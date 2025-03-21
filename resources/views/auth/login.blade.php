{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <h1>Inicio de sesión</h1>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Campo Usuario --}}
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required>
        @error('nombre_usuario')
            <p class="error">{{ $message }}</p>
        @enderror
        <br>

        {{-- Campo Contraseña --}}
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror
        <br>

        {{-- Checkbox Recordarme --}}
        <label>
            <input type="checkbox" name="recordar" value="on" {{ request()->cookie('nombre_usuario') ? 'checked' : '' }}>
            Recordarme
        </label><br>

        {{-- Mostrar reCAPTCHA después de tres intentos fallidos --}}
        @if (session('login_attempts', 0) >= 3)
            <div class="g-recaptcha" data-sitekey="6LdQLocqAAAAAGP8fTS5d1kbSY3f-KjAQRQOMTIp"></div>
        @endif

        {{-- Botones --}}
        <button type="submit">Iniciar Sesión</button>
        <button type="button" onclick="location.href='{{ url('/') }}'">Atrás</button>

        {{-- Mostrar errores generales --}}
        @if(session('errors'))
            @foreach (session('errors')->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif

        {{-- Inicio de sesión con GitHub --}}
        <h3>Inicia sesión con:</h3>
        <button type="button" onclick="location.href='{{ route('github.auth') }}'">
            <i class="fab fa-github"></i>
        </button>
    </form>
@endsection
