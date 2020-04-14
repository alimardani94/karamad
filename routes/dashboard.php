<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@home')->name('home');


Route::group(['prefix' => 'onlineCourses'], function () {
    Route::post('/', 'OnlineCourseController@store')->name('onlineCourses.store');
    Route::get('/instructor/{onlineCourse}', 'OnlineCourseController@instructurShow')->name('onlineCourses.instructor.show');
    Route::get('/{onlineCourse}', 'OnlineCourseController@studentShow')->name('onlineCourses.student.show');
});

