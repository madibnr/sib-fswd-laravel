<?php

use App\Http\Controllers\API\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('produk')->group(function() {
    Route::get('', [ProdukController::class, 'index']);
    Route::get('/{id}', [ProdukController::class, 'show']);
    Route::post('', [ProdukController::class, 'store']);
    Route::put('/{id}', [ProdukController::class, 'update']);
    Route::delete('/{id}', [ProdukController::class, 'destroy']);
});