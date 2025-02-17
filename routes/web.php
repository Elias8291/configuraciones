<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
Route::middleware('no-cache')->group(function () {
    Route::get('/', function () {
        return auth()->check() ? redirect('/dashboard') : view('welcome');
    })->name('welcome');
});

Route::middleware(['auth', 'verified', 'no-cache'])->group(function () {
    Route::get('/dashboard', function () {
        return Auth::check() ? view('dashboard') : redirect()->route('login');
    })->name('dashboard');

    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

require __DIR__ . '/auth.php';
