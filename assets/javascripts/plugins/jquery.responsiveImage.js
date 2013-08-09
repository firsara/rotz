(function(window, document, $, undefined){
    
  $.fn.responsiveImage = function(resolution, callback){

    if (! resolution) return;

    $(this).each(function(){
      var self = $(this);
      var node = self.is('noscript') ? self : self.find('noscript');
      var sources = $.parseJSON( node.attr('data-src') );
      var image = sources['image'];

      if (app.helper.detections.isRetina && sources[resolution + '-retina']) {
        image = sources[resolution + '-retina'];
      } else if (sources[resolution]) {
        image = sources[resolution];
      }

      self.addClass('responsive-image-loaded');

      var img = self.find('img');

      if (img.size() > 0) {
        if (img.attr('src') == image.src) return;

        var newImage = $('<img src="'+image.src+'" width="'+image.width+'" height="'+image.height+'">');

        newImage.load(function(){
          newImage.insertAfter(self.find('noscript'));
          self.find('img').not(newImage).remove();
          if (callback) callback();
        });
      } else {
        self.find('img').remove();

        var newImage = $('<img src="'+image.src+'" width="'+image.width+'" height="'+image.height+'">');

        if (callback) {
          newImage.load(callback);
        }

        newImage.insertAfter(self.find('noscript'));
      }
      
      return this;
    });
    
    return this;
  };
  
})(window, window.document, jQuery);