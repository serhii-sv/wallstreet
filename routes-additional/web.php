<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['site.status']], function () {
        Route::get('/test', 'Customer\TestController@index')->name('test');
    });
});