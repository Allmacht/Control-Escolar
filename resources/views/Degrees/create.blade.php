@extends('layouts.app')
@section('title','Registrar carrera')
@section('content')
        <div class="container">
            <div class="row">

                <div class="nav" aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: white;">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Degrees') }}">{{ __('Carreras') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Nuevo registro') }}</li>
                    </ol>
                </div>

                <div class="col-md-12 pb-4">
                    <h3>{{ __('Nuevo registro') }}</h3>
                </div>
                @if($errors->any())
                    <div class="col-md-6 offset-lg-3 col-sm-12 pt-1 pb-3">
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
                    </div>
                @endif
            </div>
            <form action="{{ route('DegreeStore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="card_id">{{ __('Clave') }}</label>
                                <input type="text" class="form-control" name="card_id" placeholder="Ingrese clave única" 
                                required value="{{ old('card_id') }}">
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="degree_name">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control" name="degree_name" placeholder="Ingrese nombre de carrera" 
                                required value="{{ old('degree_name') }}">
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="semesters">{{ __('Semestres') }}</label>
                                <input type="number" class="form-control" name="semesters" placeholder="Ingrese número de semestres" 
                                required value="{{ old('semesters') }}">
                            </div>
                            <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                <label for="user_id">{{ __('Coordinador') }}</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($users as $user)
                                        @if($user->hasRole('Coordinador') || $user->hasRole('Administrador'))
                                            <option @if(old('user_id') == $user->id) selected="selected" @endif value="{{ $user->id }}">{{ $user->names }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-8 col-md-6 col-sm-12">
                                <label for="description">{{ __('Descripción') }}</label>
                                <input type="text" class="form-control" name="description" placeholder="Ingrese descripción corta" value="{{ old('description') }}">
                            </div>
                        </div>

                        <div class="col-md-12 text-center py-3">
                            <button type="submit" class="btn btn-outline-success">
                                <span class="fas fa-edit"></span>
                                {{ __(' Registrar') }}
                            </button>
                            <a href="{{ route('Degrees') }}" class="btn btn-outline-danger">
                                <span class="fas fa-times"></span>
                                {{ __(' Cancelar') }}
                            </a>
                        </div>
                    </div>
                    
                </div>    
            </form>    
        </div>
@endsection