<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');

Route::resources([
    'instructors' => 'InstructorController',
    'categories' => 'CategoryController',
    'courses' => 'CourseController',
    'syllabuses' => 'SyllabusController',
    'users' => 'UserController',
    'posts' => 'PostController',
    'tags' => 'TagController',
]);
