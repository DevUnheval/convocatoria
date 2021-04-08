$(document).ready(function() {

    $("#nacionalidad").on('change',function(){
       
        if($('#nacionalidad').val() == "Peruano(a)"){
            $('#ubigeodni').removeClass('required');
            $('#ubigeodni').prop('required',false);
            $('#ubigeodni').prop('id','vacio');
            $('#html_lugar_nac2').hide();
            $('#html_lugar_nac').show();
            $('#ubigeodni_alt').prop('id','ubigeodni');
            $('#ubigeodni').addClass('required');
            $('#ubigeodni').prop('required',true);
            $('#vacio').prop('id','ubigeodni_alt');
                     
        }

        if($('#nacionalidad').val() == "Extranjero(a)"){
        
            $('#ubigeodni').removeClass('required');
            $('#ubigeodni').prop('required',false);
            $('#ubigeodni').prop('id','vacio');
            $('#html_lugar_nac').hide();
            $('#html_lugar_nac2').show();
            $('#ubigeodni_alt').prop('id','ubigeodni');
            $('#ubigeodni').addClass('required');
            $('#ubigeodni').prop('required',true);
            $('#vacio').prop('id','ubigeodni_alt');
           
        }

        if($('#nacionalidad').val() == ""){
           
            }
    })
   
    $.get('/postulante/datosuser/recuperar_ubigeo',function (data){
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
    //__________________________________INICIO TABLAS POSTULAR_______________________________________________________________
    
    


//_________________________________ guardar formacion académica - section 2___________________________________
    
// ______________________________-boton cancelar, ocultar modal - section 2
        $('#btn_can_formac').on('click',function(){
            $('#modal_nueva_formacion').modal('hide');
        })

//_________________________________ guardar curso capacitacion - section 3
   

//__________________________________ boton cancelar, ocultar modal - section 3
$('#btn_can_capacitacion').on('click',function(){
    $('#modal_nuevo').modal('hide');
})

//_________________________________ guardar experiencia - section 4


// boton cancelar, ocultar modal - section 3
$('#btn_cancelar_exper').on('click',function(){
    $('#modal_nueva_experiencia').modal('hide');
    
})

//select de crear una una formacion academica
$("#tipo_estudio").on('change',function(){
    if($("#tipo_estudio").val()==2 || $("#tipo_estudio").val()==3){
        $('#especialidad').attr('disabled',true);
        $("#especialidad").val('');
    }else{
        $('#especialidad').removeAttr('disabled');
    }
})

//select de crear una nueva capacitacion/curso/idioma/ofimatica academica
$("#tipo_capacitacion").on('change',function(){
    if($("#tipo_capacitacion").val()==4 || $("#tipo_capacitacion").val()==5){
        $('#nivel_capa').prop('disabled',false);
        $('#nivel_capa').prop('required',true);
        $('#nivel_capa').val('');
        
    }else{
        $('#nivel_capa').prop('disabled',true);
        $('#nivel_capa').prop('required',false);
        $('#nivel_capa').val('');
        
    }
})


    //____________________________________FIN INICIO TABLAS POSTULAR
   /* $('#file_discapacidad').prop('disabled',true);
    $('#file_discapacidad').val('');
    $('#file_ffaa').prop('disabled',true);
    $('#file_ffaa').val('');
    $('#file_deportista').prop('disabled',true);
    $('#file_deportista').val('');*/

    $('.group1').click(function(){
        if($(this).val()=='true'){
            $('#file_discapacidad').prop('disabled',false);
           
        }else{
            $('#file_discapacidad').prop('disabled',true);
            $('#btn_doc_disc').html('');
            $('#file_discapacidad').val('');
            $('#input_hide_disc').val('0');
        }
    })
    $('.group2').click(function(){
        if($(this).val()=='true'){
            $('#file_ffaa').prop('disabled',false);
        }else{
            $('#file_ffaa').prop('disabled',true);
            $('#btn_doc_ffaa').html('');
            $('#file_ffaa').val('');
            $('#input_hide_ffaa').val('0');
        }
    })
    $('.group3').click(function(){
        if($(this).val()=='true'){
            $('#file_deportista').prop('disabled',false);
        }else{
            $('#file_deportista').prop('disabled',true);
            $('#btn_doc_deport').html('');
            $('#file_deportista').val('');
            $('#input_hide_deport').val('0');
        }
    })
        


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

         $('#cargar_dni').prop('required',true);
         if(data[0].archivo_dni != null){
          href_dni=data[0].archivo_dni.replace("public/", '/storage/');
          var htmldni = "<td><a href='"+href_dni+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a>";
             $('#btn_doc_dni').html(htmldni);
             $('#input_hide_dni').val('1');
             $('#cargar_dni').prop('required',false);
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
 
             var href_form_ca="#";
             if(data2[i].archivo != null){
                 href_form_ca = data2[i].archivo.replace('public/','/storage/');
             }
 
             tipoestudio = "";
            // totalhoras = totalhoras + parseFloat(data2[i].cantidad_horas);
 
             if(data2[i].es_curso_espec==1){
                 tipoestudio = "Curso";
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
     
     $('#zeroconfig2_body').append(tabla2);
     //$('#total_horas').val(totalhoras);
         
     
     
     });
 
     //_______________________________llenar tabla EXPERIENCIAS______________________
     var tabla3="";
     //var ttiempoexp_gen=0;
     //var ttiempoexp_esp=0;
    
     $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         url: "/postulante/experiencias/data1/perfil",
         type: "GET" ,
         datatype: "json",
         data: {idproceso: $('#datospostulante').data('id')},
         success:function(data3){
             //console.log(data3);
         
         //var totaldias_gen=0;
         //var totaldias_esp=0;

         var Fechas_expGen = new Array();
        var Fechas_expEsp = new Array();

         for (var i = 0; i < data3.query.length; i++) {
            
            // totaldias_gen=totaldias_gen+parseInt(data3.query[i].dias_exp_gen);
            // totaldias_esp=totaldias_esp+parseInt(data3.query[i].dias_exp_esp);
             
           var  marcadogeneral="";
            var marcadoespecifico="";
            var tipo_exp="";
  
             if(data3.query[i].es_exp_gen==1){
                Fechas_expGen.push({f_inicio: data3.query[i].fecha_inicio, f_fin: data3.query[i].fecha_fin}); //capturo fechas de inicio y fin
                marcadogeneral="GENERAL";}

             if(data3.query[i].es_exp_esp==1){
                Fechas_expEsp.push({f_inicio: data3.query[i].fecha_inicio, f_fin: data3.query[i].fecha_fin}); //capturo fechas de inicio y fin
                marcadoespecifico=" y <br> ESPECÍFICA";}

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
     
    // $('#exp_gen_pro').html(anios_meses_dias(parseInt(data3.proceso[0].anios_exp_lab_gen)));
    // $('#exp_esp_pro').html(anios_meses_dias(parseInt(data3.proceso[0].anios_exp_lab_esp)));
     
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
  /*   var form = $(".validation-wizard").show();
     
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
             }
            
             if(validar_paso.estado){
               
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
             var msj_error="";
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
 
             msj_error = "Usted está declarando "+dj+" de la Declaración Jurada, por tal motivo NO ES APTO para postular al presente PROCESO."
             
             if(dj == ""){
                 if(!$('#check_dj').prop('checked')){
                     msj_error = "Debe de marcar que está deacerdo con el 'PRINCIPIO DE VERACIDAD";
                     
                     Swal.fire({
                         type: 'warning',
                         title: "¡INFORMACIÓN!",
                         text: msj_error,
                         timer: null
                     })
                     return false;
                 }else{
                     return form.validate().settings.ignore = ":disabled", form.valid();
                 }
                 
             }else {
                 Swal.fire({
                     type: 'warning',
                     title: "¡NO PUEDE POSTULAR!",
                     text: msj_error,
                     timer: null
                 })
                 return false;
                }
             
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
     */
 
    $('#btn_update_pass').on('click',function(){
        
        var forms10 = document.getElementsByClassName('needs-validation10');
        // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms10, function(form10) {
            
                if (form10.checkValidity() === false) {
                   // event.preventDefault();
                    //event.stopPropagation();
                    form10.classList.add('was-validated');
                    
                }else{
                    update_password();
                    form10.classList.remove('was-validated');    
                }
            })
       

    });
    

 })
 
  //______________________________________________________________________________________________________________
 //________________________________FIN DE TAB WIZARD_____________________________________________________________-
 
 function update_password(){
      if($('#password').val() != $('#password_confirmation').val()){
        var htmlalert = 
         "<div  class=\"form-group alert-danger p-3\">"+
        "<div > Las contraseñas nuevas no coinciden.</div>"+
        "</div>"
            
        $('#mensaje-alert').html(htmlalert);
            return false;
       }else{
        $('#mensaje-alert').html("");
       $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/update_password",
        type: "POST" ,
        datatype: "json",
        data :
        {
            mypassword: $('#mypassword').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val()
        },
        success:function(data){
            
            if(data){
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: "Contraseña actualizada",
                    showConfirmButton: false,
                    timer: 2000
                })
                $('#m_contraseña').modal('hide');
                $('#mypassword').val("");
                $('#password').val("");
                $('#password_confirmation').val("");

            }else{
                Swal.fire({
                    type: 'warning',
                    title: "¡Credenciales Incorrectos!",
                    text: "La contraseña ingresada no es la correcta.",
                    timer: null
                })
                $('#mypassword').val("");
                                

            }
          // console.log(data);
        },
        error: function(data){
          // console.log("error!!"); 
        
        }

    });
    
    }

 }
 
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
         url: "/postulante/perfil/eliminarexperiencia",
         type: "POST" ,
         datatype: "json",
         data: { 
             id:id
             //idproceso:$('#datospostulante').data('id')
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
    var formg = document.getElementsByClassName('form_datospers_perfil');
    // Loop over them and prevent submission
    //var arrayExp={estado:"",msjok:"",msjerror:"falta complete...."};

    var validation = Array.prototype.filter.call(formg, function(form_g) {
        
            if (form_g.checkValidity() === false) {
               // event.preventDefault();
                //event.stopPropagation();
                
                    Swal.fire({
                        type: 'warning',
                        title: "¡Información!",
                        text: "Debe de completar todos los campos requeridos",
                        timer: null
                    })
                  form_g.classList.add('was-validated');
               // arrayExp={estado:false,msjok:"",msjerror:"falta complete...."};
               
            }else{
                //event.preventDefault();
                
                form_g.classList.remove('was-validated');  
                guardardatos();  
            }
       
        });

      //  return arrayExp;
}    
 
 function guardardatos(){
    
     var discap=0;
     var ffaa=0;
     var depor=0;
     var msj_error = "";
     

     if($('#input_hide_dni').val() == "0" && $('#cargar_dni').val() == ""){
        
         msj_error = "Debe de cargar su documento de Identidad";
         
     }else 

     if($("#fecha_nacimiento").val()=="" || $("#ubigeodni").val()=="" || 
     $("#nacionalidad").val()=="" || $("#telefono_celular").val()=="" || 
     $("#domicilio").val()=="" || $("#ubigeo_domicilio").val()==""){
         
         msj_error = "Debe de completar todos lo campos requeridos";
         ///////////////////////////////d$('.micheckbox').prop('checked')
         
     }else if(!$("#si_discapacidad").is(':checked') && !$("#no_discapacidad").is(':checked')){
         
         msj_error = "Debe de seleccionar si es discapacitado o no";
         
     }else if(!$("#si_ffaa").is(':checked') && !$("#no_ffaa").is(':checked')){
         
         msj_error = "Debe de seleccionar si es licenciado de las Fuerzas Armadas";
         
     }else if(!$("#si_deportista").is(':checked') && !$("#no_deportista").is(':checked')){
         
         msj_error = "Debe de seleccionar si es Deportista Calificado";
         
     }else 
     
     if($("#si_discapacidad").is(':checked') && $('#file_discapacidad').val() == "" && $('#input_hide_disc').val() == "0"){
         
         msj_error = "Debe de cargar su archivo que fundamente su discapacidad";
         
     }else if($("#si_ffaa").is(':checked') && $('#file_ffaa').val() =="" && $('#input_hide_ffaa').val() == "0"){
         
         msj_error = "Debe de cargar su archivo que fundamente que es licenciado de las fuerzas armadas";
         
     }else if($("#si_deportista").is(':checked') && $('#file_deportista').val() == "" && $('#input_hide_deport').val() == "0"){
         
         msj_error = "Debe de cargar su archivo que fundamente que es Deportista Calificado";
         
     }
     
     if(msj_error != ""){
        Swal.fire({
            type: 'warning',
            title: "¡Información!",
            text: msj_error,
            timer: null
        })
        return false;
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
 
     $('#loading-screen').fadeIn(); //PRELOADER INICIO
          
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
               // console.log("success= ",data);
               $('#loading-screen').fadeOut(); //PRELOADER FIN
               Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Datos de usuario actualizado",
                showConfirmButton: false,
                timer: 2000
            });
            
            
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
                // console.log("error");
             }
 
         });
 
      //   arrayExp.estado = true;
      //   arrayExp.msjok = "Datos actualizados";
      //   return arrayExp;
 
     }
 
   /*  function cumplehoras_totales(hrsminima_total,mihrs_total){
     var resultado; 
     if(mihrs_total<hrsminima_total){
         resultado = true;
      }else{
          resultado = false;
      }
      
   return resultado;
  }
  */
