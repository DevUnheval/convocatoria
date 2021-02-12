$(function(){

    var myTable=$('#data_table').DataTable( {
        bProcessing: true,
        sAjaxSource: '/maestro/formacion/data',
        language : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: [],
    }) 

    $("#guardar_cambios").on("click",function(){
        var datos=$("#formulario_editar").serialize();
        var route = "/maestro/formacion/update/"+$("#editar_id").val();
        $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                data: datos,
                url:   route,
                type: 'POST',
            beforeSend: function () {
                console.log('enviando....');
            },
            success:  function (){
                $('#data_table').DataTable().ajax.reload();
                $('#modal_editar').modal('hide');                    
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
    })

    $("#guardar_nuevo").on("click",function(){
        var datos=$("#formulario_nuevo").serialize();
        var route = "/maestro/formacion/store";
        $.ajax({
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                data: datos,
                url:   route,
                type: 'POST',
            beforeSend: function () {
                console.log('enviando....');
            },
            success:  function (){
                $('#data_table').DataTable().ajax.reload();
                $('#modal_nuevo').modal('hide');    
                $("#nuevo_nombre").val("");
                $("#nuevo_descripcion").val(""); 

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
    })
});

function editar(id){         
    $.ajax({
        url:   "/maestro/formacion/editar/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            console.log("resultado",response);
            $("#editar_id").val(response.id);
            $("#editar_nombre").val(response.nombre);
            $("#editar_descripcion").html(response.descripcion);
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
    $("#modal_editar").modal("show");
}


function guardar_cambios(){
    
}