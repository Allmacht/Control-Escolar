@extends('layouts.app')
@section('title','Becas')
@section('content')

    <!--CONTENIDO -->

    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4">
                <h3>{{ __('Control de Becas') }}</h3>
            </div>
            <div class="col-lg-6 col-sm-12 text-center text-lg-left">
                <a href="#" class="btn btn-outline-success mb-3"><i class="fas fa-plus-circle"></i> Nuevo Registro</a>
                <a href="#" class="btn btn-outline-info mb-3"><i class="fas fa-times"></i> Becas eliminadas</a>
            </div>
            <div class="col-lg-6 col-sm-12 text-center text-lg-right">
               <form action="" method="get">
                   <div class="input-group mb-3">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar.." value="{{ $busqueda }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">{{ __('Buscar') }}</button>
                        </div>
                    </div>
               </form>
            </div> 
            <div class="col-md-12 py-2">
                <div class="table-responsive">
                    <table class="table  table-hover shadow">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Nombre de Beca') }}</th>
                                <th scope="col">{{ __('Descripción') }}</th>
                                <th scope="col">{{ __('Acciones Disponibles') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scholarships as $scholarship)
                                <tr>
                                    <th>{{ $scholarship->name }}</th>
                                    <th>{{ $scholarship->description }}</th>
                                    <th>
                                        <a href="#" class="btn btn-outline-primary" 
                                            data-toggle="tooltip" data-placement="left" title="{{ __('Modificar') }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-outline-warning" 
                                            data-toggle="tooltip" data-placement="top" title="{{ __('Ver') }}"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-outline-danger" 
                                            data-toggle="tooltip" data-placement="right" title="{{ __('Eliminar') }}"><i class="fas fa-times"></i></a>
                                    </th>
                                </tr>
                            @empty
                                <h3>{{ __('No existen Becas registradas') }}</h3>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $scholarships->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN DE CONTENIDO -->
@endsection