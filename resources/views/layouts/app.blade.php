<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('icons/science.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Control Escolar')</title>

    <!-- Scripts -->
    

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" 
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            @if(Auth::check())
                <i class="fas fa-bars d-none d-lg-block "  onclick="openNav()"></i>
            @endif
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('icons/science.png') }}" alt="" width="40px">
                Control Escolar</a>
                <button type="button" class="navbar-toggler" @if(!Auth::check()) data-toggle="collapse" data-target="#navbarText" @endif aria-controls="navbatText" >
                    <span class="navbar-toggler-icon" @if(Auth::check()) onclick="openNav()"@endif></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto"></ul>
                    <div class="my-2 my-lg-0">
                    @guest
                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#login">
                            <i class="fas fa-sign-in-alt"></i>  Iniciar Sesión
                        </button>
                    @else
                        <!--<div class="dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        -->
                        
                        <a href="{{ route('ProfileUser',['id'=>Auth::id()]) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="Mi perfil">
                            <img class="rounded-circle"
                            src=@if(!Auth::user()->profile_picture == null)
                                    "/images/profile_pictures/{{ Auth::user()->id }}"
                                @else
                                     "{{ asset('images/default.png') }}"
                                @endif
                            width="30px">
                            {{ Auth::user()->name }}
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="modal fade modal-login" id="login" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="avatar text-center">
                            <img class="" src="{{ asset('icons/user.png') }}" alt="">
                        </div>
                        <h4 class="modal-title" id="modaltitle">Iniciar Sesión</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">  
                                <label for="email">Correo</label>
                                <input type="email" class="form-control" name="email" placeholder="Ingresa tu email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-success btn-block">Ingresar</button>
                                <br>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Ha olvidado su contraseña?') }}
                                </a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <div id="mySidenav" class="sidenav shadow-lg">
            <div class="user">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <img src="{{ asset('images/Material1.png') }}" alt="" width="400px">
                @if(Auth::check())
                    <img class="userIcon rounded-circle" 
                    src=@if(!Auth::user()->profile_picture == null)
                            "/images/profile_pictures/{{ Auth::user()->id }}"
                        @else
                            "{{ asset('images/default.png') }}"
                        @endif alt="" width="70px">
                    
                    <h3 class="userName text-white text-capitalize text-truncate">{{ Auth::user()->name }}</h3>
                    <p class="text-white userEmail">{{ Auth::user()->email }}</p>

                    <a id="btnPerfil" href="{{ route('ProfileUser',['id'=>Auth::id()]) }}" class="btn btn-primary btnPerfil">{{ __('Mi perfil') }}</a>

                    <a id="btnLogout" href="{{ route('logout') }}" class="btn btn-danger logout" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            </div>
            <br>
            <!-- ELEMENTOS DEL MENU -->

            <div class="list-group list-group-flush items" id="items">
                <a href="{{ url('/') }}" class="list-group-item list-group-item-action">{{ __('Inicio') }}</a>
                <a href="{{ route('Scholarships') }}" class="list-group-item list-group-item-action">{{ __('Becas') }}</a>
            </div>
            
            <!-- FIN ELEMENTOS DEL MENU -->
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    @if($errors->any())
                        <div class="col-lg-6 offset-lg-3 col-md-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ( $errors->all() as $error )
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @yield('content')
        </main>
    </div>
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "320px";
            
            setTimeout(mostrar, 200);
        }
        function mostrar(){
            document.getElementById("btnLogout").style.visibility = "visible";
            document.getElementById("btnPerfil").style.visibility = "visible";
            document.getElementById("items").style.visibility = "visible";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("btnLogout").style.visibility = "hidden";
            document.getElementById("btnPerfil").style.visibility = "hidden";
            document.getElementById("items").style.visibility = "hidden";
        }
    </script>
</body>
</html>
