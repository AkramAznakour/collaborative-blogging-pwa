<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Post;
use App\Topic;
use willvincent\Rateable\Rating;

class PostsController extends BaseController
{
    public function index()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);

        return $this->sendResponse([
            'author' => new UserResource($post->user),
            'post' => new PostResource($post),
            "message" => ""
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

        return [
            "post_id" => $post->id,
            "message" => "your post was successfully published"
        ];
    }


    protected function getUserPosts($user_id, $page)
    {
        $message = "scroll down for more content";

        $posts = Post::where('user_id', "=", $user_id)->get();

        $postsResources = $posts->map(function ($post) {
            return new PostExcerptResource($post);
        });

        $loadMore = true;

        $postsResources = $postsResources->slice($page, 3);

        if ($postsResources->count() == 0):
            $loadMore = false;
            $message = "no more content to load";
        endif;

        return [
            "posts" => $postsResources,
            "loadMore" => $loadMore,
            "message" => $message,
        ];
    }

    public function ratePost($post_id, $rate)
    {
        $user = auth()->user();
        $post = Post::find($post_id);
        $rating = new  Rating();

        if (Rating::where("rateable_id", $post_id)->where("user_id", $user->id)->first()) {
            $rating = Rating::where("rateable_id", $post_id)->where("user_id", $user->id)->first();
        } else
            $rating->user_id = $user->id;

        $rating->rating = $rate;
        $post->ratings()->save($rating);

        $message = "you have successfully rated this post with ".$rate;

        return [
            "message" => $message
        ];
    }
}
