
@extends('layouts.material2')

@section('content')
    
<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="alert alert-success text-center" role="alert">
                <h5> <i class="fa fa-check mr-5" aria-hidden="true"></i>Sr(a) {{auth()->user()->nombres}} {{auth()->user()->apellido_paterno}} se ha registrado correctamente, es necesario que verifique su <strong> correo electrónico</strong></h5>
            </div>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                   <!-- 
                    
                    {{ __('Antes de continuar, consulte su correo electrónico ')}} {{session('correo')}} {{(' para ver si hay un enlace de verificación.') }}
                    {{ __('If you did not receive the email') }}, 

                    -->
                    Antes de continuar, consulte su correo electrónico <strong> {{auth()->user()->email}} </strong> para ver si hay un enlace de 
                    verificación. Si no ha recibido el correo electrónico,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    <br><br><br>
                    <button class="float-left btn btn-outline-success">Ya he verificado mi correo</button>
                    <button class="float-right btn btn-outline-success">Deseo cambiar el correo registrado</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
