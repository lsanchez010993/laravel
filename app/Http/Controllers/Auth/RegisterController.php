<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Asegúrate de que `resources/views/auth/register.blade.php` existe
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed'
        ]);

        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Cuenta creada correctamente. Inicia sesión.');
    }
}
