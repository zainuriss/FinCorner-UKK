<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [FilmController::class, 'landingPage'])->name('landing-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/detail-film-{id}', [FilmController::class, 'show'])->name('films.show');
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('films')->name('films.')->group(function () {
        Route::get('/', [FilmController::class, 'index'])->name('index');
        Route::get('/create', [FilmController::class, 'create'])->name('create');
        Route::post('/', [FilmController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FilmController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [FilmController::class, 'update'])->name('update');
        Route::delete('/{id}', [FilmController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [FilmController::class, 'restore'])->name('restore');
        Route::get('/trash', [FilmController::class, 'trash'])->name('trash');
    });    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
