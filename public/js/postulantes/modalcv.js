function validar_exp(idbtn,dias_gen,dias_esp){
    var totaldias_gen=parseInt($('#hidden_expgen_t').val());
    var totaldias_esp=parseInt($('#hidden_expesp_t').val());
    var valor_validacion=0;
   // console.log(dias_gen+" "+dias_esp+" "+idbtn);

    if($('#'+idbtn).hasClass('ti-layout-width-full')){
         
         $('#'+idbtn).removeClass('ti-layout-width-full');
         $('#'+idbtn).addClass('fa fa-check');
         totaldias_gen= totaldias_gen + parseInt(dias_gen);
         totaldias_esp= totaldias_esp + parseInt(dias_esp);
         valor_validacion= 1;

    }else if($('#'+idbtn).hasClass('fa fa-check')){

        $('#'+idbtn).removeClass('fa fa-check');
         $('#'+idbtn).addClass('ti-layout-width-full');
         totaldias_gen= totaldias_gen - parseInt(dias_gen);
         totaldias_esp= totaldias_esp - parseInt(dias_esp);
         valor_validacion= 0;
    }
    //ti-layout-width-full - fas fa-check
    $('#hidden_expgen_t').val(totaldias_gen);
    $('#hidden_expesp_t').val(totaldias_esp);
    $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
    $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));

    $.ajax({
       // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulantes/datosuser/"+idbtn+"/"+valor_validacion+"/guardar_validacion",
        type: "GET",
        datatype: "json",
        success:function(data){
           // console.log("validación guardada");
        },error:function(data){
            console.log("validación error");
        } 
    })

    

}

function mostrar_modalcv(idpostulante,iduser){
 //alert(idpostulante);
 $('#total_exp_general').val("0");
 $('#total_exp_especifica').val("0");

 $.ajax({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url: "/postulantes/datosuser/cargar_cv/"+idpostulante+"/"+iduser,
    type: "GET" ,
    datatype: "json",
    success:function(data){ 
      //console.log(data);
      var esdisc = "";
      var esffaa = "";
      var esdep = "";
      if(data.quser!=null){
      $('#postulante').html(data.quser.apellido_paterno+" "+data.quser.apellido_materno+", "+data.quser.nombres);
        $('#apellidosynombres').html(data.quser.apellido_paterno+" "+data.quser.apellido_materno+", "+data.quser.nombres);
        $('#dni').html(data.quser.dni);
        $('#dnicab').html(data.quser.dni);
        $('#email').html(data.quser.email);
    }else{
        $('#postulante').html("");
        $('#apellidosynombres').html("");
        $('#dni').html("");
        $('#dnicab').html("");
        $('#email').html("");
    }
    
    if(data.qdatos!=null){
       $('#res_fecha_nac').html(data.qdatos.fecha_nacimiento);
             $('#res_ubigeo_nac').html(data.qdatos.ubigeo_nacimiento);
       $('#res_ruc').html(data.qdatos.ruc);
       $('#res_celular').html(data.qdatos.telefono_celular);
       $('#res_direccion').html(data.qdatos.domicilio);
             $('#res_ubigeo_direc').html(data.qdatos.ubigeo_domicilio);
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
    }
        //llenar formacion
        if(data.qform[0]!=null){  
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
                 tipoestudio = "Curso/Especialización";
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
             html_rescap += "<tr>"+
             "<td>"+tipoestudio+"</td>"+
             "<td>"+data.qcapa[i].especialidad+"</td>"+
             "<td>"+data.qcapa[i].centro_estudios+"</td>"+
             "<td>"+data.qcapa[i].cantidad_horas+"</td>"+
             "<td><a href='"+href_form_ca+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
             "</td>"+
             "</tr>";
             }
             
             $('#tbl_cv3').html(html_rescap);
            }else{
                $('#tbl_cv3').html(""); 
                
            }
       
         //llenar experiencias
         if(data.qexp[0]!=null){  
         var html_resexp = "";
       
        
        var totaldias_gen=0;
        var totaldias_esp=0;  
        
        for (var i = 0; i < data.qexp.length; i++) {

           
           var marcadogeneral="";
           var marcadoespecifico="";
           var tipo_exp="";
        if(data.qexp[i].es_exp_gen==1){marcadogeneral="checked";}
        if(data.qexp[i].es_exp_esp==1){marcadoespecifico="checked";}
        
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
        totaldias_gen=totaldias_gen+parseInt(data.qexp[i].dias_exp_gen);
        totaldias_esp=totaldias_esp+parseInt(data.qexp[i].dias_exp_esp);
        icono = "fa fa-check";
        }
        

        html_resexp += "<tr class=\"\">"+
        "<td>"+tipo_exp+"</td>"+
        "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
        "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
        "<td>"+data.qexp[i].centro_laboral+"</td>"+
        "<td>"+data.qexp[i].cargo_funcion+"</td>"+
        "<td>"+data.qexp[i].fecha_inicio+"</td>"+
        "<td>"+data.qexp[i].fecha_fin+"</td>"+
        "<td>"+anios_meses_dias(parseInt(data.qexp[i].dias_exp_gen))+"</td>"+
        "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-outline-info' type='button'><i class=\"fas fa-download\"></i></a>"+
        "</td>"+
        "<td class='alert-info border-black'><div  >"+
        //"<input style=\"width: 20px; height: 20px\" id=\"check_dj"+i+"\" name=\"check_dj\" value=\"1\" type=\"checkbox\" />"+
        "<button type='button' onclick=\"validar_exp("+data.qexp[i].id+","+data.qexp[i].dias_exp_gen+","+data.qexp[i].dias_exp_esp+")\" class='btn'><i id='"+data.qexp[i].id+"' class=\""+icono+"\"></i></button>"+
        //"<button type='button' onclick='validar_exp()' class='btn bg-white-box'><i class=\"ti-layout-width-full\"></i></button>"+
        //"<button class='btn-outline '><i class=\"\"></i></button>"+far fa-square - ti-layout-width-full - fas fa-check
        "</div></td>"+
        "</tr>";
    }

    $('#tbl_cv4').html(html_resexp);
    $('#hidden_expgen_t').val(totaldias_gen);
    $('#hidden_expesp_t').val(totaldias_esp);
    $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
    $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
    
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