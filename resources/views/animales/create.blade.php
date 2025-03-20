
@extends('layouts.app')
{{-- @include('components.banner') --}}
@section('content')
    <h1>Crear Animal</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('animales.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmarCreacion();">
        @csrf

        <label for="nombre_comun">Nombre Común:</label>
        <input type="text" name="nombre_comun" id="nombre_comun" value="{{ old('nombre_comun') }}">
        <br><br>

        <label for="nombre_cientifico">Nombre Científico:</label>
        <input type="text" name="nombre_cientifico" id="nombre_cientifico" value="{{ old('nombre_cientifico') }}">
        <br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
        <br><br>

        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
        <br><br>

        <label>
            <input type="radio" name="es_mamifero" value="1" @checked(old('es_mamifero') === '1')>
            Mamífero
        </label>
        <label>
            <input type="radio" name="es_mamifero" value="0" @checked(old('es_mamifero') === '0')>
            Ovípero
        </label>
        <br><br>

        <button type="submit">Crear Animal</button>
        <button type="button" onclick="location.href='{{ route('animales.index') }}'">Atrás</button>
    </form>

    <script>
        function confirmarCreacion() {
            return confirm("¿Estás seguro de que deseas crear este animal?");
        }
    </script>
@endsection
