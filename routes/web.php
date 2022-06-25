<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\fieldController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\scheduleController;

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
    return view('page.login.login');
})->middleware('guest');

Route::get('/signup', function () {
    return view('page.login.signup');
 });


Route::post('/login', [loginController::class , 'authenticate']);
Route::post('/register', [signupController::class , 'register']);
Route::post('/logout', [loginController::class , 'logout']);

Route::get('/homepage', [homeController::class, 'index']);
Route::get('/news', [homeController::class, 'newsView']);
Route::get('/about_us', [homeController::class, 'aboutusView']);
Route::get('/newsHome', [homeController::class, 'newsHomeView']);
Route::get('/maps', [homeController::class, 'mapView']);


Route::get('/field/create', [fieldController::class, 'create']);
Route::post('/field/store', [fieldController::class, 'store']);

Route::post('/owner/create', [fieldController::class, 'ownerCreate']);
Route::get('/owner/order', [fieldController::class, 'orderList']);
Route::get('/owner/field/view', [fieldController::class, 'ownerView']);
Route::get('/owner', [fieldController::class, 'owner']);
Route::post('/create/type', [fieldController::class, 'createType']);

Route::post('/schedule/create/{id}', [fieldController::class, 'createSchedule']); // not use
Route::get('/field/schedule', [scheduleController::class, 'index']);
Route::post('/schedule/update/{type}', [scheduleController::class, 'update']);

Route::get('/admin/approval', [adminController::class, 'approval']);
Route::post('/admin/approve/{id}', [adminController::class, 'approve']);
Route::post('/admin/reject/{id}', [adminController::class, 'reject']);
Route::get('/admin/news', [adminController::class, 'news']);
Route::post('/admin/news/upload', [adminController::class, 'newsUpload']);

Route::get('/field/list', [bookController::class, 'listField']);
Route::get('/field/book/detail', [bookController::class, 'book']);
Route::get('/fieldsTo/{id}', [bookController::class, 'fieldsTo']);
Route::get('/fieldsTo/book/order', [bookController::class, 'index']);
Route::get('/fieldsTo/book/pay', [bookController::class, 'payment']);
Route::post('/fieldsTo/send/order/{id}', [bookController::class, 'sendOrder']);
// Route::post('/fieldsTo/send/order/check/{id}', [bookController::class, 'checkOrder']);

Route::get('/fieldsTo/order/list', [bookController::class, 'orderList']);

Route::get('/forgot_password', function () {
    return view('forgotpasswordemail');
 });

 Route::get('/forgotpasswordcode', function () {
    return view('forgotpasswordcode');
 });

 Route::get('/forgotpassword', function () {
   return view('forgotpassword');
});

Route::get('/aboutus', function () {
   return view('aboutus');
});

// Route::get('/news', function () {
//    return view('news');
// });

// Route::get('/maps', function () {
//    return view('maps');
// });

// Route::get('/schedule', function () {
//     return view('schedule');
//  });

Route::get('/linkstorage', function () {
   Artisan::call('storage:link');
});

