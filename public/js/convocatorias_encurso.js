$(document).ready(function() {
    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/convocatorias/en_curso/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: []
    });

    $("#btn_guardar_resultado").click(function(){
        var formData = new FormData();
        formData.append('id', $("#id_proceso_r").val() );
        if( $("#archivo_resultado").attr("type") =="file" ){
            var file=document.getElementById('archivo_resultado').files[0];
            if(!file){ alert("Archivo vacio, no se puede guardar"); return false; }
            else{formData.append('archivo_resultado', file);}
        }else{
            if($("#archivo_resultado").val()==""){
                alert("dados vacios...");
                return false;
            }else{
                var archivo_resultado = $("#archivo_resultado").val();
                var resultado_archivo_tipo = "web"; 
                formData.append('archivo_resultado', archivo_resultado);
                formData.append('resultado_archivo_tipo', resultado_archivo_tipo);
            }

        }
        
    $.ajax({
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
        url:   "/convocatorias/update_resultado", //revisar la ruta
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
    })

    //cambiar tipo de entrada segun el check=> archivo o URL
    $(".resultado-check").change(function(){
        if( $(this).val() =="local"){   
            $("#div_resultado_file").html('<input type="file" class="form-control-file" id="archivo_resultado" name="archivo_resultado">');
        }else if ( $(this).val() =="web" ){
            $("#div_resultado_file").html('<input type="url" class="form-control" id="archivo_resultado" name="archivo_resultado">'); 
            $("#archivo_resultado").focus();
        }else{
            $("#div_resultado_file").html('<label>No definido</label>');
        }
    })

})
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
function ver_evaluacion(id){
    $.ajax({
        url:   "/convocatorias/show_evaluacion/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            if ( $("#proceso_id_evaluacion").length ) {
                $("#proceso_id_evaluacion").val(id);
            }
           
           $('#tabla_evaluacion_procesos tbody').html(response)
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
    $("#modal_evaluacion").modal("show"); 
    //$('#myTable tr:last').after('<tr>...</tr><tr>...</tr>');   
}
function guardar_evaluacion(){
    if( $("#nombre_nuevo_evaluacion").val()=="" ){
        $("#nombre_nuevo_evaluacion").focus();
        Swal.fire({
            //position: 'top-end',
            type: 'warning',
            title: 'El campo nombre está vacio',
            showConfirmButton: false,
            timer: 1500
        }) 
        return false;
    }
    var file=document.getElementById('file_evaluacion').files[0];
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
        formData.append('nombre', $("#nombre_nuevo_evaluacion").val());
        formData.append('proceso_id', $("#proceso_id_evaluacion").val());
        formData.append('_token', $('input[name=_token]').val());

    $.ajax({
        url:   "/convocatorias/guardar_evaluacion",
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
            document.getElementById("form_evaluacion").reset();
            ver_evaluacion($("#proceso_id_evaluacion").val()); 
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

function eliminar_evaluacion(evaluacion_id, proceso_id){
    Swal.fire({
        title: "¿Está seguro de desea ELIMINAR ?",
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
                url:   "/convocatorias/eliminar_evaluacion/"+evaluacion_id,
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
                    ver_evaluacion(proceso_id);
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



function resultado(id){ //esto se abrirá directo desde el boton, como no está cargando datos...
    $("#modal_resultado").modal("show");
    $("#id_proceso_r").val(id);
}
