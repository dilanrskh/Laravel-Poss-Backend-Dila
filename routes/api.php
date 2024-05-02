<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

// Produk API
Route::controller(ProdukApiController::class)->group(function () {
    Route::get('/produk-api', 'indexProduk');
    Route::get('/produk-api/detail/{id}', 'detailProduk');
    Route::post('/produk-api/create', 'createProduk');
    Route::delete('/produk-api/delete/{id}', 'deleteProduk');
    Route::put('/produk-api/update/{id}', 'updateProduk');
});
