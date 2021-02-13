    $(document).ready(function(){
       // $('#dni').on('keyup',contardigitos);	

        var forms = document.getElementsByClassName('needs-validation_registro');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                form.classList.add('was-validated');
                $('#form_registrar').removeClass('form-material');
            }else{
                               
            }
        
            
        }, false);
    });

    });
    
    function contardigitos(){
        var dni = $('#dni').val();
        var count = $('#dni').val().length;
        if (count == 8) { //probar con dni de 6 dígitos '?
        console.log('entre');
            $.get("/api_reniec/"+dni+"/dni",function(data){
                $("#email").focus();
                if (data != "error") {
                    console.log(dni,data);
                    $('#apellido_paterno').val(decodeURI(data.apellido_paterno));
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
    