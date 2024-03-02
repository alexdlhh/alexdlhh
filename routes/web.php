<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SDController;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/forgot', [HomeController::class, 'forgot'])->name('forgot');
Route::post('/do_login', [HomeController::class, 'do_login'])->name('do_login');
Route::post('/do_forgot', [HomeController::class, 'do_forgot'])->name('do_forgot');

Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/do_register', [HomeController::class, 'do_register'])->name('do_register');

Route::group(['middleware' => ['auth']], function () {    
    Route::get('/admin', [HomeController::class, 'dashboard'])->name('adminPanel');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::post('/txt2img', [SDController::class, 'txt2img'])->name('txt2img');
}); 