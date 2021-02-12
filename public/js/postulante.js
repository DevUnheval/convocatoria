$(document).ready(function() {
  
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
            "<td>"+data[i].grado_id+"</td>"+
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
        for (var i = 0; i < data3.length; i++) {
            //ttiempoexp_gen = ttiempoexp_gen + parseFloat(data3[i].dias_exp_gen);
            //ttiempoexp_esp = ttiempoexp_esp + parseFloat(data3[i].dias_exp_esp);
             marcadogeneral="";
             marcadoespecifico="";
            if(data3[i].es_exp_gen==1){marcadogeneral="checked";}
            if(data3[i].es_exp_esp==1){marcadoespecifico="checked";}
            
           
            tabla3 += "<tr id='tblexp"+data3[i].id+"'>"+
            "<td>falta tipo</td>"+
            "<td><p>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /></p><br>"+
            "<p>Exp.Específica <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></p></td>"+
            
            "<td>falta entidad</td>"+
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
            finish: "Registrar Postulación"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            //var validar_paso = validar_paso(currentIndex, newIndex);
            // alert(validar_paso);

            //aquí validamos dependiendo el PASO actual: currentIndex
            var validar_paso = 
            //{"estado":true, "msj1":"Éxito", "msj2":"Se guardaron los cambios"};
            {"estado":false, "msj1":"Error", "msj2":"Algo salio mal"};

            switch(currentIndex){
                case 0: validar_paso = guardar(); break; //mediante AJAX o jQuery.get() verificamos que cumpla y seteamos la variable validar_paso  
                case 1: console.log("Formación Académica"); break;
                case 2: console.log("Cursos y/o especializaciones"); break;
                case 3: console.log("Experiecia Laboral"); break;
            }
           
            if(validar_paso.estado){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: validar_paso.msj2,
                    showConfirmButton: false,
                    timer: 1500
                })
                return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) 
            }else{
                Swal.fire({
                    type: 'error',
                    title: "¡Error!",
                    text: validar_paso.msj2,
                    icon: "error",
                    timer: 3500,
                })
                return false;
            }
                
        }, 
        onFinishing: function(event, currentIndex) {
            alert("hola 2");
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            alert("hola"); 
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
            alert("hola 3");
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })



    
/*
$("#example-vertical").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: "vertical"
});

//Custom design form example
$(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onFinished: function(event, currentIndex) {
        swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

    }
});
*/
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
           alert("fila eliminada!!"+data);
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
           alert("fila eliminada!!"+data);
           $('#'+transid).remove();
           console.log(data);
           //alert(data.cantidad_horas);
           $('#total_horas').val(parseFloat($('#total_horas').val()) - parseFloat(data[0].cantidad_horas));//totalhrs +=data2[i].cantidad_horas;
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
           alert("fila eliminada!!"+data);
           $('#'+transid).remove();
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



 







