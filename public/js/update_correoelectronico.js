$(document).ready(function(){

    $('#btn_cambio_correo').on('click', () => {
        
        var forms = document.getElementsByClassName('m_cambioCorreo');
        // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            
                if (form.checkValidity() === false) {
                   // event.preventDefault();
                    //event.stopPropagation();
                    form.classList.add('was-validated');
                    
                }else{
                    update_correo();
                    form.classList.remove('was-validated');    
                }
            })
       
    })
})

   function update_correo(){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/cambiocorreo",
        type: "POST",
        datatype: "json",
        data:{
            correonuevo : $('#id_correonuevo').val()
        }, 
        success:function(data){
           
           // console.log(data);
           if(data){
            
            Swal.fire({
                type: 'warning',
                title: "¡Información!",
                text: "El correo electrónico ya está en uso",
                timer: null
            })

           }else{
            $('#loading-screen').fadeIn();
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Correo actualizado con éxito",
                showConfirmButton: false,
                timer: 2000
            })
                    
            $('#m_cambioCorreo').modal('hide');
            
            location.reload();
           }

        },
        error: function(data){
            alert("error!!")

        }

    });

}

function actualizarpag(){
    location.reload();
}


   
    