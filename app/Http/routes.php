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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/mentor/login', ['as' => 'mentor.login', 'uses' => 'Mentor\MentorController@showLogin']);
    Route::get('/mentor/login/go', ['as' => 'mentor.login.go', 'uses' => 'Mentor\MentorController@doLogin']);
});


// Student CMS
Route::group(['middleware' => 'auth'], function () {
    Route::get('/student', ['as' => 'student.info', 'uses' => 'Student\StudentController@showInfo']);
    Route::get('/student/profile', ['as' => 'student.profile', 'uses' => 'Student\StudentController@showProfile']);
    Route::post('/student/profile', ['as' => 'student.store', 'uses' => 'Student\StudentController@storeProfile']);
});
Route::group(['middleware' => 'guest'], function () {
    Route::get('/student/login', ['as' => 'student.login', 'uses' => 'Student\StudentController@showLogin']);
    Route::get('/student/login/go', ['as' => 'student.login.go', 'uses' => 'Student\StudentController@doLogin']);
});


// Authentication
Route::get('/auth/facebook', ['as' => 'auth.facebook', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('/auth/facebook/callback', ['as' => 'auth.facebook.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);
Route::get('/auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Redirects
Route::get('/brucosi', function() {
   return redirect()->route('student.login');
});

// Feedback forms
Route::get('/anketa/mali-buraz', function() {
    return view('forms.maliburaz');
});
Route::get('/anketa/veliki-buraz', function() {
    return view('forms.velikiburaz');
});

// Admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', ['as' => 'admin.statistics', 'uses' => 'Admin\StatisticsController@getPage']);
    Route::get('/admin/faces/little',
        ['as' => 'admin.faces.little', 'uses' => 'Admin\FacesController@getLittleBrosFacesPage']);
    Route::get('/admin/faces/big', ['as' => 'admin.faces.big', 'uses' => 'Admin\FacesController@getBigBrosFacesPage']);
    Route::get('/admin/face/{userId}', ['as' => 'admin.face', 'uses' => 'Admin\FacesController@getSingleFace']);
    Route::get('/admin/settings', ['as' => 'admin.settings', 'uses' => 'Admin\SettingsController@getSettingsPage']);
    Route::get('/admin/settings/setStudentsAsMentors', ['as' => 'admin.settings.setStudentsAsMentors', 'uses' => 'Admin\SettingsController@setStudentsAsMentors']);
    Route::get('/admin/settings/truncateStudentsTable', ['as' => 'admin.settings.truncateStudentsTable', 'uses' => 'Admin\SettingsController@truncateStudentsTable']);
    Route::get('/admin/settings/setMentorsAsInactive', ['as' => 'admin.settings.setMentorsAsInactive', 'uses' => 'Admin\SettingsController@setMentorsAsInactive']);
    Route::get('/admin/settings/resetStudentCount', ['as' => 'admin.settings.resetStudentCount', 'uses' => 'Admin\SettingsController@resetStudentCount']);
    Route::get('/admin/settings/sendEmailsToMentors', ['as' => 'admin.settings.sendEmailsToMentors', 'uses' => 'Admin\SettingsController@sendEmailsToMentors']);
    Route::get('/admin/settings/setMatching', ['as' => 'admin.settings.setMatching', 'uses' => 'Admin\SettingsController@setMatching']);
    Route::get('/admin/settings/notifyMatch', ['as' => 'admin.settings.notifyMatch', 'uses' => 'Admin\SettingsController@notifyMatch']);
    Route::get('/admin/email', ['as' => 'admin.email', 'uses' => 'Admin\EmailController@getPage']);
    Route::post('/admin/email/sendEmail', ['as' => 'admin.email.sendEmail', 'uses' => 'Admin\EmailController@sendEmail']);
});