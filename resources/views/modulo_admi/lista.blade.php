@extends('layouts.material')

@section('css')
@endsection

@section('content')

<div class="card">    
    <div class="card-body table-responsive">
        <button type="button" class="btn btn-info">
            <i class="fas fa-plus"> Nuevo</i>
        </button>
        <br>   
             
       <table class="table table-bordered">
            <thead class="bg-success text-white">
                <th>Fecha Publicación</th>
                <th>Código</th>
                <th>Nombre de la convocatoria</th>
                <th>N° Plazas</th>
                <th>Plazo Inscripción</th>
                <th>Comunicados</th>
                <th>Acciones</th>               
            </thead>
            <tr>
                <td>26-01-2021</td>
                <td>CAS N° 001-2021</td>
                <td>
                    <h6>Cargo: <small>ESPECIALISTA EN GESTIÓN DEL BIENESTAR</small></h6>
                    <h6>Area: <small>Dirección Ejecutiva</small></h6>                                     
                </td>
                <td class="text-center">01</td>
                <td class="text-left">
                    <small>Del 27/01/2021 08:00:00 AM<br>Al 28/01/2021 16:00:00 PM</small>
                </td>>                
                <td> 
                    <button type="button" class="btn btn-danger btn-outline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar">
                        <i class="fa fa-file-pdf" style="font-size:20px;color:white"></i>
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-circle btn-info btn-outline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver">
                        <i class="fa fa-eye" ></i>
                    </button>

                    <button type="button" class="btn btn-circle btn-warning btn-outline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Editar">
                        <i class="fa fa-edit" ></i>
                    </button>
                </td>
            </tr>
       </table>
    </div>
</div>
@endsection
@section('js')
{{-- Ajustes de vista --}}
@endsection