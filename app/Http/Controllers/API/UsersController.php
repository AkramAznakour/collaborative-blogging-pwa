<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\User;

class UsersController extends BaseController
{


    public function show($user_id)
    {
        $user = User::find($user_id);

        return [
            "user" => new UserResource($user),
            "message" => ""
        ];
    }

    public function store()
    {
        $user_id = User::create(request()->all());

        $user = $this->getUser($user_id->id);

        return [
            "user" => new UserResource($user),
            "message" => ""
        ];
    }

    public function update($user_id)
    {
        User::find($user_id)->update(request()->all());

        $user = $this->getUser($user_id->id);

        return [
            "user" => new UserResource($user),
            "message" => ""
        ];
    }


    public function searchUser($name)
    {
        $users = User::where('name', 'like', '%' . $name . '%')->get();

        return [
            "users" => $users,
            "message" => ""

        ];
    }

    public function destroy($user_id)
    {
        User::destroy($user_id);
    }
}