/* function cumple_exp_genyesp(){
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
 
 }*/
 /*
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
 
 }*/
 
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
 
 
  //______________________FUNCIONES TABLA_POSTULAR________________________________

//_______________________________GUARDAR NUEVA FORMACION ACADÉMICA_________________________
function guardar_formac(){
    
    var forms4 = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms4, function(form4) {
    
        if (form4.checkValidity() === false) {
           // event.preventDefault();
            //event.stopPropagation();
            form4.classList.add('was-validated');
            
        }else{
            guardar_formacion_data();
            form4.classList.remove('was-validated');    
        }
  
});

}
//_________________actualizar formacion académica__________________
function actualizar_formac(transid){
    var forms5 = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms5, function(form5) {
    
        if (form5.checkValidity() === false) {
           // event.preventDefault();
            //event.stopPropagation();
            form5.classList.add('was-validated');
            
        }else{
            actualizar_formac_data(transid);
            form5.classList.remove('was-validated');    
        }
    })

}

function actualizar_formac_data(transid){

    var id=transid.substring(7);
    var especialidad_tratada= "";
    if($("#tipo_estudio").val()==2 || $("#tipo_estudio").val()==3){
        especialidad_tratada = "-";
    }else{
        especialidad_tratada= $("#especialidad").val();
    }

    var formData = new FormData();
    formData.append('id',id);
    formData.append('grado_id',$("#tipo_estudio").val());
    formData.append('fecha_inicio',$("#fecha_inicio").val());
    formData.append('fecha_fin', $("#fecha_fin").val());
    formData.append('fecha_expedicion',$("#fecha_exp").val());
    formData.append('centro_estudios',$("#centro_estudio_form").val());
    formData.append( 'especialidad',especialidad_tratada);
    formData.append('ciudad',$("#ciudad_form").val());
    formData.append('pais',$("#pais_form").val());
    formData.append('archivo_formacion',$("#documento_formac").prop('files')[0]);
    
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                        
                               
    $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/actualizar_formac_data",
            type: "POST" ,
            datatype: "json",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                //console.log("dataform=>",data);
                var href_form_ed="#";
            if(data[0].archivo != null){
                href_form_ed = data[0].archivo.replace('public/','/storage/');
            }
               var filahtml = 
              "<td>"+data[0].nombre+"</td>"+
              "<td>"+data[0].especialidad+"</td>"+
              "<td>"+data[0].centro_estudios+"</td>"+
              "<td>"+data[0].fecha_expedicion+"</td>"+
              "<td><a href='"+href_form_ed+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_form('tblform"+data[0].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
             "   <button type='button' onclick=\"eliminar('tblform"+data[0].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>";

            $('#modal_nueva_formacion').modal('hide');
            $('#loading-screen').fadeOut(); //PRELOADER FIN
                                         
               Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Formacion actualizada",
                showConfirmButton: false,
                timer: 2000
            });

            var iddd="tblform"+data[0].id;
               
               $("#"+iddd).html(filahtml);
               
            },
            error: function(data){
                alert("error!!")

            }

        });
}


//_______________________________GUARDAR NUEVA CAPACITACION_________________________
function guardar_capacitacion(){
    
    var forms6 = document.getElementsByClassName('needs-validation2');
// Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms6, function(form6) {
    
        if (form6.checkValidity() === false) {
           // event.preventDefault();
            //event.stopPropagation();
            form6.classList.add('was-validated');
            
        }else{
            guardar_capacitacion_data();
            form6.classList.remove('was-validated');    
        }
  
});

}

//_________________ACTUALIZAR CAPACITACION__________________
function actualizar_capac(transid){
    var forms7 = document.getElementsByClassName('needs-validation2');
// Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms7, function(form7) {
    
        if (form7.checkValidity() === false) {
           // event.preventDefault();
            //event.stopPropagation();
            form7.classList.add('was-validated');
            
        }else{
            actualizar_capacitacion_data(transid);
            form7.classList.remove('was-validated');    
        }
    })

}

function actualizar_capacitacion_data(transid){
    var id=transid.substring(8);
    var es_curso_espec=0;
    var es_especializacion=0;
    var es_diplomado=0;
    var  es_ofimatica=0;
     var es_idioma=0;   
     var nivel_tratada="";
     
    /* if(!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))){
 
         Swal.fire({
             type: 'error',
             title: "¡Error!",
             text: "No cumple con mínimo de horas de curso/capacitación",
             icon: "error",
             timer: false,
         })
         return false;
     }  */
 
     if($("#tipo_capacitacion").val()==1){
        es_curso_espec=1;
        es_especializacion = 0;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==2){
        es_curso_espec=0;
        es_especializacion = 1;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==3){
        es_curso_espec=0;
        es_especializacion = 0;
        es_diplomado = 1;
        es_ofimatica=0;
        es_idioma=0;
        nivel_tratada =  "-";
    }
    if($("#tipo_capacitacion").val()==4){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=1;
       es_idioma=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==5){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=1;
       nivel_tratada = $("#nivel_capa").val();
   }
     
     var formData = new FormData();
     formData.append('id', id);
     formData.append('es_curso_espec', es_curso_espec);
     formData.append('es_especializacion', es_especializacion);
     formData.append('es_diplomado', es_diplomado);
    formData.append('es_ofimatica', es_ofimatica);
    formData.append('es_idioma', es_idioma);
    formData.append('especialidad', $("#descripcion").val());
    formData.append('centro_estudios', $("#institucion").val());
    formData.append('pais', $("#pais_capacit").val());
    formData.append('ciudad', $("#ciudad_capacit").val());
    formData.append('fechainicio_capac', $("#fechainicio_capac").val());
    formData.append('fechafin_capac', $("#fechafin_capac").val());
    formData.append('nivel_capa', nivel_tratada);
    formData.append('cantidad_horas', $("#horaslectivas").val());
    formData.append('archivo_capacitacion',$("#documento_capa").prop('files')[0]);
    
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
    
    $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         url: "/postulante/actualizarcapacitacion_data",
         type: "POST" ,
         datatype: "json",
         data: formData,
         cache:false,
         contentType: false,
         processData: false,
         success:function(data){
            //console.log(data);
             //alert("datos guardados CAPACITACION!! ");
             var tipoestudio="";
             if(data[0].es_curso_espec==1){
                tipoestudio = "Curso";
            }
            if(data[0].es_especializacion==1){
               tipoestudio = "Especialización";
           }
           if(data[0].es_diplomado==1){
               tipoestudio = "Diplomado";
           }
             if(data[0].es_ofimatica==1){
                 tipoestudio = "Ofimática";
             }
             if(data[0].es_idioma==1){
                 tipoestudio = "Idioma";
             } 
             
             var href_cap="#";
             if(data[0].archivo != ""){
                href_cap=data[0].archivo.replace("public/", '/storage/');
             }

           var filahtml = 
           "<td>"+tipoestudio+"</td>"+
           "<td>"+data[0].especialidad+"</td>"+
           "<td>"+data[0].centro_estudios+"</td>"+
           "<td>"+data[0].cantidad_horas+"</td>"+
           "<td><a href='"+href_cap+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_capac('tblcapac"+data[0].id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
            "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data[0].id+"');\" class=' btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
           "</td>";
           
           $('#modal_nuevo').modal('hide');
           $('#loading-screen').fadeOut(); //PRELOADER FIN
           Swal.fire({
             position: 'top-end',
             type: 'success',
             title: "Curso/Capacitación actualizado",
             showConfirmButton: false,
             timer: 2000
         });
 
         var iddd="tblcapac"+data[0].id;
         
         $("#"+iddd).html(filahtml);
  
           // $('#total_horas').val(parseFloat($('#total_horas').val()) + parseFloat(data.cantidad_horas));
          
         },
         error: function(data){
             alert("error!!")
 
         }
 
     });
}

// ______________________________GUARDAR NUEVA EXPERIENCIA USUARIO_________________________________

function guardar_experiencia(){
    
    var forms3 = document.getElementsByClassName('needs-validation3');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms3, function(form3) {
    
        if (form3.checkValidity() === false) {
           // event.preventDefault();
            //event.stopPropagation();
            form3.classList.add('was-validated');
            
        }else{
            //event.preventDefault();
            guardar_experiencia_data();
            form3.classList.remove('was-validated');    
        }
   
    });

}
//_____________________________GUARDAR EXPERIENCIA DATA___________________

function guardar_experiencia_data(){

    var Fechs_inicio_val = new Date($("#fecha_inicio_exp").val()+" 00:00:00");
    var Fecha_fin_val = new Date($("#fecha_fin_exp").val()+" 00:00:00");
     
    if(Fecha_fin_val.getTime() < Fechs_inicio_val.getTime()){
        Swal.fire({
            type: 'warning',
            title: "¡Información!",
            text: "La 'FECHA FIN' no puede ser menor a la 'FECHA INICIO'",
            timer: null
        })
        return false;
    
    }else if(Fecha_fin_val.getTime() == Fechs_inicio_val.getTime()){
        Swal.fire({
            type: 'warning',
            title: "¡Información!",
            text: "La 'FECHA FIN' no puede ser igual a la 'FECHA INICIO'",
            timer: null
        })
        return false;
    }
    
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
    
    var formData = new FormData();
    //formData.append('idproceso',$('#datospostulante').data('id'));
    formData.append('es_exp_gen',exp_general);
    formData.append('es_exp_esp',exp_especifica);
    formData.append('tipo_institucion', $("#tipo_entidad").val());
    formData.append('tipo_experiencia',$("#tipo_experiencia").val());
    formData.append('centro_laboral', $("#nombre_entidad").val());
    formData.append('cargo_funcion', $("#cargo_exp").val());
    formData.append('desc_cargo_funcion', $("#funciones_princi").val());
    formData.append('fecha_inicio', $("#fecha_inicio_exp").val());
    formData.append('fecha_fin' , $("#fecha_fin_exp").val());
    //formData.append('num_pag' , $("#num_pag").val());
    formData.append('dias_exp_gen', diasexpgen);
    formData.append('dias_exp_esp', diasexpesp);
    formData.append('archivo_experiencia',$("#documento_exp").prop('files')[0]);
   
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
        
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/guardarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
           var tipo_exp; 
            marcadogeneral="";
            marcadoespecifico="";
           if(data.query.es_exp_gen==1){marcadogeneral="GENERAL";}
           if(data.query.es_exp_esp==1){marcadoespecifico="y <br> ESPECÍFICA";}
          
           if(data.query.tipo_experiencia == '1'){
            tipo_exp="Experiencia Laboral";
          }else if(data.query.tipo_experiencia == '2'){
            tipo_exp="Prácticas Pre Profesionales";
          }else if(data.query.tipo_experiencia == '3'){
            tipo_exp="Prácticas Profesionales";
          }

           var href_exp="#";
           if(data.query.archivo != ""){
            href_exp=data.query.archivo.replace("public/", '/storage/');
           }

            var fila = "<tr id='tblexp"+data.query.id+"'>"+
            "<td>"+tipo_exp+"</td>"+
            "<td>"+marcadogeneral + marcadoespecifico+"</td>"+
            
            "<td>"+data.query.centro_laboral+"</td>"+
            "<td>"+data.query.cargo_funcion+"</td>"+
            "<td>"+data.query.fecha_inicio+"</td>"+
            "<td>"+data.query.fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.query.dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "<button type='button' onclick=\"editar_expe('tblexp"+data.query.id+"');\" class='btn btn-warning' data-toggle=\"modal\" ><i class=\"fas fa-edit\"></i></button>"+
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data.query.id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>"+
            "</tr>";
           $('#zeroconfig3_body').prepend(fila);
           
           $('#modal_nueva_experiencia').modal('hide');
           $('#loading-screen').fadeOut(); //PRELOADER FIN
           Swal.fire({
            position: 'top-end',
            type: 'success',
            title: "Experiencia registrada",
            showConfirmButton: false,
            timer: 2000
        })
        
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
         
       //________________fin proceso interseccion 

          // var totaldias_gen=parseInt(data.suma_expgen);
          // var totaldias_esp=parseInt(data.suma_expesp);
          $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
           $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
        },
        error: function(data){
            alert("error!!");

        }

    });
}
//______________________________ACTUALIZAR DATOS EXPERIENCIA_______________________

function actualizar_expe(transid){
    
    var forms3 = document.getElementsByClassName('needs-validation3');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms3, function(form) {
        
            if (form.checkValidity() === false) {
               // event.preventDefault();
                //event.stopPropagation();
                form.classList.add('was-validated');
                
            }else{
                actualizar_experiencia_data(transid);
                form.classList.remove('was-validated');
            }
 })
   
}

//_________________________actualizar_experiencia_data_____________________

function actualizar_experiencia_data(transid){
        
    var Fechs_inicio_val = new Date($("#fecha_inicio_exp").val()+" 00:00:00");
    var Fecha_fin_val = new Date($("#fecha_fin_exp").val()+" 00:00:00");
     
    if(Fecha_fin_val.getTime() < Fechs_inicio_val.getTime()){
        Swal.fire({
            type: 'warning',
            title: "¡Información!",
            text: "La 'FECHA FIN' no puede ser menor a la 'FECHA INICIO'",
            timer: null
        })
        return false;
    
    }else if(Fecha_fin_val.getTime() == Fechs_inicio_val.getTime()){
        Swal.fire({
            type: 'warning',
            title: "¡Información!",
            text: "La 'FECHA FIN' no puede ser igual a la 'FECHA INICIO'",
            timer: null
        })
        return false;
    }

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
    
    var formData = new FormData();
    //formData.append('idproceso',$('#datospostulante').data('id'));
    formData.append('id',id);
    formData.append('es_exp_gen',exp_general);
    formData.append('es_exp_esp',exp_especifica);
    formData.append('tipo_institucion', $("#tipo_entidad").val());
    formData.append('tipo_experiencia',$("#tipo_experiencia").val());
    formData.append('centro_laboral', $("#nombre_entidad").val());
    formData.append('cargo_funcion', $("#cargo_exp").val());
    formData.append('desc_cargo_funcion', $("#funciones_princi").val());
    formData.append('fecha_inicio', $("#fecha_inicio_exp").val());
    formData.append('fecha_fin' , $("#fecha_fin_exp").val());
    //formData.append('num_pag' , $("#num_pag").val());
    formData.append('dias_exp_gen', diasexpgen);
    formData.append('dias_exp_esp', diasexpesp);
    formData.append('archivo_experiencia',$("#documento_exp").prop('files')[0]);
    
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                                                        
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/actualizarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            //console.log(data);
            //alert(data);
            var tipo_exp;
          var marcadogeneral="";
            var marcadoespecifico="";
           if(data.query[0].es_exp_gen==1){marcadogeneral="GENERAL";}
           if(data.query[0].es_exp_esp==1){marcadoespecifico="y <br> ESPECÍFICA";}
            
           if(data.query[0].tipo_experiencia == '1'){
            tipo_exp="Experiencia Laboral";
          }else if(data.query[0].tipo_experiencia == '2'){
            tipo_exp="Prácticas Pre Profesionales";
          }else if(data.query[0].tipo_experiencia == '3'){
            tipo_exp="Prácticas Profesionales";
          }

           var href_exp="#";
           if(data.query[0].archivo != ""){
            href_exp=data.query[0].archivo.replace("public/", '/storage/');
           }

          var filahtml =
            "<td>"+tipo_exp+"</td>"+
            "<td>"+marcadogeneral + marcadoespecifico+"</td>"+
            
            "<td>"+data.query[0].centro_laboral+"</td>"+
            "<td>"+data.query[0].cargo_funcion+"</td>"+
            "<td>"+data.query[0].fecha_inicio+"</td>"+
            "<td>"+data.query[0].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.query[0].dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "   <button type='button' onclick=\"editar_expe('tblexp"+data.query[0].id+"');\" class='btn btn-warning' data-toggle=\"modal\" ><i class=\"fas fa-edit\"></i></button>"+
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data.query[0].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>";
            
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
         
       //________________fin proceso interseccion_______________

            //var totaldias_gen=parseInt(data.suma_expgen);
           //var totaldias_esp=parseInt(data.suma_expesp);
           $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
           $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
            
            var iddd="tblexp"+data.query[0].id;

            $('#modal_nueva_experiencia').modal('hide');
            $('#loading-screen').fadeOut(); //PRELOADER FIN
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Experiencia actualizada",
                showConfirmButton: false,
                timer: 2000
            })

            
            $("#"+iddd).html(filahtml);
           
            
           
         },
        error: function(data){
            alert("error!!");

        }
        
       

    });
}

