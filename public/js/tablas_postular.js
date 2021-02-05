$(document).ready(function() {

    /*console.log("hola entre");
    
    console.log($('#datospostulante').serialize());
*/
    $('.group1').click(function(){
        if($(this).val()=='true'){
            $('#file_discapacidad').removeAttr('disabled');
        }else{
            $('#file_discapacidad').attr('disabled','disabled');
        }
    })
    $('.group2').click(function(){
        if($(this).val()=='true'){
            $('#file_ffaa').removeAttr('disabled');
        }else{
            $('#file_ffaa').attr('disabled','disabled');
        }
    })
    $('.group3').click(function(){
        if($(this).val()=='true'){
            $('#file_deportista').removeAttr('disabled');
        }else{
            $('#file_deportista').attr('disabled','disabled');
        }
    })
        
    $('#btn_guardardatos').on('click',function(){
    var discap;
    var ffaa;
    var depor;
      if($("#si_discapacidad").is(':checked')){ discap=1;}else{discap=0; }
      if($("#si_ffaa").is(':checked')){ ffaa=1;}else{ffaa=0; }
      if($("#si_deportista").is(':checked')){ depor=1;}else{depor=0; }
//var ddd= {!! json_encode($datos_usuario) !!};
//@json($datos_usuario);
    
   
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/actualizardatos",
            type: "POST" ,
            datatype: "json",
            data: {
                id: $("#di").val(),
                fechanac: $("#fecha_nacimiento").val(),
                ruc:$("#ruc").val(),
                ubigeodni: $("#ubigeodni").val(),
                nacionalidad: $("#nacionalidad").val(),
                celular: $("#telefono_celular").val(),
                telfijo: $("#telefono_fijo").val(),
                domicilio: $("#domicilio").val(),
                dicapacidad: discap,
                ffaa:ffaa,
                deportista: depor

            },
            success:function(data){
                console.log(data.mensaje);
                alert("datos guardados!!")
                $('#section1').load();
            },
            error: function(data){
                alert("error!!")

            }

        });

    })


    $('#btn_guardar_formacion').on('click',function(){
      /* var discap;
        var ffaa;
        var depor;
          if($("#si_discapacidad").is(':checked')){ discap=1;}else{discap=0; }
          if($("#si_ffaa").is(':checked')){ ffaa=1;}else{ffaa=0; }
          if($("#si_deportista").is(':checked')){ depor=1;}else{depor=0; }
    //var ddd= {!! json_encode($datos_usuario) !!};
    //@json($datos_usuario);
        */
       
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "/postulante/guardarformacion",
                type: "POST" ,
                datatype: "json",
                data: {
                    user_id: $("#di2").val(),
                    grado_id: $("#tipo_estudio").val(),
                    fecha_inicio:$("#fecha_inicio").val(),
                    fecha_fin: $("#fecha_fin").val(),
                    fecha_expedicion: $("#fecha_exp").val(),
                    centro_estudios: $("#centro_estudio_form").val(),
                    especialidad: $("#especialidad").val(),
                    ciudad: $("#ciudad_form").val(),
                    pais: $("#pais_form").val(),
                        
                },
                success:function(data){
                    console.log(data.mensaje);
                    alert("datos guardados!!");
                   // $('#zero_config1').DataTable().ajax.reload();
                    //$('#zero_config1').modal('hide'); 
                    var refreshId =  setInterval( function(){
                        $('#div_act').load('');//actualizas el div
                       }, 1000 );
                },
                error: function(data){
                    alert("error!!")
    
                }
    
            });
    
        }) 
/*
   if($('#si_deportista').prop('checked')) {
        $('#file_deportista').attr('enabled','true');
    }
    if($('#no_deportista').prop('checked')) {
        $('#file_deportista').attr('disabled','true');
    }
    */
})