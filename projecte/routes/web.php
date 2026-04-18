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

// 1. Rutes públiques (Per a Guests i Users)
// Tothom pot veure el llistat de jocs i el detall d'un joc.
Route::resource('games', GameController::class)->only(['index', 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 2. Rutes protegides (Només usuaris que han fet login)
Route::middleware('auth')->group(function () {
    // Rutes del perfil de Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutes per gestionar la col·lecció personal de l'usuari (Afegir/Editar/Eliminar de la llista)
    Route::resource('collection', CollectionController::class)->except(['show']);
});

// 3. Rutes d'Administrador (Protegides pel Gate 'is_admin')
Route::middleware(['auth', 'can:is_admin'])->group(function () {
    Route::resource('developers', DeveloperController::class);
    Route::resource('users', UserController::class);
    // L'Admin té accés a la resta de mètodes dels jocs (create, store, edit, update, destroy)
    Route::resource('games', GameController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';