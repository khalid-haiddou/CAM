<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipatesController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginRegister'])->name('login'); // Show login/register form
Route::post('/register', [AuthController::class, 'register'])->name('register'); // Handle registration
Route::post('/login', [AuthController::class, 'login'])->name('doLogin'); // Handle login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Handle logout

// Routes secured for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Participation Routes
Route::get('/participate', [ParticipatesController::class, 'index'])->name('participate.form'); // Show participation form
Route::post('/participate', [ParticipatesController::class, 'store'])->name('participate.store'); // Handle form submission

// Thank You Page
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks'); // Thank You page
