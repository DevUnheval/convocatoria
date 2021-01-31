$(document).ready(function(){
    $('#dni').on('keyup',contardigitos)	
    contardigitos();
    });
    
    function contardigitos(){
        var dni = $('#dni').val();
        var count = $('#dni').val().length;
        if (count == 8) {
            $.get("/prueba/"+dni+"/dni",function(data){
                
                if (data != "") {
                    
                    $('#apellido_paterno').val(data[0].apellido_paterno);
                    $('#apellido_materno').val(data[0].apellido_materno);
                    $('#nombres').val(data[0].nombres);
                                        
                    $('#apellido_paterno').attr('readonly','');
                    $('#apellido_materno').attr('readonly','');
                    $('#nombres').attr('readonly','');
                    
                }
            });		
                    
        } else if (count < 8){
            
            $('#apellido_paterno').removeAttr('readonly').val('');
            $('#apellido_materno').removeAttr('readonly').val('');
            $('#nombres').removeAttr('readonly').val('');
            
            
        }
    }
    