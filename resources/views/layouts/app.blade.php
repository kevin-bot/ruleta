<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="user" content="{{ Auth::user()->jugador }}">        
    @endauth    
    <title>Ruleta</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm"> 
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">My Ruleta</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
    
                </ul>
                <ul class="nav nav-pills">                    
                    @auth
                        <li class="nav-item "><a class="nav-link" href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Salir</a></li>
                        @if (Auth::user()->rol == 1)
                        <li class="nav-item "><a  class="nav-link" href="{{route('jugadores')}}">Registrar Jugador</a></li>    
                        @endif
                    @else                        
                        <li class="nav-item "><a  class="nav-link" href="{{route('login')}}">Login</a></li>                                                        
                    @endauth
                </ul>
            </div>
        </div>   
    </nav>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div id="app">                
        <main class="py-4">
            @yield('content')
        </main>


    </div>

</body>

</html>