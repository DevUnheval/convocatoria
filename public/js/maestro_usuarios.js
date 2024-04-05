$(document).ready(function() {
    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/maestro/usuarios/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: []
    });

})

function editar(id){
    $.ajax({
        url:   "/maestro/usuarios/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            //console.log("resultado",response.usuario.dni);
            $("#dni").val(response.usuario.dni);
            $("#nombres").val(response.usuario.nombres);
            $("#apellido_paterno").val(response.usuario.apellido_paterno);
            $("#apellido_materno").val(response.usuario.apellido_materno);
            $("#email").val(response.usuario.email);
            $("#id").val(response.usuario.id);
            $(".check_rol").prop("checked",false);
            response.roles.forEach(rol => $("#rol_checkbox_"+rol).prop("checked",true) );
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


function guardar_cambio(){
    var datos=$("#editar_usuario").serialize();
    var route = '/maestro/usuarios/update/'+$("#id").val();
    $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data: datos,
            url:   route,
            type: 'POST',
        beforeSend: function () {
            console.log('enviando....');
        },
        success:  function (){
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Cambios Guardados Correctamente',
                showConfirmButton: false,
                timer: 1500
            }) 
            $('#zero_config').DataTable().ajax.reload();
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
}
