/**
 * Created by Peter Mai on 7/12/2016.
 */

(function ($) {
	'use strict';

	window.FloralBackendVcDivContentView = window.VcColumnView.extend({
		events: {
			'click > .vc_controls.floral-div-content-controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls.floral-div-content-controls [data-vc-control="add"]'   : "addElement",
			'click > .vc_controls.floral-div-content-controls [data-vc-control="edit"]'  : "editElement",
			'click > .vc_controls.floral-div-content-controls [data-vc-control="clone"]' : "clone",
			"click > .wpb_element_wrapper > .vc_empty-container"                         : "addToEmpty"
		}
	});
	window.FloralBackendVcDivWrapperView = window.VcColumnView.extend({
		events: {
			'click > .vc_controls.floral-div-wrapper-controls [data-vc-control="delete"]': "deleteShortcode",
			'click > .vc_controls.floral-div-wrapper-controls [data-vc-control="add"]'   : "addElement",
			'click > .vc_controls.floral-div-wrapper-controls [data-vc-control="edit"]'  : "editElement",
			'click > .vc_controls.floral-div-wrapper-controls [data-vc-control="clone"]' : "clone",
			"click > .wpb_element_wrapper > .vc_empty-container"                         : "addToEmpty"
		}
	});

	window.VcGitemZoneViewCustom = window.VcColumnView.extend({
		addElement           : function (e) {
			var row;
			e && e.preventDefault(), vc.storage.lock(), row = vc.shortcodes.create({
				shortcode: "vc_gitem_row",
				params   : _.extend({}, vc.getDefaults("vc_gitem_row")),
				parent_id: this.model.get("id")
			}), vc.shortcodes.create({
				shortcode: "vc_gitem_col",
				params   : _.extend({width: "1/1"}, vc.getDefaults("vc_gitem_col")),
				parent_id: row.get("id")
			})
		}, buildDesignHelpers: function () {
			var matches, featuredImage, image, color, css = this.model.getParam("css"), $before = this.$el.find("> .vc_controls").get(0);
			var auto_feature_heading = this.model.view.params.auto_feature.heading;
			var auto_feature = this.model.getParam("auto_feature");
			var auto_feature_string = this.model.view.params.auto_feature.options[auto_feature];
			var $auto_feature_stt = this.$el.find('>.auto-feature-area');
			if ($auto_feature_stt.length > 0) {
				$auto_feature_stt.find('.__value').html(auto_feature_string)
			} else {
				$auto_feature_stt = this.$el.prepend('<div class="auto-feature-area"> <div class="__inner">' + auto_feature_heading + ': <span class="__value">' + auto_feature_string + '</span></div></div>');
			}
			auto_feature == 'auto' && this.$el.addClass('floral-auto-feature');
			auto_feature == 'manual' && this.$el.removeClass('floral-auto-feature');

			featuredImage = this.model.getParam("featured_image"),
				this.$el.find('> [data-vc-helper="color"]').remove(),
				this.$el.find('> [data-vc-helper="image"]').remove(),
				this.$el.find('> [data-vc-helper="image-featured"]').remove(),
				matches = css.match(/background\-image:\s*url\(([^\)]+)\)/),
			matches && !_.isUndefined(matches[1]) && (image = matches[1]),
				matches = css.match(/background\-color:\s*([^\s\;]+)\b/),
			matches && !_.isUndefined(matches[1]) && (color = matches[1]),
				matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/),
			matches && !_.isUndefined(matches[1]) && (color = matches[1], image = matches[2]),
			image && $('<span class="vc_css-helper vc_image-helper" data-vc-helper="image" style="background-image: url(' + image + ');" title="' + i18nLocale.column_background_image + '"></span>').insertBefore($before),
			color && $('<span class="vc_css-helper vc_color-helper" data-vc-helper="color" style="background-color: ' + color + '" title="' + i18nLocale.column_background_color + '"></span>').insertBefore($before),
			"yes" === featuredImage && $('<span class="vc_css-helper vc_featured" data-vc-helper="image-featured"></span>').insertBefore($before)
		}
	});

	window.FloralContentTemplateView = window.vc.shortcode_view.extend({
		changeShortcodeParams: function (model) {
			window.FloralContentTemplateView.__super__.changeShortcodeParams.call(this, model);
			var $wrapper = this.$el.parents('.wpb_element_wrapper'),
				$container = this.$el.find('.wpb_element_wrapper'),
				$row = this.$el.parents('.wpb_vc_row');
			this.$el.addClass('vc-non-draggable');
			if (this.model.getParam('outside_row') === 'true') {
				$row.find('a.set_columns.l_11').trigger('click');
				setTimeout(function () {
					$row.find('.vc_row_layouts').hide();
					$row.find('.vc_control-column').hide();
					$row.find('.vc_column-add').hide();
					$row.find('.vc_row_edit_clone_delete .vc_column-clone, .vc_row_edit_clone_delete .vc_column-edit, .vc_row_edit_clone_delete .vc_column-toggle').hide();
					$wrapper.css('padding', '0');
					$container.css('backgroundColor', '#F5F5F5');
				}, 500);
			} else {
				$row.find('.vc_row_layouts').show();
				$row.find('.vc_control-column').show();
				$row.find('.vc_column-add').show();
				$row.find('.vc_row_edit_clone_delete .vc_column-clone, .vc_row_edit_clone_delete .vc_column-edit, .vc_row_edit_clone_delete .vc_column-toggle').show();
				$wrapper.removeAttr('style');
				$container.removeAttr('style');
			}
		},
		deleteShortcode      : function (e) {
			return false;
		},
		clone                : function (e) {
			return false;
		}
	});

	window.FloralMainNavView = window.vc.shortcode_view.extend({
		changeShortcodeParams: function (model) {
			window.FloralContentTemplateView.__super__.changeShortcodeParams.call(this, model);
			var $wrapper = this.$el.parents('.wpb_element_wrapper'),
				$container = this.$el.find('.wpb_element_wrapper'),
				$row = this.$el.parents('.wpb_vc_row');
			this.$el.addClass('vc-non-draggable');
			setTimeout(function () {
				$row.find('.vc_row_layouts').hide();
				$row.find('.vc_control-column').hide();
				$row.find('.vc_column-add').hide();
				$row.find('.vc_row_edit_clone_delete').hide();
				$row.find('.vc_controls-row').hide();
				$wrapper.css('padding', '0');
				$container.css('backgroundColor', '#F5F5F5');
			}, 500);
		}
	});

	//Fix visual composer lag

	vc.events.on("vc:access:backend:ready", function (access) {
		var $vc_container = $('#wpb_visual_composer');

		$(window).on('load', function () {
			if ($vc_container.css('display') === 'block') {
				vc.events.trigger("vc:backend_editor:switch");
				setTimeout(function () {
					vc.events.trigger("vc:backend_editor:switch");
				}, 100);
			}
		})
	});

})(jQuery);