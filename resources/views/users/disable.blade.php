@extends('layouts.app')
@section('title','Administrativos desactivados')
@section('content')

    <div class="container">
        <div class="row">
            <div class="nav" aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color:white;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('administrativos') }}">{{ __('Administrativos') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Administrativos desactivados') }}</li>
                </ol>
            </div>

            <div class="col-md-12 py-4 text-center text-lg-left">
                <h3>{{ __('Administrativos desactivados') }}</h3>
            </div>

            <div class="col-lg-6 col-md-12 text-center text-lg-left pb-3">
                <a href="{{ route('administrativos') }}" class="btn btn-outline-success"><i class="fas fa-chevron-left"></i>{{ __(' Administrativos') }}</a>
            </div>

            <div class="col-lg-6 col-sm-12 text-center text-lg-right">
                <form action="" method="get">
                    <div class="input-group my-1">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value="{{ $busqueda }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary">{{ __('Buscar') }}</button>
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
            
            <div class="col-md-12 my-2">
                <div class="table-responsive">
                    <table class="table table-hover shadow"> 
                        <thead>
                            <tr>
                                <th>{{ __('Perfil') }}</th>
                                <th>{{ __('Nombre(s)') }}</th>
                                <th>{{ __('Usuario') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Rol') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if($user->hasRole('Administrador') || $user->hasRole('Coordinador'))
                                    <tr>
                                        @if($user->profile_picture != null)
                                            <th>
                                                <img class="rounded-circle" src="/images/profile_pictures/{{ $user->profile_picture }}" alt="" width="40px">
                                            </th>
                                        @else
                                            <th>
                                                <img class="rounded-circle" src="/images/default.png" alt="" width="40px">
                                            </th>
                                        @endif
                                        <th class="align-middle">{{ $user->names }}</th>
                                        <th class="align-middle">{{ $user->name }}</th>
                                        <th class="align-middle">{{ $user->email }}</th>
                                        <th class="align-middle">
                                            @foreach ($user->getRoleNames() as $role)
                                                {{ $role }}
                                            @endforeach
                                        </th>
                                        <th>
                                            <span data-toggle="tooltip" data-placement="left" title="Reactivar">
                                                <button class="btn btn-outline-success open-modal" data-toggle="modal" data-target="#reactivar" data-id="{{ $user->id }}">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </span>
                                            <span data-toggle="tooltip" data-placement="right" title="Eliminar">
                                                <button class="btn btn-outline-danger open-modal" data-id="{{ $user->id }}" data-toggle="modal" data-target="#eliminar">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </span>
                                        </th>
                                    </tr>
                                @endif
                                
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $users->appends(['busqueda'=>$busqueda])->links() }}
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <div class="modal fade" id="reactivar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Reactivar usuario') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('¿Realmente desea reactivar el usuario?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                    <form action="{{ route('AdminReactive') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-outline-success">{{ __('Reactivar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Eliminar usuario') }}</h5>
                    <button type="button" data-dismiss="modal" class="close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('¿Realmente desea eliminar el usuario?, Esta acción es irreversible') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger">{{ __('Cancelar') }}</button>
                    <form action="{{ route('AdminDestroy') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-outline-success">{{ __('Eliminar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/modalDatos.js') }}"></script>
@endsection

