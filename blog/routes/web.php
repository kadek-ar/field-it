<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
 });

 
Route::get('/login', function () {
    return view('login');
 });

Route::get('/forgot_password', function () {
    return view('forgotpasswordemail');
 });

 Route::get('/forgotpasswordcode', function () {
    return view('forgotpasswordcode');
 });

 Route::get('/homepage', function () {
    return view('homepage');
 });

 Route::get('/forgotpassword', function () {
   return view('forgotpassword');
});

Route::get('/aboutus', function () {
   return view('aboutus');
});

Route::get('/news', function () {
   return view('news');
});

Route::get('/maps', function () {
   return view('maps');
});