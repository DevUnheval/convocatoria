$(document).ready(function() {
    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/maestro/tipoprocesos/data',
        "language" : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: []
    }) 

});

function editar(id,nombre,descripcion){
    var id = id;
    var nombre = nombre;
    var descripcion=descripcion;
   // alert("==========>");
    $("#modal_edit_tipo_proc").modal("show");
    console.log("id",id);
    console.log("nombre",nombre);
    console.log("descripcion",descripcion);
}
