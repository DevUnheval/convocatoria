@extends('layouts.material')

@section('css')
@endsection

@section('content')


@if ($mensaje != "")
<div class="alert alert-danger text-center" role="alert">
    <h4> <i class="fa fa-check mr-5" aria-hidden="true"></i>{{$mensaje}}</h4>
</div>
@endif
<br><br>

<div class="header bg-ligth-warning btn-rounded alert alert-primary col-md-8 offset-2">

    <h4 class="modal-title text-black text-center  font-weight-bold" id="fullWidthModalLabel">CONSTANCIA DE POSTULACIÓN</h4>
</div>
<div class="card border-left border-info col-md-8 offset-2">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <!--<h2>CONSTANCIA DE POSTULACIÓN</h2> -->
               <div class="modal-body">                
                    <div class="card col-md ">
                        <div class="row">
                            <div class="col-md-12 form-row">
                                <div class="col-2 border form-group">
                                    <img src="{{ asset(Auth::user()->img)}}" alt="user" width="80">
                                </div>
                                <div class="col-5 border form-group">                                
                                    <small class="text-center text-dark-info font-weight-bold "><strong>ESTAS POSTULANDO AL PROCESO: </strong></small> <br>{{$proceso->cod}}
                                    <br>
                                    <small><strong  class="text-dark-info font-weight-bold">N° Plazas = </strong> </small><br>{{$proceso->n_plazas}}
                                </div>
                                <div class="col-5 border form-group">
                                    <small ><strong class="text-center text-dark-info font-weight-bold">PUESTO AL QUE POSTULA:  </strong> </small><br>{{$proceso->nombre}}
                                    <br>
                                    <small ><strong class="text-center text-dark-info font-weight-bold">AREA/OFICINA:  </strong> </small> <br>{{$proceso->oficina}}
                                </div> 
                            </div>                   
                        </div>
                        <div class="table-responsive">
                            <table class="table border-info table-bordered table-condensed">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th colspan="4">I. DATOS PERSONALES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Apellidos y Nombres</th>
                                        <td colspan="3">{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}}, {{auth()->user()->nombres}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Documentos de Identidad</th>
                                        <td>{{auth()->user()->dni}}</td>
                                        <th scope="row" class="alert alert-secondary">RUC:</th>
                                        <td>{{$datos_usuario['ruc']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                        <td>{{$datos_usuario['fecha_nacimiento']}}</td>
                                        <th scope="row" class="alert alert-secondary">Dist-Prov-Dep</th>
                                        <td>{{$datos_usuario['ubigeo_nacimiento']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Celular N° </th>
                                        <td>{{$datos_usuario['telefono_celular']}}</td>
                                        <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                                        <td>{{auth()->user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Dirección Actual </th>
                                        <td>{{$datos_usuario['domicilio']}}</td>
                                        <th scope="row" class="alert alert-secondary">Dist-Prov-Dep</th>
                                        <td>{{$datos_usuario['ubigeo_domicilio']}}</td>
                                    </tr>
                                </tbody>                            
                            </table>
                        </div>                    
                        <div>
                            <h6 class="text-info mb-0">Se ha enviado una contancia de su postulación al correo registrado <strong class="text-success mb-0">{{$datos_usuario->email}}</strong></h6>
                            <h5 class="text-info mb-0">Puede ver su postulación haciendo click <strong ><a href="{{ route('mispostulaciones')}}">Aquí</a></strong></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection