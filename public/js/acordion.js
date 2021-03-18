$(document).ready(function() {
  //document.getElementById("accordion-saem").disabled = true;
  $(".btn-accordion").click(function(){
    const clase_temporal = $(this).toggleClass("active").attr("class");
    $(".btn-accordion").removeClass("active");
    $(this).attr("class",clase_temporal);
  })
})