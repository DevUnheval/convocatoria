var tipoUsuarios = 'postulantes';
var myTable = null;

$(document).ready(function() {
    myTable = $('#zero_config').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/maestro/usuarios/data',
            data: function (d) {
                d.tipo = tipoUsuarios;
            }
        },
        language: {'url': '/js/table-latino.json'},
        pageLength: 15,
        lengthMenu: [15, 25, 50, 100],
        autoWidth: true,
        order: [[1, 'desc']],
        columns: [
            { orderable: false }, // Conf.
            null,                 // Id
            { orderable: false }, // CV-VITAE
            { orderable: false }, // CV-POST
            { orderable: false }, // CV-USER
            null,                 // DNI
            null,                 // Nombres
            { orderable: false }, // Foto
            { orderable: false }  // Roles
        ]
    });

    $('#usuariosTabs .nav-link').on('click', function () {
        var tipo = $(this).data('tipo');
        if (tipo === tipoUsuarios) {
            return;
        }
        tipoUsuarios = tipo;
        $('#usuariosTabs .nav-link').removeClass('active');
        $(this).addClass('active');
        myTable.ajax.reload();
    });
});

function editar(id){
    $.ajax({
        url:   "/maestro/usuarios/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
            $("#dni").val(response.usuario.dni);
            $("#nombres").val(response.usuario.nombres);
            $("#apellido_paterno").val(response.usuario.apellido_paterno);
            $("#apellido_materno").val(response.usuario.apellido_materno);
            $("#email").val(response.usuario.email);
            $("#id").val(response.usuario.id);
            $(".check_rol").prop("checked",false);
            if (response.roles.length > 0) {
                $("#rol_radio_"+response.roles[0]).prop("checked",true);
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
            myTable.ajax.reload(null, false);
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
