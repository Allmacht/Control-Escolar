@extends('layouts.app')
@section('title', $campus->name)
@section('content')

    <div class="container">
        <div class="row">

            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('Campus') }}">{{ __('Planteles') }}</a></li>
                    <li class="breadcrumb-item">{{ $campus->name }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4">
                <h3>{{ $campus->name }}</h3>
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
                                    <b>{{ __('Clave') }}</b>
                                </td>
                                <td>
                                    {{ $campus->card_id }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('Nombre') }}</b>
                                </td>
                                <td>
                                    {{ $campus->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('País') }}</b>
                                </td>
                                <td>
                                    {{ $campus->country }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('Estado') }}</b>
                                </td>
                                <td>
                                    {{ $campus->state }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('Municipio') }}</b>
                                </td>
                                <td>
                                    {{ $campus->municipality }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('Calle') }}</b>
                                </td>
                                <td>
                                    {{ $campus->street }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>{{ __('Número exterior') }}</b>
                                </td>
                                <td>
                                    {{ $campus->external_number }}
                                </td>
                            </tr>
                            @if ($campus->internal_number != null)
                                <tr>
                                    <td>
                                        <b>{{ __('Número interior') }}</b>
                                    </td>
                                    <td>
                                        {{ $campus->internal_number }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Código postal') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $campus->zipcode }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Teléfono local') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $campus->local_phone }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>
                                        {{ __('Tipo de plantel') }}
                                    </b>
                                </td>
                                <td>
                                    {{ $campus->type }}
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <b>
                                        {{ __('Administrador') }}
                                    </b>
                                </td>
                                <td>
                                    <a href="{{ route('ProfileUser',['id'=>$campus->user->id]) }}" class="btn btn-outline-secondary"
                                        data-toggle="tooltip" data-placement="right" @if ($campus->user->id == Auth::user()->id)
                                            title="Mi perfil"
                                        @else
                                            title="Ver perfil"
                                        @endif>
                                        @if ($campus->user->profile_picture != null)
                                            <img class="rounded-circle align-middle" src="{{ asset('images/profile_pictures/'.$campus->user->id) }}" width="30px">
                                        @else
                                            <img class="rounded-circle align-middle" src="{{ asset('images/default.png') }}" width="30px">
                                        @endif
                                        {{ $campus->user->name }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12 text-center py-4">
                
                @if (Auth::user()->hasRole('Administrador'))
                    <a href="" class="btn btn-outline-primary">
                        <span class="fas fa-edit"></span>
                        {{ __('Editar') }}
                    </a>
                @endif
               
                <a href="{{ route('Campus') }}" class="btn btn-outline-danger">
                    <span class="fas fa-arrow-left"></span>
                    {{ __('Regresar') }}
                </a>
            </div>
        </div>
    </div>
    
@endsection