<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    require base_path('routes/api/auth.php');
    require base_path('routes/api/profile.php');
    require base_path('routes/api/users.php');
});


Route::fallback(function() {
    return response()->json(['message' => 'Not Found!'], 404);
});

/*************Authentication *************/
Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');
Route::get('user', 'Auth\AuthController@index');

/**************Posts **************/
Route::post('post/store', 'PostController@store');
