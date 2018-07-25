@extends('layouts.app')
@section('title','Modificar rol')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-3">
                <h3>{{ __('Modificar rol') }}</h3>
            </div>
            <div class="col-lg-6 offset-lg-3 col-sm-12 shadow py-3">
                <form action="{{ route('RoleUpdate',['id'=>$role->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Nombre del rol') }}</label>
                        <input type="text" class="form-control" name="name" 
                        pattern="[A-Za-z]{3,}" title="Mínimo 3 letras, sin números ni espacios" value="{{ $role->name }}" required>
                    </div>
                    <p>{{ __('Permisos del rol :') }}</p>
                    <div class="text-center">
                        <div class="form-check form-check-inline py-3">
                            <input class="form-check-input" type="checkbox" name="crear" 
                            id="crear" @if($role->hasPermissionTo('Crear')) checked @endif>
                            <label class="form-check-label" for="crear">{{ __('Crear') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="ver" 
                            id="ver" @if($role->hasPermissionTo('Ver')) checked @endif>
                            <label class="form-check-label" for="ver">{{ __('Ver') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="editar" 
                            id="editar" @if($role->hasPermissionTo('Editar')) checked @endif>
                            <label class="form-check-label" for="editar">{{ __('Editar') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="eliminar" 
                            id="eliminar" @if($role->hasPermissionTo('Eliminar')) checked @endif>
                            <label class="form-check-label" for="eliminar">{{ __('Eliminar') }}</label>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="btn btn-outline-success">{{ __('Modificar') }}</button>
                        <a href="{{ route('Roles') }}" class="btn btn-outline-danger">{{ __('Cancelar') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection