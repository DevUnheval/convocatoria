function validar_form(idbtn){
    
    var valor_validacion=0;
   // console.log(dias_gen+" "+dias_esp+" "+idbtn);

    if($('#'+idbtn).hasClass('ti-layout-width-full')){
         
         $('#'+idbtn).removeClass('ti-layout-width-full');
         $('#'+idbtn).addClass('fa fa-check');
         valor_validacion= 1;

    }else if($('#'+idbtn).hasClass('fa fa-check')){

        $('#'+idbtn).removeClass('fa fa-check');
        $('#'+idbtn).addClass('ti-layout-width-full');
        valor_validacion= 0;
    }
    
    var idform = idbtn.substring(4);
    $.ajax({
       // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulantes/datosuserform/"+idform+"/"+valor_validacion+"/guardar_validacion",
        type: "GET",
        datatype: "json",
        success:function(data){
           // console.log("validación guardada");
        },error:function(data){
            console.log("validación error form");
        } 
    })
}

function validar_capa(idbtn){
    var valor_validacion=0;
    if($('#'+idbtn).hasClass('ti-layout-width-full')){
         
         $('#'+idbtn).removeClass('ti-layout-width-full');
         $('#'+idbtn).addClass('fa fa-check');
         valor_validacion= 1;

    }else if($('#'+idbtn).hasClass('fa fa-check')){

        $('#'+idbtn).removeClass('fa fa-check');
        $('#'+idbtn).addClass('ti-layout-width-full');
        valor_validacion= 0;
    }
    
    var idcapa = idbtn.substring(4);
    $.ajax({
       // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulantes/datosusercapa/"+idcapa+"/"+valor_validacion+"/guardar_validacion",
        type: "GET",
        datatype: "json",
        success:function(data){
           // console.log("validación guardada");
        },error:function(data){
            console.log("validación error capa");
        } 
    })
}

function validar_exp(idbtn){
   // var totaldias_gen=parseInt($('#hidden_expgen_t').val());
    //var totaldias_esp=parseInt($('#hidden_expesp_t').val());
    var valor_validacion=0;
   // console.log(dias_gen+" "+dias_esp+" "+idbtn);

    if($('#'+idbtn).hasClass('ti-layout-width-full')){
         
         $('#'+idbtn).removeClass('ti-layout-width-full');
         $('#'+idbtn).addClass('fa fa-check');
        // totaldias_gen= totaldias_gen + parseInt(dias_gen);
         //totaldias_esp= totaldias_esp + parseInt(dias_esp);
         valor_validacion= 1;

    }else if($('#'+idbtn).hasClass('fa fa-check')){

        $('#'+idbtn).removeClass('fa fa-check');
         $('#'+idbtn).addClass('ti-layout-width-full');
         //totaldias_gen= totaldias_gen - parseInt(dias_gen);
         //totaldias_esp= totaldias_esp - parseInt(dias_esp);
         valor_validacion= 0;
    }
    //ti-layout-width-full - fas fa-check
    //$('#hidden_expgen_t').val(totaldias_gen);
    //$('#hidden_expesp_t').val(totaldias_esp);
    //$('#total_exp_general').val(anios_meses_dias(totaldias_gen));
    //$('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));

    $.ajax({
       // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulantes/datosuserexp/"+idbtn+"/"+valor_validacion+"/guardar_validacion",
        type: "GET",
        datatype: "json",
        success:function(data){
          // console.log("data:",data);

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

        $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
        $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
         
       //________________fin proceso interseccion 


        },error:function(data){
            console.log("validación error");
        } 
    })

    

}

function mostrar_modalcv(idpostulante,iduser,$etapa, $proceso_id,$ev_con,$vista){
 //CARGAR DATA al BOTON 
    $("#btn_guardar_evaluacion_cv").attr("data-proceso_id",$proceso_id);
    $("#btn_guardar_evaluacion_cv").attr("data-etapa",$etapa);
    $("#btn_guardar_evaluacion_cv").attr("data-ev_con",$ev_con);
    $("#btn_guardar_evaluacion_cv").attr("data-vista",$vista);
    //MiniFormulario
    $("#input_puntaje_curricular_1").attr("name",`evaluacion[${idpostulante}]`);
    $("#textarea_puntaje_curricular_1").attr("name",`observacion[${idpostulante}][obs_curricular]`);
    if($etapa=='1'){//en las diguientes etapas el formulario no se crea, por lo que retiornaria error, y no abre el modal
        document.getElementById("form_ev_curricular_1").reset();
    }
 //alert(idpostulante);
 $('#total_exp_general').val("0");
 $('#total_exp_especifica').val("0");

 $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: "/postulantes/datosuser/cargar_cv/"+idpostulante+"/"+iduser,
    type: "GET" ,
    datatype: "json",
    success:function(data){ 
      //FORMULARIO OPCIONAL Ev. Currocular
      $("#input_puntaje_curricular_1").val(parseInt(data.postulante.ev_curricular,10));
      $("#textarea_puntaje_curricular_1").html(data.postulante.obs_curricular); 
     // console.log(data);
      var esdisc = "";
      var esffaa = "";
      var esdep = "";
      $("#ruta_cv_postulante").attr("href","/reportes/cv/"+idpostulante);
      $("#ruta_cv_postulante2").attr("href","/reportes/cv2/"+idpostulante);
      if(data.quser!=null){
      $('#postulante').html(data.quser.apellido_paterno+" "+data.quser.apellido_materno+", "+data.quser.nombres);
        $('#apellidosynombres').html(data.quser.apellido_paterno+" "+data.quser.apellido_materno+", "+data.quser.nombres);
        $('#dni').html(data.quser.dni);
        $('#dnicab').html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "+data.quser.dni);
        $('#email').html(data.postulante.email);
        
    }else{
        $('#postulante').html("");
        $('#apellidosynombres').html("");
        $('#dni').html("");
        $('#dnicab').html("");
        $('#email').html("");
    }
    
    if(data.qdatos!=null){
        if(data.qdatos.archivo_foto != null){
            var src = data.qdatos.archivo_foto.replace('public/','/storage/');
            $('#foto_perfil').prop('src',src);
        }else{
            $('#foto_perfil').prop("src", asset+"/imagenes/users/user.png"); // asset esta declarado en la vista index de postulantes
        }
 
       $('#res_fecha_nac').html(data.qdatos.fecha_nacimiento);
             $('#res_ubigeo_nac').html(data.qdatos.ubigeo_nacimiento);
       $('#res_ruc').html(data.qdatos.ruc);
       $('#res_celular').html(data.qdatos.telefono_celular);
       $('#res_nacionalidad').html(data.nacionalidad);
           
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
    $('#res_ubigeo_direc').html(html_dom);
    }

       //_______________________FIN TRANSFORMAR UBIGEOS_________________________
       $('#res_direccion').html(data.qdatos.domicilio+" ("+html_dom+")");   

     //_______________________discap ffaa deportista_________________________
       if(data.qdatos.es_pers_disc == 1){
        esdisc= "SI";
        if(data.qdatos.archivo_disc != null){
          var href_disc=data.qdatos.archivo_disc.replace("public/", '/storage/');
           esdisc += "<span class='ml-3'><a href='"+href_disc+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a></span>";
            }
        }else {esdisc = "NO";}
        $('#res_disc').html(esdisc);
        
        if(data.qdatos.es_lic_ffaa == 1){
            esffaa= "SI";
        if(data.qdatos.archivo_ffaa != null){
           var href_ffaa=data.qdatos.archivo_ffaa.replace("public/", '/storage/');
            esffaa += "<span class='ml-3'><a href='"+href_ffaa+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a></span>";
             }
         }else {esffaa = "NO";}
         $('#res_ffaa').html(esffaa); 

         if(data.qdatos.es_deportista == 1){
            esdep= "SI";
        if(data.qdatos.archivo_deport != null){
           var href_dep=data.qdatos.archivo_deport.replace("public/", '/storage/');
           esdep += "<span class='ml-3'><a href='"+href_dep+"' target=\"_blank\" class='btn btn-info' type='button'>ver documento<i class=\"fas fa-download\"></i></a></span>";
             }
         }else {esdep = "NO";}
         $('#res_depor').html(esdep);
//_______________________ FIN discap ffaa deportista_________________________

    }else{
        $('#res_fecha_nac').html("");
        $('#res_ubigeo_nac').html("");
        $('#res_ruc').html("");
        $('#res_celular').html("");
        $('#res_direccion').html("");
        $('#res_disc').html("");
       $('#res_ffaa').html("");
       $('#res_depor').html("");
       $('#foto_perfil').prop("src", asset+"/imagenes/users/user.png");
    }
        //llenar formacion
        if(data.qdatos.colegiatura != null){
            $('#dato_colegiado').html("<i class=\"fas fa-info-círculo\"></i>"+"<strong> Me encuentro COLEGIADO y HABILITADO: </strong>"+data.qdatos.colegiatura);
            var href_lic;
                
            if(data.qdatos.archivo_colegiatura != null){
                    href_lic = data.qdatos.archivo_colegiatura.replace('public/', '/storage/');
                    var html_lic = "<a href='"+href_lic+"' target=\"_blank\" class='btn btn-info'>ver documento<i class=\"fas fa-download\"></i></a>";
                        $('#btn_doc_colegiatura').html(html_lic);
                                               
                    }
          }else{
              $('#dato_colegiado').html("<i class=\"fas fa-info-círculo\"></i>"+"<strong> No me encuentro COLEGIADO.</strong>");
          }

        if(data.qform[0]!=null){  
        var html_resform = "";
        for (var i = 0; i < data.qform.length; i++) {
           
            var href_form="#";
            if(data.qform[i].archivo != null){
                href_form = data.qform[i].archivo.replace('public/','/storage/');
            }

            var icono = 0;
            if(data.qform[i].validacion == 0){
            icono = "ti-layout-width-full";
            }else if(data.qform[i].validacion == 1){
            icono = "fa fa-check";
            }

            html_resform += "<tr>"+
            "<td>"+data.qform[i].nombre+"</td>"+
            "<td>"+data.qform[i].especialidad+"</td>"+
            "<td>"+data.qform[i].centro_estudios+"</td>"+
            "<td>"+data.qform[i].fecha_expedicion+"</td>"+
            "<td><a href='"+href_form+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
             "</td>"+
             "<td class='alert-info border-black'><div  >"+
             "<button type='button' onclick=\"validar_form('form"+data.qform[i].id+"')\" class='btn'><i id='form"+data.qform[i].id+"' class=\""+icono+"\"></i></button>"+
             "</div></td>"+
            "</tr>";
        }
        $('#tbl_cv2').html(html_resform);
    }else{
        $('#tbl_cv2').html("");
    }
        
        //llenar capacitaciones
        if(data.qcapa[0]!=null){  
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
             
             var href_form_ca="#";
             if(data.qcapa[i].archivo != null){
                 href_form_ca = data.qcapa[i].archivo.replace('public/','/storage/');
             }

            var icono = 0;
            if(data.qcapa[i].validacion == 0){
            icono = "ti-layout-width-full";
            }else if(data.qcapa[i].validacion == 1){
            icono = "fa fa-check";
            }

             html_rescap += "<tr>"+
             "<td>"+tipoestudio+"</td>"+
             "<td>"+data.qcapa[i].especialidad+"</td>"+
             "<td>"+data.qcapa[i].centro_estudios+"</td>"+
             "<td>"+data.qcapa[i].cantidad_horas+"</td>"+
             "<td><a href='"+href_form_ca+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
             "</td>"+
             "<td class='alert-info border-black'><div  >"+
             "<button type='button' onclick=\"validar_capa('capa"+data.qcapa[i].id+"')\" class='btn'><i id='capa"+data.qcapa[i].id+"' class=\""+icono+"\"></i></button>"+
             "</div></td>"+
             "</tr>";
             }
             
             $('#tbl_cv3').html(html_rescap);
            }else{
                $('#tbl_cv3').html(""); 
                
            }
       
         //llenar experiencias
         if(data.qexp[0]!=null){  
         var html_resexp = "";
       
        
       // var totaldias_gen=0;
        //var totaldias_esp=0;  
        
        var Fechas_expGen = new Array();
        var Fechas_expEsp = new Array();

        for (var i = 0; i < data.qexp.length; i++) {

           
           var marcadogeneral="";
           var marcadoespecifico="";
           var tipo_exp="";
        if(data.qexp[i].es_exp_gen==1 && data.qexp[i].validacion == 1){
            Fechas_expGen.push({f_inicio: data.qexp[i].fecha_inicio, f_fin: data.qexp[i].fecha_fin}); //capturo fechas de inicio y fin
           
        }
        if(data.qexp[i].es_exp_esp==1 && data.qexp[i].validacion == 1){
            Fechas_expEsp.push({f_inicio: data.qexp[i].fecha_inicio, f_fin: data.qexp[i].fecha_fin}); //capturo fechas de inicio y fin
           
        }

        if(data.qexp[i].es_exp_gen==1){
            marcadogeneral="GENERAL";
        }
        if(data.qexp[i].es_exp_esp==1){
            marcadoespecifico="y <br> ESPECÍFICA";
        }
        
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
        var icono = 0;
        if(data.qexp[i].validacion == 0){
        icono = "ti-layout-width-full";
        }else if(data.qexp[i].validacion == 1){
        //totaldias_gen=totaldias_gen+parseInt(data.qexp[i].dias_exp_gen);
        //totaldias_esp=totaldias_esp+parseInt(data.qexp[i].dias_exp_esp);
        icono = "fa fa-check";
        }
        

        html_resexp += "<tr class=\"\">"+
        "<td>"+tipo_exp+"</td>"+
        "<td>"+marcadogeneral + marcadoespecifico+"</td>"+
        "<td>"+data.qexp[i].centro_laboral+"</td>"+
        "<td>"+data.qexp[i].cargo_funcion+"</td>"+
        "<td>"+data.qexp[i].fecha_inicio+"<br>"+data.qexp[i].fecha_fin+"</td>"+
        "<td>"+data.qexp[i].desc_cargo_funcion+"</td>"+
        "<td>"+anios_meses_dias(parseInt(data.qexp[i].dias_exp_gen))+"</td>"+
        "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-outline-info' type='button'><i class=\"fas fa-download\"></i></a>"+
        "</td>"+
        "<td class='alert-info border-black'><div  >"+
        "<button type='button' onclick=\"validar_exp("+data.qexp[i].id+")\" class='btn'><i id='"+data.qexp[i].id+"' class=\""+icono+"\"></i></button>"+
        "</div></td>"+
        "</tr>";
    }

    $('#tbl_cv4').html(html_resexp);

    //$('#hidden_expgen_t').val(totaldias_gen);
    //$('#hidden_expesp_t').val(totaldias_esp);
    
    $('#total_exp_general').val(verificar_interseccion(Fechas_expGen).tiempo_total_exper);
    $('#total_exp_especifica').val(verificar_interseccion(Fechas_expEsp).tiempo_total_exper);
    
    }else{
        $('#tbl_cv4').html("");
        $('#total_exp_general').val("");
        $('#total_exp_especifica').val("");
    }
   /* //DECLARACION JURADA
    $('#res_dj1').html(data.qdatos.dj1 == 1 ? "SI" : "NO");
    $('#res_dj2').html(data.qdatos.dj2 == 1 ? "SI" : "NO");
    $('#res_dj3').html(data.qdatos.dj3 == 1 ? "SI" : "NO");
    $('#res_dj4').html(data.qdatos.dj4 == 1 ? "SI" : "NO");
    $('#res_dj5').html(data.qdatos.dj5 == 1 ? "SI" : "NO");
    $('#res_dj6').html(data.qdatos.dj6 == 1 ? "SI" : "NO");
    $('#res_dj7').html(data.qdatos.dj7 == 1 ? "SI" : "NO");
    $('#res_dj8').html(data.qdatos.dj8 == 1 ? "SI" : "NO");
    */

    },
    error:function(data){
        console.log("error en resumen postulante");
    }

});
$('#modal_cv').modal('show'); 
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