<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');


Route::group(['prefix' => 'orders'], function () {
    Route::delete('destroy/{order}', 'OrderController@destroy')->name('orders.destroy');
});

