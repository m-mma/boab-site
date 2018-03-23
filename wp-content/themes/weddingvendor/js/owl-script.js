// JavaScript Document
jQuery(document).ready(function($){
	if($('.owl-carousel').hasClass('slider'))
	{
		"use strict";
		$(".slider").owlCarousel({
		  nav : false, // Show next and prev buttons
		  autoplayTimeout : 300,
		  dotsSpeed : 400,
		  autoPlay: true,
		  transitionStyle : "fade",
		  autoPlay:4000,
		  items : 1,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},	
		
		});		
	}

	if($('.owl-carousel').hasClass('owl-gallery-slide'))
	{
		"use strict";
		$(".owl-gallery-slide").owlCarousel({
		  nav: false, // Show next and prev buttons
		  autoplayTimeout : 5000,
		  smartSpeed : 1000,
		  autoPlay: true,
		  transitionStyle : "fade",
		  items : 1,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},	
		});		
	}	

	if($('.owl-carousel').hasClass('testimonial'))
	{
		"use strict";
		$(".testimonial").owlCarousel({
			nav: false, // Show next and prev buttons
			autoplayTimeout : 5000,
			smartSpeed : 1000,
			autoplay:true,
			loop:true,
			items : 3,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:3
				}
			},			  
		});		
	}	
	"use strict";
	var sync1 = $("#sync1");
	var sync2 = $("#sync2");	 

	var syncedSecondary = true;
	
	sync1.owlCarousel({
		items:1,
		loop:true,
		margin:0,
		autoplay:true,
		autoplayTimeout:6000,
		autoplayHoverPause:false,
		nav: false,
		dots: false
	}).on('changed.owl.carousel', syncPosition);
	
	sync2
	.on('initialized.owl.carousel', function () {
		sync2.find(".owl-item .projectitem").eq(0).addClass("active");
	})
	.owlCarousel({
		items:6,
		margin:10,
		autoplay:true,
		nav: false,
		dots: false
	}).on('changed.owl.carousel', syncPosition2);
	
	function syncPosition(el) {
		//if you set loop to false, you have to restore this next line
		var current = el.item.index;
	
		//if you disable loop you have to comment this block
		var count = el.item.count-1;
		var current = Math.round(el.item.index - (el.item.count/6) - .5);
		if(current < 0) {
			current = count;
		}
		if(current > count) {
			current = 0;
		}
		//end block
	
		sync2
		.find(".projectitem")
		.removeClass("active")
		.eq(current)
		.addClass("active");
	}
	
	function syncPosition2(el) {
		if(syncedSecondary) {
			var number = el.item.index;
			sync1.data('owl.carousel').to(number, 100, true);
		}
	}
	
	sync2.on("click", ".projectitem", function(e){
		e.preventDefault();
		sync1.trigger('to.owl.carousel', [$(e.target).parents('.owl-item').index(), 300, true]);
	});


});