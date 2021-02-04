$(document).ready(function() {
    
    $('#zero_config1').DataTable();
    $('#zero_config2').DataTable();
    $('#zero_config3').DataTable();

    var form = $(".validation-wizard").show();
    
    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Registrar Postulación"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function(event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            alert("hola");
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
                    //Swal.fire('Guardado!','El registro ha sido creado con éxito.','success');
                    $('#zero_config').DataTable().ajax.reload();
                    $('#modal_nuevo').modal('hide');                    
                },
                error: function (response){
                    console.log("Error",response.data);
                    Swal.fire({
                        title: "¡Error!",
                        text: response.responseJSON.message,
                        icon: "error",
                        timer: 10500,
                    })
                }
            });
            alert("se guardo");

        }
    }), $(".validation-wizard").validate({
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

    

$("#example-vertical").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: "vertical"
});

//Custom design form example
$(".tab-wizard").steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: {
        finish: "Submit"
    },
    onFinished: function(event, currentIndex) {
        swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

    }
});


})





