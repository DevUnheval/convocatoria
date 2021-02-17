$(document).ready(function() {
    $(".select_2").select2({
        placeholder: "Distrito - provincia - departamento",
        minimumInputLength: 3,
        ajax: {
            url: '/buscar_ubigeo_reniec',
            dataType: 'json',
            type:   'GET',
            delay: 10,
            data: function(params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (data) {
                  return {
                    results: data
                  };
            },
            cache: true
        },
        language: 
        {
            errorLoading: function () {
                return "La carga falló";
            },
            inputTooLong: function (e) {
                var t = e.input.length - e.maximum,
                    n = "Por favor, elimine " + t + " car";
                return t == 1 ? (n += "ácter") : (n += "acteres"), n;
            },
            inputTooShort: function (e) {
                var t = e.minimum - e.input.length,
                    n = "Por favor, introduzca " + t + " car";
                return t == 1 ? (n += "ácter") : (n += "acteres"), n;
            },
            loadingMore: function () {
                return "Cargando más resultados…";
            },
            maximumSelected: function (e) {
                var t = "Sólo puede seleccionar " + e.maximum + " elemento";
                return e.maximum != 1 && (t += "s"), t;
            },
            noResults: function () {
                return "No se encontraron resultados";
            },
            searching: function () {
                return "Buscando…";
            },
        },
    });
});