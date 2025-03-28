<!DOCTYPE html>
<html>
<head>
    <title>Mi Aplicación</title>
    <link rel="stylesheet" href="{{ asset('css/header.menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vistaAnimals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mostrarAnimales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos_formulario.css') }}">
    <!-- CSS y otros -->
</head>
<body>
    @include('components.banner')
    <div id="resultat"></div>
    <div class="container">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/ajax.js') }}"></script>

</body>
</html>
