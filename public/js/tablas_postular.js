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
        

    //  actualizar datos personales - section 1
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

// guardar formacion académica - section 2
    $('#btn_guardar_formacion').on('click',function(){
             
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
                   // console.log(data);
                    alert("datos guardados!! "+data.especialidad);
                   
                    
                  var fila = "<tr id='tblform"+data.id+"'>"+
                  "<td>"+data.grado_id+"</td>"+
                  "<td>"+data.especialidad+"</td>"+
                  "<td>"+data.centro_estudios+"</td>"+
                  "<td>"+data.fecha_expedicion+"</td>"+
                  "<td><button class='btn btn-info' >ver</button>"+
                   "   <button type='button' onclick=\"eliminar('tblform"+data.id+"');\" class=' btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
                  "</td>"+
                  "</tr>";
                   $('#zeroconfig1_body').prepend(fila); 
                   $('#modal_nueva_formacion').modal('hide');
                   //$('#zero_config1').DataTable().ajax.reload(); 
                    //var refreshId =  setInterval( function(){
                      //  $('#div_act').load();//actualizas el div
                       //}, 1000 );
                },
                error: function(data){
                    alert("error!!")
    
                }
    
            });
    
        }) 

// ______________________________-boton cancelar, ocultar modal - section 2
        $('#btn_can_formac').on('click',function(){
            $('#modal_nueva_formacion').modal('hide');
        })

//_________________________________ guardar curso capacitacion - section 3
$('#btn_guardar_capacitacion').on('click',function(){
    var es_curso_espec=0;
   var  es_ofimatica=0;
    var es_idioma=0;    
    if($("#tipo_capacitacion").val()==1){
        es_curso_espec=1;
        es_ofimatica=0;
        es_idioma=0;
    }
    if($("#tipo_capacitacion").val()==2){
        es_curso_espec=0;
        es_ofimatica=1;
        es_idioma=0;
    }
    if($("#tipo_capacitacion").val()==3){
        es_curso_espec=0;
        es_ofimatica=0;
        es_idioma=1;
    }

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/guardarcapacitacion",
        type: "POST" ,
        datatype: "json",
        data: {
           // user_id: $("#di2").val(),
           es_curso_espec: es_curso_espec,
           es_ofimatica: es_ofimatica,
           es_idioma: es_idioma,
           
           especialidad:$("#descripcion").val(),
           centro_estudios: $("#institucion").val(),
           pais: $("#pais_capacit").val(),
           ciudad: $("#ciudad_capacit").val(),
           fechainicio_capac: "",
           fechafin_capac: "",
           nivel_capa : $("#nivel_capa").val(),
           cantidad_horas: $("#horaslectivas").val(),  
                
        },
        success:function(data){
           // console.log(data);
            alert("datos guardados CAPACITACION!! ");
            var tipoestudio="";
            if(data.es_curso_espec==1){
                tipoestudio = "Curso/Especialización";
            }
            if(data.es_ofimatica==1){
                tipoestudio = "Ofimática";
            }
            if(data.es_idioma==1){
                tipoestudio = "Idioma";
            } 
            
          var fila = "<tr id='tblcapac"+data.id+"'>"+
          "<td>"+tipoestudio+"</td>"+
          "<td>"+data.especialidad+"</td>"+
          "<td>"+data.centro_estudios+"</td>"+
          "<td>"+data.cantidad_horas+"</td>"+
          "<td><button class='btn btn-info' >ver</button>"+
           "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data.id+"');\" class=' btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
          "</td>"+
          "</tr>";
           $('#zeroconfig2_body').prepend(fila); 
           $('#modal_nuevo').modal('hide');
           $('#total_horas').val(parseFloat($('#total_horas').val()) + parseFloat(data.cantidad_horas));
           //$('#zero_config1').DataTable().ajax.reload(); 
            //var refreshId =  setInterval( function(){
              //  $('#div_act').load();//actualizas el div
               //}, 1000 );
        },
        error: function(data){
            alert("error!!")

        }

    });

}) 

//__________________________________ boton cancelar, ocultar modal - section 3
$('#btn_can_capacitacion').on('click',function(){
    $('#modal_nuevo').modal('hide');
})

//_________________________________ guardar experiencia - section 4
//$('#btn_guardar_experiencia').on('click',function(){
  

// boton cancelar, ocultar modal - section 3
$('#btn_cancelar_exper').on('click',function(){
    $('#modal_nueva_experiencia').modal('hide');
    
})

})

//______________________FUNCIONES________________________________

// ______________________________GUARDAR NUEVA EXPERIENCIA USUARIO_________________________________

function guardar_experiencia(){ 
    var diasexpgen=0;
    var diasexpesp=0;
    var exp_general=0;
    var exp_especifica=0;
    var fechainicio=moment($("#fecha_inicio_exp").val());
    var fechafin=moment($("#fecha_fin_exp").val());
    var dias=fechafin.diff(fechainicio,"days");

    if($('#exp_general').prop('checked')){
        exp_general=1;
        diasexpgen=dias
    }else{
        exp_general=0;
    }
    if($('#exp_especifica').prop('checked')){
        exp_especifica=1;
        diasexpesp=dias;
    }else{
        exp_especifica=0;
    }
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/guardarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: {
           
            es_exp_gen:exp_general,
            es_exp_esp:exp_especifica,
            centro_laboral: $("#nombre_entidad").val(),
            cargo_funcion: $("#cargo_exp").val(),
            desc_cargo_funcion: $("#funciones_princi").val(),
            fecha_inicio: $("#fecha_inicio_exp").val(),
            fecha_fin : $("#fecha_fin_exp").val(),
            dias_exp_gen: diasexpgen,
            dias_exp_esp: diasexpesp,  
                
        },
        success:function(data){
           // console.log(data);
            alert("datos guardados EXPERIENCIA!! ");
            
            marcadogeneral="";
            marcadoespecifico="";
           if(data.es_exp_gen==1){marcadogeneral="checked";}
           if(data.es_exp_esp==1){marcadoespecifico="checked";}

          var fila = "<tr id='tblexp"+data.id+"'>"+
          "<td>falta tipo</td>"+
            "<td><p>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /></p><br>"+
            "<p>Exp.Específica <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></p></td>"+
            "<td>falta entidad</td>"+
            "<td>"+data.centro_laboral+"</td>"+
            "<td>"+data.cargo_funcion+"</td>"+
            "<td>"+data.fecha_inicio+"</td>"+
            "<td>"+data.fecha_fin+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button></td>"+
            "<td><button type='button' onclick=\"editar_expe('tblexp"+data.id+"');\" class='btn btn-warning' data-toggle=\"modal\" ><i class=\"fas fa-edit\"></i></button>"+
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data.id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
           $('#zeroconfig3_body').prepend(fila); 
           $('#modal_nueva_experiencia').modal('hide');
           
           //$('#zero_config1').DataTable().ajax.reload(); 
            //var refreshId =  setInterval( function(){
              //  $('#div_act').load();//actualizas el div
               //}, 1000 );
        },
        error: function(data){
            alert("error!!");

        }

    });

}

//______________________________ACTUALIZAR DATOS EXPERIENCIA_______________________

function actualizar_expe(transid){
    alert("estoy por actualizar tu experiencia" + transid);
    var id=transid.substring(6);

    var diasexpgen=0;
    var diasexpesp=0;
    var exp_general=0;
    var exp_especifica=0;
    var fechainicio=moment($("#fecha_inicio_exp").val());
    var fechafin=moment($("#fecha_fin_exp").val());
    var dias=fechafin.diff(fechainicio,"days");

    if($('#exp_general').prop('checked')){
        exp_general=1;
        diasexpgen=dias
    }else{
        exp_general=0;
    }
    if($('#exp_especifica').prop('checked')){
        exp_especifica=1;
        diasexpesp=dias;
    }else{
        exp_especifica=0;
    }
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/actualizarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: {
            id: id,
            es_exp_gen:exp_general,
            es_exp_esp:exp_especifica,
            centro_laboral: $("#nombre_entidad").val(),
            cargo_funcion: $("#cargo_exp").val(),
            desc_cargo_funcion: $("#funciones_princi").val(),
            fecha_inicio: $("#fecha_inicio_exp").val(),
            fecha_fin : $("#fecha_fin_exp").val(),
            dias_exp_gen: diasexpgen,
            dias_exp_esp: diasexpesp,  
                
        },
        success:function(data){
            console.log(data);
            //alert(data);
          var marcadogeneral="";
            var marcadoespecifico="";
           if(data[0].es_exp_gen==1){marcadogeneral="checked";}
           if(data[0].es_exp_esp==1){marcadoespecifico="checked";}
        
          var filahtml =
            "<td>falta tipo</td>"+
            "<td><p>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /></p><br>"+
            "<p>Exp.Específica <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></p></td>"+
            "<td>falta entidad</td>"+
            "<td>"+data[0].centro_laboral+"</td>"+
            "<td>"+data[0].cargo_funcion+"</td>"+
            "<td>"+data[0].fecha_inicio+"</td>"+
            "<td>"+data[0].fecha_fin+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button></td>"+
            "<td><button type='button' onclick=\"editar_expe('tblexp"+data[0].id+"');\" class='btn btn-warning' data-toggle=\"modal\" ><i class=\"fas fa-edit\"></i></button>"+
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data[0].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>";
            
            
            var iddd="tblexp"+data[0].id;
            $('#modal_nueva_experiencia').modal('hide');
            $("#"+iddd).html(filahtml);
           
           
           
          
        },
        error: function(data){
            alert("error!!");

        }
        
       

    });

   
}