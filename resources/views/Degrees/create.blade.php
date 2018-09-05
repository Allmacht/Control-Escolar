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

                <div class="col-md-12">
                    <h3>{{ __('Nuevo registro') }}</h3>
                </div>
                
            </div>    
        </div>
@endsection