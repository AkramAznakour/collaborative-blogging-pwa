<?php

namespace App\Http\Controllers\API;

use App\Post;

class PostsController extends BaseController
{
    public function index()
    {
        return Post::orderBy('id', 'desc')
            ->get();
    }

    public function show($group)
    {
        return $this->getPost($group);
    }

    public function store()
    {
        $group = Post::create(request()->all());

        return $this->getPost($group->id);
    }

    public function update($group)
    {
        Post::whereId($group)->update(request()->all());

        return $this->getPost($group);
    }

    public function destroy($group)
    {
        Post::destroy($group);
    }

    protected function getPost($group)
    {
        return Post::whereId($group)->first();
    }
    protected function getUserPosts()
    {
        $user = auth()->user();
        return $user->posts;
    }
}
