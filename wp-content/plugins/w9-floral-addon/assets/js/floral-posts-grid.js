/**
 * Created by Peter Mai on 8/3/2016.
 */
var vcGridStyleSlider;
!function ($) {
	vcGridStyleSlider = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$el = !1, this.$content = !1, this.filterValue = null, this.isLoading = !1, this.htmlCache = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.$firstSlideItems, this.init()
	}, vcGridStyleSlider.prototype.init = function () {
		_.bindAll(this, "addItems", "initCarousel")
	}, vcGridStyleSlider.prototype.setIsLoading = function () {
		this.$loader.show(), this.isLoading = !0
	}, vcGridStyleSlider.prototype.unsetIsLoading = function () {
		this.isLoading = !1, this.$loader.hide()
	}, vcGridStyleSlider.prototype.render = function () {
		this.$el = this.grid.$el, this.$content = this.$el, this.$content.append(this.$loader), this.setIsLoading(), this.grid.ajax({}, this.addItems)
	}, vcGridStyleSlider.prototype.filter = function (filter) {
		if (filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter)return !1;
		this.$content.css({'transform': 'scale(0.8)', 'opacity': '0', 'transition': 'all 0.15s'});
		var $this = this;
		var $html;
		setTimeout(function () {
			$this.$content.data("owl.vccarousel") && ($this.$content.off("initialized.owl.vccarousel"), $this.$content.off("changed.owl.vccarousel"), $this.$content.data("vcPagination") && $this.$content.data("vcPagination").twbsPagination("destroy"), $this.$content.data("owl.vccarousel").destroy()), $this.$content.empty(), $html = $(".vc_grid-item", $this.htmlCache), "" !== filter && ($html = $html.filter(filter)), $this.filterValue = filter, $this.buildSlides($html.addClass("vc_visible-item"));
			$this.$content.css({'transform': 'scale(1)', 'opacity': '1', 'transition': 'all 0.3s'});
		}, 150);
	}, vcGridStyleSlider.prototype.buildSlides = function ($html) {
		var i, j, tempArray, chunk = parseInt(this.settings.items_per_page);
		// for (i = 0, j = $html.length; j > i; i += chunk)tempArray = $html.slice(i, i + chunk), $('<div class="vc_pageable-slide-wrapper">').append($(tempArray)).appendTo(this.$content);
		// this.$content.find(".vc_pageable-slide-wrapper:first").imagesLoaded(this.initCarousel)
		for (i = 0; i < $html.length; i++) {
			$($html[i]).appendTo(this.$content);
		}
		this.$content.addClass('floral-vc-grid-slider');
		this.$content.imagesLoaded(this.initCarousel());

	}, vcGridStyleSlider.prototype.addItems = function (html) {
		this.$el.append(html), !1 === this.htmlCache && (this.htmlCache = html), this.unsetIsLoading(), this.$content = this.$el.find('[data-vc-pageable-content="true"]'), this.$content.addClass("owl-carousel vc_grid-owl-theme"), this.grid.initFilter(), this.filter(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
	}, vcGridStyleSlider.prototype.initCarousel = function () {
		if ($.fn.vcOwlCarousel) {
			var $vcCarousel, that = this;

			function calculate_items(element_width) {
				var numcol;
				element_width = (element_width > 0) ? element_width : 1;
				numcol = Math.ceil(12 / element_width);
				// console.log(element_width);

				if (numcol === 6) {
					return responsive = {
						1200: {items: 6},
						992: {items: 4},
						768: {items: 3},
						480: {items: 2},
						0  : {items: 1}
					};
				} else if (numcol === 4) {
					return responsive = {
						992: {items: 4},
						768: {items: 3},
						480: {items: 2},
						0  : {items: 1}
					};
				}

				return responsive = {
					992: {items: numcol},
					480: {items: (numcol - 1) > 0 ? numcol - 1 : 1},
					0  : {items: 1}
				};
			}

			var responsive = calculate_items(this.settings.element_width);

			$vcCarousel = this.$content.data("owl.vccarousel"), $vcCarousel && $vcCarousel.destroy(), this.$content.on("initialized.owl.vccarousel", function (event) {
				if (that.settings.paging_design.indexOf("pagination") > -1) {
					var $carousel = event.relatedTarget, items = Math.ceil($carousel.items().length * that.settings.element_width / 12), $pagination = $("<div></div>").addClass("vc_grid-pagination").appendTo(that.$el);
					$pagination.twbsPagination({
						totalPages     : items,
						visiblePages   : that.settings.visible_pages,
						onPageClick    : function (event, page) {
							$carousel.to(page - 1)
						},
						paginationClass: "vc_grid-pagination-list vc_grid-" + that.settings.paging_design + " vc_grid-pagination-color-" + that.settings.paging_color,
						nextClass      : "vc_grid-next",
						first          : items > 20 ? " " : !1,
						last           : items > 20 ? " " : !1,
						prev           : items > 3 ? " " : !1,
						next           : items > 3 ? " " : !1,
						prevClass      : "vc_grid-prev",
						lastClass      : "vc_grid-last",
						loop           : that.settings.loop,
						firstClass     : "vc_grid-first",
						pageClass      : "vc_grid-page",
						activeClass    : "vc_grid-active",
						disabledClass  : "vc_grid-disabled"
					}), $(this).data("vcPagination", $pagination), that.$content.on("changed.owl.vccarousel", function (event) {
						var $pagination = $(this).data("vcPagination"), $pag_object = $pagination.data("twbsPagination");
						$pag_object.render($pag_object.getPages(1 + event.page.index)), $pag_object.setupEvents()
					}), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
				}
			}).vcOwlCarousel({
				items            : (this.settings.element_width > 0) ? Math.ceil(12 / this.settings.element_width) : 1,
				responsive       : responsive,
				loop             : this.settings.loop,
				margin           : this.settings.gap,
				nav              : !0,
				rtl              : $('body').hasClass('rtl'),
				navText          : ["", ""],
				navContainerClass: "vc_grid-owl-nav vc_grid-owl-nav-color-" + this.settings.arrows_color,
				dotClass         : "vc_grid-owl-dot",
				dotsClass        : "vc_grid-owl-dots vc_grid-" + this.settings.paging_design + " vc_grid-owl-dots-color-" + this.settings.paging_color,
				navClass         : ["vc_grid-owl-prev " + this.settings.arrows_design + " vc_grid-nav-prev-" + this.settings.arrows_position, "vc_grid-owl-next " + this.settings.arrows_design.replace("_left", "_right") + " vc_grid-nav-next-" + this.settings.arrows_position],
				animateIn        : "none" !== this.settings.animation_in ? this.settings.animation_in : !1,
				animateOut       : "none" !== this.settings.animation_out ? this.settings.animation_out : !1,
				autoHeight       : 0,
				autoplay         : !0 === this.settings.auto_play,
				autoplayTimeout  : this.settings.speed,
				callbacks        : !0,
				onTranslated     : function () {
					setTimeout(function () {
						$(window).trigger("grid:items:added", that.$el)
					}, 750)
				},
				onRefreshed      : function () {
					setTimeout(function () {
						$(window).trigger("grid:items:added", that.$el)
					}, 750)
				}
			})
		}
	}
}(jQuery);

