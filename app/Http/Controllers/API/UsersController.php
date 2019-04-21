<?php

namespace App\Http\Controllers\API;

use App\User;

class UsersController extends BaseController
{
    public function index()
    {
        return User::orderBy('id', 'desc')
            ->get();
    }

    public function show($user_id)
    {
        return $this->getUser($user_id);
    }

    public function store()
    {
        $user_id = User::create(request()->all());

        return $this->getUser($user_id->id);
    }

    public function update($user_id)
    {
        User::whereId($user_id)->update(request()->all());

        return $this->getUser($user_id);
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
        return User::where('name','like','%'.$name.'%')->get();
    }


}
