<?php

Route::apiResources([
    'users' => 'UsersController',
]);

Route::get(
    'search-user/{name}', 'UsersController@searchUser'
);

