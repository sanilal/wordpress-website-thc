/**
 * Created by Sinzii Rosy on 8/26/2016.
 */

var floral_gmaps = {};

(function ($) {
	'use strict';

	floral_gmaps = {
		init_map: function (map_holder_id) {
			if (typeof (map_holder_id) == 'undefined') {
				return;
			}
			var $this = $('#' + map_holder_id),
				data_position = $.parseJSON($this.attr('data-position')),
				data_draggable = $this.attr('data-draggable') || 1,
				data_zoom_level = parseInt($this.attr('data-zoom-level')) || 8,
				data_zoom_on_mouse_wheel = $this.attr('data-zoon-on-mouse-wheel') || 1,
				data_theme = $this.attr('data-theme') || {},
				data_map_type = $this.attr('data-map-type') || 'roadmap',
				data_custom_marker = $this.attr('data-custom-marker') || '',
				data_markers = $this.attr('data-markers') || [];

			var themes = {
				ultra_light       : [{
					"featureType": "water",
					"elementType": "geometry",
					"stylers"    : [{"color": "#e9e9e9"}, {"lightness": 17}]
				}, {
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers"    : [{"color": "#f5f5f5"}, {"lightness": 20}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers"    : [{"color": "#ffffff"}, {"lightness": 17}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers"    : [{"color": "#ffffff"}, {"lightness": 29}, {"weight": 0.2}]
				}, {
					"featureType": "road.arterial",
					"elementType": "geometry",
					"stylers"    : [{"color": "#ffffff"}, {"lightness": 18}]
				}, {
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers"    : [{"color": "#ffffff"}, {"lightness": 16}]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers"    : [{"color": "#f5f5f5"}, {"lightness": 21}]
				}, {
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers"    : [{"color": "#dedede"}, {"lightness": 21}]
				}, {
					"elementType": "labels.text.stroke",
					"stylers"    : [{"visibility": "on"}, {"color": "#ffffff"}, {"lightness": 16}]
				}, {
					"elementType": "labels.text.fill",
					"stylers"    : [{"saturation": 36}, {"color": "#333333"}, {"lightness": 40}]
				}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
					"featureType": "transit",
					"elementType": "geometry",
					"stylers"    : [{"color": "#f2f2f2"}, {"lightness": 19}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.fill",
					"stylers"    : [{"color": "#fefefe"}, {"lightness": 20}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.stroke",
					"stylers"    : [{"color": "#fefefe"}, {"lightness": 17}, {"weight": 1.2}]
				}],
				unsaturated_browns: [{
					"elementType": "geometry",
					"stylers"    : [{"hue": "#ff4400"}, {"saturation": -68}, {"lightness": -4}, {"gamma": 0.72}]
				}, {"featureType": "road", "elementType": "labels.icon"}, {
					"featureType": "landscape.man_made",
					"elementType": "geometry",
					"stylers"    : [{"hue": "#0077ff"}, {"gamma": 3.1}]
				}, {
					"featureType": "water",
					"stylers"    : [{"hue": "#00ccff"}, {"gamma": 0.44}, {"saturation": -33}]
				}, {
					"featureType": "poi.park",
					"stylers"    : [{"hue": "#44ff00"}, {"saturation": -23}]
				}, {
					"featureType": "water",
					"elementType": "labels.text.fill",
					"stylers"    : [{"hue": "#007fff"}, {"gamma": 0.77}, {"saturation": 65}, {"lightness": 99}]
				}, {
					"featureType": "water",
					"elementType": "labels.text.stroke",
					"stylers"    : [{"gamma": 0.11}, {"weight": 5.6}, {"saturation": 99}, {"hue": "#0091ff"}, {"lightness": -86}]
				}, {
					"featureType": "transit.line",
					"elementType": "geometry",
					"stylers"    : [{"lightness": -48}, {"hue": "#ff5e00"}, {"gamma": 1.2}, {"saturation": -23}]
				}, {
					"featureType": "transit",
					"elementType": "labels.text.stroke",
					"stylers"    : [{"saturation": -64}, {"hue": "#ff9100"}, {"lightness": 16}, {"gamma": 0.47}, {"weight": 2.7}]
				}],
				light_dream       : [{
					"featureType": "landscape",
					"stylers"    : [{"hue": "#FFBB00"}, {"saturation": 43.400000000000006}, {"lightness": 37.599999999999994}, {"gamma": 1}]
				}, {
					"featureType": "road.highway",
					"stylers"    : [{"hue": "#FFC200"}, {"saturation": -61.8}, {"lightness": 45.599999999999994}, {"gamma": 1}]
				}, {
					"featureType": "road.arterial",
					"stylers"    : [{"hue": "#FF0300"}, {"saturation": -100}, {"lightness": 51.19999999999999}, {"gamma": 1}]
				}, {
					"featureType": "road.local",
					"stylers"    : [{"hue": "#FF0300"}, {"saturation": -100}, {"lightness": 52}, {"gamma": 1}]
				}, {
					"featureType": "water",
					"stylers"    : [{"hue": "#0078FF"}, {"saturation": -13.200000000000003}, {"lightness": 2.4000000000000057}, {"gamma": 1}]
				}, {
					"featureType": "poi",
					"stylers"    : [{"hue": "#00FF6A"}, {"saturation": -1.0989010989011234}, {"lightness": 11.200000000000017}, {"gamma": 1}]
				}],
				blue_water        : [{
					"featureType": "administrative",
					"elementType": "labels.text.fill",
					"stylers"    : [{"color": "#444444"}]
				}, {
					"featureType": "landscape",
					"elementType": "all",
					"stylers"    : [{"color": "#f2f2f2"}]
				}, {
					"featureType": "poi",
					"elementType": "all",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "road",
					"elementType": "all",
					"stylers"    : [{"saturation": -100}, {"lightness": 45}]
				}, {
					"featureType": "road.highway",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}]
				}, {
					"featureType": "road.arterial",
					"elementType": "labels.icon",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "transit",
					"elementType": "all",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "water",
					"elementType": "all",
					"stylers"    : [{"color": "#46bcec"}, {"visibility": "on"}]
				}],
				paper             : [{
					"featureType": "administrative",
					"elementType": "all",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "landscape",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}, {"hue": "#0066ff"}, {"saturation": 74}, {"lightness": 100}]
				}, {
					"featureType": "poi",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}]
				}, {
					"featureType": "road",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}]
				}, {
					"featureType": "road.highway",
					"elementType": "all",
					"stylers"    : [{"visibility": "off"}, {"weight": 0.6}, {"saturation": -85}, {"lightness": 61}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry",
					"stylers"    : [{"visibility": "on"}]
				}, {
					"featureType": "road.arterial",
					"elementType": "all",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "road.local",
					"elementType": "all",
					"stylers"    : [{"visibility": "on"}]
				}, {
					"featureType": "transit",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}]
				}, {
					"featureType": "water",
					"elementType": "all",
					"stylers"    : [{"visibility": "simplified"}, {"color": "#5f94ff"}, {"lightness": 26}, {"gamma": 5.86}]
				}],
				midnight_commander: [{
					"featureType": "all",
					"elementType": "labels.text.fill",
					"stylers"    : [{"color": "#ffffff"}]
				}, {
					"featureType": "all",
					"elementType": "labels.text.stroke",
					"stylers"    : [{"color": "#000000"}, {"lightness": 13}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.fill",
					"stylers"    : [{"color": "#000000"}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.stroke",
					"stylers"    : [{"color": "#144b53"}, {"lightness": 14}, {"weight": 1.4}]
				}, {
					"featureType": "landscape",
					"elementType": "all",
					"stylers"    : [{"color": "#08304b"}]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers"    : [{"color": "#0c4152"}, {"lightness": 5}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers"    : [{"color": "#000000"}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers"    : [{"color": "#0b434f"}, {"lightness": 25}]
				}, {
					"featureType": "road.arterial",
					"elementType": "geometry.fill",
					"stylers"    : [{"color": "#000000"}]
				}, {
					"featureType": "road.arterial",
					"elementType": "geometry.stroke",
					"stylers"    : [{"color": "#0b3d51"}, {"lightness": 16}]
				}, {
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers"    : [{"color": "#000000"}]
				}, {
					"featureType": "transit",
					"elementType": "all",
					"stylers"    : [{"color": "#146474"}]
				}, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#021019"}]}],
				retro             : [{
					"featureType": "administrative",
					"stylers"    : [{"visibility": "off"}]
				}, {"featureType": "poi", "stylers": [{"visibility": "simplified"}]}, {
					"featureType": "road",
					"elementType": "labels",
					"stylers"    : [{"visibility": "simplified"}]
				}, {"featureType": "water", "stylers": [{"visibility": "simplified"}]}, {
					"featureType": "transit",
					"stylers"    : [{"visibility": "simplified"}]
				}, {
					"featureType": "landscape",
					"stylers"    : [{"visibility": "simplified"}]
				}, {"featureType": "road.highway", "stylers": [{"visibility": "off"}]}, {
					"featureType": "road.local",
					"stylers"    : [{"visibility": "on"}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry",
					"stylers"    : [{"visibility": "on"}]
				}, {
					"featureType": "water",
					"stylers"    : [{"color": "#84afa3"}, {"lightness": 52}]
				}, {"stylers": [{"saturation": -17}, {"gamma": 0.36}]}, {
					"featureType": "transit.line",
					"elementType": "geometry",
					"stylers"    : [{"color": "#3f518c"}]
				}],
				cool_grey         : [{
					"featureType": "landscape",
					"elementType": "labels",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "transit",
					"elementType": "labels",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "poi",
					"elementType": "labels",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "water",
					"elementType": "labels",
					"stylers"    : [{"visibility": "off"}]
				}, {
					"featureType": "road",
					"elementType": "labels.icon",
					"stylers"    : [{"visibility": "off"}]
				}, {"stylers": [{"hue": "#00aaff"}, {"saturation": -100}, {"gamma": 2.15}, {"lightness": 12}]}, {
					"featureType": "road",
					"elementType": "labels.text.fill",
					"stylers"    : [{"visibility": "on"}, {"lightness": 24}]
				}, {"featureType": "road", "elementType": "geometry", "stylers": [{"lightness": 57}]}],
				neutral_blue      : [{
					"featureType": "water",
					"elementType": "geometry",
					"stylers"    : [{"color": "#193341"}]
				}, {
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers"    : [{"color": "#2c5a71"}]
				}, {
					"featureType": "road",
					"elementType": "geometry",
					"stylers"    : [{"color": "#29768a"}, {"lightness": -37}]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers"    : [{"color": "#406d80"}]
				}, {
					"featureType": "transit",
					"elementType": "geometry",
					"stylers"    : [{"color": "#406d80"}]
				}, {
					"elementType": "labels.text.stroke",
					"stylers"    : [{"visibility": "on"}, {"color": "#3e606f"}, {"weight": 2}, {"gamma": 0.84}]
				}, {
					"elementType": "labels.text.fill",
					"stylers"    : [{"color": "#ffffff"}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry",
					"stylers"    : [{"weight": 0.6}, {"color": "#1a3541"}]
				}, {"elementType": "labels.icon", "stylers": [{"visibility": "off"}]}, {
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers"    : [{"color": "#2c5a71"}]
				}]
			};


			// map theme
			var map_theme = {};
			if (typeof (themes[data_theme]) === 'undefined') {
				try {
					map_theme = $.parseJSON(data_theme);
				} catch (e) {
					//do nothing
				}
			} else {
				map_theme = themes[data_theme];
			}

			// init the map
			var map = new google.maps.Map(document.getElementById(map_holder_id), {
				center           : data_position,
				zoom             : data_zoom_level,
				scrollwheel      : data_zoom_on_mouse_wheel,
				draggable        : data_draggable,
				navigationControl: true,
				mapTypeId        : data_map_type || 'roadmap',
				styles           : map_theme || {}
			});


			// responsive
			google.maps.event.addDomListener(window, "resize", function () {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center);
			});

			// markers
			if (typeof (data_markers) === 'string') {
				try {
					data_markers = $.parseJSON(data_markers);

					for (var i = 0; i < data_markers.length; i++) {
						var data_marker = data_markers[i];
						var marker_options = {
							position: data_marker[0]
						};

						if (data_custom_marker) {
							marker_options.icon = {
								url: data_custom_marker
							}
						}
						if (data_marker[1]) {
							marker_options.title = data_marker[1];
						}
						if (data_marker[2] === 'drop') {
							marker_options.animation = google.maps.Animation.DROP;
						} else if (data_marker[2] === 'bounce') {
							marker_options.animation = google.maps.Animation.BOUNCE;
						}
						var marker = new google.maps.Marker(marker_options);
						marker.setMap(map);
					}
				} catch (e) {
					// do nothing
				}
			}

		}
	}
})(jQuery);