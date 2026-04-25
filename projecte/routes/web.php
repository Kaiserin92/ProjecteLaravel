<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 1. Rutas de Administrador (is_admin)
Route::middleware(['auth', 'can:is_admin'])->group(function () {
    Route::resource('developers', DeveloperController::class);
    Route::resource('users', UserController::class);
    Route::resource('games', GameController::class)->except(['index', 'show']);
});

// 2. Rutas protegidas (Cualquier usuario logueado)
Route::middleware('auth')->group(function () {
    
    // El Dashboard ahora vive aquí dentro
    Route::get('/dashboard', [CollectionController::class, 'index'])
        ->middleware('verified') // Mantenemos verified por si lo usas
        ->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de Colección
    Route::post('/games/{game}/collection', [CollectionController::class, 'store'])->name('collection.store');
    Route::delete('/collection/{game}', [CollectionController::class, 'destroy'])->name('collection.destroy');
    // Cambiar estado de un juego en la colección
    Route::patch('/collection/{game}', [CollectionController::class, 'update'])->name('collection.update');
});

// 3. Rutas públicas
Route::resource('games', GameController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';