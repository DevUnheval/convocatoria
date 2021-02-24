$(document).ready(function () {
  $("#btn-exp").on("click", function () {
      $(this).toggleClass("icono-cerrado");
      $(this).toggleClass("fa fa-arrow-circle-right");
      $(this).toggleClass("fa fa-window-minimize");
      $(this).toggleClass("icono-abierto");
  });
});