<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ParticularController;
use App\Http\Controllers\ColaboratorsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RepairController;


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
}); 