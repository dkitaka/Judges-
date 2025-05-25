<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\ScoreboardController;

// Public scoreboard routes
Route::get('/', [ScoreboardController::class, 'index'])->name('scoreboard');
Route::get('/scoreboard/data', [ScoreboardController::class, 'getData'])->name('scoreboard.data');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/judges/create', [AdminController::class, 'create'])->name('admin.judges.create');
    Route::post('/judges', [AdminController::class, 'store'])->name('admin.judges.store');
    Route::delete('/judges/{judge}', [AdminController::class, 'destroy'])->name('admin.judges.destroy');
});

// Judge routes
Route::prefix('judges')->group(function () {
    Route::get('/{judge}', [JudgeController::class, 'index'])->name('judges.index');
    Route::get('/{judge}/score/{user}', [JudgeController::class, 'score'])->name('judges.score');
    Route::post('/{judge}/score/{user}', [JudgeController::class, 'storeScore'])->name('judges.store-score');
});
