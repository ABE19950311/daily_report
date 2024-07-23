<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckAuthUser;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([CheckAuthUser::class])->group(function () {
    Route::get('/{userType}/login', 'LoginController@index');
});

Route::post('/{userType}/login', 'LoginController@store');
Route::get('/{userType}/register', 'UserRegisterController@index');
Route::post('/{userType}/register', 'UserRegisterController@store');

Route::middleware([CheckAuth::class])->group(function () {

    Route::get('/report/show', 'ReportController@isShowReport');
    Route::get('/report/update', 'ReportController@isShowUpdateReportPage');
    Route::post('/report/json', 'ReportController@isGetReportData');
    Route::put('/report', 'ReportController@update');
    Route::delete('/report', 'ReportController@destroy');
    Route::get('/logout', 'SessionController@isLogout');
    Route::get('/contact/complete', 'ContactController@isShowCompletePage');
    Route::get('/account/password', 'AccountController@isShowPassChangePage');
    Route::post('/account/password', 'AccountController@isPasswordChange');
    Route::get('/account/user', 'AccountController@isShowUserNameChangePage');
    Route::post('/account/user', 'AccountController@isUserNameChange');

    Route::resource('home', 'HomeController');
    Route::resource('mail', 'NotificationController');
    Route::resource('report', 'ReportController');
    Route::resource('ranking', 'RankingController');
    Route::resource('contact', 'ContactController');
    Route::resource('account', 'AccountController');
    Route::resource('dashboard', 'DashboardController');
    
});

