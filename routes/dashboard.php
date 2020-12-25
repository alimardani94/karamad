<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::post('/profile/update', 'ProfileController@update')->name('profile.update');
Route::post('/profile/image/update', 'ProfileController@imageUpdate')->name('profile.image.update');
Route::post('/profile/password/update', 'ProfileController@changePassword')->name('profile.password.change');


Route::group(['prefix' => 'products'], function () {
    Route::post('/', 'ProductController@store')->name('products.store');
});

Route::group(['prefix' => 'orders'], function () {
    Route::delete('destroy/{order}', 'OrderController@destroy')->name('orders.destroy');
    Route::get('show/{order}', 'OrderController@show')->name('orders.show');
    Route::get('pay/{order}', 'OrderController@pay')->name('orders.pay');
});

