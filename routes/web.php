<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Socialite
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

// Email Verification
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Route::get('/home', 'HomeController@index')->name('home');

// User Dashboard
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {

    // Auto Like
    Route::get('tang-like', 'AutoLikeController@index');
    Route::post('tang-like', 'AutoLikeController@AutoLike');

    // Auto Comment
    Route::get('tang-comment', 'AutoCommentController@index');
    Route::post('tang-comment', 'AutoCommentController@AutoComment');
});

// Admin Dashboard
Route::group(['prefix' => 'home/admin', 'middleware' => ['role:admin']], function () {

    // Admin Index
    Route::get('', 'AdminController@index');

    // User Manager
    Route::resource('users', 'UserController');

    // Bảng giá
    Route::resource('prices', 'PriceController');

    // Quản lý người dùng bot like
    Route::resource('botlikes', 'BotlikeController');

    // View Log
    Route::get('log', 'AdminController@viewLog');
});

// User Dashboard
Route::group(['prefix' => 'cron'], function () {

    // Cronjob Auto Like
    Route::get('botlike', 'BotlikeController@action');
});
