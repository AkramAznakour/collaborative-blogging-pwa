<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\User;

class UsersController extends BaseController
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return
            [
                "users" => $users,
                "message" => "success"
            ];

    }

    public function show($user_id)
    {
        $user = $this->getUser($user_id);
        return
            [
                "user" => new UserResource($user),
                "message" => "success"
            ];
    }

    public function store()
    {
        $user_id = User::create(request()->all());

        $user =  $this->getUser($user_id->id);

        return
            [
                "user" => new UserResource($user),
                "message" => "success"
            ];
    }

    public function update($user_id)
    {
        User::whereId($user_id)->update(request()->all());

        $user =  $this->getUser($user_id->id);

        return
            [
                "user" => new UserResource($user),
                "message" => "success"
            ];
    }

    public function destroy($user_id)
    {
        User::destroy($user_id);
    }

    public function getUser($user_id)
    {
        return User::whereId($user_id)->first();
    }

    public function searchUser($name)
    {
        return User::where('name', 'like', '%' . $name . '%')->get();
    }


}
