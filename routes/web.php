<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'],function(){
    Route::get('/login',[AdminController::class,'login']);
    Route::post('/post-login', [AdminController::class,'postLogin']);
    Route::get('/register',[AdminController::class,'register']);
    Route::post('/register',[AdminController::class,'postRegister']);
    Route::group(['middleware' => 'auth.admin'] ,function(){
        Route::get('/dashboard',[AdminController::class,'dashboard']);
    });
});

Route::group(['prefix' => 'user'],function(){
    Route::get('/login', [UserController::class,'login']);
    Route::post('/post-login', [UserController::class,'postLogin'])->name('user-login.post');
    Route::get('/register',[UserController::class,'register']);
    Route::post('/register',[UserController::class,'postRegister']);
});
