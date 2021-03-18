$(document).ready(function() {

//__________________________LLENAR TABLA MISPOSTULACIONES    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: "/mispostulaciones/datatabla",
        type: "GET",
        datatype: "json",
        success:function(data){
           console.log(data);

           var html_tabla=""
           if(data.length == 0){
            html_tabla += "<tr>"+
            "<td colspan='8'>Todavía no tiene postulaciones...</td>"+
            "</tr>";
           }else{
           for(i=0 ; i<data.length; i++){
            html_tabla += "<tr>"+
            "<td>"+data[i].cod+"</td>"+
            "<td><b><i class=\"fa fa-address-book\"></i></b>"+data[i].nombre+"<br><b><i class=\"fa fa-home\"></i> </b><small>"+data[i].oficina+"<small></td>"+
            "<td></td>"+
            "<td></td>"+
            "<td></td>"+
            "<td></td>"+
            "<td></td>"+
            "<td>"+data[i].estado+"</td>"+
            "</tr>";
           }
        }
           $("#mispostulaciones").html(html_tabla);
        }
        ,error: function(data){
            alert("error!!"); }

    });  


})