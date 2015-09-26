<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Static
Route::get('/', ['as' => 'homepage', 'uses' => 'PagesController@index']);

// Mentor CMS
Route::group(['middleware' => 'auth'], function () {
    Route::get('/mentor', ['as' => 'mentor.info', 'uses' => 'Mentor\MentorController@showInfo']);
    Route::get('/mentor/profile', ['as' => 'mentor.profile', 'uses' => 'Mentor\MentorController@showProfile']);
    Route::post('/mentor/profile', ['as' => 'mentor.store', 'uses' => 'Mentor\MentorController@storeProfile']);
});
Route::get('/mentor/login', ['as' => 'mentor.login', 'uses' => 'Mentor\MentorController@showLogin']);
Route::get('/mentor/login/go', ['as' => 'mentor.login.go', 'uses' => 'Mentor\MentorController@doLogin']);

// Student CMS
Route::group(['middleware' => 'auth'], function () {
    Route::get('/student', ['as' => 'student.info', 'uses' => 'Student\StudentController@showInfo']);
    Route::get('/student/profile', ['as' => 'student.profile', 'uses' => 'Student\StudentController@showProfile']);
    Route::post('/student/profile', ['as' => 'student.store', 'uses' => 'Student\StudentController@storeProfile']);
});
Route::get('/student/login', ['as' => 'student.login', 'uses' => 'Student\StudentController@showLogin']);
Route::get('/student/login/go', ['as' => 'student.login.go', 'uses' => 'Student\StudentController@doLogin']);

// Authentication
Route::get('/auth/facebook', ['as' => 'auth.facebook', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('/auth/facebook/callback', ['as' => 'auth.facebook.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);
Route::get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('/test', function() {
   return Auth::user()->student->sendBigBroNotificationEmail();
});