var vcGridStyleAll;
!function ($) {
	vcGridStyleAll = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.filterValue = null, this.$el = !1, this.$content = !1, this.isLoading = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.init()
	}, vcGridStyleAll.prototype.init = function () {
		_.bindAll(this, "addItems", "showItems")
	}, vcGridStyleAll.prototype.render = function () {
		this.$el = this.grid.$el, this.$content = this.$el, this.setIsLoading(), this.grid.ajax({}, this.addItems)
	}, vcGridStyleAll.prototype.setIsLoading = function () {
		this.$content.append(this.$loader), this.isLoading = !0
	}, vcGridStyleAll.prototype.unsetIsLoading = function () {
		this.isLoading = !1, this.$loader && this.$loader.remove()
	}, vcGridStyleAll.prototype.filter = function (filter) {
		if (filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter)return !1;
		var animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		vcGridSettings.addItemsAnimation = animation, this.$content.find(".vc_visible-item").removeClass("vc_visible-item " + vcGridSettings.addItemsAnimation + " animated"), this.filterValue = filter, _.defer(this.showItems)
	}, vcGridStyleAll.prototype.showItems = function () {
		var $els = this.$content.find(".vc_grid-item" + this.filterValue);
		this.setIsLoading();
		var animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		vcGridSettings.addItemsAnimation = animation, $els.addClass("vc_visible-item " + ("none" !== vcGridSettings.addItemsAnimation ? vcGridSettings.addItemsAnimation + " animated" : "")), this.unsetIsLoading(), $(window).trigger("grid:items:added", this.$el)
	}, vcGridStyleAll.prototype.addItems = function (html) {
		var els = $(html);
		this.$el.append(els), this.unsetIsLoading(), this.$content = els.find('[data-vc-grid-content="true"]'), this.grid.initFilter(), this.filter(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
	}
}(jQuery);

