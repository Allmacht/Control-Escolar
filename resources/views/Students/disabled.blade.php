@extends('layouts.app')
@section('title','Estudiantes Desactivados')
@section('content')

    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Students') }}">{{ __('Estudiantes') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Estudiantes desactivados') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ __('Estudiantes desactivados') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-lg-left">
                <a href="{{ route('Students') }}" class="btn btn-outline-success mb-3">
                    <i class="fas fa-chevron-left"></i>
                    {{ __('Estudiantes') }}
                </a>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 text-lg-right">
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

            <div class="col-md-12 py-2 my-2 responsive-table">
                <table class="table table-hover shadow">
                    <thead>
                        <tr>
                            <th>{{ __('Perfil') }}</th>
                            <th>{{ __('Matrícula') }}</th>
                            <th>{{ __('Nombre(s)') }}</th>
                            <th>{{ __('Apellidos') }}</th>
                            <th>{{ __('Carrera') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            @if($student->HasRole('Alumno'))
                                <tr>
                                     @if($student->profile_picture != null)
                                        <td>
                                            <img class="rounded-circle" src="/images/profile_pictures/{{ $student->profile_picture }}" alt="" width="40px">
                                        </td>
                                    @else
                                        <td>
                                            <img class="rounded-circle" src="/images/default.png" alt="" width="40px">
                                        </td>
                                    @endif
                                    <td class="align-middle">{{ $student->card_id }}</td>
                                    <td class="align-middle">{{ $student->names }}</td>
                                    <td class="align-middle">{{ $student->paternal_surname." ".$student->maternal_surname }}</td>
                                    <td class="align-middle">{{ $student->Degree->degree_name }}</td>
                                    <td class="align-middle">
                                        <span data-toggle="tooltip" data-placement="left" title="Activar">
                                            <button class="btn btn-outline-success open-modal" data-id="{{ $student->id }}" data-toggle="modal" data-target="#activar">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </span>
                                        <span data-toggle="tooltip" data-placement="right" title="Eliminar">
                                             <button class="btn btn-outline-danger open-modal" data-id="{{ $student->id }}" data-toggle="modal" data-target="#eliminar">
                                                 <i class="fa fa-times-circle"></i>
                                             </button>
                                        </span>
                                       
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12">
                    {{ $students->appends(['busqueda'=>$busqueda])->links() }}
                </div>
            </div>
        </div>
    </div>
    
    @include('Students.ModalActivate')

    @include('Students.ModalDelete')

@endsection
@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection