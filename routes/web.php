<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('sign-up', [
        'uses' => 'SignUpController@show',
        'as' => 'auth.sign-up',
        'middleware' => 'guest',
    ]);
    Route::post('sign-up', [
        'uses' => 'SignUpController@request',
        'middleware' => 'guest',
    ]);
    Route::get('sign-in', [
        'uses' => 'SignInController@show',
        'as' => 'auth.sign-in',
        'middleware' => 'guest',
    ]);
    Route::post('sign-in', [
        'uses' => 'SignInController@request',
        'middleware' => 'guest',
    ]);
    Route::get('sign-out', [
        'uses' => 'SignOutController@handle',
        'as' => 'auth.sign-out',
    ]);
    Route::get('instructor/sign-up', [
        'uses' => 'Instructor\SignUpController@show',
        'as' => 'auth.instructor.sign-up',
        'middleware' => 'guest',
    ]);
    Route::post('instructor/sign-up', [
        'uses' => 'Instructor\SignUpController@request',
        'middleware' => 'guest',
    ]);
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@home')->name('home');
    Route::get('/search', 'SearchController@search')->name('search');
    Route::get('/course/search', 'SearchController@courseSearch')->name('course.search');
    Route::get('/post/search', 'SearchController@postSearch')->name('post.search');
    Route::get('/product/search', 'SearchController@productSearch')->name('product.search');

    Route::group(['prefix' => 'course', 'namespace' => 'Course'], function () {
        Route::resources([
            'courses' => 'CourseController',
            'syllabuses' => 'SyllabusController',
        ]);
        Route::post('/{course}/reactions', ['as' => 'courses.react', 'uses' => 'CourseController@react']);
    });

    Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
        Route::resources([
            'posts' => 'PostController',
        ]);
        Route::resource('posts.comments', 'CommentController')->shallow();
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/', 'ShopController@index')->name('shop.index');
        Route::get('/product/{id}', 'ShopController@product')->name('shop.product');
        Route::get('/cart', 'CartController@show')->name('shop.cart.show');
        Route::get('/cart/{product}/{count}', 'CartController@add')->name('shop.cart.add');
        Route::get('/checkout', 'ShopController@checkout')->name('shop.checkout');
        Route::get('/checkout', 'ShopController@checkout')->name('shop.checkout');

        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        Route::post('/orders', 'OrderController@store')->name('orders.store');
        Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
    });


    Route::post('/payment/{gateway}/{invoice}/callback', 'PaymentController@callback')->name('payment.callback');
});
