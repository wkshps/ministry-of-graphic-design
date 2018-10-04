var hasTouch = 'ontouchstart' in window;

$(document).ready(function() {
  var rotation = Cookies.get('rotation');

  if (rotation != undefined) {
    $('.flipper-content').css('transform', 'rotateY(' + rotation + 'deg)');
    $('.flipper-logo').css('transform', 'rotateY(' + (rotation * 3) + 'deg)');
    $('input[type="range"]').val(rotation).change();
  }

  $('input[type="range"]').rangeslider({
    polyfill: false,
    onSlide: function(position, value) {
      $('.flipper-content').css('transform', 'rotateY(' + value + 'deg)');
      $('.flipper-logo').css('transform', 'rotateY(' + (value * 3) + 'deg)');
      Cookies.set('rotation', value, { expires: 7 });
    }
  });

  setTimeout(function() {
    $('html').removeClass('loading');
  }, 120);
});
