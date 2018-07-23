@extends('layouts.app')
@section('title','Control de Roles y permisos')
@section('content')
   <div class="container">
       <div class="row">
           <div class="col-lg-12 py-3">
               <h3>{{ __('Control de Roles') }}</h3>
           </div>
           <div class="col-lg-12 py-3">
               <a href="" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i>{{ __(' Nuevo Rol') }}</a>
           </div>
           <div class="col-lg-12">
               <div class="table-responsive">
                   <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Rol') }}</th>
                                <th scope="col">{{ __('Permisos') }}</th>
                                <th scope="col">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="align-middle">{{ $role->name }}</td>
                                    <td class="align-middle">
                                        @foreach($roles_has_permissions as $rhp)
                                            @if($rhp->role_id == $role->id)
                                                <span class="badge badge-pill badge-primary">{{ $rhp->permission->name }}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        <a href="" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="left" 
                                            title="Modificar"><i class="fas fa-edit"></i></a>
                                        <a href="" class="btn btn-outline-danger px-3" data-toggle="tooltip" data-placement="right"
                                            title="Eliminar"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
@endsection