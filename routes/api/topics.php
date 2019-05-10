<?php

Route::get('topics', 'TopicsController@index');

Route::get('topics/{topic_id}', 'TopicsController@show');
