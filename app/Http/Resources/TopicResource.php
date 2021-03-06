<?php

namespace App\Http\Resources;

use App\Topic;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $last_topic_post = Topic::find($this->id)->posts->last();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'post' => new PostExcerptResource($last_topic_post)
        ];
    }
}
