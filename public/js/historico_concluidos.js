$(function(){

    var myTable=$('#zero_config').DataTable( {
        bProcessing: true,
        sAjaxSource: '/convocatorias/historico/concluido/data',
        language : {'url':'/js/table-latino.json'},
        iDisplayLength: 15,
         aLengthMenu: [15, 25,50, 100],
         bAutoWidth: true,
          order: [],
    })
})