<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

if (! function_exists('almacenarTokenEnBD')) {
    /**
     * Actualiza el token de sesión para un usuario en la base de datos.
     *
     * @param string $nombre_usuario
     * @param string $token
     * @return void
     */
    function almacenarTokenEnBD($nombre_usuario, $token)
    {
        DB::table('usuarios')
            ->where('nombre_usuario', $nombre_usuario)
            ->update(['token' => $token]);
    }
}

if (! function_exists('verificarTokenSesion')) {
    /**
     * Verifica el token de sesión guardado en la cookie 'remember_me'.
     * Si el token es válido, se guarda el nombre de usuario en la sesión.
     *
     * @return bool
     */
    function verificarTokenSesion()
    {
        if (Cookie::has('remember_me')) {
            $token = Cookie::get('remember_me');
            
            $usuario = DB::table('usuarios')
                ->where('token', $token)
                ->first();

            if ($usuario) {
                Session::put('nombre_usuario', $usuario->nombre_usuario);
                return true;
            } else {
                // Si el token no es válido, eliminamos la cookie
                Cookie::queue(Cookie::forget('remember_me'));
            }
        }
        return false;
    }
}

if (! function_exists('cerrarSesion')) {
    /**
     * Cierra la sesión del usuario: limpia el token en la base de datos,
     * elimina la cookie y destruye la sesión.
     *
     * @return void
     */
    function cerrarSesion()
    {
        $nombre_usuario = Session::get('nombre_usuario');
        if ($nombre_usuario) {
            DB::table('usuarios')
                ->where('nombre_usuario', $nombre_usuario)
                ->update(['token' => null]);
        }
        
        // Eliminar la cookie 'remember_me'
        Cookie::queue(Cookie::forget('remember_me'));
        // Limpiar toda la sesión
        Session::flush();
    }
}
