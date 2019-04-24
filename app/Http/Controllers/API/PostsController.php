<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostResource;
use App\Post;
use App\Topic;

class PostsController extends BaseController
{
    public function index()
    {
        return Post::orderBy('id', 'desc')->get();
    }

    public function show($post_id)
    {

        $post =  Post::find($post_id) ;


        return $post;

        return $this->sendResponse([
            'post' => new PostResource($post),
        ]);
    }

    public function store()
    {
        $user = auth()->user();

        $post = new Post();

        if (request()->file('image')){
            $img_name = time() . '.' . request()->file('image')->getClientOriginalExtension();

            request()->file('image')->move(
                base_path() . '/public/img/', $img_name
            );

            $post->image = $img_name;
        }

        $topic = Topic::where('name','=',request()->input("topic"))->first();

        if (!$topic){
            $topic = new Topic();
            $topic->name = request()->input("topic");
            $topic->save();
        }

        $post->title = request()->input("title");
        $post->content = request()->input("content");
        $post->topic_id = $topic->id;
        $post->user_id = $user->id;

        $post->save();

        return
            [
                "post_id"=>$post->id,
                "message"=>"post was successfully created"
            ];
    }


    protected function getUserPosts()
    {
        $user = auth()->user()->id;
        return Post::where('user_id',"=",auth()->user()->id)->get();
    }
}
