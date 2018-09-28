@extends('layouts.app')
@section('title','Nuevo registro')
@section('content')
    
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Campus') }}">{{ __('Planteles') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Nuevo Registro') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
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

         <form action="{{ route('CampusStore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label for="card_id">{{ __('Clave') }}</label>
                                <input type="text" class="form-control" name="card_id" value="{{ old('card_id') }}"
                                placeholder="Ingrese clave única" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label for="name">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Ingrese el nombre" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                                <label for="type">{{ __('Tipo de institución') }}</label>
                                <select name="type" class="form-control" required>
                                    <option value="{{ __('Plantel') }}">{{ __('Plantel') }}</option>
                                    <option value="{{ __('CAE') }}">{{ __('CAE') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="country">{{ __('País') }}</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country') }}"
                                placeholder="Ingrese el país" required>
                            </div>
                            
                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="state">{{ __('Estado') }}</label>
                                <input type="text" class="form-control" name="state" value="{{ old('state') }}"
                                placeholder="Ingrese el estado" required>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="municipality">{{ __('Municipio') }}</label>
                                <input type="text" class="form-control" name="municipality" value="{{ old('municipality') }}"
                                placeholder="Ingrese el municipio" required>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="street">{{ __('Calle') }}</label>
                                <input type="text" class="form-control" name="street" value="{{ old('street') }}"
                                placeholder="Ingrese la calle">
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                                <label for="external_number">{{ __('Número exterior') }}</label>
                                <input type="number" class="form-control" name="external_number" value="{{ old('external_number') }}"
                                placeholder="Número exterior" required>
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                                <label for="internal_number">{{ __('Número interior') }}</label>
                                <input type="text" class="form-control" name="internal_number" value="{{ old('internal_number') }}"
                                placeholder="Número interior">
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                                <label for="zipcode">{{ __('Código postal') }}</label>
                                <input type="number" class="form-control" name="zipcode" value="{{ old('zipcode') }}"
                                placeholder="Código postal" required>
                            </div>
                            
                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="local_phone">{{ __('Teléfono') }}</label>
                                <input type="number" class="form-control" name="local_phone" value="{{ old('local_phone') }}"
                                placeholder="Ingrese teléfono" required>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-12 mb-3">
                                <label for="user_id">{{ __('Administrador') }}</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($users as $user)
                                            @if ($user->hasRole('Administrador'))
                                                <option value="{{ $user->id }}">{{ $user->names }}</option>
                                            @endif
                                        @endforeach
                                    </select>   
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 pt-4 text-center">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="fas fa-edit"></span>
                            {{ __('Registrar') }}
                        </button>
                        <a href="{{ route('Campus') }}" class="btn btn-outline-danger">
                            <span class="fas fa-times"></span>
                            {{ __('Cancelar') }}
                        </a>
                    </div>
                </div>
            </form>
    </div>

@endsection