$(document).ready(function(){

$('#file_foto').on('change',() => {
var formData = new FormData();
formData.append('foto',$('#file_foto').prop('files')[0]);
$('#fotografia').prop('src',URL.createObjectURL(formData.get('foto')));
})

$('#btn_update_foto').on('click', () => {
    file_foto
    var formData = new FormData();
    formData.append('foto',$('#file_foto').prop('files')[0]);

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/postulante/perfil/update_fotografia",
        type: "POST" ,
        datatype: "json",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
           //console.log(data);
           var src = data.replace('public/','/storage/');
           $('#foto_perfil').prop('src',src);
           $('#img_material').prop('src',src);
           $('#img_material_peque').prop('src',src);
           $('#m_fotografia').modal('hide');
        },
        error: function(data){
            alert("error!!")

        }

    });


})

})
