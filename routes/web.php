<?php
use App\Http\Controllers\AuthController;

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
