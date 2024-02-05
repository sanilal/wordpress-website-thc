/**
 * Created by Thang X. Vu on 5/12/2016.
 */

var floral_admin = {};

(function ($, window) {
	"use strict";
	var $body = $(document.body);
	floral_admin = {
		onReady: function () {
			//widget multi select
			$(document).on('widget-added', floral_admin.widget_select2);
			$(document).on('widget-updated', floral_admin.widget_select2);
			floral_admin.widget_select2();
			floral_admin.select2_type_multi_remove_selected();
			// floral_admin.select2_type_single();

			$(document).on('widget-added', floral_admin.widget_do_slider);
			$(document).on('widget-updated', floral_admin.widget_do_slider);
			floral_admin.widget_do_slider();

			// file selector
			$(document).on('widget-added widget-updated', floral_admin.widget_file_selector);
			floral_admin.widget_file_selector();
			//color picker
			$(document).on('widget-added widget-updated', floral_admin.widget_color_picker);
			floral_admin.widget_color_picker();
			// widget dependency
			$(document).on('widget-added widget-updated', function () {
				floral_admin.widget_dependency();
			});
			floral_admin.widget_dependency();
		},

		advance_menu: function (item_id, depth, title) {
			var form = $('#floral-advance-menu-form');
			var container = $('#floral-advance-menu-form-container');
			//Save item setting
			function SaveMenuItem() {
				container.removeClass('active');
				var floral_menu_item_submit_data = form.serialize();
				$.post(
					ajaxurl,
					{
						'action'                      : 'floral_save_advance_menu_item_setting',
						'floral_menu_item_id'         : item_id,
						'floral_menu_item_submit_data': floral_menu_item_submit_data
					},
					function (response) {
						if (response == '') {
							dialog.dialog("close");
						}
						else {
							alert(response);
						}
					}
				);
				//Highlight edited item
				var $menuitem = $('#menu-item-' + item_id);
				$menuitem.addClass('floral-edited');
				setTimeout(function () {
					$menuitem.removeClass('floral-edited')
				}, 2500);
			}

			//Get item setting
			function GetMenuItem() {
				$('body').addClass("advance-menu-on");
				$.post(
					ajaxurl,
					{
						'action'                : 'floral_get_advance_menu_item_setting',
						'floral_menu_item_id'   : item_id,
						'floral_menu_item_depth': depth
					},
					function (response) {
						form.html(response);
						container.addClass('active');
					}
				);
			}

			//Prevent submit default
			form.on('submit', function (event) {
				event.preventDefault();
				SaveMenuItem();
			});

			//Show dialog
			var dialog = $("#floral-advance-menu-form-container").dialog({
				autoOpen: false,
				height  : 700,
				width   : 500,
				modal   : true,
				title   : title,
				buttons : {
					"Save": SaveMenuItem,
					Cancel: function () {
						dialog.dialog("close");
					}
				},
				open    : GetMenuItem,
				close   : function () {
					container.removeClass('active');
					$('body').removeClass("advance-menu-on");
				}
			});
			dialog.dialog("open");
		},

		icon_picker: function (selector) {
			selector = typeof selector !== 'undefined' ? selector : '';
			$('.floral-icon-picker' + selector).each(function (index) {
				var $this = $(this),
					$icon_lib = $this.find('.floral-icon-picker-lib'),
					$input_area = $this.find('.picker-input'),
					$preview_area = $this.find('.picker-preview i'),
					$pick_button = $this.find('.picker-pick'),
					$remove_button = $this.find('.picker-remove'),
					icon_picker_table_class = 'floral_icon_picker_table';
				$icon_lib.find("option[value=" + $icon_lib.val() + "]").attr('selected', true);

				function update_area($table) {
					var classname = $table.find('.icon-container.active i').attr('class');
					if (!classname) {
						return;
					}
					$input_area.val(classname);
					$preview_area.attr('class', classname);
				}

				function reset_picker() {
					$input_area.val('');
					$preview_area.attr('class', '');
				}

				function focus_action($table) {
					var classes = $input_area.val();
					if (classes) {
						var selector = '.' + classes.replace(' ', '.');

						$table.find(selector).parent('.icon-container').addClass('active');
					}
				}

				function init_action(icon_lib_val) {
					var $table;
					//Create container
					var content = '<div class=' + '"' + icon_picker_table_class + '"' + 'data-icon-picker-lib=' + '"' + icon_lib_val + '"' + '>' +
						'<div class="floral-waiting-overlay"><span class="spinner"></span></div>' +
						'<div class="floral-icon-picker-filter-wrapper"><input type="text" class="floral-icon-picker-filter"/></div>' +
						'<style class="floral-inline-filter-style"></style>' +
						'<div class="floral-icon-picker-content"></div>' +
						'</div>';
					$table = $('body').append(content).children('.' + icon_picker_table_class + '[data-icon-picker-lib="' + icon_lib_val + '"]');

					//load from ajax
					$.post(
						ajaxurl,
						{
							'action'                : 'floral_html_icon_list',
							'floral_icon_picker_lib': icon_lib_val
						},
						//init
						function (response) {
							// Set up the page after response
							$table.find('.floral-icon-picker-content').html(response);
							$table.addClass('floral-remove-waiting');
							$table.find('.icon-container').on('click', function (event) {
								event.preventDefault();
								$(this).addClass('active').siblings().removeClass('active');
							});
							var $stylearea = $table.find('.floral-inline-filter-style');
							$table.find('.floral-icon-picker-filter').on('keyup', function (event) {
								var value = $(this).val();

								if (value) {
									var cssstring = '.' + icon_picker_table_class + '[data-icon-picker-lib="' + icon_lib_val + '"] ' + '.floral-icon-picker-content .icon-container:not([title*="' + value + '"]){' +
										'display : none;' +
										'}';
									$stylearea.html(cssstring);
								} else {
									$stylearea.html('');
								}
							})
						}
					);

					return $table;
				}

				function open_action() {
					var icon_lib_val = $icon_lib.val();
					var $table = $('.' + icon_picker_table_class + '[data-icon-picker-lib="' + icon_lib_val + '"]');

					if ($table.length < 1) {
						var $table = init_action(icon_lib_val);
					}

					return $table;
				}

				function open_dialog() {
					var $table = open_action();
					var dialog = $table.dialog({
						autoOpen: false,
						width   : 800,
						height  : 800,
						modal   : true,
						open    : function () {
							focus_action($table);
							var $container = $table,
								$icon_filter_block = $container.find('.floral-icon-picker-filter-wrapper'),
								$icon_list_block = $container.find('.floral-icon-picker-content');
							$icon_list_block.css({
								'max-height': $container.height() - $icon_filter_block.height(),
								'overflow'  : 'auto'
							});
						},
						buttons : {
							Select: function () {
								update_area($table);
								dialog.dialog("close")
							},
							Cancel: function () {
								dialog.dialog("close");
							}
						},
						close   : function () {
							$table.find('.icon-container').removeClass('active');
						}
					});
					dialog.dialog('open');

				}

				$pick_button.on('click', function (event) {
					event.preventDefault();
					open_dialog();
				});
				$remove_button.on('click', function (event) {
					event.preventDefault();
					reset_picker();
				})
			})
		},

		media_picker: function (selector) {
			selector = typeof selector !== 'undefined' ? selector : '';
			$('.floral-media-picker' + selector).each(function (index) {
				var $this = $(this),
					media_frame = false,
					$select_button = $this.find('.floral-select-button'),
					$reset_button = $this.find('.floral-reset-button'),
					$input_field = $this.find('.floral-media-input'),
					$preview_area = $this.find('.floral-preview-area'),
					multiple = $this.data('multiple') ? true : false,
					add_selection = $this.data('add-selection') ? true : false;

				function open_action() {
					if (!media_frame) {
						init_action();
					}
					media_frame.open();
				}

				function init_action() {
					media_frame = wp.media({
						title   : 'Select or Upload Media',
						button  : {
							text: 'Use this media'
						},
						multiple: multiple  // Set to true to allow multiple files to be selected
					});

					media_frame.on('select', function () {
						var attachments = media_frame.state().get('selection').toJSON();
						var preview_content = [];
						var input_value = [];

						if (add_selection) {
							var old_content = $preview_area.html();
							var old_value = $input_field.val();

							if (old_content.length > 0) {
								preview_content.push(old_content);
							}
							if (old_value.length > 0) {
								input_value.push(old_value);
							}
						}

						for (var key in attachments) {
							// Send the attachment URL to our custom image input field.
							preview_content.push('<img src="' + attachments[key].url + '" alt=""/>');

							// Send the attachment id to our hidden input
							input_value.push(attachments[key].url)
						}
						$preview_area.html(preview_content.join(''));
						$input_field.val(input_value.join('||'));
					});
				}

				function reset_action() {
					$preview_area.html('');
					$input_field.val('');
				}

				$select_button.on('click', function (event) {
					event.preventDefault();
					open_action();
				});

				$reset_button.on('click', function (event) {
					event.preventDefault();
					reset_action();
				});
			});
		},

		widget_file_selector: function (event, widget) {
			if (typeof (widget) === 'undefined') {
				if ($('#widgets-right').length > 0) {
					$('#widgets-right .floral-file-selector:not(.ready)').each(function () {
						floral_admin.file_selector($(this));
					});
				} else {
					$('.floral-file-selector:not(.ready)').each(function () {
						floral_admin.file_selector($(this));
					});
				}
			} else {
				$('.floral-file-selector:not(.ready)', widget).each(function () {
					floral_admin.file_selector($(this));
				});
			}
		},

		file_selector: function ($target) {
			if (typeof ($target) == 'undefined') {
				$target = $('.floral-file-selector:not(.ready)');
			}

			$target.each(function () {
				var $this = $(this),
					selector_frame = false,
					is_img_selector = $this.hasClass('floral-image-selector') ? true : false,
					$select_btn = $this.find('.selector-btn'),
					$remove_btn = $this.find('.remove-btn'),
					$_input = $this.find('input[type="text"]');

				$this.addClass('ready');
				function remove_current_image() {
					var current_image = $this.find('img');
					if (current_image.length > 0) {
						current_image.remove();
					}
				}

				function frame_action() {
					if (selector_frame == false) {
						// Create a new media frame
						selector_frame = wp.media({
							title   : 'Select or Upload Media',
							button  : {
								text: 'Use this media'
							},
							multiple: false  // Set to true to allow multiple files to be selected
						});

						// When an image is selected in the media frame...
						selector_frame.on('select', function () {
							if (is_img_selector) {
								remove_current_image();
							}
							// Get media attachment details from the frame state
							var attachment = selector_frame.state().get('selection').first().toJSON();

							// Send the attachment URL to our custom image input field.
							if (is_img_selector) {
								$this.append('<img class="widget-image-selected" src="' + attachment.url + '" alt=""/>');
							}
							// Send the attachment id to our hidden input
							$_input.val(attachment.url);
						});
					}
					selector_frame.open();
				}

				// select action
				$select_btn.on('click', function () {
					frame_action();
				});

				//remove action
				$remove_btn.on('click', function () {
					$_input.val(null);
					if (is_img_selector) {
						remove_current_image();
					}
				})

			});
		},

		widget_color_picker: function (event, widget) {
			if (typeof (widget) === 'undefined') {
				if ($('#widgets-right').length > 0) {
					$('#widgets-right .floral-color-picker:not(.ready)').each(function () {
						floral_admin.color_picker($(this));
					});
				} else {
					$('.floral-color-picker:not(.ready)').each(function () {
						floral_admin.color_picker($(this));
					});
				}
			} else {
				$('.floral-color-picker:not(.ready)', widget).each(function () {
					floral_admin.color_picker($(this));
				});
			}
		},

		color_picker: function ($target) {
			if (typeof ($target) == 'undefined') {
				$target = $('.floral-color-picker:not(.ready)');
			}

			$target.each(function () {
				var $this = $(this);
				$this.find('.color-init').wpColorPicker(
					{
						change: function (e, ui) {
							$(this).val(ui.color.toString());
						},
						clear : function (e, ui) {
							$(this).val('');
						}
					}
				).addClass('ready');
			});
		},

		widget_select2: function (event, widget) {
			if (typeof (widget) === 'undefined') {
				if ($('#widgets-right').length > 0) {
					$('#widgets-right select.widget-select2:not(.select2-ready)').each(function () {
						floral_admin.widget_select2_item(this);
					});

					$('#widgets-right select.single-select2:not(.select2-ready)').each(function () {
						floral_admin.select2_type_single(this);
					});
				} else {
					$('select.widget-select2:not(.select2-ready)').each(function () {
						floral_admin.widget_select2_item(this);
					});

					$('select.single-select2:not(.select2-ready)').each(function () {
						floral_admin.select2_type_single(this);
					});
				}
			} else {
				$('select.widget-select2:not(.select2-ready)', widget).each(function () {
					floral_admin.widget_select2_item(this);
				});

				$('select.single-select2:not(.select2-ready)', widget).each(function () {
					floral_admin.select2_type_single(this);
				});
			}
		},

		widget_select2_item: function (target) {
			$(target).addClass('select2-ready');

			var data_value = $(target).attr('data-value');

			var choices = [];

			if (data_value != '') {
				var arr_data_value = data_value.split('||');

				for (var i = 0; i < arr_data_value.length; i++) {
					var option = $('option[value=' + arr_data_value[i] + ']', target);
					choices[i] = arr_data_value[i];
				}

			}

			$(target).select2({
				width                  : '100%',
				closeOnSelect          : true,
				minimumResultsForSearch: 20
			});
			$(target).val(choices).trigger('change');

			/*-------------------------------------
			 CHECK BOX SELECT ALL
			 ---------------------------------------*/
			var $checkbox = $(target).parent().find('input[type="checkbox"]');
			var $options = $(target).find('option');
			var $loaded_input = $(target).parent().find('input[type="hidden"]');

			var check_box = function (current) {
				if ($checkbox.length) {
					// console.log($options.length);
					// console.log(current);
					if ($options.length == current) {
						$checkbox.prop('checked', true);
					} else {
						$checkbox.prop('checked', false);
					}
				}
			};
			check_box($loaded_input.val().split("||").length);
			if ($checkbox.length) {
				$checkbox.on('click', function (e) {
					if ($checkbox.prop('checked')) {
						var ip = '';
						$options.each(function (index, value) {
							$(this).prop('selected', 'selected');
							if (index != 0) {
								ip += '||';
							}
							if (value != '') {
								ip += $(this).val()
							}
						});
						$(target).change();
						$loaded_input.val(ip);
					} else {
						$options.removeAttr('selected');
						$(target).change();
						$loaded_input.val(null);
					}
				})
			}
			/*-------------------------------------
			 select2 v3.5.2
			 ---------------------------------------*/
			// $(target).on("select2-selecting", function (e) {
			// 	var ids = $('input[type="hidden"]', $(this).parent()).val();
			// 	if (ids != "") {
			// 		ids += "||";
			// 	}
			// 	ids += e.choice.id;
			// 	$('input[type="hidden"]', $(this).parent()).val(ids);
			// 	check_box(ids.split('||').length);
			// }).on("select2-removed", function (e) {
			// 	var ids = $('input[type="hidden"]', $(this).parent()).val();
			// 	var arr_ids = ids.split("||");
			// 	var newIds = "";
			// 	for (var i = 0; i < arr_ids.length; i++) {
			// 		if (arr_ids[i] != e.choice.id) {
			// 			if (newIds != "") {
			// 				newIds += "||";
			// 			}
			// 			newIds += arr_ids[i];
			// 		}
			// 	}
			// 	$('input[type="hidden"]', $(this).parent()).val(newIds);
			// 	check_box(newIds.split('||').length);
			// });

			/*-------------------------------------
			 SELECT 2 v4.0.2
			 ---------------------------------------*/
			$(target).on("select2:select", function (e) {
				var ids = $('input[type="hidden"]', $(this).parent()).val();
				if (ids != "") {
					ids += "||";
				}
				ids += e.params.data.id;
				$('input[type="hidden"]', $(this).parent()).val(ids);
				check_box(ids.split('||').length);
			}).on("select2:unselect", function (e) {
				// console.log('asd');
				var ids = $('input[type="hidden"]', $(this).parent()).val();
				var arr_ids = ids.split("||");
				var newIds = "";
				for (var i = 0; i < arr_ids.length; i++) {
					if (arr_ids[i] != e.params.data.id) {
						if (newIds != "") {
							newIds += "||";
						}
						newIds += arr_ids[i];
					}
				}
				$('input[type="hidden"]', $(this).parent()).val(newIds);
				check_box(newIds.split('||').length);
			});


			/*-------------------------------------
			 TOGGLE SELECT2-DROP
			 ---------------------------------------*/
			// $(document).on('click', function (e) {
			// 	if ($('.vc_ui-panel-window').length !== 0) {
			// 		// $(target).select2('close');
			// 	}
			// });
		},

		select2_type_multi_remove_selected: function () {
			$('select[multiple=multiple]').each(function () {
				$(this).on("select2:select", function (evt) {
					var element = evt.params.data.element;
					var $element = $(element);
					$element.detach();
					$(this).append($element);
					$(this).trigger("change");
				});
			});
		},

		select2_type_single: function (target) {
			$(target).addClass('select2-ready');

			var data_value = $(target).attr('data-value');

			var choices = '';

			if (data_value != '') {
				choices = data_value;
			}

			$(target).select2({
				width                  : '100%'
				// closeOnSelect          : true,
				// minimumResultsForSearch: 20
			});
			$(target).val(choices).trigger('change');
			$(target).on("select2:select", function (e) {
				var id = e.params.data.id;
				$('input[type="hidden"]', $(this).parent()).val(id);
			});
		},

		do_switcher: function ($switcher_wrapper) {
			if ($switcher_wrapper.length > 0) {
				$switcher_wrapper.each(function () {
					var $this = $(this),
						$hidden_input = $this.find('input[type="hidden"]');

					$this.buttonset();

					$this.find('label').each(function () {
						var $label = $(this),
							_for = $label.attr('for');

						$label.on('click', function () {
							$hidden_input.val(get_input_val(_for));
							$hidden_input.trigger('change');
						});
					});

					function get_input_val(id) {
						return $this.find('input#' + id).val();
					}
				});
			}
		},

		widget_do_slider: function () {
			$('#widgets-right .floral-param-slider:not(.slider-ready)').each(function () {
				floral_admin.do_slider($(this));
			});
		},

		do_slider: function ($slider_wrapper) {
			if ($slider_wrapper.length > 0) {
				$slider_wrapper.each(function () {
					var $this = $(this),
						$slider_object = $this.find('.slider-object'),
						$_input = $this.find('.slider-value'),
						data_slider = $this.attr('data-slider');

					$this.addClass('slider-ready');

					try {
						data_slider = $.parseJSON(data_slider);
					} catch (e) {
						data_slider = {
							unit: '',
							min : 0,
							max : 1,
							step: 0.1
						}
					}

					var current_value = $_input.val();
					if (data_slider.unit !== '') {
						current_value = current_value.replace(data_slider.unit, '');
					}

					// clear the current value
					current_value = parseFloat(current_value);
					if (!isNaN(current_value)) {
						if (current_value < data_slider.min) {
							current_value = data_slider.min
						}
						if (current_value > data_slider.max) {
							current_value = data_slider.max
						}
					} else {
						current_value = data_slider.min;
						$_input.val(current_value + data_slider.unit);
					}

					$slider_object.slider({
						value: current_value,
						min  : data_slider.min,
						max  : data_slider.max,
						step : data_slider.step,
						slide: function (e, ui) {
							$_input.val(ui.value + data_slider.unit);
						}
					});
				});
			}
		},

		do_buttonset: function ($buttonset_wrapper) {
			if ($buttonset_wrapper.length > 0) {
				$buttonset_wrapper.each(function () {
					var $this = $(this),
						$hidden_input = $this.find('input[type="hidden"]'),
						multiple = $buttonset_wrapper.attr('data-multiple');

					$this.buttonset();

					$this.find('label').each(function () {
						var $label = $(this),
							_for = $label.attr('for');

						$label.on('click', function () {
							var hidden_input_val = $hidden_input.val(),
								_input_val = get_input_val(_for),
								_hid_vals = hidden_input_val.split('||'),
								find_index = $.inArray(_input_val, _hid_vals);

							if (multiple == 'true') {
								if ($label.hasClass('ui-state-active')) {
									if (find_index > -1) {
										_hid_vals.splice(find_index, 1);
									}
									hidden_input_val = _hid_vals.join('||');
								} else {
									if (hidden_input_val == '') {
										hidden_input_val = _input_val;
									} else {
										if (find_index == -1) {
											hidden_input_val += '||' + _input_val;
										}
									}
								}
								$hidden_input.val(hidden_input_val);
							} else {
								$hidden_input.val(_input_val);
							}
							$hidden_input.trigger('change');
						});
					});
					function get_input_val(id) {
						return $this.find('input#' + id).val();
					}
				});
			}
		},

		widget_dependency: function () {
			if ($body.hasClass('widgets-php')) {
				$('.widget-content:not(dep-ready)').each(function () {
					var $wrapper = $(this),
						$fields = $wrapper.find('.widget-field-wrapper');

					$wrapper.addClass('dep-ready');

					function check_dependencies($field) {
						if (!$field) return;
						var $this = $field,
							dep_el = $this.attr('dep_el'),
							dep_equal_to = $this.attr('dep_equal_to'),
							del_not_equal_to = $this.attr('dep_not_equal_to'),
							deps = get_deps($this);

						deps.push($this);

						function check_dep($target) {
							if (!$target) $target = $('#' + dep_el);
							var $target_wrapper = $target.parents('.widget-field-wrapper');
							var val = get_target_value($target);

							if (val !== null) {
								if (dep_equal_to) {
									if (check_value(val, dep_equal_to)) {
										if ($target_wrapper.css('display') !== 'none') {
											$this.slideDown();
										}
										for (var i = 0; i < deps.length; i++) {
											var field = deps[i].attr('data-id');
											$('#' + field).trigger('change');
										}
									} else {
										$this.slideUp();
										do_slideUp();
									}
								} else if (del_not_equal_to) {
									if (check_value(val, del_not_equal_to)) {
										$this.slideUp();
										do_slideUp();
									} else {
										if ($target_wrapper.css('display') !== 'none') {
											$this.slideDown();
										}
										for (var i = 0; i < deps.length; i++) {
											var field = deps[i].attr('data-id');
											$('#' + field).trigger('change');
										}
									}
								}
							}
						}

						function get_deps($current) {
							var current_id = $current.attr('data-id');
							var deps = [];
							if (current_id) {
								$fields.each(function () {
									var dep_el = $(this).attr('dep_el');
									if (current_id == dep_el) {
										deps.push($(this));
										deps = deps.concat(get_deps($(this)));
									}
								});
							}
							return deps;
						}

						function do_slideUp() {
							for (var i = 0; i < deps.length; i++) {
								deps[i].slideUp();
							}
						}

						function do_slideDown() {
							for (var i = 0; i < deps.length; i++) {
								deps[i].slideDown();
							}
						}

						if (dep_el && (dep_equal_to || del_not_equal_to)) {
							check_dep();

							$('#' + dep_el).on('change', function () {
								check_dep($(this));
							});

						}
					}

					function check_value(_current, _value) {
						if (typeof (_current) === 'object') {
							return _current.indexOf(_value) !== -1;
						} else {
							return _current == _value;
						}
					}

					function get_target_value($target) {
						var _data_type = $target.attr('data-type');

						switch (_data_type) {
							case 'text':
							case 'number':
							case "select":
							case "textarea":
							case 'number-slider':
							case 'file-selector':
							case 'image-selector':
							case 'icon-picker':
							case 'multi-select':
							case 'colorpicker':
								return $target.val();
								break;
							case 'checkbox':
								return $target.is(':checked');
								break;
							default:
								return null;
						}

					}

					$fields.each(function () {
						check_dependencies($(this));
					});
				});
			}
		}
	};

	$(document).ready(function () {
		floral_admin.onReady();
	})

})(jQuery, window);