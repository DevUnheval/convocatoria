<!-- Full width modal content -->
<div id="modal_ver" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header bg-secondary" >
               <h4 class="modal-title text-white"id="fullWidthModalLabel">Detalles de la Convocatoria</h4>
               <button type="button" class="close btn-light" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
                 <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
                  <div class="col-12">
                     <div class="card">
                        <!-- Inicio de los Tabs -->
                        <div class="card-body">
                           <ul class="nav nav-tabs mb-3 ">
                                 <li class="nav-item">
                                    <a href="#tab_1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                       <i class="mdi mdi-file-pdf d-lg-none d-block mr-1"></i>
                                       <span class="d-none d-lg-block">Datos Generales</span>
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                       <i class="mdi mdi-calendar-clock d-lg-none d-block mr-1"></i>
                                       <span class="d-none d-lg-block">Conocimientos</span>
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                       <i class="mdi mdi-calendar-clock d-lg-none d-block mr-1"></i>
                                       <span class="d-none d-lg-block">Cronograma</span>
                                    </a>
                                 </li>
                           </ul>
                           <div class="tab-content">
                                 <!-- Tab 1-->
                                 <div class="tab-pane show active" id="tab_1">
                                    <div class="alert alert-success" role="alert">
                                       <i class='fa fa-info-circle'></i> Para Postular recuerde que debe haber <b><span class="text-success"> iniciado sesión</span></b> como Postulante, asimismo, si aún no cuenta con un Usuario le invitamos a registrarse.
                                    </div>
                                    <div class="form-group">
                                       <div class="row    ">                                            
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <b><small>Código de la convocatoria:  </small></b>
                                                <input type="text" class="form-control required" name="cod"  id="cod" disabled>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <small>Tipo de Proceso:   </small>
                                                <select class="custom-select form-control" name="tipo_id" id="tipo_id" disabled>
                                                   @foreach($datos['tipos_proc'] as $key => $tipo )
                                                   <option value="{{$key}}">{{$tipo}}</option>
                                                   @endforeach                                                   
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <small>Cantidad de plazas:  </small>
                                                <input type="number" class="form-control required" name="n_plazas" id="n_plazas" disabled>
                                             </div>
                                          </div>
                                       </div>                                        
                                       <div class="row form-group border-bottom   ">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <small>Nombre/Cargo de la convocatoria:  </small>
                                                <input type="text" class="form-control required"   name="nombre" id="nombre" disabled> 
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <small>Area/Unidad al que postula:  </small>
                                                <input type="text" class="form-control required"   name="oficina" id="oficina" disabled>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <small>Descripción</small>
                                                <textarea class="form-control" name="descripcion" id="descripcion" disabled></textarea>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">							
                                       <strong >Bases</strong>
                                       <button type="button" class="btn btn-outline-danger btn-rounded btn-xs"><i class="fa fa-download"></i> Descargar</button>                                       
                                    </div>
                                    <div class="form-group">							
                                       <strong >Resolución de aprobación</strong>
                                       <button type="button" class="btn btn-outline-danger btn-rounded btn-xs"><i class="fa fa-download"></i> Descargar</button>                                     
                                    </div>
                                 </div>
                                 <!-- Tab 2-->
                                 <div class="tab-pane show" id="tab_2">
                                    <div class="form-group">
                                       <div class="row">                                            
                                          <div class="col-md-12 form-group">
                                             <b>Formación Académica</b>
                                             <textarea class="form-control" name="" id="" disabled>Titulada/o Universitaria/o de la carrera de Ingeniería Industrial, Ingeniería de Sistemas, Ingeniería Empresarial o Ingeniería Informática </textarea>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <b>Experiencia</b>
                                                <textarea class="form-control" name="" id="" disabled>No menor de cinco (5) años. No menor de tres (3) años en niveles de puesto de analista o especialista, realizando actividades relacionadas al diseño o rediseño o modelamiento o mejora de proceso</textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <b>Habilidades</b>
                                                <input class="form-control" name="" id="" disabled value="Planificación y organización, habilidad analítica, orientación a resultados e iniciativa"></input>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <b>Conocimientos para el puesto (mínimos o indispensable)</b>
                                                <textarea class="form-control" name="" id="" disabled>Programa de Especialización en Gestión de Procesos, Diseño de Procesos, Gestión de Calidad o Mejora continua de Procesos o similares</textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <b>Programas de especialización o Diplomado/Cursos:</b>
                                                <textarea class="form-control" name="" id="" disabled>Conocimiento en Gestión de Procesos. Conocimientos en MS Project. Conocimiento en ARIS, BIZAGI u otro modelador que utilice notación BPMN. Conocimiento en metodologías ágiles. Conocimiento de Hoja de Cálculo a nivel avanzado, Procesador de Texto y Programa de Presentaciones a nivel intermedio. Conocimientos de inglés a nivel básico.</textarea>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <b>Remuneración mensual</b>
                                                <input class="form-control" name="" id="" disabled value="S/8,500.00"></input>
                                             </div>
                                          </div>
                                       </div> 
                                    </div>
                                 </div>
                                 <!-- Tab 3-->
                                 <div class="tab-pane show" id="tab_3">
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-md-6 form-group">
                                             <small>Fecha Aprobación:</small>
                                             <input type="date" class="form-control" name="fecha_aprobacion"  id="fecha_aprobacion">
                                          </div>
                                          <div class="col-md-6 form-group">
                                             <small>Fecha Publicación:</small>
                                             <input type="date" class="form-control required" name="fecha_publicacion" id="fecha_publicacion">
                                          </div>
                                          <div class="col-md-6 form-group">
                                             <small>Fecha Publicación:</small>
                                             <input type="date" class="form-control required" name="fecha_inscripcion_inicio" id="fecha_inscripcion_inicio">
                                          </div>
                                          <div class="col-md-6 form-group">
                                             <small>Fecha Publicación:</small>
                                             <input type="date" class="form-control required" name="fecha_inscripcion_fin"  id="fecha_inscripcion_fin">
                                          </div> 
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger my-2" data-dismiss="modal">Cerrar</button>
                        </div>
                  <!-- Fin de los Tabs -->                           
                     </div>
                  </div>
                  <!-- ============================================================== -->
                  <!-- Example -->
                  <!-- ============================================================== -->
               {{-- wizard FIN--}}
              
            </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}
               