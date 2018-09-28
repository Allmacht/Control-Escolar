@extends('layouts.app')
@section('title',$degree->degree_name)
@section('content')

    <div class="container">
        <div class="row">
            
            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Degrees') }}">{{ __('Carreras') }}</a></li>
                    <li class="breadcrumb-item active">{{ $degree->degree_name }}</li>
                </ol>
            </div>
            
            <div class="col-md-12 pb-3">
                <h3>{{'Modificar  - '. $degree->degree_name }}</h3>
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
        <form action="{{ route('DegreeUpdate',['id'=>$degree->id]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="card_id">{{ __('Clave') }}</label>
                            <input type="text" class="form-control" name="card_id" placeholder="Ingrese clave única" 
                            value="{{ $degree->card_id }}" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="rvoe">{{ __('R.V.O.E.') }}</label>
                            <input type="text" class="form-control" name="rvoe" placeholder="Ingrese RVOE"
                            value="{{ $degree->rvoe }}" required> 
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="degree_name">{{ __('Nombre') }}</label>
                            <input type="text" name="degree_name" class="form-control" placeholder="Ingrese nombre de la carrera" 
                            value="{{ $degree->degree_name }}" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="semesters">{{ __('Semestres') }}</label>
                            <input type="number" name="semesters" class="form-control" placeholder="N. de semestres"
                            value="{{ $degree->semesters }}" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="user_id">{{ __('Coordinador') }}</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    @if($user->hasRole('Administrador') || $user->hasRole('Coordinador'))
                                        <option @if($user->id == $degree->user_id) selected="selected" @endif value="{{ $user->id }}">{{ $user->names }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="mode">{{ __('Modalidad') }}</label>
                            <select name="mode" class="form-control">
                                <option value="Escolarizada" @if($degree->mode == "Escolarizada") selected="selected" @endif>
                                    {{ __('Escolarizada') }}
                                </option>
                                <option value="Mixta" @if($degree->mode == "Mixta") selected="selected" @endif>
                                    {{ __('No escolarizada') }}
                                </option>
                                <option value="TSU" @if($degree->mode == "TSU") selected="selected" @endif>
                                    {{ __('TSU') }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="office_id">{{ __('Plantel') }}</label>
                            <select name="office_id" class="form-control">
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}"
                                    @if($office->id == $degree->office_id)
                                        selected = "selected"
                                    @endif
                                        >{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-6 col-sm-12 mb-3">
                            <label for="description">{{ __('Descripción') }}</label>
                            <input type="text" name="description" class="form-control" placeholder="Ingrese una descripción breve"
                            value="{{ $degree->description }}">
                        </div>
                    </div>
                    <div class="col-md-12 text-center pt-4">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="fas fa-edit"></span>
                            {{ __(' Guardar cambios') }}
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