@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="container">
    <h1>Recuperar Contraseña</h1>

    {{-- Mensaje de confirmación si se envió el enlace --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Ingresa tu correo electrónico:</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enviar enlace de recuperación</button>
    </form>

    <p>
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </p>
</div>
@endsection
