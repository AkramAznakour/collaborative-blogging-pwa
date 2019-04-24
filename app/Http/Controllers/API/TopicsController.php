<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\UserResource;
use App\Post;
use App\Topic;

class TopicsController extends BaseController
{
    public function index()
    {
        return Tpoic::orderBy('name')->get();
    }

    public function show($topic_id)
    {
        $topic = Tpoic::find($topic_id);

        return $this->sendResponse([
            'topic' => new UserResource($topic->user),
            'posts' => new TpoicResource($topic),
        ]);
    }

}
