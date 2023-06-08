<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SliderController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//edit tugas ke 23 menjadi tugas 24
// Route::get('/', [LandingController::class, 'index'])->name('landing');

// Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('isLogin');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::middleware('auth')->group(function() {
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //Admin
    Route::middleware('role:Admin')->group(function(){

        // Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('slider.index'); // route untuk menampilkan data awal
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create'); // route untuk menampilkan form create
        Route::post('/slider', [SliderController::class, 'store'])->name('slider.store'); // route untuk menyimpan data
        Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit'); // route untuk menampilkan form edit
        Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update'); // route untuk mengupdate data
        Route::delete('/slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy'); // route untuk menghapus data
    });

    //Staff dan Admin
    Route::middleware('role:Admin|Staff')->group(function(){

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });


    //Staff, Admin, dan Customer
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

    Route::middleware('role:Admin|Staff')->group(function(){

        // Produk
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    });

    //Admin
    Route::middleware('role:Admin')->group(function(){

        // User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        // Role
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });
});