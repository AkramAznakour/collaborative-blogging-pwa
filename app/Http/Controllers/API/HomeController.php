<?php

namespace App\Http\Controllers\API;


use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;


class HomeController extends BaseController
{
    public function index($page)
    {
        //$posts = $this->getUserPostsFeed();

        $posts = $this->getUserPostsFeed()->slice( $page,5);


        $loadMore = true;

        if ($posts->count() == 0)
            $loadMore = false;


        return [
            "posts" => $posts,
            "loadMore" => $loadMore,
            "message" => "",
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
}
