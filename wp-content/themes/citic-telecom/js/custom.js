jQuery(window).load(function() {

	jQuery('#slidebox').flexslider({
		animation: "fade",
		directionNav:true,
		controlNav:false
	});

	/* Navigation */

	jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   { opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	  

	jQuery('#topmenu').mobileMenu({
		prependTo:'.mobilenavi'
	});	
	
});

// home news slider	
jQuery(document).ready(function($){
	$('.home-news').slick({
  		fade: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
  		autoplaySpeed: 2000,
  		dots: true,
  		arrows: false,
	});

	$('.home-news-list').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: false,
  		dots: false,
  		arrows: true,

  		responsive: [
  		 {
		      breakpoint: 1200,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1,
		        infinite: true,
		      }
		    },
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1,
		        infinite: true,
		      }
		    },
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		]
	});

	$('.home-highlight').slick({
  		fade: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
  		autoplaySpeed: 2500,
  		arrows: false
	});

	// $('.newsblock-equalizer').matchHeight({
	// 	byRow: false,
	//     property: 'height',
	//     target: null,
	//     remove: false
	// });

	$('.hometools-equalizer').matchHeight({
		byRow: false,
	    property: 'height',
	    target: null,
	    remove: false
	});

});






