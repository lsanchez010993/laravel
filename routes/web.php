<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\GithubAuthController;
use App\Http\Controllers\Auth\PasswordChangeController;

// Ruta principal
Route::get('/', [AnimalController::class, 'index'])->name('animales.index');

// Rutas de CRUD de Animales
Route::get('/animales/create', [AnimalController::class, 'create'])->name('animales.create');
Route::post('/animales', [AnimalController::class, 'store'])->name('animales.store');
Route::delete('animales/{id}', [AnimalController::class, 'destroy'])->name('animales.destroy');
Route::get('animales/{id}/edit', [AnimalController::class, 'edit'])->name('animales.edit');
Route::put('animales/{id}', [AnimalController::class, 'update'])->name('animales.update');

// Rutas GitHub Login
Route::get('/auth/github', [GithubAuthController::class, 'redirect'])->name('github.auth');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback']);

// Rutas Login / Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas para Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Rutas para recuperación de contraseña por token
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rutas para cambiar la contraseña de un usuario autenticado (NO confundir con reset)
Route::get('/password/change', [PasswordChangeController::class, 'showChangeForm'])->name('password.change');
Route::post('/password/change', [PasswordChangeController::class, 'updatePassword'])->name('password.change.update');

// Ruta para buscar animales (AJAX)
Route::get('/buscar/animal', [AnimalController::class, 'buscar'])->name('animal.buscar');
