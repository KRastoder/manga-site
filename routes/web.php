<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-manga-form', [MangaController::class, 'createMangaForm'])->name('manga.create.form');
    Route::post('/create-manga', [MangaController::class, 'create'])->name('manga.create');

    Route::get('/my-mangas', [MangaController::class, 'myMangas'])->name('manga.my-mangas');
});

require __DIR__ . '/auth.php';
