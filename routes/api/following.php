<?php

Route::middleware(['auth:api'])->group(function () {

    Route::get('toggle-follow/{folled_id}', 'FollowingController@toggleFollow');


});

