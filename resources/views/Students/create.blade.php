@extends('layouts.app')
@section('title','Nuevo registro')
@section('content')
    
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Students') }}">{{ __('Estudiantes') }}</a></li>
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
        <form action="{{ route('StudentCreate') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-row">

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="names">{{ __('Nombre(s)') }}</label>
                            <input type="text" class="form-control" name="names" 
                            placeholder="Ingrese nombres de Estudiante" value="{{ old('names') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="paternal_surname">{{ __('Apellido paterno') }}</label>
                            <input type="text" class="form-control" name="paternal_surname"
                            placeholder="Ingrese apellido paterno" value="{{ old('paternal_surname') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="maternal_surname">{{ __('Apellido materno') }}</label>
                            <input type="text" class="form-control" name="maternal_surname"
                            placeholder="Ingrese apellido materno" value="{{ old('maternal_surname') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="gender">{{ __('Género') }}</label>
                            <select name="gender" class="form-control">
                                <option value="Masculino">{{ __('Masculino') }}</option>
                                <option value="Femenino">{{ __('Femenino') }}</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="birthdate">{{ __('Fecha de nacimiento') }}</label>
                            <input type="date" class="form-control" name="birthdate" 
                            value="{{ old('birthdate') }}" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="curp">{{ __('CURP') }}</label>
                            <input type="text" class="form-control" name="curp"
                            placeholder="Ingrese CURP" value="{{ old('curp') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="state">{{ __('Estado') }}</label>
                            <input type="text" class="form-control" name="state"
                            placeholder="Ingrese el estado" value="{{ old('state') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="municipality">{{ __('Municipio') }}</label>
                            <input type="text" class="form-control" name="municipality"
                            placeholder="Ingrese el municipio" value="{{ old('municipality') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="colony">{{ __('Colonia') }}</label>
                            <input type="text" class="form-control" name="colony"
                            placeholder="Ingrese colonia o fraccionamiento" value="{{ old('colony') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="street">{{ __('Calle') }}</label>
                            <input type="text" class="form-control" name="street"
                            placeholder="Ingrese la calle" value="{{ old('street') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="external_number">{{ __('Número exterior') }}</label>
                            <input type="number" class="form-control" name="external_number"
                            placeholder="Número exterior" value="{{ old('external_number') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="internal_number">{{ __('Número interior') }}</label>
                            <input type="number" class="form-control" name="internal_number"
                            placeholder="Número interior" value="{{ old('internal_number') }}">
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="zipcode">{{ __('Código postal') }}</label>
                            <input type="number" class="form-control" name="zipcode"
                            placeholder="Código postal" value="{{ old('zipcode') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="cellphone">{{ __('Celular') }}</label>
                            <input type="number" class="form-control" name="cellphone"
                            placeholder="Teléfono celular" value="{{ old('cellphone') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="local_phone">{{ __('Teléfono local') }}</label>
                            <input type="number" class="form-control" name="local_phone"
                            placeholder="Teléfono local" value="{{ old('local_phone') }}">
                        </div>

                        <div class="col-lg-5 col-md-6 col-sm-12 mb-3">
                            <label for="contact_name">{{ __('Contacto') }}</label>
                            <input type="text" class="form-control" name="contact_name"
                            placeholder="En caso de emergencia llamar a..." value="{{ old('contact_name') }}" required>
                        </div>

                        <div class="col-lg-5 col-md-6 col-sm-12 mb-3">
                            <label for="contact_number">{{ __('Teléfono del contacto') }}</label>
                            <input type="number" class="form-control" name="contact_number"
                            placeholder="Al número..." value="{{ old('contact_number') }}" required>
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="allergy">{{ __('Alergias') }}</label>
                            <select name="allergy" class="form-control">
                                <option value="1">{{ __('Si') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>

                        <div class="col-lg-10 col-md-6 col-sm-12 mb-3">
                            <label for="allergy_description">{{ __('Descripción de alergia(s)') }}</label>
                            <input type="text" class="form-control" name="allergy_description"
                            placeholder="Ingrese la descripción de la(s) alergia(s)" value="{{ old('allergy_description') }}">
                        </div>

                        <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="controlled_medication">{{ __('Medicamento controlado') }}</label>
                            <select name="controlled_medication" class="form-control">
                                <option value="1">{{ __('Si') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>

                        <div class="col-lg-10 col-md-6 col-sm-12 mb-3">
                            <label for="medication_description">{{ __('Descripción de medicamento(s)') }}</label>
                            <input type="text" class="form-control" name="medication_description"
                            placeholder="Descripción de los medicamentos controlados" value="{{ old('medication_description') }}">
                        </div>

                        <div class="div col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="degree_id">{{ __('Carrera') }}</label>
                            <select name="degree_id" class="form-control">
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree->id }}">{{ $degree->degree_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="scholarship_id">{{ __('Beca') }}</label>
                            <select name="scholarship_id" class="form-control">
                                <option value="0">{{ __('Sin beca') }}</option>
                                @foreach ($scholarships as $scholarship)
                                    <option value="{{ $scholarship->id }}">{{ $scholarship->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="name">{{ __('Nombre de usuario') }}</label>
                            <input type="text" class="form-control" name="name"
                            placeholder="Ingrese nombre de usuario" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="email">{{ __('Correo electrónico') }}</label>
                            <input type="email" class="form-control" name="email"
                            placeholder="Ingrese correo electrónico" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input type="password" id="password" class="form-control" name="password"
                            placeholder="Ingrese contraseña de usuario" required>
                            <small class="ml-4">
                                <input name="mostrar" type="checkbox" class="form-check-input" id="mostrar" onchange="
                                    document.getElementById('password').type = this.checked ? 'text':'password'
                                ">
                                <label for="mostrar">{{ __('Mostrar contraseña') }}</label>
                            </small>
                        </div>

                    </div>
                </div>
                <div class="col-md-12 text-center mb-5">
                    <button class="btn btn-outline-success" type="submit">
                        <span class="fas fa-edit"></span>
                        {{ __('Registrar') }}
                    </button>
                    <a href="{{ route('Students') }}" class="btn btn-outline-danger">
                        <span class="fas fa-times"></span>
                        {{ __(' Cancelar') }}
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection