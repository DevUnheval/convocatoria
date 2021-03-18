
                                <div class="row">
                                    <div class="col-sm-6 border border-secondary p-3 rounded bg-light">
                                        <br>
                                        <div align="center" >
                                            <img id="" src="/imagenes/users/user.png" width="60%" onerror="this.src='/imagenes/users/user.png';">
                                        </div>
                                        
                                        <small> DNI: </small>
                                        <h5 >{{$postulante->user->dni}}</h5>
                                        <small>  Apellidos y Nombres: </small>
                                        <h5> {{$postulante->user->apellido_paterno}} {{$postulante->user->apellido_materno}} {{$postulante->user->nombres}}</h5>
                                        <small> Carrera(s): </small>
                                        <h5> {{$postulante->get_especialidad()}}</h5>

                                        <br>
                                        <a class="btn btn-block btn-danger text-white" target="_blank" href="/reportes/cv/{{$postulante->id}}"> <i class="fa fa-file-pdf"></i> Descargar Currículum Vitae</a>
                                        <br>
                                    </div>
                                    <div class="col-sm-6">

                                        <small> EVALUACIÓN CURRICULAR (A)</small>
                                        <h5 > {{$postulante->ev_curricular}}</h5>
                                        <?php 
                                                $formula = "Ax(".$postulante->proceso->peso_cv.")";
                                                $Ptotal = $postulante->ev_curricular*$postulante->proceso->peso_cv;
                                        ?>
                                        @if($postulante->obs_curricular)
                                        <div id="div_observacion_curricular_mas">
                                            <small> OBSERVACIÓN </small>
                                            <h5><i>{{$postulante->obs_curricular}}</i></h5>
                                           
                                        </div>
                                        @endif
                                        <hr>
                                        @if($postulante->proceso->evaluar_conocimientos)
                                        <div id="div_conocimiento_mas">
                                            <small> EVALUACIÓN CONOCIMIENTO (B)</small>
                                            <h5> {{$postulante->ev_conocimiento}}</h5>
                                            <?php 
                                                $formula .= " + Bx(".$postulante->proceso->peso_conoc.")"; 
                                                $Ptotal+= $postulante->ev_conocimiento*$postulante->proceso->peso_conoc;
                                            ?>
                                            @if($postulante->obs_entrevista)
                                            <div id="div_observacion_conocimiento_mas">
                                                <small> OBSERVACIÓN </small>
                                                <h5><i> {{$postulante->obs_entrevista}}</i></h5>
                                            </div>
                                            @endif<hr>
                                        </div>
                                        @endif

                                        <small> EVALUACIÓN ENTREVISTA (C)</small>
                                        <h5> {{(float) $postulante->ev_entrevista}}</h5>
                                        <?php
                                                $formula .= " + Cx(".$postulante->proceso->peso_entrev.")"; 
                                                $Ptotal += (float) $postulante->ev_entrevista*$postulante->proceso->peso_entrev;
                                        ?>
                                        @if($postulante->obs_conocimiento)
                                        <div id="div_observacion_entrevista_mas">
                                            <small> OBSERVACIÓN </small>
                                            <h5><i> {{$postulante->obs_conocimiento}}</i></h5>
                                        </div>
                                        @endif
                                        <hr>

                                        <small> PUNTAJE TOTAL</small>
                                        <h5>  <i class="text-primary">FORMULA = {{$formula}}</i> = {{$Ptotal}}</h5>
                                            
                                    </div>
                                    <div class="col-sm-12 P-3">
                                        <br>
                                        <table class="table table-bordered">
                                            <thead class="bg-light">
                                                <tr  align="center">
                                                    <th colspan="3">BONIFICACIONES</th>
                                                </tr>
                                                
                                                <tr  align="center">
                                                    <th>Persona con discapacidad <br>({{ ($postulante->proceso->bon_pers_disc*100)}}% del puntaje TOTAL)</th>
                                                    

                                                    <th>Deportista calificado <br>({{($postulante->proceso->bon_deport*100)}}% del puntaje TOTAL)</th>
                                                    
                                                
                                                    <th>Deportista Lic. FFAA <br>({{($postulante->bon_ffaa*100)}}% del puntaje TOTAL)</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr  align="center">
                                                        <td>{{(float) $postulante->bonific_pers_disc}}</td>
                                                        <td>{{(float) $postulante->bonific_deportista}}</td>
                                                        <td>{{(float) $postulante->bonific_ffaa}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered">
                                            <thead class="bg-light">
                                                <tr  align="center">
                                                    <th colspan="4">RESULTADOS</th>
                                                </tr>
                                                <tr  align="center">
                                                    <th>PUNTAJE TOTAL</th>
                                                    <th>BONIFICACIONES</th>
                                                    <th>PUNTAJE FINAL</th>
                                                    <th>CONDICIÓN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr  align="center">
                                                        <td>{{$postulante->total}}</td>
                                                        <td>{{( $postulante->bonific_pers_disc + $postulante->bonific_deportista + $postulante->bonific_ffaa)}}</td>
                                                        <td>{{$postulante->final}}</td>
                                                        <td>{{$postulante->condicion}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>