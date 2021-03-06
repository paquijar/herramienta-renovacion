<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Herramienta Renovación de tecnologías
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/black-dashboard.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">




</head>

<body>
    <div id="app">
        @if(!empty($msg))
        <div class="alert alert-danger"> {{ $msg }}</div>
        @endif
        @if (session('msg'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
        @endif
        <nav class="navbar navbar-expand-md navbar-light bg-info shadow-sm fixed-top">
            <a class="navbar-brand align-text-center" style="font-size: large;" href="{{ url('/') }}">
                <strong>Herramienta Renovación de tecnologías</strong>
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif --}}
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="row">
                                <div class="col text-right">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="col text-left">
                                    <span class="caret"></span>
                                </div>

                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>

        </nav>

        <main class="">
            <div class="d-flex" id="wrapper">
                <!-- Sidebar -->
                <div class="bg-dark" id="sidebar-wrapper">
                    <div class="sidebar-heading text-secondary"><strong>MENÚ</strong> </div>
                    <div class="list-group list-group-flush">
                        <!-- <a href="/categoria" class="list-group-item list-group-item-action bg-light">Categoría</a>
                        <a href="/subcategoria" class="list-group-item list-group-item-action bg-light">Subcategorías</a>
                        <a href="/variable" class="list-group-item list-group-item-action bg-light">Variables</a>
                        <a href="/propuesta" class="list-group-item list-group-item-action bg-light">Propuestas</a> -->
                        <a href="{{ route('registerSuper') }}" class="list-group-item list-group-item-action bg-dark text-secondary"><span class="material-icons">account_circle</span> Crear Usuario</a>
                        <a href="/hospital/create" class="list-group-item list-group-item-action bg-dark text-secondary"><span class="material-icons">local_hospital</span> Crear Institución de Salud</a>
                    </div>
                </div>
                <div id="page-content-wrapper-admin">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                'placement': 'top'
            });
        });
    </script>
</body>

</html>
