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
Route::get('welcome', 'App\Http\Controllers\WelcomeController@welcome');
Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->middleware('auth')->group(function(){
Route::view('','dashboard.admin');
Route::resource('posts','App\Http\Controllers\PostController');
Route::resource('categories','App\Http\Controllers\CategoryController');
Route::resource('users','App\Http\Controllers\UserController');
Route::resource('roles','App\Http\Controllers\RoleController');
});

Auth::routes(['verify'=>true]);

Route::match(['get','post'],'/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
