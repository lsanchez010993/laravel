<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
    /**
     * Muestra el formulario para restablecer contraseña (con el token).
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Procesa el formulario para restablecer la contraseña.
     */
    public function reset(Request $request)
    {
        // Valida los campos
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Actualiza la contraseña
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        // Verifica la respuesta de Password::reset()
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Si falla, retorna con error
        return back()->withErrors(['email' => [trans($status)]]);
    }
}
