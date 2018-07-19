@extends('layouts.app')
@section('title', $scholarship->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-3">
                <h3>{{ __('Modificar información de "'.$scholarship->name.'"') }}</h3>
            </div>
            <div class="col-lg-8 col-sm-12 offset-lg-2 py-3 my-3 shadow">
                <form action="{{ route('ScholarshipUpdate',['id'=>$scholarship->id])}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Nombre') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ $scholarship->name }}" required> 
                    </div>
                     <div class="form-group">
                        <label for="description">{{ __('Descripción') }}</label>
                        <input type="text" name="description" class="form-control" value="{{ $scholarship->description }}" required> 
                    </div>
                     <div class="form-group">
                        <label for="level">{{ __('Nivel') }}</label>
                        <select name="level" class="form-control" required>
                            <option @if($scholarship->level == "Universidad") selected="selected" @endif value="Universidad">{{ __('Universidad') }}</option>
                            <option @if($scholarship->level == "Preparatoria") selected="selected" @endif value="Preparatoria">{{ __('Preparatoria') }}</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="provider">{{ __('Proveedor') }}</label>
                        <input type="text" name="provider" class="form-control" value="{{ $scholarship->provider }}" required> 
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-success">{{ __('Modificar') }}</button>
                        <a href="{{ route('Scholarships') }}" class="btn btn-outline-danger">{{ __('Cancelar') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection