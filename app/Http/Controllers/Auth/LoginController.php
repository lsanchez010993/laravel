<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // La vista en resources/views/auth/login.blade.php
    }

    public function login(LoginRequest $request)
    {
        // Obtener credenciales del formulario
        $credentials = $request->only('nombre_usuario', 'password');
        $remember = $request->has('recordar'); // true si se marcó "recordar"

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials, $remember)) {
    
            $request->session()->regenerate();

        
            session(['user_id' => Auth::id()]);

        
            return redirect()->route('animales.index')
                ->withCookie(cookie('nombre_usuario', $request->input('nombre_usuario'), 30 * 24 * 60))
                ->withCookie(cookie('token', bin2hex(random_bytes(32)), 30 * 24 * 60));
        }

   
        session()->increment('login_attempts');
        return back()->withErrors(['error' => 'Credenciales inválidas'])->withInput();
    }
    public function username()
    {
        return 'nombre_usuario';
    }
}
