@extends('layouts.app')

@section('title', 'Modificar Animal')

@section('content')
    <h1>Modificar Animal</h1>

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

    {{-- Formulario para actualizar el animal --}}
    <form action="{{ route('animales.update', $animal->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmarModificacion();">
        @csrf
        @method('PUT')

        <label for="nombre_comun">Nombre Común:</label>
        <input type="text" name="nombre_comun" id="nombre_comun" value="{{ old('nombre_comun', $animal->nombre_comun) }}">
        <br><br>

        <label for="nombre_cientifico">Nombre Científico:</label>
        <input type="text" name="nombre_cientifico" id="nombre_cientifico" value="{{ old('nombre_cientifico', $animal->nombre_cientifico) }}">
        <br><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion">{{ old('descripcion', $animal->descripcion) }}</textarea>
        <br><br>

        <label for="imagen">Selecciona una imagen (opcional):</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
        <br>
        @if($animal->ruta_imagen)
            <img src="{{ asset($animal->ruta_imagen) }}" alt="Imagen del animal" style="max-width: 200px;">
        @endif
        <br><br>

        <label>
            <input type="radio" name="es_mamifero" value="1" @checked(old('es_mamifero', $animal->es_mamifero) == 1)>
            Mamífero
        </label>
        <label>
            <input type="radio" name="es_mamifero" value="0" @checked(old('es_mamifero', $animal->es_mamifero) == 0)>
            Ovípero
        </label>
        <br><br>

        <button type="submit">Actualizar Animal</button>
        <button type="button" onclick="location.href='{{ route('animales.index') }}'">Atrás</button>
    </form>

    <script>
        function confirmarModificacion() {
            return confirm("¿Estás seguro de que deseas modificar este animal?");
        }
    </script>
@endsection
