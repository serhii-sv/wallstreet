<?php
/**
 * Copyright. "Hyipium" engine. All rights reserved.
 * Any questions? Please, visit https://hyipium.com
 */

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['site.status']], function () {
        Route::get('/test', 'Customer\TestController@index')->name('test');
    });
});