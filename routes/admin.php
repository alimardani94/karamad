<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profiles.index');
Route::post('/profile', 'ProfileController@update')->name('profiles.update');

Route::resources([
    'users' => 'UserController',
    'admins' => 'AdminController',
    'tags' => 'TagController',
    'categories' => 'CategoryController',
]);

Route::group(['namespace' => 'Course', 'prefix' => 'course'], function () {
    Route::resources([
        'instructors' => 'InstructorController',
        'courses' => 'CourseController',
        'syllabuses' => 'SyllabusController',
    ]);
});

Route::group(['namespace' => 'Exam', 'prefix' => 'exam'], function () {
    Route::resources([
        'exams' => 'ExamController',
        'questions' => 'QuestionController',
    ]);
});

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resources([
        'posts' => 'PostController',
    ]);

    Route::get('/comments/', 'CommentController@index')->name('posts.comments.index');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('posts.comments.destroy');
});

Route::group(['namespace' => 'Shop', 'prefix' => 'shop'], function () {
    Route::resources([
        'products' => 'ProductController',
    ]);

    Route::get('/comments/', 'CommentController@index')->name('products.comments.index');
    Route::delete('/comments/{comment}', 'CommentController@destroy')->name('products.comments.destroy');
});

Route::post('/upload/image', 'uploadController@dropzone')->name('upload.dropzone');


