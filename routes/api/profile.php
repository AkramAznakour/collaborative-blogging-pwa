<?php

Route::group(['namespace' => 'Profile', 'prefix' => 'profile'], function () {
    // Current user
    Route::group(['prefix' => 'current', 'middleware' => ['auth:api']], function () {
        Route::post('set-password', 'ProfileController@setPassword');
        Route::post('set-avatar', 'ProfileController@setAvatar');
        Route::post('set-user-data', 'ProfileController@setUserData');
    });
});