var vcGridStyleLoadMore;
!function ($) {
	vcGridStyleLoadMore = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$loadMoreBtn = !1, this.$el = !1, this.filterValue = null, this.$content = !1, this.isLoading = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.init()
	}, vcGridStyleLoadMore.prototype.setIsLoading = function () {
		this.$loadMoreBtn && this.$loadMoreBtn.hide(), this.isLoading = !0
	}, vcGridStyleLoadMore.prototype.unsetIsLoading = function () {
		this.isLoading = !1, this.setLoadMoreBtn()
	}, vcGridStyleLoadMore.prototype.init = function () {
		_.bindAll(this, "addItems")
	}, vcGridStyleLoadMore.prototype.render = function () {
		this.$el = this.grid.$el, this.$content = this.$el, this.setIsLoading(), this.$content.append(this.$loader), this.grid.ajax({}, this.addItems)
	}, vcGridStyleLoadMore.prototype.showItems = function () {
		var $els = this.$content.find(".vc_grid_filter-item:not(.vc_visible-item):lt(" + this.settings.items_per_page + ")");
		this.setIsLoading();
		var animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		vcGridSettings.addItemsAnimation = animation, $els.addClass("vc_visible-item " + vcGridSettings.addItemsAnimation + " animated"), this.unsetIsLoading(), $(window).trigger("grid:items:added", this.$el)
	}, vcGridStyleLoadMore.prototype.filter = function (filter) {
		if (filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter)return !1;
		this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		this.$content.find(".vc_visible-item, .vc_grid_filter-item").removeClass("vc_visible-item vc_grid_filter-item "), this.filterValue = filter, this.$content.find(".vc_grid-item" + this.filterValue).addClass("vc_grid_filter-item"), this.showItems()
	}, vcGridStyleLoadMore.prototype.addItems = function (html) {
		var els = $(html);
		this.$el.append(els), this.unsetIsLoading(), this.$content = els.find('[data-vc-grid-content="true"]'), this.$loadMoreBtn = els.find('[data-vc-grid-load-more-btn="true"] .vc_btn3'), this.$loadMoreBtn.length || (this.$loadMoreBtn = els.find('[data-vc-grid-load-more-btn="true"] .vc_btn'));
		var self = this;
		this.$loadMoreBtn.click(function (e) {
			e.preventDefault(), self.showItems()
		}), this.$loadMoreBtn.hide(), this.grid.initFilter(), this.filter(), this.$loader.remove(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
	}, vcGridStyleLoadMore.prototype.setLoadMoreBtn = function () {
		$('.vc_grid_filter-item:not(".vc_visible-item")', this.$content).length && $(".vc_grid_filter-item", this.$content).length ? this.$loadMoreBtn && this.$loadMoreBtn.show() : this.$loadMoreBtn && this.$loadMoreBtn.hide()
	}
}(jQuery);

var vcGridStyleLazy;
!function ($) {
	$.waypoints("extendFn", "vc_grid-infinite", function (options) {
		var $container, opts, el = this;
		return opts = $.extend({}, $.fn.waypoint.defaults, {
			container: "auto",
			items    : ".infinite-item",
			offset   : "bottom-in-view",
			handle   : {
				load: function (opts) {
				}
			}
		}, options), $container = "auto" === opts.container ? el : $(opts.container, el), opts.handler = function (direction) {
			var $this;
			("down" === direction || "right" === direction) && ($this = $(this), $this.waypoint("destroy"), opts.handle.load.call(this, opts))
		}, this.waypoint(opts)
	}), vcGridStyleLazy = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$el = !1, this.filterValue = null, this.$content = !1, this.isLoading = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.init()
	}, vcGridStyleLazy.prototype.setIsLoading = function () {
		this.$content.append(this.$loader), this.isLoading = !0
	}, vcGridStyleLazy.prototype.unsetIsLoading = function () {
		this.isLoading = !1, this.$loader && this.$loader.remove()
	}, vcGridStyleLazy.prototype.init = function () {
		_.bindAll(this, "addItems", "showItems")
	}, vcGridStyleLazy.prototype.render = function () {
		this.$el = this.grid.$el, this.$content = this.$el, this.setIsLoading(), this.grid.ajax({}, this.addItems)
	}, vcGridStyleLazy.prototype.showItems = function () {
		var $els = this.$content.find(".vc_grid_filter-item:not(.vc_visible-item):lt(" + this.settings.items_per_page + ")");
		this.setIsLoading();
		var animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		vcGridSettings.addItemsAnimation = animation, $els.addClass("vc_visible-item " + vcGridSettings.addItemsAnimation + " animated"), this.unsetIsLoading(), $(window).trigger("grid:items:added", this.$el)
	}, vcGridStyleLazy.prototype.filter = function (filter) {
		if (filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter)return !1;
		var animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation");
		vcGridSettings.addItemsAnimation = animation, this.$content.find(".vc_visible-item, .vc_grid_filter-item").removeClass("vc_visible-item vc_grid_filter-item " + ("none" !== vcGridSettings.addItemsAnimation ? vcGridSettings.addItemsAnimation + " animated" : "")), this.filterValue = filter, this.$content.find(".vc_grid-item" + this.filterValue).addClass("vc_grid_filter-item"), _.defer(this.showItems), this.initScroll()
	}, vcGridStyleLazy.prototype.addItems = function (html) {
		var els = $(html);
		this.$el.append(els), this.unsetIsLoading(), this.$content = els.find('[data-vc-grid-content="true"]'), this.grid.initFilter(), this.filter(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
	}, vcGridStyleLazy.prototype.initScroll = function () {
		var self = this;
		this.$content.unbind("waypoint").waypoint("vc_grid-infinite", {
			container: "auto",
			items    : ".vc_grid-item",
			handle   : {
				load: function (opts) {
					self.showItems(), self.checkNext(opts)
				}
			}
		})
	}, vcGridStyleLazy.prototype.checkNext = function (opts) {
		if (this.$content.find('.vc_grid_filter-item:not(".vc_visible-item")').length) {
			var fn, self = this;
			fn = function () {
				return self.$content.waypoint(opts)
			}, _.defer(fn)
		}
	}
}(jQuery);

var vcGridStylePagination;
!function ($) {
	vcGridStylePagination = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$el = !1, this.$content = !1, this.filterValue = null, this.isLoading = !1, this.htmlCache = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.$firstSlideItems, this.init()
	}, vcGridStylePagination.prototype.init = function () {
		_.bindAll(this, "addItems", "initCarousel")
	}, vcGridStylePagination.prototype.setIsLoading = function () {
		this.$loader.show(), this.isLoading = !0
	}, vcGridStylePagination.prototype.unsetIsLoading = function () {
		this.isLoading = !1, this.$loader.hide()
	}, vcGridStylePagination.prototype.render = function () {
		this.$el = this.grid.$el, this.$content = this.$el, this.$content.append(this.$loader), this.setIsLoading(), this.grid.ajax({}, this.addItems)
	}, vcGridStylePagination.prototype.filter = function (filter) {
		if (filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter)return !1;
		this.$content.css({'transform': 'scale(0.8)', 'opacity': '0', 'transition': 'all 0.15s'});
		var $this = this;
		var $html;
		setTimeout(function () {
			$this.$content.data("owl.vccarousel") && ($this.$content.off("initialized.owl.vccarousel"), $this.$content.off("changed.owl.vccarousel"), $this.$content.data("vcPagination") && $this.$content.data("vcPagination").twbsPagination("destroy"), $this.$content.data("owl.vccarousel").destroy()), $this.$content.empty(), $html = $(".vc_grid-item", $this.htmlCache), "" !== filter && ($html = $html.filter(filter)), $this.filterValue = filter, $this.buildSlides($html.addClass("vc_visible-item"));
			$this.$content.css({'transform': 'scale(1)', 'opacity': '1', 'transition': 'all 0.3s'});
		}, 150);
	}, vcGridStylePagination.prototype.buildSlides = function ($html) {
		var i, j, tempArray, chunk = parseInt(this.settings.items_per_page);
		for (i = 0, j = $html.length; j > i; i += chunk)tempArray = $html.slice(i, i + chunk), $('<div class="vc_pageable-slide-wrapper">').append($(tempArray)).appendTo(this.$content);
		this.$content.find(".vc_pageable-slide-wrapper:first").imagesLoaded(this.initCarousel)
	}, vcGridStylePagination.prototype.addItems = function (html) {
		this.$el.append(html), !1 === this.htmlCache && (this.htmlCache = html), this.unsetIsLoading(), this.$content = this.$el.find('[data-vc-pageable-content="true"]'), this.$content.addClass("owl-carousel vc_grid-owl-theme"), this.grid.initFilter(), this.filter(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
	}, vcGridStylePagination.prototype.initCarousel = function () {
		if ($.fn.vcOwlCarousel) {
			var $vcCarousel, that = this;
			$vcCarousel = this.$content.data("owl.vccarousel"), $vcCarousel && $vcCarousel.destroy(), this.$content.on("initialized.owl.vccarousel", function (event) {
				if (that.settings.paging_design.indexOf("pagination") > -1) {
					var $carousel = event.relatedTarget, items = $carousel.items().length, $pagination = $("<div></div>").addClass("vc_grid-pagination").appendTo(that.$el);
					$pagination.twbsPagination({
						totalPages     : items,
						visiblePages   : that.settings.visible_pages,
						onPageClick    : function (event, page) {
							$carousel.to(page - 1)
						},
						paginationClass: "vc_grid-pagination-list vc_grid-" + that.settings.paging_design + " vc_grid-pagination-color-" + that.settings.paging_color,
						nextClass      : "vc_grid-next",
						first          : items > 20 ? " " : !1,
						last           : items > 20 ? " " : !1,
						prev           : items > 5 ? " " : !1,
						next           : items > 5 ? " " : !1,
						prevClass      : "vc_grid-prev",
						lastClass      : "vc_grid-last",
						loop           : that.settings.loop,
						firstClass     : "vc_grid-first",
						pageClass      : "vc_grid-page",
						activeClass    : "vc_grid-active",
						disabledClass  : "vc_grid-disabled"
					}), $(this).data("vcPagination", $pagination), that.$content.on("changed.owl.vccarousel", function (event) {
						var $pagination = $(this).data("vcPagination"), $pag_object = $pagination.data("twbsPagination");
						$pag_object.render($pag_object.getPages(1 + event.page.index)), $pag_object.setupEvents()
					}), window.vc_prettyPhoto(), floral.core.do_prettyphoto()
				}
			}).vcOwlCarousel({
				items            : 1,
				loop             : this.settings.loop,
				margin           : 10,
				nav              : !0,
				navText          : ["", ""],
				rtl              : $('body').hasClass('rtl'),
				navContainerClass: "vc_grid-owl-nav vc_grid-owl-nav-color-" + this.settings.arrows_color,
				dotClass         : "vc_grid-owl-dot",
				dotsClass        : "vc_grid-owl-dots vc_grid-" + this.settings.paging_design + " vc_grid-owl-dots-color-" + this.settings.paging_color,
				navClass         : ["vc_grid-owl-prev " + this.settings.arrows_design + " vc_grid-nav-prev-" + this.settings.arrows_position, "vc_grid-owl-next " + this.settings.arrows_design.replace("_left", "_right") + " vc_grid-nav-next-" + this.settings.arrows_position],
				animateIn        : "none" !== this.settings.animation_in ? this.settings.animation_in : !1,
				animateOut       : "none" !== this.settings.animation_out ? this.settings.animation_out : !1,
				autoHeight       : !0,
				autoplay         : !0 === this.settings.auto_play,
				autoplayTimeout  : this.settings.speed,
				callbacks        : !0,
				onTranslated     : function () {
					setTimeout(function () {
						$(window).trigger("grid:items:added", that.$el)
					}, 750)
				},
				onRefreshed      : function () {
					setTimeout(function () {
						$(window).trigger("grid:items:added", that.$el)
					}, 750)
				}
			})
		}
	}
}(jQuery);

