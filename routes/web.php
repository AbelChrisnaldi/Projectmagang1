<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC (TIDAK PERLU LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])
    ->middleware('guest')
    ->name('home');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard (CRUD)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/dashboard', [DashboardController::class, 'store'])
        ->name('kegiatan.store');

    Route::delete('/dashboard/{kegiatan}', [DashboardController::class, 'destroy'])
        ->name('kegiatan.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
