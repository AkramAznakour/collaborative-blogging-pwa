<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Post;
use App\Topic;

class PostsController extends BaseController
{
    public function index()
    {
        return Post::orderBy('created_at', 'desc')->random(10);
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);

        return $this->sendResponse([
            'author' => new UserResource($post->user),
            'post' => new PostResource($post),
        ]);
    }

    public function store()
    {
        $user = auth()->user();

        $post = new Post();

        if (request()->file('image')) {
            $img_name = time() . '.' . request()->file('image')->getClientOriginalExtension();

            request()->file('image')->move(
                base_path() . '/public/img/', $img_name
            );

            $post->image = $img_name;
        }

        $topic = Topic::where('name', '=', request()->input("topic"))->first();

        if (!$topic) {
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
                "post_id" => $post->id,
                "message" => "post was successfully created"
            ];
    }


    protected function getUserPosts($user_id)
    {
        $posts = Post::where('user_id', "=", $user_id)->get();

        $postsResources = $posts->map(function ($post) {
            return new PostExcerptResource($post);
        });

        return
            [
                "posts" => $postsResources,
                "message" => "post was successfully created"
            ];
    }
}
