<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
Route::post('/profile/image/update', 'ProfileController@imageUpdate')->name('profile.image.update');
Route::post('/profile/password/update', 'ProfileController@changePassword')->name('profile.password.change');


Route::group(['prefix' => 'orders'], function () {
    Route::delete('destroy/{order}', 'OrderController@destroy')->name('orders.destroy');
});