var vcGridStyleAllMasonry;
!function ($) {
	vcGridStyleAllMasonry = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.filterValue = null, this.$el = !1, this.$content = !1, this.isLoading = !1, this.filtered = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.masonryEnabled = !1, _.bindAll(this, "setMasonry"), this.init()
	}, vcGridStyleAllMasonry.prototype = _.extend({}, vcGridStyleAll.prototype, {
		updateHeight     : function () {
			// var $this = this;
			// var old_height = $this.$el.height();
			// setTimeout(function () {
			// 	var new_height = $this.$el.css('height', 'auto').height();
			// 	$this.$el.height(old_height);
			// 	$this.$el.animate({
			// 		'height' : new_height
			// 	}, 300);
			// }, 500);
		},
		showItems        : function () {
			var $els = this.$content.find(".vc_grid-item" + this.filterValue), self = this;
			this.setIsLoading(), $els.imagesLoaded(function () {
				$els.addClass("vc_visible-item"), self.setItems($els), self.filtered && (self.filtered = !1, self.setMasonry()), self.unsetIsLoading(), window.vc_prettyPhoto(), floral.core.do_prettyphoto(), $(window).trigger("grid:items:added", self.$el)
			}), this.updateHeight()
		}, filter        : function (filter) {

			// $parent.css({'transition':'all 0.3s'}).innerHeight(this.$content.height());
			filter = _.isUndefined(filter) || "*" === filter ? "" : filter,
				this.filterValue == filter ? !1 : (
					this.filterValue = filter,
					this.$content.data("masonry") && this.$content.masonry("destroy") ,
						this.masonryEnabled = !1,
						this.$content.find(".vc_visible-item").removeClass("vc_visible-item"),
						this.$content.find(".vc_grid-item" + this.filterValue),
						this.filtered = !0, $(window).resize(this.setMasonry),
						this.setMasonry(), void this.showItems()
				);

			return filter;
		}, setIsLoading  : function () {
			this.$el.append(this.$loader), this.isLoading = !0
		}, unsetIsLoading: function () {
			this.isLoading = !1, this.$loader && this.$loader.remove()
		}, setItems      : function (els) {
			this.masonryEnabled ? this.$content.masonry("appended", els) : this.setMasonry()
		}, setMasonry    : function () {
			var animation, settings, windowWidth = window.innerWidth;
			windowWidth < vcGridSettings.mobileWindowWidth ? (this.$content.data("masonry") && this.$content.masonry("destroy"), this.masonryEnabled = !1) : this.masonryEnabled ? (this.$content.masonry("reloadItems"), this.$content.masonry("layout")) : (animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation"), settings = {
				itemSelector : ".vc_visible-item",
				isResizeBound: !1,
				columnWidth  : '.vc_col-sm-' + this.settings.element_width
			}, "none" == animation ? (settings.hiddenStyle = {visibility: "hidden"}, settings.visibleStyle = {visibility: "visible"}) : "fadeIn" == animation ? (settings.hiddenStyle = {opacity: 0}, settings.visibleStyle = {opacity: 1}) : (settings.hiddenStyle = {
				opacity  : 0,
				transform: "scale(0.001)"
			},
				settings.visibleStyle = {
					opacity  : 1,
					transform: "scale(1)"
				}), this.$content.masonry(settings), this.masonryEnabled = !0)
		}
	})
}(jQuery);

var vcGridStyleLazyMasonry;
!function ($) {
	vcGridStyleLazyMasonry = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$el = !1, this.filterValue = null, this.filtered = !1, this.$content = !1, this.isLoading = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.masonryEnabled = !1, _.bindAll(this, "setMasonry"), this.init()
	}, vcGridStyleLazyMasonry.prototype = _.extend({}, vcGridStyleLazy.prototype, {
		showItems      : function () {
			if (!0 === this.isLoading)return !1;
			this.setIsLoading();
			var $els = this.$content.find(".vc_grid_filter-item:not(.vc_visible-item):lt(" + this.settings.items_per_page + ")"), self = this;
			$els.imagesLoaded(function () {
				$els.addClass("vc_visible-item"), self.setItems($els), self.filtered && (self.filtered = !1, self.setMasonry(), self.initScroll(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()), self.unsetIsLoading(), $(window).trigger("grid:items:added", self.$el)
			})
		}, setIsLoading: function () {
			this.$el.append(this.$loader), this.isLoading = !0
		}, filter      : function (filter) {
			return filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter ? !1 : (this.$content.data("masonry") && this.$content.masonry("destroy"), this.masonryEnabled = !1, this.$content.find(".vc_visible-item, .vc_grid_filter-item").removeClass("vc_visible-item vc_grid_filter-item"), this.filterValue = filter, this.$content.find(".vc_grid-item" + this.filterValue).addClass("vc_grid_filter-item"), this.filtered = !0, $(window).resize(this.setMasonry), this.setMasonry(), void _.defer(this.showItems))
		}, setItems    : function (els) {
			this.masonryEnabled ? this.$content.masonry("appended", els) : this.setMasonry()
		}, setMasonry  : function () {
			var animation, settings, windowWidth = window.innerWidth;
			windowWidth < vcGridSettings.mobileWindowWidth ? (this.$content.data("masonry") && this.$content.masonry("destroy"), this.masonryEnabled = !1) : this.masonryEnabled ? (this.$content.masonry("reloadItems"), this.$content.masonry("layout")) : (animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation"), settings = {
				itemSelector : ".vc_visible-item",
				isResizeBound: !1
			}, "none" == animation ? (settings.hiddenStyle = {visibility: "hidden"}, settings.visibleStyle = {visibility: "visible"}) : "fadeIn" == animation ? (settings.hiddenStyle = {opacity: 0}, settings.visibleStyle = {opacity: 1}) : (settings.hiddenStyle = {
				opacity  : 0,
				transform: "scale(0.001)"
			}, settings.visibleStyle = {
				opacity  : 1,
				transform: "scale(1)"
			}), this.$content.masonry(settings), this.masonryEnabled = !0)
		}
	})
}(jQuery);

