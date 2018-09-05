@extends('layouts.app')
@section('title',$degree->degree_name)
@section('content')

    <div class="container">
        <div class="row">
            
            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboad</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Degrees') }}">{{ __('Carreras') }}</a></li>
                    <li class="breadcrumb-item active">{{ $degree->degree_name }}</li>
                </ol>
            </div>
            
            <div class="col-md-12">
                <h3>{{ $degree->degree_name }}</h3>
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow">
                        <thead>
                            <th>{{ __('Columna') }}</th>
                            <th>{{ __('Valor') }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Clave') }} 
                                    </b>
                                </td>
                                <td>
                                    {{ $degree->card_id }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Nombre de la carrera') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $degree->degree_name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Número de semestres') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $degree->semesters }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Descripción') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $degree->description }}
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <b>
                                        {{ __('Coordinador') }}
                                    </b>
                                </td>
                                <td>
                                    <a href="{{ route('ProfileUser',['id'=>$degree->user->id]) }}" class="btn btn-outline-secondary" 
                                    data-toggle="tooltip" data-placement="right" 
                                    @if(Auth::user()->id == $degree->user->id) 
                                        title="Mi perfil"
                                    @else
                                        title="Ver perfil"
                                    @endif;
                                    >
                                        @if($degree->user->profile_picture != null)
                                            <img class="rounded-circle align-middle" src="{{ asset('images/profile_pictures/'.$degree->user->id) }}" width="30px">
                                        @else
                                            <img class="rounded-circle align-middle" src="{{ asset('images/default.png') }}" width="30px">
                                        @endif
                                        {{ $degree->user->names }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-md-12 text-center pt-3">
                        <a href="{{ route('DegreeEdit',['id'=>$degree->id]) }}" class="btn btn-outline-primary">
                            <span class="fas fa-edit"></span>
                            {{ __(' Editar') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>    
    </div>

@endsection