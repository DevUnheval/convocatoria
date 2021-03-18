<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-md-8">
    <div class="nuevaclase">
        <h2 class="modal-title text-black text-center  font-weight-bold" id="fullWidthModalLabel">CONSTANCIA DE POSTULACIÓN</h2>
    </div>
    <div class="form-row">
        <div class="navbar-header col-md-2 offset-1" alingn="center">
            <img src="{{ asset('\imagenes\ajustes\logo.png')}}" alt="">

            <a class="navbar-brand" href="{{ route('index') }}" title="Ir al buscador">
                <img src="{{substr(\App\Ajuste::find(1)->elemento('logo'), 0,6)=='public'
                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo'))
                    :asset(\App\Ajuste::find(1)->elemento('logo'))}}"  alt="homepage" class="light-logo" height="85px" /> 
            </a>
        </div>
        <div class="col-md-9">
            <h4>Se registro correctamente su postulación!</h4>
            <label for="">Estimado(a) Sr(a): <strong>{{auth()->user()->apellido_paterno}} {{auth()->user()->apellido_materno}}, {{auth()->user()->nombres}}</strong></label> <br>
            <label for="">Gracias por su participación. Su correo ha sido recibido con éxito y la documentación que adjunte será evaluada según lo establecido en las bases de la convocatoria a la cual postula.</label>
            
        </div>
    </div>
    <hr>
    <div class="form-row border border-info bg-white"> 
        <div class="offset-1"></div>
        <div class="col-5 mb-3 form-group">
            <small ><strong class="text-center text-dark-info font-weight-bold">PUESTO AL QUE POSTULA:  </strong> </small>{{$proceso->nombre}}
            <br>
            <small ><strong class="text-center text-dark-info font-weight-bold">AREA/OFICINA:  </strong> </small> {{$proceso->oficina}}
        </div>
        <div class="col-4  form-group ">                                
            <small class="text-center text-dark-info font-weight-bold "><strong>PROCESO: </strong></small> {{$proceso->cod}}
            <br>
            <small><strong  class="text-dark-info font-weight-bold">N° Plazas = </strong> </small>{{$proceso->n_plazas}}
        </div>
    </div>
    <br>
    <div class="table-responsive border-info border">
        <table class="table">
            <thead class="bg-info text-white">
                <tr>
                    <th colspan="4">DATOS PERSONALES</th>
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
                    <th scope="row" class="alert alert-secondary">Lugar de nacimiento</th>
                    <td>{{$desc_u_nac}}</td>
                </tr>
                <tr>
                    <th scope="row" class="alert alert-secondary">Celular N° </th>
                    <td>{{$datos_postulante['telefono_celular']}}</td>
                    <th scope="row" class="alert alert-secondary">Correo Electrónico</th>
                    <td>{{$postulacion->email}}</td>
                </tr>
                <tr>
                    <th scope="row" class="alert alert-secondary">Fecha de Postulacion </th>
                    <td>{{date_format(date_create($postulacion->created_at),"d/m/Y")}}</td>
                    <th scope="row" class="alert alert-secondary">Hora de Postulacion</th>
                    <td>{{date_format(date_create($postulacion->created_at),"H:m:s")}}</td>
                </tr>
                <tr>
                    <th scope="row" class="alert alert-secondary">Dirección Actual </th>
                    <td colspan="3">{{$datos_postulante['domicilio']}} ({{$desc_u_dom}})</td>
                    
                </tr>
                
            </tbody>                            
        </table>
    </div>   
</div>
<br>
<hr>    
<label for=""><strong>NOTA:</strong> Por favor no responder a esta dirección de correo, ya que este buzón es de envío automático.</label>

</body>
</html>

