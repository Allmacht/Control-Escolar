@extends('layouts.app')
@section('title', $campus->name)
@section('content')
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Campus') }}">{{ __('Planteles') }}</a></li>
                    <li class="breadcrumb-item active">{{ $campus->name }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ $campus->name }}</h3>
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

        <form action="{{ route('CampusUpdate',['id'=>$campus->id]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="card_id">{{ __('Clave') }}</label>
                            <input type="text" class="form-control" name="card_id" placeholder="Ingrese clave única"
                            value="{{ $campus->card_id }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="name">{{ __('name') }}</label>
                            <input type="text" class="form-control" name="name" placeholder="Ingrese nombre"
                            value="{{ $campus->name }}" required>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="type">{{ __('Tipo de institución') }}</label>
                            <select name="type" class="form-control">
                                <option value="Plantel" @if ($campus->type == "Plantel") selected="selected"
                                @endif>{{ __('Pantel') }}</option>

                                <option value="CAE" @if ($campus->type == "CAE") selected="selected"
                                @endif>{{ __('CAE') }}</option>
                            </select>
                        </div>

                        <div class="from-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="country">{{ __('País') }}</label>
                            <input type="text" class="form-control" name="country" placeholder="Ingrese el país"
                            value="{{ $campus->country }}" required>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="state">{{ __('Estado') }}</label>
                            <input type="text" class="form-control" name="state" placeholder="Ingrese el estado"
                            value="{{ $campus->state }}" required>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="municipality">{{ __('Municipio') }}</label>
                            <input type="text" class="form-control" name="municipality" placeholder="Ingrese el municipio"
                            value="{{ $campus->municipality }}" required>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="street">{{ __('Calle') }}</label>
                            <input type="text" class="form-control" name="street" placeholder="Ingrese la calle"
                            value="{{ $campus->street }}" required>
                        </div>

                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="external_number">{{ __('Número exterior') }}</label>
                            <input type="number" class="form-control" name="external_number" placeholder="Número exterior"
                            value="{{ $campus->external_number }}" required>
                        </div>

                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="internal_number">{{ __('Número interior') }}</label>
                            <input type="text" class="form-control" name="internal_number" placeholder="Número interior"
                            value="{{ $campus->internal_number }}" required>
                        </div>

                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="zipcode">{{ __('Código postal') }}</label>
                            <input type="number" class="form-control" name="zipcode" placeholder="Código postal"
                            value="{{ $campus->zipcode }}" required>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="local_phone">{{ __('Teléfono local') }}</label>
                            <input type="number" class="form-control" name="local_phone" placeholder="Ingrese teléfono"
                            value="{{ $campus->local_phone }}" required>
                        </div>

                        <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                            <label for="user_id">{{ __('Administrador') }}</label>
                            <select name="user_id" class="form-control">
                                @foreach ($users as $user)
                                    @if ($user->hasRole('Administrador'))
                                        <option value="{{ $user->id }}"@if ($user->id == $campus->user->id) selected="selected"
                                        @endif>{{ $user->names }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center py-4">
                    <button type="submit" class="btn btn-outline-success">
                        <span class="fas fa-edit"></span>
                        {{ __('Guardar cambios') }}
                    </button>
                    <a href="{{ route('Campus') }}" class="btn btn-outline-danger">
                        <span class="fas fa-arrow-left"></span>
                        {{ __('Atrás') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection