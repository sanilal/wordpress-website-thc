/**
 * Created by Thang X. Vu on 4/27/2016.
 */
   
 var floral = {};

(function ($, window) {
	'use strict';

	var $body = $('body'),
		$html = $('html'),
		$window = $(window),
		isRTL = $body.hasClass('rtl');

	floral.core = {
		on_ready: function () {
			floral.core.magnific_gallery_image_popup();
			floral.core.magnific_inline_popup();
			floral.core.magnific_single_image_popup();
			floral.core.do_prettyphoto();
			floral.core.do_prettyPhoto_popup();
			floral.core.do_init_sticky();
			floral.core.do_owl_carousel();
			// floral.core.do_slick_carousel();
			floral.core.do_parallax_handling();
			floral.core.do_columns_equal_height();
			floral.core.do_init_fittext();
			floral.core.do_init_tooltip();
			floral.core.do_init_dismissible_element();
			floral.core.do_init_nicescroll();
			floral.core.do_init_hoverdir();
		},


		magnific_inline_popup: function () {
			$('.floral-inline-popup').each(function () {
				var inline_html = $(this).data('inline-html') || 'No data to display';
				$(this).magnificPopup({
					items       : {
						src : inline_html, // can be a HTML string, jQuery object, or CSS selector
						type: 'inline'
					},
					showCloseBtn: true
				});
			});
		},

		magnific_single_image_popup: function ($selector) {
			if (typeof ($selector) == 'undefined') {
				$selector = $('a.single-item-popup:not(.ready)');
			}
			$selector.magnificPopup({
				type        : 'image',
				removalDelay: 300,
				mainClass   : 'mfp-fade',
				image       : {
					titleSrc: function (item) {
						return item.el.parents('.entry-thumbnail').find('img').attr('title');
					}
				}
			}).addClass('ready');
		},

		magnific_gallery_image_popup: function () {

			$('div.gallery-popup').each(function () {
				$(this).magnificPopup({
					delegate    : ':not(.cloned) a.gallery-item-popup', // the selector for gallery item
					type        : 'image',
					gallery     : {
						enabled: true
					},
					removalDelay: 300,
					mainClass   : 'mfp-fade gallery-popup',
					image       : {
						titleSrc: function (item) {
							return item.el.parents('.entry-thumbnail').find('img').attr('title');
						}
					},
					callbacks   : {
						open: function () {
							var $gallery_modal = $.magnificPopup.instance;
							this.container.on('mousewheel', function (e) {
								if (e.deltaY > 0) {
									$(this).find('.mfp-arrow-right').trigger('click');
								} else {
									$(this).find('.mfp-arrow-left').trigger('click');
								}
								e.preventDefault();
							});
						},
					}
				});


			});
		},

		do_prettyphoto: function () {
			$(document).ready(function () {
				$("a[data-rel^='floral-prettyPhoto']:not(.pretty-ready), .owl-item:not(.cloned) a[data-rel^='floral-owl-prettyPhoto']:not(.pretty-ready), .floral-gallery a[data-rel^='floral-owl-prettyPhoto']:not(.pretty-ready), a.floral-pretty-photo-link:not(.pretty-ready)").prettyPhoto({
					padding     : 15,
					social_tools: false,
					allow_resize: true,
					modal       : false,
					showTitle   : true,
					hook        : 'data-rel'
				}).addClass('pretty-ready');
			});
		},

		do_prettyPhoto_popup: function () {
			try {
				var api_images = [];
				$.fn.prettyPhoto && $('a.prettyPhoto').each(function () {
					var options = {
						animationSpeed         : "normal",
						padding                : 15,
						opacity                : .7,
						showTitle              : !0,
						allowresize            : !0,
						counter_separator_label: "/",
						hideflash              : !1,
						deeplinking            : !1,
						modal                  : !1,
						hook                   : 'data-rel',
						callback               : function () {
							var url = location.href, hashtag = url.indexOf("#!prettyPhoto") ? !0 : !1;
							hashtag && (location.hash = "")
						},
						social_tools           : ""
					};

					var data_width = $(this).attr('data-width'), data_height = $(this).attr('data-height');
					if (data_width) options.default_width = data_width;
					if (data_height) options.default_height = data_height;

					api_images.push($(this).attr('href'));
					// console.log(api_images);
					var pPhoto = $(this).prettyPhoto(options);
					// pPhoto.open(api_images);
				});
			} catch (err) {
				window.console && window.console.log && console.log(err)
			}
		},

		do_owl_carousel: function ($target) {
			if (typeof $target == 'undefined') {
				$target = $('div.owl-carousel:not(.manual)');
			}
			$target.each(function () {
				var $this = $(this);
				var defaults = {
					items    : 4,
					nav      : false,
					navText  : ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
					dots     : false,
					loop     : true,
					center   : false,
					mouseDrag: true,
					touchDrag: true,
					pullDrag : true,
					freeDrag : false,

					margin      : 0,
					stagePadding: 0,

					merge    : false,
					mergeFit : true,
					autoWidth: false,
					rtl      : isRTL,

					startPosition: 0,

					smartSpeed  : 250,
					fluidSpeed  : false,
					dragEndSpeed: false,

					autoplayHoverPause: true
				};

				var config = $.extend({}, defaults, $.parseJSON($this.attr("data-options")));
				// Initialize Slider
				$this.on({
					'initialized.owl.carousel': function () {
						$this.children().show();
						// $this.find('.item-placeholder').hide();
					}

				}).owlCarousel(config);

				if ($this.hasClass('mouse-wheel-enabled')) {
					$this.on('mousewheel', '.owl-stage', function (e) {
						if (e.deltaY > 0) {
							$this.trigger('next.owl');
						} else {
							$this.trigger('prev.owl');
						}

						e.preventDefault();
					});
				}

				if ($this.hasClass('owl-control-floral')) {
					var $_dots = $this.find('.owl-dots'), $_nav = $this.find('.owl-nav');
					if ($_nav.length > 0 && $_dots.length > 0 && !$_nav.hasClass('disabled')) {
						$_nav.find('.owl-prev').after($_dots);
					}
				}
			});
		},

		do_slick_carousel: function ($target) {
			if (typeof $target == 'undefined') {
				$target = $('div.slick-carousel:not(.manual)');
			}

			$target.each(function () {
				var $this = $(this);
				var defaults = {
					slidesPerRow: 4,
					arrows      : false,
					dots        : false,
					infinite    : false
					// rtl         : isRTL
				};

				$this.addClass('slick-ready');
				var config = $.extend({}, defaults, $.parseJSON($this.attr("data-options")));
				// Initialize Slider
				$this.on("init", function (event, slick) {
					$this.children().show();
				}).slick(config);

				// if ($this.hasClass('mouse-wheel-enabled')) {
				// 	$this.on('mousewheel', '.slick-track', function (e) {
				// 		if (e.deltaY > 0) {
				// 			$this.slick('slickNext');
				// 		} else {
				// 			$this.slick('slickPrev');
				// 		}
				//
				// 		var current_slide = $this.slick('slickCurrentSlide');
				// 		$this.slick('setSlideClasses', current_slide);
				// 		$this.slick('asNavFor', current_slide);
				//
				// 		e.preventDefault();
				// 	});
				// }
			});
		},

		do_parallax_handling: function () {
			if (!floral.core.is_mobile_device()) {
				$.stellar({
					horizontalScrolling: false,
					scrollProperty     : 'scroll',
					positionProperty   : 'position',
					responsive         : true,
					parallaxBackgrounds: true
				});
			}

			// disable vc parallax on mobile
			if (floral.core.is_mobile_device()) {
				$('[data-vc-parallax]').each(function () {
					$(this).attr('data-vc-parallax', '1');
				});
			}
		},

		do_columns_equal_height: function () {
			$.fn.equalHeight = function () {
				var heights = [];
				$.each(this, function (i, element) {
					var $element = $(element);
					var element_height;
					// Should we include the elements padding in it's height?
					var includePadding = ($element.css('box-sizing') == 'border-box') || ($element.css('-moz-box-sizing') == 'border-box');
					if (includePadding) {
						element_height = $element.innerHeight();

					} else {
						element_height = $element.height();
					}
					heights.push(element_height);
				});
				this.height(Math.max.apply(window, heights));
				return this;
			};

			/**
			 * Create a grid of equal height elements.
			 */
			$.fn.equalHeightGrid = function (columns) {
				var $tiles = this;
				$tiles.css('height', 'auto');
				for (var i = 0; i < $tiles.length; i++) {
					if (i % columns === 0) {
						var row = $($tiles[i]);
						for (var n = 1; n < columns; n++) {
							row = row.add($tiles[i + n]);
						}
						row.equalHeight();
					}
				}
				return this;
			};

			/**
			 * Detect how many columns there are in a given layout.
			 */
			$.fn.detectGridColumns = function () {
				var offset = 0, cols = 0;
				this.each(function (i, elem) {
					var elem_offset = $(elem).offset().top;
					if (offset === 0 || elem_offset == offset) {
						cols++;
						offset = elem_offset;
					} else {
						return false;
					}
				});
				return cols;
			};

			/**
			 * Ensure equal heights now, on ready, load and resize.
			 */
			$.fn.responsiveEqualHeightGrid = function () {
				var _this = this;

				function syncHeights() {
					var cols = _this.detectGridColumns();
					_this.equalHeightGrid(cols);
				}

				$(window).on('resize load', syncHeights);
				syncHeights();
				return this;
			};


			if ($('.columns-equal-height').length) {
				$('.columns-equal-height').each(function () {
					$('> div', this).responsiveEqualHeightGrid();
				});
			}

			if ($('.owl-item-equal-height .owl-stage-outer').length && $('.owl-item').length) {
				$('.owl-item-equal-height .owl-stage-outer').each(function () {
					$('.owl-item', this).responsiveEqualHeightGrid();
				})
			}

		},

		do_init_fittext: function () {
			/*global jQuery */
			/*!
			 * FitText.js 1.2
			 *
			 * Copyright 2011, Dave Rupert http://daverupert.com
			 * Released under the WTFPL license
			 * http://sam.zoy.org/wtfpl/
			 *
			 * Date: Thu May 05 14:23:00 2011 -0600
			 */
			$.fn.fitText = function (kompressor, options) {

				// Setup options
				var compressor = kompressor || 1,
					settings = $.extend({
						'minFontSize': Number.NEGATIVE_INFINITY,
						'maxFontSize': Number.POSITIVE_INFINITY
					}, options);

				return this.each(function () {

					// Store the object
					var $this = $(this);

					// Resizer() resizes items based on the object width divided by the compressor * 10
					var resizer = function () {
						$this.css('font-size', Math.max(Math.min($this.width() / (compressor * 10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
					};

					// Call once to set.
					resizer();

					// Call on resize. Opera debounces their resize by default.
					$(window).on('resize.fittext orientationchange.fittext', resizer);

				});

			};

			$('.responsive-font-size').each(function () {
				var $this = $(this),
					default_options = {
						'minFontSize': 20,
						'maxFontSize': 50
					},
					data_resize = $.parseJSON($this.attr('data-resize'));

				var config = default_options;
				if (data_resize && data_resize.font_size) {
					config = $.extend({}, default_options, data_resize.font_size);
				} else {
					return;
				}

				var kompress = (data_resize && data_resize.compressor) ? data_resize.compressor : 1;

				$this.fitText(kompress, config);
			});
		},

		do_init_sticky: function () {
			$(".floral-sticky-enabled").each(function () {
				var options = eval('({' + $(this).data('sticky-setting') + '})');
				$(this).sticky(options);
			});
		},


		get_cookie: function (cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		},

		set_cookie: function (cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
		},

		is_mobile_device: function () {
			return (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
		},

		validate_email             : function (email) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		},
		get_parameter_by_name      : function (name, url) {
			if (!url) url = window.location.href;
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		},
		scroll_to                  : function (position, scroll_time) {
			if (!position) {
				position = 0;
			}

			position = parseFloat(position.toString().trim().replace('px', '')) + 'px';

			if (!scroll_time) scroll_time = 700;

			$('html,body').animate({
					scrollTop: position
				},
				scroll_time,
				'easeInOutQuart'
			);
		},
		do_init_dismissible_element: function () {
			$('.dismissible-element').each(function () {
				var $this = $(this);
				$this.append('<span class="dismiss-button"><i class="w9 w9-ico-close"></i></span>');

				$('.dismiss-button', $this).on('click', function () {
					$this.fadeOut(200);
				});
			});
		},
		do_init_tooltip            : function () {
			$('[data-toggle="tooltip"]').tooltip({
				trigger: 'hover'
			});
		},

		do_init_nicescroll: function () {
			// scroll bar theme
			$('.floral-nicescroll').each(function () {
				var theme = $(this).attr('data-scrollbar-theme') || 'minimal';
				$(this).mCustomScrollbar({
					theme     : theme,
					axis      : 'y',
					mouseWheel: {
						scrollAmount: 200
					}
				});
			})
		},

		do_init_hoverdir: function () {
			$('.floral-overlay-container.__hoverdir:not(.hoverdir-ready)').each(function (index) {
				$(this).hoverdir({
					hoverElement: '.floral-overlay'
				});
				$(this).addClass('hoverdir-ready');
			});
		}
	};

	floral.page = {

		on_ready: function () {
			this.page_transition();
			this.back_top_top();
			this.ajax_search();
			this.active_page_link();
			this.vertical_menu();
			this.easing_link();
		},

		on_load: function () {
			this.page_transition_fade_in();
		},

		active_page_link: function () {
			var url = window.location.href;
			// var filename = url.substring(url.lastIndexOf('/') + 1);
			// console.log(url);
			$(".floral-main-menu-content li a").each(function () {
				if ($(this).attr('href') === url) {
					// console.log("!!!!!!!!!!!!!!!!!!!!");
					$(this).parents(".floral-main-menu-content li").addClass('menu-item_active-link');
				}
			});
		},

		vertical_menu: function () {
			$('.floral-widget-vertical-multi-level .menu-item-has-children').each(function (index) {
				var $this = $(this);
				var $sub_menu = $this.children('.sub-menu');
				var $toggle_button = $this.children('.floral-link-container').children('a');

				$toggle_button.on('click', function (event) {
					event.preventDefault();
					var $sibling = $this.siblings();
					$sibling.find('.sub-menu').slideUp();
					$sibling.removeClass('sub-menu-opening').find('.sub-menu-opening').removeClass('sub-menu-opening');

					if ($this.hasClass('sub-menu-opening')) {
						$this.find('.sub-menu').slideUp();
						$this.find('.sub-menu-opening').removeClass('sub-menu-opening');
						$this.removeClass('sub-menu-opening');
					} else {
						$sub_menu.slideDown();
						$this.addClass('sub-menu-opening');
					}
				})

			})
		},

		popup: function (popup_type, popup_content) {
			var popup_id = '#' + popup_type + '-' + popup_content;
			var scrollbar_width = window.outerWidth - $body.outerWidth();

			$.magnificPopup.open({
				items         : {
					src : popup_id, // can be a HTML string, jQuery object, or CSS selector
					type: 'inline'
				},
				closeBtnInside: false,
				autoFocusLast : false,
				closeMarkup   : '<button title="%title%" type="button" class="mfp-close"><i class="w9 w9-ico-close"></i></button>',
				removalDelay  : 300,
				mainClass     : 'floral-popup-wrapper animation-fade popup-area-type-' + popup_type,
				callbacks     : {
					open : function () {
						var $sticky_nav = $('.floral-nav-body.sticky-content');
						var padding_right = parseInt($sticky_nav.css('padding-right')) + scrollbar_width;
						$sticky_nav.css({'padding-right': +padding_right + 'px', 'transition': 'all 0s'});
						$('.page-rightzone-open .page-rightzone, #floral-back-to-top').css({
							'margin-right': +scrollbar_width + 'px',
							'transition'  : 'all 0s'
						});

					},
					close: function () {
						var $sticky_nav = $('.floral-nav-body.sticky-content');
						$sticky_nav.css({'padding-right': ''});
						$('.page-rightzone-open .page-rightzone, #floral-back-to-top').css({'margin-right': ''});
						setTimeout(function () {
							$sticky_nav.css({'transition': ''});
							$('.page-rightzone-open .page-rightzone, #floral-back-to-top').css({'transition': ''});
						}, 300)
					}
				}
			});
		},

		ajax_search: function () {
			$(document).on('submit', '#floral-search-popup.search-type-ajax form', function (event) {
				var $form = $(this);
				var $input = $form.find('input.search-field');
				var query = $input.val();
				var $content = $('.floral-ajax-search-content');
				var $result_area = $content.find('.__result');
				var $loading_screen = $content.find('.__loading');

				$.ajax({
					type      : 'post',
					url       : floral_main_vars.ajax_url,
					data      : {
						action: 'floral_load_search_results',
						query : query
					},
					beforeSend: function () {
						$input.prop('disabled', true);
						$loading_screen.fadeIn();
						$result_area.fadeOut();
					},
					success   : function (response) {
						$input.prop('disabled', false);
						$result_area.html(response);
						$loading_screen.fadeOut();
						$result_area.fadeIn();
					}
				});

				event.preventDefault();
			})
		},

		page_leftzone: function (action) {
			if (typeof action == 'undefined') {
				$body.toggleClass('page-leftzone-open');
			} else if (action == 'close') {
				$body.removeClass('page-leftzone-open');
			} else if (action == 'open') {
				$body.addClass('page-leftzone-open');
			}
		},

		page_rightzone: function (action) {
			if (typeof action == 'undefined') {
				$body.toggleClass('page-rightzone-open');
			} else if (action == 'close') {
				$body.removeClass('page-rightzone-open');
			} else if (action == 'open') {
				$body.addClass('page-rightzone-open');
			}
		},

		page_transition: function () {
			if ($body.hasClass('loading-transition-enable')) {
				var link_element = 'a.animsition-link, a:not([target="_blank"]):not([href^="#"]):not([href*="javascript"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".gif"]):not([href*=".png"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".mp4"]):not([href*=".flv"]):not([href*=".avi"]):not([href*=".mp3"]):not([href^="mailto:"]):not([class*="no-animation"]):not([class*="single-item-popup"]):not([class*="gallery-popup"]):not([class*="add_to_wishlist"]):not([class*="add_to_cart_button"]):not([class*="prettyPhoto"]):not([rel*="prettyPhoto"]):not([class*="prettyphoto"]):not([class*="__cart-toggle"]):not([class*="comment-reply-link"]):not([id*="cancel-comment-reply-link"])';
				$(link_element).on('click', function (event) {
					event.preventDefault();
					var $self = $(this);
					var url = $self.attr('href');

					// middle mouse button issue #24
					// if(middle mouse button || command key || shift key || win control key)
					if (event.which === 2 || event.metaKey || event.shiftKey || navigator.platform.toUpperCase().indexOf('WIN') !== -1 && event.ctrlKey) {
						window.open(url, '_blank');
					} else {
						floral.page.page_transition_fade_out();
						window.location.href = url;
					}
				});
			}
		},

		page_transition_fade_in: function () {
			if ($body.hasClass('loading-transition-enable')) {
				$('.floral-page-transitions-wrapper').fadeOut(800);
			}
		},

		page_transition_fade_out: function () {
			if ($body.hasClass('loading-transition-enable')) {
				$('.floral-page-transitions-wrapper').fadeIn(500);
			}
		},

		back_top_top: function () {
			var offset = 700, scroll_top_duration = 700, $back_top_btn = $('#floral-back-to-top');
			if ($back_top_btn.length > 0) {
				$(window).on('scroll', function () {
					if ($(window).scrollTop() > offset) {
						$back_top_btn.addClass('active');
					} else {
						$back_top_btn.removeClass('active');
					}
				});
				$back_top_btn.on('click', function (e) {
					e.preventDefault();
					floral.core.scroll_to(0, scroll_top_duration);
				});
			}
		},

		calculate_nav_space: function () {
			var $adminbar = $('#wpadminbar');
			var $main_nav = $('#floral-main-nav');
			var $mobile_nav = $('#floral-mobile-nav');
			var space = 0;
			if ($adminbar.length > 0) {
				space += $adminbar.outerHeight();
			}
			if ($main_nav.length > 0) {
				space += $main_nav.outerHeight();
			}
			if ($mobile_nav.length > 0) {
				space += $mobile_nav.outerHeight();
			}

			return space;
		},

		easing_link: function () {
			$('.menu-item a[href^="#"],.vc_icon_element a[href^="#"],.floral-button-wrapper a[href^="#"],.floral-main-nav a[href^="#"] ,.floral-vertical-menu-inner a[href^="#"] ,a.floral-easing-link[href^="#"] ').not('[href="#"]').on('click', function (event) {
				event.preventDefault();
				var $target_object = $($(this).attr('href'));
				if ($target_object.length > 0) {
					var $window = $(window);
					var element_position = $target_object.offset().top;
					var window_position = $window.scrollTop();
					var scroll_time = 400 + Math.abs(element_position - window_position) / 3;
					// if ($window.width)
					// 	var nav_space = floral.page.calculate_nav_space();

					$('html,body').animate({
							// scrollTop: element_position - nav_space
							scrollTop: element_position
						},
						scroll_time,
						'easeInOutQuart'
					);
				}
			});
		},

		scroll_spy: function () {
			var $main_onepage_links = $('#floral-main-menu a[href^="#"]').not('[href="#"]');
			if ($main_onepage_links.length > 0) {
				var offset = floral.page.calculate_nav_space();
				$('body').scrollspy({
					target: '#floral-main-menu',
					offset: offset
				});
			}
		},

		page_disable_scrolling: function () {
			if (!$html.hasClass('slipscreen-active')) {
				$('html,body').css('overflow-y', 'hidden');
			}
		},

		page_enable_scrolling: function () {
			if (!$html.hasClass('slipscreen-active')) {
				$html.css('overflow-y', 'auto');
			}
		}

	};

	floral.slip_screen = {
		on_ready: function () {

			var $slip_container = $('article.type-page > .entry-content'),
				$slip_section = $slip_container.children('section.vc_row');

			// $slip_container.parent('article.type-page').css('height', $window.height() + 'px');
			$slip_container.attr('id', 'slipscreen-container');
			$slip_section.addClass('slipscreen-section');

			var data_anchors = [],
				data_tool_tips = [];

			$slip_section.each(function (index) {
				var $this = $(this);
				if (!$this[0].hasAttribute('data-anchor')) {
					$this.attr('data-anchor', 'slip_section-' + (index + 1 ));
				}
				data_anchors.push($this.data('anchor'));

				if (!$this[0].hasAttribute('data-navigation-tooltip')) {
					$this.attr('data-navigation-tooltip', '');
				}
				data_tool_tips.push($this.data('navigation-tooltip'));
			});

			var slipOn = false;
			slip_screen_setting();

			$window.on('resize load', function () {
				if (window.innerWidth < 992) {
					slipOn = false;
					$.fn.fullpage.destroy('all');
					if ($html.hasClass('slipscreen-active')) {
						$html.removeClass('slipscreen-active');
					}
				}
				else {
					slip_screen_setting();
					if (!$html.hasClass('slipscreen-active')) {
						$html.addClass('slipscreen-active');
					}
				}

			});

			function slip_screen_setting() {
				if (slipOn === false) {
					slipOn = true;
					$('#slipscreen-container').fullpage({
						sectionSelector   : '.slipscreen-section',
						anchors           : data_anchors,
						navigation        : true,
						navigationTooltips: data_tool_tips,
						scrollingSpeed    : 500,
						scrollOverflow    : true,
						// scrollBar         : true,
						onLeave           : function (index, nextIndex, direction) {
							if (nextIndex !== 1) {
								if (!$body.hasClass('hidden-menu')) {
									$body.addClass('hidden-menu');
								}
							}
							else {
								if ($body.hasClass('hidden-menu')) {
									$body.removeClass('hidden-menu');
								}
							}
						}
					});
				}
			}
		}
	};

	floral.header = {
		on_ready: function () {
			this.sticky();
			this.submenu_auto_set_position();
			this.mini_cart_toggle();
		},

		sticky: function () {
			var $main_nav = $('#floral-main-nav');
			if ($main_nav.length < 1) {
				return;
			}
			var sticky_enable = $main_nav.hasClass('floral-sticky');
			var $header = $main_nav.parent();
			if (sticky_enable) {

				//Create sticky and headroom
				var check_value = Math.abs(parseInt(floral_main_vars.floral_sticky_show_up, 10)),
					sticky_show_up = check_value;
				if (isNaN(check_value)) {
					sticky_show_up = 0;
				}

				var start_sticky = $main_nav.offset().top + $main_nav.outerHeight()  + sticky_show_up;

				$main_nav.find(".sticky-content").headroom({
					offset   : start_sticky,
					tolerance: 1,
					onTop    : function () {

						// close the mini cart of the sticky nav
						$('.floral-nav-body.sticky-content')
							.find('.floral-mini-cart')
							.removeClass('open');

						setTimeout(function () {
							$header.removeClass('is-sticky');
						}, 300);
					},
					onNotTop : function () {

						// close the mini cart of the static nav
						$('.floral-nav-body:not(.sticky-content)')
							.find('.floral-mini-cart')
							.removeClass('open');

						setTimeout(function () {
							$header.addClass('is-sticky');

							// re-init minicart scroll bar for sticky nav after it show up
							floral.woocommerce.do_make_custom_minicart_scrollbar(
								'.floral-nav-body.sticky-content .widget_shopping_cart_content ul.cart_list'
							);
						}, 300);
					}
				});
			}
		},

		submenu_auto_set_position: function () {
			if (floral_main_vars.floral_scroll_set_submenu_position) {
				if ($(".floral-main-menu-content").length > 0) {
					$(window).scroll(function () {
						var scrollTop = $(window).scrollTop(),
							topOffset = $(".floral-main-menu-content").offset().top,
							relativeOffset = topOffset - scrollTop,
							windowHeight = $(window).height();

						if (relativeOffset > windowHeight / 2) {
							if (!($(".floral-main-menu-content").hasClass("submenu-reverse"))) {
								$(".floral-main-menu-content").addClass("submenu-reverse");
							}
						}
						else {
							if (($(".floral-main-menu-content").hasClass("submenu-reverse"))) {
								$(".floral-main-menu-content").removeClass("submenu-reverse");
							}
						}
					})
				}
			}
		},

		mini_cart_toggle: function () {
			function init_cart_icon_action() {
				$('.floral-mini-cart').each(function () {
					var $wrapper = $(this),
						$__mini_cart_icon = $wrapper.find('.__cart-toggle'),
						$__cart_wrapper = $wrapper.find('.__cart-wrapper'),
						__allow_minicart = $__cart_wrapper.attr('data-allow-minicart');

					if (!__allow_minicart) __allow_minicart = false;

					$__mini_cart_icon.on('click', function (e) {
						e.preventDefault();

						if (__allow_minicart == '1') {
							$wrapper.toggleClass('open');
						} else {
							var $table_cart = $('table.shop_table.cart');
							if ($table_cart.length > 0) {
								floral.core.scroll_to($($table_cart[0]).offset().top - $('header.main-header').outerHeight() * 2);
							} else {
								// var _href = $__mini_cart_icon.attr('href');
								window.location.href = $__mini_cart_icon.attr('href');
							}
						}
					});

					$__cart_wrapper.on('click', 'a:not(.remove):not(.empty-cart):not(.undo)', function () {
						$wrapper.removeClass('open');
					});
				});
			}

			function update_total_cart_items() {
				var $cart_list = $('.widget_shopping_cart_content ul.cart_list');
				if ($cart_list.length > 0) {
					var $_first_cart_list = $($cart_list[0]);
					var _total = 0;
					$_first_cart_list.find('li .quantity').each(function () {
						var data_quantity = parseInt($(this).attr('data-quantity'));
						if (!data_quantity) {
							data_quantity = 0;
						}
						_total += data_quantity;
					});

					if (_total > 0) {
						$('.floral-mini-cart').find('.__cart-toggle .__number-product').text(_total).css('opacity', 1);
					} else {
						$('.floral-mini-cart').find('.__cart-toggle .__number-product').css('opacity', 0);
					}
				}
			}

			$(document.body).on('click', function (e) {
				if ($(e.target).closest('.floral-mini-cart').length === 0) {
					$('.floral-mini-cart').removeClass('open');
				}
			});

			$(document.body).on('added_to_cart wc_fragments_loaded wc_fragments_refreshed', function () {
				update_total_cart_items();
			});

			// check not in mobile devices
			if ($(window).outerWidth() >= 480 && !floral.core.is_mobile_device()) {
				init_cart_icon_action();
			}

			update_total_cart_items();
		}
	};

	floral.blog = {
		on_ready: function () {
			floral.blog.do_blog_grid();
			floral.blog.do_blog_masonry();
			floral.blog.blog_load_more();
			floral.blog.blog_infinite_scroll();
		},

		do_blog_grid: function () {
			var blog_grid = $('.blog-type-grid');
			blog_grid.imagesLoaded(function () {
				blog_grid.isotope({
					itemSelector   : '.loop-item',
					layoutMode     : "fitRows",
					percentPosition: true,
					isOriginLeft   : !isRTL
				});
				blog_grid.isotope('layout');
				floral.blog.init_filter(blog_grid);
				floral.blog.refresh_fitler(blog_grid);
			});

			$window.on('load resize', function () {
				setTimeout(function () {
					blog_grid.isotope('layout');
				}, 300);
			});
		},

		do_blog_masonry: function () {
			var blog_masonry = $('.blog-type-masonry');
			floral.blog.refresh_fitler(blog_masonry);
			blog_masonry.imagesLoaded(function () {
				blog_masonry.isotope({
					itemSelector   : '.loop-item',
					layoutMode     : "masonry",
					percentPosition: true,
					isOriginLeft   : !isRTL
				});
				blog_masonry.isotope('layout');
				floral.blog.init_filter(blog_masonry);
			});

			$window.on('load resize', function () {
				setTimeout(function () {
					blog_masonry.isotope('layout');
				}, 300);
			});
		},

		init_filter: function (wrapper) {
			var filter = wrapper.data('filter-id');
			if (filter) {
				$(filter).find('.filter-link').on('click', function (event) {
					wrapper.isotope({filter: $(this).data('filter')});
					$(filter).find('li').removeClass('active');
					$(this).parent().addClass('active');
					event.preventDefault();
				})
			}
		},

		refresh_fitler: function (wrapper) {
			var filter = wrapper.data('filter-id');
			if (filter) {
				$(filter).find('.filter-link').each(function () {
					if (wrapper.find($(this).data('filter')).length > 0) {
						$(this).parent().removeClass('hide');
					} else {
						$(this).parent().addClass('hide');
					}
				})
			}
		},

		blog_load_more: function () {
			$('.blog-load-more').on('click', function (e) {
				var $this = $(this).button('loading'),
					data_next_page = $this.attr('data-next-page'),
					$blog_loop = $('.posts-loop');

				e.preventDefault();

				$.get(data_next_page, function (data) {
					var $next_post = $('.loop-item', data),
						$next_page = $('.blog-load-more', data);

					if ($next_post.length > 0) {
						$next_post.css('opacity', 0);


						$next_post.imagesLoaded(function () {
							$blog_loop.append($next_post);
							floral.core.magnific_single_image_popup();
							floral.core.magnific_gallery_image_popup();
							floral.core.do_owl_carousel();
							floral.core.do_init_hoverdir();
							// floral.shortcodes.do_popup_the_subscribe_form($next_post.find('.floral-btn-subscribe-popup'));
							floral.woocommerce.do_init_product_quick_view_feature($next_post.find('a.quick-view-btn'));

							if ($blog_loop.hasClass('blog-type-masonry') || $blog_loop.hasClass('blog-type-grid')) {
								$blog_loop.isotope('appended', $next_post).isotope('layout');
								floral.blog.refresh_fitler($blog_loop);
							}


							$next_post.animate({
								opacity: 1
							}, 500);
						});
					}
					// set next page link
					if ($next_page.length > 0) {
						$this.attr('data-next-page', $next_page.attr('data-next-page'));
					} else {
						$this.attr('data-next-page', 0);
						$this.parents('.navigation-type-load-more').fadeOut();
					}
					$this.button('reset');
				});
			});
		},

		blog_infinite_scroll: function () {
			var $infinite_scroll = $('.floral-infinite-scroll'),
				$blog_loop = $('.posts-loop');

			$infinite_scroll.each(function () {
				$(window).on('scroll', function () {
					var window_bottom = $(window).scrollTop() + $(window).height(),
						infinite_top = $infinite_scroll.offset().top;

					if (infinite_top - window_bottom < 700) {
						if (!$infinite_scroll.hasClass('loading')) {
							load_data($infinite_scroll, $blog_loop);
						}
					}
				});

				function load_data($infinite_scroll, $blog_loop) {
					var $next_page_link = $infinite_scroll.find('.infinite-scroll-link'),
						data_next_page = $next_page_link.attr('data-next-page'),
						$_loading = $infinite_scroll.find('.loading-three-bounce');
					// no more post to show
					if (data_next_page == 0) {
						return;
					}
					// start loading
					$infinite_scroll.addClass('loading');
					$_loading.animate({
						opacity: 1
					}, 500);

					// get the data form server
					$.get($next_page_link.attr('data-next-page'), {action: 'infinite-scroll'}, function (data) {
						var $next_post = $('.loop-item', data),
							$next_page = $('.infinite-scroll-link', data);
						// append them to blog loop
						if ($next_post.length > 0) {
							$next_post.css('opacity', 0);
							$next_post.imagesLoaded(function () {
								$blog_loop.append($next_post);
								floral.core.magnific_single_image_popup();
								floral.core.magnific_gallery_image_popup();
								floral.core.do_owl_carousel();
								floral.core.do_init_hoverdir();
								// floral.shortcodes.do_popup_the_subscribe_form($next_post.find('.floral-btn-subscribe-popup'));
								floral.woocommerce.do_init_product_quick_view_feature($next_post.find('a.quick-view-btn'));

								if ($blog_loop.hasClass('blog-type-masonry') || $blog_loop.hasClass('blog-type-grid')) {
									$blog_loop.isotope('appended', $next_post).isotope('layout');
									floral.blog.refresh_fitler($blog_loop);
								}

								$next_post.animate({
									opacity: 1
								}, 500);
							});
						}

						// set next page link
						if ($next_page.length > 0) {
							$next_page_link.attr('data-next-page', $next_page.attr('data-next-page'));
							// turn off loading
							$infinite_scroll.removeClass('loading');
							$_loading.animate({
								opacity: 0
							}, 500);
						} else {
							$next_page_link.attr('data-next-page', 0);
							$infinite_scroll.parents('.navigation-type-infinite-scroll').fadeOut();

						}
					});
				}
			});
		}
	};

	floral.shortcodes = {
		on_ready: function () {
			floral.shortcodes.demo_listing();
			floral.shortcodes.do_counter();
			floral.shortcodes.do_expand_section();
			floral.shortcodes.do_init_button_icon_effects();
			floral.shortcodes.ctf7_submit_action();
		},

		demo_listing: function () {
			var $theme_demo_content = $('.floral-theme-demo-wrapper');
			if ($theme_demo_content.length > 0) {
				$theme_demo_content.each(function () {
					var $this = $(this);
					var $demo_content = $this.find('.floral-theme-demo-content');
					var $filter_item = $this.find('.floral-demo-filter .__filter-item');

					$demo_content.imagesLoaded(function () {
						$demo_content.isotope({
							itemSelector: '.floral-theme-demo-column',
							layoutMode  : 'fitRows',
						});

						$filter_item.on('click', function (event) {
							event.preventDefault();
							$filter_item.removeClass('active');
							$(this).addClass('active');
							var filter_string = $(this).data('filter');
							if (filter_string != '*') {
								filter_string = '.' + filter_string;
							}
							$demo_content.isotope({
								filter: filter_string
							});
							$demo_content.isotope('layout');
						})
					});

				});
			}
		},

		do_counter: function () {
			$('.floral-counter-wrapper').each(function (index) {
				var delay = 0;
				var count_time = $(this).data('count-time') || 1.5;
				var $counters = $(this).find('.floral-counter-item .showed-man .__counter');
				var $counter_inners = $(this).find('.counter-item-inner');

				$counters.each(function () {
					var $this = $(this);
					var element = $this[0];
					var count_from = $this.data('count-from');
					var count_to = $this.data('count-to');
					var $count_prefix = $this.data('prefix');
					var $count_suffix = $this.data('suffix');
					var options = {
						prefix   : $count_prefix,
						suffix   : $count_suffix,
						separator: '',
						decimal  : '.'
					};
					var counter = new CountUp(element, count_from, count_to, delay, count_time, options);

					var counterWaypoint = $this.waypoint({
						handler: function () {
							$this.animate({
								opacity: 1
							}, 500);
							counter.start();
						},
						offset : 'bottom-in-view'
					});
				});
			})
		},

		do_expand_section: function () {
			$('.floral-expandable-section').each(function () {
				var $wrapper = $(this), $toggle_content = $wrapper.find('.toggle-content');
				var $expand_button = $wrapper.find('.expand-toggle-button'),
					data_expand_class = $expand_button.attr('data-class-expand'),
					data_collapse_class = $expand_button.attr('data-class-collapse'),
					data_toggle_animation = $expand_button.attr('data-toggle-animation');

				if (!data_toggle_animation || ['slide', 'fade'].indexOf(data_toggle_animation) === -1) {
					data_toggle_animation = 'slide';
				}


				var $button_content = $wrapper.find('.button-content'),
					data_expand_label = $button_content.attr('data-expand-label'),
					data_expand_icon = $button_content.attr('data-expand-icon'),
					data_collapse_label = $button_content.attr('data-collapse-label'),
					data_collapse_icon = $button_content.attr('data-collapse-icon');

				// functions
				function get_current_state() {
					if ($wrapper.hasClass('es-state-expand')) {
						return 'expand';
					} else if ($wrapper.hasClass('es-state-collapse')) {
						return 'collapse';
					} else {
						return null;
					}
				}

				function toggle_content(_type) {
					switch (_type) {
						case 'in':
							if (data_toggle_animation === 'slide') {
								$toggle_content.slideDown();
							} else {
								$toggle_content.fadeIn();
							}
							break;
						case 'out':
						default:
							if (data_toggle_animation === 'slide') {
								$toggle_content.slideUp();
							} else {
								$toggle_content.fadeOut();
							}
							break;
					}
				}

				function do_toggle_state() {
					if (get_current_state() === 'expand') {
						$wrapper.removeClass('es-state-expand').addClass('es-state-collapse');
						$expand_button.removeClass(data_expand_class).addClass(data_collapse_class);
						$button_content.find('i').removeClass(data_expand_icon).addClass(data_collapse_icon);
						$button_content.find('.state-label').text(data_collapse_label);
						// collapse content
						toggle_content('out');

					} else {
						$wrapper.removeClass('es-state-collapse').addClass('es-state-expand');
						$expand_button.removeClass(data_collapse_class).addClass(data_expand_class);
						$button_content.find('i').removeClass(data_collapse_icon).addClass(data_expand_icon);
						$button_content.find('.state-label').text(data_expand_label);
						// expand content
						toggle_content('in');
					}
				}


				// check state
				if (get_current_state() === null) {
					return;
				}

				$expand_button.on('click', function () {
					do_toggle_state();
				});


			});
		},

		ctf7_submit_action: function () {
			$('.floral-form').each(function () {
				var $this = $(this),
					$submit = $this.find('.wpcf7-submit');


				if ($submit.hasClass('floral-btn')) {
					$submit.append('<div class="ctf7-loader"><i class="fa fa-cog fa-spin"></i></div>');

					// disable the ajax loader image
					$this.find('img.ajax-loader').css('display', 'none');
				}


				var $_loader = $submit.find('.ctf7-loader');

				$submit.on('click', function (e) {
					e.preventDefault();
					if (!is_in_process()) {
						$this.parents('form.wpcf7-form').trigger('submit');
						do_start_process();
					}
				});


				function is_in_process() {
					var in_process = $this.attr('in-process');
					return !(in_process == 'false' || in_process == false || in_process == '' || typeof in_process == 'undefined');
				}

				function do_start_process() {
					$this.attr('in-process', 'true');
					$_loader.fadeIn(200);

					$this.find('input.wpcf7-not-valid, select.wpcf7-not-valid, textarea.wpcf7-not-valid').each(function () {
						var _in_valid = $(this);
						_in_valid.removeClass('wpcf7-not-valid');
						_in_valid.css('background-color', '');
					});
				}

				function do_stop_process() {
					$this.attr('in-process', 'false');
					$_loader.fadeOut(200);
				}

				function do_bind_event_on_invalid() {
					$this.find('input.wpcf7-not-valid, select.wpcf7-not-valid, textarea.wpcf7-not-valid').each(function () {
						var _in_valid = $(this);
						_in_valid.on('click', function () {
							_in_valid.css('background-color', '#fff');
						});
					});
				}

				$(document).on('wpcf7:mailsent', function () {
					// set cookie, this person already is a subscriber
					do_stop_process();
				});

				$(document).on('wpcf7:mailfailed', function () {
					do_stop_process();
				});

				$(document).on('wpcf7:spam', function () {
					do_stop_process();
				});

				// animation on invalid email
				$(document).on('wpcf7:invalid', function () {
					do_stop_process();
					do_bind_event_on_invalid();
				});
			});
		},

		do_init_button_icon_effects: function ($target) {
			if (typeof $target == 'undefined') {
				$target = $('.floral-btn');
			}

			$target.each(function () {
				var $this = $(this);

				if ($this.hasClass('ready')) {
					return;
				}


				$this.addClass('ready');


				if ($this.hasClass('align-icon-right') || $this.hasClass('align-icon-left')) {
					var current_padding = $this.css('padding-left'); // /%|in|cm|mm|em|rem|ex|pt|pc|px|vw|vh|vmin|vmax/
					current_padding = parseInt(current_padding.replace(/%|in|cm|mm|em|rem|ex|pt|pc|px|vw|vh|vmin|vmax/g, ''));
					if (!current_padding) {
						return;
					}

					var $__icon = $this.find('> i'),
						$__text = $this.find('> span'),
						__icon_width = $__icon.outerWidth(),
						__text_width = $__text.outerWidth();

					var new_padding = 0;
					if ($this.hasClass('icon-effect-inner-out') || $this.hasClass('icon-effect-outer-in')) {
						new_padding = current_padding + __icon_width * 1.5;
					} else if ($this.hasClass('icon-effect-inner-out-text') || $this.hasClass('icon-effect-outer-in-text')) {
						new_padding = current_padding + __icon_width / 2;
					}

					if (new_padding !== 0) {
						$this.css('padding-left', new_padding);
						$this.css('padding-right', new_padding);
					}

					var hovered_padding = (new_padding * 2 - __icon_width - 10) / 2;

					if ($this.hasClass('align-icon-left')) {
						var __icon_left = $__icon.css('left'),
							__text_left = $__text.css('left');
						if (($this.hasClass('icon-effect-inner-out-text') || $this.hasClass('icon-effect-outer-in-text'))) {
							$this.hover(function () {
									$__icon.animate({
										'left': hovered_padding
									}, 50);

									$__text.animate({
										'left': new_padding - hovered_padding
									}, 50);
								}, function () {
									$__icon.animate({
										'left': __icon_left
									}, 50);

									$__text.animate({
										'left': __text_left
									}, 50);
								}
							);
						}

						if ($this.hasClass('icon-effect-inner-out') || $this.hasClass('icon-effect-outer-in')) {
							$this.hover(function () {
									$__icon.animate({
										'left': new_padding / 2 - __icon_width / 2
									}, 50);
								}, function () {
									$__icon.animate({
										'left': __icon_left
									}, 50);
								}
							);
						}
					}

					if ($this.hasClass('align-icon-right')) {
						var __icon_right = $__icon.css('right'),
							__text_right = $__text.css('right');
						if (($this.hasClass('icon-effect-inner-out-text') || $this.hasClass('icon-effect-outer-in-text'))) {
							$this.hover(function () {
									$__icon.animate({
										'right': hovered_padding
									}, 50);

									$__text.animate({
										'right': new_padding - hovered_padding
									}, 50);
								}, function () {
									$__icon.animate({
										'right': __icon_right
									}, 50);

									$__text.animate({
										'right': __text_right
									}, 50);
								}
							);
						}

						if ($this.hasClass('icon-effect-inner-out') || $this.hasClass('icon-effect-outer-in')) {
							$this.hover(function () {
									$__icon.animate({
										'right': new_padding / 2 - __icon_width / 2
									}, 50);
								}, function () {
									$__icon.animate({
										'right': __icon_right
									}, 50);
								}
							);
						}
					}

				}

			});
		},


	};

	floral.woocommerce = {
		__cart_message: '',

		on_ready: function () {
			floral.woocommerce.thumbnail_slider();
			floral.woocommerce.do_add_to_cart_active();
			floral.woocommerce.do_quantity_input_action();
			floral.woocommerce.do_init_product_quick_view_feature();
			floral.woocommerce.do_init_effect_on_checkout_form_expanded();
			floral.woocommerce.do_init_cart_action();

			$(document.body).on('added_to_cart wc_fragments_refreshed wc_fragments_loaded', function () {
				var $cart_list = $('.cart_list_wrapper');
				$cart_list.find('p.cart-message').remove();
				if (floral.woocommerce.__cart_message) {
					$cart_list.prepend('<p class="cart-message">' + floral.woocommerce.__cart_message + '</p>');
				}

				floral.woocommerce.do_init_cart_action();
				floral.woocommerce.do_make_custom_minicart_scrollbar();
			});
		},

		on_load         : function () {
			floral.woocommerce.do_make_custom_minicart_scrollbar();
		},
		thumbnail_slider: function ($target) {
			if (typeof $target == 'undefined') {
				$target = $('.product-item-images-slide-show');
			}
			$target.each(function () {
				var $this = $(this),
					$slider01 = $this.find(".sync-1"),
					$slider02 = $this.find(".sync-2");
				$this.addClass('thumbnail-ready');

				floral.core.do_slick_carousel($slider01);

				// $slider01.slick({
				// 	infinite      : false,
				// 	fade          : ($slider01.hasClass('animation-fade') ? true : false),
				// 	speed         : 400,
				// 	adaptiveHeight: ($slider01.hasClass('height-auto') ? true : false),
				// 	arrows        : ($slider01.hasClass('dir-nav') ? true : false),
				// 	dots          : $slider01.hasClass('control-nav') ? true : false
				// });
				// $slider01.slick($.parseJSON($slider01.attr("data-options")));

				$slider01.on('beforeChange', function (event, slick, currentSlide, nextSlide) {
					syncPosition(nextSlide);
				});

				var visibleItems = [];
				var option = 0;

				$slider02.on("init", function (event, slick) {
					$(this).find(".slick-slide").eq(0).addClass("synced");
					var WW = window.innerWidth;
					if (WW >= 1020) {
						option = 4;
					}

					if (WW < 1020) {
						option = 3;
					}

					for (var i = 0; i < option; i++) {
						visibleItems.push(i);
					}
				});

				$window.on('resize load', function (event) {
					var WW = window.innerWidth;
					if (WW >= 1020) {
						option = 4;
					}

					if (WW < 1020) {
						option = 3;
					}
				});

				$slider02.on('afterChange', function (event, slick, currentSlide) {
					visibleItems.length = 0;
					for (var i = currentSlide; i < currentSlide + option; i++) {
						visibleItems.push(i);
					}
				});

				floral.core.do_slick_carousel($slider02);
				// $slider02.slick($.parseJSON($slider02.attr("data-options")));
				// $slider02.slick({
				// 	swipeToSlide   : true,
				// 	infinite       : false,
				// 	slidesToShow   : 4,
				// 	slidesToScroll : 1,
				// 	speed          : 400,
				// 	arrows         : ($slider02.hasClass('direction-nav') ? true : false),
				// 	centerPadding  : '0px',
				// 	vertical       : true,
				// 	verticalSwiping: true,
				// 	responsive     : [
				//
				// 		{
				// 			breakpoint: 1230,
				// 			settings  : {
				// 				slidesToShow   : 4,
				// 				vertical       : false,
				// 				verticalSwiping: false
				// 			}
				// 		},
				//
				// 		{
				// 			breakpoint: 1020,
				// 			settings  : {
				// 				slidesToShow   : 3,
				// 				vertical       : false,
				// 				verticalSwiping: false
				// 			}
				// 		}
				// 	]
				// });

				function syncPosition(value) {
					var current = value;
					$slider02
						.find(".slick-slide")
						.removeClass("synced")
						.eq(current)
						.addClass("synced");
					center(current);
				}

				$slider02.on("click", ".slick-slide", function (e) {
					e.preventDefault();
					var number = $(this).data("slick-index");
					$slider01.slick("slickGoTo", number);
				});

				function center(number) {
					var num = number;
					var found = false;
					var lastSlideIndex = $slider02.find('.slick-slide:last').index();
					for (var i in visibleItems) {
						if (num === visibleItems[i]) {
							found = true;
						}
					}

					if (found === false) {
						if (num > visibleItems[visibleItems.length - 1]) {
							if (num == lastSlideIndex) {
								$slider02.slick("slickGoTo", num - visibleItems.length + 1);
							}

							else {
								$slider02.slick("slickGoTo", num - visibleItems.length + 2);
							}
						}
						else {
							if (num - 1 === -1) {
								$slider02.slick("slickGoTo", 0);
							}
							else {
								$slider02.slick("slickGoTo", num - 1);
							}
						}

					} else if (num === visibleItems[visibleItems.length - 1]) {
						// console.log(1);
						$slider02.slick("slickGoTo", visibleItems[1]);
					} else if (num === visibleItems[0]) {
						// console.log(2);
						$slider02.slick("slickGoTo", num - 1);
					}
				}
			});
		},

		do_quantity_input_action: function ($target) {
			if (typeof $target == 'undefined') {
				$target = $('.quantity');
			}

			$target.each(function () {
				var $this = $(this),
					$text_input = $this.find('input[type="text"]'),
					$btn_up = $this.find('button[data-action="plus"]'),
					$btn_down = $this.find('button[data-action="minus"]');
				if ($text_input.length == 0) {
					return;
				}

				$this.addClass('ready');

				var min = 1,
					max = parseInt($text_input.attr('max')),
					step = parseInt($text_input.attr('step'));

				if (!max) max = 100;
				if (!step) step = 1;

				function get_current_input_val() {
					var current = parseInt($text_input.val());
					return (current) ? current : 0;
				}

				//
				$text_input.on('keypress', function (e) {
					var code = String.fromCharCode(e.which);
					if (!code.match(/[0-9+-]/))
						return false;
				});

				$text_input.on('keyup', function (e) {
					var val = parseInt($(this).val());
					if (val > max) {
						$(this).val(max);
					}

					if (val < min) {
						$(this).val(min);
					}

				});

				$text_input.on('blur', function (e) {
					var val = parseInt($(this).val());

					if (isNaN(val)) {
						$(this).val(min);
					}
				});

				function remove_update_cart_prop_disable() {
					var $target = $('div.woocommerce > form input[name="update_cart"]'),
						isDisabled = $target.prop('disabled');
					if (($target.length > 0) && isDisabled) {
						$target.prop('disabled', false);
					}
				}


				$btn_up.on('click', function (e) {
					e.preventDefault();
					var result = get_current_input_val() + step;
					if (result < min) {
						result = min;
					} else if (result > max) {
						result = max;
					}

					$text_input.val(result);
					remove_update_cart_prop_disable();
				});

				$btn_down.on('click', function (e) {
					e.preventDefault();
					var result = get_current_input_val() - step;
					if (result < min) {
						result = min;
					} else if (result > max) {
						result = max;
					}
					$text_input.val(result);
					remove_update_cart_prop_disable();
				});
			});
		},

		do_add_to_cart_active: function () {
			$(document.body).on('adding_to_cart', function (e, $button) {
				$button.parents('.product-thumbnail').addClass('active');
			});

			$(document.body).on('added_to_cart', function (e, fragments, cart_hash, $button) {
				setTimeout(function () {
					$button.parents('.product-thumbnail').removeClass('active');
					$button.removeClass('added');
				}, 1500);
			});
		},

		do_init_product_quick_view_feature: function ($target) {
			if (!$body.hasClass('woocommerce-page') || !$body.hasClass('product-quick-view-enabled')) {
				return;
			}

			if (typeof $target == 'undefined') {
				$target = $('a.quick-view-btn:not(.ready)');
			}

			$target.on('click', function (e) {
				var $this = $(this),
					$current_loop = $this.parents('.loop-item'),
					product_id = $this.attr('data-product-id'),
					$quick_view_wrapper = $('#floral-quick-view'),
					$quick_view_loading = $quick_view_wrapper.find('.block-loader-inner'),
					$quick_view_product = $quick_view_wrapper.find('.quick-view-product');

				function start_click_process() {
					$this.addClass('ready');
					$this.parents('.product-thumbnail').addClass('active');
					$this.find('i').removeClass('fa-expand').addClass('fa-spinner fa-spin');
				}

				function stop_click_process() {
					$this.parents('.product-thumbnail').removeClass('active');
					$this.find('i').removeClass('fa-spinner fa-spin').addClass('fa-expand');
				}

				function is_nav_feature_enabled() {
					return $body.hasClass('product-quick-view-nav-enabled');
				}

				function on_model_shown() {
					stop_click_process();
					floral.woocommerce.do_quantity_input_action($('.quantity:not(.ready)', $quick_view_wrapper));
					// floral.core.do_slick_carousel($('.slick-carousel:not(.slick-ready)', $quick_view_wrapper));
					floral.woocommerce.thumbnail_slider($('.product-item-images-slide-show:not(.thumbnail-ready)', $quick_view_wrapper));
					floral.shortcodes.do_init_button_icon_effects($('.floral-btn:not(.ready)', $quick_view_wrapper));
					if (is_nav_feature_enabled()) {
						set_nav_links();
						make_nav_link_in_action();
					}
				}

				function set_nav_links() {
					var next = $current_loop.next().find('.quick-view-btn').attr('data-product-id'),
						prev = $current_loop.prev().find('.quick-view-btn').attr('data-product-id');

					var $next_link = $quick_view_wrapper.find('.qv-next'),
						$prev_link = $quick_view_wrapper.find('.qv-prev');
					$next_link.removeClass('disabled');
					$prev_link.removeClass('disabled');

					if (typeof next == 'undefined') {
						$next_link.addClass('disabled')
					} else {
						$next_link.attr('data-product-id', next);
					}

					if (typeof prev == 'undefined') {
						$prev_link.addClass('disabled')
					} else {
						$prev_link.attr('data-product-id', prev);
					}
				}

				function make_nav_link_in_action() {
					var $_links = $quick_view_wrapper.find('.qv-nav-item:not(.ready)');

					$_links.each(function () {
						var _link = $(this);
						_link.addClass('ready');

						_link.on('click', function () {
							$_links.addClass('disabled');
							if (_link.hasClass('qv-next')) {
								$current_loop = $current_loop.next();
							} else if (_link.hasClass('qv-prev')) {
								$current_loop = $current_loop.prev();
							}
							var p_id = _link.attr('data-product-id');
							load_quick_view_product_content(p_id);
						});
					});
				}

				function load_quick_view_wrapper() {
					var data = {
						action    : 'load_quick_view_wrapper',
						product_id: product_id
					};
					$.ajax({
						type   : 'GET',
						url    : floral_main_vars.ajax_url,
						data   : data,
						success: function (resp) {
							// change icon to quick view icon
							$body.append(resp);
							$quick_view_wrapper = $('#floral-quick-view');
							$quick_view_loading = $quick_view_wrapper.find('.block-loader-inner');
							$quick_view_product = $quick_view_wrapper.find('.quick-view-product');

							$quick_view_wrapper.modal({
								show    : false,
								keyboard: false
							});

							$quick_view_wrapper.on('shown.bs.modal', function () {
								on_model_shown();
							});
							show_quick_view();
						},
						error  : function (resp) {
							console.log(resp);
						}
					});
				}

				function load_quick_view_product_content(product_id) {
					var data = {
						action    : 'load_quick_view_product_content',
						product_id: product_id
					};
					$quick_view_loading.css('display', 'block');
					$.ajax({
						type   : 'GET',
						url    : floral_main_vars.ajax_url,
						data   : data,
						success: function (resp) {
							// change icon to quick view icon
							$quick_view_product = $quick_view_wrapper.find('.quick-view-product');
							$quick_view_product.animate({
								opacity: 0
							}, 500).remove();
							$quick_view_wrapper.find('.quick-view-content').append(resp);
							$quick_view_product = $quick_view_wrapper.find('.quick-view-product');
							floral.woocommerce.thumbnail_slider($('.product-item-images-slide-show:not(.thumbnail-ready)', $quick_view_wrapper));
							$quick_view_product.fadeIn();
							// $(document.body).trigger('product_switched', [$quick_view_product]);
							setTimeout(function () {
								floral.woocommerce.do_quantity_input_action($('.quantity:not(.ready)', $quick_view_product));
								// floral.core.do_slick_carousel($('.slick-carousel:not(.slick-ready)', $quick_view_product));
								floral.shortcodes.do_init_button_icon_effects($('.floral-btn:not(.ready)', $quick_view_product));
								if (is_nav_feature_enabled()) {
									set_nav_links();
								}
								$quick_view_loading.css('display', 'none');
							}, 100);
						},
						error  : function (resp) {
							console.log(resp);
						}
					});

				}

				function show_quick_view() {
					$quick_view_wrapper.modal('show');
				}

				// handling the click events
				e.preventDefault();
				start_click_process();
				$quick_view_wrapper.on('shown.bs.modal', function () {
					on_model_shown();
				});

				if ($quick_view_wrapper.length === 0) {
					load_quick_view_wrapper();
				} else {
					show_quick_view();
					if (product_id !== $quick_view_product.attr('data-product-id')) {
						load_quick_view_product_content(product_id);
					}
				}

			});
		},

		do_init_effect_on_checkout_form_expanded: function () {
			if ($body.hasClass('woocommerce-checkout')) {
				$('a.showcoupon, a.showlogin').on('click', function () {
					var $this = $(this),
						$show_coupon = $('a.showcoupon'),
						$show_login = $('a.showlogin');

					$this.toggleClass('active');
					$this.parents('.woocommerce').find('form.checkout').addClass('above-form-expanded');

					if (!$show_coupon.hasClass('active') && !$show_login.hasClass('active')) {
						$this.parents('.woocommerce').find('form.checkout').removeClass('above-form-expanded');
					}
				});
			}
		},

		do_init_cart_action: function ($target) {
			if (!$body.hasClass('mini-cart-ajax-actions-enabled')) {
				return;
			}

			if (typeof $target == 'undefined') {
				$target = $('.cart_list_wrapper:not(.ready)');
			}

			$target.each(function () {
				var $this = $(this),
					$_empty_cart_btn = $this.find('a.empty-cart'),
					$_remove_item_btn = $this.find('a.remove'),
					$_undo_item_btn = $this.find('a.undo'),
					$_cart_message = $target.find('.cart-message'),
					$_loading = $target.find('.block-loader-inner');

				$this.addClass('ready');

				function start_cart_action_process() {
					$_loading.fadeIn();
				}

				function stop_cart_action_process() {
					$_loading.fadeOut();
				}

				function update_cart_message(message) {
					if (!message) message = floral.woocommerce.__cart_message;

					if ($_cart_message.length == 0) {
						$target.prepend('<p class="cart-message"></p>');
						$_cart_message = $target.find('.cart-message');
					}

					if (message) {
						$_cart_message.empty().append(message);
					} else {
						$_cart_message.remove();
					}

				}

				function update_error_cart_message() {
					update_cart_message(floral_main_vars.error_message);
				}

				$(document.body).on('wc_fragments_refreshed', function () {
					console.log(floral.woocommerce.__cart_message);
					stop_cart_action_process();
				});

				$_empty_cart_btn.on('click', function (e) {
					e.preventDefault();

					start_cart_action_process();

					$.ajax({
						type    : 'GET',
						dataType: 'html',
						url     : $_empty_cart_btn.attr('href'),
						success : function (resp) {
							$(document.body).trigger('wc_fragment_refresh');
						},
						error   : function (resp) {
							stop_cart_action_process();
						}
					});

				});

				$_remove_item_btn.on('click', function (e) {
					e.preventDefault();

					var _self = $(this),
						remove_url = _self.attr('href');

					var cart_item_key = floral.core.get_parameter_by_name('remove_item', remove_url),
						_nonce = floral.core.get_parameter_by_name('_wpnonce', remove_url);

					if (cart_item_key && _nonce) {
						var data = {
							action: 'woocommerce_remove_cart_item',
							cik   : cart_item_key,
							_nonce: _nonce
						};

						start_cart_action_process();
						$.ajax({
							type   : 'GET',
							data   : data,
							url    : floral_main_vars.ajax_url,
							success: function (resp) {
								try {
									console.log(resp);
									resp = $.parseJSON(resp);

									if (resp.status == 'success') {
										$(document.body).trigger('wc_fragment_refresh');
										floral.woocommerce.__cart_message = resp.message;
									} else {
										console.log(resp.message);
										floral.woocommerce.__cart_message = resp.message;
										update_cart_message();
										stop_cart_action_process();
									}
								} catch (e) {
									console.log(e);
									update_error_cart_message();
									stop_cart_action_process();
								}
							},
							error  : function (resp) {
								console.log(resp);
								update_error_cart_message();
								stop_cart_action_process();
							}
						});
					}
				});

				$_undo_item_btn.on('click', function (e) {
					e.preventDefault();
					var _self = $(this),
						undo_url = _self.attr('href');

					var cart_item_key = floral.core.get_parameter_by_name('undo_item', undo_url),
						_nonce = floral.core.get_parameter_by_name('_wpnonce', undo_url);

					if (cart_item_key && _nonce) {
						var data = {
							action: 'woocommerce_undo_cart_item',
							cik   : cart_item_key,
							_nonce: _nonce
						};
						start_cart_action_process();
						$.ajax({
							type   : 'GET',
							data   : data,
							url    : floral_main_vars.ajax_url,
							success: function (resp) {
								try {
									console.log(resp);
									resp = $.parseJSON(resp);

									if (resp.status == 'success') {
										$(document.body).trigger('wc_fragment_refresh');
										floral.woocommerce.__cart_message = '';
									} else {
										console.log(resp.message);
										floral.woocommerce.__cart_message = resp.message;
										update_cart_message();
										stop_cart_action_process();
									}
								} catch (e) {
									console.log(e);
									update_error_cart_message();
									stop_cart_action_process();
								}
							},
							error  : function (resp) {
								console.log(resp);
								update_error_cart_message();
								stop_cart_action_process();
							}
						});
					}
				});
			});
		},

		do_make_custom_minicart_scrollbar: function (targetSelector) {
            var $target;
			if (targetSelector) {
                $target = $(targetSelector);
			} else {
				$target = $('.widget_shopping_cart_content ul.cart_list');
			}

			$target.each(function () {
				var $this = $(this);
				var $parent = $this.parents('.__cart-wrapper');

				$this.addClass('custom-scrollbar-ready');
				var max_height = 0,
					$li_items = $this.find('li.mini_cart_item');

				// scrollbar start
				var scrollbar_start = parseInt($this.attr('data-scrollbar-start'));
				if (!scrollbar_start) scrollbar_start = 3;

				if ($li_items.length < scrollbar_start) {
					return;
				}

				// calculate max height
				$parent.css({'opacity': 0, 'display': 'block'});
				$li_items.each(function (index) {
					if (index < scrollbar_start) {
						max_height += $(this).outerHeight(true);
					}
				});
				$parent.css({'display': '', 'opacity': 1});

				$this.css('max-height', max_height);

				// scroll bar theme
				var scrollbar_theme = $parent.attr('data-scrollbar-theme');
				if (!scrollbar_theme) scrollbar_theme = 'dark';
				$this.mCustomScrollbar({
					theme     : scrollbar_theme,
					axis      : 'y',
					mouseWheel: {
						scrollAmount: 150
					}
				});

			});
		}
	};

	/*Document On Ready*/
	$(document).ready(function () {
		floral.core.on_ready();
		floral.page.on_ready();
		floral.header.on_ready();
		if ($body.hasClass('slipscreen-mode-on')) {
			floral.slip_screen.on_ready();
		}
		floral.blog.on_ready();
		floral.shortcodes.on_ready();
		floral.woocommerce.on_ready();
	});

	$(window).load(function () {
		floral.page.on_load();
		// floral.woocommerce.on_load();
	});

	// make mini-cart scroll bar when page load
	$(document.body).on('wc_fragments_loaded', function () {
		floral.woocommerce.do_make_custom_minicart_scrollbar();
	});
})(jQuery, window);