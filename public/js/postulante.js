$(document).ready(function() {
          
    

   //___________________________RECUPERAR DATOS DEL USUARIO EN CASO HUBIERA__________________
   
   $.get('/postulante/datosuser/recuperar_ubigeo',function (data){
       // console.log(data); 
        
        if(data.nacionalidad == "Peruano(a)"){
            //$('#ubigeodni').prop('id','nose');
            $('#html_lugar_nac2').hide();
            $('#html_lugar_nac').show();
            $("#nacionalidad option[value='Peruano(a)']").prop('selected',true);
            
            var html_nac = "<option value='"+data.cod_nac+"'>"+data.desc_u_nac+"</option>";
            if(data.cod_nac != ""){
                $('#ubigeodni').html(html_nac);
            }
        }else  if(data.nacionalidad == "Extranjero(a)"){
            $('#ubigeodni').removeClass('required');
            $('#ubigeodni').prop('id','vacio');
            $('#html_lugar_nac').hide();
            $('#html_lugar_nac2').show();
            $('#ubigeodni_alt').prop('id','ubigeodni');
            $('#ubigeodni').addClass('required');
            $('#vacio').prop('id','ubigeodni_alt');
            
            $("#nacionalidad option[value='Extranjero(a)']").prop('selected',true);
            $('#ubigeodni').val(data.cod_nac);
            
        }else{
            $("#nacionalidad option[value='']").prop('selected',true);
        }
        
        
        var html_dom = "<option value='"+data.cod_dom+"'>"+data.desc_u_dom+"</option>";
       
        if(data.cod_dom != ""){
        $('#ubigeo_domicilio').html(html_dom);
        }
    }); 

    $.get('/postulante/datosuser/data1',function (data){
        if(data.valor=="0"){
            //console.log("esta vacio");
            $('#input_hide').val('0');
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
           
            
            var href_dni="#";
            var href_deport="#";
            var href_disc="#";
            var href_ffaa="#";
   
            if(data[0].archivo_dni != null){
             href_dni=data[0].archivo_dni.replace("public/", '/storage/');
             var htmldni = "<td><a href='"+href_dni+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                $('#btn_doc_dni').html(htmldni);
                $('#input_hide_dni').val('1');
            }
     
           
            if(data[0].es_lic_ffaa==1){
                $("#si_ffaa").prop("checked", true);
                if(data[0].archivo_ffaa != null){
                   href_ffaa=data[0].archivo_ffaa.replace("public/", '/storage/');
                   var htmlffaa = "<td><a href='"+href_ffaa+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                       $('#btn_doc_ffaa').html(htmlffaa);
                       $('#input_hide_ffaa').val('1');
                   }
   
           }else{$("#no_ffaa").prop("checked", true); $('#file_ffaa').prop('disabled',true);}
            
           if(data[0].es_deportista==1){
                $("#si_deportista").prop("checked", true);
                if(data[0].archivo_deport != null){
                   href_deport=data[0].archivo_deport.replace("public/", '/storage/');
                   var htmldeport = "<td><a href='"+href_deport+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                       $('#btn_doc_deport').html(htmldeport);
                       $('#input_hide_deport').val('1');
                   }
           }else{$("#no_deportista").prop("checked", true); $('#file_deportista').prop('disabled',true);}
   
            if(data[0].es_pers_disc==1){
                $("#si_discapacidad").prop("checked", true);
                if(data[0].archivo_disc != null){
                   href_disc=data[0].archivo_disc.replace("public/", '/storage/');
                   var htmldisc = "<td><a href='"+href_disc+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                       $('#btn_doc_disc').html(htmldisc);
                       $('#input_hide_disc').val('1');
                   }  
           }else{$("#no_discapacidad").prop("checked", true); $('#file_discapacidad').prop('disabled',true);}
        
        } 
    });  
    
    //___________________________llenar tabla formacion académica__________________
    var tabla="";
    
    $.get('/postulante/formacion/data1',function (data){
        for (var i = 0; i < data.length; i++) {
            
            var href_form_ll="#";
            if(data[i].archivo != null){
                href_form_ll = data[i].archivo.replace('public/','/storage/');
            }
            tabla += "<tr id='tblform"+data[i].id+"'>"+
            "<td>"+data[i].nombre+"</td>"+
            "<td>"+data[i].especialidad+"</td>"+
            "<td>"+data[i].centro_estudios+"</td>"+
            "<td>"+data[i].fecha_expedicion+"</td>"+
            "<td><a href='"+href_form_ll+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_form('tblform"+data[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
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

           if(data2[i].cantidad_horas >= parseInt($('#horas_cap_ind').val())){
            var href_form_ca="#";
            if(data2[i].archivo != null){
                href_form_ca = data2[i].archivo.replace('public/','/storage/');
            }

            tipoestudio = "";
           // totalhoras = totalhoras + parseFloat(data2[i].cantidad_horas);

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
            "<td><a href='"+href_form_ca+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_capac('tblcapac"+data2[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
             "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data2[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
            }

        }
    
    $('#zeroconfig2_body').append(tabla2);
    //$('#total_horas').val(totalhoras);
        
    
    
    });

    //_______________________________llenar tabla EXPERIENCIAS______________________
    var tabla3="";
    //var ttiempoexp_gen=0;
    //var ttiempoexp_esp=0;
   
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/experiencias/data1/",
        type: "GET" ,
        datatype: "json",
        data: {idproceso: $('#datospostulante').data('id')},
        success:function(data3){
            //console.log(data3);
        var marcadogeneral="";
        var marcadoespecifico="";
        var tipo_exp= "";
        var totaldias_gen=0;
        var totaldias_esp=0;
        for (var i = 0; i < data3.query.length; i++) {
            
            

            totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
            totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
            /*   if(data3.proceso.consid_prac_preprof == 1 && data3.proceso.consid_prac_prof == 1){
                totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
                 totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
              }else if(data3.proceso.consid_prac_preprof == 0 && data3.proceso.consid_prac_prof == 1){
                  if(data3.query[i].tipo_experiencia != 2){
                    totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
                    totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
                  }
              }else if(data3.proceso.consid_prac_preprof == 1 && data3.proceso.consid_prac_prof == 0){
                if(data3.query[i].tipo_experiencia != 3){
                    totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
                    totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
                  }
              }
            */
            marcadogeneral="";
            marcadoespecifico="";
            tipo_exp="";  
            if(data3.query[i].es_exp_gen==1){marcadogeneral="checked";}
            if(data3.query[i].es_exp_esp==1){marcadoespecifico="checked";}
            //<option value=1>Experiencia Laboral</option>
            //<option value=2>Prácticas Pre Profesionales</option>
            //<option value=3>Prácticas Profesionales</option>
              if(data3.query[i].tipo_experiencia == '1'){
                tipo_exp="Experiencia Laboral";
              }else if(data3.query[i].tipo_experiencia == '2'){
                tipo_exp="Prácticas Pre Profesionales";
              }else if(data3.query[i].tipo_experiencia == '3'){
                tipo_exp="Prácticas Profesionales";
              }

            var href_exp_ll="#";
           if(data3.query[i].archivo != ""){
            href_exp_ll=data3.query[i].archivo.replace("public/", '/storage/');
           }
           

            tabla3 += "<tr id='tblexp"+data3.query[i].id+"'>"+
            "<td>"+tipo_exp+"</td>"+
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
            "<td>"+data3.query[i].centro_laboral+"</td>"+
            "<td>"+data3.query[i].cargo_funcion+"</td>"+
            "<td>"+data3.query[i].fecha_inicio+"</td>"+
            "<td>"+data3.query[i].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data3.query[i].dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp_ll+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_expe('tblexp"+data3.query[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
            "    <button type='button' onclick=\"eliminar_expe('tblexp"+data3.query[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig3_body').append(tabla3);
    
    $('#exp_gen_pro').html(anios_meses_dias(parseInt(data3.proceso[0].anios_exp_lab_gen)));
    $('#exp_esp_pro').html(anios_meses_dias(parseInt(data3.proceso[0].anios_exp_lab_esp)));
    
    $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
    $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
    //$('#total_exp_general').val(ttiempoexp_gen);
    //$('#total_exp_especifica').val(ttiempoexp_esp);

        },error: function(data){
            alert("error!!");

        }
        
       

    });
        

    //__________________________________________________________________________________________
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
          var validar_paso;

          if(newIndex<currentIndex){
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ;
          }
                   
          switch(currentIndex){
                case 0: validar_paso = guardardatos(); break; //mediante AJAX o jQuery.get() verificamos que cumpla y seteamos la variable validar_paso  
                case 1: validar_paso = cumple_formacion($('#datospostulante').data('id')); break; 
                case 2: return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ; break;
                case 3: validar_paso = cumple_exp_genyesp(); break;
                case 4: validar_paso = declaracion_jurada(); break;
            }
           
            if(validar_paso.estado){
               /* Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: validar_paso.msjok,
                    showConfirmButton: false,
                    timer: 2000
                })*/
                   return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ;
            } else{
                Swal.fire({
                    type: 'warning',
                    title: "¡Información!",
                    text: validar_paso.msjerror,
                    timer: null
                })
                return false;
            }
           
        }, 
        onFinishing: function(event, currentIndex) {
            
            return form.validate().settings.ignore = ":disabled", form.valid();
            
        },
        onFinished: function(event, currentIndex) {

           Swal.fire({
                title: '¿Está seguro de registrar su postulación?',
                text: "Recuerde que una vez registrado no podrá modificar ninguna información",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',  
                cancelButtonText: 'No, cerrar',              
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si, registrar'
            }).then((result) => {
               

                if(result.value){

                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: "/postulante/registrofinal",
                        type: "POST",
                        datatype: "json",
                        data: { 
                            idproceso:$('#datospostulante').data('id'),
                            dj1:$('input:radio[name=g1]:checked').val(),
                            dj2:$('input:radio[name=g2]:checked').val(),
                            dj3:$('input:radio[name=g3]:checked').val(),
                            dj4:$('input:radio[name=g4]:checked').val(),
                            dj5:$('input:radio[name=g5]:checked').val(),
                            dj6:$('input:radio[name=g6]:checked').val(),
                            dj7:$('input:radio[name=g7]:checked').val(),
                            dj8:$('input:radio[name=g8]:checked').val(),
                            dj9:$('input:radio[name=g9]:checked').val()
                         },
                        success:function(data){
                            console.log(data);
                        var url = "/postulante/registro/"+$('#datospostulante').data('id');
                        $(location).attr('href',url);
                        },
                        error: function(data){
                            alert("error!!"); }
                
                    });
                   
                   
                   
                    
                }

            })

            
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

 //______________________________________________________________________________________________________________
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
            alert("error!!"); }

    });

    $('#'+transid).remove();
 }

