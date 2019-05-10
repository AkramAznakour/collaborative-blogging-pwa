<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'createdAt' => (string)$this->created_at,
            'updatedAt' => (string)$this->updated_at,
        ];

        if (auth()->check() && auth()->user()->id != $this->id)
            $data["isFollowed"] = auth()->user()->isFollowing(User::find($this->id));

        return $data;
    }
}
