$(document).ready(function() {
    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/convocatorias/vigentes/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: []
    }) 


    var form = $(".tab-wizard").show();
    $(".tab-wizard").steps({
        headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                next: "Siguiente",
                previous: "Anterior",
                finish: 'Terminar'
            },
            onStepChanging: function (event, currentIndex, newIndex) {
              return currentIndex > newIndex || (currentIndex < newIndex && ($(this).find(".body:eq(" + newIndex + ") label.error").remove(), $(this).find(".body:eq(" + newIndex + ") .error").removeClass("error")), $(this).validate().settings.ignore = ":disabled,:hidden", $(this).valid())
            },
            onFinishing: function (event, currentIndex) {
              return $(this).validate().settings.ignore = ":disabled", $(this).valid()
            },
        onFinished: function(event, currentIndex) {//cuando se termina todos los pasos
            //Swal.fire("Aquí escribir el AJAX para que mande el formulario, y sweet alert para que avise que se registró")
            Swal.fire({
                //title: '',
                text: "¿Está seguro de crear el PROCESO de CONVOCATORIA de PERSONAL?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',  
                cancelButtonText: 'No, cerrar',              
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si, registrar'
            }).then((result) => {
                if (result.value) {
                    //===========================
                    var route = $(this).data("route");
                    
                    var id_form=$(this).attr('id');
                    var data = $("#"+id_form).serializeArray();
                    var bases = $("#"+id_form+ " .archivo_bases"); 
                    var resolucion = $("#"+id_form+ " .archivo_resolucion"); 

                    var formData = new FormData();
                    data.forEach(element => {
                       if(!(element.name=="bases" || element.name=="resolucion" || element.name=="e_archivo_resolucion" || element.name=="e_archivo_bases")){//son nombres no válidos, que no tienen campos en la BD, pero necesarios para las vistas
                            formData.append(element.name,element.value);
                       }
                       
                    });
                    
                    
                    if(bases.attr("type") == "file"){
                        if(document.getElementById(bases.attr('id')).files[0]){
                            formData.append("archivo_bases", document.getElementById(bases.attr('id')).files[0] );
                        }
                    }else if (bases.attr("type") == "url"){
                        formData.append("archivo_bases", $("#"+bases.attr('id') ).val());
                        formData.append("archivo_bases_tipo", "web" );
                    }else{
                        alert("No hay base");
                    }

                    if(resolucion.attr("type") == "file"){
                        if(document.getElementById(resolucion.attr('id')).files[0]){
                            formData.append("archivo_resolucion", document.getElementById(resolucion.attr('id')).files[0] );
                        }
                    }else if (resolucion.attr("type") == "url"){
                        formData.append("archivo_resolucion", $("#"+resolucion.attr('id') ).val());
                        formData.append("archivo_resolucion_tipo", "web" );
                    }else{
                        alert("No hay resolucion");
                        //return false;
                    }
                    $.ajax({
                            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                            data:  formData,
                            url:   route,
                            type: 'POST',
                            cache:false,
                            contentType: false,
                            processData: false,
                        beforeSend: function () {
                            console.log('enviando....');
                        },
                        success:  function (response){
                            console.log("respuesta",response);
                           
                            
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'Se registró correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            })  
                            $('#zero_config').DataTable().ajax.reload();
                            $('.modal_nuevo_edit').modal('hide'); 
                            document.getElementById("form_nuevo").reset();
                            $("#form_nuevo").steps('reset');    
                            document.getElementById("form_editar").reset();
                            $("#form_editar").steps('reset');  
                            $("#n_resolucion_local").change();     $("#n_resolucion_local").click();
                            $("#n_bases_local").change();   $("#n_bases_local").click();
                        },
                        error: function (response){
                            console.log("Error",response.data);
                            Swal.fire({
                                title: "¡Error!",
                                text: response.responseJSON.message,
                                icon: "error",
                                timer: 3500,
                            })
                        }
                    });
                }
                              
            })
        }
       
        // ============>
    }), $(".tab-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })  
})

