@extends('layouts.app')
@section('title','Nuevo registros')
@section('content')
    
    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Students') }}">{{ __('Estudiantes') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Nuevo registro') }}</li>
                </ol>
            </div>

        </div>
    </div>

@endsection