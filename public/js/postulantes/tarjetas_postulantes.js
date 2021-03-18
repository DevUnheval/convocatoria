$(document).ready(function() {
    var $btns = $('.note-link').click(function() {
        if (this.id == 'all-category') {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        } if (this.id == 'important') {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        } else {
          var $el = $('.' + this.id).fadeIn();
          $('#note-full-container > div').not($el).hide();
        }
        $btns.removeClass('active');
        $(this).addClass('active');  
    })

    $('.form-check-input').on('change', function() {
        const proceso   = $(this).data("proceso");
        const etapa     = $(this).data("etapa");
        $(location).attr('href', $(this).data("url"));
    });
    
})

