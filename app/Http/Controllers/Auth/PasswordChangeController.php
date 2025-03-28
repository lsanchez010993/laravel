<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class PasswordChangeController extends Controller
{
    // 1. Mostrar el formulario de cambio de contraseña
    public function showChangeForm()
    {
        return view('auth.passwords.change'); 
       
    }

    // 2. Procesar el cambio de contraseña
    public function updatePassword(Request $request)
    {
        // Validar los campos del formulario
       
        $request->validate([
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase() // requiere mayúsculas y minúsculas
            ],
        ]);
        

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar que la contraseña actual coincida
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no coincide.']);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->new_password);
        // dd($user);
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('password.change')->with('status', '¡Contraseña actualizada con éxito!');
    }
}
