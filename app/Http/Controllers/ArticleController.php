<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class ArticleController extends Controller
{
    public function view($id)
    {
        return view('articlesView', [
            "categories" => Category::all(),
            "articles" => Article::where('category_id', $id)->get(),
            "users" => User::all()
        ]);
    }
    public function sortTwo($id)
    {
        return view('articlesView', [
            "categories" => Category::all(),
            "articles" => Article::where('category_id', $id)->get()->sortByDesc('id'),
            "users" => User::all()
        ]);
    }
    public function viewArticle($id)
    {
        return view('articleView', [
            "categories" => Category::all(),
            "articles" => Article::where('id', $id)->get(),
            "users" => User::all(),
            "comments" => Comment::where('article_id', $id)->get(),
        ]);
    }
    public function delArticle($id)
    {
        $article = Article::find($id);

        $comments = Comment::where('article_id', $article['id'])->get();

        foreach ($comments as $comment) {
            $comment->delete();
        }

        $article->delete();

        return redirect()->back();
    }

    public function addArticle(Request $request)
    {
        $app_info = $request->all();

        $params = [
            "user_id" => $app_info["user_id"],
            "category_id" => $app_info["category"],
            "title" => $app_info["title"],
            "text" => $app_info["text"],
            "image" => $app_info["image"]
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move('images', $fileName);
            $params["image"] = $fileName;
        }
        else{
            $params["image"] = 'default.png';
        }

        Article::create($params);

        return redirect("/");
    }
}
