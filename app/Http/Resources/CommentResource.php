<?php

namespace App\Http\Resources;

use App\Topic;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'date' => $this->created_at,
            'author' => [
                'name'=> $this->user->name,
                'image'=> $this->user->avatar,
            ],
        ];
    }
}
