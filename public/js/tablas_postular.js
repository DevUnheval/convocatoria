$(document).ready(function() {

    const selectElement = document.getElementById('check_colegiatura');

    selectElement.addEventListener('change', (event) => {
       
        if(selectElement.checked){
            $('#codigo_colegiatura').prop('disabled',false);
            $('#file_colegiatura').prop('disabled',false);
            $('#codigo_colegiatura').focus();

            $('#cont_colegiatura').addClass('border border-cyan');
            $("#div_colegiatura").show();
        }else{
            $('#codigo_colegiatura').prop('disabled',true);
            $('#file_colegiatura').prop('disabled',true);
            $('#cont_colegiatura').removeClass('border border-cyan');
            $('#codigo_colegiatura').val('');
            $('#btn_doc_colegiatura').html('');
            $('#file_colegiatura').val('');
            $('#input_hide_licenciatura').val('0');
            $("#div_colegiatura").hide();
        }

        
        
    });

    /*
    const selectElement2 = document.getElementById('check_licencia');

    selectElement2.addEventListener('change', (event) => {
       
        if(selectElement2.checked){
            $('#codigo_licencia').prop('disabled',false);
            $('#file_licencia').prop('disabled',false);
            $('#codigo_licencia').focus();

            $('#cont_licencia').addClass('border border-cyan');
            $("#div_licencia").show();
        }else{
            $('#codigo_licencia').prop('disabled',true);
            $('#file_licencia').prop('disabled',true);
            $('#cont_licencia').removeClass('border border-cyan');
            $('#codigo_licencia').val('');
            $('#btn_doc_licencia').html('');
            $('#file_licencia').val('');
            $('#input_hide_licenciaconducir').val('0');
            $("#div_licencia").hide();
        }

        
        
    });
    */


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

        $('#fechainicio_capac').prop('disabled',false);
        $('#fechainicio_capac').prop('required',true);
        $('#fechainicio_capac').val('');

        $('#fechafin_capac').prop('disabled',false);
        $('#fechafin_capac').prop('required',true);
        $('#fechafin_capac').val('');

        $('#horaslectivas').prop('disabled',false);
        $('#horaslectivas').prop('required',true);
        $('#horaslectivas').val('');
        
    }else if($("#tipo_capacitacion").val()==6 ){
        $('#fechainicio_capac').prop('disabled',true);
        $('#fechainicio_capac').prop('required',true);
        $('#fechainicio_capac').val('');

        $('#fechafin_capac').prop('disabled',true);
        $('#fechafin_capac').prop('required',true);
        $('#fechafin_capac').val('');

        $('#horaslectivas').prop('disabled',true);
        $('#horaslectivas').prop('required',true);
        $('#horaslectivas').val('');

        $('#nivel_capa').prop('disabled',false);
        $('#nivel_capa').prop('required',true);
        $('#nivel_capa').val('');

    }else if($("#tipo_capacitacion").val()==7 ){
        $('#horaslectivas').prop('disabled',true);
        $('#horaslectivas').prop('required',true);
        $('#horaslectivas').val('');

        $('#nivel_capa').prop('disabled',false);
        $('#nivel_capa').prop('required',true);
        $('#nivel_capa').val('');    

    }
    else{
        $('#nivel_capa').prop('disabled',true);
        $('#nivel_capa').prop('required',false);
        $('#nivel_capa').val('');

        $('#fechainicio_capac').prop('disabled',false);
        $('#fechainicio_capac').prop('required',true);
        $('#fechainicio_capac').val('');

        $('#fechafin_capac').prop('disabled',false);
        $('#fechafin_capac').prop('required',true);
        $('#fechafin_capac').val('');

        $('#horaslectivas').prop('disabled',false);
        $('#horaslectivas').prop('required',true);
        $('#horaslectivas').val('');
    }
})



})

//______________________FUNCIONES TABLA POSTULAR________________________________

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

            $('#loading-screen').fadeOut(); //PRELOADER FIN                   
               Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Formacion actualizada",
                showConfirmButton: false,
                timer: 2000
            });

            var iddd="tblform"+data[0].id;
               $('#modal_nueva_formacion').modal('hide');
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
     var es_certificado=0; 
     var es_licencia=0;    
     var nivel_tratada="";
     
     if((!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))) && ($("#tipo_capacitacion").val()!=6)){
    //if($("#tipo_capacitacion").val()==1){    
 
         Swal.fire({
             type: 'error',
             title: "¡Error!",
             text: "No cumple con mínimo de horas de curso/capacitación",
             icon: "error",
             timer: false,
         })
         return false;
     } 
 
     if($("#tipo_capacitacion").val()==1){
        es_curso_espec=1;
        es_especializacion = 0;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==2){
        es_curso_espec=0;
        es_especializacion = 1;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==3){
        es_curso_espec=0;
        es_especializacion = 0;
        es_diplomado = 1;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada =  "-";
    }
    if($("#tipo_capacitacion").val()==4){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=1;
       es_idioma=0;
       es_certificado=0;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==5){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=1;
       es_certificado=0;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==6){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=0;
       es_certificado=1;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==7){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=0;
       es_certificado=0;
       es_licencia=1;
       nivel_tratada = $("#nivel_capa").val();
   }
     
     var formData = new FormData();
     formData.append('id', id);
     formData.append('es_curso_espec', es_curso_espec);
     formData.append('es_especializacion', es_especializacion);
     formData.append('es_diplomado', es_diplomado);
    formData.append('es_ofimatica', es_ofimatica);
    formData.append('es_idioma', es_idioma);
    formData.append('es_certificado', es_certificado);
    formData.append('es_licencia', es_licencia);
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
           // console.log(data);
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
             if(data[0].es_certificado==1){
                 tipoestudio = "Certificado OSCE";
             }
             if(data[0].es_licencia==1){
                 tipoestudio = "Licencia de conducir";
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
           
           $('#loading-screen').fadeOut(); //PRELOADER FIN

           Swal.fire({
             position: 'top-end',
             type: 'success',
             title: "Curso/Capacitación actualizado",
             showConfirmButton: false,
             timer: 2000
         });
 
         var iddd="tblcapac"+data[0].id;
         $('#modal_nuevo').modal('hide');
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
    formData.append('idproceso',$('#datospostulante').data('id'));
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
        url: "/postulante/guardarexperiencia",
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
           if(data.query.es_exp_esp==1){marcadoespecifico=" y <br> ESPECÍFICA";}

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
            "<td>"+data.query.fecha_inicio+"<br>"+data.query.fecha_fin+"</td>"+
           // "<td>"+data.query.fecha_fin+"</td>"+
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

           //var totaldias_gen=parseInt(data.suma_expgen);
           //var totaldias_esp=parseInt(data.suma_expesp);
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
    formData.append('idproceso',$('#datospostulante').data('id'));
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
        url: "/postulante/actualizarexperiencia",
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
            "<td>"+data.query[0].fecha_inicio+"<br>"+data.query[0].fecha_fin+"</td>"+
           // "<td>"+data.query[0].fecha_fin+"</td>"+
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
            // var totaldias_gen=parseInt(data.suma_expgen);
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
     var es_certificado=0;
     var es_licencia=0;    
     var nivel_tratada="";
     
     //if(!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))){
     if((!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))) && ($("#tipo_capacitacion").val()!=6)){   
 
         Swal.fire({
             type: 'error',
             title: "¡Error!",
             text: "No cumple con mínimo de horas de curso/capacitación",
             icon: "error",
             timer: false,
         })
         return false;
     }
 
     if($("#tipo_capacitacion").val()==1){
        es_curso_espec=1;
        es_especializacion = 0;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==2){
        es_curso_espec=0;
        es_especializacion = 1;
        es_diplomado = 0;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada = "-";
    }
    if($("#tipo_capacitacion").val()==3){
        es_curso_espec=0;
        es_especializacion = 0;
        es_diplomado = 1;
        es_ofimatica=0;
        es_idioma=0;
        es_certificado=0;
        es_licencia=0;
        nivel_tratada =  "-";
    }
    if($("#tipo_capacitacion").val()==4){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=1;
       es_idioma=0;
       es_certificado=0;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==5){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=1;
       es_certificado=0;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==6){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=0;
       es_certificado=1;
       es_licencia=0;
       nivel_tratada = $("#nivel_capa").val();
   }
   if($("#tipo_capacitacion").val()==7){
       es_curso_espec=0;
       es_especializacion = 0;
       es_diplomado = 0;
       es_ofimatica=0;
       es_idioma=0;
       es_certificado=0;
       es_licencia=1;
       nivel_tratada = $("#nivel_capa").val();
   }
 
     var formData = new FormData();
     formData.append('es_curso_espec', es_curso_espec);
     formData.append('es_especializacion', es_especializacion);
     formData.append('es_diplomado', es_diplomado);
    formData.append('es_ofimatica', es_ofimatica);
    formData.append('es_idioma', es_idioma);
    formData.append('es_certificado', es_certificado);
    formData.append('es_licencia', es_licencia);
    formData.append('especialidad', $("#descripcion").val());
    formData.append('centro_estudios', $("#institucion").val());
    formData.append('pais', $("#pais_capacit").val());
    formData.append('ciudad', $("#ciudad_capacit").val());
    formData.append('fechainicio_capac', $("#fechainicio_capac").val()=='' ? '1990-01-01' : $("#fechainicio_capac").val());
    formData.append('fechafin_capac', $("#fechafin_capac").val()=='' ? '1990-01-01' : $("#fechafin_capac").val());
    formData.append('nivel_capa', nivel_tratada);
    formData.append('cantidad_horas', $("#horaslectivas").val()=='' ? '0' : $("#horaslectivas").val());
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
             if(data.es_certificado==1){
                 tipoestudio = "Certificado OSCE";
             }
             if(data.es_licencia==1){
                 tipoestudio = "Licencia de conducir";
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