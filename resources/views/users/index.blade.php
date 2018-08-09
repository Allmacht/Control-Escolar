@extends('layouts.app')
@section('title','Administrativos')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4">
                <h3>{{ __('Administrativos') }}</h3>
            </div>
           
            <div class="col-lg-6 col-sm-12 text-center text-lg-left">
                 @if(Auth::user()->hasRole('Administrador'))
                    <a href="{{ route('AdminCreate') }}" class="btn btn-outline-success  mb-3"><i class="fas fa-plus-circle"></i>{{ __(' Nuevo Registro') }}</a>
                    <a href="#" class="btn btn-outline-info  mb-3"><i class="fas fa-times"></i>{{ __(' Usuarios desactivados') }}</a>
                @endif
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
            <div class="col-md-12  py-2 my-2">
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
                            @forelse($users as $user)
                                @if($user->hasRole('Administrador'))
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
                                        <th class="align-middle">
                                            <a href="{{ route('ProfileUser',['id'=>$user->id]) }}" class="btn btn-outline-primary"
                                                data-toggle="tooltip" data-placement="left" title="{{ __('Perfil') }}"><i class="fas fa-user-circle"></i></a>
                                            @if($user->id == Auth::user()->id || Auth::user()->hasRole('Administrador'))
                                            <a href="{{ route('ProfileEdit',['id'=>$user->id]) }}" class="btn btn-outline-info"
                                                data-toggle="tooltip" data-placement="right" title="{{ __('Modificar') }}"><i class="fas fa-edit"></i></a>
                                            @endif
                                        </th>
                                    </tr>
                                @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{ $users->appends(['busqueda'=>$busqueda])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection