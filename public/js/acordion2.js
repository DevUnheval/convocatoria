$(document).ready(function () {
  $("#btn-exp").on("click", function () {
      $(this).toggleClass("icono-cerrado");
      $(this).toggleClass("glyphicon glyphicon-collapse-down");
      $(this).toggleClass("glyphicon glyphicon-collapse-up");
      $(this).toggleClass("icono-abierto");
  });
});