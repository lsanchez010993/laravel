<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\GithubAuthController;







// Ruta para mostrar el formulario (con token)
// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
//      ->name('password.reset');

// // Ruta para procesar el formulario
// Route::post('password/reset', [ResetPasswordController::class, 'reset'])
//      ->name('password.update');


Route::get('/', [AnimalController::class, 'index'])->name('animales.index');



Route::get('/animales/create', [AnimalController::class, 'create'])->name('animales.create');
Route::post('/animales', [AnimalController::class, 'store'])->name('animales.store');


Route::get('/auth/github', [GithubAuthController::class, 'redirect'])->name('github.auth');
Route::get('/auth/github/callback', [GithubAuthController::class, 'callback']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);



Route::delete('animales/{id}', [AnimalController::class, 'destroy'])->name('animales.destroy');


// Ruta para mostrar el formulario de edición de un animal
Route::get('animales/{id}/edit', [AnimalController::class, 'edit'])->name('animales.edit');

// Ruta para actualizar el animal
Route::put('animales/{id}', [AnimalController::class, 'update'])->name('animales.update');




// 1. Formulario para solicitar enlace de recuperación
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

// 2. Enviar el enlace de recuperación por email
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// 3. Formulario para restablecer la contraseña (con token)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// 4. Procesar el restablecimiento de contraseña
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');



?>
