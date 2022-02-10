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

Route::get('/',[App\Http\Controllers\Auth\LoginController::class,'showLoginForm']);

Route::resource('/test', App\Http\Controllers\TestController::class);

Route::resource('/image-upload', App\Http\Controllers\ImageUploadController::class);

Route::resource('/profile', App\Http\Controllers\ProfileController::class);
Route::put('profile_details_update/{id}',  [ App\Http\Controllers\ProfileController::class, 'updateDetails'])->name('profile.details_update');

Route::resource('/collections', App\Http\Controllers\CategoryWiseCollectionController::class);
Route::get('/collections-chart', [App\Http\Controllers\CategoryWiseCollectionController::class, 'chart'])->name('collections.chart');

Route::get('/insert', function () {
    $stuRef = app('firebase.firestore')->database()->collection('students')->newDocument();
    $stuRef->set([
        'firstname' => 'sgu',
        'lastname' => 'hsg'
    ]);
});

Route::resource('/students', App\Http\Controllers\StudentController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);
Route::resource('/event_datas', App\Http\Controllers\EventDataController::class);
Route::resource('/admin', App\Http\Controllers\AdminController::class);
Route::resource('/user-ranking', App\Http\Controllers\UserRankingController::class);
Route::resource('/location-bases-collection', App\Http\Controllers\LocationBasedCollectionController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify');

Route::post('login/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleCallback');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);
