<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CastingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreRelationController;

Route::get('/', [FilmController::class, 'landingPage'])->name('landing-page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/detail-film{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/edit-film{id}', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/update-film/{id}', [FilmController::class, 'update'])->name('films.update');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('films')->name('films.')->group(function () {
        Route::get('/', [FilmController::class, 'index'])->name('index');
        Route::get('/create', [FilmController::class, 'create'])->name('create');
        Route::post('/', [FilmController::class, 'store'])->name('store');
        // Route::get('/{id}/edit', [FilmController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [FilmController::class, 'update'])->name('update');
        Route::delete('/{id}', [FilmController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [FilmController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [FilmController::class, 'restore'])->name('restore');
        Route::get('/trash', [FilmController::class, 'trash'])->name('trash');
    });  
    
    Route::prefix('genres')->name('genres.')->group(function () {
        Route::get('/', [GenreController::class, 'index'])->name('index');
        Route::get('/create', [GenreController::class, 'create'])->name('create');
        Route::post('/', [GenreController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [GenreController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GenreController::class, 'update'])->name('update');
        Route::delete('/{id}', [GenreController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [GenreController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [GenreController::class, 'restore'])->name('restore');
        Route::get('/trash', [GenreController::class, 'trash'])->name('trash');
    });  
    
    Route::prefix('genre_relations')->name('genre_relations.')->group(function () {
        Route::get('/', [GenreRelationController::class, 'index'])->name('index');
        Route::get('/create', [GenreRelationController::class, 'create'])->name('create');
        Route::post('/', [GenreRelationController::class, 'store'])->name('store');
        Route::get('/{film_id}/edit', [GenreRelationController::class, 'edit'])->name('edit');
        Route::put('/{id}', [GenreRelationController::class, 'update'])->name('update');
        Route::delete('/{id}', [GenreRelationController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [GenreRelationController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [GenreRelationController::class, 'restore'])->name('restore');
        Route::get('/trash', [GenreRelationController::class, 'trash'])->name('trash');
    });

    Route::prefix('castings')->name('castings.')->group(function () {
        Route::get('/', [CastingController::class, 'index'])->name('index');
        Route::get('/create', [CastingController::class, 'create'])->name('create');
        Route::post('/', [CastingController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CastingController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CastingController::class, 'update'])->name('update');
        Route::delete('/{id}', [CastingController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [CastingController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [CastingController::class, 'restore'])->name('restore');
        Route::get('/trash', [CastingController::class, 'trash'])->name('trash');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/', [AdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'delete'])->name('delete');
        Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [AdminController::class, 'restore'])->name('restore');
        Route::get('/trash', [AdminController::class, 'trash'])->name('trash');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
