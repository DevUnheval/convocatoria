$(document).ready(function() {
   // $('#zeroconfig1').DataTable();
     /*   bProcessing: true,
        sAjaxSource: '/postulante/formacion/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
        aLengthMenu: [15, 25,50, 100],
        bAutoWidth: true,
         order: []
       */
    
   

    //$('#zero_config2').DataTable();
    //$('#zero_config3').DataTable();
    
    
    
    //llenar tabla formacion académica
    var tabla="";
    $.get('/postulante/formacion/data1',function (data){
        for (var i = 0; i < data.length; i++) {
            
            tabla += "<tr id='tblform"+data[i].id+"'>"+
            "<td>"+data[i].grado_id+"</td>"+
            "<td>"+data[i].especialidad+"</td>"+
            "<td>"+data[i].centro_estudios+"</td>"+
            "<td>"+data[i].fecha_expedicion+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button>"+
             "   <button type='button' onclick=\"eliminar('tblform"+data[i].id+"');\" class='btn btn-danger'>Eliminar</button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig1_body').append(tabla);
    });

    //_______________________________llenar tabla cursos / capacitaciones______________________
    var tabla2="";
    var tipoestudio="";
    $.get('/postulante/capacitaciones/data1',function (data){
       
        for (var i = 0; i < data.length; i++) {
            tipoestudio = "";
            if(data[i].es_curso_espec==1){
                tipoestudio = "Curso/Especialización";
            }
            if(data[i].es_ofimatica==1){
                tipoestudio = "Ofimática";
            }
            if(data[i].es_idioma==1){
                tipoestudio = "Idioma";
            }
            tabla += "<tr id='tblcapac"+data[i].id+"'>"+
            "<td>"+tipoestudio+"</td>"+
            "<td>"+data[i].especialidad+"</td>"+
            "<td>"+data[i].centro_estudios+"</td>"+
            "<td>"+data[i].cantidad_horas+"</td>"+
            "<td><button class='btn btn-info' type='button'>ver</button>"+
             "   <button type='button' onclick=\"eliminarcapac('tblcapac"+data[i].id+"');\" class='btn btn-danger'>Eliminar</button>"+
            "</td>"+
            "</tr>";
        }
    
    $('#zeroconfig2_body').append(tabla);
        
    
    
    });

    //_________________________________________________________________________
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
//________________________________FIN DE TAB WIZARD_____________________________________________________________-

//funcion eliminar formacion academica
function eliminar(transid){
    //alert("holas : "+transid);
    var id=transid.substring(7);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarformacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
           alert("fila eliminada!!"+data);
        },
        error: function(data){
            alert("error!!"+data); }

    });

    $('#'+transid).remove();
 }


 //________________________funcion eliminar capacitacion______________________________________
 function eliminarcapac(transid){
    //alert("holas : "+transid);
    var id=transid.substring(8);
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/eliminarcapacitacion",
        type: "POST" ,
        datatype: "json",
        data: { id:id },
        success:function(data){
           alert("fila eliminada!!"+data);
           $('#'+transid).remove();
        },
        error: function(data){
            alert("error!!"+data); }

    });

    
 }






