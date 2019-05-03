<?php

Route::middleware(['auth:api'])->group(function () {

    Route::get('home/{page}', 'HomeController@index');


});

