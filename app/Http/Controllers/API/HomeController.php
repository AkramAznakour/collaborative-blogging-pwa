<?php

namespace App\Http\Controllers\API;


use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Collection;

class HomeController extends BaseController
{
    public function index()
    {

        $user = auth()->user();

        $followed_users = $user->followings()->get();
        $posts = [];

        foreach ($followed_users as $followed_user) {
            foreach ($followed_user->posts as $post) {
                $posts[] = new PostExcerptResource($post);
            }
        }

        $posts = new Collection($posts);
        $posts = $posts->sortBy('date');

        return [
            "latest_post" => $posts->slice(0, 1)->first(),
            "second_posts" => $posts->slice(1, 4)->all(),
            "posts" => $posts->slice(3)->all(),
            "featureds" => $posts->slice(1, 5)->all(),
        ];
    }


}
