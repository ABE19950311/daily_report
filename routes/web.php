<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('login', 'LoginController');
Route::resource('register', 'UserRegisterController');
Route::resource('home', 'HomeController');
Route::get('/session', 'SessionController@sessionCheck');
Route::get('/logout', 'SessionController@isLogout');
