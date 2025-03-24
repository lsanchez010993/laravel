<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class GithubAuthController extends Controller
{
    public function redirect()
    {
        // Redirige al usuario a GitHub para autenticación
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
    
        // Buscar el usuario por email
        $user = User::where('email', $githubUser->getEmail())->first();
    
        if (!$user) {
            
            $user = User::create([
                'nombre_usuario' => $githubUser->getNickname(), // O getName()
                'email'          => $githubUser->getEmail(),
                'provider'       => 'github',                    // Indica el proveedor
                'provider_id'    => $githubUser->getId(),          // ID único del usuario en GitHub
                'password'       => bcrypt(Str::random(16)),
            ]);
        } else {
            // Si el usuario ya existe, actualizamos sus datos del proveedor
            $user->update([
                'nombre_usuario' => $githubUser->getNickname(),
                'provider'       => 'github',
                'provider_id'    => $githubUser->getId(),
            ]);
        }
    
        Auth::login($user);
        return redirect('/');
    }
    
    
}
