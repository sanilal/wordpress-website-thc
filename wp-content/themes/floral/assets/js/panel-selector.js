var floral_panelSelector = {};

(function ($) {
	"use strict";
	floral_panelSelector = {
		ps_context: '#panel-style-selector',
		onReady   : function () {
			$('.panel-selector-open', floral_panelSelector.ps_context).click(function () {
				$('#panel-style-selector').toggleClass('in');
			});
			this.layout();
			this.background();
			this.rtl();
			this.reset();
			this.demos();
		},
		layout    : function () {
			if ($('body').hasClass('layout-boxed')) {
				$('a[data-value="boxed"]', floral_panelSelector.ps_context).parent().addClass('active');
			} else if ($('body').hasClass('layout-float')) {
				$('a[data-value="float"]', floral_panelSelector.ps_context).parent().addClass('active');
			} else {
				$('a[data-value="wide"]', floral_panelSelector.ps_context).parent().addClass('active');
			}

			$('a[data-type="layout"]', floral_panelSelector.ps_context).click(function (event) {
				event.preventDefault();

				$(this).parent().siblings().removeClass('active');
				$(this).parent().addClass('active');

				var layout = $(this).data('value');
				if (layout == 'boxed') {
					if ($('body').hasClass('layout-float')) {
						$('body').removeClass('layout-float');
					}

					$('body').addClass('layout-boxed');
				} else if (layout == 'float') {
					if ($('body').hasClass('layout-boxed')) {
						$('body').removeClass('layout-boxed');
					}
					$('body').addClass('layout-float');
				} else if (layout == 'wide') {
					if ($('body').hasClass('layout-float')) {
						$('body').removeClass('layout-float');
					}

					if ($('body').hasClass('layout-boxed')) {
						$('body').removeClass('layout-boxed');
					}

					if ($('.background-section', floral_panelSelector.ps_context).is(':visible')) {
						$('.background-section', floral_panelSelector.ps_context).slideUp();
					}
				}

				if ((layout != 'wide') && ($('.background-section', floral_panelSelector.ps_context).is(':hidden'))) {
					$('.background-section', floral_panelSelector.ps_context).slideDown();
				}
				// $('#wrapper-content').trigger(jQuery.Event('resize'));
			});
		},
		background: function () {
			if (!$('body').hasClass('layout-boxed') && !$('body').hasClass('layout-float') && ($('.background-section', floral_panelSelector.ps_context).is(':visible'))) {
				$('.background-section', floral_panelSelector.ps_context).slideUp();
			}

			$('.panel-primary-background li', floral_panelSelector.ps_context).click(function (event) {
				event.preventDefault();
				var name = $(this).data('name');

				$('body').css({
					'background-image'     : 'url(' + floral_main_vars.floral_theme_url + 'assets/images/pattern/' + name + ')',
					'background-repeat'    : 'repeat',
					'background-position'  : 'center center',
					'background-attachment': 'scroll',
					'background-size'      : 'auto'
				});

				$(this).siblings().removeClass('active');
				$(this).addClass('active');

			})
		},
		rtl       : function () {
			$('#panel-selector-rtl', floral_panelSelector.ps_context).click(function (event) {
				event.preventDefault();

				var mode = $(this).data('mode');
				if (mode == 'on') {
					$(this).data('mode', 'off');
					$(this).text('RTL On')
				} else {
					$(this).data('mode', 'on');
					$(this).text('RTL Off')
				}
			})
		},
		reset     : function () {
			$('#panel-selector-reset', floral_panelSelector.ps_context).click(function (event) {
				event.preventDefault();
				document.location.reload(true);
			})
		},
		demos     : function () {
			$('.demos .__item', floral_panelSelector.ps_context).on('mouseover', function () {
				var $marker = $(this),
					markerPosition = $marker.position();

				$('.__large', $marker).css({
					top : markerPosition.top - $('.__large', $marker).outerHeight() + 35,
					left: markerPosition.left - $('.__large', $marker).outerWidth() + 35
				});
			});
		}

	};
	// on ready
	$(document).ready(function () {
		floral_panelSelector.onReady();
	});
})(jQuery);