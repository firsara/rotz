app.layout.global = (function(window, document, $, layout, undefined){

  layout.resize = function(){
    $('.project-detail').css('height', $(window).height() - $('#header').height() - $('#footer').height());
    $('.project-detail').css('position', 'relative');
    $('.project-detail').css('top', $('#header').height());
  };

  layout.loaded = function(){
    $('.responsive-image').unveil();
  };

  layout.setup = function(){
    $('.hate').click(function(e){
      e.preventDefault();

      var el = $(this);
      var url = $(this).attr('href');

      $.get(url, function(result){
        el.find('.text').html(result);
      });
    });
  };

  layout.match = function(){
  };

  layout.unmatch = function(){
  };

  return layout;

})(window, window.document, jQuery, {});