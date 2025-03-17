<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Cerrar sesión
        Auth::logout();

        // Eliminar cookies de sesión y remember me
        Cookie::queue(Cookie::forget('laravel_session'));
        Cookie::queue(Cookie::forget('remember_web_'.Auth::getDefaultDriver()));

        // Invalidar sesión
        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('animales.index');
    }
}