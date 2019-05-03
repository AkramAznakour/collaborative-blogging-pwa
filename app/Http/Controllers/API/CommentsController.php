<?php

namespace App\Http\Controllers\API;


use App\Comment;
use App\Http\Resources\CommentResource;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends BaseController
{

    public function store($post_id, Request $request)
    {

        $user = auth()->user();


        $comment = new Comment();
        $comment->title = $request->input("title");
        $comment->content = $request->input("content");
        $comment->post_id = $post_id;
        $comment->user_id = $user->id;
        $comment->save();

        return [
            "comment" => new CommentResource($comment)
        ];
    }

    public function getPostComments($post_id)
    {
        $comments =  Post::find($post_id)->comments->map(function($comment){
            return new CommentResource($comment );
        });

        return [
            "comments" => $comments
        ];
    }
}
