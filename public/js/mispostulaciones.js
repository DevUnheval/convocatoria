$(document).ready(function() {
        var myTable=$('#zero_config').DataTable( {
            bProcessing: true,
            sAjaxSource: $('#zero_config').data("url"),
            "language" : {'url':'/js/table-latino.json'},
            iDisplayLength: 15,
             aLengthMenu: [15, 25,50, 100],
             bAutoWidth: true,
              order: []
        }) 

})