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
			base.$context = $('body');
			base.$content = base.$context.find('.content');
			
			base.attachEvents();
			if (base.helpers.onPage('/Games/Database')) {
    			base.prepareGameDB();
			}
		},
		
		attachEvents: function() {
			
		},
		
		prepareGameDB: function() {
            var base = this;
		
    		base.$content.find('.thumbnail > p').ellipsis();
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
	},
	
	Barrel.core.helpers = {
    	onPage: function(page) {
        	return window.location.href.indexOf(page) > -1;
    	}
	}
}(jQuery));