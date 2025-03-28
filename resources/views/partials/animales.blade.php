@if($animales->count())
<br>
<p><h1>Resultados de busqueda:</p></h1>
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
    
                        {{-- Mostrar botones de Editar y Eliminar solo si el usuario está autenticado y es el propietario --}}
                        @if (Auth::check() && $animal->usuario_id == Auth::id())
                            <div class="acciones">
                                {{-- Botón Editar --}}
                                <form action="{{ route('animales.edit', $animal->id) }}" method="GET" style="display:inline-block;">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </form>
    
                                {{-- Botón Eliminar --}}
                                <form action="{{ route('animales.destroy', $animal->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este animal?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </article>
                </div>
            @endforeach
        </div>
    
@else
<br>
    <p><h1>No se encontraron resultados.</p></h1>
@endif
