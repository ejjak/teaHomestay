$(function() {
  //----- OPEN
  $('[data-popup-open]').on('click', function(e)  {
    var targeted_popup_class = jQuery(this).attr('data-popup-open');
    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

    e.preventDefault();
  });

  //----- CLOSE
  $('[data-popup-close]').on('click', function(e)  {
    var targeted_popup_class = jQuery(this).attr('data-popup-close');
    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

    e.preventDefault();
  });
});
// OWL CAROUSEL

$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    autoplay: true,
    autoPlaySpeed: 5000,
    autoPlayTimeout: 5000,
    autoplayHoverPause: true,
    loop: true,
    rewindNav: true,
    dots: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      600: {
        items:1,
        nav: false
      },
      1000: {
        items:1,
        nav: false,
        loop: false,
        dots: true
      }
    }
  })
})

$(document).ready(function() {
  $('.owl-carousel-1').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items:1,
        nav: false
      },
      1000: {
        items:1,
        nav: true,
        loop: false,
        margin:30
      }
    }
  })
})


// NAV

$('#toggle-menu').click(function(e) {
  e.preventDefault();
  $('ul').toggleClass('active');
});

$('.tp_cnct').click(function() {
  $('.two').slideToggle();
})
// Scroll effect

$(window).scroll(function(){

  var scroll = $(window).scrollTop();

  if (scroll > 0 ) {
    $('.header').addClass('sticky');
  }

  if (scroll <= 0 ) {
    $('.header').removeClass('sticky');
 }

});




// SCROLL DETECT

//$('html').on ('mousewheel', function (e) {
    //var delta = e.originalEvent.wheelDelta;

    //if (delta < 0) {
        //$('.bread').addClass('crumb-fix');
    //}
	//if (delta > 0) {
     //   $('.bread').removeClass('crumb-fix');
   // }
//});

$(window).scroll(function(){

  var scroll = $(window).scrollTop();

  if (scroll > 0 ) {
    $('.bread').addClass('crumb-fix');
  }

  if (scroll <= 0 ) {
    $('.bread').removeClass('crumb-fix');
 }

});



// ACCORDION 

$("#accordion").on("shown.bs.collapse", function () {
    var myEl = $(this).find('.collapse.in').prev('.panel-heading');

    $('html, body').animate({
        scrollTop: $(myEl).offset().top - 110
    }, 800);
});

// ANCHOR TAG SCROLL

$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});

// DATEPICKER
$(function(){
  $('.datepicker').datepicker({
    format: 'mm-dd-yyyy'
  });
});


