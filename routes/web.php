<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipatesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

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

    Route::get('/dashboard', [ParticipatesController::class, 'dashboard'])->name('dashboard');

    // Participation Routes (CRUD)
    Route::get('/participate/{id}/edit', [ParticipatesController::class, 'edit'])->name('participate.edit'); // Show edit form
    Route::put('/participate/update/{id}', [ParticipatesController::class, 'update'])->name('participate.update'); // Handle update
    Route::delete('/participate/{id}', [ParticipatesController::class, 'destroy'])->name('participate.delete'); // Handle delete
});
Route::post('/participate', [ParticipatesController::class, 'store'])->name('participate.store');
// Participation Routes
Route::get('/participate', [ParticipatesController::class, 'index'])->name('participate.form'); // Show participation form
Route::post('/participate', [ParticipatesController::class, 'store'])->name('participate.store'); // Handle form submission

// Thank You Page
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks'); // Thank You page

// Google Calendar Integration Routes
Route::get('/google/redirect', [ParticipatesController::class, 'redirectToGoogle'])->name('google.redirect'); // Redirect to Google OAuth
Route::get('/google/callback', [ParticipatesController::class, 'handleGoogleCallback'])->name('google.callback'); // Google OAuth callback
Route::get('/add-to-google-calendar', [ParticipatesController::class, 'addEventToGoogleCalendar'])->name('google.addEvent');

// Reminder Emails
Route::post('/send-reminder', [ParticipatesController::class, 'sendReminder'])->name('send.reminder');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.read');