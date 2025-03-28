{{-- resources/views/auth/passwords/change.blade.php --}}

@extends('layouts.app')

@section('title', 'Cambiar Contraseña')

@section('content')
<div class="container">
    <h1>Cambiar contraseña</h1>

    {{-- Mensaje de éxito (si existe) --}}
    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    {{-- Mostrar errores de validación (si existen) --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('password.change.update') }}" method="POST">
        @csrf

        <div>
            <label for="current_password">Contraseña actual</label>
            <input type="password" name="current_password" id="current_password" required>
        </div>

        <div>
            <label for="new_password">Nueva contraseña</label>
            <input type="password" name="new_password" id="new_password" required>
        </div>

        <div>
            <label for="new_password_confirmation">Confirmar nueva contraseña</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
        </div>

        <button type="submit">Actualizar contraseña</button>
        <button type="button" onclick="location.href='{{ route('animales.index') }}'">Volver a inicio</button>
    </form>
</div>
@endsection
