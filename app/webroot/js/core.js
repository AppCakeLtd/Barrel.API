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
    		base.prepareActiveButtons();
		},
		
		prepareActiveButtons: function() {
			var base = this,
				components = window.location.href.split('/'),
				lastPathComponent = '';
			
			if (components && components.length) {
				lastPathComponent = components[components.length - 1];
			}
			
			// Highlight the active button
			base.$content.find('.btn-toolbar a.btn').removeClass('active');
			base.$content.find('.btn-toolbar a.btn[data-letter="' + lastPathComponent + '"]').addClass('active');
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