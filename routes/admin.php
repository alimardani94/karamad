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
});

Route::group(['namespace' => 'Shop', 'prefix' => 'shop'], function () {
    Route::resources([
        'products' => 'ProductController',
    ]);
});

Route::post('/upload/image', 'uploadController@dropzone')->name('upload.dropzone');


