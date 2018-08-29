@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         <!--<div class="col-md-12">
            <div class="col-md-3 float-left shadow py-4"></div>
            <div class="col-md-8 float-right shadow py-5"></div>
            <div class="col-md-3 float-left shadow py-5 my-2"></div>
        </div>-->
        <div class="col-md-12 py-3">
            <div class="col-md-3 float-left py-4 d-none d-lg-block sticky-top" style="z-index: 2;">       
                <div class="card text-center" style="width: 15rem;">
                    @if($user->profile_picture == null)
                        <img  class="rounded card-img-top" src="{{ asset('images/default.png') }}" alt="" >
                    @else
                        <img class="rounded card-img-top" src="/images/profile_pictures/{{ $user->id }}" alt="">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title text-primary">{{ $user->name }}</h4>
                        <p class="card-text">{{ $user->email }}</p>
                        <p class="card-text">
                            @foreach ($user->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
            <div class="float-right col-lg-8 col-md-12 col-sm-12 py-3">

                <h3 class="pb-3 text-lg-left text-center">Dashboard</h3>

                <div class="alert alert-success">
                    <h4 class="alert-heading">{{ __('Administrativos') }}</h4>
                    <p>{{ __('Listado de personal administrativo') }}</p>
                    <hr>
                    <div class="text-right">
                        <a href="{{ route('administrativos') }}" class="btn btn-outline-success" 
                        data-toggle="tooltip" data-placement="right" title="Ir">
                            <i class="fas fa-arrow-alt-circle-right"></i> 
                        </a>
                    </div>
                </div>

                <div class="alert alert-dark">
                    <h4 class="alert-heading">{{ __('Docentes') }}</h4>
                    <p>{{ __('Listado de docentes') }}</p>
                    <hr>
                    <div class="text-right">
                        <a href="#" class="btn btn-outline-dark"
                        data-toggle="tooltip" data-placement="right" title="Ir">
                            <i class="fas fa-arrow-alt-circle-right"></i>
                        </a>
                    </div>
                </div>

                @if(Auth::user()->hasRole('Administrador','Coordinador','Docente'))
                    <div class="alert alert-danger">
                        <h4 class="alert-heading">{{ __('Alumnos') }}</h4>
                        <p>{{ __('Listado de alumnos') }}</p>
                        <hr>
                        <div class="text-right">
                            <a href="#" class="btn btn-outline-danger" 
                            data-toggle="tooltip" data-placement="right" title="Ir">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif
                
                 @if(Auth::user()->hasRole('Administrador','Coordinador','Docente'))
                    <div class="alert alert-primary">
                        <h4 class="alert-heading">{{ __('Carreras') }}</h4>
                        <p>{{ __('Listado de carreras disponibles') }}</p>
                        <hr>
                        <div class="text-right">
                            <a href="#" class="btn btn-outline-primary"
                            data-toggle="tooltip" data-placement="right" title="Ir">
                                <i class="fa fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif

                @if(Auth::user()->hasRole('Administrador'))
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">{{ ('Roles') }}</h4>
                        <p>{{ ('Listado de roles disponibles') }}</p>
                        <hr>
                        <div class="text-right">
                            <a href="{{ route('Roles') }}" class="btn btn-outline-warning"
                            data-toggle="tooltip" data-placement="right" title="Ir">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endif

                
                
            </div>
        </div>
    </div>
</div>
@endsection