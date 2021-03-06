@extends('layouts.material')

@section('css')
@endsection

@section('content')

<div class="col-md-8 offset-2">
    @if ($mensaje != "")
    <div class="alert bg-warning text-center" role="alert">
        <strong><h4 class="text-white"> <i class="fa fa-check mr-5" aria-hidden="true"></i>{{$mensaje}}</h4></strong>
    </div>
    @endif
    <br>
</div>

<div class="header bg-cyan btn-rounded alert alert-primary col-md-8 offset-2">

    <h4 class="modal-title text-black text-center text-white font-weight-bold" id="fullWidthModalLabel">CONSTANCIA DE POSTULACIÓN</h4>
</div>
<div class="card border-left border-info col-md-8 offset-2">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <!--<h2>CONSTANCIA DE POSTULACIÓN</h2> -->
               <div class="modal-body">                
                    <div class="card col-md ">
                        <div class="row">
                            <div class="col-md form-row">
                                <div class="pt-1 pb-1 col-3 border form-group">
                                   <center><img src="{{ asset(str_replace('public/','storage/',Auth::user()->img))}}" alt="user" width="100" height="100"> </center>
                                </div>
                                <div class="col-4 border form-group">                                
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
                                <thead class="bg-cyan text-white">
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
                                        <td>{{$datos_postulante['ruc']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Fecha de Nacimiento</th>
                                        <td>{{$datos_postulante['fecha_nacimiento']}}</td>
                                        <th scope="row" class="alert alert-secondary">Lugar de Nacimiento</th>
                                        <td>{{$desc_u_nac}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Celular N° </th>
                                        <td>{{$datos_postulante['telefono_celular']}}</td>
                                        <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                                        <td>{{$pos->email}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Fecha de Postulacion </th>
                                        <td>{{date_format(date_create($pos->created_at),"d/m/Y")}}</td>
                                        <th scope="row" class="alert alert-secondary">Hora de Postulacion</th>
                                        <td>{{date_format(date_create($pos->created_at),"H:i:s")}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="alert alert-secondary">Domicilio Actual </th>
                                        <td colspan="3">{{$datos_postulante['domicilio']}} ({{$desc_u_dom}})</td>
                                        
                                    </tr>
                                    
                                </tbody>                            
                            </table>
                        </div>                    
                        <div>
                            <h6 class="mb-0">Se ha enviado una contancia de su postulación al correo registrado <strong class="text-success mb-0">{{$pos->email}}</strong></h6>
                            <h6 class="mb-0">Puede ver su postulación haciendo click <strong ><a href="{{ route('mispostulaciones')}}">Aquí</a></strong></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection