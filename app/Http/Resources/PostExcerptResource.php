<?php

namespace App\Http\Resources;

use App\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostExcerptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $sug = Post::all()->random(2);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'excerpt' => substr(strip_tags($this->excerp),1,80),
            'topic' => $this->topic->name,
            'topic_id' => $this->topic_id,
            'date' => $this->created_at->format('d M Y'),
        ];
    }
}