function editar(id){
    $("#form_editar").steps('reset');  
    $.ajax({
        url:   "/convocatorias/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            $("#id").val(response.id);
            $("#cod").val(response.cod);
            $("#tipo_id").val(response.tipo_id);
            $("#n_plazas").val(response.n_plazas);
            $("#nombre").val(response.nombre);
            $("#oficina").val(response.oficina);
            $("#descripcion").val(response.descripcion);
            $("#remuneracion").val(response.remuneracion);
            $("#nivel_acad_convocar").val(response.nivel_acad_convocar);
            $("#nivel_acad_evaluar").val(response.nivel_acad_evaluar);
            $("#especialidad").val(response.especialidad);
            $("#capacitaciones").val(response.capacitaciones);
            $("#habilidades").val(response.habilidades);
            

            $("#fecha_aprobacion").val(response.fecha_aprobacion);
            $("#fecha_publicacion").val(response.fecha_publicacion);
            $("#fecha_inscripcion_inicio").val(response.fecha_inscripcion_inicio);
            $("#fecha_inscripcion_fin").val(response.fecha_inscripcion_fin);
            $("#fecha_firma_contrato").val(response.fecha_firma_contrato);
            $("#duracion_contrato").val(response.duracion_contrato);
            
            $("#pje_min_cv").val(response.pje_min_cv);
            $("#pje_max_cv").val(response.pje_max_cv);
            $("#peso_cv").val(response.peso_cv);
            $("#pje_min_conoc").val(response.pje_min_conoc);
            $("#pje_max_conoc").val(response.pje_max_conoc);
            $("#peso_conoc").val(response.peso_conoc);
            $("#pje_min_entrev").val(response.pje_min_entrev);
            $("#pje_max_entrev").val(response.pje_max_entrev);
            $("#peso_entrev").val(response.peso_entrev);
            $("#anios_exp_lab_gen").val(response.anios_exp_lab_gen);
            $("#anios_exp_lab_esp").val(response.anios_exp_lab_esp);
            $("#horas_cap_total").val(response.horas_cap_total);
            $("#horas_cap_ind").val(response.horas_cap_ind);

            $("#hay_bon_pers_disc_"+response.hay_bon_pers_disc).prop("checked", true);
            $("#hay_bon_ffaa_"+response.hay_bon_ffaa).prop("checked", true);
            $("#hay_bon_deport_"+response.hay_bon_deport_).prop("checked", true);     
            
            if(response.archivo_resolucion_tipo == "web"){
                $("#e_res_web").change();
                $("#e_res_web").click();
                $("#e_archivo_resolucion").val(response.archivo_resolucion);
            }else{
                $("#e_res_local").change();
                $("#e_res_local").click();
            }

            if(response.archivo_bases_tipo == "web"){
                $("#e_bases_web").change();
                $("#e_bases_web").click();
                $("#e_archivo_bases").val(response.archivo_bases);
            }else{
                $("#e_bases_local").change();
                $("#e_bases_local").click();
            }
        },
        error: function (response){
            console.log("Error",response.data);
          Swal.fire({
              title: "¡Error!",
              text: response.responseJSON.message,
              icon: "error",
              timer: 3500,
          })

        }
    });
    $("#modal_editar").modal("show");
}

function ver_detalles(id){
    $.ajax({
        url:   "/convocatorias/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
           console.log("Resultados => ",response);
           $("#ver_cod").html(response.cod);
           $("#ver_n_plazas").html(response.n_plazas);
           $(".ocultar_elemento").prop("hidden", true);
           $("#ver_tipo_id_"+response.tipo_id).prop("hidden", false);
           $("#ver_remuneracion").html("S/ "+response.remuneracion);
           $("#ver_nombre").html(response.nombre);
           $("#ver_oficina").html(response.oficina);
           $("#ver_nivel_acad_convocar_"+response.nivel_acad_convocar).prop("hidden", false);

           $("#ver_exp_lab_gen").html(response.anios_exp_lab_gen);
           $("#ver_exp_lab_esp").html(response.anios_exp_lab_esp);
           $("#ver_postulacion").html("Desde: "+response.fecha_inscripcion_inicio+" <br> Hasta: "+response.fecha_inscripcion_fin);
           $("#ver_fecha_firma_contrato").html("Dia: "+response.fecha_firma_contrato);
           $("#ver_duracion_contrato").html(response.duracion_contrato)

           if(response.capacitaciones!= null){
                $("#ver_capacitaciones").html(response.capacitaciones);
                $("#div_ver_capacitaciones").prop("hidden", false);
           }
           if(response.especialidad != null){
                $("#div_ver_especialidad").prop("hidden", false);
                $("#ver_especialidad").html(response.especialidad);
           }
           if(response.habilidades!=null){
                $("#ver_habilidades").html(response.habilidades);
                $("#div_ver_habilidades").prop("hidden", false);
           }
           if(response.descripcion!=null){
                $("#ver_descripcion").html(response.descripcion);
                $("#div_ver_descripcion").prop("hidden", false);
           }
            $href_bases="#";
            if(response.archivo_bases != ""){
                $href_bases=response.archivo_bases.replace("public/", '/storage/');
            }
            $href_res="#";
            if(response.archivo_resolucion != ""){
                $href_res=response.archivo_resolucion.replace("public/", '/storage/');
            }
                $("#ver_bases").attr("href", $href_bases);
                $("#ver_resolucion").attr("href", $href_res);
           $("#modal_ver_mas").modal("show"); 
          
           
           
        },
        error: function (response){
            console.log("Error",response.data);
          Swal.fire({
              title: "¡Error!",
              text: response.responseJSON.message,
              icon: "error",
              timer: 3500,
          })
        }
    });
}

