/**
 * jQuery Select2 Sortable
 * - enable select2 to be sortable via normal select element
 * 
 * author      : Vafour
 * modified    : Kevin Provance (kprovance)
 * inspired by : jQuery Chosen Sortable (https://github.com/mrhenry/jquery-chosen-sortable)
 * License     : GPL
 */

(function ($) {

	"use strict";

	$.fn.extend({
		select2SortableOrder: function () {

			var $this, $select, $select2, sorted, optArr, groupName, optVal, id;

			$this = this.filter('[multiple]');

			$this.each(function () {

				$select = $(this);

				// skip elements not select2-ed
				if (typeof ($select.data('select2')) !== 'object') {
					return false;
				}

				$select2 = $select.siblings('.select2-container');

				// Opt group names
				optArr = [];

				$select.find('optgroup').each(function (idx, val) {
					optArr.push(val);
				});

				$select.find('option').each(function (idx, val) {
					groupName = $(this).parent('optgroup').prop('label');
					optVal = this;

					if (groupName === undefined) {
						if (this.value !== '' && !this.selected) {
							optArr.push(optVal);
						}
					}
				});

				sorted = $($select2.find('.select2-selection__rendered li[class!="select2-search__field"]').map(function () {
					if (!this) {
						return undefined;
					}

                    /*
                     if ($(this).data('select2Data') !== undefined) {
                     id = $(this).data('select2Data').id;
                     return $select.find('option[value="' + id + '"]')[0];
                     }*/
					if ($(this).data('data') !== undefined) {
						id = $(this).data('data').id;
						return $select.find('option[value="' + id + '"]')[0];
					}


					//var id = $(this).data('select2Data').id;

					//return $select.find('option[value="' + id + '"]')[0];
				}));

				sorted.push.apply(sorted, optArr);

				$select.children().remove();
				$select.append(sorted);
			});

			return $this;
		},

		select2Sortable: function () {

			var args, $this, validMethods, defaultOptions, options, $select, $select2choices;

			args = Array.prototype.slice.call(arguments, 0);
			$this = this.filter('[multiple]');
			validMethods = ['destroy'];

			if (args.length === 0 || typeof (args[0]) === 'object') {
				defaultOptions = {
					bindOrder: 'formSubmit', // or sortableStop
					sortableOptions: {
						placeholder: 'ui-state-highlight',
						items: 'li:not(.select2-search__field)',
						tolerance: 'pointer'
					}
				};

				options = $.extend(defaultOptions, args[0]);

				// Init select2 only if not already initialized to prevent select2 configuration loss
				if (typeof ($this.data('select2')) !== 'object') {
					$this.select2();
				}

				$this.each(function () {
					$select = $(this);
					$select2choices = $select.siblings('.select2-container').find('.select2-selection__rendered');

					// Init jQuery UI Sortable
					$select2choices.sortable(options.sortableOptions);

					switch (options.bindOrder) {
						case 'sortableStop':
							// apply options ordering in sortstop event
							$select2choices.on("sortstop.select2sortable", function (event, ui) {
								$select.select2SortableOrder();
							});

							$select.on('change', function (e) {
								$(this).select2SortableOrder();
							});
							break;

						default:
							// apply options ordering in form submit
							$select.closest('form').unbind('submit.select2sortable').on('submit.select2sortable', function () {
								$select.select2SortableOrder();
							});
							break;
					}
				});
			} else if (typeof (args[0] === 'string')) {
				if ($.inArray(args[0], validMethods) === -1) {
					throw "Unknown method: " + args[0];
				}

				if (args[0] === 'destroy') {
					$this.select2SortableDestroy();
				}
			}

			return $this;
		},

		select2SortableDestroy: function () {

			var $this, $select, $select2choices;

			$this = this.filter('[multiple]');
			$this.each(function () {
				$select = $(this);
				$select2choices = $select.parent().find('.select2-selection__rendered');

				// unbind form submit event
				$select.closest('form').unbind('submit.select2sortable');

				// unbind sortstop event
				$select2choices.unbind("sortstop.select2sortable");

				// destroy select2Sortable
				$select2choices.sortable('destroy');
			});

			return $this;
		}
	});
}(jQuery));

// (function ($) {
//     $.fn.extend({
//         select2SortableOrder: function () {
//             var $this = this.filter('[multiple]');
//
//             $this.each(function () {
//                 var $select = $(this);
//
//                 // skip elements not select2-ed
//                 if (typeof ($select.data('select2')) !== 'object') {
//                     return false;
//                 }
//
//                 var $select2 = $select.siblings('.select2-container');
//                 var sorted;
//
//                 // Opt group names
//                 var optArr = [];
//
//                 $select.find('optgroup').each(function(idx, val) {
//                     optArr.push (val);
//                 });
//
//                 $select.find('option').each(function(idx, val) {
//                     var groupName = $(this).parent('optgroup').prop('label');
//                     var optVal = this;
//
//                     if (groupName === undefined) {
//                         if (this.value !== '' && !this.selected) {
//                             optArr.push (optVal);
//                         }
//                     }
//                 });
//
//                 sorted = $($select2.find('.select2-choices li[class!="select2-search-field"]').map(function () {
//                     if (!this) {
//                         return undefined;
//                     }
//
//                     if($(this).data('select2Data') != undefined){
//                         var id = $(this).data('select2Data').id;
//                         return $select.find('option[value="' + id + '"]')[0];
//                     }
//
//
//                     //var id = $(this).data('select2Data').id;
//
//                     //return $select.find('option[value="' + id + '"]')[0];
//                 }));
//
//                  sorted.push.apply(sorted, optArr);
//
//                 $select.children().remove();
//                 $select.append(sorted);
//               });
//
//             return $this;
//         },
//
//         select2Sortable: function () {
//             var args = Array.prototype.slice.call(arguments, 0);
//             $this = this.filter('[multiple]'),
//                     validMethods = ['destroy'];
//
//             if (args.length === 0 || typeof (args[0]) === 'object') {
//                 var defaultOptions = {
//                     bindOrder: 'formSubmit', // or sortableStop
//                     sortableOptions: {
//                         placeholder: 'ui-state-highlight',
//                         items: 'li:not(.select2-search-field)',
//                         tolerance: 'pointer'
//                     }
//                 };
//
//                 var options = $.extend(defaultOptions, args[0]);
//
//                 // Init select2 only if not already initialized to prevent select2 configuration loss
//                 if (typeof ($this.data('select2')) !== 'object') {
//                     $this.select2();
//                 }
//
//                 $this.each(function () {
//                     var $select = $(this)
//                     var $select2choices = $select.siblings('.select2-container').find('.select2-choices');
//
//                     // Init jQuery UI Sortable
//                     $select2choices.sortable(options.sortableOptions);
//
//                     switch (options.bindOrder) {
//                         case 'sortableStop':
//                             // apply options ordering in sortstop event
//                             $select2choices.on("sortstop.select2sortable", function (event, ui) {
//                                 $select.select2SortableOrder();
//                             });
//
//                             $select.on('change', function (e) {
//                                 $(this).select2SortableOrder();
//                             });
//                         break;
//
//                         default:
//                             // apply options ordering in form submit
//                             $select.closest('form').unbind('submit.select2sortable').on('submit.select2sortable', function () {
//                                 $select.select2SortableOrder();
//                             });
//                         break;
//                     }
//                 });
//             }
//             else if (typeof (args[0] === 'string')) {
//                 if ($.inArray(args[0], validMethods) == -1) {
//                     throw "Unknown method: " + args[0];
//                 }
//
//                 if (args[0] === 'destroy') {
//                     $this.select2SortableDestroy();
//                 }
//             }
//
//             return $this;
//         },
//
//         select2SortableDestroy: function () {
//             var $this = this.filter('[multiple]');
//             $this.each(function () {
//                 var $select = $(this)
//                 var $select2choices = $select.parent().find('.select2-choices');
//
//                 // unbind form submit event
//                 $select.closest('form').unbind('submit.select2sortable');
//
//                 // unbind sortstop event
//                 $select2choices.unbind("sortstop.select2sortable");
//
//                 // destroy select2Sortable
//                 $select2choices.sortable('destroy');
//             });
//
//             return $this;
//         }
//     });
// }(jQuery));
