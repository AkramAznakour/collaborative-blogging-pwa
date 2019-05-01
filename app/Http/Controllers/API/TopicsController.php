<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PostExcerptResource;
use App\Http\Resources\TopicResource;
use App\Post;
use App\Topic;


class TopicsController extends BaseController
{
    public function index()
    {
        $topics = Topic::orderBy('created_at')->get();
        $featureds = Post::all()->random(5);

        $topicsResources = $topics->map(function ($topic) {
            return new TopicResource($topic);
        });

        $featuredsPostsResources = $featureds->map(function ($featureds) {
            return new PostExcerptResource($featureds);
        });


        return $this->sendResponse([
            'topics' => $topicsResources,
            'featureds' => $featuredsPostsResources
        ]);
    }

    public function show($topic_id)
    {
        $topic = Topic::find($topic_id);

        $posts = Post::where("topic_id","=",$topic_id)->take(10)->get();

        $featureds = Post::where("topic_id","=",$topic_id)->take(5)->get();


        $featuredsPostsResources = $featureds->map(function ($featureds) {
            return new PostExcerptResource($featureds);
        });

        $postsResources = $featureds->map(function ($posts) {
            return new PostExcerptResource($posts);
        });


        return $this->sendResponse([
            'topic' => new TopicResource($topic),
            'posts' => $postsResources,
            'featureds' => $featuredsPostsResources
        ]);


    }

}
