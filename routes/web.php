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
    Route::put('/report', 'ReportController@update');
    Route::delete('/report', 'ReportController@destroy');
    Route::get('/logout', 'SessionController@isLogout');

    Route::resource('home', 'HomeController');
    Route::resource('mail', 'NotificationController');
    Route::resource('report', 'ReportController');
    Route::resource('ranking', 'RankingController');
    Route::resource('contact', 'ContactController');
    
});

