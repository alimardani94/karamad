<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profiles.index');
Route::post('/profile', 'ProfileController@update')->name('profiles.update');

Route::resources([
    'users' => 'UserController',
    'admins' => 'AdminController',
    'tags' => 'TagController',
]);

Route::group(['namespace' => 'Course', 'prefix' => 'course', 'as' => 'course.'], function () {
    Route::resources([
        'instructors' => 'InstructorController',
        'courses' => 'CourseController',
        'syllabuses' => 'SyllabusController',
        'categories' => 'CategoryController',
    ]);
});

Route::group(['namespace' => 'Exam', 'prefix' => 'exam' , 'as' => 'exam.'], function () {
    Route::resources([
        'exams' => 'ExamController',
        'questions' => 'QuestionController',
    ]);
});

Route::group(['namespace' => 'Blog', 'prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::resources([
        'posts' => 'PostController',
    ]);

    Route::get('/comments/', 'CommentController@index')->name('posts.comments.index');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('posts.comments.destroy');
});

Route::group(['namespace' => 'Shop', 'prefix' => 'shop', 'as' => 'shop.'], function () {
    Route::resources([
        'products' => 'ProductController',
        'categories' => 'CategoryController',
    ]);

    Route::post('/products/{product}/change-status', 'ProductController@changeStatus')->name('products.change-status');

    Route::get('/comments/', 'CommentController@index')->name('products.comments.index');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('products.comments.destroy');

    Route::get('/orders/', 'OrderController@index')->name('orders.index');
    Route::post('/orders/{order}/change-status', 'OrderController@changeStatus')->name('orders.change-status');
});

Route::get('/transactions/', 'TransactionController@index')->name('transactions.index');

Route::get('/contact-form/', 'ContactFormController@index')->name('contact-form.index');


