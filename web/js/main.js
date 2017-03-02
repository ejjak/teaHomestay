
$(document).ready(function() { 
		$('#incfont').click(function(){	   
        curSize= parseInt($('.about-us, .content, .table_bor').css('font-size')) + 2;
		if(curSize<=20)
        $('.about-us, .content, .table_bor').css('font-size', curSize);
        });  
		$('#decfont').click(function(){	   
        curSize= parseInt($('.about-us, .content, .table_bor').css('font-size')) - 2;
		if(curSize>=12)
        $('.about-us, .content, .table_bor').css('font-size', curSize);
        }); 
	});
	
//  Script to Activate the Carousel

$('.carousel').carousel({
        interval: 5000 //changes the speed
    })
	
// Scroll effect

$(window).scroll(function(){

  var scroll = $(window).scrollTop();

  if (scroll > 0 ) {
    $('nav').addClass('scrolled');
  }

  if (scroll <= 0 ) {
    $('nav').removeClass('scrolled');
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


$(document).ready(function() {
	var odometer,next;
    var data = [
        {text:'GSDP AT CURRENT PRICES (Rs in Lakhs)',value:'16,63678'},
        {text:'GSDP AT CONSTANT PRICES (Rs in Lakhs)',value:'1372154'},
        {text:'NSDP AT CURRENT PRICES (in Rs)',value:'1458646'},
        {text:'NSDP AT CONSTANT PRICES (in Rs)',value:'1192843'},
        {text:'PER CAPITA INCOME AT CURRENT PRICES (in Rs)',value:'259950'},
        {text:'PER CAPITA INCOME AT CONSTANT PRICE (in Rs)',value:'214399'},
    ];
    var currentNumber = 0;
    var od = document.querySelector('.odometer');
    odometer = new Odometer({
        el: od,
        value: data[0].value,		
    });
    odometer.render();
    next = function() {
        var number;
        number = data[currentNumber];
        odometer.update(number.value);
        $('.my-slider').find('.odometer-title').html(number.text);
        return currentNumber = (currentNumber + 1) % data.length;
    };
    next();
    return setInterval(function() {
        return next();
    }, 5000);

})


// SCROLL BAR

	$(".x-scroll").mCustomScrollbar({
					axis:"x",
					advanced:{autoExpandHorizontalScroll:true}
				});