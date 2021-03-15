var  modal_evaluar_individual = function(idpostulante,observacion_bd,$etapa,$proceso_id,$ev_con,$vista){
    $("#btn_guardar_ev_individual").attr("data-proceso_id",$proceso_id);
    $("#btn_guardar_ev_individual").attr("data-etapa",$etapa);
    $("#btn_guardar_ev_individual").attr("data-ev_con",$ev_con);
    $("#btn_guardar_ev_individual").attr("data-vista",$vista);
    $("#input_puntaje_ev_individual").attr("name",`evaluacion[${idpostulante}]`);
    $("#textarea_puntaje_ev_individual").attr("name",`observacion[${idpostulante}][${observacion_bd}]`);

   $("#modal_evaluar").modal("show");
}
var  modal_evaluar_todos = function($etapa, $proceso_id,$ev_con,$vista){
    //modal_evaluar_todos(2,1,0,1)
    //postulantes/postulantes_evaluados/1/2/0
    $.ajax({
        url:   `/postulantes/postulantes_evaluados/${$proceso_id}/${$etapa}/${$ev_con}`,
        type: 'GET',
        beforeSend: function () {
        console.log('enviando....');
        },
        success:  function (response){
            $('#postulantes_evaluados tbody').html(response);
        },
        error: function (response){
            console.log("Error",response.data);
        Swal.fire({
            title: "¡Error!",
            text: response.responseJSON.message,
            icon: "error",
            timer: 3500,
        })
        }
    });
    $("#btn_guardar_evaluacion").attr("data-proceso_id",$proceso_id);
    $("#btn_guardar_evaluacion").attr("data-etapa",$etapa);
    $("#btn_guardar_evaluacion").attr("data-ev_con",$ev_con);
    $("#btn_guardar_evaluacion").attr("data-vista",$vista);
    
    $("#modal_evaluar_todos").modal("show");
}

var dataTable = function(proceso,etapa){
    $('#data_table').DataTable( {
                    bProcessing: true,
                    sAjaxSource: '/postulantes/'+proceso+'/'+etapa+'/1/listar/data',
                    language : {'url':'/js/table-latino.json'},
                    iDisplayLength: 15,
                    aLengthMenu: [15, 25,50, 100],
                    bAutoWidth: true,
                    //order: [[ 2, "asc" ]],
                    order: [],
                    columnDefs: [
                                    {
                                        "targets": 1, // your case first column
                                        "className": "text-center",
                                        //"width": "4%"
                                    },
                                    {
                                        "targets": 4,
                                        "className": "text-center",
                                    },
                                    {
                                        "targets": 5,
                                        "className": "text-center",
                                    },
                                    {
                                        "targets": 6,
                                        "className": "text-center",
                                    },
                                    {
                                            "targets": 7,
                                            "className": "text-center",
                                    },
                                ],
    })
}

var dataTajetas = function(proceso,etapa){
    $.ajax({
            url:   '/postulantes/'+proceso+'/'+etapa+'/2/listar/data',
            type: 'GET',
        beforeSend: function () {
            console.log('enviando....');
        },
        success:  function (response){
            //console.log("respuesta",response);
            $("#grupo_total").html("Total ("+response.grupos.total+")");
            $("#grupo_pendientes").html("Pendientes ("+response.grupos.pendientes+")");
            $("#grupo_califica").html("Califica ("+response.grupos.califica+")");
            $("#grupo_noCalifica").html("No califica ("+response.grupos.noCalifica+")");
            
            var key=0;
            response.postulantes.forEach(element => {
                key++;
                //console.log("ECO",element.estado_nombre);
                var random_img = Math.floor(Math.random() * 8)+1;

                var $tarjeta = `<div class="col-md-3 single-note-pendiente container-fluid all-category ${element.estado_clase}">`; //`${}`: son string interpolation
                    $tarjeta +=    '<div class="card card-body el-element-overlay">';
                    $tarjeta +=        '<span class="side-stick"></span>';
                    $tarjeta +=        `<h5 class="note-title text-truncate w-75 mb-0"> ${element.estado_nombre}  <i class="point fas fa-circle ml-1 font-10" ></i></h5>`;
                    $tarjeta +=        `<p class="note-date font-12 text-muted">PUNTAJE: <b>${element.ev_actual}</b></p>`;
                    $tarjeta +=        '<div class="note-content">';
                    $tarjeta +=            '<div class="el-card-item pb-3">';
                    $tarjeta +=                '<div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">'; 
                    $tarjeta +=                    `<img src="/material-pro/src/assets/images/users/${random_img}.jpg" class="d-block position-relative w-100" />`;
                    $tarjeta +=                    '<div class="el-overlay w-100 overflow-hidden">';
                    $tarjeta +=                        '<ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">';
                    //$tarjeta +=                            `<li class="el-item d-inline-block my-0 mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="material-pro/src/assets/images/users/${random_img}.jpg" title="ver foto"><i class="icon-picture"></i></a></li>`;
                    $tarjeta +=                            '<li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_cv" title="ver curriculum vitae"><i class="fas fa-address-card" ></i></button></li>'; 
                    $tarjeta +=                            '<li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_evaluar" title="evaluar"><i class="fas fa-calculator"></i></button></li>';
                    $tarjeta +=                            '<li class="el-item d-inline-block my-0 mx-1"><button class="btn prmary btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_evaluar" title="ver más"><i class="fas fa-plus"></i></button></li>';
                    $tarjeta +=                        '</ul>';
                    $tarjeta +=                    '</div>';
                    $tarjeta +=                 '</div>';
                    $tarjeta +=                 '<div class="el-card-content">';
                    $tarjeta +=                     `<h6 class="mb-0">DNI: ${element.dni} </h6>`;
                    $tarjeta +=                     `<h5 class="mb-0">${element['nombres']} (${element.edad})</h5> <span class="text-muted"> ${element.formacion}</span>`;
                    $tarjeta +=                 '</div>';
                    $tarjeta +=             '</div>';
                    $tarjeta +=             '<div class="el-card-content text-left">';
                    $tarjeta +=                 '<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">';
                    var key2 = 0;
                    response.etapas.forEach(etapa => {
                        key2++;
                    $tarjeta +=                    '<li class="nav-item">';
                    $tarjeta +=                        `<a href="#${etapa.desc_bd}-${key}" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">`;
                    $tarjeta +=                            '<i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>';
                    $tarjeta +=                            `<span class="d-none d-lg-block">Ev.${key2}</span>`;
                    $tarjeta +=                        '</a>';
                    $tarjeta +=                    '</li>';
                    })
                    
                    $tarjeta +=                    '<li class="nav-item">';
                    $tarjeta +=                        `<a href="#total-${key}" data-toggle="tab" aria-expanded="false"  class="nav-link rounded-0 active">`;
                    $tarjeta +=                            `<i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>`;
                    $tarjeta +=                            `<span class="d-none d-lg-block">Total</span>`;
                    $tarjeta +=                        '</a>';
                    $tarjeta +=                   '</li>';

                    $tarjeta +=                '</ul>';
                    $tarjeta +=                '<div class="tab-content">';
                    response.etapas.forEach(etapa => {
                    $tarjeta +=                    `<div class="tab-pane" id="${etapa.desc_bd}-${key}">`;
                    const $evaluacion = element[etapa.desc2_bd];
                    $tarjeta +=                        `<p>Evaluación ${etapa.descripcion}: ${$evaluacion} </p>`;
                    $tarjeta +=                    '</div>';
                    })
                    
                    $tarjeta +=                    `<div class="tab-pane active" id="total-${key}">`;
                    $tarjeta +=                        `<p>Total: ${element.total}</p>`;
                    $tarjeta +=                    `</div>`;
                    $tarjeta +=                `</div>`;

                    $tarjeta +=            `</div>`;      
                    $tarjeta +=         '</div>';
                    $tarjeta +=     '</div>';
                    $tarjeta += '</div>';
                $("#note-full-container").append($tarjeta);
            });
           
        },
        error: function (response){
            console.log("Error",response.data);
        }
    });
}

var cargar_vistas = function (proceso, etapa, vista, div) {
    "use strict";
    $(".ver-div").attr("hidden",true);
    $("#"+div).attr("hidden",false);

    if(vista == "1"){
        $('#data_table').DataTable().destroy();
       dataTable(proceso,etapa);
       
    }else{
        $("#note-full-container").empty();
        dataTajetas(proceso,etapa);
        
    }
}


var guardar_ev_individual = function (proceso, etapa, vista, div) {
    "use strict";
    $(".ver-div").attr("hidden",true);
    $("#"+div).attr("hidden",false);

    if(vista == "1"){
        $('#data_table').DataTable().destroy();
       dataTable(proceso,etapa);
       
    }else{
        $("#note-full-container").empty();
        dataTajetas(proceso,etapa);
        
    }
}



// var Postulantes = (function () {
//     "use strict";
//     return {
//         init: function (proceso, etapa, vista, div) {
//             cargar_vistas(proceso, etapa, vista, div);
//         },
//     };
// })();

//=========================================INICIAR============================================v
$(document).ready(function() {
    $(".btn_guardar_evaluacion").click(function(){
        const $proceso_id= $(this).data("proceso_id");
        const $etapa= $(this).data("etapa");
        const $ev_con= $(this).data("ev_con");
        const $vista= $(this).data("vista");
        const $formulario= $(this).data("id_formulario");
        const $data = $("#"+$formulario).serialize();
        if(!$("#"+$formulario).valid()){
            return false;
        }        
        $.ajax({
            async:false, //para dejar que termine el ajax, antes que continue y sacar variables del succes
            url:  `/postulantes/actualizar_evaluacion/${$proceso_id}/${$etapa}/${$ev_con}`,
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'GET',
            data:$data,
            beforeSend: function () {
            console.log('enviando....');
            },
            success:  function (response){
                console.log(response);
                var $nueva_etapa = response;
                if($etapa == $nueva_etapa){
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Se actualizó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                }else{
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Avanzamos a la siguiente etapa',
                        showConfirmButton: false,
                        timer: 2000
                    })
                   // console.log("aquí el BUG"); 
                    $(location).attr('href', `/postulantes/${$proceso_id}/${$nueva_etapa}/${$vista}/listar`);
                }
                
                
            },
            error: function (response){
                console.log("Error",response.data);
            Swal.fire({
                title: "¡Error!",
                text: response.responseJSON.message,
                icon: "error",
                timer: 3500,
            })
            }
        });
        $("#modal_evaluar_todos").modal("hide");
        iniciar_pagina();
    })

    $(".check-vista").change(function(){
        const vista   = $(this).data("vista");
        const proceso = $(this).data("proceso");
        const etapa   =  $(this).data("etapa");
        const div     =  $(this).data("div_id");
        //console.log(proceso, etapa, vista, div);
        cargar_vistas(proceso, etapa, vista, div);
        
    });
    function iniciar_pagina(){
        if( $('#vista_tablas').attr('checked') ) {
            $("#vista_tablas").change();
        }else{
            $("#vista_tarjetas").change();
        }
    }
    iniciar_pagina();
})