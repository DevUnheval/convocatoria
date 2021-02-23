$(document).ready(function() {

    $("#nacionalidad").on('change',function(){
        
       
        if($('#nacionalidad').val() == "Peruano(a)"){
            $('#ubigeodni').removeClass('required');
            $('#ubigeodni').prop('id','vacio');
            $('#html_lugar_nac2').hide();
            $('#html_lugar_nac').show();
            $('#ubigeodni_alt').prop('id','ubigeodni');
            $('#ubigeodni').addClass('required');
            $('#vacio').prop('id','ubigeodni_alt');
                     
        }

        if($('#nacionalidad').val() == "Extranjero(a)"){
        
            $('#ubigeodni').removeClass('required');
            $('#ubigeodni').prop('id','vacio');
            $('#html_lugar_nac').hide();
            $('#html_lugar_nac2').show();
            $('#ubigeodni_alt').prop('id','ubigeodni');
            $('#ubigeodni').addClass('required');
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
    if($("#tipo_capacitacion").val()==2 || $("#tipo_capacitacion").val()==3){
        $('#nivel_capa').prop('disabled',false);
        $('#nivel_capa').prop('required',true);
        $('#nivel_capa').val('');
        
    }else{
        $('#nivel_capa').prop('disabled',true);
        $('#nivel_capa').prop('required',false);
        $('#nivel_capa').val('');
        
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
    var  es_ofimatica=0;
     var es_idioma=0;   
     var nivel_tratada="";
     
     if(!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))){
 
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
         es_ofimatica=0;
         es_idioma=0;
         nivel_tratada = "-";
     }
     if($("#tipo_capacitacion").val()==2){
         es_curso_espec=0;
         es_ofimatica=1;
         es_idioma=0;
         nivel_tratada = $("#nivel_capa").val();
     }
     if($("#tipo_capacitacion").val()==3){
         es_curso_espec=0;
         es_ofimatica=0;
         es_idioma=1;
         nivel_tratada = $("#nivel_capa").val();
     }
     
     var formData = new FormData();
     formData.append('id', id);
     formData.append('es_curso_espec', es_curso_espec);
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
            console.log(data);
             //alert("datos guardados CAPACITACION!! ");
             var tipoestudio="";
             if(data[0].es_curso_espec==1){
                 tipoestudio = "Curso/Especialización";
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
    formData.append('es_exp_gen',exp_general);
    formData.append('es_exp_esp',exp_especifica);
    formData.append('tipo_institucion', $("#tipo_entidad").val());
    formData.append('tipo_experiencia',$("#tipo_experiencia").val());
    formData.append('centro_laboral', $("#nombre_entidad").val());
    formData.append('cargo_funcion', $("#cargo_exp").val());
    formData.append('desc_cargo_funcion', $("#funciones_princi").val());
    formData.append('fecha_inicio', $("#fecha_inicio_exp").val());
    formData.append('fecha_fin' , $("#fecha_fin_exp").val());
    formData.append('num_pag' , $("#num_pag").val());
    formData.append('dias_exp_gen', diasexpgen);
    formData.append('dias_exp_esp', diasexpesp);
    formData.append('archivo_experiencia',$("#documento_exp").prop('files')[0]);
   

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
           if(data.query.es_exp_gen==1){marcadogeneral="checked";}
           if(data.query.es_exp_esp==1){marcadoespecifico="checked";}

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
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
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
           
           Swal.fire({
            position: 'top-end',
            type: 'success',
            title: "Experiencia registrada",
            showConfirmButton: false,
            timer: 2000
        })

           $('#modal_nueva_experiencia').modal('hide');
           
           var totaldias_gen=parseInt(data.suma_expgen);
           var totaldias_esp=parseInt(data.suma_expesp);
           $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
           $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
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
    formData.append('num_pag' , $("#num_pag").val());
    formData.append('dias_exp_gen', diasexpgen);
    formData.append('dias_exp_esp', diasexpesp);
    formData.append('archivo_experiencia',$("#documento_exp").prop('files')[0]);
    
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
           if(data.query[0].es_exp_gen==1){marcadogeneral="checked";}
           if(data.query[0].es_exp_esp==1){marcadoespecifico="checked";}
           
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
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
            "<td>"+data.query[0].centro_laboral+"</td>"+
            "<td>"+data.query[0].cargo_funcion+"</td>"+
            "<td>"+data.query[0].fecha_inicio+"</td>"+
            "<td>"+data.query[0].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.query[0].dias_exp_gen))+"</td>"+
            "<td><a href='"+href_exp+"' target=\"_blank\" class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></a>"+
            "   <button type='button' onclick=\"editar_expe('tblexp"+data.query[0].id+"');\" class='btn btn-warning' data-toggle=\"modal\" ><i class=\"fas fa-edit\"></i></button>"+
            "   <button type='button' onclick=\"eliminar_expe('tblexp"+data.query[0].id+"');\" class='btn btn-danger'><i class=\"fas fa-trash-alt\"></i></button>"+
            "</td>";
            
            var totaldias_gen=parseInt(data.suma_expgen);
           var totaldias_esp=parseInt(data.suma_expesp);
           $('#total_exp_general').val(anios_meses_dias(totaldias_gen));
           $('#total_exp_especifica').val(anios_meses_dias(totaldias_esp));
            
            var iddd="tblexp"+data.query[0].id;

            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Experiencia actualizada",
                showConfirmButton: false,
                timer: 2000
            })

            $('#modal_nueva_experiencia').modal('hide');
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
              
               Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Formacion registrada",
                showConfirmButton: false,
                timer: 2000
            })
               $('#modal_nueva_formacion').modal('hide');
               
            },
            error: function(data){
                alert("error!!")

            }

        });
 }


 //__________________________________-GUARDAR CURSO CAPACITACION _________________________________
 function guardar_capacitacion_data(){
    var es_curso_espec=0;
    var  es_ofimatica=0;
     var es_idioma=0;   
     var nivel_tratada="";
     
     if(!cumplehoras_porcapa(parseInt($("#horas_cap_ind").val()),parseInt($("#horaslectivas").val()))){
 
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
         es_ofimatica=0;
         es_idioma=0;
         nivel_tratada = "-";
     }
     if($("#tipo_capacitacion").val()==2){
         es_curso_espec=0;
         es_ofimatica=1;
         es_idioma=0;
         nivel_tratada = $("#nivel_capa").val();
     }
     if($("#tipo_capacitacion").val()==3){
         es_curso_espec=0;
         es_ofimatica=0;
         es_idioma=1;
         nivel_tratada = $("#nivel_capa").val();
     }
 
     var formData = new FormData();
     formData.append('es_curso_espec', es_curso_espec);
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
                 tipoestudio = "Curso/Especialización";
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
 
           Swal.fire({
             position: 'top-end',
             type: 'success',
             title: "Curso/Capacitación guardado",
             showConfirmButton: false,
             timer: 2000
         });
 
            $('#zeroconfig2_body').prepend(fila); 
           // $('#total_horas').val(parseFloat($('#total_horas').val()) + parseFloat(data.cantidad_horas));
            $('#modal_nuevo').modal('hide');
            
            
         },
         error: function(data){
             alert("error!!")
 
         }
 
     });
 
 }