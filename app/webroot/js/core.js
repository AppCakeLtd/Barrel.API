// Core.js
// Aug 12, 2013

(function($) {
	
	$(function() {
		Barrel.core.init();
	});
	
	var Barrel = Barrel || {};
	
	Barrel.core = {
		init: function() {
			var base = this;
			base.$navbar = $('.navbar');
			
			base.attachEvents();
		},
		
		attachEvents: function() {
			var base = this;
			
			base.$navbar.find('ul.nav a:lt(2)').on({
				click: function(e) {
					var $el = $(e.currentTarget);
					e.preventDefault();
					
					var scrollEl = $el.attr('href') == '#' ? '#home' : $el.attr('href');
					var offset = $el.attr('href') == '#' ? 60 : 0;
					
					base.scrollTo(scrollEl, 500, offset);
				}
			});
			
			$(window).on({
				scroll: function(e) {
					var topScroll = $('html').scrollTop() > 0 ? $('html').scrollTop() : $('body').scrollTop();
					if (topScroll < $('#features').offset().top) {
						base.$navbar.find('ul.nav li').removeClass('active');
						base.$navbar.find('ul.nav li:first').addClass('active');
					}
					else if (topScroll >= $('#features').offset().top) {
						base.$navbar.find('ul.nav li').removeClass('active');
						base.$navbar.find('ul.nav li:eq(1)').addClass('active');
					}
				}
			});
		},
		
		scrollTo: function(el, speed, offset) {
			speed = speed || 'fast';
			offset = offset || 0;
			
			if (typeof (el) === 'string') {
				el = $(el);
			}
			
			$('html, body').animate({
				scrollTop: el.offset().top - offset
			}, speed);
		}
	}
}(jQuery));