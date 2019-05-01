<?php

namespace App\Http\Resources;

use App\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'date' => $this->date,
            'content' => $this->content,
            'topic' => $this->topic->name,
            'rating' => $this->userAverageRating,
            'topic_id' => $this->topic_id,
            'date' => $this->created_at->format('d M Y'),
            'next'=> [
                'id' => $sug[0]->id,
                'title' => $sug[0]->title,
                'image' => $sug[0]->image,
            ],
            'previous'=> [
                'id' => $sug[1]->id,
                'title' => $sug[1]->title,
                'image' => $sug[1]->image,
            ]
        ];
    }
}
