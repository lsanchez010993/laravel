@extends('layouts.app')

@section('title', 'Menú principal')

@section('content')
    <div class="contenedor-tarjetas">
        {{-- Listado de animales --}}
        @foreach ($animales as $animal)
            <div class="tarjeta">
                <article>
                    <h2><strong>Nombre común: </strong>{{ htmlspecialchars($animal->nombre_comun) }}</h2>
                    <h3><span>Nombre científico: </span>{{ htmlspecialchars($animal->nombre_cientifico) }}</h3>
                    <p><strong>Mamífero: </strong>{{ $animal->es_mamifero ? 'Sí' : 'No' }}</p>

                    @if (!empty($animal->ruta_imagen))
                        <img src="{{ asset($animal->ruta_imagen) }}" alt="Imagen del artículo" class="tarjeta-imagen">
                    @endif
                    <h3>Descripción:</h3>
                    <p class="descripcion">{{ htmlspecialchars($animal->descripcion) }}</p>
                </article>
            </div>
        @endforeach
    </div>

    {{-- Paginación nativa de Laravel --}}
    <div class="paginacion">
        {{ $animales->appends(request()->query())->links() }}
    </div>
@endsection
