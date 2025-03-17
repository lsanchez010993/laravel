<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menú principal</title>
    {{-- Estilos: puedes moverlos a public/css o usar @vite --}}


    <link rel="stylesheet" href="{{ asset('css/vistaAnimals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mostrarAnimales.css') }}">
    <script src="{{ asset('js/ajax.js') }}"></script>


</head>

<body>

    @include('components.banner')

    @if (Auth::check())
        <p>Usuario autenticado: {{ Auth::user()->nombre_usuario }}</p>
    @else
        <p>No hay usuario autenticado</p>
    @endif

    <div class="contenedor-tarjetas">

        {{-- Listar animales usando Blade --}}
        @foreach ($animales as $animal)
            <div class="tarjeta">
                <article>
                    <h2><strong>Nombre común: </strong>{{ htmlspecialchars($animal->nombre_comun) }}</h2>
                    <h3><span>Nombre científico: </span>{{ htmlspecialchars($animal->nombre_cientifico) }}</h3>
                    <p><strong>Mamífero: </strong>{{ $animal->es_mamifero ? 'Sí' : 'No' }}</p>

                    @if (!empty($animal->ruta_imagen))
                        <img src="{{ asset($animal->ruta_imagen) }}" alt="Imagen del artículo" class="tarjeta-imagen">
                    @endif
                    <h3>Descripcio:</h3>
                    <p class="descripcion">{{ htmlspecialchars($animal->descripcion) }}</p>
                </article>
            </div>
        @endforeach

    </div>




    {{-- Paginación nativa de Laravel --}}
    <div class="paginacion">
        {{ $animales->appends(request()->query())->links() }}
    </div>
    </div>

    {{-- Incluir tu JS (ej. ajax.js) --}}
    <script src="{{ asset('js/ajax.js') }}"></script>
</body>

</html>
