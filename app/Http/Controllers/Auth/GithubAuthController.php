<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class GithubAuthController extends Controller
{
    public function redirect()
    {
        // Redirige al usuario a GitHub para autenticación
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        // GitHub redirige a esta ruta con los datos de autenticación
        $githubUser = Socialite::driver('github')->user();

        // Verifica si el usuario ya existe, si no, lo crea
        $user = User::updateOrCreate([
            'email' => $githubUser->getEmail(),
        ], [
            'nombre_usuario' => $githubUser->getNickname() ?? $githubUser->getName(),
            'password' => bcrypt(str()->random(12)), // Genera una contraseña aleatoria
        ]);

        // Inicia sesión con el usuario
        Auth::login($user);

        return redirect()->route('animales.index'); // O donde quieras redirigir
    }
}