function ver_comunicados(id){
    $.ajax({
        url:   "/convocatorias/show_comunicados/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            if ( $("#proceso_id_comunicado").length ) {
                $("#proceso_id_comunicado").val(id);
            }
           
           $('#tabla_comunicados tbody').html(response)
        },
        error: function (response){
            console.log("Error",response.data);
          Swal.fire({
              title: "¡Error!",
              text: response.responseJSON.message,
              icon: "error",
              timer: 3500,
          })
        }
    });
    $("#modal_comunicados").modal("show"); 
    //$('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');   
}

function guardar_comunicado(){
    if( $("#nombre_nuevo_comunicado").val()=="" ){
        $("#nombre_nuevo_comunicado").focus();
        Swal.fire({
            //position: 'top-end',
            type: 'warning',
            title: 'El campo nombre está vacio',
            showConfirmButton: false,
            timer: 1500
        }) 
        return false;
    }
    var file=document.getElementById('file_comunicado').files[0];
    if(!file){
        Swal.fire({
            //position: 'top-end',
            type: 'warning',
            title: 'No hay archivo',
            showConfirmButton: false,
            timer: 1500
        }) 
        return false;
    }
    console.log("FILE1",file);

    var formData = new FormData();
        formData.append('archivo', file);
        formData.append('nombre', $("#nombre_nuevo_comunicado").val());
        formData.append('proceso_id', $("#proceso_id_comunicado").val());
        formData.append('_token', $('input[name=_token]').val());

    $.ajax({
        url:   "/convocatorias/guardar_comunicados",
        data:  formData,
        type: 'POST',
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log('enviando....');
        },
        success:  function (response){
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Se registró correctamente',
                showConfirmButton: false,
                timer: 1500
            }) 
            document.getElementById("form_comunicados").reset();
            ver_comunicados($("#proceso_id_comunicado").val()); 
            $('#zero_config').DataTable().ajax.reload();
        },
        error: function (response){
            console.log("Error",response.data);
            Swal.fire({
                title: "¡Error!",
                text: response.responseJSON.message,
                icon: "error",
                timer: 3500,
            })
        }
    });
}

function eliminar_comunicado(comunicado_id, proceso_id){
    Swal.fire({
        title: "¿Está seguro de desea ELIMINAR el COMUNICADO?",
        text: "Se borrarán todos los datos permanentemente",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',  
        cancelButtonText: 'No, cerrar',              
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        
        if (result.value) {
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                url:   "/convocatorias/eliminar_comunicado/"+comunicado_id,
                type: 'POST',
                beforeSend: function () {
                  console.log('enviando....');
                },
                success:  function (response){
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Se eliminó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                    ver_comunicados(proceso_id);
                    $('#zero_config').DataTable().ajax.reload();
                },
                error: function (response){
                    console.log("Error",response.data);
                  Swal.fire({
                      title: "¡Error!",
                      text: response.responseJSON.message,
                      icon: "error",
                      timer: 3500,
                  })
                }
            });
        }
    });

    
}

function eliminar_convocatoria(proceso_id){
    Swal.fire({
        title: "¿Está seguro de desea ELIMINAR el REGISTRO?",
        text: "Se borrarán todos los datos permanentemente",
        type: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',  
        cancelButtonText: 'No, cerrar',              
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        
        if (result.value) {
            $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                url:   "/convocatorias/eliminar_convocatoria/"+proceso_id,
                type: 'POST',
                beforeSend: function () {
                  console.log('enviando....');

                },
                success:  function (response){
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Se eliminó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                    // ver_comunicados(proceso_id);
                    $('#zero_config').DataTable().ajax.reload();
                },
                error: function (response){
                    console.log("Error",response.data);
                  Swal.fire({
                      title: "¡Error!",
                      text: response.responseJSON.message,
                      icon: "error",
                      timer: 3500,
                  })
                }
            });
        }
    });


}