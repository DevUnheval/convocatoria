$(document).ready(function() {
    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/convocatorias/vigentes/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: []
    }) 


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
            //Swal.fire("Aquí escribir el AJAX para que mande el formulario, y sweet alert para que avise que se registró")
            Swal.fire({
                //title: '',
                text: "¿Está seguro de crear el registro?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',  
                cancelButtonText: 'Cancelar',              
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Crear'
            }).then((result) => {
                //===========================

                var route = '/convocatorias/store';
                $.ajax({
                  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                  data:  $("#"+$(this).attr('id')).serialize(),
                  url:   route,
                  type: 'POST',
                  beforeSend: function () {
                    console.log('enviando....');
                  },
                  success:  function (response){
                        console.log("exito",response);
                        $('#zero_config').DataTable().ajax.reload();
                        $('#modal_nuevo').modal('hide');
                    
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
        }
       
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

function editar(id){
    $.ajax({
        url:   "/convocatorias/edit/"+id,
        type: 'GET',
        beforeSend: function () {
          console.log('enviando....');
        },
        success:  function (response){
              console.log("exito",response);
              //aqui llenar todo los inputs .val("___")
              
          
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
