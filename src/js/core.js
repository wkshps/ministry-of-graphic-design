(function(f){if(typeof exports==="object"&&typeof module!=="undefined"){module.exports=f()}else if(typeof define==="function"&&define.amd){define([],f)}else{var g;if(typeof window!=="undefined"){g=window}else if(typeof global!=="undefined"){g=global}else if(typeof self!=="undefined"){g=self}else{g=this}g.fitvids = f()}})(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var selectors = [
  'iframe[src*="player.vimeo.com"]',
  'iframe[src*="youtube.com"]',
  'iframe[src*="youtube-nocookie.com"]',
  'iframe[src*="kickstarter.com"][src*="video.html"]',
  "object"
];

var css =
  ".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";

module.exports = function(parentSelector, opts) {
  parentSelector = parentSelector || "body";
  opts = opts || {};

  if (isObject(parentSelector)) {
    opts = parentSelector;
    parentSelector = "body";
  }

  opts.ignore = opts.ignore || "";
  opts.players = opts.players || "";

  var containers = queryAll(parentSelector);
  if (!hasLength(containers)) return;

  if (!document.getElementById("fit-vids-style")) {
    var head = document.head || document.getElementsByTagName("head")[0];
    head.appendChild(styles());
  }

  var custom = toSelectorArray(opts.players);
  var ignored = toSelectorArray(opts.ignore);
  var ignoredSelector = ignored.length > 0 ? ignored.join() : null;
  var selector = selectors.concat(custom).join();

  if (!hasLength(selector)) {
    return;
  }

  containers.forEach(function(container) {
    var videos = queryAll(container, selector);

    videos.forEach(function(video) {
      if (ignoredSelector && video.matches(ignoredSelector)) {
        return;
      }
      wrap(video);
    });
  });
}

function queryAll(el, selector) {
  if (typeof el === "string") {
    selector = el;
    el = document;
  }
  return Array.prototype.slice.call(el.querySelectorAll(selector));
}

function toSelectorArray(input) {
  if (typeof input === "string") {
    return input
      .split(",")
      .map(trim)
      .filter(hasLength);
  } else if (isArray(input)) {
    return flatten(input.map(toSelectorArray).filter(hasLength));
  }
  return input || [];
}

function wrap(el) {
  if (/fluid-width-video-wrapper/.test(el.parentNode.className)) {
    return;
  }

  var widthAttr = parseInt(el.getAttribute("width"), 10);
  var heightAttr = parseInt(el.getAttribute("height"), 10);

  var width = !isNaN(widthAttr) ? widthAttr : el.clientWidth;
  var height = !isNaN(heightAttr) ? heightAttr : el.clientHeight;
  var aspect = height / width;

  el.removeAttribute("width");
  el.removeAttribute("height");

  var wrapper = document.createElement("div");
  el.parentNode.insertBefore(wrapper, el);
  wrapper.className = "fluid-width-video-wrapper";
  wrapper.style.paddingTop = aspect * 100 + "%";
  wrapper.appendChild(el);
}

function styles() {
  var div = document.createElement("div");
  div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + "</style>";
  return div.childNodes[1];
}

function hasLength(input) {
  return input.length > 0;
}

function trim(str) {
  return str.replace(/^\s+|\s+$/g, "");
}

function flatten(input) {
  return [].concat.apply([], input);
}

function isObject(input) {
  return Object.prototype.toString.call(input) === "[object Object]";
}

function isArray(input) {
  return Object.prototype.toString.call(input) === "[object Array]";
}

},{}]},{},[1])(1)
});



var hasTouch = 'ontouchstart' in window,
    logo = Math.floor(Math.random() * 6) + 1,
    scrollPosition = 0;

var grids = function() {
  $('.grid').each(function() {
    $grid = $(this).masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-item',
      gutter: '.gutter-sizer',
      percentPosition: true,
    });

    $grid.imagesLoaded().progress( function() {
      $grid.masonry('layout');
    });
  });

  setTimeout(function() {
    $('.grid').masonry('layout');
  }, 3000);

  setTimeout(function() {
    $('.grid').masonry('layout');
  }, 6000);

  setTimeout(function() {
    $('.grid').masonry('layout');
  }, 9000);
};

$(document).ready(function() {
  $('html').addClass('logo-' + logo);

  var rotation = Cookies.get('rotation');

  if (rotation != undefined) {
    $('.flipper-content').css('transform', 'rotateY(' + rotation + 'deg)');
    $('.flipper-logo').css('transform', 'rotateY(' + (rotation * 3) + 'deg)');
    $('input[type="range"]').val(rotation).change();
  }

  $('.content').fitVids();

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

  $('.slideshow').slick({
    infinite: true,
    slidesToShow: 1,
    adaptiveHeight: true
  });

  grids();

  setTimeout(function() {
    $('html').removeClass('loading');
  }, 120);
});
