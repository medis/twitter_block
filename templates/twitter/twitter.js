(function($) {
  
$(function() {
  if ($('#twitter-wrapper .more-info').length > 0) {
    $('#twitter-wrapper .more-info').bind('click', function() {
        if ($(this).hasClass('collapsed')) {
          $(this).removeClass('collapsed').addClass('expanded');
          $(this).find('.title').text('Collapse');
        } else if ($(this).hasClass('expanded')) {
          $(this).removeClass('expanded').addClass('collapsed');
          $(this).find('.title').text('Expand');
        }
      $(this).find('.info').slideToggle('fast');
    });
  }
});

})(jQuery);