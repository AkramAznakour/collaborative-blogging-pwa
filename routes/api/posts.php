<?php

Route::middleware(['auth:api'])->group(function () {

    Route::get('rate/{post_id}/{rate}', 'PostsController@ratePost');



    Route::post('addComment/{post_id}/', 'CommentsController@store');

});

Route::get('getComments/{post_id}/', 'CommentsController@getPostComments');

Route::get('user-posts/{user_id}/{page}', 'PostsController@getUserPosts');



Route::apiResources([
    'posts' => 'PostsController',
]);
