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

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" 
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    @yield('styles')
</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            @if(Auth::check())
                <i class="fas fa-bars d-none d-lg-block " data-toggle="tooltip" data-placement="right" title="Menú" onclick="openNav()"></i>
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
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <h4 class="text-center mb-2">{{ __('Iniciar Sesión') }}</h4>
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
                        @endif 
                        
                        alt="" width="70px">
                    
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

            <div class="list-group list-group-flush items text-left" id="items">
                <a id="item" href="{{ route('home') }}" class="list-group-item list-group-item-action"><i class="fas fa-home"></i>{{ __('Inicio') }}</a>
                <a id="item1" href="{{ route('administrativos') }}" class="list-group-item list-group-item-action"><i class="fas fa-user"></i>{{ __('Administrativos') }}</a>
                @if(Auth::check())
                    @if(Auth::user()->hasRole('Administrador'))
                        <a id="item2" href="{{ route('Roles') }}" class="list-group-item list-group-item-action"><i class="fas fa-pencil-ruler"></i>{{ __('Roles') }}</a>
                        <a id="item3" href="{{ route('Scholarships') }}" class="list-group-item list-group-item-action"><i class="fas fa-certificate"></i>{{ __('Becas') }}</a>
                        <a id="item4" href="{{ route('Kardex') }}" class="list-group-item list-group-item-action"><i class="fas fa-certificate"></i>{{ __('kardex') }}</a>
                        
                    @endif
                @endif
            </div>
            
            <!-- FIN ELEMENTOS DEL MENU -->
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    @if(!Auth::check())
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
                    @endif
                </div>
            </div>
            @yield('content')
        </main>
    </div>
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/sideNav.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('scripts')

</body>
</html>
