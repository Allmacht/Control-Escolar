@extends('layouts.app')
@section('title', $User->name)
@section('content')
    <style>
        .fa-edit{
            font-size: 1.4rem;
            cursor: pointer;
            text-decoration: none;
            color: black;
        }
        .fa-times{
            font-size: 1.4rem;
            cursor: pointer;
            text-decoration: none;
            color: black;
        }
        .fa-times .fa-edit:hover{
            color: #7a7a7a;
        }
    </style>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-xs-12 col-sm-12 pb-5">
                <div class="card mx-auto shadow" style="width: 15rem;">

                    <img class="card-img-top img-responsive" 
                    src=@if(!$User->profile_picture == null)
                            "/images/profile_pictures/{{ $User->profile_picture }}" 
                        @else
                             "{{ asset('images/default.png') }}"
                        @endif>
                        
                    <div class="card-body text-center">
                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#ModalPerfil">{{ __('Cambiar imagen') }}</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-xs-12 col-sm-12 shadow">
                <div class="col-md-12 my-3">
                    <h4 class="text-center">{{ __('Perfil') }}</h4>
                    <hr>
                </div>
                <div class="col-md-12 text-right">
                    @if($edit == false)
                        <a href="{{ route('ProfileEdit',['id'=>$User->id]) }}">
                            <i class="fas fa-edit" data-toggle="tooltip" data-placement="right" title="Editar Información"></i>
                        </a>
                    @else
                        <a href="{{ route('ProfileUser',['id'=>$User->id]) }}">
                            <i class="fas fa-times" data-toggle="tooltip" data-placement="right" title="Cancelar"></i>
                        </a>
                    @endif
                </div>
                <div class="col-lg-8 col-md-12 col-xs-12 offset-lg-2 pb-3">
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
                    @if($errors->any())
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ( $errors->all() as $error )
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('ProfileUpdate',['id'=>$User->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Nombre') }}</label>
                            <input type="text" @if($edit==false) readonly @endif class="form-control" name="name" 
                                pattern="[A-Z a-z]{3,14}" title="Mínimo 3 caracteres, máximo 14, sin números ni caracteres especiales" value="{{ $User->names }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email"  @if($edit==false) readonly @endif class="form-control" name="email" 
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ $User->email }}" required>
                        </div>
                         @if($edit==true)
                            <div class="text-center py-2">
                                <button type="submit" class="btn btn-outline-success">{{ __('Actualizar información') }}</button>
                            </div>
                        @endif
                    </form>
                   
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalPerfil" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>{{ __('Foto de perfil') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ProfileUpdate',['id'=>$User->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="profile_picture">{{ __('Selecciona una imagen') }}</label>
                            <input type="file" class="form-control-file" name="profile_picture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{ __('Cancelar') }}</button>
                        <button type="submit" class="btn btn-outline-success">{{ __('Actualizar Imagen') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection