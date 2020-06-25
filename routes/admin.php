<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');
Route::get('/profile', 'ProfileController@profile')->name('profiles.index');
Route::post('/profile', 'ProfileController@update')->name('profiles.update');

Route::resources([
    'instructors' => 'InstructorController',
    'categories' => 'CategoryController',
    'courses' => 'CourseController',
    'syllabuses' => 'SyllabusController',
    'exams' => 'ExamController',
    'questions' => 'QuestionController',
    'users' => 'UserController',
    'admins' => 'AdminController',
]);

Route::group(['namespace' => 'Blog'], function () {
    Route::resources([
        'posts' => 'PostController',
        'tags' => 'TagController',
    ]);
});

Route::group(['namespace' => 'Shop'], function () {
    Route::resources([
        'products' => 'ProductController',
        'tags' => 'TagController',
    ]);
});

Route::post('/upload/image', 'uploadController@dropzone')->name('upload.dropzone');


