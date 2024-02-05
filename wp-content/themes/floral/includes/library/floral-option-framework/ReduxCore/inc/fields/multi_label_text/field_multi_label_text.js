/*global redux_change, redux*/

(function ($) {
	"use strict";

	redux.field_objects = redux.field_objects || {};
	redux.field_objects.multi_label_text = redux.field_objects.multi_label_text || {};

	$(document).ready(
		function () {
			//redux.field_objects.multi_label_text.init();
		}
	);

	redux.field_objects.multi_label_text.init = function (selector) {

		if (!selector) {
			selector = $(document).find('.redux-container-multi_label_text:visible');
		}

		$(selector).each(
			function () {
				var el = $(this);
				var parent = el;
				if (!el.hasClass('redux-field-container')) {
					parent = el.parents('.redux-field-container:first');
				}
				if (parent.is(":hidden")) { // Skip hidden fields
					return;
				}
				if (parent.hasClass('redux-field-init')) {
					parent.removeClass('redux-field-init');
				} else {
					return;
				}
				el.find('.redux-multi-label-text-remove').live(
					'click', function () {
						redux_change($(this));
						$(this).prev('input[type="text"]').val('');
						$(this).parent().slideUp(
							'medium', function () {
								$(this).remove();
							}
						);
					}
				);

				function redux_color_init($element) {
					$element.find('.redux-color-init:not(.reserved)').each(function () {
						$(this).wpColorPicker(
							{
								change: function (e, ui) {
									$(this).val(ui.color.toString());
									redux_change($(this));
									el.find('#' + e.target.getAttribute('data-id') + '-transparency').removeAttr('checked');
								},
								clear : function (e, ui) {
									$(this).val('');
									redux_change($(this).parent().find('.redux-color-init'));
								}
							}
						);
					});
				}

				redux_color_init(el);

				el.find('.redux-multi-label-text-add').click(
					function () {
						var number = parseInt($(this).attr('data-add_number'));
						var id = $(this).attr('data-id');
						var name = $(this).attr('data-name');
						var count = el.find('#' + id + ' li').length;
						console.log(count);
						for (var i = 0; i < number; i++) {
							var new_input = $('#' + id + ' li:first-child').clone();
							new_input.find('.reserved').removeClass('reserved');
							el.find('#' + id).append(new_input);
							el.find('#' + id + ' li:last-child').removeAttr('style');
							el.find('#' + id + ' li:last-child input.regular-text').val('');
							el.find('#' + id + ' li:last-child input.regular-text').attr('name', name + '[' + count + '][label]');
							el.find('#' + id + ' li:last-child input.regular-text-content').val('');
							el.find('#' + id + ' li:last-child input.regular-text-content').attr('name', name + '[' + count + '][content]');
							redux_color_init(new_input);
						}
					}
				);


				el.find('.redux-color').on(
					'focus', function () {
						$(this).data('oldcolor', $(this).val());
					}
				);

				el.find('.redux-color').on(
					'keyup', function () {
						var value = $(this).val();
						var color = colorValidate(this);
						var id = '#' + $(this).attr('id');

						if (value === "transparent") {
							$(this).parent().parent().find('.wp-color-result').css(
								'background-color', 'transparent'
							);

							el.find(id + '-transparency').attr('checked', 'checked');
						} else {
							el.find(id + '-transparency').removeAttr('checked');

							if (color && color !== $(this).val()) {
								$(this).val(color);
							}
						}
					}
				);

				// Replace and validate field on blur
				el.find('.redux-color').on(
					'blur', function () {
						var value = $(this).val();
						var id = '#' + $(this).attr('id');

						if (value === "transparent") {
							$(this).parent().parent().find('.wp-color-result').css(
								'background-color', 'transparent'
							);

							el.find(id + '-transparency').attr('checked', 'checked');
						} else {
							if (colorValidate(this) === value) {
								if (value.indexOf("#") !== 0) {
									$(this).val($(this).data('oldcolor'));
								}
							}

							el.find(id + '-transparency').removeAttr('checked');
						}
					}
				);

				// Store the old valid color on keydown
				el.find('.redux-color').on(
					'keydown', function () {
						$(this).data('oldkeypress', $(this).val());
					}
				);
			}
		);
	};
})(jQuery);