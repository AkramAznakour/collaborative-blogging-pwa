<?php

Route::middleware(['auth:api'])->group(function () {
    Route::apiResources([
        'posts' => 'PostsController',
    ]);

    Route::get('user-posts/{user_id}', 'PostsController@getUserPosts');

});

