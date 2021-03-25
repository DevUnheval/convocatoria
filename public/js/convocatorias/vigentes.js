
function anios_meses_dias(diasx){
    var anios;
    var meses;
    var dias;
    var anios_desc="";
    var meses_desc="";
    var dias_desc="";
    anios= Math.trunc(diasx/365); 
    meses= Math.trunc((diasx%365)/30.4);
    dias =Math.round((diasx%365)%30.4);

    if(anios == 0){
        anios_desc = "";
        anios = "";
    }else if(anios == 1){
        anios_desc = "año";
    }else if(anios > 1){
        anios_desc = "años";
    }

    if(meses == 0){
        meses_desc = "";
        meses = "";
    }else if(meses == 1){
        meses_desc = "mes";
    }else if(meses > 1){
        meses_desc = "meses";
    }

    if(dias == 0){
        dias_desc = "";
        dias = "";
    }else if(dias == 1){
        dias_desc = "dia";
    }else if(dias > 1){
        dias_desc = "dias";
    }
  return anios+" "+anios_desc+" "+meses+" "+meses_desc+" "+dias+" "+dias_desc;
 }

function ver_detalles(id){
    $.ajax({
        url:   "/convocatorias/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
          // console.log("Resultados => ",response);
           $("#ver_cod").html(response.cod);
           $("#ver_n_plazas").html(response.n_plazas);
           $(".ocultar_elemento").prop("hidden", true);
           $("#ver_tipo_id_"+response.tipo_id).prop("hidden", false);
           $("#ver_remuneracion").html("S/ "+response.remuneracion);
           $("#ver_nombre").html(response.nombre);
           $("#ver_oficina").html(response.oficina);
           $("#ver_nivel_acad_convocar_"+response.nivel_acad_convocar).prop("hidden", false);

           $("#ver_dias_exp_lab_gen").html(anios_meses_dias(response.dias_exp_lab_gen));
           
           $("#ver_dias_exp_lab_esp").html(anios_meses_dias(response.dias_exp_lab_esp));
           $("#ver_postulacion").html("Desde: "+response.fecha_inscripcion_inicio+" <br> Hasta: "+response.fecha_inscripcion_fin);
           $("#ver_fecha_firma_contrato").html(response.fecha_firma_contrato);
           $("#ver_duracion_contrato").html(response.duracion_contrato);
           
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
           if(response.duracion_contrato!=null){
            $("#ver_duracion_contrato").html(response.duracion_contrato);
            $("#div_ver_duracion_contrato").prop("hidden", false);
            }
            if(response.fecha_firma_contrato!=null){
                $("#ver_fecha_firma_contrato").html(response.fecha_firma_contrato);
                $("#div_ver_firma_contrato").prop("hidden", false);
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
                    if(response=="error"){
                        Swal.fire({
                            //position: 'top-end',
                            type: 'warning',
                            title: 'No se puede eliminar',
                            text: 'Este proceso/convocatoria tiene postulantes registrados',
                            showConfirmButton: false,
                            timer: 2500
                        }) 
                    }else if(response=="exito"){
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Se eliminó correctamente',
                            showConfirmButton: false,
                            timer: 1500
                        }) 
                    }
                    
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

function iniciar_sesion($proceso_id){
    $("#bnt_iniciar_sesion").attr("data-proceso",$proceso_id);
    $("#modal_invitado").modal("show");
} 

$("#bnt_iniciar_sesion").click(function() {
    const proceso = $(this).data("proceso");
    $.ajax({
        url:   "/ruta_temporal/"+proceso,
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (){
            location.href = '/login';
            //$(location).attr('href', `/postulantes/${$proceso_id}/${$nueva_etapa}/${$vista}/listar`);
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
})


