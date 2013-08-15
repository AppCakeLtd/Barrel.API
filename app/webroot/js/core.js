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