//___________________nueva formacion , abrir modal y limpiar los campos____________

function nueva_forma(){   
    var htmlbotones="<button onclick=\"guardar_formac();\" class=\"btn btn-success waves-effect waves-light\" type=\"button\">Guardar</button>";
    $("#header-formacion").addClass("bg-success");
    $("#header-formacion").removeClass("bg-warning");
    $('#div_btn_formacion').html(htmlbotones);
    $("#documento_formac").prop('required',true);
    $("#documento_formac").val('');
   
    $("#modal_nueva_formacion").modal("show");
    
        $('#especialidad').prop('disabled',false);
        $('#especialidad').val("");    
    
    $("#tipo_estudio option[value='']").prop('selected',true);
    $("#fecha_inicio").val("");
   $("#fecha_fin").val("");
     $("#fecha_exp").val("");
   $("#centro_estudio_form").val("");
    
    $("#ciudad_form").val("");
    $("#pais_form").val("");
        
    
 }

//________________________________editar formacion académica(abrir modal y cargar datos de la formación seleccionada)_________________________
    function editar_form(transid){
        var htmlbotones="<button onclick=\"actualizar_formac('"+transid+"');\" class=\"btn btn-warning waves-effect waves-light\" type=\"button\">Guardar</button>";
    $("#header-formacion").removeClass("bg-success");
    $("#header-formacion").addClass("bg-warning");
    $('#div_btn_formacion').html(htmlbotones);
    $("#documento_formac").prop('required',false);
    $("#documento_formac").val('');
    
    $("#modal_nueva_formacion").modal("show");
      var id=transid.substring(7);
      
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/editarformacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
          
            if(parseInt(data[0].grado_id) == 2 || parseInt(data[0].grado_id) == 3){
                $('#especialidad').prop('disabled',true);
            }else{
                $('#especialidad').prop('disabled',false);
                $('#especialidad').val(data[0].especialidad);
            }
            
            $("#tipo_estudio option[value='"+data[0].grado_id+"']").prop('selected',true);
            $("#fecha_inicio").val(data[0].fecha_inicio);
           $("#fecha_fin").val(data[0].fecha_fin);
             $("#fecha_exp").val(data[0].fecha_expedicion);
           $("#centro_estudio_form").val(data[0].centro_estudios);
            
            $("#ciudad_form").val(data[0].ciudad);
            $("#pais_form").val(data[0].pais);
         
        },
        error: function(data){
            alert("error!!"); }

    });
    }
 
