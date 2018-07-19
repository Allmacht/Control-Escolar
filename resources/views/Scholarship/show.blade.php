@extends('layouts.app')
@section('title', $scholarship->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4">
                <h3>{{ __('Información de "'.$scholarship->name.'"') }}</h3>
            </div>
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="table-responsive">
                    <table class="table shadow">
                        <thead>
                            <th>{{ __('Columna') }}</th>
                            <th>{{ __('Valor') }}</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b><i>{{ __('Nombre de Beca') }}</i></b>
                                </td>
                                <td>
                                   {{ $scholarship->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b><i>{{ __('Decripción') }}</i></b>
                                </td>
                                <td>
                                    {{ $scholarship->description }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b><i>{{ __('Nivel') }}</i></b>
                                </td>
                                <td>
                                    {{ $scholarship->level }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b><i>{{ __('Proveedor') }}</i></b>
                                </td>
                                <td>
                                    {{ $scholarship->provider }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-8 offset-lg-2 col-sm-12 text-center py-2">
                    <a href="{{ route('ScholarshipEdit',['id'=>$scholarship->id]) }}" class="btn btn-outline-primary">{{ __('Modificar') }}</a>
                    <a href="{{ route('Scholarships') }}" class="btn btn-outline-danger">{{ __('Regresar') }}</a>
                </div>        
            </div>
        </div>
    </div>
@endsection