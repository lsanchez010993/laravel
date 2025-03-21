@extends('layouts.app')

@section('title', 'Restablecer Contraseña')

@section('content')
<div class="container">
    <h1>Restablecer Contraseña</h1>

    {{-- Mostrar errores de validación --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Mensaje de éxito (si existe) --}}
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        {{-- Se incluye el token para el reset --}}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" 
                   class="form-control" 
                   value="{{ old('email') }}" 
                   required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" name="password" id="password" 
                   class="form-control" 
                   required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" 
                   id="password_confirmation" 
                   class="form-control" 
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Restablecer Contraseña
        </button>
        <button type="button" onclick="location.href='{{ route('animales.index') }}'">Atrás</button>
    </form>
</div>
@endsection
