jQuery(document).ready(function($){
		"use strict";
				
		// GALLERY
		var demo1 = $("#eternal-slider").slippry({
			speed: 1000,
			pager:false,
			captions:false
		});		
				
		// PRELOADER
		$("#preloader-container").delay(2000).fadeOut("slow");
				
		// MENU
		var select_menu_container = $('.eternal-menu-container');
		var close_menu = $('.close-menu');
		var open_menu = $('.open-menu');
		var header = $('header');	
		$('#open-menu').on("click", function(){
			select_menu_container.css('display','block').css('opacity','1');
			close_menu.css('display','block');
			open_menu.css('display','none');
			header.addClass('header-menu-open');
			return false;
		});		
		$('#close-menu').on("click", function(){
			select_menu_container.css('display','none');
			close_menu.css('display','none');
			open_menu.css('display','block');
			header.removeClass('header-menu-open');
			return false;
		});	
			
		// HIDDEN MENU WHEN CLICK ON MENU ITEM		
		$("#eternal-menu li a").on( "click", function() {	
			select_menu_container.css('opacity','0').css('display','none');
			close_menu.css('display','none');
			open_menu.css('display','block');
			header.removeClass('header-menu-open');
			return false;				
		});	
					
		// MENU ANIMATE BUTTON
		$('#eternal-menu a').on( "click", function(event){
			$('html, body').animate({
				scrollTop: $( $.attr(this, 'href') ).offset().top
			}, 500);
			event.preventDefault();
			return false;
		});		
		
		// PORTFOLIO
		var portofolio_item = $("#portfolio-image");
		$('#works-categories-list .item-cat').on("click", function(){
			$('.works-categories-list .item-cat').removeClass('active-cat');
			$(this).addClass('active-cat');
			var dataitem = this.getAttribute('data-item');	
			portofolio_item.find(".item-portfolio .item-portfolio-container").css("opacity","0.2");
			portofolio_item.find(".item-portfolio .item-portfolio-info").css("visibility","hidden");
			portofolio_item.find(".item-portfolio[data-item='" + dataitem + "'] .item-portfolio-container").css("opacity","1");
			portofolio_item.find(".item-portfolio[data-item='" + dataitem + "'] .item-portfolio-info").css("visibility","visible");
			if(dataitem == 0) {
				portofolio_item.find(".item-portfolio-container").css("opacity","1");
				portofolio_item.find(".item-portfolio .item-portfolio-info").css("visibility","visible");			
			}
			return false;
		});
		
		if ( screen.availWidth > 1023 ) {
			$('#portfolio-image').masonry({
				itemSelector: '.item-portfolio',
				percentPosition: true,
				gutter: 0,
				columnWidth: '.item-portfolio-column'
			})	
		}
		
		$('#portfolio-image').magnificPopup({
		  	delegate: '.et-mp-zoom',
		  	type: 'image',
		  	gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1]
		  	}
		});
				
		// COUNTER 
		$('.item-counter').appear(function() {
			$('.counter').data('countToOptions', {
				  	formatter: function (value, options) {
				  		return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, '');
				  	} 
			});			  				  				  
			$('.timer').each(count);					  
			function count(options) {
					var $this = $(this);
					options = $.extend({}, options || {}, $this.data('countToOptions') || {});
					$this.countTo(options);
			}				
		});		
					
		// INSTAGRAM
		$('#instagram-image').magnificPopup({
		  	delegate: '.et-mp-zoom',
		  	type: 'image',
		  	gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1]
		  	}
		});	
		
});