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
$("#tipo_estudio").on('click',function(){
    if($("#tipo_estudio").val()==2 || $("#tipo_estudio").val()==3){
        $('#especialidad').attr('disabled',true);
    }else{
        $('#especialidad').removeAttr('disabled');
    }
})

//select de crear una nueva capacitacion/curso/idioma/ofimatica academica
$("#tipo_capacitacion").on('click',function(){
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

//______________________FUNCIONES________________________________

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

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/actualizar_formac_data",
            type: "POST" ,
            datatype: "json",
            data: {
                id: id,
                grado_id: $("#tipo_estudio").val(),
                fecha_inicio:$("#fecha_inicio").val(),
                fecha_fin: $("#fecha_fin").val(),
                fecha_expedicion: $("#fecha_exp").val(),
                centro_estudios: $("#centro_estudio_form").val(),
                especialidad: especialidad_tratada,
                ciudad: $("#ciudad_form").val(),
                pais: $("#pais_form").val(),
                    
            },
            success:function(data){
                //console.log("dataform=>",data);
              var filahtml = 
              "<td>"+data[0].nombre+"</td>"+
              "<td>"+data[0].especialidad+"</td>"+
              "<td>"+data[0].centro_estudios+"</td>"+
              "<td>"+data[0].fecha_expedicion+"</td>"+
              "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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
 
     $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
         url: "/postulante/actualizarcapacitacion_data",
         type: "POST" ,
         datatype: "json",
         data: {
            id: id,
            es_curso_espec: es_curso_espec,
            es_ofimatica: es_ofimatica,
            es_idioma: es_idioma,
            
            especialidad:$("#descripcion").val(),
            centro_estudios: $("#institucion").val(),
            pais: $("#pais_capacit").val(),
            ciudad: $("#ciudad_capacit").val(),
            fechainicio_capac: $("#fechainicio_capac").val(),
            fechafin_capac: $("#fechafin_capac").val(),
            nivel_capa : nivel_tratada,
            cantidad_horas: $("#horaslectivas").val(),  
                 
         },
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
             
           var filahtml = 
           "<td>"+tipoestudio+"</td>"+
           "<td>"+data[0].especialidad+"</td>"+
           "<td>"+data[0].centro_estudios+"</td>"+
           "<td>"+data[0].cantidad_horas+"</td>"+
           "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/guardarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: {
           
            es_exp_gen:exp_general,
            es_exp_esp:exp_especifica,
            tipo_institucion: $("#tipo_entidad").val(),
            tipo_experiencia:$("#tipo_experiencia").val(),
            centro_laboral: $("#nombre_entidad").val(),
            cargo_funcion: $("#cargo_exp").val(),
            desc_cargo_funcion: $("#funciones_princi").val(),
            fecha_inicio: $("#fecha_inicio_exp").val(),
            fecha_fin : $("#fecha_fin_exp").val(),
            num_pag : $("#num_pag").val(),
            dias_exp_gen: diasexpgen,
            dias_exp_esp: diasexpesp,  
                
        },
        success:function(data){
            //console.log(data);
            //alert("datos guardados EXPERIENCIA!! ");
            
            marcadogeneral="";
            marcadoespecifico="";
           if(data.query.es_exp_gen==1){marcadogeneral="checked";}
           if(data.query.es_exp_esp==1){marcadoespecifico="checked";}

          var fila = "<tr id='tblexp"+data.query.id+"'>"+
          "<td>"+data.query.tipo_experiencia+"</td>"+
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
            "<td>"+data.query.centro_laboral+"</td>"+
            "<td>"+data.query.cargo_funcion+"</td>"+
            "<td>"+data.query.fecha_inicio+"</td>"+
            "<td>"+data.query.fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.query.dias_exp_gen))+"</td>"+
            "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/actualizarexperiencia",
        type: "POST" ,
        datatype: "json",
        data: {
            id: id,
            es_exp_gen:exp_general,
            es_exp_esp:exp_especifica,
            tipo_institucion: $("#tipo_entidad").val(),
            tipo_experiencia:$("#tipo_experiencia").val(),
            centro_laboral: $("#nombre_entidad").val(),
            cargo_funcion: $("#cargo_exp").val(),
            desc_cargo_funcion: $("#funciones_princi").val(),
            fecha_inicio: $("#fecha_inicio_exp").val(),
            fecha_fin : $("#fecha_fin_exp").val(),
            num_pag : $("#num_pag").val(),
            dias_exp_gen: diasexpgen,
            dias_exp_esp: diasexpesp,  
            
            
        },
        success:function(data){
            //console.log(data);
            //alert(data);
          var marcadogeneral="";
            var marcadoespecifico="";
           if(data.query[0].es_exp_gen==1){marcadogeneral="checked";}
           if(data.query[0].es_exp_esp==1){marcadoespecifico="checked";}
        
          var filahtml =
            "<td>"+data.query[0].tipo_experiencia+"</td>"+
            "<td>Exp.General <input  type=\"checkbox\" "+marcadogeneral+" disabled /><br>"+
            "Exp.Espec. <input  type=\"checkbox\" "+marcadoespecifico+" disabled /></td>"+
            
            "<td>"+data.query[0].centro_laboral+"</td>"+
            "<td>"+data.query[0].cargo_funcion+"</td>"+
            "<td>"+data.query[0].fecha_inicio+"</td>"+
            "<td>"+data.query[0].fecha_fin+"</td>"+
            "<td>"+anios_meses_dias(parseInt(data.query[0].dias_exp_gen))+"</td>"+
            "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/postulante/guardarformacion",
            type: "POST" ,
            datatype: "json",
            data: {
               // user_id: $("#di2").val(),
                grado_id: $("#tipo_estudio").val(),
                fecha_inicio:$("#fecha_inicio").val(),
                fecha_fin: $("#fecha_fin").val(),
                fecha_expedicion: $("#fecha_exp").val(),
                centro_estudios: $("#centro_estudio_form").val(),
                especialidad: especialidad_tratada,
                ciudad: $("#ciudad_form").val(),
                pais: $("#pais_form").val(),
                    
            },
            success:function(data){
                
              var fila = "<tr id='tblform"+data.id+"'>"+
              "<td>"+data.nombre+"</td>"+
              "<td>"+data.especialidad+"</td>"+
              "<td>"+data.centro_estudios+"</td>"+
              "<td>"+data.fecha_expedicion+"</td>"+
              "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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
            fechainicio_capac: $("#fechainicio_capac").val(),
            fechafin_capac: $("#fechafin_capac").val(),
            nivel_capa : nivel_tratada,
            cantidad_horas: $("#horaslectivas").val(),  
                 
         },
         success:function(data){
            // console.log(data);
             //alert("datos guardados CAPACITACION!! ");
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
           "<td><button class='btn btn-info' type='button'><i class=\"fas fa-download\"></i></button>"+
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