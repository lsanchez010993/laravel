<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // Validación automática con LoginRequest
        $credentials = $request->validated();

        // Obtener intentos de sesión
        $login_attempts = session()->get('login_attempts', 0);

        // Validar ReCAPTCHA si hay 3 intentos fallidos
        if ($login_attempts >= 3) {
            if (!$request->filled('g-recaptcha-response')) {
                return back()->withErrors(['Por favor, completa el reCAPTCHA.'])->withInput();
            }

            $recaptcha_secret = '6LdQLocqAAAAAHFW4ZpczXoarU5AE5JoR5mfnJPd';
            $recaptcha_response = $request->input('g-recaptcha-response');
            $recaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
            $recaptcha = json_decode($recaptcha);

            if (!$recaptcha->success) {
                return back()->withErrors(['La verificación de reCAPTCHA ha fallado. Inténtalo de nuevo.'])->withInput();
            }
        }

        // Intentar iniciar sesión con Auth::attempt()
        if (Auth::attempt(['nombre_usuario' => $credentials['nombre_usuario'], 'password' => $credentials['password']], $request->filled('recordar'))) {
            session()->put('login_attempts', 0);

            // Si el usuario marcó "Recordar sesión"
            if ($request->input('recordar') === 'on') {
                $token = bin2hex(random_bytes(32));
                almacenarTokenEnBD($credentials['nombre_usuario'], $token);

                return redirect('/')
                    ->withCookie(cookie('token', $token, 30 * 24 * 60))
                    ->withCookie(cookie('nombre_usuario', $credentials['nombre_usuario'], 30 * 24 * 60));
            }

            return redirect('/');
        }

        // Si las credenciales son incorrectas, incrementa intentos fallidos
        session()->put('login_attempts', $login_attempts + 1);
        return back()->withErrors(['Credenciales inválidas.'])->withInput();
    }
}
