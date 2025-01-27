$(document).ready(function() {
    
    
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
            $('#ubigeodni').prop('required',true);
            $('#vacio').prop('id','ubigeodni_alt');
            $('#ubigeodni_alt').prop('required',false);
            
            $("#nacionalidad option[value='Extranjero(a)']").prop('selected',true);
            $('#ubigeodni').val(data.cod_nac);
            
        }else{
            $("#nacionalidad option[value='Peruano(a)']").prop('selected',true);
        }
        
        
        var html_dom = "<option value='"+data.cod_dom+"'>"+data.desc_u_dom+"</option>";
       
        if(data.cod_dom != ""){
        $('#ubigeo_domicilio').html(html_dom);
        }
    }); 
//___________________________RECUPERAR DATOS DEL USUARIO EN CASO HUBIERA__________________
    $.get('/postulante/datosuser/data1',function (data){
        if(data.valor=="0"){
            //console.log("esta vacio");
            $('#input_hide').val('0');
        }else{
           // console.log(data);
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
            
            if(data[0].colegiatura != null){
                $('#check_colegiatura').prop('checked',true);
                $('#codigo_colegiatura').prop('disabled',false);
                $('#file_colegiatura').prop('disabled',false);
                $('#cont_colegiatura').addClass('border border-cyan');
                $('#codigo_colegiatura').val(data[0].colegiatura);
                var href_lic;
                
                if(data[0].archivo_colegiatura != null){
                    
                    href_lic = data[0].archivo_colegiatura.replace('public/', '/storage/');
                    var html_lic = "<a href='"+href_lic+"' target=\"_blank\" class='btn btn-info'>ver documento<i class=\"fas fa-download\"></i></a>";
                        $('#btn_doc_colegiatura').html(html_lic);
                        $('#input_hide_licenciatura').val('1');
                        
                    }

            }else{
                $('#codigo_colegiatura').prop('disabled',true);
                $('#file_colegiatura').prop('disabled',true);
                $('#check_colegiatura').prop('checked',false);
                $('#codigo_colegiatura').val(null);
                
            }

            /*
            if(data[0].licencia != null){
                $('#check_licencia').prop('checked',true);
                $('#codigo_licencia').prop('disabled',false);
                $('#file_licencia').prop('disabled',false);
                $('#cont_licencia').addClass('border border-cyan');
                $('#codigo_licencia').val(data[0].licencia);
                var href_lic;
                
                if(data[0].archivo_licencia != null){
                    
                    href_lic = data[0].archivo_licencia.replace('public/', '/storage/');
                    var html_lic = "<a href='"+href_lic+"' target=\"_blank\" class='btn btn-info'>ver documento<i class=\"fas fa-download\"></i></a>";
                        $('#btn_doc_licencia').html(html_lic);
                        $('#input_hide_licenciaconducir').val('1');
                        
                    }

            }else{
                $('#codigo_licencia').prop('disabled',true);
                $('#file_licencia').prop('disabled',true);
                $('#check_licencia').prop('checked',false);
                $('#codigo_licencia').val(null);
                
            }
            */

            $('#cargar_dni').prop('required',true);
            if(data[0].archivo_dni != null){
             href_dni=data[0].archivo_dni.replace("public/", '/storage/');
             var htmldni = "<a href='"+href_dni+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                $('#btn_doc_dni').html(htmldni);
                $('#input_hide_dni').val('1');
                $('#cargar_dni').prop('required',false);
            }
     
           
            if(data[0].es_lic_ffaa==1){
                $("#si_ffaa").prop("checked", true);
                if(data[0].archivo_ffaa != null){
                   href_ffaa=data[0].archivo_ffaa.replace("public/", '/storage/');
                   var htmlffaa = "<a href='"+href_ffaa+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                       $('#btn_doc_ffaa').html(htmlffaa);
                       $('#input_hide_ffaa').val('1');
                   }
   
           }else{$("#no_ffaa").prop("checked", true); $('#file_ffaa').prop('disabled',true);}
            
           if(data[0].es_deportista==1){
                $("#si_deportista").prop("checked", true);
                if(data[0].archivo_deport != null){
                   href_deport=data[0].archivo_deport.replace("public/", '/storage/');
                   var htmldeport = "<a href='"+href_deport+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
                       $('#btn_doc_deport').html(htmldeport);
                       $('#input_hide_deport').val('1');
                   }
           }else{$("#no_deportista").prop("checked", true); $('#file_deportista').prop('disabled',true);}
   
            if(data[0].es_pers_disc==1){
                $("#si_discapacidad").prop("checked", true);
                if(data[0].archivo_disc != null){
                   href_disc=data[0].archivo_disc.replace("public/", '/storage/');
                   var htmldisc = "<a href='"+href_disc+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
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
    /*$.get('/postulante/capacitaciones/data1',function (data2){
       
        for (var i = 0; i < data2.length; i++) {

           if((data2[i].cantidad_horas >= parseInt($('#horas_cap_ind').val())) || (data2[i].es_certificado = 1) || (data2[i].es_licencia = 1)){
            var href_form_ca="#";
            if(data2[i].archivo != null){
                href_form_ca = data2[i].archivo.replace('public/','/storage/');
            }

            tipoestudio = "";
           // totalhoras = totalhoras + parseFloat(data2[i].cantidad_horas);

            if(data2[i].es_curso_espec==1){
                tipoestudio = "Curso/Especialización";
            }
            if(data2[i].es_especializacion==1){
                tipoestudio = "Especialización";
            }
            if(data2[i].es_diplomado==1){
                tipoestudio = "Diplomado";
            }
            if(data2[i].es_ofimatica==1){
                tipoestudio = "Ofimática";
            }
            if(data2[i].es_idioma==1){
                tipoestudio = "Idioma";
            }
            if(data2[i].es_certificado==1){
                tipoestudio = "Certificado OSCE";
            }
            if(data2[i].es_licencia==1){
                tipoestudio = "Licencia de conducir";
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
    
    });*/
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/capacitaciones/data1",
        type: "GET" ,
        datatype: "json",
        data: {hora_requerido: $('#horas_cap_ind').val()},
        success:function(data2){
            for (var i = 0; i < data2.length; i++) {

           if((data2[i].cantidad_horas >= parseInt($('#horas_cap_ind').val())) || (data2[i].es_certificado = 1) || (data2[i].es_licencia = 1)){
            var href_form_ca="#";
            if(data2[i].archivo != null){
                href_form_ca = data2[i].archivo.replace('public/','/storage/');
            }

            tipoestudio = "";
           // totalhoras = totalhoras + parseFloat(data2[i].cantidad_horas);

            if(data2[i].es_curso_espec==1){
                tipoestudio = "Curso/Especialización";
            }
            if(data2[i].es_especializacion==1){
                tipoestudio = "Especialización";
            }
            if(data2[i].es_diplomado==1){
                tipoestudio = "Diplomado";
            }
            if(data2[i].es_ofimatica==1){
                tipoestudio = "Ofimática";
            }
            if(data2[i].es_idioma==1){
                tipoestudio = "Idioma";
            }
            if(data2[i].es_certificado==1){
                tipoestudio = "Certificado OSCE";
            }
            if(data2[i].es_licencia==1){
                tipoestudio = "Licencia de conducir";
            }
            tabla2 += "<tr id='tblcapac"+data2[i].id+"'>"+
            "<td>"+tipoestudio+"</td>"+
            "<td>"+data2[i].especialidad+"</td>"+
            "<td>"+data2[i].centro_estudios+"</td>"+
            "<td>"+(data2[i].cantidad_horas==0 ? '' : data2[i].cantidad_horas)+"</td>"+
            "<td><a href='"+href_form_ca+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_capac('tblcapac"+data2[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
             "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data2[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
            }

        }
    
    $('#zeroconfig2_body').append(tabla2);
    //$('#total_horas').val(totalhoras);

        }

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
           // console.log("fechas: ",data3);
        var marcadogeneral="";
        var marcadoespecifico="";
        var tipo_exp= "";
       // var totaldias_gen=0;
        //var totaldias_esp=0;
        var html_select_tip_exp="";
               
        if(data3.proceso[0].consid_prac_preprof == 1 && data3.proceso[0].consid_prac_prof == 1){
                html_select_tip_exp="<option value=\"\">*Seleccionar*</option><option value=1>Experiencia Laboral</option><option value=2>Prácticas Pre Profesionales</option><option value=3>Prácticas Profesionales</option>";
        }else if(data3.proceso[0].consid_prac_preprof == 1){
                html_select_tip_exp="<option value=\"\">*Seleccionar*</option><option value=1>Experiencia Laboral</option><option value=2>Prácticas Pre Profesionales</option>";
        }else if(data3.proceso[0].consid_prac_prof == 1){
                html_select_tip_exp="<option value=\"\">*Seleccionar*</option><option value=1>Experiencia Laboral</option><option value=3>Prácticas Profesionales</option>";
        }else {
            html_select_tip_exp="<option value=\"\">*Seleccionar*</option><option value=1>Experiencia Laboral</option>";
        }
        
        $('#tipo_experiencia').html(html_select_tip_exp);

        var Fechas_expGen = new Array();
        var Fechas_expEsp = new Array();

        for (var i = 0; i < data3.query.length; i++) {
            
           // totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
           // totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
           
            marcadogeneral="";
            marcadoespecifico="";
            tipo_exp="";  
            if(data3.query[i].es_exp_gen==1){
                Fechas_expGen.push({f_inicio: data3.query[i].fecha_inicio, f_fin: data3.query[i].fecha_fin}); //capturo fechas de inicio y fin
                marcadogeneral="GENERAL";
            }
            if(data3.query[i].es_exp_esp==1){
                Fechas_expEsp.push({f_inicio: data3.query[i].fecha_inicio, f_fin: data3.query[i].fecha_fin}); //capturo fechas de inicio y fin
                marcadoespecifico=" y <br> ESPECÍFICA";
            }
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
            
            "<td>"+marcadogeneral + marcadoespecifico+"</td>"+
            
            "<td>"+data3.query[i].centro_laboral+"</td>"+
            "<td>"+data3.query[i].cargo_funcion+"</td>"+
            "<td>"+data3.query[i].fecha_inicio+"<br>"+data3.query[i].fecha_fin+"</td>"+
            //"<td>"+data3.query[i].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data3.query[i].dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp_ll+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_expe('tblexp"+data3.query[i].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
            "    <button type='button' onclick=\"eliminar_expe('tblexp"+data3.query[i].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
           
          
        }
    

     ;   
     ;   
           
    $('#zeroconfig3_body').append(tabla3);
    
    $('#exp_gen_pro').html(anios_meses_dias(parseInt(data3.proceso[0].dias_exp_lab_gen)));
    $('#exp_esp_pro').html(anios_meses_dias(parseInt(data3.proceso[0].dias_exp_lab_esp)));
    
    $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
    $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
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
                case 0: 
                        $('#loading-screen').fadeIn(); //PRELOADER INICIO
                        validar_paso = pre_guardardatos(); //mediante AJAX o jQuery.get() verificamos que cumpla y seteamos la variable validar_paso  
                        $('#loading-screen').fadeOut(); //PRELOADER FIN
                        break;
                case 1: 
                        $('#loading-screen').fadeIn(); //PRELOADER INICIO
                        validar_paso = cumple_formacion($('#datospostulante').data('id')); 
                        $('#loading-screen').fadeOut(); //PRELOADER FIN
                        break;
                case 2: 
                        if(newIndex == 5){
                            $('#loading-screen').fadeIn(); //PRELOADER INICIO
                            cargar_resumen_postulante();
                            $('#loading-screen').fadeOut(); //PRELOADER FIN
                        }

                return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid()) ; break;
                case 3: 
                        $('#loading-screen').fadeIn(); //PRELOADER INICIO
                        validar_paso = cumple_exp_genyesp(); 
                        $('#loading-screen').fadeOut(); //PRELOADER FIN
                        break;
                case 4: 
                validar_paso = declaracion_jurada();
                
            }
           
            if(validar_paso.estado){
               /* Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: validar_paso.msjok,
                    showConfirmButton: false,
                    timer: 2000
                })*/
                
                if(newIndex == 5){
                    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                    cargar_resumen_postulante();
                    $('#loading-screen').fadeOut(); //PRELOADER FIN
                }
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
            if($('#check_dj').prop('checked')){
            //verificar si  todo está OK mediante AJAX

           Swal.fire({
                title: '¿Está seguro de registrar su postulación?',
                text: "Recuerde revisar la información ingresada, luego de registrar su postulación no podrá ser modificada",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',  
                cancelButtonText: 'No, cerrar',              
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si, registrar'
            }).then((result) => {
               
                if(result.value){
                    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                     $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        url: "/postulante/registrofinal",
                        type: "POST",
                        datatype: "json",
                        data: { 
                            idproceso:$('#datospostulante').data('id')
                         },
                        success:function(data){
                           // console.log('aqui= ',data);
                           if(data.estado){
                                var url =  "/postulante/"+$('#datospostulante').data('id')+"/registro"; 
                           }else{
                                var url =  `/redirect?mensaje=${data.mensaje}&color=${data.color}`; 
                           }
                            //return false;
                            $(location).attr('href',url);
                        }
                        ,error: function(data){
                           console.log("error!!",data); 
                        }
                
                    });  
                   
                   
                   
                    
                }

            })
            }else{
                Swal.fire({
                    type: 'warning',
                    title: "¡Información!",
                    text: "Debe de aceptar el principio de veracidad",
                    timer: null
                })
            }
            
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
    
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarformacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){

            $('#loading-screen').fadeOut(); //PRELOADER FIN 
            Swal.fire({
                position: 'top-end',
                type: 'success',
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
        if(data[0].es_especializacion==1){
            tipocap_sel = 2;
            $('#nivel_capa').prop('disabled',true);
            $('#nivel_capa').prop('required',false);
            $('#nivel_capa').val('');
        }
        if(data[0].es_diplomado==1){
            tipocap_sel = 3;
            $('#nivel_capa').prop('disabled',true);
            $('#nivel_capa').prop('required',false);
            $('#nivel_capa').val('');
        }
        if(data[0].es_ofimatica==1){
            tipocap_sel = 4;
            $('#nivel_capa').prop('disabled',false);
            $('#nivel_capa').prop('required',true);
            $('#nivel_capa').val(data[0].nivel);
        }
        if(data[0].es_idioma==1){
            tipocap_sel = 5;
            $('#nivel_capa').prop('disabled',false);
            $('#nivel_capa').prop('required',true);
            $('#nivel_capa').val(data[0].nivel);
        }
        if(data[0].es_certificado==1){
             tipocap_sel = 6;
             $('#nivel_capa').prop('disabled',false);
             $('#nivel_capa').prop('required',true);
             $('#nivel_capa').val(data[0].nivel);

             $('#fechainicio_capac').prop('disabled',true);
             $('#fechainicio_capac').prop('required',false);

             $('#fechafin_capac').prop('disabled',true);
             $('#fechafin_capac').prop('required',false);

             $('#horaslectivas').prop('disabled',true);
             $('#horaslectivas').prop('required',false);
             $('#horaslectivas').val('-');
         }
         if(data[0].es_licencia==1){
             tipocap_sel = 7;
             $('#nivel_capa').prop('disabled',false);
             $('#nivel_capa').prop('required',true);
             $('#nivel_capa').val(data[0].nivel);

             $('#horaslectivas').prop('disabled',true);
             $('#horaslectivas').prop('required',false);
             $('#horaslectivas').val('-');
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
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                    
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

         $('#loading-screen').fadeOut(); //PRELOADER FIN 
         Swal.fire({
            position: 'top-end',
            type: 'success',
            title: "Curso/capacitación eliminado",
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
   
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: { 
            id:id ,
            idproceso:$('#datospostulante').data('id')
         },
        success:function(data){
           
           $('#'+transid).remove();

           //_______________inicio proceso interseccion_________

        var Fechas_expGen = new Array();
        var Fechas_expEsp = new Array();
 
        for (var i = 0; i < data.query_inter.length; i++) {
            if(data.query_inter[i].es_exp_gen==1){
                Fechas_expGen.push({f_inicio: data.query_inter[i].fecha_inicio, f_fin: data.query_inter[i].fecha_fin}); 
            }
            if(data.query_inter[i].es_exp_esp==1){
                Fechas_expEsp.push({f_inicio: data.query_inter[i].fecha_inicio, f_fin: data.query_inter[i].fecha_fin}); 
            } 
        
        }
         
       //________________fin proceso interseccion____________

           //var totaldias_gen=parseInt(data.suma_expgen);
           //var totaldias_esp=parseInt(data.suma_expesp);
           $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
           $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
         
           $('#loading-screen').fadeOut(); //PRELOADER FIN
           
           Swal.fire({
            position: 'top-end',
            type: 'success',
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
    
function pre_guardardatos(){
    var formg = document.getElementsByClassName('datospostulante_v');
    // Loop over them and prevent submission
    var arrayExp={estado:"",msjok:"",msjerror:"Debe de completar todos los campos requeridos"};

    var validation = Array.prototype.filter.call(formg, function(form_g) {
        
            if (form_g.checkValidity() === false) {
               // event.preventDefault();
                //event.stopPropagation();
                form_g.classList.add('was-validated');
                arrayExp={estado:false,msjok:"",msjerror:"falta complete...."};
               
            }else{
                //event.preventDefault();
                
                form_g.classList.remove('was-validated');  
                arrayExp = guardardatos();  
            }
       
        });

        return arrayExp;
}

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
                    var htmldni = "<a href='"+href_dni+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
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
               // console.log("error");
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

    var tipo_proceso =parseInt(res.tipo_proc);

    var Exp_gen_min =parseInt(res.min_expgen);
    var Exp_esp_min =parseInt(res.min_expesp);

    //_______________inicio proceso interseccion_________

    var Fechas_expGen = new Array();
    var Fechas_expEsp = new Array();
//console.log(res);
    for (var i = 0; i < res.query_inter.length; i++) {
        if(res.query_inter[i].es_exp_gen==1){
            Fechas_expGen.push({f_inicio: res.query_inter[i].fecha_inicio, f_fin: res.query_inter[i].fecha_fin}); 
        }
        if(res.query_inter[i].es_exp_esp==1){
            Fechas_expEsp.push({f_inicio: res.query_inter[i].fecha_inicio, f_fin: res.query_inter[i].fecha_fin}); 
        } 
    
    }
     
   //________________fin proceso interseccion_______________
    
    var Mi_exp_gen =parseInt(verificar_interseccion(Fechas_expGen).dias_exper);
    var Mi_exp_esp =parseInt(verificar_interseccion(Fechas_expEsp).dias_exper);
       
    if(tipo_proceso<4) {

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
   }else{
        arrayExp.estado=true;
                
        return arrayExp;
   }
}

function cumple_formacion(idproceso){
    var arrayExp={estado:"",msjok:"",msjerror:""};

    if($('#check_colegiatura').prop('checked')){
        if($('#codigo_colegiatura').val() == ""){
            return arrayExp={estado:false,msjok:"",msjerror:"Debe de ingresar el número de su colegiatura."}; 
        }
        if($('#file_colegiatura').val() == "" && $('#input_hide_licenciatura').val() == 0){
            return arrayExp={estado:false,msjok:"",msjerror:"Debe de ingresar el documento que fundamente su colegiatura."}; 
        } 
    } 

    /****************************************************************/
    if($('#check_licencia').prop('checked')){
        if($('#codigo_licencia').val() == ""){
            return arrayExp={estado:false,msjok:"",msjerror:"Debe de ingresar el número de su colegiatura."}; 
        }
        if($('#file_licencia').val() == "" && $('#input_hide_licenciatura').val() == 0){
            return arrayExp={estado:false,msjok:"",msjerror:"Debe de ingresar el documento que fundamente su colegiatura."}; 
        } 
    } 
    /****************************************************************/   
        
    var formData = new FormData();
    formData.append('idproceso',idproceso);
    formData.append('colegiatura',$('#codigo_colegiatura').val());
    formData.append('archivo_colegiatura',$('#file_colegiatura').prop('files')[0]);

    //formData.append('licencia',$('#codigo_licencia').val());
    //formData.append('archivo_licencia',$('#file_licencia').prop('files')[0]);
   
     var respu;
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/datosformacion_general",
        type: "POST",
        async:false,
        datatype: "json",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){ 
         // console.log(data);
            respu = data;
            
            if(data.src_colegiatura != null){
                    
                href_lic = data.src_colegiatura.replace('public/', '/storage/');
                var html_lic = "<a href='"+href_lic+"' target=\"_blank\" class='btn btn-info'>ver documento<i class=\"fas fa-download\"></i></a>";
                    $('#btn_doc_colegiatura').html(html_lic);
                    $('#input_hide_licenciatura').val('1');
                    
                } 
                
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
    var algun_campo_vacio=false;
    
    if($(!"#si_p1").is(':checked') && !$("#no_p1").is(':checked')){
        algun_campo_vacio=true;    
    }else if(!$("#si_p2").is(':checked') && !$("#no_p2").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p3").is(':checked') && !$("#no_p3").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p4").is(':checked') && !$("#no_p4").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p5").is(':checked') && !$("#no_p5").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p6").is(':checked') && !$("#no_p6").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p7").is(':checked') && !$("#no_p7").is(':checked')){
        algun_campo_vacio=true;   
    }else if(!$("#si_p8").is(':checked') && !$("#no_p8").is(':checked')){
        algun_campo_vacio=true;   
    }

    if(algun_campo_vacio){
        arrayExp.msjerror = "Debe de seleccionar SI o NO en todas las opciones de la declaración jurada.";
        arrayExp.estado = false;
       return arrayExp;
    }

    var dj = "";
    if(!$('input:radio[name=g1]:checked').val()=="1"){
        dj = "'SI' en el inciso 1";
    } else if( !$('input:radio[name=g2]:checked').val()=="1"){
        dj = "'SI' en el inciso 2";
    } else if( !$('input:radio[name=g3]:checked').val()=="1"){
        dj = "'SI' en el inciso 3";
    } else if( !$('input:radio[name=g4]:checked').val()=="1"){
        dj = "'SI' en el inciso 4";
    } else if( !$('input:radio[name=g5]:checked').val()=="1"){
        dj = "'SI' en el inciso 5";
    } else if( !$('input:radio[name=g6]:checked').val()=="1"){
        dj = "'SI' en el inciso 6";
    } else if( !$('input:radio[name=g7]:checked').val()=="1"){
        dj = "'SI' en el inciso 7";
    } else if( !$('input:radio[name=g8]:checked').val()=="1"){
        dj = "'SI' en el inciso 8";
    }/* else if( $('input:radio[name=g9]:checked').val()=="0"){
        dj = "'NO' en el inciso 9";
    }*/

    arrayExp.msjerror = "Usted está declarando "+dj+" de la Declaración Jurada, por tal motivo NO ES APTO para postular al presente PROCESO."
    
    if(dj == ""){
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/declaracionjurada",
            type: "POST",
            datatype: "json",
            data: { 
                //idproceso:$('#datospostulante').data('id'),
                dj1:$('input:radio[name=g1]:checked').val(),
                dj2:$('input:radio[name=g2]:checked').val(),
                dj3:$('input:radio[name=g3]:checked').val(),
                dj4:$('input:radio[name=g4]:checked').val(),
                dj5:$('input:radio[name=g5]:checked').val(),
                dj6:$('input:radio[name=g6]:checked').val(),
                dj7:$('input:radio[name=g7]:checked').val(),
                dj8:$('input:radio[name=g8]:checked').val(),
                //dj9:$('input:radio[name=g9]:checked').val()
             },
            success:function(data){
                //console.log(data);
            },
            error: function(data){
                //alert("error!!"); 
            }
    
        });    
        
        
        arrayExp.estado = true;
            return arrayExp;
         
    }else {
        arrayExp.estado = false;
            return arrayExp;
       }
 }

 function cargar_resumen_postulante(){
 //    alert('entre a resumen');
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/datosuser/cargar_resumen_postulante",
        type: "GET" ,
        datatype: "json",
        data:{idproceso: $('#datospostulante').data('id')
       
        },success:function(data){ 
         // console.log(data);
          var esdisc = "";
          var esffaa = "";
          var esdep = "";
          var href_lic = "";
          if(data.qdatos.colegiatura != null){
            $('#dato_colegiado').html("<i class=\"fas fa-info-círculo\"></i>"+"<strong> Me encuentro COLEGIADO y HABILITADO:</strong> "+data.qdatos.colegiatura);
            if(data.qdatos.archivo_colegiatura != null){
                href_lic = data.qdatos.archivo_colegiatura.replace('public/', '/storage/');
                var html_lic = "<a href='"+href_lic+"' target=\"_blank\" class='btn btn-info'>ver documento<i class=\"fas fa-download\"></i></a>";
                    $('#btn_doc_colegiatura2').html(html_lic);
                                           
                }
          }else{
              $('#dato_colegiado').html("<i class=\"fas fa-info-círculo\"></i>"+"<strong> No me encuentro COLEGIADO.</strong>");
          }
            $('#res_fecha_nac').html(data.qdatos.fecha_nacimiento);
           $('#res_ubigeo_nac').html(data.qdatos.ubigeo_nacimiento);
           $('#res_ruc').html(data.qdatos.ruc);
           $('#res_celular').html(data.qdatos.telefono_celular);
           $('#res_nacionalidad').html(data.nacionalidad);
           if(data.qdatos.es_pers_disc == 1){esdisc = "SI"}else{esdisc = "NO"}
           if(data.qdatos.es_lic_ffaa == 1){esffaa= "SI"}else{esffaa = "NO"}
           if(data.qdatos.es_deportista == 1){esdep = "SI"}else{esdep = "NO"}
           $('#res_disc').html(esdisc);
           $('#res_ffaa').html(esffaa);
           $('#res_depor').html(esdep);

             //_______________________TRANSFORMAR UBIGEOS_________________________
       if(data.nacionalidad == "Peruano(a)"){
                
        var html_nac = data.desc_u_nac;
        if(data.cod_nac != ""){
            $('#res_ubigeo_nac').html(html_nac);
        }
    }else if(data.nacionalidad == "Extranjero(a)"){
       
        $('#res_ubigeo_nac').html(data.cod_nac);
        
    }
        
    var html_dom = data.desc_u_dom;
   
    if(data.cod_dom != ""){
    //$('#res_ubigeo_direc').html(html_dom);
    }

    $('#res_direccion').html(data.qdatos.domicilio+" ("+html_dom+")");
       //_______________________FIN TRANSFORMAR UBIGEOS_________________________

            //llenar formacion
            var html_resform = "";
            for (var i = 0; i < data.qform.length; i++) {
               
                var href_form="#";
                if(data.qform[i].archivo != null){
                    href_form = data.qform[i].archivo.replace('public/','/storage/');
                }
                html_resform += "<tr>"+
                "<td>"+data.qform[i].nombre+"</td>"+
                "<td>"+data.qform[i].especialidad+"</td>"+
                "<td>"+data.qform[i].centro_estudios+"</td>"+
                "<td>"+data.qform[i].fecha_expedicion+"</td>"+
                "<td><a href='"+href_form+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
                 "</td>"+
                "</tr>";
            }
            $('#res_tbl_form').html(html_resform);

            
            //llenar capacitaciones
            var html_rescap = "";
            for (var i = 0; i < data.qcapa.length; i++) {

                  tipoestudio = "";
                 if(data.qcapa[i].es_curso_espec==1){
                     tipoestudio = "Curso";
                 }
                 if(data.qcapa[i].es_especializacion==1){
                    tipoestudio = "Especialización";
                }
                if(data.qcapa[i].es_diplomado==1){
                    tipoestudio = "Diplomado";
                }
                 if(data.qcapa[i].es_ofimatica==1){
                     tipoestudio = "Ofimática";
                 }
                 if(data.qcapa[i].es_idioma==1){
                     tipoestudio = "Idioma";
                 }
                 if(data.qcapa[i].es_certificado==1){
                     tipoestudio = "Certificado OSCE";
                 }
                 if(data.qcapa[i].es_licencia==1){
                     tipoestudio = "Licencia de conducir";
                 }
                 
                 var href_form_ca="#";
                 if(data.qcapa[i].archivo != null){
                     href_form_ca = data.qcapa[i].archivo.replace('public/','/storage/');
                 }
                 html_rescap += "<tr>"+
                 "<td>"+tipoestudio+"</td>"+
                 "<td>"+data.qcapa[i].especialidad+"</td>"+
                 "<td>"+data.qcapa[i].centro_estudios+"</td>"+
                 "<td>"+(data.qcapa[i].cantidad_horas==0 ? '' : data.qcapa[i].cantidad_horas)+"</td>"+
                 "<td><a href='"+href_form_ca+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
                 "</td>"+
                 "</tr>";
                 }
                 
                 $('#res_tbl_capa').html(html_rescap);
             
           
             //llenar experiencias
             var html_resexp = "";
             
            
            for (var i = 0; i < data.qexp.length; i++) {
                var marcadogeneral="";
                var marcadoespecifico="";
                var tipo_exp=""; 
            if(data.qexp[i].es_exp_gen==1){marcadogeneral="GENERAL";}
            if(data.qexp[i].es_exp_esp==1){marcadoespecifico="y <br> ESPECÍFICA";}
            
                if(data.qexp[i].tipo_experiencia == '1'){
                tipo_exp="Experiencia Laboral";
                }else if(data.qexp[i].tipo_experiencia == '2'){
                tipo_exp="Prácticas Pre Profesionales";
                }else if(data.qexp[i].tipo_experiencia == '3'){
                tipo_exp="Prácticas Profesionales";
                }

            var href_exp="#";
            if(data.qexp[i].archivo != null){
                href_exp = data.qexp[i].archivo.replace('public/','/storage/');
            }

            html_resexp += "<tr>"+
            "<td>"+tipo_exp+"</td>"+
            "<td>"+marcadogeneral + marcadoespecifico+"</td>"+
            "<td>"+data.qexp[i].centro_laboral+"</td>"+
            "<td>"+data.qexp[i].cargo_funcion+"</td>"+
            "<td>"+data.qexp[i].fecha_inicio+"</td>"+
            "<td>"+data.qexp[i].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.qexp[i].dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "</td>"+
            "</tr>";
        }
        $('#res_tbl_exp').html(html_resexp);
        //DECLARACION JURADA
        $('#res_dj1').html(data.qdatos.dj1 == 1 ? "SI" : "NO");
        $('#res_dj2').html(data.qdatos.dj2 == 1 ? "SI" : "NO");
        $('#res_dj3').html(data.qdatos.dj3 == 1 ? "SI" : "NO");
        $('#res_dj4').html(data.qdatos.dj4 == 1 ? "SI" : "NO");
        $('#res_dj5').html(data.qdatos.dj5 == 1 ? "SI" : "NO");
        $('#res_dj6').html(data.qdatos.dj6 == 1 ? "SI" : "NO");
        $('#res_dj7').html(data.qdatos.dj7 == 1 ? "SI" : "NO");
        $('#res_dj8').html(data.qdatos.dj8 == 1 ? "SI" : "NO");
        
        //alert('terminé');
        },
        error:function(data){
           // console.log("error en resumen posulante");
        }
    }); 
 }

 function fecha_interseccion(F1_inicio,F1_fin,F2_inicio,F2_fin){

    const F1_i = F1_inicio;
    const F1_f = F1_fin;
    const F2_i = F2_inicio;
    const F2_f = F2_fin;

    var F1_inicio = new Date(F1_inicio+" 00:00:00");
    var F1_fin = new Date(F1_fin+" 00:00:00");
    var F2_inicio = new Date(F2_inicio+" 00:00:00");
    var F2_fin = new Date(F2_fin+" 00:00:00");

    var Inter_inicio = null;
    var Inter_fin = null;
    var Union_inicio = null;
    var Union_fin = null;

    if(F1_inicio.getTime() < F2_inicio.getTime()){

        if(F1_fin.getTime() < F2_inicio.getTime()){
            Inter_inicio = null;
            Inter_fin = null;
            Union_inicio = null;
            Union_fin = null;
            //console.log("no hay intersección");
            
        }else if(F1_fin.getTime() == F2_inicio.getTime()){
            Inter_inicio = F1_f;
            Inter_fin = F2_i;
            Union_inicio = F1_i;
            Union_fin = F2_f;
            //console.log("1 día de intersección");

        }else if(F1_fin.getTime() > F2_inicio.getTime()){
            
            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);

            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);

            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);
            }
        }    
    }else if(F1_inicio.getTime() == F2_inicio.getTime()){

        if(F1_fin.getTime() > F2_inicio.getTime()){

            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);

            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);

            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);
            }
        
        }else if(F1_fin.getTime() == F2_inicio.getTime()){
            if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = null;
                Union_fin = null;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);

            }
        }
    }else if(F1_inicio.getTime() > F2_inicio.getTime()){

        if(F1_inicio.getTime() < F2_fin.getTime()){

            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F2_i;
                Union_fin = F2_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);
            
            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F2_i;
                Union_fin = F2_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);
            
            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F2_f;
                Union_inicio = F2_i;
                Union_fin = F1_f;
                //console.log("intersección:" + Inter_inicio + " / " + Inter_fin);
            
            }
        }else if(F1_inicio.getTime() == F2_fin.getTime()){
            Inter_inicio = F1_i;
            Inter_fin = F2_f;
            Union_inicio = F2_i;
            Union_fin = F1_f;
            //console.log("1 día de intersección");

        }else if(F1_inicio.getTime() > F2_fin.getTime()){
            Inter_inicio = null;
            Inter_fin = null;
            Union_inicio = null;
            Union_fin = null;
            //console.log("No hay intersección");

        }

    } 
    
    var fechainicio;
    var fechafin;
    var dias;
    var estad = false;

    if(Inter_inicio != null && Inter_fin != null){
    fechainicio=moment(Inter_inicio);
    fechafin=moment(Inter_fin);
    dias=fechafin.diff(fechainicio,"days");
    if (dias == 0){
        dias = 1;
    }
    estad = true ;

        //console.log('DIAS :',fechafin+"-"+fechainicio+"= "+dias+" - "+anios_meses_dias(dias));

    }else{
    fechainicio=null;
    fechafin=null;
    dias=0;
    estad = false ;
    } 
    
    var intersección = {estado:estad, inicio:Inter_inicio, fin:Inter_fin,cant_dias:dias,u_inicio : Union_inicio, u_fin : Union_fin};

    return intersección;
 }
 
 function verificar_interseccion(Fechas_a_trabajar){

    var Fechas = Fechas_a_trabajar;

    //console.log('INICIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO');
    if(Fechas.length != 0){
        //___________INICIO INTERSECCION (METODO 2)_________________________
      //console.log('_______________________________________________');
      //console.log('Fechas a trabajar: ',Fechas);
      //console.log('______________PROCESAMIENTO DE FECHAS_________________________________');
      
      var FechasFijas = new Array();
      FechasFijas.push({f_inicio: Fechas[0].f_inicio, f_fin: Fechas[0].f_fin});

      for ( i = 1 ; i < Fechas.length ; i++){
         var cont=0;
         var val_inter=null;
         for ( y = 0 ; y < FechasFijas.length ; y++){
             
             var resultado = fecha_interseccion(FechasFijas[y].f_inicio,FechasFijas[y].f_fin,Fechas[i].f_inicio,Fechas[i].f_fin);
             if(resultado.estado){
                //empalmo con la intersección
                cont++;
                
                if(cont>1){
                 FechasFijas[val_inter].f_inicio = resultado.u_inicio;
                 FechasFijas[val_inter].f_fin = resultado.u_fin;
                 //console.log('union: ',FechasFijas[val_inter].f_inicio + " / " + FechasFijas[val_inter].f_fin);

                 Fechas[i].f_inicio = resultado.u_inicio;
                 Fechas[i].f_fin = resultado.u_fin;
              
                 FechasFijas.splice(y, 1);
                 y--;
                }else{
                 
                 FechasFijas[y].f_inicio = resultado.u_inicio;
                 FechasFijas[y].f_fin = resultado.u_fin;
                 //console.log('union: ',FechasFijas[y].f_inicio + " / " + FechasFijas[y].f_fin);

                 Fechas[i].f_inicio = resultado.u_inicio;
                 Fechas[i].f_fin = resultado.u_fin;
                 
                 val_inter = y;
                }
                
             }else {
/*
                 if(y == FechasFijas.length){
                 FechasFijas.push({f_inicio: Fechas[i].f_inicio, f_fin: Fechas[i].f_fin});
                 y--;
                 }
*/
                 if(y == FechasFijas.length - 1 && cont == 0){
                     FechasFijas.push({f_inicio: Fechas[i].f_inicio, f_fin: Fechas[i].f_fin});
                     y++;
                     }
             }
         }
         
 
     }
     //console.log('___________________FIN PROCESAMIENTO____________________________');
     //console.log('Fechas Fijas: ',FechasFijas);
     
     var total_dias = 0;
     for ( i = 0 ; i < FechasFijas.length ; i++){
         var fechainicio=moment(FechasFijas[i].f_inicio);
         var fechafin=moment(FechasFijas[i].f_fin);
         var dias=fechafin.diff(fechainicio,"days");
         //console.log('Fecha '+i+': ',fechainicio+' / '+fechafin+' -> '+anios_meses_dias(dias));
         total_dias += dias;
         }

     //console.log('Experiencia Total : ', anios_meses_dias(total_dias)+' - '+ total_dias+'dias');
     //console.log('FIIIIIIIIIIIIIIINNNNNNNNNNNNNN');


      //______________________________FIN INTERSECCION (METODO 2)_________________________

     /* //______________________________INICIO INTERSECCION (METODO 1)_________________________
 
 //fecha_interseccion(Fechas[0].f_inicio,Fechas[0].f_fin,Fechas[1].f_inicio,Fechas[1].f_fin);
 //console.log("_______________________Fechas a trabajar___________ :");
 //console.log(Fechas);
 
 var total_dias_descontar_1 = 0;
 var total_dias_descontar_2 = 0;
 var FechasInter = new Array();
 var Fechasfinal = new Array();
 
 console.log('______________FECHAS INTERSECCION : ETAPA 2____________________');
 for ( i = 0 ; i < Fechas.length ; i++){
     for ( y = i + 1 ; y < Fechas.length ; y++){
         var resultado = fecha_interseccion(Fechas[i].f_inicio,Fechas[i].f_fin,Fechas[y].f_inicio,Fechas[y].f_fin);
         if(resultado.estado){
             FechasInter.push({f_inicio: resultado.inicio, f_fin: resultado.fin});
             total_dias_descontar_1 += parseInt(resultado.cant_dias);
         }
     }

 }
     console.log(FechasInter);
     console.log('Dias intersectadas : ', total_dias_descontar_1);

 console.log('______________FECHAS FINALES : ETAPA 3____________________');
 for ( i = 0 ; i < FechasInter.length ; i++){
     for ( y = i + 1 ; y < FechasInter.length ; y++){
         var resultado = fecha_interseccion(FechasInter[i].f_inicio,FechasInter[i].f_fin,FechasInter[y].f_inicio,FechasInter[y].f_fin);
         if(resultado.estado){
             Fechasfinal.push({f_inicio: resultado.inicio, f_fin: resultado.fin});
             //total_dias_descontar_2 += parseInt(resultado.cant_dias);
         }
     }

 }
  console.log(Fechasfinal);

 //obtener un array con fechas únicas
 let set = new Set( Fechasfinal.map( JSON.stringify ) )
 let FechasUnicas = Array.from( set ).map( JSON.parse );
 
 console.log('_______________FECHAS ÚNICAS___________________');
 console.log(FechasUnicas);
 
 for ( i = 0 ; i < FechasUnicas.length ; i++){
 var fechainicio=moment(FechasUnicas[i].f_inicio);
 var fechafin=moment(FechasUnicas[i].f_fin);
 var dias=fechafin.diff(fechainicio,"days");
 if(dias == 0){ dias = 1;}
 total_dias_descontar_2 += dias;
 }

 console.log('Dias finales-unicas : ', total_dias_descontar_2); ///////////falta esto
 
 console.log('______________FIN____________________');
 console.log('Total experiencia: ',totaldias_gen-(total_dias_descontar_1-total_dias_descontar_2));
 console.log('Total experiencia: ',anios_meses_dias(totaldias_gen-(total_dias_descontar_1-total_dias_descontar_2)));
 
 

 //______________________________FIN INTERSECCION_________________________
 */ 
 
 return {
    tiempo_total_exper: anios_meses_dias(total_dias),
    dias_exper: total_dias
  };

    }else {

    return {
    tiempo_total_exper: 0,
    dias_exper: 0
    };
    }
 }