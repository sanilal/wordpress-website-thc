/**
 * Created by Sinzii Rosy on 7/16/2016.
 */

var floral_redux = {};

(function ($) {
	'use strict';

	jQuery.fn.selectText = function () {
		var doc = document;
		var element = this[0];
		if (doc.body.createTextRange) {
			var range = document.body.createTextRange();
			range.moveToElementText(element);
			range.select();
		} else if (window.getSelection) {
			var selection = window.getSelection();
			var range = document.createRange();
			range.selectNodeContents(element);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	};

	floral_redux = {
		on_ready: function () {
			floral_redux.do_options_preset_management();
		},

		do_options_preset_management: function () {
			var $redux_ajax_overlay = $('#redux_ajax_overlay'),
				$redux_action_bar = $('.redux-action_bar'),
				$redux_notification_bar = $('#redux_notification_bar'),
				$floral_preset_management = $('.floral-preset-management');

			function do_start_process() {
				$redux_ajax_overlay.fadeIn();
				$redux_action_bar.find('.spinner').addClass('is-active');
				$redux_action_bar.find('input').attr('disabled', 'disabled');
				$floral_preset_management.find('.create-preset, .options-preset-select').attr('disabled', 'disabled');
			}

			function do_stop_process() {
				$redux_ajax_overlay.fadeOut();
				$redux_action_bar.find('.spinner').css('visibility', 'hidden');
				$redux_action_bar.find('input').prop('disabled', false);
				$floral_preset_management.find('.create-preset, .options-preset-select').prop('disabled', false);
			}

			function show_preset_switched_notice() {
				// if ($('#info_bar .redux-action_bar').attr('data-trigger-auto-save') == 'true') {
				// 	$redux_notification_bar.find('.action-trigger-auto-save').slideDown().delay(2000).slideUp();
				// } else {
				$redux_notification_bar.find('.preset_switched_notice').slideDown().delay(4000).slideUp();
				// }
			}

			function show_preset_created_successful_notice() {
				$redux_notification_bar.find('.admin-notice').slideUp();
				$redux_notification_bar.find('.preset_created_success').slideDown();
			}

			function show_action_notice(type) {
				$redux_notification_bar.find('.admin-notice').slideUp();
				if (type == 'success') {
					$redux_notification_bar.find('.action-success').slideDown().delay(4000).slideUp();
				} else if (type == 'error') {
					$redux_notification_bar.find('.action-error').slideDown().delay(4000).slideUp();
				} else if (type == 'success-redirect') {
					$redux_notification_bar.find('.action-success-redirect').slideDown().delay(4000).slideUp();
				}
			}

			function open_editing_opt_page(opt_name) {
				var url = window.location.href,
					target_url = url + ((url.indexOf('?') == -1) ? '?' : '&') + 'opt_name=' + opt_name;
				window.open(target_url, "_self");
			}

			function init_create_preset_form_action() {
				var $body = $('body'),
					$_create_form = $body.find('.floral-preset-form-wrapper');

				if ($_create_form.length == 0) {
					var _create_preset_template_form = $('#template-create-preset');
					$body.append(_create_preset_template_form.html());
					$_create_form = $body.find('.floral-preset-form-wrapper');
				}

				var _input_preset_title = $_create_form.find('input.preset-title'),
					_start_place_holder = _input_preset_title.attr('placeholder'),
					_input_preset_clone = $_create_form.find('select.preset-clone'),
					_input_preset_edit = $_create_form.find('input.preset-edit'),
					$_block_loading = $_create_form.find('.block-loading');


				function _create_form_dialog() {
					$_create_form.dialog({
						autoOpen : false,
						modal    : true,
						width    : 500,
						height   : 340,
						resizable: false,
						buttons  : [
							{
								text : 'Create preset',
								click: function () {
									$_create_form.find('.message').remove();
									do_create_preset();
								},
								class: 'ui-button-primary'
							},
							{
								text : 'Cancel',
								click: function () {
									$(this).dialog('close');
								}
							}
						]
					});

					$_create_form.on('invalid-input', function (e, $message, add_validate_class) {
						$(this).parent('.ui-dialog').effect('shake', 500);

						if (add_validate_class == true) {
							_input_preset_title.addClass('validate-error');
						}

						if ($message) {
							$_create_form.append($message);
						} else {
							$_create_form.append(floral_redux_extend_vars.error_message);
						}
					});

					_input_preset_clone.select2({
						width: '100%'
					});
					/*-------------------------------------
					 TOGGLE SELECT2-DROP
					 ---------------------------------------*/
					// $(document).on('click', function () {
					// 	_input_preset_clone.select2('close');
					// });

					_input_preset_title.on('keypress', function (e) {
						var code = String.fromCharCode(e.which);
						if (!code.match(/[\sA-Za-z0-9_+-]/))
							return false;

						if ($(this).text().trim().length > 30) {
							return false;
						}
					}).on('focus', function () {
						if ($(this).hasClass('validate-error')) {
							$(this).removeClass('validate-error');
							$(this).attr('placeholder', _start_place_holder);
						}
					});
				}

				function do_create_preset() {
					$_block_loading.fadeIn();

					var preset_title = _input_preset_title.val().trim(),
						preset_clone = _input_preset_clone.val(),
						preset_edit = _input_preset_edit.is(':checked');

					if (preset_title.length < 1) {
						$_create_form.trigger('invalid-input', floral_redux_extend_vars.validation_error_message);
						$_block_loading.fadeOut();
					} else {
						var data = {
							action      : 'do_create_preset',
							preset_title: preset_title,
							preset_clone: preset_clone,
							preset_edit : preset_edit
						};

						$.ajax({
							type    : 'POST',
							url     : floral_main_admin_vars.ajax_url,
							data    : data,
							success : function (resp) {
								try {
									resp = $.parseJSON(resp);

									switch (resp.status) {
										case 'validation-error':
											if (resp.message) {
												$_create_form.trigger('invalid-input', resp.message, true);
											} else {
												$_create_form.trigger('invalid-input', floral_redux_extend_vars.validation_error_message, true);
											}
											break;
										case 'success':
											$_create_form.dialog('close');
											show_preset_created_successful_notice();
											do_start_process();
											window.location.reload(true);
											break;
										case 'edit':
											$_create_form.dialog('close');
											do_start_process();
											show_preset_created_successful_notice();
											// open_editing_opt_page(resp.message);
											window.open(resp.message, "_self");
											break;
										default:
									}
								} catch (e) {
									$_create_form.trigger('invalid-input', e, false);
								}
							},
							error   : function (resp) {
								$_create_form.trigger('invalid-input', resp, false);
							},
							complete: function () {
								$_block_loading.fadeOut();
							}
						});
					}

				}

				function bind_events() {
					$floral_preset_management.on('click', 'button.create-preset', function (e) {
						e.preventDefault();
						$_create_form.find('.message').remove();
						$_create_form.dialog('open');
					});
				}

				_create_form_dialog();
				bind_events();
			}

			function do_select_preset_on_change() {
				$floral_preset_management.each(function () {
					var $this = $(this),
						$select_preset_box = $this.find('select.options-preset-select'),
						current_editing = $select_preset_box.val();

					$select_preset_box.on('change', function (e) {
						e.preventDefault();
						var selected = $select_preset_box.val();
						if (selected !== current_editing) {
							do_start_process();
							window.open(selected, "_self");
						}
					});
				});
			}

			function do_init_preset_manage_actions() {
				var $current_preset_wrapper = $('.floral_redux-current-preset'),
					$global_holder = $floral_preset_management.find('a.global-preset-title'),
					$_current_preset = $current_preset_wrapper.find('h3.current-preset'),
					$_action_edit = $current_preset_wrapper.find('.action-edit'),
					$_action_make_global = $current_preset_wrapper.find('.action-make-global'),
					$_action_remove = $current_preset_wrapper.find('.action-remove');

				function _start_action_process($target, remove_class) {
					do_start_process();
					$target.find('i').removeClass(remove_class).addClass('fa-spinner fa-spin');
				}

				function _stop_action_process($target, add_class) {
					do_stop_process();

					$target.find('i').removeClass('fa-spinner fa-spin').addClass(add_class);
				}

				$_action_make_global.on('click', function (e) {
					e.preventDefault();
					var $this = $(this);

					_start_action_process($this, 'fa-globe');

					var data = {
						action     : 'do_make_global_preset',
						preset_name: $_current_preset.attr('data-current-preset')
					};

					$.ajax({
						type    : 'GET',
						data    : data,
						url     : floral_main_admin_vars.ajax_url,
						success : function (resp) {
							try {
								resp = $.parseJSON(resp);
								if (resp.status) {
									$global_holder.text($_current_preset.text());
									show_action_notice('success');
									$this.fadeOut().parents('.hint').remove();
								} else {
									show_action_notice('error');
								}
							} catch (e) {
								show_action_notice('error');
							}
						},
						error   : function () {
							show_action_notice('error');
						},
						complete: function () {
							_stop_action_process($this, 'fa-globe');
						}
					});
				});

				$_action_remove.on('click', function (e) {
					e.preventDefault();

					var $this = $(this);

					if (confirm(floral_redux_extend_vars.confirm_remove_preset_message)) {
						_start_action_process($this, 'fa-trash-o');
						var data = {
							action     : 'do_remove_preset',
							preset_name: $_current_preset.attr('data-current-preset')
						};

						$.ajax({
							type   : 'GET',
							data   : data,
							url    : floral_main_admin_vars.ajax_url,
							success: function (resp) {
								try {
									resp = $.parseJSON(resp);
									if (resp.status) {
										if (resp.redirect) {
											show_action_notice('success-redirect');
											window.open(resp.redirect, "_self");
										} else {
											show_action_notice('success');
										}
									} else {
										show_action_notice('error');
										_stop_action_process($this, 'fa-trash-o');
									}
								} catch (e) {
									show_action_notice('error');
									_stop_action_process($this, 'fa-trash-o');
								}
							},
							error  : function () {
								show_action_notice('error');
								_stop_action_process($this, 'fa-trash-o');
							}
						});
					}

				});

				var old_preset_name = $_current_preset.text().trim();

				function reset_current_preset_holer_status() {
					$_current_preset.prop('contenteditable', false);
					$_current_preset.css('text-transform', 'uppercase');
					$_current_preset.text(old_preset_name);
				}

				$_current_preset.on('save-preset-name', function () {
					var $this = $(this);
					if ($this.text().trim() == old_preset_name) {
						$_action_edit.effect('shake', 500);
						return;
					}
					_start_action_process($_action_edit, 'fa-save fa-edit');


					var data = {
						action      : 'do_change_preset_title',
						preset_title: $this.text().trim(),
						preset_name : $this.attr('data-current-preset')
					};

					$.ajax({
						type   : 'GET',
						data   : data,
						url    : floral_main_admin_vars.ajax_url,
						success: function (resp) {
							try {
								resp = $.parseJSON(resp);

								if (resp.status) {
									show_action_notice('success-redirect');
									window.location.reload(true);
								} else {
									show_action_notice('error');
									reset_current_preset_holer_status();
									_stop_action_process($_action_edit, 'fa-edit');
								}
							} catch (e) {
								show_action_notice('error');
								reset_current_preset_holer_status();
								_stop_action_process($_action_edit, 'fa-edit');
							}
						},
						error  : function (resp) {
							show_action_notice('error');
							reset_current_preset_holer_status();
							_stop_action_process($_action_edit, 'fa-edit');
						}
					});
				});


				$_current_preset.on('keypress', function (e) {
					var code = String.fromCharCode(e.which);
					if (e.which == 13) {
						$(this).trigger('save-preset-name');
						return false;
					}

					if (!code.match(/[\sA-Za-z0-9_-]/))
						return false;

					if ($(this).text().trim().length > 30) {
						return false;
					}
				});

				$(document).on('click', function (e) {
					if ($(e.target).closest('.action-edit').length == 0 && $(e.target).closest('h3.current-preset').length == 0) {
						if ($_action_edit.find('i').hasClass('fa-save')) {
							reset_current_preset_holer_status();
							$_action_edit.find('i').removeClass('fa-save').addClass('fa-edit');
						}
					}
				});


				$_action_edit.on('click', function (e) {
					e.preventDefault();
					var $this = $(this),
						_inner_i = $this.find('i');

					if (_inner_i.hasClass('fa-edit')) {
						$_current_preset.prop('contenteditable', true);
						$_current_preset.css('text-transform', 'inherit');
						$_current_preset.trigger('focus').selectText();

						_inner_i.removeClass('fa-edit').addClass('fa-save');
					} else if (_inner_i.hasClass('fa-save')) {
						$_current_preset.trigger('save-preset-name');
					}
				});

			}

			function do_trigger_auto_save() {
				$redux_action_bar.each(function () {
					var $this = $(this);

					if ($this.attr('data-trigger-auto-save') == 'true') {
						$this.find('#button-generate-css').trigger('click');
					}

				});

			}

			show_preset_switched_notice();
			do_select_preset_on_change();
			do_init_preset_manage_actions();
			init_create_preset_form_action();
			do_trigger_auto_save();
		},

		do_init_generate_css_action: function () {
			$('button.floral-btn-generate-presets-css').each(function () {
				var $this = $(this),
					$redux_ajax_overlay = $('#redux_ajax_overlay'),
					$redux_action_bar = $('.redux-action_bar'),
					$logging_wrapper = $this.parent().find('.logging-panel');

				$this.on('click', function (e) {
					e.preventDefault();

					if (!is_in_process()) {
						do_start_process();
						var data = {
							action: 'do_regenerate_presets_css'
						};

						$.ajax({
							type    : 'GET',
							data    : data,
							url     : ajaxurl,
							success : function (resp) {
								try {
									resp = $.parseJSON(resp);
									console.log(resp);
									$logging_wrapper.append('<span class="logging" style="color:green">STATUS: ' + resp.status + '</span>');
									$logging_wrapper.append('<span class="logging" style="color:green">SUCCESS COLORS: ' + resp.message.success + '</span>');
									$logging_wrapper.append('<span class="logging" style="color:red">FAIL COLORS: ' + resp.message.fail + '</span>');
									$logging_wrapper.append('<span class="logging" style="color:blue">TIME: ' + resp.time + '(ms) </span>');
								} catch (e) {
									$logging_wrapper.append('<span class="logging" style="color:red">PARSING ERROR: ' + e + '</span>');
								}
							},
							error   : function (resp) {
								$logging_wrapper.append('<span class="logging" style="color:red">ERROR: ' + resp + '</span>');
							},
							complete: function () {
								do_stop_process();
							}
						});
					}
				});

				function is_in_process() {
					var in_process = $this.attr('data-in-process');
					return !(in_process == 'false' || in_process == false || in_process == '' || typeof in_process == 'undefined');
				}

				function do_start_process() {
					$this.attr('data-in-process', 'true');
					$this.addClass('disabled');
					$redux_ajax_overlay.css('display', 'block');
					$redux_action_bar.find('.spinner').css('visibility', 'visible');
					$redux_action_bar.find('input').attr('disabled', 'disabled');
					$this.parent().find('.logging').remove();
				}

				function do_stop_process() {
					$this.attr('data-in-process', 'false');
					$this.removeClass('disabled');
					$redux_ajax_overlay.css('display', 'none');
					$redux_action_bar.find('.spinner').css('visibility', 'hidden');
					$redux_action_bar.find('input').prop('disabled', false);
				}

			});
		}


	};

	$(document).ready(function () {
		floral_redux.on_ready();
	})
})(jQuery);
