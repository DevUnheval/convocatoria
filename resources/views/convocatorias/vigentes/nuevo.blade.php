<!-- Full width modal content -->
<div id="modal_nuevo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-full-width">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="fullWidthModalLabel">Nuevo registro</h4>
               <button type="button" class="close" data-dismiss="modal"
               aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
             {{-- wizard --}}
                 <!-- ============================================================== -->
                    <!-- Example -->
                    <!-- ============================================================== -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <!--<h4 class="card-title">Step wizard with validation</h4>
                                <h6 class="card-subtitle">You can us the validation like what we did</h6>
                                -->
                                <form action="#" class="tab-wizard wizard-circle mt-5" id="nueva_convocatoria">
                                    <!-- Step 1 -->
                                    <h6><strong>Datos generales</strong></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="wfirstName2">Código de la convocatoria:<span class="danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="wfirstName2" name="firstName">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="wlastName2">Tipo de Proceso: <span class="danger">*</span> </label>
                                                    <select class="custom-select form-control" id="location1" name="location">
                                                        <option value="">*Seleccione*</option>
                                                        <option value="Amsterdam">CAS/1057</option>
                                                        <option value="Frankfurt">Prácticas</option>
                                                        <option value="Berlin">276</option>
                                                        <option value="Frankfurt">728</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="wfirstName2">Cantidad de plazas:<span class="danger">*</span> </label>
                                                    <input type="number" class="form-control required" id="wfirstName2" name="firstName">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wemailAddress2">Nombre de la convocatoria: <span class="danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="wemailAddress2" name="emailAddress" placeholder="Cargo al que postula"> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="wphoneNumber2">Puesto de la convocatoria :<span class="danger">*</span> </label>
                                                    <input type="text" class="form-control required" id="wphoneNumber2" placeholder="Area/Unidad al que postula">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6><strong>Cronográma</strong></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="jobTitle2">Fecha Publicación:</label>
                                                    <input type="date" class="form-control required" id="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Fecha y Hora de Inicio Inscripción:</label>
                                                    <input type="datetime-local" class="form-control required" id="" value="2021-01-29T07:30:00">
                                                    <!--<div class="col-md-5">Hora inicio:<input class="form-control" type="time" value="18:00:00"></div>-->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Fecha y Hora de Fin Inscripción:</label>
                                                    <input type="datetime-local" class="form-control" id="" value="2021-01-31T22:00:00"> 
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 3 -->
                                    <h6><strong>Configuraciones</strong></h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="jobTitle2">Bases</label>
                                                    <input type="date" class="form-control required" id="" >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Anexos:</label>
                                                    <input type="date" class="form-control required" id=""></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Comunicados:</label>
                                                    <input type="date" class="form-control" id="">
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Example -->
                    <!-- ============================================================== -->
               {{-- wizard FIN--}}
              
            </div>
            {{-- <div class="modal-footer">
               <button type="button" class="btn btn-light"
               data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   {{-- Modal End --}}

               