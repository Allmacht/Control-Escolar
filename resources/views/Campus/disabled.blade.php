@extends('layouts.app')
@section('title','Planteles desactivados')
@section('content')

    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Campus') }}">{{ __('Planteles') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Planteles desactivados') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ __('Planteles desactivados') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 offset-lg-6 text-lg-right">
                <form action="" method="get">
                    <div class="input-group my-1">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value="{{ $busqueda }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">{{ __('Buscar') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            @if(session('status'))
                <div class="col-lg-6 col-sm-12 offset-lg-3 py-2 align-middle">
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12 py-2 my-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow">
                        <thead>
                            <tr>
                                <th>{{ __('Clave') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Teléfono') }}</th>
                                <th>{{ __('Administrador') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                                <tr>
                                    <th class="align-middle">
                                        {{ $office->card_id }}
                                    </th>
                                    <th class="align-middle">
                                        {{ $office->name }}
                                    </th>
                                    <th class="align-middle">
                                        {{ $office->local_phone }}
                                    </th>
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

                                       <span data-toggle="tooltip" data-placement="left" title="Activar">
                                            <button class="btn btn-outline-success open-modal" data-toggle="modal" data-target="#activar" 
                                            data-id="{{ $office->id }}">
                                                <span class="fas fa-edit"></span>
                                            </button>
                                       </span>

                                       <span data-toggle="tooltip" data-placement="right" title="Eliminar">
                                           <button class="btn btn-outline-danger open-modal" data-toggle="modal" data-target="#eliminar"
                                           data-id="{{ $office->id }}">
                                                <span class="fas fa-times"></span>
                                           </button>
                                       </span>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    
    @include('Campus/ModalActivar')
    @include('Campus/ModalDelete')
    
@endsection
@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection