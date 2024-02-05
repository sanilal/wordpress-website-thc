/*
 * Copyright(c) 2016, 9WPThemes
 * @filename: main-admin-panel.js
 * @time    : 8/26/16 11:56 AM
 * @author  : 9WPThemes Team
 */

/**
 * Created by Thang X. Vu on 5/25/2016.
 */

var floral_ap = {};


(function ($) {
	'use strict';
	var install_demo_phases = [
		'Prepare',
		'Check Theme Requirement',
		'Check Libraries',
		'Check Data Files',
		'Import Options',
		'Import Data Demo || Import Categories',
		'Import Data Demo || Import Tags',
		'Import Data Demo || Import Terms',
		'Import Data Demo || Import Posts',
		'Import Data Demo || Update Info and Cleanup',
		'Import Updates',
		'Generate CSS',
		'Import Revolution Sliders',
		'End'];

	floral_ap.install_demo = {
		is_installing  : false,
		current_phase  : 0,
		current_process: 0,
		time_spent     : 0,

		onReady: function () {
			floral_ap.install_demo.show_log();
			floral_ap.install_demo.trigger_install();
			floral_ap.install_demo.progress_bar_work();
		},

		show_log: function () {
			$('html').append('<div id="log-dialog" title="Install Demo Data Log"></div>');
			var button_show_log = $('a#button-show-log'),
				log_dialog = $('div#log-dialog');

			log_dialog.dialog({
				autoOpen : false,
				maxHeight: 600,
				maxWidth : 600,
				height   : 300,
				width    : 400,
				open     : function (event, ui) {
					$(event.target).parent().css('position', 'fixed').position({
						my: "right bottom",
						at: "left top",
						of: button_show_log
					});
				},
				resize   : function (event, ui) {
					$(event.target).parent().position({my: "right bottom", at: "left top", of: button_show_log});
				},
				position : {my: "right bottom", at: "left top", of: button_show_log}
			});

			button_show_log.on('click', function (e) {
				e.preventDefault();
				if (log_dialog.dialog('isOpen')) {
					log_dialog.dialog('close')
				} else {
					log_dialog.dialog('open');
				}
			});

			this.add_log('Hi there, this is 9WPThemes!')
		},

		add_log: function (content, type) {
			var log_type = ['info', 'error', 'warning', 'success'],
				log_dialog = $('div#log-dialog');
			content = typeof content !== 'undefined' ? content : '';
			type = typeof type !== 'undefined' ? type : 'info';
			if (log_type.indexOf(type) == -1) {
				type = 'info';
			}

			if (log_dialog.length > 0) {
				log_dialog.prepend('<p class="' + type + '"><strong>' + (new Date()).toLocaleTimeString() + ':-</strong><span> ' + content + '</span></p>');
			}
		},

		show_message                : function (target, content) {
			$('html').append('<div class="auto-generated-dialog"><div>' + content + '</div></div>');
			var $message_dialog = $('.auto-generated-dialog');
			$message_dialog.dialog({
				modal  : true,
				width  : 400,
				buttons: {
					'Got it!': function () {
						$(this).dialog('close');
						$(this).remove();
					}
				}
			});
		},
		show_install_success_message: function (target, demo) {
			$('html').append('<div class="auto-generated-dialog">Install demo data: ' + demo + ' finish success.<br/> <strong>Check out the site now!</strong><p style="margin-top: 10px"><i>Total time spent: ' + (floral_ap.install_demo.time_spent / 1000) + '(s)</i></p></div>');
			var $message_dialog = $('.auto-generated-dialog');
			$message_dialog.dialog({
				modal  : true,
				width  : 400,
				buttons: {
					'Check Out The Site': function () {
						var win = window.open(floral_ap_object.home_url, '_blank');
						win.focus();
						$(this).dialog('close');
					},
					'Cancel'            : function () {
						$(this).dialog('close');
					}
				},
				close  : function (event, ui) {
					location.reload(true);
					$(this).remove();
				}
			});
		},
		install_demo                : function (target, demo, path, phase, dummy, options) {
			floral_ap.install_demo.is_installing = true;
			var data = {
				action   : 'install_demo_data',
				demo_name: demo,
				demo_path: path,
				phase    : phase,
				dummy    : dummy,
				options  : options
			};

			var progress_bar = $(target).parents('.demo-item-inner').find('.progressbar');
			floral_ap.install_demo.spinner_on(target);
			$.ajax({
				type   : 'POST',
				data   : data,
				url    : floral_ap_object.ajax_url,
				success: function (resp) {
					try {
						resp = $.parseJSON(resp);
						resp.phase = parseInt(resp.phase);
						floral_ap.install_demo.current_phase = resp.phase;

						floral_ap.install_demo.add_log('MESSAGE: <i>' + resp.message + '</i><br/>PROCESS: <i>' + resp.process + '</i><br/>PHASE: <i>' + install_demo_phases[resp.phase] + '</i>', resp.status);

						if (resp.status == 'error') {
							floral_ap.install_demo.add_log('The installation has been stopped, please try again!', resp.status);
							floral_ap.install_demo.show_message(this, '<p class="error"><strong>The installation has been stopped.</strong><br/><strong style="color: red;">Message: ' + resp.message + '</strong><br/><br/><i>Hit the show log button for more information!</i></p>');
							floral_ap.install_demo.spinner_off(target);
							floral_ap.install_demo.reset_data();
							floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
						} else {
							// question force install
							if (resp.phase == 1 && resp.status == 'warning') {
								var force_install = confirm('Some server configurations do not meet theme recommended requirement, force install? (Be careful, the installation can be stuck some where!)');
								if (!force_install) {
									floral_ap.install_demo.add_log('The installation has been stopped, please check out the System Status for more information!', 'error');
									floral_ap.install_demo.show_message(this, '<p class="error"><strong>The installation has been stopped.<br/> Please check out the System Status for more information!</strong></p>');
									floral_ap.install_demo.spinner_off(target);
									floral_ap.install_demo.reset_data();
									floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
									return;
								}
							}

							if (resp.process == 'complete') {
								if (resp.phase < install_demo_phases.length - 1) {
									switch (resp.phase) {
										case 0:
											floral_ap.install_demo.current_process = 0;
											break;
										case 1:
											floral_ap.install_demo.current_process = 1;
											break;
										case 2:
											floral_ap.install_demo.current_process = 2;
											break;
										case 3:
											floral_ap.install_demo.current_process = 3;
											break;
										case 4:
											floral_ap.install_demo.current_process = 3 + 15;
											break;
										case 5:
											floral_ap.install_demo.current_process = 3 + 15 + 5;
											break;
										case 6:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5;
											break;
										case 7:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5;
											break;
										case 8:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5 + 30;
											break;
										case 9:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5 + 30 + 5;
											break;
										case 10:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5 + 30 + 5 + 10;
											break;
										case 11:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5 + 30 + 5 + 10 + 5;
											break;
										case 12:
											floral_ap.install_demo.current_process = 3 + 15 + 5 + 5 + 5 + 30 + 5 + 10 + 5 + 17;
											break;
										default:
											floral_ap.install_demo.current_process = 100;
									}

									floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
									floral_ap.install_demo.install_demo(target, demo, path, 1 + resp.phase, resp.process, options);
								} else {
									// install success
									floral_ap.install_demo.current_process = 100;
									floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
									// last benchmarks
									floral_ap.install_demo.time_spent = (new Date()).getTime() - floral_ap.install_demo.time_spent;
									// show success message
									floral_ap.install_demo.show_install_success_message(target, demo);
									// reset data
									floral_ap.install_demo.spinner_off(target);
									floral_ap.install_demo.reset_data();
								}
							} else {
								var process = (resp.process).split('||');
								if (resp.phase == 12) {
									var count_zip = process[0], current_zips = process.length - 1;
									floral_ap.install_demo.current_process += (current_zips / count_zip) * 100 * 0.17;
									floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
								}

								if (resp.phase == 8) {
									if (process.length >= 2) {
										var totals = process[1], current = process[0];
										var posts_process = floral_ap.install_demo.current_process + (current / totals) * 100 * 0.3;
										floral_ap.install_demo.animate_progress_bar(progress_bar, posts_process);
									}
								}

								floral_ap.install_demo.install_demo(target, demo, path, resp.phase, resp.process, options);
							}
						}
					} catch (err) {
						floral_ap.install_demo.add_log('The installation has been stopped, due to an unexpected response. <br/> DETAIL: ' + err + '<br/> RESPONSE: <pre>' + resp + '</pre>', 'error');
						floral_ap.install_demo.show_message(this, '<p class="error"><strong>The installation has been stopped, due to an unexpected response.<br/> Please hit the show log button for more information!</strong></p>');
						floral_ap.install_demo.spinner_off(target);
						floral_ap.install_demo.reset_data();
						floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
					}
				},
				error  : function (resp) {
					floral_ap.install_demo.add_log('ERROR: ' + resp.statusText, 'error ');
					console.log(resp);
					floral_ap.install_demo.spinner_off(target);
					floral_ap.install_demo.reset_data();
					floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
				}
			});
		},
		trigger_install             : function () {
			var $button = $('.button-install');
			$button.each(function () {
				var $this = $(this);
				$this.on('click', function (e) {
					e.preventDefault();
					if (!$this.hasClass('disabled')) {
						if (floral_ap.install_demo.is_installing) {
							floral_ap.install_demo.show_message(this, 'The installation is in process, please be patient!!');
						} else {
							var demo_name = $this.attr('data-demo'),
								demo_path = $this.attr('data-path'),
								demo_title = $this.parent().find('span.demo-title').text();
							var $confirm_dialog = $('#confirm-install-demo');
							if ($confirm_dialog.length > 0) {
								$confirm_dialog.find('span.demo-title').text(demo_title);
								$confirm_dialog.find('input#demo-data').on('change', function () {
									if ($(this).is(':checked')) {
										$confirm_dialog.find('input#fetching-demo-images').attr('checked', 'checked');
									} else {
										$confirm_dialog.find('input#fetching-demo-images').prop('checked', false);
									}
								});

								$confirm_dialog.dialog({
									modal  : true,
									width  : 500,
									open   : function (event, ui) {
										// check all the options
										$(this).find('input#demo-data').attr('checked', 'checked');
										$(this).find('input#fetching-demo-images').attr('checked', 'checked');
										$(this).find('input#demo-options').attr('checked', 'checked');
										$(this).find('input#demo-revslider').attr('checked', 'checked');
									},
									buttons: {
										'I understand, just install it.': function () {
											var progress_bar = $(this).parents('.demo-item-inner').find('.progressbar');
											if (demo_name) {
												floral_ap.install_demo.animate_progress_bar(progress_bar, floral_ap.install_demo.current_process);
												// start time benchmarks
												floral_ap.install_demo.time_spent = (new Date()).getTime();
												// get options
												var install_demo_options = $(this).find('input#demo-options').is(':checked') ? 1 : 0,
													install_demo_data = $(this).find('input#demo-data').is(':checked') ? 1 : 0,
													fetching_demo_images = $(this).find('input#fetching-demo-images').is(':checked') ? 1 : 0,
													install_demo_revslider = $(this).find('input#demo-revslider').is(':checked') ? 1 : 0,
													options = install_demo_options + '||' + install_demo_data + '||' + fetching_demo_images + '||' + install_demo_revslider,
													message_option = '';
												// get options message
												// if (install_demo_data && install_demo_options && install_demo_revslider) {
												// 	message_option = 'All Options';
												// } else
												if (install_demo_data == 0 && install_demo_options == 0 && install_demo_revslider == 0) {
													$(this).dialog('close');
													floral_ap.install_demo.add_log('<b>No import options selected</b>, the installation can not start! Please try again.');
													floral_ap.install_demo.show_message($this, 'No options selected, the installation can not start! <br/> Please try again.');
													return;
												} else {
													if (install_demo_data == 1) {
														message_option += '<br/> - Demo data';
														if (fetching_demo_images == 1) {
															message_option += ' and fetching images from our server';
														} else {
															message_option += ' and no fetching images from our server';
														}
													}
													if (install_demo_options == 1) {
														message_option += '<br/> - Demo options';
													}
													if (install_demo_revslider == 1) {
														message_option += '<br/> - Demo revolution slider';
													}
												}
												// show start message
												floral_ap.install_demo.add_log('Installing Demo Data: <b>' + demo_title + '</b><br/>Your selected options : <b>' + message_option + '</b>');
												// start the installation
												floral_ap.install_demo.install_demo($this, demo_name, demo_path, floral_ap.install_demo.current_phase, '', options);
											} else {
												floral_ap.install_demo.show_message($this, 'Fail to start the installer! Demo data does not exist.');
											}
											$(this).dialog('close');
										},
										'Cancel'                        : function () {
											$(this).dialog('close');
										}
									}
								});
							}
						}
					} else {
						floral_ap.install_demo.show_message(this, 'You currently can not install this demo data!');
					}
				})
			})
		},

		progress_bar_work: function () {
			$('.progressbar').progressbar({value: 0});
		},

		animate_progress_bar: function (progressbar, percent) {
			progressbar.progressbar("value", percent);
		},

		disable_other_demo: function (current_demo) {
			$('.demo-item-inner').each(function () {
				var button_insatll = $(this).find('.button-install');
				if (button_insatll[0] !== current_demo) {
					$(this).find('.dismiss-overlay').css('display', 'block');
				}
			})
		},

		release_all_demo: function () {
			$('.dismiss-overlay').css('display', 'none');
		},

		reset_data: function () {
			this.current_phase = 0;
			this.current_process = 0;
			this.time_spent = 0;
			this.is_installing = false;
		},


		spinner_on : function (target) {
			$(target).parent().find('span.spinner').css('visibility', 'inherit');
		},
		spinner_off: function (target) {
			$(target).parent().find('span.spinner').css('visibility', 'hidden');
		}
	};

	floral_ap.other_product = {
		onReady: function () {
			floral_ap.other_product.trigger_load_more();
		},

		trigger_load_more: function () {
			var $load_more_btn = $('#tp-load-more');
			$load_more_btn.on('click', function (e) {
				e.preventDefault();
				// $load_more_btn.parent('.load-more-product').addClass('loading');
				floral_ap.other_product.load_theme_product(this);
			});
			$load_more_btn.trigger('click');
		},

		load_theme_product: function (target) {
			var $product_list = $('.product-list'),
				paged = $(target).attr('data-paged'),
				$target_parent = $(target).parent('.load-more-product');

			$target_parent.addClass('loading');
			var data = {
				action  : 'load_theme_product',
				paged   : paged,
				post_num: 5
			};
			$.ajax({
				type   : 'POST',
				data   : data,
				url    : floral_ap_object.ajax_url,
				success: function (resp) {
					$(target).attr('data-paged', parseInt(paged) + 1);
					if (resp == '') {
						$target_parent.append('<strong>NO MORE PRODUCTS TO SHOW.</strong>');
						$(target).remove();
					} else {
						var loaded = $(resp).hide().fadeIn(1000);
						$product_list.append(loaded);
					}
					$target_parent.removeClass('loading');
				},
				error  : function (resp) {
					$target_parent.append('<strong>NO MORE PRODUCTS TO SHOW.</strong>');
					$(target).remove();
					$target_parent.removeClass('loading');
				}
			});
		}
	};

	/**
	 * On Document Ready Event
	 */
	$(document).ready(function () {
		floral_ap.install_demo.onReady();
		floral_ap.other_product.onReady();
	});
})(jQuery);