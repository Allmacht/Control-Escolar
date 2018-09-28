@extends('layouts.app')
@section('title','Planteles')
@section('content')

    <div class="container">
        <div class="row">
            
            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Planteles') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ __('Planteles') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-left">
                @if (Auth::user()->hasRole('Administrador'))
                    <a href="{{ route('CampusCreate') }}" class="btn btn-outline-success">
                        <span class="fas fa-plus"></span>
                        {{ __(' Nuevo registro') }}
                    </a>
                    <a href="{{ route('CampusDisabled') }}" class="btn btn-outline-info">
                        <span class="fas fa-times"></span>
                        {{ __('Planteles desactivados') }}
                    </a>
                @endif
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-right">
                <form action="" method="get">
                    <div class="input-group my-1">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value="{{ $busqueda }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">{{ __('Buscar') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 col-sm-12 offset-lg-3 py-2 align-middle">
                @if(session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if($errors->any())  
                    <div class="col-lg-12">
                        @foreach ( $errors->all() as $error )
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}    
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-12 py-2 my-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow">
                        <thead>
                            <tr>
                                <th>{{ __('Clave') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Télefono') }}</th>
                                <th>{{ __('Administrador') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                                <tr>
                                    <th class="align-middle">{{ $office->card_id }}</th>
                                    <th class="align-middle">{{ $office->name }}</th>
                                    <th class="align-middle">{{ $office->local_phone }}</th>
                                    <th class="align-middle">
                                        <a href="{{ route('ProfileUser',['id'=>$office->user->id]) }}" 
                                        class="btn btn-outline-secondary align-middle"
                                        data-toggle="tooltip" data-placement="left" 
                                        @if (Auth::user()->id == $office->user->id)
                                            title ="Mi perfil"
                                        @else
                                            title="Ver perfil"
                                        @endif>
                                            @if ($office->user->profile_picture != null)
                                                <img src="{{ asset('images/profile_pictures/'.$office->user->id) }}" 
                                                class="rounded-circle align-middle" width="30px">
                                            @else
                                                <img src="{{ asset('images/default.png') }}" 
                                                class="rounded-circle align-middle" width="30px">
                                            @endif
                                            {{ $office->user->name }}
                                        </a>
                                    </th>
                                    <th class="align-middle">
                                        @if (Auth::user()->hasRole('Administrador'))
                                            <span data-toggle="tooltip" data-placement="left" title="Modificar">
                                                <a href="{{ route('CampusEdit', ['id'=>$office->id]) }}" class="btn btn-outline-primary">
                                                    <span class="fas fa-edit"></span>
                                                </a>
                                            </span>
                                        @endif
                                        <span data-toggle="tooltip" data-placement="top" title="Ver">
                                            <a href="{{ route('CampusShow', ['id'=>$office->id]) }}" class="btn btn-outline-warning"> 
                                                <span class="fas fa-eye"></span>
                                            </a>
                                        </span>
                                        @if (Auth::user()->hasRole('Administrador'))
                                            <span data-toggle="tooltip" data-placement="right" title="Eliminar">
                                                <button type="button" class="btn btn-outline-danger open-modal" data-id="{{ $office->id }}"
                                                    data-toggle="modal" data-target ="#eliminar">
                                                    <span class="fas fa-times"></span>
                                                </button>
                                            </span>
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $offices->appends(['busqueda'=>$busqueda])->links() }}   
                    </div>
                </div>
            </div>
        </div>    
    </div>

    @include('Campus/ModalEliminar')

@endsection
@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection