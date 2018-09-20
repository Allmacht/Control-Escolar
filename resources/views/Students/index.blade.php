@extends('layouts.app')
@section('title','Estudiantes')
@section('content')
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ __('Estudiantes') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ __('Estudiantes') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-center text-lg-left">
                @if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Coordinador'))
                    <a href="{{ route('StudentsCreate') }}" class="btn btn-outline-success mb-3">
                        <span class="fas fa-plus"></span>
                        {{ __(' Nuevo registro') }}
                    </a>
                    <a href="" class="btn btn-outline-info mb-3">
                        <span class="fas fa-times"></span>
                        {{ __('Estudiantes desactivados') }}
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

            <div class="ol-md-12 py-2 my-2 table-responsive">
                <table class="table table-hover shadow">
                    <thead>
                        <tr>
                            <th>{{ __('Matrícula') }}</th>
                            <th>{{ __('Nombres') }}</th>
                            <th>{{ __('Apellidos') }}</th>
                            <th>{{ __('Carrera') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            @if($student->hasRole('Alumno'))
                                <tr>
                                    <th class="align-middle">{{ $student->card_id }}</th>
                                    <th class="align-middle">{{ $student->names }}</th>
                                    <th class="align-middle">{{ $student->paternal_surname." ".$student->maternal_surname }}</th>
                                    <th class="align-middle">{{ $student->Degree->degree_name }}</th>
                                    <th class="align-middle">
                                        
                                    </th>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection