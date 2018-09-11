var hasTouch = 'ontouchstart' in window;
var windowWidth = $(window).width();

$(document).ready(function() {
  $('body').removeClass('loading');

  $('.flipper-toggle').hover(function() {
    if ($(this).hasClass('flipper-toggle-1')) {
      $('body').addClass('flipped2');
    } else {
      $('body').removeClass('flipped2');
    }
  });

  $('input[type="range"]').rangeslider({
    polyfill: false,
    onSlide: function(position, value) {
      $('.flipper-content').css('transform', 'rotateY(' + value + 'deg)');
      $('.flipper-logo').css('transform', 'rotateY(' + (value * 3) + 'deg)');
    }
  });


  document.onmousemove = handleMouseMove;
    function handleMouseMove(event) {
        var dot, eventDoc, doc, body, pageX, pageY;

        event = event || window.event;
        if (event.pageX == null && event.clientX != null) {
            eventDoc = (event.target && event.target.ownerDocument) || document;
            doc = eventDoc.documentElement;
            body = eventDoc.body;

            event.pageX = event.clientX +
              (doc && doc.scrollLeft || body && body.scrollLeft || 0) -
              (doc && doc.clientLeft || body && body.clientLeft || 0);
            event.pageY = event.clientY +
              (doc && doc.scrollTop  || body && body.scrollTop  || 0) -
              (doc && doc.clientTop  || body && body.clientTop  || 0 );
        }

        // Use event.pageX / event.pageY here

        var percentage = event.pageX / windowWidth;
        var rotation = percentage * 480;
        var logoRotation = (0 - percentage) * 180;

        //$('.flipper-content').css('transform', 'rotateY(' + rotation + 'deg)');
        //$('.flipper-logo').css('transform', 'rotateY(' + logoRotation + 'deg)');
    }
});
