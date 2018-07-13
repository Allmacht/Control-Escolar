@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <!-- CÓDIGO ORIGINAL-->

        <!--<div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>-->

    <!-- FIN CÓDIGO ORIGINAL -->
    
    <div class="col-md-10 shadow p-3 mb-5 bg-white rounded">
        <div class="text-center">
            <br>
            <img  class="img-responsive" src="{{ asset('icons/login.png') }}" alt="" width="100px">
            <hr>
            <h2>Recuperación de contraseña</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                {{ session('status') }}
                </div>
            @endif
        </div>

       <form action="{{ route('password.email') }}" method="post">
           @csrf
           <div class="col-md-6 mx-auto">
               <br>
               <div class="form-group row">
                   <label for="email">{{ __('Email') }}</label>
                   <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Ingresa tu email') }}" required>

                   <div class="col-md-6">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
               </div>
           </div>
           <div class="text-center">
                <button type="submit" class="btn btn-outline-danger">{{ __('Enviar código') }}</button>
           </div>
       </form>
    </div>
</div>
@endsection
