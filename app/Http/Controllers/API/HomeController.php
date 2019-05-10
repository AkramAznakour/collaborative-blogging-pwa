<?php

namespace App\Http\Controllers\API;


use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\PostResource;
use App\Post;
use App\Traits\AuthTokenResponses;
use Illuminate\Http\Request;


class HomeController extends BaseController
{


    public function index($page)
    {
        $loadMore = true;
        $message = "scroll down for more content";

        if (!auth()->check()) {

            $posts = $this->getGenrerivPostsFeed()->slice($page, 5);


            if ($posts->count() == 0):
                $loadMore = false;
                $message = "no more content to load";
            endif;
            return [
                "posts" => $posts,
                "loadMore" => $loadMore,
                "message" => $message,
            ];
        }


        $posts = $this->getUserPostsFeed()->slice($page, 5);

        if ($posts->count() == 0):
            $posts = $this->getGenrerivPostsFeed()->slice($page, 5);
            if ($posts->count() == 0) :
                $loadMore = false;
            endif;

        elseif ($posts->count() == 0):
            $loadMore = false;
        endif;


        if ($loadMore == false)
            $message = "no more content to load";

        return [
            "posts" => $posts,
            "loadMore" => $loadMore,
            "message" => $message,
        ];


    }

    public function getUserPostsFeed()
    {

        $user = auth()->user();

        $followed_users = $user->followings()->get();
        $posts = [];

        foreach ($followed_users as $followed_user) {
            foreach ($followed_user->posts as $post) {
                $posts[] = new PostExcerptResource($post);
            }
        }

        return collect($posts);
    }

    public function getGenrerivPostsFeed()
    {
        $posts = Post::all()->map(
            function ($post) {
                return new PostExcerptResource($post);
            }
        );


        return $posts;
    }
}
