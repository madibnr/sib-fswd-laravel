<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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
    return view('landing'); 
});

// Tugas 22
// Route::get('/crud', [UserController::class, 'index']);
// Route::get('/crud.add', [UserController::class, 'add']);
// Route::get('/crud.edit', [UserController::class, 'edit']);

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');