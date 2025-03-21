<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Muestra el formulario para solicitar el enlace de restablecimiento de contraseña.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Envía el enlace de restablecimiento de contraseña vía email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Valida el correo electrónico
        $request->validate([
            'email' => 'required|email'
        ]);

        // Envía el enlace de recuperación al correo indicado
        $response = Password::sendResetLink($request->only('email'));

        // Evalúa la respuesta y retorna mensajes correspondientes
        return $response === Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }
}
