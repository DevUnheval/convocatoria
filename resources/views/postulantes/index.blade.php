@extends('layouts.material')

@section('css')
<!-- This Page CSS -->
<link href="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">
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



<div class="container-fluid note-has-grid">
    <div class="row justify-content-center h-100">
        
        <div class="form-check form-check-inline">
        @foreach($etapas as $key => $e)
            <input class="form-check-input material-inputs" type="radio"  name="etapa" id="etapa_{{$key}}"
                    {{ $e['etapa']>$proceso->etapa_evaluacion ? "disabled" : ''}}
                    value="{{ $e['etapa'] }}" for="a_{{$e['etapa']}}" data-etapa="{{$e['etapa']}}" data-proceso="{{$proceso->id}}"
                    {{ $e["etapa"]==$etapa_actual["etapa"] ? "checked" : ''}} data-url="{{route('postulantes.index',[$proceso->id,$e['etapa'] ])}}">
            <label class="form-check-label" for="etapa_{{$key}}" style = "{{ $e["etapa"]==$etapa_actual["etapa"] ? 'font-weight: bold' : ''}} ">{{$e['descripcion']}}</label> &nbsp;&nbsp;&nbsp;   
        @endforeach
        </div>
    </div>
    <ul class="nav nav-pills p-3 bg-light mb-3 rounded-pill align-items-center">
        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2"  id="all-category">
            <i class="icon-layers mr-1"></i><span class="d-none d-md-block">Todos ({{$grupo['total']}})</span></a> 
        </li>
        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-pendiente">
            <i class="icon-clock mr-1"></i><span class="d-none d-md-block">Pendientes ({{$grupo['pendientes']}})</span></a> 
        </li>
        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-no-califica">
            <i class="icon-close mr-1"></i><span class="d-none d-md-block">No califica ({{$grupo['noCalifica']}})</span></a> 
        </li>
        <li class="nav-item"> <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="note-califica">
            <i class="icon-check mr-1"></i><span class="d-none d-md-block">Califica ({{$grupo['califica']}})</span></a> 
        </li>
        <li class="nav-item ml-auto">
            <div class="btn-group">
                <label class="nav-link btn-success rounded-pill d-flex align-items-center px-3 " id="add-notes"  data-toggle="dropdown" aria-haspopup="true">
                    <i class="fa fa-file-excel m-1"></i><span class="d-none d-md-block font-14">Datos</span>
                </label> 
                <div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                    <a class='dropdown-item' href='javascript:void(0)'><i class='ti-eye'></i> Exportar </a>
                    <a class='dropdown-item' href='javascript:void(0)' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Inportar</a>
                </div>
            </div>
        </li>

    </ul>
    <div class="tab-content">
        <div  id="note-full-container" class="note-has-grid row">
               
                @include('postulantes.modal_cv')
                @include('postulantes.modal_evaluar')
                @foreach($postulantes as $key => $p)
                <div class="col-md-3 single-note-pendiente container-fluid all-category {{array_key_exists($p->$calificacion_etapa_actual, $estado) ? $estado[$p->$calificacion_etapa_actual]['clase'] : 'note-pendiente'}}">
                    <div class="card card-body el-element-overlay">
                        <span class="side-stick"></span>
                        <h5 class="note-title text-truncate w-75 mb-0"> {{array_key_exists($p->$calificacion_etapa_actual, $estado) ? $estado[$p->$calificacion_etapa_actual]['nombre'] : 'Pendiente'}}  <i class="point fas fa-circle ml-1 font-10" ></i></h5>
                        <p class="note-date font-12 text-muted">11 March 2009</p>
                        <div class="note-content">
                            <div class="el-card-item pb-3">
                                <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center"> 
                                    <img src="{{Url('material-pro/src/assets/images/users/'.($key%7+1).'.jpg')}}" alt="user" class="d-block position-relative w-100" />
                                    <div class="el-overlay w-100 overflow-hidden">
                                        <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                                            <li class="el-item d-inline-block my-0 mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="{{url('material-pro/src/assets/images/users/'.($key%7+1).'.jpg')}}" title="ver foto"><i class="icon-picture"></i></a></li>
                                            <li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_cv" title="CV"><i class="fas fa-address-card" ></i></button></li> 
                                            <li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_evaluar" title="evaluar"><i class="fas fa-calculator"></i></button></li>

                                        </ul>
                                    </div>
                                  
                                </div>
                                <div class="el-card-content text-center">
                                    <h4 class="mb-0">{{$p->user->nombres.' '.$p->user->apellido_paterno.' '.$p->user->apellido_materno}} (25)</h4> <span class="text-muted">Ingenieria Civil</span>
                                </div>
                            </div>
                            <div class="el-card-content text-left">
                                    <span class="text-muted"><b>Curricular:</b> 34</span><br>
                                    <span class="text-muted"><b>Conoc/Psic/Hab:</b> 34</span><br>
                                    <span class="text-muted"><b>Entrevista:</b> 34</span>
                            </div>
                          
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>				
</div>


     
        

@endsection
@section('js')
	<!--This page JavaScript -->
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('/material-pro/src/assets/libs/magnific-popup/meg.init.js')}}"></script>
    <script src="{{ asset('/js/postulantes.js')}}"></script>
    

{{-- Ajustes de vista --}}
@endsection