//_______________nueva capacitacion - abrir modal y limpiar campos___________________________________________
function nueva_capacitacion(){   
    var htmlbotones="<button onclick=\"guardar_capacitacion();\" class=\"btn btn-success waves-effect waves-light\" type=\"button\">Guardar</button>";
$("#header-capacitacion").addClass("bg-success");
$("#header-capacitacion").removeClass("bg-warning");
$('#div_btn_capacitacion').html(htmlbotones);
$("#documento_capa").prop('required',true);
$("#documento_capa").val('');

$("#modal_nuevo").modal("show");
    
$("#tipo_capacitacion option[value='']").prop('selected',true);
$("#descripcion").val("");
$("#institucion").val("");
$("#pais_capacit").val("");
$("#ciudad_capacit").val("");
$("#fechainicio_capac").val("");
$("#fechafin_capac").val("");
$("#horaslectivas").val("");
$('#nivel_capa').val("");
        
    
 }



//_______________________funcion editar capacitacion abrir modal y recuperar datos de la fila selccionada___________

function editar_capac(transid){
    var htmlbotones="<button onclick=\"actualizar_capac('"+transid+"');\" class=\"btn btn-warning waves-effect waves-light\" type=\"button\">Guardar</button>";
$("#header-capacitacion").removeClass("bg-success");
$("#header-capacitacion").addClass("bg-warning");
$('#div_btn_capacitacion').html(htmlbotones);
$("#documento_capa").prop('required',false);
$("#documento_capa").val('');

$("#modal_nuevo").modal("show");
  var id=transid.substring(8);
  
$.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: "/postulante/editarcapacitacion",
    type: "POST" ,
    datatype: "json",
    data: { id:id },
    success:function(data){
      var tipocap_sel=0;
        if(data[0].es_curso_espec==1){
            tipocap_sel = 1;
            $('#nivel_capa').prop('disabled',true);
            $('#nivel_capa').prop('required',false);
            $('#nivel_capa').val('');
        }
        if(data[0].es_ofimatica==1){
            tipocap_sel = 2;
            $('#nivel_capa').prop('disabled',false);
            $('#nivel_capa').prop('required',true);
            $('#nivel_capa').val(data[0].nivel);
        }
        if(data[0].es_idioma==1){
            tipocap_sel = 3;
            $('#nivel_capa').prop('disabled',false);
            $('#nivel_capa').prop('required',true);
            $('#nivel_capa').val(data[0].nivel);
        }

        $("#tipo_capacitacion option[value='"+tipocap_sel+"']").prop('selected',true);
        $("#descripcion").val(data[0].especialidad);
        $("#institucion").val(data[0].centro_estudios);
        $("#pais_capacit").val(data[0].pais);
        $("#ciudad_capacit").val(data[0].ciudad);
        $("#fechainicio_capac").val(data[0].fecha_inicio);
        $("#fechafin_capac").val(data[0].fecha_fin);
        $("#horaslectivas").val(data[0].cantidad_horas);
           
    },
    error: function(data){
        alert("error!!"); }

});
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
         //  $('#total_horas').val(parseFloat($('#total_horas').val()) - parseFloat(data[0].cantidad_horas));//totalhrs +=data2[i].cantidad_horas;

           Swal.fire({
            position: 'top-end',
            type: 'error',
            title: "Curso eliminado",
            showConfirmButton: false,
            timer: 1500
        })
        },
        error: function(data){
            alert("error!!"); }

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
           var totaldias_gen=parseInt(data.suma_expgen);
           var totaldias_esp=parseInt(data.suma_expesp);
           $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
           $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
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
    $("#header-experiencia").addClass("bg-success");
    $("#header-experiencia").removeClass("bg-warning");
    $('#div_btns_exper').html(htmlbotones);
    $("#documento_exp").prop('required',true);
    $("#documento_exp").val('');
   
    $("#modal_nueva_experiencia").modal("show");
    
          $('#exp_general').prop("checked",true);
          $('#exp_especifica').prop("checked",false);
          $("#nombre_entidad").val("");
          $("#tipo_experiencia").val("");
          $("#tipo_entidad").val("");
          $("#cargo_exp").val("");
          $("#funciones_princi").val("");
          $("#fecha_inicio_exp").val("");
          $("#fecha_fin_exp").val("");
          $("#num_pag").val("");
        
    
 }

