@extends('layouts.app')
@section('title','Carreras')
@section('content')
    
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboad</a></li>
                    <li class="breadcrumb-item active" aria-current="active">{{ __('Carreras') }}</li>
                </ol>
            </div>
            

            <div class="col-md-12 py-4">
                <h3>{{ __('Carreras') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-left">
                @if(Auth::user()->hasRole('Administrador'))
                    <a href="#" class="btn btn-outline-success mb-3"><span class="fas fa-plus"></span>{{ __(' Nuevo registro') }}</a>
                    <a href="#" class="btn btn-outline-info mb-3"><span class="fas fa-times"></span>{{ __(' Carreras Desactivadas') }}</a>
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
                                <th>{{ __('Semestres') }}</th>
                                <th>{{ __('Coordinador') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($degrees as $degree)
                                <tr>
                                    <th class="align-middle">{{ $degree->card_id }}</th>
                                    <th class="align-middle">{{ $degree->degree_name }}</th>
                                    <th class="align-middle">{{ $degree->semesters }}</th>
                                    <th class="align-middle">{{ $degree->user->name }}</th>
                                    <th class="align-middle">
                                        <span data-toggle="tooltip" data-placement="left" title="Modificar">
                                            <a href="" class="btn btn-outline-primary">
                                                <span class="fas fa-edit"></span>
                                            </a>
                                        </span>

                                    </th>
                                </tr>   
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection