    $(document).ready(function(){
        $('#dni').on('keyup',contardigitos)	
        contardigitos();
    });
    
    function contardigitos(){
        var dni = $('#dni').val();
        var count = $('#dni').val().length;
        if (count == 8) { //probar con dni de 6 dígitos '?
            $.get("/api_reniec/"+dni+"/dni",function(data){
                $("#email").focus();
                if (data != "error") {
                    console.log(dni,data);
                    $('#apellido_paterno').val(data.apellido_paterno);
                    $('#apellido_materno').val(data.apellido_materno);
                    $('#nombres').val(data.nombres);
                                        
                    $('#apellido_paterno').attr('readonly','');
                    $('#apellido_materno').attr('readonly','');
                    $('#nombres').attr('readonly','');
                }
            });		                   
        }else{
            $('#apellido_paterno').removeAttr('readonly').val('');
            $('#apellido_materno').removeAttr('readonly').val('');
            $('#nombres').removeAttr('readonly').val('');         
        }
    }
    