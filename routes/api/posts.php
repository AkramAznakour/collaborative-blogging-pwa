<?php

Route::middleware(['auth:api'])->group(function () {
    Route::apiResources([
        'posts' => 'PostsController',
    ]);

    Route::get(
        'user-posts', 'PostsController@getUserPosts'
    );

});

