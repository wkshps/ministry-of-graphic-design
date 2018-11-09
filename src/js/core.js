var hasTouch = 'ontouchstart' in window,
    logo = Math.floor(Math.random() * 6) + 1,
    scrollPosition = 0;

$(document).ready(function() {
  $('html').addClass('logo-' + logo);

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

  $('.main').scroll(function() {
    scrollPosition = $('.main').scrollTop();

    if (scrollPosition > 10) {
      $('html').addClass('scrolled');
    } else {
      $('html').removeClass('scrolled');
    }
  });

  $('.view').click(function(e) {
    e.preventDefault();

    $('.view.active').removeClass('active');

    if ($(this).hasClass('view-grid')) {
      $('html').addClass('grid-view');
      $('.view-grid').addClass('active');
    } else {
      $('html').removeClass('grid-view');
      $('.view-list').addClass('active');
    }
  });

  $('.site-nav-toggle').click(function(e) {
    e.preventDefault();

    if ($('html').hasClass('site-nav-active')) {
      $('html').removeClass('site-nav-active');
    } else {
      $('html').addClass('site-nav-active');
    }
  });

  setTimeout(function() {
    $('html').removeClass('loading');
  }, 120);
});
