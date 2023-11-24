<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class CategoryController extends Controller
{
    public function view(){
        return view('index',[
            "categories"=>Category::all(),
            "articles"=>Article::latest('id')->take(4)->get()
        ]);
    }

    public function addViewGo(){
        return view('addNewView',[
            "categories"=>Category::all(),
            "articles"=>Article::all()
        ]);
    }

    public function delCategory($id){
        $category = Category::find($id);

        $articles = Article::where('category_id', $category['id'])->get();

        foreach ($articles as $article) {
            $comments = Comment::where('article_id', $article['id'])->get();

            foreach ($comments as $comment) {
                $comment->delete();
            }

            $article->delete();
        }

        if ($category) {
            $category->delete();
        }
        return redirect()->back();
    }
    public function addCategory(Request $request)
    {
        $app_info = $request->all();

        $params = [
            "title" => $app_info["title"],
            "image" => $app_info["image"]
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move('public/images', $fileName);
            $params["image"] = $fileName;
        }
        else{
            $params["image"] = 'default.png';
        }

        Category::create($params);

        return redirect("/");
    }
}
