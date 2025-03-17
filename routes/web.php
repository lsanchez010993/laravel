<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\GithubAuthController;



Route::get('/animales', [AnimalController::class, 'index'])->name('animales.index');



Route::get('/animales/create', [AnimalController::class, 'create'])->name('animales.create');
Route::post('/animales', [AnimalController::class, 'store'])->name('animales.store');


Route::get('/auth/github', [GithubAuthController::class, 'redirect'])->name('github.auth');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



?>
