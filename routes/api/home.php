<?php

Route::middleware(['auth:api'])->group(function () {

    Route::get('home', 'HomeController@index');


});

