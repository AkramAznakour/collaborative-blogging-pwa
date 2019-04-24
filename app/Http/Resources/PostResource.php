<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'date' => $this->date,
            'content' => $this->content,
          //  'topic' => $this->topic->name,
            'topic_id' => (string) $this->topic_id,
            'date' => (string) $this->created_at,
          ];
    }
}
