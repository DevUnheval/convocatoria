@extends('layouts.material')

@section('css')
<!-- This Page CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">
<link href="{{ asset('/material-pro/src/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<style>
.note-has-grid .single-note-pendiente.note-no-califica .side-stick {background-color: rgba(252, 75, 108, 0.5); }
.note-no-califica .point {  color: rgba(252, 75, 108, 0.5); }

.note-has-grid .single-note-pendiente.note-califica .side-stick {background-color: rgba(33, 193, 214, 0.5); }
.note-califica .point {  color: rgba(33, 193, 214, 0.5); }

.note-pendiente .point {  color: rgba(79, 84, 103, 0.4); }

.note-has-grid .single-note-pendiente .side-stick {
    position: absolute;
    width: 3px;
    height: 35px;
    left: 0;
    background-color: rgba(79, 84, 103, 0.4); }

</style>
@endsection

@section('title','Ajustes')

@section('menu_title_1','Potulantes: '.$proceso->nombre)
@section('menu_title_2','Postulantes > '.$proceso->nombre)

@section('content')



<div class="container-fluid note-has-grid"><hr>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    <div class="row">
        <div class="col-sm-4 col-xs-12 justify-content-center row">
            <div class="form-check form-check-inline ">

                    <input class="material-inputs check-vista" type="radio"  name="vista" id="vista_tablas" value="1" {{ ($vista=='1' || $vista=='0')?'checked' : ''}} data-proceso="{{$proceso->id}}" data-etapa="{{$etapa}}" data-vista="1" data-div_id="ver-tablas">
                    <label class="form-check-label" for="vista_tablas">Ver en tablas</label> &nbsp;&nbsp;&nbsp;     

                    <input class="material-inputs  check-vista" type="radio"  name="vista" id="vista_tarjetas" value="2" {{$vista == '2' ? 'checked' : ''}} data-proceso="{{$proceso->id}}" data-etapa="{{$etapa}}" data-vista="2" data-div_id="ver-tarjetas">
                    <label class="form-check-label" for="vista_tarjetas">Ver en tarjetas </label> &nbsp;&nbsp;&nbsp;       
            </div><br>
        </div> 
        <div class="col-sm-6 justify-content-center row">
            <div class="form-check form-check-inline">
                @foreach($etapas as $key => $e)
                <input class="form-check-input material-inputs" type="radio"  name="etapa" id="etapa_{{$key}}"
                        {{ $e['etapa']>$proceso->etapa_evaluacion ? "disabled" : ''}}
                        value="{{ $e['etapa'] }}" for="a_{{$e['etapa']}}" data-etapa="{{$e['etapa']}}" data-proceso="{{$proceso->id}}"
                        {{ $e["etapa"]==$etapa_actual["etapa"] ? "checked" : ''}} data-url="{{route('postulantes.index',[$proceso->id,$e['etapa'],$vista ])}}">
                <label class="form-check-label" for="etapa_{{$key}}" style = "{{ $e["etapa"]==$etapa_actual["etapa"] ? 'font-weight: bold' : ''}} ">{{$e['descripcion']}}</label> &nbsp;&nbsp;&nbsp;   
                @endforeach
            </div>
        </div>
        <div class="col-sm-2 justify-content-center row">
            <div class="btn-group">
                <label class="nav-link btn-success rounded-pill d-flex align-items-center px-3 " data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-download"> </i> <span class="d-none d-md-block font-14">&nbsp;Exportar</span>
                </label> 
                <div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                    <a class='dropdown-item text-success' href='{{route("reportes.excel",$proceso->id)}}' target="_blank"><i class='fa fa-file-excel'></i> Exportar a excel</a>
                    <a class='dropdown-item text-danger' href='{{route("reportes.pdf",$proceso->id)}}' target="_blank"><i class='fa fa-file-pdf success'></i> Exportar a pdf</a><hr class="my-0">
                    <a class='dropdown-item text-info' href='{{route("reportes.pdf",$proceso->id)}}' target="_blank"><i class='fa fa-file-pdf success'></i> Exportar otro</a>
                </div>
            </div>
        </div>
       
    </div><hr> 
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------- -->
    @include('postulantes.modal_cv')
    @include('postulantes.modal_evaluar')
    @include('postulantes.m_evaluacion_todos')
    <div id="ver-tarjetas" class="ver-div" hidden>
        <ul class="nav nav-pills p-3 bg-light mb-3 rounded-pill align-items-center">
            <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2"  id="all-category">
                <i class="icon-layers mr-1"></i><span class="d-none d-md-block" id="grupo_total">Todos </span></a> 
            </li>
            <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-pendiente">
                <i class="icon-clock mr-1"></i><span class="d-none d-md-block"  id="grupo_pendientes">Pendientes </span></a> 
            </li>
            <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-no-califica">
                <i class="icon-close mr-1"></i><span class="d-none d-md-block"  id="grupo_noCalifica">No califica </span></a> 
            </li>
            <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-califica">
                <i class="icon-check mr-1"></i><span class="d-none d-md-block"  id="grupo_calificia">Califica </span></a> 
            </li>
        </ul>
        
        <div class="tab-content">
            <div  id="note-full-container" class="note-has-grid row">
                    <!-- Code from script -->
            </div>
        </div>	
    </div>
    <div id="ver-tablas" class="ver-div" hidden>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    POSTULANTES AL PROCESO
                </h4>
                <div class="table-responsive">
                    <table id="data_table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>CV</th>
                                <th>Ev. Curricular <br> <small> peso {{100*$proceso->peso_cv}}%</small></th> 
                                @if($proceso->evaluar_conocimientos=="1")
                                <th>Ev. Conoc/ Psic/Hab  <br> <small> peso {{100*$proceso->peso_conoc}}%</small> </th>   
                                @endif
                                <th>Ev. entrevista <br><small> peso {{100*$proceso->peso_entrev}}%</small></th>
                                <th title="Bonificación">Bon+</th>
                                <th>Total </th>
                            </tr>
                        </thead>
                        <tbody>
                                <!-- Cuerpo vacio -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Estado</th>
                                <th>DNI</th>
                                <th>Apellidos y Nombres</th>
                                <th>CV</th>
                                <th>Ev. Curricular</th> 
                                @if($proceso->evaluar_conocimientos=="1")
                                <th>Ev. Conoc/ Psic/Hab: </th>   
                                @endif
                                <th>Ev. entrevista</th>
                                <th title="Bonificación">Bon+</th>
                                <th>Total </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>			
</div>


     
        

@endsection
@section('js')
	<!--This page JavaScript -->
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/meg.init.js')}}"></script>
    <script src="{{ asset('/js/postulantes/tarjetas_postulantes.js')}}"></script>
    <script src="{{ asset('/js/postulantes/postulantes.js')}}"></script>
    <script src="{{ asset('/js/postulantes/modalcv.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/material-pro/dist/js/pages/datatable/custom-datatable.js')}}"></script>
    <script>               
        
    </script>
    

{{-- Ajustes de vista --}}
@endsection