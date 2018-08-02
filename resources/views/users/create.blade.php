@extends('layouts.app')
@section('title','Registro de Personal')
@section('content')
    <style>
        hr{
            border: 0.5px solid #565656;      
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 py-3">
                <h3>{{ __('Registro de personal Administrativo') }}</h3>
                <hr>
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
        <form action="{{ route('AdminStore') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="names">{{ __('Nombre(s)') }}</label>
                            <input type="text" class="form-control" name="names" placeholder="Ingrese nombre(s)" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="paternal_surname">{{ __('Apellido paterno') }}</label>
                            <input type="text" class="form-control" name="paternal_surname" placeholder="Ingrese el apellido paterno" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="maternal_surname">{{ __('Apellido materno') }}</label>
                            <input type="text" class="form-control" name="maternal_surname" placeholder="Ingrese el apellido materno" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="gender">{{ __('Género') }}</label>
                            <select name="gender" class="form-control">
                                <option value="Masculino">{{ __('Masculino') }}</option>
                                <option value="Femenino">{{ __('Femenino') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="birthdate">{{ __('Fecha de nacimiento') }}</label>
                            <input type="date" class="form-control" name="birthdate" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="curp">{{ __('CURP') }}</label>
                            <input type="text" class="form-control" name="curp" placeholder="Ingrese curp" pattern="[A-Za-z0-9]{18}" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="state">{{ __('Estado') }}</label>
                            <input type="text" class="form-control" name="state" placeholder="Ingrese estado" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="municipality">{{ __('Municipio') }}</label>
                            <input type="text" class="form-control" name="municipality" placeholder="Ingrese municipio" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="colony">{{ __('Colonia / Fraccionamiento') }}</label>
                            <input type="text" name="colony" class="form-control" placeholder="Ingrese Colonia / Fraccionamiento" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="street">{{ __('Calle') }}</label>
                            <input type="text" name="street" class="form-control" placeholder="Ingrese calle" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="external_number">{{ __('Número exterior') }}</label>
                            <input type="number" name="external_number" class="form-control" placeholder="Número exterior" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="internal_number">{{ __('Número interior') }}</label>
                            <input type="text" name="internal_number" class="form-control" placeholder="Número interior">
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="zipcode">{{ __('Código postal') }}</label>
                            <input type="number" name="zipcode" class="form-control" placeholder="Código postal" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="cellphone">{{ __('Celular') }}</label>
                            <input type="number" name="cellphone" class="form-control" placeholder="Teléfono celular" pattern="[0-9]{10}" required>
                        </div>
                        <div class="form-group col-lg-2 col-md-6 col-sm-12 mb-3">
                            <label for="local_phone">{{ __('Teléfono local') }}</label>
                            <input type="number" name="local_phone" class="form-control" pattern="[0-9]{7,}" placeholder="Teléfono local">
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="contact_name">{{ __('En caso de emergencia llamar a :') }}</label>
                            <input type="text" name="contact_name" class="form-control" placeholder="Ingrese nombre del contacto" required>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="contact_number">{{ __('Al número :') }}</label>
                            <input type="number" name="contact_number" class="form-control" pattern="[0-9]{7,}" placeholder="Ingrese número del contacto" required>
                        </div>
                        <div class="form-group col-lg-1 col-md-6 col-sm-12 mb-3">
                            <label for="allergy">{{ __('Alergia(s)') }}</label>
                            <select name="allergy" class="form-control" required>
                                <option value="1">{{ __('Si') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-11 col-md-12 col-sm-12 mb-3">
                            <label for="allergy_description">{{ __('Descripción de alergia(s)') }}</label>
                            <input type="text" name="allergy_description" class="form-control" placeholder="Descripción de alergia(s) en caso de existir">
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-12 mb-3">
                            <label for="controlled_medication">{{ __('Medicamento(s)') }}</label>
                            <select name="controlled_medication" class="form-control" required>
                                <option value="1">{{ __('Si') }}</option>
                                <option value="0">{{ __('No') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-10 col-md-9 col-sm-12 mb-3">
                            <label for="medication_description">{{ __('Descripción de medicamento(s)') }}</label>
                            <input type="text" name="medication_description" class="form-control" placeholder="Descripción de medicamento(s) en caso de existir"> 
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="professional_license">{{ __('Cédula profesional (opcional)') }}</label>
                            <input type="text" name="professional_license" class="form-control" placeholder="Ingrese número de cédula">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="rfc">{{ __('RFC') }}</label>
                            <input type="text" name="rfc" class="form-control" placeholder="Ingrese RFC" pattern="[A-Za-z0-9]{12,13}">
                        </div>
                        <div class="col-12">
                            <hr>
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12 py-3">
                            <h3>{{ __('Administración') }}</h3>
                        </div>
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="nip">{{ __('NIP') }}</label>
                            <input type="number" class="form-control" readonly value="{{ $nip }}" name="nip" required>
                            <small>{{ __('NIP generado automáticamente') }}</small>
                        </div>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12 mb-3">
                            <label for="card_id">{{ __('identificación (opcional)') }}</label>
                            <input type="text" class="form-control" placeholder="Identificación única" name="card_id">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="name">{{ __('Nombre de usuario') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese nombre de usuario" required pattern="[A-Za-z]{3,}">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="email">{{ __('Correo electrónico') }}</label>
                            <input type="email" name="email" class="form-control" placeholder="Ingrese correo electrónico" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Contraseña temporal" required>
                            <small class="ml-4">
                                <input name="mostrar" type="checkbox" class="form-check-input" id="mostrar" onchange="
                                    document.getElementById('password').type = this.checked ? 'text':'password'
                                ">
                                <label for="mostrar">{{ __('Mostrar contraseña') }}</label>
                            </small>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label for="role">{{ __('Rol') }}</label>
                            <select name="role" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-12 py-4 text-center">
                    <button type="submit" class="btn btn-block btn-outline-success">{{ __('Registrar') }}</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="perfil">
        <div class="modal-dialog" role="document" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Agregar fotografía') }}</h5>
                    <button class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="get">
                    <div class="modal-body">
                       <div class="form-group">
                           <label for="profile_picture">{{ __('Selecciona una fotografía') }}</label>
                           <input type="file" class="form-control-file" name="profile_picture" required>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-outline-success">{{ __('Aceptar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection