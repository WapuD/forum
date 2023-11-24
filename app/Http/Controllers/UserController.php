<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function signin(){
        return view("signin");
    }
    public function signup(){
        return view("signup");
    }
    public function signout(){
        Session::flush();
        Auth::logout();
        return redirect("/");
    }
    public function profile(){
        return view('profile', [
            "users" => Auth::user(),
            "categories" => Category::all(),
            "articles" => Article::where('user_id', Auth::user()['id'])->get(),
        ]);
    }

    public function redactProfile(Request $request){

        $request->validate
        ([
            "name"=>"required|max:50",
            "password"=>"required|max:50"
        ],
        [
            "name.required"=>"Поле обзяательно для заполнения",
            "name.max"=>"Длина названия не должна превышать 50 символов",
            "password.required"=>"Поле обзяательно для заполнения",
            "password.max"=>"Длина названия не должна превышать 50 символов"
        ]);
        
        $user = User::find(Auth::user()['id']);
        $user->name = $request->input('name');
        $user->password = Hash::make(($request->input('password')));
        $user->save();
        return redirect()->back();
    }

    public function signup_valid(Request $request){

        $request->validate
        ([
            "email"=>"required|max:50",
            "name"=>"required|max:50",
            "password"=>"required|max:50"
        ],
        [
            "email.required"=>"Поле обзяательно для заполнения",
            "email.max"=>"Длина названия не должна превышать 50 символов",
            "name.required"=>"Поле обзяательно для заполнения",
            "name.max"=>"Длина названия не должна превышать 50 символов",
            "password.required"=>"Поле обзяательно для заполнения",
            "password.max"=>"Длина названия не должна превышать 50 символов"
        ]);

        $app_info = $request->all();

        User::create([
            "name"=>$app_info["user_name"],
            "email"=>$app_info["user_email"],
            "password"=>Hash::make(($app_info["password"])),
            "status"=>"0"
        ]);
        return redirect("/signin");
    }

    public function signin_valid(Request $request){
        $credentials = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);
        if (Auth::attempt($credentials)){
            return redirect("/");
        }
        return redirect()->back();


        if (Auth::getUser()) {
            $credentials = $request->validate([
                "email" => ['required', 'email'],
                "password" => ['required']
            ]);
            $user = Auth::user();
            if ($user->status == '1'){
                return redirect("/admin");
            }
            else if (Auth::attempt($credentials)){
                return redirect("/");
            }
        }
        return redirect()->back();
    }
}