//_______________________________EDITAR EXPERIENCIA (ABRIR MODAL Y RECUPERAR DATOS PARA MOSTRAR EN LOS INPUT)___________________
 function editar_expe(transid){
    
    var htmlbotones="<button onclick=\"actualizar_expe('"+transid+"');\" class=\"btn btn-warning waves-effect waves-light\" type=\"button\">Guardar</button>";
    $("#header-experiencia").removeClass("bg-success");
    $("#header-experiencia").addClass("bg-warning");
    $('#div_btns_exper').html(htmlbotones);
    $("#documento_exp").prop('required',false);
    $("#documento_exp").val('');
    
    $("#modal_nueva_experiencia").modal("show");
      var id=transid.substring(6);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/editarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
          
            //alert("datos recibidos");
           //console.log(data);
          if(data[0].es_exp_gen==1){$('#exp_general').prop("checked",true);}else{
            $('#exp_general').prop("checked",false); 
          }
          if(data[0].es_exp_esp==1){$('#exp_especifica').prop("checked",true);}else{
            $('#exp_especifica').prop("checked",false);
          }
          
          $("#tipo_entidad").val("'"+data[0].tipo_institucion+"'");
          $("#tipo_experiencia").val("'"+data[0].tipo_experiencia+"'");
          $("#nombre_entidad").val(data[0].centro_laboral);
          $("#cargo_exp").val(data[0].cargo_funcion);
          $("#funciones_princi").val(data[0].desc_cargo_funcion);
          $("#fecha_inicio_exp").val(data[0].fecha_inicio);
          $("#fecha_fin_exp").val(data[0].fecha_fin);
          $("#num_pag").val(data[0].num_pag);
          $("#tipo_experiencia option[value='"+data[0].tipo_experiencia+"']").prop('selected',true);
          $("#tipo_entidad option[value='"+data[0].tipo_institucion+"']").prop('selected',true);

        },
        error: function(data){
            alert("error!!"); }

    });
 }

