<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    public function addComment(Request $request){
        $app_info = $request->all();
        
        $params = [
            "user_id"=>$app_info["user_id"],
            "article_id"=>$app_info["article_id"],
            "text"=>$app_info["text"]
        ];

        Comment::create($params);

        return redirect()->back();
    }
    public function delComment($id){
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
        }
        return redirect()->back();
    }
}