var vcGridStyleLoadMoreMasonry;
!function ($) {
	vcGridStyleLoadMoreMasonry = function (grid) {
		this.grid = grid, this.settings = grid.settings, this.$loadMoreBtn = !1, this.$el = !1, this.filterValue = null, this.$content = !1, this.isLoading = !1, this.filtered = !1, this.$loader = $('<div class="vc_grid-loading"></div>'), this.masonryEnabled = !1, _.bindAll(this, "setMasonry"), this.init()
	}, vcGridStyleLoadMoreMasonry.prototype = _.extend({}, vcGridStyleLoadMore.prototype, {
		updateHeight: function () {
			// var $this = this;
			// var old_height = $this.$el.height();
			// setTimeout(function () {
			// 	var new_height = $this.$el.css('height', 'auto').height();
			// 	$this.$el.height(old_height);
			// 	$this.$el.animate({
			// 		'height' : new_height
			// 	}, 300);
			// }, 500);
		},

		showItems     : function () {
			if (!0 === this.isLoading)return !1;
			this.setIsLoading();
			var $els = this.$content.find(".vc_grid_filter-item:not(.vc_visible-item):lt(" + this.settings.items_per_page + ")"), self = this;
			$els.imagesLoaded(function () {
				$els.addClass("vc_visible-item"), self.setItems($els), self.filtered && (self.filtered = !1, self.setMasonry(), window.vc_prettyPhoto(), floral.core.do_prettyphoto()), self.unsetIsLoading(), $(window).trigger("grid:items:added", self.$el)
			}), this.updateHeight()
		},
		filter        : function (filter) {
			return filter = _.isUndefined(filter) || "*" === filter ? "" : filter, this.filterValue == filter ? !1 : (this.$content.data("masonry") && this.$content.masonry("destroy"), this.masonryEnabled = !1, this.$content.find(".vc_visible-item, .vc_grid_filter-item").removeClass("vc_visible-item vc_grid_filter-item"), this.filterValue = filter, this.$content.find(".vc_grid-item" + this.filterValue).addClass("vc_grid_filter-item"), this.filtered = !0, $(window).resize(this.setMasonry), this.setMasonry(), void this.showItems())
		},
		setIsLoading  : function () {
			this.$el.append(this.$loader), this.$loadMoreBtn && this.$loadMoreBtn.hide(), this.isLoading = !0
		},
		unsetIsLoading: function () {
			this.isLoading = !1, this.$loader && this.$loader.remove(), this.setLoadMoreBtn()
		},
		setItems      : function (els) {
			this.masonryEnabled ? this.$content.masonry("appended", els) : this.setMasonry()
		},
		setMasonry    : function () {
			var animation, settings, windowWidth = window.innerWidth;
			windowWidth < vcGridSettings.mobileWindowWidth ? (this.$content.data("masonry") && this.$content.masonry("destroy"), this.masonryEnabled = !1) : this.masonryEnabled ? (this.$content.masonry("reloadItems"), this.$content.masonry("layout")) : (animation = this.$content.parents(".vc_grid-container").data("initial-loading-animation"), settings = {
				itemSelector : ".vc_visible-item",
				isResizeBound: !1
			}, "none" == animation ? (settings.hiddenStyle = {visibility: "hidden"}, settings.visibleStyle = {visibility: "visible"}) : "fadeIn" == animation ? (settings.hiddenStyle = {opacity: 0}, settings.visibleStyle = {opacity: 1}) : (settings.hiddenStyle = {
				opacity  : 0,
				transform: "scale(0.001)"
			}, settings.visibleStyle = {
				opacity  : 1,
				transform: "scale(1)"
			}), this.$content.masonry(settings), this.masonryEnabled = !0)
		}
	})
}(jQuery);

