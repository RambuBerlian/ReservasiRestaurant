<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PesananMakananController;
use App\Http\Controllers\API\DetailReservasiController;

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

// Endpoint login (tanpa autentikasi)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint yang hanya bisa diakses jika sudah login (dengan Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('detail-reservasi', DetailReservasiController::class);
    Route::apiResource('pesanan-makanan', PesananMakananController::class);

    // Mendapatkan user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
