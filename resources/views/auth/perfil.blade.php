@extends('layouts.material')

@section('css')
@endsection

@section('title','Ajustes')

@section('menu_title_1','Nombre Menu')
@section('menu_title_2','Nombre_Menu')

@section('content')



<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-4"> <img src="{{ asset(Auth::user()->img)}}" alt="user" class="rounded-circle" width="150">
                                    <h4 class="card-title mt-2">{{auth()->user()->nombres.' '.auth()->user()->apellido_paterno.' '.auth()->user()->apellido_materno}}</h4>
                                    @foreach(auth()->user()->roles as $rol)
                                    <button class="btn waves-effect waves-light btn-rounded btn-success" disabled> {{$rol->nombre}}</button>
                                    @endforeach
                                    <!-- <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div> -->
                                </center>
                            </div>
                            <div></div>
                                <hr> 
                                <div class="card-body"> 
                                    <small class="text-muted">DNI</small> 
                                        <h6>{{auth()->user()->dni}}</h6> 
                                    <small class="text-muted">Fecha de Nacimiento</small> 
                                        <h6></h6> 
                                    <small class="text-muted pt-4 db">Celular</small> 
                                        <h6>987654321</h6>
                                    <small class="text-muted pt-4 db">Correo</small> 
                                        <h6>{{auth()->user()->email}}</h6>  
                                    <small class="text-muted pt-4 db">Dirección</small>
                                        <h6>Calle alla sito, N° 20815</h6>
                                    <br> 
                                    <button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Editar"><i class="mdi mdi-account-edit font-20"></i></button>
                                <!-- <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                                </div> 
                                    <small class="text-muted pt-4 db">Redes Sociales</small>
                                    <br>
                                    <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                                    <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button> 
                                -->
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Tabs -->
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true">Formación Académica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">Capacitaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Experiencia Laboral</a>
                                </li>
                            </ul>
                            <!-- Tabs -->
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-sm-12">Formación</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>Universitaria</option>
                                                        <option>Tecnica</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-12">Grado Académico</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>Universitaria Completa</option>
                                                        <option>Magister</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Institución</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>UNHEVAL</option>
                                                        <option>UDH</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label class="col-md-12">Desde</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Hasta</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Año de Estudios</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="5" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>

                                            
                                            <div class="form-group">
                                                <label class="col-md-12">Fecha de Egresado de la carrera Prof. o Téc.</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>

                                            
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-sm-12">Tipo</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>Certificado</option>
                                                        <option>Diplomado</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Nombre</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Nombre del Curso" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Institución</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Nombre de Institución" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Desde</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Hasta</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Horas Académicas</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="5" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-12">Ciudad</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>Lima</option>
                                                        <option>Huanuco</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                                
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    
                                    <div class="card-body">
                                    <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-sm-12">Tipo de Experiencia</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>General</option>
                                                        <option>Especifica</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Institución</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-12">Tipo de Institución</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>Privada</option>
                                                        <option>Publica</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Cargo</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Funciones</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>

                                            
                                            <div class="form-group">
                                                <label class="col-md-12">Desde</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Hasta</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="03/02/2021" class="form-control form-control-line">
                                                </div>
                                                
                                            </div>
                                           

                                            
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>





@endsection
@section('js')

{{-- Ajustes de vista --}}
@endsection
