<?php

Route::middleware(['auth:api'])->group(function () {

    Route::get('topics', 'TopicsController@index');

    Route::get('topics/{topic_id}', 'TopicsController@show');

});

