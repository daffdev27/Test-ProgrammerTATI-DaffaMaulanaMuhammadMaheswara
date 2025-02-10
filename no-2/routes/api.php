<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinsiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('provinsi', ProvinsiController::class);

Route::get('provinsi/{id}/kecamatan', [ProvinsiController::class, 'getKecamatan']);
Route::get('provinsi/{id}/kelurahan', [ProvinsiController::class, 'getKelurahan']);