//_______________________________guardar o actualizar datos personales - section 1____________________________
    
function guardardatos(){
   
    
    var arrayExp={estado:"",msjok:"",msjerror:""};
    var discap=0;
    var ffaa=0;
    var depor=0;
    
    
        if($('#input_hide_dni').val() == "0" && $('#cargar_dni').val() == ""){
        
            arrayExp.msjerror = "Debe de cargar su documento de Identidad";
            arrayExp.estado = false;
            return arrayExp;
            
        }else 
   
        if($("#fecha_nacimiento").val()=="" || $("#ubigeodni").val()=="" || 
        $("#nacionalidad").val()=="" || $("#telefono_celular").val()=="" || 
        $("#domicilio").val()=="" || $("#ubigeo_domicilio").val()==""){
            
            arrayExp.msjerror = "Debe de completar todos lo campos requeridos";
            arrayExp.estado = false;
            return arrayExp;
            ///////////////////////////////d$('.micheckbox').prop('checked')
            
        }else if(!$("#si_discapacidad").is(':checked') && !$("#no_discapacidad").is(':checked')){
            
            arrayExp.msjerror = "Debe de seleccionar si es discapacitado o no";
            arrayExp.estado = false;
            return arrayExp;
            
        }else if(!$("#si_ffaa").is(':checked') && !$("#no_ffaa").is(':checked')){
            
            arrayExp.msjerror = "Debe de seleccionar si es licenciado de las Fuerzas Armadas";
            arrayExp.estado = false;
            return arrayExp;
            
        }else if(!$("#si_deportista").is(':checked') && !$("#no_deportista").is(':checked')){
            
            arrayExp.msjerror = "Debe de seleccionar si es Deportista Calificado";
            arrayExp.estado = false;
            return arrayExp;
            
        }else 
        
        if($("#si_discapacidad").is(':checked') && $('#file_discapacidad').val() == "" && $('#input_hide_disc').val() == "0"){
            
            arrayExp.msjerror = "Debe de cargar su archivo que fundamente su discapacidad";
            arrayExp.estado = false;
            return arrayExp;
            
        }else if($("#si_ffaa").is(':checked') && $('#file_ffaa').val() =="" && $('#input_hide_ffaa').val() == "0"){
            
            arrayExp.msjerror = "Debe de cargar su archivo que fundamente que es licenciado de las fuerzas armadas";
            arrayExp.estado = false;
            return arrayExp;
            
        }else if($("#si_deportista").is(':checked') && $('#file_deportista').val() == "" && $('#input_hide_deport').val() == "0"){
            
            arrayExp.msjerror = "Debe de cargar su archivo que fundamente que es Deportista Calificado";
            arrayExp.estado = false;
            return arrayExp;
            
        } 

    if($("#si_discapacidad").is(':checked')){ discap=1;}else{discap=0; }
    if($("#si_ffaa").is(':checked')){ ffaa=1;}else{ffaa=0; }
    if($("#si_deportista").is(':checked')){ depor=1;}else{depor=0; }
   
    var formData = new FormData();

    formData.append('archivo_dni',$('#cargar_dni').prop('files')[0]);
    formData.append('archivo_discapacidad',$('#file_discapacidad').prop('files')[0]);
    formData.append('archivo_ffaa',$('#file_ffaa').prop('files')[0]);
    formData.append('archivo_deport',$('#file_deportista').prop('files')[0]);
    formData.append('fechanac',$("#fecha_nacimiento").val());
    formData.append('ruc',$("#ruc").val());
    formData.append('ubigeodni',$("#ubigeodni").val());
    formData.append('nacionalidad',$("#nacionalidad").val());
    formData.append('celular',$("#telefono_celular").val());
    formData.append('telfijo',$("#telefono_fijo").val());
    formData.append('domicilio',$("#domicilio").val());
    formData.append('ubigeo_domicilio',$("#ubigeo_domicilio").val());
    formData.append('dicapacidad',discap);
    formData.append('ffaa',ffaa);
    formData.append('deportista',depor);

   
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/actualizardatos",
            type: "POST" ,
            datatype: "json",
            cache:false,
            contentType: false,
            processData: false,
            data:formData, 
            
            success:function(data){
               //console.log("success= ",data);
                    var href_dni="#";
                    var href_deport="#";
                    var href_disc="#";
                    var href_ffaa="#";

                    if(data.archivo_dni != null){
                    href_dni=data.archivo_dni.replace("public/", '/storage/');
                    var htmldni = "<td><a href='"+href_dni+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                        $('#btn_doc_dni').html(htmldni);
                        $('#input_hide_dni').val('1');
                    }           
                    if(data.archivo_deport != null && data.es_deportista == 1){
                        href_deport=data.archivo_deport.replace("public/", '/storage/');
                        var htmldeport = "<td><a href='"+href_deport+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                            $('#btn_doc_deport').html(htmldeport);
                            $('#input_hide_deport').val('1');
                        }
                    if(data.archivo_disc != null && data.es_pers_disc == 1){
                        href_disc=data.archivo_disc.replace("public/", '/storage/');
                        var htmldisc = "<td><a href='"+href_disc+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                            $('#btn_doc_disc').html(htmldisc);
                            $('#input_hide_disc').val('1');
                        }    
                    if(data.archivo_ffaa != null && data.es_lic_ffaa == 1){
                        href_ffaa=data.archivo_ffaa.replace("public/", '/storage/');
                        var htmlffaa = "<td><a href='"+href_ffaa+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                            $('#btn_doc_ffaa').html(htmlffaa);
                            $('#input_hide_ffaa').val('1');
                        }
            },
            error: function(data){
                console.log("error");
            }

        });

        arrayExp.estado = true;
        arrayExp.msjok = "Datos actualizados";
        return arrayExp;

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
    var res;
    
    $.ajax({
        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/datosexpgenyesp",
        type: "GET" ,
        async:false,
        datatype: "json",
        data: {idproceso : $('#datospostulante').data('id')},
        success:function(data){
           res= data;
        }
    });

    //console.log(res);
    var Mi_exp_gen = res.suma_expgen;
    var Mi_exp_esp = res.suma_expesp;
    var Exp_gen_min = res.min_expgen;
    var Exp_esp_min = res.suma_expesp;
 
    if(Mi_exp_gen==0 || Mi_exp_esp==0){
        arrayExp.estado=false;
        arrayExp.msjerror="Debe de registrar experiencia general y específica";
        return arrayExp;
    } else if(Mi_exp_gen<Exp_gen_min){
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

}

