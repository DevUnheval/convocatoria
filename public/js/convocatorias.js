$(document).ready(function() {
    var form = $(".tab-wizard").show();
    $(".tab-wizard").steps({
        headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                next: "Siguiente",
                previous: "Anterior",
                finish: 'Terminar'
            },
            onStepChanging: function (event, currentIndex, newIndex) {
              return currentIndex > newIndex || (currentIndex < newIndex && ($(this).find(".body:eq(" + newIndex + ") label.error").remove(), $(this).find(".body:eq(" + newIndex + ") .error").removeClass("error")), $(this).validate().settings.ignore = ":disabled,:hidden", $(this).valid())
            },
            onFinishing: function (event, currentIndex) {
              return $(this).validate().settings.ignore = ":disabled", $(this).valid()
            },
        onFinished: function(event, currentIndex) {//cuando se termina todos los pasos
            Swal.fire("Aquí escribir el AJAX para que mande el formulario, y sweet alert para que avise que se registró")
        }
        // =========> ejemplito
    //     onFinished: function (event, currentIndex) {
    //         var route = '/informe/'+$(this).attr('id');
    //         $.ajax({
    //           headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
    //           data:  $("#"+$(this).attr('id')).serialize(),
    //           url:   route,
    //           type: 'POST',
    //           beforeSend: function () {
    //             console.log('enviando....');
    //           },
    //           success:  function (response){
                    //console.log(response.data);
    //              console.log(response);
    //             if(!response.resultado){
    //               Swal.fire({
    //                       title: "¡Error!",
    //                       text: response.msj,
    //                       icon: "error",
    //                       timer: 2500,
    //                   })
    //               return false;
    //             }
    //             $('#datatable-ajax').DataTable().ajax.reload();
    //             $('#modal_nuevo').modal('hide');
    //             $('#modal_editar').modal('hide');
    //             personas(response.data.id,response.data.programa);
    //             Swal.fire({
    //                       title: "¡Éxito!",
    //                       text: response.msj,
    //                       icon: "success",
    //                       timer: 2500,
    //                       showConfirmButton: false
    //                   })
    //             document.getElementById("form_editar").reset();
    //             document.getElementById("form_nuevo").reset();
    //             $("#form_editar").steps('reset');
    //             $("#form_nuevo").steps('reset');
    //           },
    //           error: function (response){
    //             Swal.fire({
    //                 title: "¡Error!",
    //                 text: response.responseJSON.message,
    //                 icon: "error",
    //                 timer: 3500,
    //             })

    //           }
    //         });
    //     }
    // })
        // ============>
    }), $(".tab-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })    
})
