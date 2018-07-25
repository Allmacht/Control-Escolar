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
                <a href="{{ route('ScholarshipCreate') }}" class="btn btn-outline-success mb-3"><i class="fas fa-plus-circle"></i> {{ __('Nuevo Registro') }}</a>
                <a href="#" class="btn btn-outline-info mb-3"><i class="fas fa-times"></i> {{ __('Becas eliminadas') }}</a>
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
            <div class="col-lg-6 col-sm-12 offset-lg-3 py-2">
                @if(session('status'))
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
            @if($create == true)
                <div class="col-lg-6 col-sm-12 offset-lg-3 py-2 my-4 shadow">
                    <form action="{{ route('ScholarshipStore') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Beca') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="Ingrese nombre de beca" required>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Descripción') }}</label>
                            <input type="text" name="description" class="form-control" placeholder="Ingrese una descripción" required>
                        </div>
                        <div class="form-group">
                            <label for="level">{{ __('Nivel') }}</label>
                            <select name="level" class="form-control">
                                <option value="Universidad">{{ __('Universidad') }}</option>
                                <option value="Preparatoria">{{ __('Preparatoria') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="provider">{{ __('Proveedor') }}</label>
                            <input type="text" name="provider" class="form-control" placeholder="Ingrese el proveedor de Beca" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success">{{ __('Registrar') }}</button>
                            <a href="{{ route('Scholarships') }}" class="btn btn-outline-danger">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            @endif
            <div class="col-md-12 py-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Nombre de Beca') }}</th>
                                <th scope="col">{{ __('Descripción') }}</th>
                                <th scope="col">{{ __('Nivel') }}</th>
                                <th scope="col">{{ __('Acciones Disponibles') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($scholarships as $scholarship)
                                <tr>
                                    <th>{{ $scholarship->name }}</th>
                                    <th>{{ $scholarship->description }}</th>
                                    <th>{{ $scholarship->level }}</th>
                                    <th>
                                        <a href="{{ route('ScholarshipEdit',['id'=>$scholarship->id]) }}" class="btn btn-outline-primary" 
                                            data-toggle="tooltip" data-placement="left" title="{{ __('Modificar') }}"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('ScholarshipShow',['id'=>$scholarship->id]) }}" class="btn btn-outline-warning" 
                                            data-toggle="tooltip" data-placement="top" title="{{ __('Ver') }}"><i class="fas fa-eye"></i></a>
                                        <span data-toggle="tooltip" data-placement="right" title="{{ __('Eliminar') }}">
                                            <button class="btn btn-outline-danger open-modal" data-toggle="modal" 
                                                data-target="#confirm" data-id="{{ $scholarship->id }}"><i class="fas fa-times"></i></button>
                                        </span>
                                    </th>
                                </tr>
                            @empty
                                <h3 class="text-danger">{{ __('No existen Becas registradas') }}</h3>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $scholarships->appends(['busqueda'=>$busqueda])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FIN DE CONTENIDO -->

    <!--MODAL ELIMINAR -->

        <div class="modal fade" tabindex="-1" role="dialog" id="confirm">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Eliminar') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('¿Realmente desea eliminarlo(a)?') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-info" data-dismiss="modal">{{ __('Cancelar') }}</button>
                        <form action="{{ route('ScholarshipSoftdelete') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-outline-danger">{{ __('Eliminar') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- FIN DE MODAL ELIMINAR -->
@endsection

@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection