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

Route::group(['middleware' => ['auth']], function () {    
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
}); 