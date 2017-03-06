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
                    margin:30,
					dots: true
                  }
                }
              })
            })

			

$(document).ready(function() {
              $('.owl-carousel-1').owlCarousel({
				  autoplay: true,
    			autoPlaySpeed: 5000,
    			autoPlayTimeout: 5000,
   				autoplayHoverPause: true,
				lazyLoad : true,
                loop: true,
				dots: false,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: false,
					dots:true,
                  },
                  600: {
                    items:3,
                    nav: false
                  },
                  1000: {
                    items:4,
                    nav: false,
                    loop: false,
                    margin:30
                  }
                }
              })
            })

$(document).ready(function() {
              $('.owl-carousel-3').owlCarousel({
                animateOut: 'fadeOut',
				autoplay: false,
    			autoPlaySpeed: 5000,
    			autoPlayTimeout: 5000,
   				autoplayHoverPause: true,
                loop: true,
				dots: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    nav: true
                  },
                  600: {
                    items:1,
                    nav: true
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


// SCROLL BAR

	$(".x-scroll").mCustomScrollbar({
					axis:"x",
					advanced:{autoExpandHorizontalScroll:true}
				});


