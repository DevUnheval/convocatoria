$(document).ready(function(){

$('#file_foto').on('change',() => {
var formData = new FormData();
formData.append('foto',$('#file_foto').prop('files')[0]);
//console.log("que hay: ",formData.get('foto'));
if($('#file_foto').prop('files')[0] != undefined){
$('#fotografia').prop('src',URL.createObjectURL(formData.get('foto')));
}
})

$('#btn_update_foto').on('click', () => {
    
    if($('#file_foto').val() != ""){
    var formData = new FormData();
    formData.append('foto',$('#file_foto').prop('files')[0]);
   // console.log(formData.get('foto'));
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/update_fotografia",
        type: "POST",
        datatype: "json",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
          // console.log(data);
            var src = data.replace('public/','/storage/');
            $('#foto_perfil').prop('src',src);
            $('#img_material').prop('src',src);
            $('#img_material_peque').prop('src',src);
            $('#m_fotografia').modal('hide');
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: "Fotografía actualizada",
                showConfirmButton: false,
                timer: 2000
            })
        },
        error: function(data){
            console.log("error!!")

        }

    });
    }else {
        Swal.fire({
            type: 'warning',
            title: "¡Advertencia!",
            text: `Debe de cargar una imagen.`,
            timer: null
        })
    }

})

})