function cumple_formacion(id){
    var arrayExp={estado:"",msjok:"",msjerror:""};

    var id = id;
    
    $.ajax({
        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/datosformacion_general",
        type: "GET" ,
        async:false,
        datatype: "json",
        data: {idproceso : id},
        success:function(data){ 
           respu= data;
        }
    });
    
    
    var miformacion_max = respu.miformacion_max;
    var formacion_nivel_requerido = respu.form_nivel_requerido;
    
    if(miformacion_max==null){
        arrayExp.estado=false;
        arrayExp.msjerror="Es necesario que registre una formación académica";
        return arrayExp;
    } else if(miformacion_max<formacion_nivel_requerido){
        arrayExp.estado=false;
        arrayExp.msjerror="No cumple con el nivel de formación requerido";
        return arrayExp;
    }else {
        arrayExp.estado=true;
        arrayExp.msjok="Usted cumple con el nivel de formación requerido";
        return arrayExp;
    }

}

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

    function declaracion_jurada(){
    var arrayExp={estado:"",msjok:"",msjerror:""};
    
    var dj = "";
    if($('input:radio[name=g1]:checked').val()=="1"){
        dj = "'SI' en el inciso 1";
    } else if( $('input:radio[name=g2]:checked').val()=="1"){
        dj = "'SI' en el inciso 2";
    } else if( $('input:radio[name=g3]:checked').val()=="1"){
        dj = "'SI' en el inciso 3";
    } else if( $('input:radio[name=g4]:checked').val()=="1"){
        dj = "'SI' en el inciso 4";
    } else if( $('input:radio[name=g5]:checked').val()=="1"){
        dj = "'SI' en el inciso 5";
    } else if( $('input:radio[name=g6]:checked').val()=="1"){
        dj = "'SI' en el inciso 6";
    } else if( $('input:radio[name=g7]:checked').val()=="1"){
        dj = "'SI' en el inciso 7";
    } else if( $('input:radio[name=g8]:checked').val()=="1"){
        dj = "'SI' en el inciso 8";
    } else if( $('input:radio[name=g9]:checked').val()=="0"){
        dj = "'NO' en el inciso 9";
    }

    arrayExp.msjerror = "Usted está declarando "+dj+" de la Declaración Jurada, por tal motivo NO ES APTO para postular al presente PROCESO."
    
    if(dj == ""){
        if(!$('#check_dj').prop('checked')){
            arrayExp.msjerror = "Debe de marcar que está de acuerdo con el 'PRINCIPIO DE VERACIDAD";
            arrayExp.estado = false;
            return arrayExp;
        }else{
            arrayExp.estado = true;
            return arrayExp;
        }
        
    }else {
        arrayExp.estado = false;
            return arrayExp;
       }
 }

 

 