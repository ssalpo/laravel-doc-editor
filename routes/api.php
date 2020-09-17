<?php

Route::group(['prefix' => 'v1'], function () {
    Route::resource('document', 'DocumentController')->except(['create', 'edit', 'destroy']);
    Route::post('document/{id}/publish', 'DocumentController@publish')->name('document.publish');
});
