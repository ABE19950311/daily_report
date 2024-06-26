<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/report/show', 'ReportController@isShowReport');
Route::get('/report/record', 'ReportController@recordUserReportShow');
Route::get('/report/update', 'ReportController@isShowUpdateReportPage');
Route::put('/report', 'ReportController@update');
Route::delete('/report', 'ReportController@destroy');
Route::resource('login', 'LoginController');
Route::resource('register', 'UserRegisterController');
Route::resource('home', 'HomeController');
Route::resource('mail', 'MailController');
Route::resource('report', 'ReportController');
Route::get('/session', 'SessionController@sessionCheck');
Route::get('/logout', 'SessionController@isLogout');
