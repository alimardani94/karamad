<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('/otp', [
        'uses' => 'OtpController@show',
        'as' => 'auth.otp',
        'middleware' => 'guest',
    ]);
    Route::post('/otp/request', [
        'uses' => 'OtpController@request',
        'as' => 'auth.otp.request',
        'middleware' => ['throttle:3,1', 'guest'],
    ]);
    Route::post('/otp/submit', [
        'uses' => 'OtpController@submit',
        'as' => 'auth.otp.submit',
        'middleware' => ['throttle:3,1', 'guest'],
    ]);

    Route::get('sign-up', [
        'uses' => 'SignUpController@show',
        'as' => 'auth.sign-up',
        'middleware' => 'auth',
    ]);
    Route::post('sign-up', [
        'uses' => 'SignUpController@request',
        'middleware' => 'auth',
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
});

//verify email
Route::get('/account/email/verify/{token}', [
    'uses' => 'Account\EmailResetController@verify',
    'as' => 'account.email.verify',
]);

// get all cities of province
Route::get('/cities', 'CityController@get')->name('cities');

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'HomeController@home')->name('home');

    Route::get('/contact-us', 'ContactUsController@show')->name('contact-us');
    Route::post('/contact-us', 'ContactUsController@request');

    Route::get('/search', 'SearchController@search')->name('search');
    Route::get('/course/search', 'SearchController@courseSearch')->name('course.search');
    Route::get('/post/search', 'SearchController@postSearch')->name('post.search');
    Route::get('/product/search', 'SearchController@productSearch')->name('product.search');

    Route::group(['prefix' => 'courses', 'namespace' => 'Course'], function () {
        Route::get('/', 'CourseController@index')->name('courses.index');
        Route::get('/{course}/{slug?}', 'CourseController@show')->name('courses.show');

        Route::post('/{course}/reactions', ['as' => 'courses.react', 'uses' => 'CourseController@react']);


        Route::group(['prefix' => 'syllabuses'], function () {
            Route::get('/{syllabus}/{slug?}', 'SyllabusController@show')->name('syllabuses.show');
        });

        Route::get('/instructors/{instructor}/{slug?}', 'InstructorController@show')->name('instructors.show');
    });

    Route::group(['prefix' => 'articles', 'namespace' => 'Blog'], function () {
        Route::get('/', 'PostController@index')->name('posts.index');
        Route::get('/filter', 'PostController@filter')->name('posts.filter');
        Route::get('/{post}/{slug?}', 'PostController@show')->name('posts.show');

        Route::resource('posts.comments', 'CommentController')->shallow();
    });

    Route::group(['prefix' => 'shop', 'namespace' => 'Shop'], function () {
        Route::get('/', 'ShopController@index')->name('shop.index');
        Route::get('/product/{id}/{slug?}', 'ShopController@product')->name('shop.product');
        Route::get('/cart', 'CartController@show')->name('shop.cart.show');
        Route::get('/cart/{product}/{count}', 'CartController@add')->name('shop.cart.add');
        Route::get('/checkout', 'ShopController@checkout')->name('shop.checkout');
        Route::get('/checkout', 'ShopController@checkout')->name('shop.checkout');

        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        Route::post('/orders', 'OrderController@store')->name('orders.store');
        Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
    });

    Route::group(['prefix' => 'provinces', 'namespace' => 'Province'], function () {
        Route::get('/', 'ProvinceController@index')->name('provinces.index');
        Route::get('/{province}', 'ProvinceController@show')->name('provinces.show');
    });

    Route::get('/invoices/{invoice}', 'InvoiceController@show')->name('invoices.show');
    Route::post('/invoices/{invoice}/pay', 'InvoiceController@pay')->name('invoices.pay');

    Route::any('/payment/callback/{gateway}/{invoice}', 'PaymentController@callback')->name('payment.callback');
});
