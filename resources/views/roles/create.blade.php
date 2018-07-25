@extends('layouts.app')
@section('title','Nuevo Rol')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-3">
                <h3>{{ __('Nuevo Registro') }}</h3>
            </div>
            <div class="col-lg-6 offset-lg-3 col-sm-12 shadow py-3">
                <form action="{{ route('RoleStore') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Nombre del nuevo rol') }}</label>
                        <input type="text" class="form-control  text-capitalize" name="name" pattern="[A-Za-z]{3,}" 
                        title="Mínimo tres letras, sin caracteres especiales, sin especios" required>
                    </div>
                    <p>{{ __('Seleccione los permisos que tendrá el nuevo rol :') }}</p>
                    <div class="text-center">
                        <div class="form-check form-check-inline py-3">
                            <input class="form-check-input" type="checkbox" name="crear">
                            <label class="form-check-label" for="crear">{{ __('Crear') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="ver">
                            <label class="form-check-label" for="ver">{{ __('Ver') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="editar">
                            <label class="form-check-label" for="editar">{{ __('Editar') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="eliminar">
                            <label class="form-check-label" for="eliminar">{{ __('Eliminar') }}</label>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-outline-success">{{ __('Registrar') }}</button>
                        <a href="{{ route('Roles') }}" class="btn btn-outline-danger">{{ __('Cancelar') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection