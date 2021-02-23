var dataTable = function(proceso,etapa){
    $('#data_table').DataTable( {
                    bProcessing: true,
                    sAjaxSource: '/postulantes/'+proceso+'/'+etapa+'/1/listar/data',
                    language : {'url':'/js/table-latino.json'},
                    iDisplayLength: 15,
                    aLengthMenu: [15, 25,50, 100],
                    bAutoWidth: true,
                    order: []
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
            console.log("respuesta",response);
            $("#grupo_total").html("Total ("+response.grupos.total+")");
            $("#grupo_pendientes").html("Pendientes ("+response.grupos.pendientes+")");
            $("#grupo_califica").html("Califica ("+response.grupos.califica+")");
            $("#grupo_noCalifica").html("No califica ("+response.grupos.noCalifica+")");
            
            var key=0;
            response.postulantes.forEach(element => {
                key++;
                console.log("ECO",element.estado_nombre);
                var random_img = Math.floor(Math.random() * 8)+1;

                var $tarjeta = `<div class="col-md-3 single-note-pendiente container-fluid all-category ${element.estado_clase}">`; //`${}`: son string interpolation
                    $tarjeta +=    '<div class="card card-body el-element-overlay">';
                    $tarjeta +=        '<span class="side-stick"></span>';
                    $tarjeta +=        `<h5 class="note-title text-truncate w-75 mb-0"> ${element.estado_nombre}  <i class="point fas fa-circle ml-1 font-10" ></i></h5>`;
                    $tarjeta +=        `<p class="note-date font-12 text-muted">DNI: ${element.dni}</p>`;
                    $tarjeta +=        '<div class="note-content">';
                    $tarjeta +=            '<div class="el-card-item pb-3">';
                    $tarjeta +=                '<div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">'; 
                    $tarjeta +=                    `<img src="/material-pro/src/assets/images/users/${random_img}.jpg" class="d-block position-relative w-100" />`;
                    $tarjeta +=                    '<div class="el-overlay w-100 overflow-hidden">';
                    $tarjeta +=                        '<ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">';
                    //$tarjeta +=                            `<li class="el-item d-inline-block my-0 mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="material-pro/src/assets/images/users/${random_img}.jpg" title="ver foto"><i class="icon-picture"></i></a></li>`;
                    $tarjeta +=                            '<li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_cv" title="CV"><i class="fas fa-address-card" ></i></button></li>'; 
                    $tarjeta +=                            '<li class="el-item d-inline-block my-0 mx-1"><button class="btn default btn-outline el-link text-white border-white" data-toggle="modal" data-target="#modal_evaluar" title="evaluar"><i class="fas fa-calculator"></i></button></li>';
                    $tarjeta +=                        '</ul>';
                    $tarjeta +=                    '</div>';
                    $tarjeta +=                 '</div>';
                    $tarjeta +=                 '<div class="el-card-content text-center">';
                    $tarjeta +=                     `<h4 class="mb-0">${element.nombres} (${element.edad})</h4> <span class="text-muted"> ${element.formacion}</span>`;
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
                    $tarjeta +=                     '<li class="nav-item">';
                    $tarjeta +=                        `<a href="#bono-${key}" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">`;
                    $tarjeta +=                            '<i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>';
                    $tarjeta +=                            '<span class="d-none d-lg-block">B+</span>';
                    $tarjeta +=                        '</a>';
                    $tarjeta +=                    '</li>';
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
                    $tarjeta +=                        `<p>Evaluación ${etapa.descripcion}: 50</p>`;
                    $tarjeta +=                    '</div>';
                    })
                    $tarjeta +=                    `<div class="tab-pane" id="bono-${key}">`;
                    $tarjeta +=                        `<p>bono: 20</p>`;
                    $tarjeta +=                    `</div>`;
                    $tarjeta +=                    `<div class="tab-pane active" id="total-${key}">`;
                    $tarjeta +=                        `<p>Total: 20</p>`;
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
       dataTable(proceso,etapa);
       $("#note-full-container").empty();
    }else{
        dataTajetas(proceso,etapa);
        $('#data_table').DataTable().destroy();
    }


}
var Postulantes = (function () {
    "use strict";
    return {
        init: function (proceso, etapa, vista, div) {
            cargar_vistas(proceso, etapa, vista, div);
        },
    };
})();