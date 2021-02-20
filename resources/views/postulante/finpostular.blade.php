@extends('layouts.material')

@section('css')
@endsection

@section('content')
Estas postulando al proceso {{$proceso->cod}}<br>
Sr(a): {{$datos_usuario->nombres}} {{$datos_usuario->apellido_paterno}} {{$datos_usuario->apellido_materno}}<br>
RUC: {{$datos_usuario->ruc}}<br>
Se ha enviado una contancia de su postulación al correo registrado <strong>{{$datos_usuario->email}}</strong><br>
Puede ver su postulación ingresando <a href="#">Aquí</a>
<div class="card border-bottom border-info">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h2>Se guardo correctamente su postulación!</h2>
                Estas postulando al proceso {{$proceso->cod}}<br>
Sr(a): {{$datos_usuario->nombres}} {{$datos_usuario->apellido_paterno}} {{$datos_usuario->apellido_materno}}<br>
RUC: {{$datos_usuario->ruc}}<br>
Se ha enviado una contancia de su postulación al correo registrado <strong>{{$datos_usuario->email}}</strong><br>
Puede ver su postulación ingresando <a href="#">Aquí</a>
                <h6 class="text-info mb-0">News Feed</h6>
                <div class="modal-body">                
                <div class="card col-md-12">
                    <div class="row">
                        <div class="col-2 border form-group">
                            <img src="{{ asset(Auth::user()->img)}}" alt="user" width="80">
                        </div>
                        <div class="col-5 border form-group">
                            <small class="text-center text-dark-info font-weight-bold "><strong>PROCESO: </strong></small> <br>{{$proceso->cod}}
                               
                            <br>
                            <small><strong  class="text-dark-info font-weight-bold">N° Plazas = </strong> </small><br>{{$proceso->n_plazas}}
                        </div>
                        <div class="col-5 border form-group">
                            <small ><strong class="text-center text-dark-info font-weight-bold">PUESTO AL QUE POSTULA:  </strong> </small><br>{{$proceso->nombre}}
                            <br>
                            <small ><strong class="text-center text-dark-info font-weight-bold">AREA/OFICINA:  </strong> </small> <br>{{$proceso->oficina}}
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
                                    <td>{{auth()->user()->dni}}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Roshan</td>
                                    <td>Rogahn</td>
                                    <td>@Hritik</td>
                                </tr>
                            </tbody>
                            
                        </table>
                        <div>Puede ver su postulación ingresando <a href="#">Aquí</a></div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection