<?php

namespace App\Http\Controllers\API;


use App\User;

class FollowingController extends BaseController
{
    public function toggleFollow($folled_id)
    {

        $user = auth()->user();

        $folled_user = User::find($folled_id);

        $user->toggleFollow($folled_user);

        return [
            "toggleFollow"=> true
        ];
    }

}
