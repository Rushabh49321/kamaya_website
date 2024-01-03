
$.fn.jQuerySimpleCounter = function( options ) {
    var settings = $.extend({
        start:  0,
        end:    100,
        easing: 'swing',
        duration: 400,
        complete: ''
    }, options );

    var thisElement = $(this);

    $({count: settings.start}).animate({count: settings.end}, {
        duration: settings.duration,
        easing: settings.easing,
        step: function() {
            var mathCount = Math.ceil(this.count);
            thisElement.text(mathCount+'+');
        },
        complete: settings.complete
    });
};


$('#number1').jQuerySimpleCounter({end: 6,duration: 3000});
$('#number2').jQuerySimpleCounter({end: 269,duration: 3000});
$('#number3').jQuerySimpleCounter({end: 6,duration: 2000});
$('#number4').jQuerySimpleCounter({end: 1000,duration: 2500});



  /* AUTHOR LINK */
 $('.about-me-img').hover(function(){
        $('.authorWindowWrapper').stop().fadeIn('fast').find('p').addClass('trans');
    }, function(){
        $('.authorWindowWrapper').stop().fadeOut('fast').find('p').removeClass('trans');
    });
jQuery( document ).ready(function( $ ) {


	"use strict";


    
        $(function() {
            $( "#tabs" ).tabs();
        });


        // Page loading animation

        $("#preloader").animate({
            'opacity': '0'
        }, 600, function(){
            setTimeout(function(){
                $("#preloader").css("visibility", "hidden").fadeOut();
            }, 300);
        });
        

        $(window).scroll(function() {
          var scroll = $(window).scrollTop();
          var box = $('.header-text').height();
          var header = $('header').height();

          if (scroll >= box - header) {
            $("header").addClass("background-header");
            $(".logo").attr("src", "./assets/images/kamya-black.png");
            $(".shop-button").css({"background-color": "#44536a", "color": "#fff"});
          } else {
            $("header").removeClass("background-header");
            $(".logo").attr("src", "./assets/images/kamya-white.png");
            $(".shop-button").css({"background-color": "#fff", "color": "#44536a"});
          }
        });
        if ($('.owl-clients').length) {
            $('.owl-clients').owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                items: 1,
                margin: 30,
                autoplay: false,
                smartSpeed: 700,
                autoplayTimeout: 6000,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 3,
                        margin: 20
                    },
                    992: {
                        items: 5,
                        margin: 30
                    }
                }
            });
        }
		if ($('.owl-testimonials').length) {
            $('.owl-testimonials').owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                items: 1,
                margin: 30,
                autoplay: false,
                smartSpeed: 700,
                autoplayTimeout: 6000,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 2,
                        margin: 20
                    },
                    992: {
                        items: 2,
                        margin: 30
                    }
                }
            });
        }
        if ($('.owl-banner').length) {
            $('.owl-banner').owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                items: 1,
                margin: 0,
                autoplay: false,
                smartSpeed: 700,
                autoplayTimeout: 6000,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    460: {
                        items: 1,
                        margin: 0
                    },
                    576: {
                        items: 1,
                        margin: 20
                    },
                    992: {
                        items: 1,
                        margin: 30
                    }
                }
            });
        }

        $(".Modern-Slider").slick({
            autoplay:true,
            autoplaySpeed:10000,
            speed:600,
            slidesToShow:1,
            slidesToScroll:1,
            pauseOnHover:false,
            dots:true,
            pauseOnDotsHover:true,
            cssEase:'linear',
           // fade:true,
            draggable:false,
            prevArrow:'<button class="PrevArrow"></button>',
            nextArrow:'<button class="NextArrow"></button>', 
        });

        $('.filters ul li').click(function(){
        $('.filters ul li').removeClass('active');
        $(this).addClass('active');
          
          var data = $(this).attr('data-filter');
          $grid.isotope({
            filter: data
          })
        });

        var $grid = $(".grid").isotope({
          itemSelector: ".all",
          percentPosition: true,
          masonry: {
            columnWidth: ".all"
          }
        })
        $('.accordion > li:eq(0) a').addClass('active').next().slideDown();

        $('.accordion a').click(function(j) {
            var dropDown = $(this).closest('li').find('.content');

            $(this).closest('.accordion').find('.content').not(dropDown).slideUp();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $(this).closest('.accordion').find('a.active').removeClass('active');
                $(this).addClass('active');
            }

            dropDown.stop(false, true).slideToggle();

            j.preventDefault();
        });
 
});
const multipleItemCarousel = document.querySelector("#carouselExampleControls");

if (window.matchMedia("(min-width:576px)").matches) {
  const carousel = new bootstrap.Carousel(multipleItemCarousel, {
    interval: false
  });

  var carouselWidth = $(".carousel-inner")[0].scrollWidth;
  var cardWidth = $(".carousel-item").width();

  var scrollPosition = 0;

  $(".carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 4) {
      scrollPosition = scrollPosition + cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 600);
    }
  });
  $(".carousel-control-prev").on("click", function () {
    if (scrollPosition > 0) {
      scrollPosition = scrollPosition - cardWidth;
      $(".carousel-inner").animate({ scrollLeft: scrollPosition }, 600);
    }
  });
} else {
  $(multipleItemCarousel).addClass("slide");
}
function shop(){
    window.location.href = "http://kamyatextilemills.com/"
}