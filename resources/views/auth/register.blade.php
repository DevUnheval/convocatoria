<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    
    <title>Registro</title>
    <!-- Custom CSS -->
    <link href="{{ asset('/material-pro/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/preloader.css')}}" rel="stylesheet" type="text/css">
    <style>
        .mayuscula{
            text-transform: uppercase;
        }
    </style>

</head>

<body>

    <div id="loading-screen" style="display: none">
    
        <img src="{{ asset('/imagenes/preloader/spinning-circles.svg')}}" >
        <h4 id="text_cargando">Cargando</h4>
        
    </div>

<div class="main-wrapper ">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background-image:url({{substr(\App\Ajuste::find(1)->elemento('imagen fondo login'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('imagen fondo login'))
                                    :asset(\App\Ajuste::find(1)->elemento('imagen fondo login'))}}); background-repeat: no-repeat; background-size: 100% 100%;">
            <div class="p-4 bg-white rounded shadow-lg">
                <div class="main-wrapper">
                    <!-- ============================================================== -->
                    <!-- Preloader - style you can find in spinners.css -->
                    <!-- ============================================================== -->
                    
                    <!-- ============================================================== -->
                    <!-- Preloader - style you can find in spinners.css -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Login box.scss -->
                    <!-- ============================================================== -->
                    <div  >
                        <div>
                            <div>
                                
                                <!-- Mensaje de error en caso las credenciales sean incorrectos -->
                               
                                   
                            <div class="navbar-header" alingn="center">
                                <a class="navbar-brand" href="{{ route('index') }}" title="Ir al buscador">
                                    <img src="{{substr(\App\Ajuste::find(1)->elemento('logo'), 0,6)=='public'
                                        ?Storage::url(\App\Ajuste::find(1)->elemento('logo'))
                                        :asset(\App\Ajuste::find(1)->elemento('logo'))}}"  alt="homepage" class="light-logo" height="45px" /> 
                                    <img src="{{substr(\App\Ajuste::find(1)->elemento('logo texto 2'), 0,6)=='public'
                                        ?Storage::url(\App\Ajuste::find(1)->elemento('logo texto 2'))
                                        :asset(\App\Ajuste::find(1)->elemento('logo texto 2'))}}" class="logo" alt="Logo-oscuro" 
                                        style="max-width: 198px; max-height: 45px" />
                                </a>
                                <h1 style="font-size:20px;">Crear una cuenta</h1>
                            </div>

                                @if($errors->any())
                                <div class="alert alert-danger alert alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                    <ul>
                                        
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li> 
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                               
                               
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-12">
                                        
                                        <form id="form_registrar" class="needs-validation_registro form-horizontal mt-3 form-material" method="POST" action="{{route('registro_usuario_post')}} " novalidate>
                                            @csrf
                                            <div class="form-group mb-3">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="text" required id="dni" name="dni" placeholder="DNI/Carné de extranjería" value="{{old('dni')}}" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="text" required id="nombres" name="nombres" placeholder="Nombres" value="{{old('nombres')}}" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                                

                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="text" required id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" value="{{old('apellido_paterno')}}" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                            </div><div class="form-group mb-3">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="text" required id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" value="{{old('apellido_materno')}}" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 ">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="email" required id="email" name="email" placeholder="Correo electrónico" value="{{old('email')}}">
                                                    <div class="invalid-feedback">
                                                        Ingrese un correo válido
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 ">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="password" required id="password" name="password" placeholder="Contraseña" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="password" required id="password-confirm" name="password_confirmation" placeholder="Confirmar contraseña" >
                                                    <div class="invalid-feedback">
                                                        Complete este campo
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="">
                                                    <div class="checkbox checkbox-success pt-0">
                                                        <input id="checkbox-signup" type="checkbox" required class="chk-col-indigo material-inputs">
                                                        <label for="checkbox-signup"> Estoy de acuerdo con los <a href="{{ asset('storage/procesos/terminos/documento.pdf') }}">términos</a></label>
                                                        <div class="invalid-feedback">
                                                           Marque la opción "Estoy de acuerdo con los términos"
                                                          </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group text-center mb-3">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Registrarse</button>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group mb-0 mt-2 ">
                                                <div class="col-sm-12 text-center ">
                                                    ¿Ya tienes una cuenta? <a href="{{route('login')}}" class="text-info ml-1 ">Inicia Sesión</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Login box.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Page wrapper scss in scafholding.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Page wrapper scss in scafholding.scss -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right Sidebar -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Right Sidebar -->
                    <!-- ============================================================== -->
                </div>    
                
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>


    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('/material-pro/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/material-pro/src/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- 
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>============================================================== -->
    <script src="{{ asset('/js/buscar_dni_api.js')}}"></script>
    
    
</body>

</html>