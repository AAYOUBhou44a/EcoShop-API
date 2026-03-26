<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
| Ces routes ne sont accessibles que si l'utilisateur n'est PAS connecté.
| On utilise 'throttle:5,1' pour bloquer les tentatives de brute-force (5 essais/min).
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    
    // Inscription (Register)
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->middleware('throttle:10,1');

    // Connexion (Login)
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');

});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Déconnexion (Logout)
    // Note : On utilise POST pour la sécurité (prévention CSRF)
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

});