/**
 * External Dependencies
 */
import 'jquery';
import 'bootstrap';

$(document).ready(() => {
  // console.log('Hello world');

  function pageNotTop() {
    var notTop = false;
    var body = jQuery('body');
    jQuery(document).scroll(function() {
      if (jQuery(document).scrollTop() > 30) {
        if (!notTop) {
          notTop = true;
          body.addClass('not-top');
        }
      } else {
        notTop = false;
        body.removeClass('not-top');
      }
    });
  }
  pageNotTop();

  var allImageLinks = $('a[href$=".jpg"],a[href$=".jpeg"],a[href$=".png"], a[href*="youtu"]');
  $(allImageLinks).fancybox({
    // selector : '.gallery a'
    buttons : [
      'download',
      'thumbs',
      'zoom',
      'close',
    ]
  });

  $(".gallery-item .gallery-icon a").attr('data-fancybox','gallery').fancybox({
    thumbs : {
      autoStart : true,
      axis: "x"
    }
  });

  // BS4 modal
  // $($allImageLinks).click(function (e) {
  //   e.preventDefault();
  //   var url = $(this).attr('href');
  //   var image = '<img class="img-fluid w-100" src='+url+' alt="">';
  //   var modalHtml = '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+image+'</div></div></div></div>';
  //   if($(this).find('.modal').length < 1){
  //     $(this).closest('a').append(modalHtml)
  //   }
  //   $(this).find('.modal').modal()
  // })

  // Submenu
  function menuNavigation() {
    $('.navbar .navbar-nav > li.menu-item-has-children > a').on('mouseenter touchend focus', function(e) {
      e.preventDefault();
      $('.header-nav .navbar-nav > li').removeClass('open');
      $(this).parent().addClass('open');
    });

    function closeMenu() {
      $('.navbar .navbar-nav > li').removeClass('open');
    }

    $('.navbar .navbar-nav > li:not(.menu-item-has-children)').on('mouseenter touchend focus', function(e) {
      closeMenu();
    });

    $('body').on('click', function() {
      closeMenu();
    });
    $('header.banner').mouseleave(function() {
      closeMenu();
    });
  }
  if ($(window).width() >= 992) {
    menuNavigation();
  }

  // Table
  function checkTableWidth() {
    $('table').each(function() {
      var elem = $(this),
        shadowRight,
        elemParent = elem.parent('.table-wrap');
      if (!elemParent.hasClass('table-wrap')) {
        elem.wrap('<div class="table-wrap">');
        elemParent = elem.parent('.table-wrap');
      }
      if (elem.find('.shadow_right').length === 0) {
        shadowRight = $('<span class="shadow_right"></span>').appendTo($(this));
      }
      if (elem.find('.shadow_left').length === 0) {
        shadowRight = $('<span class="shadow_left"></span>').appendTo($(this));
      }

      function checkOverflow() {
        if (elem.find('tbody').outerWidth() > elemParent.outerWidth()) {
          elemParent.addClass('overflow');
          elemParent.addClass('right_active');
        } else {
          elemParent.removeClass('overflow');
        }
      }
      checkOverflow();

      $(window).resize(function() {
        checkOverflow();
      });
    });
    $('table').on('scroll', function() {
      if ($(this).parent().hasClass('table-wrap')) {
        var elem = $(this),
          elemBody = elem.find('tbody'),
          elemParent = elem.parent('.table-wrap');
        var scrolled = (elemBody.outerWidth() - elemParent.outerWidth() - elem.scrollLeft());
        if (scrolled < 3) {
          elemParent.addClass('left_active');
          elemParent.removeClass('right_active');
        } else if (elem.scrollLeft() < 3) {
          elemParent.removeClass('left_active');
          elemParent.addClass('right_active');
        } else {
          elemParent.addClass('left_active');
          elemParent.addClass('right_active');
        }
      }
    });
  }
  checkTableWidth();

  // Map
  function makeMap() {
    var snazzyMap = JSON.parse(wpGlobals.mapOptions);
    var map = new google.maps.Map(document.getElementById('the-map'), {
      center : new google.maps.LatLng(59.5444132, 25.2493266),
      zoom : 10,
      mapTypeId : google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: true,
      styles : snazzyMap
    });
    var marker = new google.maps.Marker({
      position : new google.maps.LatLng(59.5201922, 25.2764296),
      draggable: true,
      animation: google.maps.Animation.DROP
    });
    marker.addListener('click', toggleBounce);
    marker.setMap(map);

    function toggleBounce() {
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }

  }
  google.maps.event.addDomListener(window, 'load', makeMap);

  var wpGlobals = {"mapOptions":"[{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#1e2d3b\"}]},{\"featureType\":\"landscape\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#edcd1f\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#29768a\"},{\"lightness\":-37}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#406d80\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#406d80\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"#3e606f\"},{\"weight\":2},{\"gamma\":0.84}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry\",\"stylers\":[{\"weight\":0.6},{\"color\":\"#1a3541\"}]},{\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#edcd1f\"}]}]"};

});
