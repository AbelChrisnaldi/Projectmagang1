<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kegiatan', [KegiatanController::class, 'index']);
    Route::post('/kegiatan', [KegiatanController::class, 'store']);
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'update']);
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy']);
});
