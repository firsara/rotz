;(function($){

  var handleScroll = null;
  var isActive = false;

  var wheel = function(){
    var delta = 0;

    if (! event) /* For IE. */
      event = window.event;
    if (event.wheelDelta) { /* IE/Opera. */
      delta = event.wheelDelta/120;
    } else if (event.detail) { /** Mozilla case. */
      /** In Mozilla, sign of delta is different than in IE.
       * Also, delta is multiple of 3.
       */
      delta = -event.detail/3;
    }
    /** If delta is nonzero, handle it.
     * Basically, delta is now positive if wheel was scrolled up,
     * and negative, if wheel was scrolled down.
     */
    if (delta && handleScroll) handleScroll(delta);
    /** Prevent default actions caused by mouse wheel.
     * That might be ugly, but we handle scrolls somehow
     * anyway, so don't bother here..
     */
    if (event.preventDefault) event.preventDefault();

    event.returnValue = false;
  };

  $.wheel = function(callback){
    if (handleScroll) $.unwheel();
    handleScroll = callback;

    if (window.addEventListener)
      /** DOMMouseScroll is for mozilla. */
      window.addEventListener('DOMMouseScroll', wheel, false);

    /** IE/Opera. */
    window.onmousewheel = document.onmousewheel = wheel;
  };

  $.unwheel = function(){
    handleScroll = null;

    if (window.addEventListener)
      /** DOMMouseScroll is for mozilla. */
      window.removeEventListener('DOMMouseScroll', wheel, false);

    /** IE/Opera. */
    window.onmousewheel = document.onmousewheel = null;
  };

})(jQuery);