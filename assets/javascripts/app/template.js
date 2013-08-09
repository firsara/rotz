app.template = (function(window, document, $, self, undefined){

  self.before = function(){
    //$('body').find('*').unbind().off();
  };

  self.parse = function(data){
    $('#header .toggle.active').trigger('click');
    $('#header .active').removeClass('active');
    $('#header a[href="'+data.url+'"]').addClass('active');

    $('#content').html(data.content);
    app.layout.initializeNewContent();
  };

  self.render = function(data){
  };

  return self;

})(window, window.document, jQuery, {});