//________________________FUNCIONES EXTRAS____________________________
function cumplehoras_porcapa(hrsminima,hrsdecapa){
    var resultado; 
    if(hrsdecapa>=hrsminima){
        resultado = true;
     }else{
         resultado = false;
     }
     
  return resultado;
 }


 function guardar_formacion_data(){
     
    var especialidad_tratada= "";
    if($("#tipo_estudio").val()==2 || $("#tipo_estudio").val()==3){
        especialidad_tratada = "-";
    }else{
        especialidad_tratada= $("#especialidad").val();
    }

    var formData = new FormData();
    formData.append('grado_id',$("#tipo_estudio").val());
    formData.append('fecha_inicio',$("#fecha_inicio").val());
    formData.append('fecha_fin', $("#fecha_fin").val());
    formData.append('fecha_expedicion',$("#fecha_exp").val());
    formData.append('centro_estudios',$("#centro_estudio_form").val());
    formData.append( 'especialidad',especialidad_tratada);
    formData.append('ciudad',$("#ciudad_form").val());
    formData.append('pais',$("#pais_form").val());
    formData.append('archivo_formacion',$("#documento_formac").prop('files')[0]);
   
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
                                    
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/guardarformacion",
            type: "POST" ,
            datatype: "json",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
             
             var href_form="#";
            if(data.archivo != ""){
                href_form=data.archivo.replace("public/", '/storage/');
            }
                
              var fila = "<tr id='tblform"+data.id+"'>"+
              "<td>"+data.nombre+"</td>"+
              "<td>"+data.especialidad+"</td>"+
              "<td>"+data.centro_estudios+"</td>"+
              "<td>"+data.fecha_expedicion+"</td>"+
              "<td><a href='"+href_form+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
              "   <button type='button' onclick=\"editar_form('tblform"+data.id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
              "   <button type='button' onclick=\"eliminar('tblform"+data.id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+

              "</td>"+
              "</tr>";
               $('#zeroconfig1_body').prepend(fila); 
              
               $('#modal_nueva_formacion').modal('hide');
               $('#loading-screen').fadeOut(); //PRELOADER FIN
               Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Formacion registrada",
                showConfirmButton: false,
                timer: 2000
            })
               
               
            },
            error: function(data){
                alert("error!!")

            }

        });
 }


 //__________________________________-GUARDAR CURSO CAPACITACION _________________________________
 function guardar_capacitacion_data(){
    var es_curso_espec=0;
    var es_especializacion=0;
    var es_diplomado=0;
    var  es_ofimatica=0;
     var es_idioma=0;   
     var nivel_tratada="";
     
   /*  if(!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))){
 
         Swal.fire({
             type: 'error',
             title: "¡Error!",
             text: "No cumple con mínimo de horas de curso/capacitación",
             icon: "error",
             timer: false,
         })
         return false;
     }
    */
     if($("#tipo_capacitacion").val()==1){
         es_curso_espec=1;
         es_especializacion = 0;
         es_diplomado = 0;
         es_ofimatica=0;
         es_idioma=0;
         nivel_tratada = "-";
     }
     if($("#tipo_capacitacion").val()==2){
         es_curso_espec=0;
         es_especializacion = 1;
         es_diplomado = 0;
         es_ofimatica=0;
         es_idioma=0;
         nivel_tratada = "-";
     }
     if($("#tipo_capacitacion").val()==3){
         es_curso_espec=0;
         es_especializacion = 0;
         es_diplomado = 1;
         es_ofimatica=0;
         es_idioma=0;
         nivel_tratada =  "-";
     }
     if($("#tipo_capacitacion").val()==4){
        es_curso_espec=0;
        es_especializacion = 0;
        es_diplomado = 0;
        es_ofimatica=1;
        es_idioma=0;
        nivel_tratada = $("#nivel_capa").val();
    }
    if($("#tipo_capacitacion").val()==5){
        es_curso_espec=0;
        es_especializacion = 0;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=1;
        nivel_tratada = $("#nivel_capa").val();
    }
 
     var formData = new FormData();
     formData.append('es_curso_espec', es_curso_espec);
     formData.append('es_especializacion', es_especializacion);
     formData.append('es_diplomado', es_diplomado);
     formData.append('es_ofimatica', es_ofimatica);
    formData.append('es_idioma', es_idioma);
    formData.append('especialidad', $("#descripcion").val());
    formData.append('centro_estudios', $("#institucion").val());
    formData.append('pais', $("#pais_capacit").val());
    formData.append('ciudad', $("#ciudad_capacit").val());
    formData.append('fechainicio_capac', $("#fechainicio_capac").val());
    formData.append('fechafin_capac', $("#fechafin_capac").val());
    formData.append('nivel_capa', nivel_tratada);
    formData.append('cantidad_horas', $("#horaslectivas").val());
    formData.append('archivo_capacitacion',$("#documento_capa").prop('files')[0]);
    
    $('#loading-screen').fadeIn(); //PRELOADER INICIO
        
    $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         url: "/postulante/guardarcapacitacion",
         type: "POST" ,
         datatype: "json",
         data: formData,
         cache:false,
        contentType: false,
        processData: false,
         success:function(data){
            
             var tipoestudio="";
             if(data.es_curso_espec==1){
                tipoestudio = "Curso";
            }
            if(data.es_especializacion==1){
               tipoestudio = "Especialización";
           }
           if(data.es_diplomado==1){
               tipoestudio = "Diplomado";
           }
             if(data.es_ofimatica==1){
                 tipoestudio = "Ofimática";
             }
             if(data.es_idioma==1){
                 tipoestudio = "Idioma";
             } 
             
             var href_form="#";
             if(data.archivo != ""){
                 href_form=data.archivo.replace("public/", '/storage/');
             }

           var fila = "<tr id='tblcapac"+data.id+"'>"+
           "<td>"+tipoestudio+"</td>"+
           "<td>"+data.especialidad+"</td>"+
           "<td>"+data.centro_estudios+"</td>"+
           "<td>"+data.cantidad_horas+"</td>"+
           "<td><a href='"+href_form+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "    <button type='button' onclick=\"editar_capac('tblcapac"+data.id+"');\" class='btn btn-warning'><i class=\"fas fas fa-edit\"></i></button>"+ 
            "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data.id+"');\" class=' btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
           "</td>"+
           "</tr>";

           $('#modal_nuevo').modal('hide');
           $('#loading-screen').fadeOut(); //PRELOADER FIN
           Swal.fire({
             position: 'top-end',
             type: 'success',
             title: "Curso/Capacitación guardado",
             showConfirmButton: false,
             timer: 2000
         });
 
            $('#zeroconfig2_body').prepend(fila); 
           // $('#total_horas').val(parseFloat($('#total_horas').val()) + parseFloat(data.cantidad_horas));
            
            
            
         },
         error: function(data){
             alert("error!!")
 
         }
 
     });
 
 }

 function mensaje_tamaño_archivo(){
    Swal.fire({
        type: 'warning',
        title: "¡Información!",
        text: "El archivo seleccionado supera los 5MB en tamaño, seleccione otro archivo.",
        timer: null
    })
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
                        
        }else if(F1_fin.getTime() == F2_inicio.getTime()){
            Inter_inicio = F1_f;
            Inter_fin = F2_i;
            Union_inicio = F1_i;
            Union_fin = F2_f;
            
        }else if(F1_fin.getTime() > F2_inicio.getTime()){
            
            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                
            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                
            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                            }
        }    
    }else if(F1_inicio.getTime() == F2_inicio.getTime()){

        if(F1_fin.getTime() > F2_inicio.getTime()){

            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F2_f;
                
            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                
            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F2_i;
                Inter_fin = F2_f;
                Union_inicio = F1_i;
                Union_fin = F1_f;
                            }
        
        }else if(F1_fin.getTime() == F2_inicio.getTime()){
            if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = null;
                Union_fin = null;
                
            }
        }
    }else if(F1_inicio.getTime() > F2_inicio.getTime()){

        if(F1_inicio.getTime() < F2_fin.getTime()){

            if(F1_fin.getTime() < F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F2_i;
                Union_fin = F2_f;
                            
            }else if(F1_fin.getTime() == F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F1_f;
                Union_inicio = F2_i;
                Union_fin = F2_f;
                            
            }else if(F1_fin.getTime() > F2_fin.getTime()){
                Inter_inicio = F1_i;
                Inter_fin = F2_f;
                Union_inicio = F2_i;
                Union_fin = F1_f;
                            
            }
        }else if(F1_inicio.getTime() == F2_fin.getTime()){
            Inter_inicio = F1_i;
            Inter_fin = F2_f;
            Union_inicio = F2_i;
            Union_fin = F1_f;
            
        }else if(F1_inicio.getTime() > F2_fin.getTime()){
            Inter_inicio = null;
            Inter_fin = null;
            Union_inicio = null;
            Union_fin = null;
            
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

        if(Fechas.length != 0){
       
                        
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
                 
                 Fechas[i].f_inicio = resultado.u_inicio;
                 Fechas[i].f_fin = resultado.u_fin;
              
                 FechasFijas.splice(y, 1);
                 y--;
                }else{
                 
                 FechasFijas[y].f_inicio = resultado.u_inicio;
                 FechasFijas[y].f_fin = resultado.u_fin;
                 
                 Fechas[i].f_inicio = resultado.u_inicio;
                 Fechas[i].f_fin = resultado.u_fin;
                 
                 val_inter = y;
                }
                
             }else {

                 if(y == FechasFijas.length - 1 && cont == 0){
                     FechasFijas.push({f_inicio: Fechas[i].f_inicio, f_fin: Fechas[i].f_fin});
                     y++;
                     }
             }
         }
         
 
     }
               
     var total_dias = 0;
     for ( i = 0 ; i < FechasFijas.length ; i++){
         var fechainicio=moment(FechasFijas[i].f_inicio);
         var fechafin=moment(FechasFijas[i].f_fin);
         var dias=fechafin.diff(fechainicio,"days");
                  total_dias += dias;
         }

           
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