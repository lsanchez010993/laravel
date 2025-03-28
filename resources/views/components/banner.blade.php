<header class="banner">
    <link rel="stylesheet" href="{{ asset('css/header.menu.css') }}">
    


    @if(Auth::check())
     
            <!-- Mensaje de Bienvenida (no administración) -->
            <div class="submenu">
                <span class="nombre_usuario">Bienvenido: {{ Auth::user()->nombre_usuario }}</span>
            </div>
       
    @endif

   
   
        <div>
            <div class="search-bar" action="" method="GET" onsubmit="return false;">
                <input type="text" name="nombre_comun" placeholder="Buscar animal..." autocomplete="on">
            </div>
        </div>
       

    <div class="menu menu-right">
        {{-- <div id="resultat"></div> --}}
        @if(!isset($resultadosBusqueda))
            <!-- Menú principal -->
            <button class="menu-toggle">
                {{ Auth::check() ? 'Menú' : 'No has iniciado sesión' }}
            </button>
            <div class="menu-content">
                @if(!Auth::check())
                    <!-- Opciones si la sesión no está iniciada -->
                    <button onclick="location.href='{{ route('login') }}'">Iniciar Sesión</button>
                    <button onclick="location.href='{{ route('register') }}'">Registrarse</button>
                    <button onclick="location.href='{{ route('password.request') }}'">Recuperar Contraseña</button>
                @else
                    @if(Auth::user()->nombre_usuario === 'admin')
                        <!-- Submenú de administración (si el usuario es admin) -->
                        {{-- <div class="submenu">
                            <button class="submenu-toggle">Administrar</button>
                            <div class="submenu-content">
                                <button onclick="location.href='{{ route('admin.usuarios') }}'">Administrar Usuarios</button>
                                <button onclick="location.href='{{ route('admin.animales') }}'">Administrar Animales</button>
                            </div>
                            <button onclick="location.href='{{ route('animales.pendientes') }}'">Aprobar animales</button>
                        </div> --}}
                    @endif

                    <!-- Opciones si la sesión está iniciada -->
                  

                    <button onclick="location.href='{{ route('animales.create') }}'">Insertar Nuevo Artículo</button>
                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    
                    <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </button>
                    
                    <button onclick="location.href='{{ route('password.change') }}'">Cambiar Password</button>
                @endif
            </div>
        @endif
    </div>
</header>