var VcGrid, vcGridSettings = {
	addItemsAnimation   : "zoomIn",
	mobileWindowWidth   : 768,
	itemAnimationSpeed  : 1e3,
	itemAnimationDelay  : [],
	clearAnimationDelays: function () {
		_.each(this.itemAnimationDelay, function (id) {
			window.clearTimeout(id)
		}), this.itemAnimationDelay = []
	}
};
!function ($) {
	"use strict";
	function Plugin(option) {
		return this.each(function () {
			var $this = $(this), data = $this.data("vcGrid");
			data || $this.data("vcGrid", data = new VcGrid(this)), "string" == typeof option && data[option]()
		})
	}

	VcGrid = function (el) {
		this.$el = $(el), this.settings = {}, this.$filter = !1, this.gridBuilder = !1, this.init()
	}, VcGrid.prototype.init = function () {
		_.bindAll(this, "filterItems", "filterItemsDropdown"), this.setSettings(), this.initStyle(), this.initHover(), this.initZoneLink()
	}, VcGrid.prototype.setSettings = function () {
		this.settings = $.extend({visible_pages: 5}, this.$el.data("vcGridSettings") || {})
	}, VcGrid.prototype.initStyle = function () {
		var styleObject = this.settings.style ? $.camelCase("vc-grid-style-" + this.settings.style) : !1;
		styleObject && !_.isUndefined(window[styleObject]) && window[styleObject].prototype.render && (this.gridBuilder = new window[styleObject](this), this.gridBuilder.render())
	}, VcGrid.prototype.initFilter = function () {
		this.$filter = this.$el.find("[data-vc-grid-filter]"), this.$filterDropdown = this.$el.find("[data-vc-grid-filter-select]"), this.$filter.length && this.$filter.find(".vc_grid-filter-item").unbind("click").click(this.filterItems), this.$filterDropdown.length && this.$filterDropdown.unbind("change").change(this.filterItemsDropdown)
	}, VcGrid.prototype.initHover = function () {
		this.$el.on("mouseover", ".vc_grid-item-mini", function () {
			var $this = $(this);
			$this.addClass("vc_is-hover")
		}).on("mouseleave", ".vc_grid-item-mini", function () {
			var $this = $(this);
			$this.removeClass("vc_is-hover")
		})
	}, VcGrid.prototype.initZoneLink = function () {
		window.vc_iframe ? (this.$el.on("click.zonePostLink", "[data-vc-link]", function () {
			var href = ($(this), $(this).data("vcLink"));
			window.open(href)
		}), this.$el.on("click", ".vc_gitem-link", function (e) {
			var $this = $(this);
			e.preventDefault(), !$this.hasClass("vc-gitem-link-ajax") && window.open($this.attr("href"))
		})) : this.$el.on("click.zonePostLink", "[data-vc-link]", function () {
			var $this = $(this), href = $(this).data("vcLink");
			"_blank" === $this.data("vcTarget") ? window.open(href) : window.location.href = href
		})
	}, VcGrid.prototype.initHover_old = function () {
		this.$el.on("mouseover", ".vc_grid-item", function () {
			var $this = $(this);
			$this.hasClass("vc_is-hover") || (vcGridSettings.clearAnimationDelays(), $this.addClass("vc_is-hover vc_is-animated"), $this.find(".vc_grid-item-row-animate").each(function () {
				var $animate = $(this), animationIn = $animate.data("animationIn"), animationOut = $animate.data("animationOut");
				$animate.removeClass(animationOut).addClass(animationIn), vcGridSettings.itemAnimationDelay.push(_.delay(function () {
					$animate.removeClass(animationIn), $this.removeClass("vc_is-animated")
				}, vcGridSettings.itemAnimationSpeed))
			}))
		}).on("mouseleave", ".vc_grid-item", function () {
			var $this = $(this);
			vcGridSettings.clearAnimationDelays(), $this.addClass("vc_is-animated").removeClass("vc_is-hover"), $this.find(".vc_grid-item-row-animate").each(function () {
				var $animate = $this.find(".vc_grid-item-row-animate"), animationOut = $animate.data("animationOut"), animationIn = $animate.data("animationIn");
				$animate.addClass(animationOut), vcGridSettings.itemAnimationDelay.push(_.delay(function () {
					$animate.removeClass(animationOut + " " + animationIn), $this.removeClass("vc_is-animated")
				}, vcGridSettings.itemAnimationSpeed - 1))
			})
		})
	}, VcGrid.prototype.filterItems = function (e) {
		var $control = (this.style ? $.camelCase("filter-" + this.style) : "filterAll", $(e.currentTarget).find("[data-vc-grid-filter-value]")), filter = $control.data("vcGridFilterValue");
		return e && e.preventDefault(), $control.hasClass("vc_active") ? !1 : (this.$filter.find(".vc_active").removeClass("vc_active"), this.$filterDropdown.find(".vc_active").removeClass("vc_active"), this.$filterDropdown.find('[value="' + filter + '"]').addClass("vc_active").attr("selected", "selected"), $control.parent().addClass("vc_active"), void this.gridBuilder.filter(filter))
	}, VcGrid.prototype.filterItemsDropdown = function (e) {
		var $control = this.$filterDropdown.find(":selected"), filter = $control.val();
		return $control.hasClass("vc_active") ? !1 : (this.$filterDropdown.find(".vc_active").removeClass("vc_active"), this.$filter.find(".vc_active").removeClass("vc_active"), this.$filter.find('[data-vc-grid-filter-value="' + filter + '"]').parent().addClass("vc_active"), $control.addClass("vc_active"), void this.gridBuilder.filter(filter))
	}, VcGrid.prototype.ajax = function (data, callback) {
		var requestData;
		_.isUndefined(data) && (data = {}), requestData = _.extend({
			action    : "vc_get_vc_grid_data",
			vc_action : "vc_get_vc_grid_data",
			tag       : this.settings.tag,
			data      : this.settings,
			vc_post_id: this.$el.data("vcPostId"),
			_vcnonce  : this.$el.data("vcPublicNonce")
		}, data), $.ajax({
			type    : "POST",
			dataType: "html",
			url     : this.$el.data("vcRequest"),
			data    : requestData
		}).done(callback)
	}, $.fn.vcGrid = Plugin, $.fn.vcGrid.Constructor = VcGrid, $(document).ready(function () {
		$("[data-vc-grid-settings]").vcGrid()
	})
}(jQuery);
