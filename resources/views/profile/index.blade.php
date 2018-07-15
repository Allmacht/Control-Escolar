@extends('layouts.app')
@section('title', $User->name)
@section('content')
    <style>
        
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-xs-12 col-sm-12 pb-5">
                <div class="card mx-auto shadow" style="width: 15rem;">
                    <img class="card-img-top img-responsive" src="{{ asset('images/persona1.jpg') }}" >
                    <div class="card-body text-center">
                        <button class="btn btn-outline-success">{{ __('Cambiar imagen') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-xs-12 col-sm-12 shadow">
                <div class="col-md-12 my-3">
                    <h4 class="text-center">{{ __('Perfil') }}</h4>
                    <hr>
                </div>
                <div class="col-lg-8 col-md-12 col-xs-12 offset-lg-2">
                    <div class="form-group">
                        <label for="name">{{ __('Nombre') }}</label>
                        <input type="text" readonly class="form-control" name="name" value="{{ $User->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="text" readonly class="form-control" name="email" value="{{ $User->email }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection