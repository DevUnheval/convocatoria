$(document).ready(function() {
  
   //___________________________RECUPERAR DATOS DEL USUARIO EN CASO HUBIERA__________________
    $.get('/postulante/datosuser/data1',function (data){
    if(data.valor=="0"){
        console.log("esta vacio");
    }else{
        //console.log(data);
        $('#ruc').val(data[0].ruc);
        $('#ubigeodni').val(data[0].ubigeo_nacimiento);
        $('#nacionalidad').val(data[0].nacionalidad);
        $('#telefono_celular').val(data[0].telefono_celular);
        $('#telefono_fijo').val(data[0].telefono_fijo);
        $('#domicilio').val(data[0].domicilio);
        $('#fecha_nacimiento').val(data[0].fecha_nacimiento);
        $('#ubigeo_domicilio').val(data[0].ubigeo_domicilio);

        if(data[0].es_lic_ffaa==1){$("#si_ffaa").prop("checked", true);}else{$("#no_ffaa").prop("checked", true);}
        if(data[0].es_deportista==1){$("#si_deportista").prop("checked", true);}else{$("#no_deportista").prop("checked", true);}
        if(data[0].es_pers_disc==1){$("#si_discapacidad").prop("checked", true);}else{$("#no_discapacidad").prop("checked", true);}
    
    } 
});    
    
    //___________________________llenar tabla formacion académica__________________
    var tabla="";
    $.get('/postulante/formacion/data1',function (data){
        for (var i = 0; i < data.length; i++) {
            
            tabla += "<tr id='tblform"+data[i].id+"'>"+
            "<td>"+data[i].nombre+"</td>"+
            "<td>"+data[i].especialidad+"</td>"+
            "<td>"+data[i].centro_estudios+"</td>"+
            "<td>"+data[i].fecha_expedicion+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button>"+
             "   <button type='button' onclick=\"eliminar('tblform"+data[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig1_body').append(tabla);
    });

    //_______________________________llenar tabla cursos / capacitaciones______________________
    var tabla2="";
    var tipoestudio="";
    var totalhoras=0;
    $.get('/postulante/capacitaciones/data1',function (data2){
       
        for (var i = 0; i < data2.length; i++) {
            tipoestudio = "";
            totalhoras = totalhoras + parseFloat(data2[i].cantidad_horas);

            if(data2[i].es_curso_espec==1){
                tipoestudio = "Curso/Especialización";
            }
            if(data2[i].es_ofimatica==1){
                tipoestudio = "Ofimática";
            }
            if(data2[i].es_idioma==1){
                tipoestudio = "Idioma";
            }
            tabla2 += "<tr id='tblcapac"+data2[i].id+"'>"+
            "<td>"+tipoestudio+"</td>"+
            "<td>"+data2[i].especialidad+"</td>"+
            "<td>"+data2[i].centro_estudios+"</td>"+
            "<td>"+data2[i].cantidad_horas+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button>"+
             "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data2[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig2_body').append(tabla2);
    $('#total_horas').val(totalhoras);
        
    
    
    });

    //_______________________________llenar tabla EXPERIENCIAS______________________
    var tabla3="";
    //var ttiempoexp_gen=0;
    //var ttiempoexp_esp=0;
    $.get('/postulante/experiencias/data1',function (data3){
        var marcadogeneral="";
        var marcadoespecifico="";
        var totaldias_gen=0;
        var totaldias_esp=0;
        for (var i = 0; i < data3.length; i++) {
            //ttiempoexp_gen = ttiempoexp_gen + parseFloat(data3[i].dias_exp_gen);
            //ttiempoexp_esp = ttiempoexp_esp + parseFloat(data3[i].dias_exp_esp);
             marcadogeneral="";
             marcadoespecifico="";
             totaldias_gen=totaldias_gen+data3[i].dias_exp_gen;
             totaldias_esp=totaldias_esp+data3[i].dias_exp_esp;
            if(data3[i].es_exp_gen==1){marcadogeneral="checked";}
            if(data3[i].es_exp_esp==1){marcadoespecifico="checked";}
            
           
            tabla3 += "<tr id='tblexp"+data3[i].id+"'>"+
            "<td>"+data3[i].tipo_experiencia+"</td>"+
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
            "<td>"+data3[i].tipo_institucion+"</td>"+
            "<td>"+data3[i].centro_laboral+"</td>"+
            "<td>"+data3[i].cargo_funcion+"</td>"+
            "<td>"+data3[i].fecha_inicio+"</td>"+
            "<td>"+data3[i].fecha_fin+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button></td>"+
            "<td><button type='button' onclick=\"editar_expe('tblexp"+data3[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data3[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig3_body').append(tabla3);
    $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
    $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
    //$('#total_exp_general').val(ttiempoexp_gen);
    //$('#total_exp_especifica').val(ttiempoexp_esp);
     
    });

    //_________________________INICIO TAB WIZARD________________________________________________
    var form = $(".validation-wizard").show();
    
    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            next: "Siguiente",
            previous: "Anterior",
            finish: "REGISTRAR POSTULACIÓN"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
          var validar_paso={"estado":false, "msjok":"", "msjerror":""};
          //
          //{"estado":false, "msj1":"Error", "msj2":"Algo salio mal"};
          switch(currentIndex){
                case 0: validar_paso = guardardatos(); break; //mediante AJAX o jQuery.get() verificamos que cumpla y seteamos la variable validar_paso  
                case 1:  return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ; break;
                case 2: return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ; break;
                case 3: validar_paso = cumple_exp_genyesp(); break;
            }
           
            if(validar_paso.estado){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: validar_paso.msjok,
                    showConfirmButton: false,
                    timer: 2000
                })
           //     setTimeout(function(){
             //       return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ;
               // }, 2500);

                return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ;
               
            }else{
                Swal.fire({
                    type: 'error',
                    title: "¡Error!",
                    text: validar_paso.msjerror,
                    icon: "error",
                    timer: 3500,
                })
                return false;
            }
           
        }, 
        onFinishing: function(event, currentIndex) {
            
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
           
        }, 
        
    }), $(".validation-wizard").validate({
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

 
//________________________________FIN DE TAB WIZARD_____________________________________________________________-

//____________________________funcion eliminar formacion academica_____________
function eliminar(transid){
    //alert("holas : "+transid);
    var id=transid.substring(7);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarformacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){

            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: "Formacion eliminada",
                showConfirmButton: false,
                timer: 1500
            })
        },
        error: function(data){
            alert("error!!"+data); }

    });

    $('#'+transid).remove();
 }


 //________________________funcion eliminar capacitacion______________________________________
 function eliminarcapac(transid){
    
    var id=transid.substring(8);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarcapacitacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
           
           $('#'+transid).remove();
           
           //alert(data.cantidad_horas);
           $('#total_horas').val(parseFloat($('#total_horas').val()) - parseFloat(data[0].cantidad_horas));//totalhrs +=data2[i].cantidad_horas;

           Swal.fire({
            position: 'top-end',
            type: 'error',
            title: "Curso eliminado",
            showConfirmButton: false,
            timer: 1500
        })
        },
        error: function(data){
            alert("error!!"+data); }

    });

    
 }
 //________________________funcion eliminar EXPERIENCIA______________________________________
 function eliminar_expe(transid){
    //alert("holas : "+transid);
    var id=transid.substring(6);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
           
           $('#'+transid).remove();
           Swal.fire({
            position: 'top-end',
            type: 'error',
            title: "Experiencia eliminada",
            showConfirmButton: false,
            timer: 1500
        })
        },
        error: function(data){
            alert("error!!"+data); }

    });
 }
//_______________________________NUEVA EXPERIENCIA VER FORMULARIO (LIMPIA LOS CAMPOS INPUT) 
function nueva_expe(){   
    var htmlbotones="<button onclick=\"guardar_experiencia();\" class=\"btn btn-success waves-effect waves-light\" type=\"button\">Guardar</button>";
    
    $('#div_btns_exper').html(htmlbotones);
   
    $("#modal_nueva_experiencia").modal("show");
    
          $('#exp_general').attr("checked",true);
          $('#exp_especifica').removeAttr("checked");
          $("#nombre_entidad").val("");
          $("#tipo_experiencia").val("0");
          $("#tipo_entidad").val("0");
          $("#cargo_exp").val("");
          $("#funciones_princi").val("");
          $("#fecha_inicio_exp").val("");
          $("#fecha_fin_exp").val("");
        
    
 }

//_______________________________EDITAR EXPERIENCIA (ABRIR MODAL Y RECUPERAR DATOS PARA MOSTRAR EN LOS INPUT)___________________
 function editar_expe(transid){
    
    var htmlbotones="<button onclick=\"actualizar_expe('"+transid+"');\" class=\"btn btn-warning waves-effect waves-light\" type=\"button\">Guardar</button>";

    $('#div_btns_exper').html(htmlbotones);
    
    $("#modal_nueva_experiencia").modal("show");
      var id=transid.substring(6);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/editarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
           alert("datos recibidos");
           console.log(data);
          if(data[0].es_exp_gen==1){$('#exp_general').attr("checked",true);}else{
            $('#exp_general').removeAttr("checked"); 
          }
          if(data[0].es_exp_esp==1){$('#exp_especifica').attr("checked",true);}else{
            $('#exp_especifica').removeAttr("checked");
          }

          $("#tipo_entidad").val("'"+data[0].tipo_institucion+"'");
          $("#tipo_experiencia").val("'"+data[0].tipo_experiencia+"'");
          $("#nombre_entidad").val(data[0].centro_laboral);
          $("#cargo_exp").val(data[0].cargo_funcion);
          $("#funciones_princi").val(data[0].desc_cargo_funcion);
          $("#fecha_inicio_exp").val(data[0].fecha_inicio);
          $("#fecha_fin_exp").val(data[0].fecha_fin);
          

        },
        error: function(data){
            alert("error!!"+data); }

    });
 }

//_______________________________guardar o actualizar datos personales - section 1____________________________
    
function guardardatos(){
    var discap=0;
    var ffaa=0;
    var depor=0;
    var valor;
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
               // id: $("#di").val(),
                fechanac: $("#fecha_nacimiento").val(),
                ruc:$("#ruc").val(),
                ubigeodni: $("#ubigeodni").val(),
                nacionalidad: $("#nacionalidad").val(),
                celular: $("#telefono_celular").val(),
                telfijo: $("#telefono_fijo").val(),
                domicilio: $("#domicilio").val(),
                ubigeo_domicilio:$("#ubigeo_domicilio").val(),
                dicapacidad: discap,
                ffaa:ffaa,
                deportista: depor

            },
            success:function(data){
               console.log("correcto");
            },
            error: function(data){
                console.log("error");
            }

        });

       return {'estado':true,'msjok':'datos guardados correctamente','msjerror':'error en guardar datos'};
    }

 

 function cumplehoras_totales(hrsminima_total,mihrs_total){
    var resultado; 
    if(mihrs_total<hrsminima_total){
        resultado = true;
     }else{
         resultado = false;
     }
     
  return resultado;
 }
 
function cumple_exp_genyesp(){
    var arrayExp={estado:"",msjok:"",msjerror:""};
    
    var aa = $.get('/postulante/datosexpgenyesp',function (data){
        
        //var b={'suma_expgen':data.suma_expgen,'suma_expesp':suma_data.suma_expesp};
   
    });

    var jqxhr = $.ajax( "/postulante/datosexpgenyesp" )
  .done(function(data) {
    console.log(data);
  });

  console.log('jqxhr=> ',jqxhr);
  console.log('=> ',jqxhr.responseJSON);
    //console.log(aa[responseJSON.suma_expesp]);
    console.log(aa);
    //console.log("hola",aa.responseText.suma_expgen);
    //console.log(JSON.parse(aa));
    //console.log(aa.responseJSON[0].suma_expgen);
       /* if(Mi_exp_gen<Exp_gen_min){
        arrayExp.estado=false;
        arrayExp.msjerror="No cumple con la experiencia general mínima";
        return arrayExp;
    }else if(Mi_exp_esp<Exp_esp_min){
        arrayExp.estado=false;
        arrayExp.msjerror="No cumple con la experiencia específica mínima";
        return arrayExp;
    }else{
        arrayExp.estado=true;
        arrayExp.msjok="Usted cumple con el requisito mínimo de experiencia";
        return arrayExp;
    }

*/
}

function cumple_formacion(){
    var arrayExp={estado:"",msjok:"",msjerror:""};
    

   /* if(Mi_exp_gen<Exp_gen_min){
        arrayExp.estado=false;
        arrayExp.msjerror="No cumple con la experiencia general mínima";
        return arrayExp;
    }else if(Mi_exp_esp<Exp_esp_min){
        arrayExp.estado=false;
        arrayExp.msjerror="No cumple con la experiencia específica mínima";
        return arrayExp;
    }else{
        arrayExp.estado=true;
        arrayExp.msjok="Usted cumple con el requisito mínimo de experiencia";
        return arrayExp;
    }

*/
}


 function cumple_exp_gen(mi_exp,exp_totalmin){
    var resultado; 
    if(mi_exp<exp_totalmin){
        resultado = true;
     }else{
         resultado = false;
     }
     
  return resultado;
 }
 function cumple_exp_esp(mi_exp,exp_totalmin){
    var resultado; 
    if(mi_exp<exp_totalmin){
        resultado = true;
     }else{
         resultado = false;
     }
     
  return resultado;
 }

 function anios_meses_dias(diasx){
    var anios;
    var meses;
    var dias;
    anios= Math.trunc(diasx/365); 
    meses= Math.trunc((diasx%365)/30);
    dias =(diasx%365)%30;
    
     
  return anios+" año(s) "+meses+" mes(es) "+dias+" dia(s)";
 }

 