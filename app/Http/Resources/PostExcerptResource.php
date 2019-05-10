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

        $rating = 0;
        if ($this->averageRating )
            $rating = $this->averageRating;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'rating' => (int) $rating  ,
            'excerpt' => substr(strip_tags($this->content),1,120)."..." ,
            'topic' => $this->topic->name,
            'topic_id' => $this->topic_id,
            'date' => $this->created_at->format('d M Y'),
            'time' => strtotime($this->created_at),
        ];
    }
}
