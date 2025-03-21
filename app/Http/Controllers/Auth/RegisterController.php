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
        // Validar la contraseña con los requisitos específicos
        $request->validate([
            'nombre_usuario' => 'required|string|unique:usuarios|max:255',
            'email' => 'required|email|unique:usuarios|max:255',
            'password' => [
                'required',
                'string',
                'min:8', // Mínimo 8 caracteres
                'confirmed', // Debe coincidir con 'password_confirmation'
                'regex:/[0-9]/', // Debe contener al menos un número
                'regex:/[a-z]/', // Debe contener al menos una letra minúscula
                'regex:/[A-Z]/', // Debe contener al menos una letra mayúscula
            ],
        ], [
            // Mensajes de error personalizados
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número.',
        ]);
    
        // Crear el usuario
        $usuario = User::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashear la contraseña
        ]);
    
        return redirect()->route('login')->with('success', 'Cuenta creada correctamente. Inicia sesión.');
    }
    
}
