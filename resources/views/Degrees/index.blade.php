@extends('layouts.app')
@section('title','Carreras')
@section('content')
    
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb" >
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="active">{{ __('Carreras') }}</li>
                </ol>
            </div>
            

            <div class="col-md-12 py-4">
                <h3>{{ __('Carreras') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-left">
                @if(Auth::user()->hasRole('Administrador'))
                    <a href="{{ route('DegreeCreate') }}" class="btn btn-outline-success mb-3">
                        <span class="fas fa-plus"></span>
                        {{ __(' Nuevo registro') }}
                    </a>
                    <a href="{{ route('DegreesDisabled') }}" class="btn btn-outline-info mb-3">
                        <span class="fas fa-times"></span>{{ __(' Carreras Desactivadas') }}
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

            <div class="col-lg-6 col-sm-12 offset-lg-3 py-2">
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
            </div>

            <div class="col-md-12 py-2 my-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow">
                        <thead>
                            <tr>
                                <th>{{ __('Clave') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Modalidad') }}</th>
                                <th>{{ __('Coordinador') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($degrees as $degree)
                                <tr>
                                    <th class="align-middle">{{ $degree->card_id }}</th>
                                    <th class="align-middle">{{ $degree->degree_name }}</th>
                                    <th class="align-middle">{{ $degree->mode }}</th>
                                    <th class="align-middle">
                                       
                                        <a href="{{ route('ProfileUser',['id'=>$degree->user->id]) }}" class="btn btn-outline-secondary align-middle" 
                                        data-toggle="tooltip" data-placement="left" 
                                        @if(Auth::user()->id == $degree->user->id)
                                            title="Mi Perfil"
                                        @else
                                            title="Ver perfil"
                                        @endif>
                                            @if($degree->user->profile_picture != null)
                                                <img class="rounded-circle align-middle" src="{{ asset('images/profile_pictures/'.$degree->user->id) }}" alt="" width="30px">
                                            @else
                                                <img class="rounded-circle align-middle" src="{{ asset('images/default.png') }}" alt="" width="30px">
                                            @endif
                                            {{ $degree->user->name }}
                                        </a>
                                    </th>
                                    <th class="align-middle">
                                        <span data-toggle="tooltip" data-placement="left" title="Modificar">
                                            <a href="{{ route('DegreeEdit',['id'=>$degree->id]) }}" class="btn btn-outline-primary">
                                                <span class="fas fa-edit"></span>
                                            </a>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="top" title="Ver">
                                            <a href="{{ route('DegreeShow',['id'=>$degree->id]) }}" class="btn btn-outline-warning">
                                                <span class="fas fa-eye"></span>
                                            </a>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="right" title="Desactivar">
                                            <button class="btn btn-outline-danger open-modal" data-toggle="modal" 
                                            data-target="#eliminar" data-id="{{ $degree->id }}">
                                                <span class="fas fa-times-circle"></span>
                                            </button>
                                        </span>
                                    </th>
                                </tr>   
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $degrees->appends(['busqueda'=>$busqueda])->links() }}   
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Degrees.eliminarModal')
@endsection

@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection