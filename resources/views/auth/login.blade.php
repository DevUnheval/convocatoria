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
    <link rel="icon" type="image/png" sizes="16x16" href="{{substr(\App\Ajuste::find(1)->elemento('icono'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('icono'))
                                    :asset(\App\Ajuste::find(1)->elemento('icono'))}}">
    <title>Iniciar Sesión</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="{{ asset('/material-pro/dist/css/style.min.css') }}" rel="stylesheet">
<![endif]-->
</head>

<body>
<div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background-image:url({{substr(\App\Ajuste::find(1)->elemento('imagen fondo login'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('imagen fondo login'))
                                    :asset(\App\Ajuste::find(1)->elemento('imagen fondo login'))}}); background-repeat: no-repeat; background-size: 100% 100%;">
            <div class="auth-box p-4 bg-white rounded">
                <div id="loginform">
                    
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('validaracceso') }}">
                        @csrf
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
                        </div>
                        <br>

                        <!-- Mensaje de error en caso las credenciales sean incorrectos -->
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

                        <div class="form-group ">
                            <div class="col-xs-12">



                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" placeholder="Usuario/DNI" autofocus>
                               <!-- @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                 -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
                            </div><br>
                            <div class="col-xs-12">
                                <a href="{{route('registro_usuario')}}" class="col-xs-6"><u>Crear una cuenta</u></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{ route('password.request') }}" class="col-xs-6">Olvidé la contraseña</a>
                            </div>
                        </div>
                       
                    </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="logo">
                        <h3 class="font-weight-medium mb-3">Recover Password</h3>
                        <span class="text-muted">Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row mt-3 form-material">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="email" required="" placeholder="dni">
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-block btn-lg btn-primary text-uppercase" type="submit" name="action">Reset</button>
                                </div>
                            </div>
                        </form>
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


    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('/material-pro/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/material-pro/src/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
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
    </script>
</body>

</html>