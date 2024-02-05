<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: map-helpers.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Map_Helpers {
	
	static function get_animations() {
		return array(
			esc_html__( 'None', 'w9-floral-addon' )                 => '',
			esc_html__( 'Fade In', 'w9-floral-addon' )              => 'fadeIn',
			esc_html__( 'Fade Top to Bottom', 'w9-floral-addon' )   => 'fadeInDown',
			esc_html__( 'Fade Bottom to Top', 'w9-floral-addon' )   => 'fadeInUp',
			esc_html__( 'Fade Left to Right', 'w9-floral-addon' )   => 'fadeInLeft',
			esc_html__( 'Fade Right to Left', 'w9-floral-addon' )   => 'fadeInRight',
			esc_html__( 'Bounce In', 'w9-floral-addon' )            => 'bounceIn',
			esc_html__( 'Bounce Top to Bottom', 'w9-floral-addon' ) => 'bounceInDown',
			esc_html__( 'Bounce Bottom to Top', 'w9-floral-addon' ) => 'bounceInUp',
			esc_html__( 'Bounce Left to Right', 'w9-floral-addon' ) => 'bounceInLeft',
			esc_html__( 'Bounce Right to Left', 'w9-floral-addon' ) => 'bounceInRight',
			esc_html__( 'Zoom In', 'w9-floral-addon' )              => 'zoomIn',
			esc_html__( 'Flip Vertical', 'w9-floral-addon' )        => 'flipInX',
			esc_html__( 'Flip Horizontal', 'w9-floral-addon' )      => 'flipInY',
			esc_html__( 'Bounce', 'w9-floral-addon' )               => 'bounce',
			esc_html__( 'Flash', 'w9-floral-addon' )                => 'flash',
			esc_html__( 'Shake', 'w9-floral-addon' )                => 'shake',
			esc_html__( 'Pulse', 'w9-floral-addon' )                => 'pulse',
			esc_html__( 'Swing', 'w9-floral-addon' )                => 'swing',
			esc_html__( 'Rubber band', 'w9-floral-addon' )          => 'rubberBand',
			esc_html__( 'Wobble', 'w9-floral-addon' )               => 'wobble',
			esc_html__( 'Tada', 'w9-floral-addon' )                 => 'tada'
		);
	}
	
	static function get_animations_out() {
		return array(
			__( 'None', 'w9-floral-addon' )                  => '',
			__( 'Fade Out', 'w9-floral-addon' )              => 'fadeOut',
			__( 'Fade Out Down', 'w9-floral-addon' )         => 'fadeOutDown',
			__( 'Fade Out Down Big', 'w9-floral-addon' )     => 'fadeOutDownBig',
			__( 'Fade Out Left', 'w9-floral-addon' )         => 'fadeOutLeft',
			__( 'Fade Out Left Big', 'w9-floral-addon' )     => 'fadeOutLeftBig',
			__( 'Fade Out Right', 'w9-floral-addon' )        => 'fadeOutRight',
			__( 'Fade Out Right Big', 'w9-floral-addon' )    => 'fadeOutRightBig',
			__( 'Fade Out Up', 'w9-floral-addon' )           => 'fadeOutUp',
			__( 'Fade Out Up Big', 'w9-floral-addon' )       => 'fadeOutUpBig',
			__( 'FlipOutX', 'w9-floral-addon' )              => 'flipOutX',
			__( 'FlipOutY', 'w9-floral-addon' )              => 'flipOutY',
			__( 'Light SpeedOut', 'w9-floral-addon' )        => 'lightSpeedOut',
			__( 'Rotate Out', 'w9-floral-addon' )            => 'rotateOut',
			__( 'Rotate Out Down Left', 'w9-floral-addon' )  => 'rotateOutDownLeft',
			__( 'Rotate Out Down Right', 'w9-floral-addon' ) => 'rotateOutDownRight',
			__( 'Rotate Out Up Left', 'w9-floral-addon' )    => 'rotateOutUpLeft',
			__( 'Rotate Out UpRight', 'w9-floral-addon' )    => 'rotateOutUpRight',
			__( 'Roll In', 'w9-floral-addon' )               => 'rollIn',
			__( 'Roll Out', 'w9-floral-addon' )              => 'rollOut',
			__( 'Zoom Out', 'w9-floral-addon' )              => 'zoomOut',
			__( 'Zoom Out Down', 'w9-floral-addon' )         => 'zoomOutDown',
			__( 'Zoom Out Left', 'w9-floral-addon' )         => 'zoomOutLeft',
			__( 'Zoom Out Right', 'w9-floral-addon' )        => 'zoomOutRight',
			__( 'Zoom Out Up', 'w9-floral-addon' )           => 'zoomOutUp',
			__( 'Slide Out Down', 'w9-floral-addon' )        => 'slideOutDown',
			__( 'Slide Out Left', 'w9-floral-addon' )        => 'slideOutLeft',
			__( 'Slide Out Right', 'w9-floral-addon' )       => 'slideOutRight',
			__( 'Slide Out Up', 'w9-floral-addon' )          => 'slideOutUp',
		);
	}
	
	static function animation_css() {
		return array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Animation CSS ', 'w9-floral-addon' ),
			'param_name'  => 'animation_css',
			'value'       => self::get_animations(),
			'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'w9-floral-addon' ),
			'group'       => esc_html__( 'Animations', 'w9-floral-addon' )
		);
	}
	
	static function animation_duration() {
		return array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Animation duration', 'w9-floral-addon' ),
			'param_name'  => 'animation_duration',
			'value'       => '',
			'description' => __( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'w9-floral-addon' ),
			'dependency'  => Array(
				'element' => 'animation_css',
				'value'   => array(
					'fadeIn',
					'fadeInDown',
					'fadeInUp',
					'fadeInLeft',
					'fadeInRight',
					'bounceIn',
					'bounceInDown',
					'bounceInUp',
					'bounceInLeft',
					'bounceInRight',
					'zoomIn',
					'flipInX',
					'flipInY',
					'bounce',
					'flash',
					'shake',
					'pulse',
					'swing',
					'rubberBand',
					'wobble',
					'tada'
				)
			),
			'group'       => esc_html__( 'Animations', 'w9-floral-addon' )
		);
	}
	
	static function animation_delay() {
		return array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Animation delay', 'w9-floral-addon' ),
			'param_name'  => 'animation_delay',
			'value'       => '',
			'description' => esc_html__( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'w9-floral-addon' ),
			'dependency'  => Array(
				'element' => 'animation_css',
				'value'   => array(
					'fadeIn',
					'fadeInDown',
					'fadeInUp',
					'fadeInLeft',
					'fadeInRight',
					'bounceIn',
					'bounceInDown',
					'bounceInUp',
					'bounceInLeft',
					'bounceInRight',
					'zoomIn',
					'flipInX',
					'flipInY',
					'bounce',
					'flash',
					'shake',
					'pulse',
					'swing',
					'rubberBand',
					'wobble',
					'tada'
				)
			),
			'group'       => esc_html__( 'Animations', 'w9-floral-addon' )
		);
	}
	
	static function extra_class() {
		return array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'w9-floral-addon' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' )
		);
	}
	
	static function design_options() {
		return array(
			'type'       => 'css_editor',
			'heading'    => __( 'Css box', 'w9-floral-addon' ),
			'param_name' => 'css',
			'group'      => __( 'Design Options', 'w9-floral-addon' )
		);
	}
	
	static function design_options_on_tablet() {
		return array(
			'type'             => 'css_editor_lite',
			'heading'          => __( 'On tablet devices', 'w9-floral-addon' ),
			'description'      => __( 'Screen width from 480px to 991px.', 'w9-floral-addon' ),
			'param_name'       => 'tablet_css',
			'group'            => __( 'Design Options', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-xs-6 responsive_param'
		);
	}
	
	static function design_options_on_mobile() {
		return array(
			'type'             => 'css_editor_lite',
			'heading'          => __( 'On mobile devices', 'w9-floral-addon' ),
			'description'      => __( 'Screen width smaller than 480px.', 'w9-floral-addon' ),
			'param_name'       => 'mobile_css',
			'group'            => __( 'Design Options', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-xs-6 responsive_param'
		);
	}
	
	static function inline_styles() {
		return array(
			'type'        => 'textarea',
			'heading'     => __( 'Inline styles', 'w9-floral-addon' ),
			'param_name'  => 'css_inline',
			'group'       => __( 'Design Options', 'w9-floral-addon' ),
			'description' => esc_html__( 'eg: property_1: value_1; property_2: value_2; ...', 'w9-floral-addon' )
		);
	}
	
	
	static function get_icon_picker_9wpthemes( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'        => 'iconpicker',
			'heading'     => __( 'Icon', 'w9-floral-addon' ),
			'param_name'  => $param_prefix . 'icon_9wpthemes',
			'value'       => '', // default value to backend editor admin_label
			'settings'    => array(
				'emptyIcon'    => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 100,
				'type'         => '9wpthemes',
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
//				'source'       => Floral_Icons::get_theme_base_icons()
			),
			'dependency'  => array(
				'element' => $param_prefix . 'type',
				'value'   => '9wpthemes',
			),
			'admin_label' => $label,
			'std'         => $std,
			'description' => __( 'Select icon from library.', 'w9-floral-addon' ),
		);
	}
	
	static function get_icon_picker_floral( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'        => 'iconpicker',
			'heading'     => __( 'Icon', 'w9-floral-addon' ),
			'param_name'  => $param_prefix . 'icon_floral',
			'value'       => '', // default value to backend editor admin_label
			'settings'    => array(
				'emptyIcon'    => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 100,
				'type'         => 'floral',
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
//				'source'       => Floral_Icons::get_theme_floral_icons()
			),
			'dependency'  => array(
				'element' => $param_prefix . 'type',
				'value'   => 'floral',
			),
			'admin_label' => $label,
			'std'         => $std,
			'description' => __( 'Select icon from library.', 'w9-floral-addon' ),
		);
	}
	
	static function get_icon_picker_fontawesome( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_fontawesome',
			'value'                => 'fa fa-adjust', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 100,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'fontawesome',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icon_picker_openiconic( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_openiconic',
			'value'                => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'openiconic',
				'iconsPerPage' => 100, // default 100, how many icons per/page to display
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'openiconic',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icon_picker_typicons( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_typicons',
			'value'                => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'typicons',
				'iconsPerPage' => 100, // default 100, how many icons per/page to display
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'typicons',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icon_picker_entypo( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_entypo',
			'value'                => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'entypo',
				'iconsPerPage' => 100, // default 100, how many icons per/page to display
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'entypo',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icon_picker_linecons( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_linecons',
			'value'                => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'linecons',
				'iconsPerPage' => 100, // default 100, how many icons per/page to display
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'linecons',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icon_picker_monosocial( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'iconpicker',
			'heading'              => __( 'Icon', 'w9-floral-addon' ),
			'param_name'           => $param_prefix . 'icon_monosocial',
			'value'                => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
			'settings'             => array(
				'emptyIcon'    => false, // default true, display an "EMPTY" icon?
				'type'         => 'monosocial',
				'iconsPerPage' => 100, // default 100, how many icons per/page to display
			),
			'dependency'           => array(
				'element' => $param_prefix . 'type',
				'value'   => 'monosocial',
			),
			'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
			'admin_label'          => $label,
			'std'                  => $std,
			'integrated_shortcode' => 'vc_icon'
		);
	}
	
	static function get_icons_picker_type( $std = '', $label = true, $param_prefix = '' ) {
		return array(
			'type'                 => 'dropdown',
			'heading'              => __( 'Icon library', 'w9-floral-addon' ),
			'value'                => array(
				__( '9WPThemes', 'w9-floral-addon' )    => '9wpthemes',
				__( 'Floral', 'w9-floral-addon' )       => 'floral',
				__( 'Font Awesome', 'w9-floral-addon' ) => 'fontawesome',
				__( 'Open Iconic', 'w9-floral-addon' )  => 'openiconic',
				__( 'Typicons', 'w9-floral-addon' )     => 'typicons',
				__( 'Entypo', 'w9-floral-addon' )       => 'entypo',
				__( 'Linecons', 'w9-floral-addon' )     => 'linecons',
				__( 'Mono Social', 'w9-floral-addon' )  => 'monosocial',
			),
			'std'                  => $std,
			'admin_label'          => $label,
			'param_name'           => $param_prefix . 'type',
			'description'          => __( 'Select icon library.', 'w9-floral-addon' ),
			'integrated_shortcode' => 'vc_icon'
		);
		
	}
	
	static function get_class_animation( $css_animation ) {
		$output = '';
		if ( '' !== $css_animation ) {
			wp_enqueue_script( 'waypoints' );
			$output = ' wpb_animate_when_almost_visible floral-css-animation wpb_' . $css_animation;
		}
		
		return $output;
	}
	
	static function get_animation_duration_n_delay( $duration = 0, $delay = 0 ) {
		$styles = array();
		if ( $duration !== 0 && ! empty( $duration ) ) {
			$duration = (float) trim( $duration, "\n\ts" );
			$styles[] = "-webkit-animation-duration: {$duration}s";
			$styles[] = "-moz-animation-duration: {$duration}s";
			$styles[] = "-ms-animation-duration: {$duration}s";
			$styles[] = "-o-animation-duration: {$duration}s";
			$styles[] = "animation-duration: {$duration}s";
		}
		if ( $delay !== 0 && ! empty( $delay ) ) {
			$delay = (float) trim( $delay, "\n\ts" );
//            $styles[] = "opacity: 0";
			$styles[] = "-webkit-animation-delay: {$delay}s";
			$styles[] = "-moz-animation-delay: {$delay}s";
			$styles[] = "-ms-animation-delay: {$delay}s";
			$styles[] = "-o-animation-delay: {$delay}s";
			$styles[] = "animation-delay: {$delay}s";
		}
//        if ( count( $styles ) > 1 ) {
//            return 'style="' . implode( ';', $styles ) . '"';
//        }
//
//        return implode( ';', $styles );
		return $styles;
	}
	
	static function get_inline_style( $styles, $duration = 0, $delay = 0 ) {
		if ( is_string( $styles ) ) {
			$styles = explode( ';', preg_replace( "/\r|\n/", " ", strip_tags( $styles ) ) );
		}
		
		$styles = array_merge( $styles, self::get_animation_duration_n_delay( $duration, $delay ) );
		
		if ( count( $styles ) > 0 ) {
			return 'style="' . implode( '; ', $styles ) . '"';
		}
		
		return '';
	}
	
	
	static function hex_to_rgba( $hex, $opacity = 1 ) {
		$hex = str_replace( "#", "", $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
		
		return $rgba;
	}
	
	static function get_colors() {
		return array_merge( array(
			__( 'Default CSS', 'w9-floral-addon' )  => '__',
			__( 'Transparent', 'w9-floral-addon' )  => 'transparent',
			__( 'Custom Color', 'w9-floral-addon' ) => 'custom',
		), self::get_just_colors() );
	}
	
	static function get_just_colors() {
		return array_merge( array(
			__( 'Primary Color', 'w9-floral-addon' )   => 'p',
			__( 'Secondary Color', 'w9-floral-addon' ) => 's',
			__( 'Text Color', 'w9-floral-addon' )      => 'text',
			__( 'Meta Text Color', 'w9-floral-addon' ) => 'meta-text',
			__( 'Border Color', 'w9-floral-addon' )    => 'border',
			__( 'Light #FFF', 'w9-floral-addon' )      => 'light',
			__( 'Dark #000', 'w9-floral-addon' )       => 'dark',
			__( 'Gray #222', 'w9-floral-addon' )       => 'gray2',
			__( 'Gray #444', 'w9-floral-addon' )       => 'gray4',
			__( 'Gray #666', 'w9-floral-addon' )       => 'gray6',
			__( 'Gray #888', 'w9-floral-addon' )       => 'gray8',
		), floral_get_most_used_colors( 'name_key' ) );
	}
	
	static function get_color_value( $color ) {
		switch ( $color ) {
			case 'inherit':
				return 'inherit';
			case 'custom':
				return 'custom';
			case 'transparent':
				return 'transparent';
			case 'p':
				return floral_get_option( 'primary-color' );
			case 's':
				return floral_get_option( 'secondary-color' );
			case 'text':
				return floral_get_option( 'text-color' );
			case 'meta-text':
				return floral_get_option( 'meta-text-color' );
			case 'border':
				return floral_get_option( 'border-color' );
			case 'dark':
				return '#000000';
			case 'gray2':
				return '#222222';
			case 'gray4':
				return '#444444';
			case 'gray6':
				return '#666666';
			case 'gray8':
				return '#888888';
			case 'light':
				return '#ffffff';
			default:
				$most_used_color = floral_get_most_used_colors( 'color', $color );
				
				return ! empty( $most_used_color ) ? $most_used_color : '';
		}
	}
	
	static function get_gradient_inline_style( $color_1, $color_2, $angle = '' ) {
		$inline_style = array();
		if ( ! empty( $angle ) && floatval( $angle ) ) {
			$angle        = $angle . 'deg';
			$webkit_angle = ( 90 - floatval( $angle ) ) . 'deg';
		} else {
			$angle        = 'to right';
			$webkit_angle = 'left';
		}
		
		$inline_style[] = 'border: none';
		$inline_style[] = 'background-color: ' . $color_1;
		$inline_style[] = 'background-image: -webkit-linear-gradient(' . $webkit_angle . ', ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
		$inline_style[] = 'background-image: linear-gradient(' . $angle . ', ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
		
		return $inline_style;
	}
	
	
	static function adjust_color( $color_code, $func = 'lighter', $amount = 10 ) {
		Floral_Addon::require_floral_color();
		$hex_pattern  = '/^#(?:[A-Fa-f0-9]{3}){1,2}$/i';
		$rgb_partern  = '/^rgb[(](?:\s*0*(?:\d\d?(?:\.\d+)?(?:\s*%)?|\.\d+\s*%|100(?:\.0*)?\s*%|(?:1\d\d|2[0-4]\d|25[0-5])(?:\.\d+)?)\s*(?:,(?![)])|(?=[)]))){3}[)]$/i';
		$rgba_partern = '/^rgba[(](?:\s*0*(?:\d\d?(?:\.\d+)?(?:\s*%)?|\.\d+\s*%|100(?:\.0*)?\s*%|(?:1\d\d|2[0-4]\d|25[0-5])(?:\.\d+)?)\s*,){3}\s*0*(?:\.\d+|1(?:\.0*)?)\s*[)]$/i';
		
		// is rgb || is rgba
		$alpha = 1;
		if ( @preg_match( $rgb_partern, $color_code ) || @preg_match( $rgba_partern, $color_code ) ) {
			$rgb       = str_replace( array(
				'rgba',
				'rgb',
				'(',
				')',
			), '', $color_code );
			$rgb       = explode( ',', $rgb );
			$rgb_array = array(
				'R' => $rgb[0],
				'G' => $rgb[1],
				'B' => $rgb[2],
			);
			
			if ( isset( $rgb[3] ) ) {
				$alpha = $rgb[3];
			}
			
			$color_code = '#' . Floral_Color::rgbToHex( $rgb_array );
		}
		
		// is hex
		if ( @preg_match( $hex_pattern, $color_code ) ) {
			$color_obj = new Floral_Color( $color_code );
			
			try {
				switch ( $func ) {
					case 'lighter':
						$_adjusted = $color_obj->lighten( $amount );
						break;
					case 'bolder':
						$_adjusted = $color_obj->darken( $amount );
						break;
					default:
						return false;
				}
				
				if ( $alpha == 1 ) {
					return '#' . $_adjusted;
				} else {
					return self::hex_to_rgba( '#' . $_adjusted, $alpha );
				}
				
			} catch ( Exception $e ) {
				return false;
			}
		}
		
		return false;
	}
	
	static function width_list() {
		return array(
			__( '1 column - 1/12', 'w9-floral-admin' )    => 'vc_col-sm-1',
			__( '2 columns - 1/6', 'w9-floral-admin' )    => 'vc_col-sm-2',
			__( '3 columns - 1/4', 'w9-floral-admin' )    => 'vc_col-sm-3',
			__( '4 columns - 1/3', 'w9-floral-admin' )    => 'vc_col-sm-4',
			__( '5 columns - 5/12', 'w9-floral-admin' )   => 'vc_col-sm-5',
			__( '6 columns - 1/2', 'w9-floral-admin' )    => 'vc_col-sm-6',
			__( '7 columns - 7/12', 'w9-floral-admin' )   => 'vc_col-sm-7',
			__( '8 columns - 2/3', 'w9-floral-admin' )    => 'vc_col-sm-8',
			__( '9 columns - 3/4', 'w9-floral-admin' )    => 'vc_col-sm-9',
			__( '10 columns - 5/6', 'w9-floral-admin' )   => 'vc_col-sm-10',
			__( '11 columns - 11/12', 'w9-floral-admin' ) => 'vc_col-sm-11',
			__( '12 columns - 1/1', 'w9-floral-admin' )   => 'vc_col-sm-12',
		);
	}
	
	static function item_width( $std = 'vc_col-sm-4' ) {
		return array(
			'type'       => 'dropdown',
			'heading'    => __( 'Item width', 'w9-floral-addon' ),
			'param_name' => 'floral_item_width',
			'value'      => self::width_list(),
			'std'        => $std,
		);
	}
	
	static function responsive_item_width() {
		return array(
			'type'        => 'column_offset',
			'heading'     => __( 'Single item width in each screen size', 'w9-floral-addon' ),
			'param_name'  => 'floral_responsive_item_width',
			'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
			'description' => __( 'Adjust item width for different screen sizes.', 'w9-floral-addon' ),
		);
	}
	
	/**
	 * Taken from js_composer/include/classes/vendors/plugins/class-vc-vendor-woocommerce.php
	 *
	 * @param $parent_id
	 * @param $pos
	 * @param $array
	 * @param $level
	 * @param $dropdown
	 */
	static function getCategoryChildsFull( $parent_id, $pos, $array, $level, &$dropdown ) {
		
		for ( $i = $pos; $i < count( $array ); $i ++ ) {
			if ( $array[ $i ]->category_parent == $parent_id ) {
				$name       = str_repeat( '- ', $level ) . $array[ $i ]->name;
				$value      = $array[ $i ]->slug;
				$dropdown[] = array(
					'label' => $name,
					'value' => $value,
				);
				self::getCategoryChildsFull( $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
			}
		}
	}
	
	static function get_categories_for_param_multi_select( $parent_id, $pos, $array, $level, &$multi_select ) {
		for ( $i = $pos; $i < count( $array ); $i ++ ) {
			if ( $array[ $i ]->category_parent == $parent_id ) {
				$name       = str_repeat( '- ', $level ) . $array[ $i ]->name;
				$value      = $array[ $i ]->slug;
				$multi_select[$value] = $name;
//				$multi_select[] = array(
//					'label' => $name,
//					'value' => $value,
//				);
				self::get_categories_for_param_multi_select( $array[ $i ]->term_id, $i, $array, $level + 1, $multi_select );
			}
		}
	}
	
	static function number_item_per_row() {

//        return array(
//            'type'        => 'param_group',
//            'heading'     => __( 'Number item per row', 'w9-floral-addon' ),
//            'description' => __( 'Define number column per row in each screen size.', 'w9-floral-addon' ),
//            'param_name'  => 'number_item_per_row',
//            'value'       => urlencode( json_encode( array(
//                array(
//                    'screen_size'   => 'xs',
//                    'number_column' => '12'
//                ),
//                array(
//                    'screen_size'   => 'sm',
//                    'number_column' => '3'
//                )
//            ) ) ),
//            'max_items' => '5',
//            'params'      => array(
//                array(
//                    'type'        => 'dropdown',
//                    'heading'     => __( 'Screen Size', 'w9-floral-addon' ),
//                    'param_name'  => 'screen_size',
//                    'admin_label' => true,
//                    'edit_field_class' => 'vc_col-sm-8 vc_column-with-padding',
//                    'value'       => array(
//                        __( 'Mobile and larger (>0px)', 'w9-floral-addon' )           => 'xs',
//                        __( 'Tablet and larger (>768px)', 'w9-floral-addon' )         => 'sm',
//                        __( 'Small desktop and larger (>992px)', 'w9-floral-addon' )  => 'md',
//                        __( 'Large desktop and larger (>1200px)', 'w9-floral-addon' ) => 'lg',
//                        __( 'Wide desktop and larger (>1600px)', 'w9-floral-addon' )  => 'xlg',
//                    ),
//                ),
//                array(
//                    'type'        => 'dropdown',
//                    'heading'     => __( 'Number Column', 'w9-floral-addon' ),
//                    'param_name'  => 'number_column',
//                    'description' => __( 'Number column per row in this screen.', 'w9-floral-addon' ),
//                    'admin_label' => true,
//                    'edit_field_class' => 'vc_col-sm-4',
//                    'value'       => array(
//                        __( '12', 'w9-floral-addon' ) => '1',
//                        __( '6', 'w9-floral-addon' )  => '2',
//                        __( '4', 'w9-floral-addon' )  => '3',
//                        __( '3', 'w9-floral-addon' )  => '4',
//                        __( '2', 'w9-floral-addon' )  => '6',
//                        __( '1', 'w9-floral-addon' )  => '12',
//                    ),
//                    'std' => '4',
//                ),
//            ),
//            'callbacks' => array(
//                'after_add'  => 'vcItemPerRowParamAfterAddCallback',
//                'after_delete' => 'vcItemPerRowParamAfterDeleteCallback',
//            ),
//        );
	}
	
	static function get_triangle_svg( $svg_type, $angle_deg, $background_color, $absolute = true, $class = '' ) {
		$html           = '';
		$wrapper_height = 0;
		$height         = 1000 * tan( absint( $angle_deg ) * pi() / 180 );
		if ( $absolute === false ) {
			$wrapper_height = $height;
		}
		$height = intval( $height );
		
		
		$class = floral_clean_html_classes( $class );
		
		switch ( $svg_type ) {
			case 'top-left':
				$points   = "0,0 1000,0 1000,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'bottom-left':
				$points   = "0,$height 1000,0 1000,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'top-right':
				$points   = "0,$height 0,0 1000,0";
				$view_box = "0 0 1000 $height";
				break;
			case 'bottom-right':
				$points   = "0,$height 0,0 1000,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'top-center':
				$height   = $height / 2;
				$points   = "0,0 1000,0 500,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'bottom-center':
				$height   = $height / 2;
				$points   = "500,0 1000,$height 0,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'top-center-reversed':
				$height   = $height / 2;
				$points   = "0,0 1000,0 1000,$height 500,0 0,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'bottom-center-reversed':
				$height   = $height / 2;
				$points   = "0,0 500,$height 1000,0 1000,$height 0,$height";
				$view_box = "0 0 1000 $height";
				break;
			case 'right-top':
				$view_box = "0 0 $height 1000";
				$points   = "$height,0 $height,1000 0,1000";
				break;
			case 'right-middle':
				$height   = $height / 2;
				$view_box = "0 0 $height 1000";
				$points   = "$height,0 0,500 $height,1000";
				break;
			case 'right-middle-reversed':
				$height   = $height / 2;
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,0 $height,1000 0,1000 $height,500";
				break;
			case 'right-bottom':
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,1000 $height,0";
				break;
			case 'left-top':
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,1000 0,1000";
				break;
			case 'left-middle':
				$height   = $height / 2;
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,500 0,1000";
				break;
			case 'left-middle-reversed':
				$height   = $height / 2;
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,0 0,500 $height,1000 0,1000";
				break;
			case 'left-bottom':
				$view_box = "0 0 $height 1000";
				$points   = "0,0 $height,0 0,1000";
				break;
			
		}
		if ( isset( $points ) && isset( $view_box ) ) {
			$html = <<<HTML
<div class="sloped-edge $class" style="padding-top: $wrapper_height%">
<svg viewBox="$view_box" shape-rendering="auto">
  <polygon  points="$points" style="fill: $background_color"/>
</svg>
</div>
HTML;
		}
		
		return $html;
	}
	
	static function widget_common_params() {
		return array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'floral_extra_widget_classes',
				'heading'     => esc_html__( 'Widget extra class', 'w9-floral-addon' ),
				'description' => __( 'Add one or more extra classes to widget.', 'w9-floral-addon' ),
			),
			
			array(
				'type'        => 'switcher',
				'param_name'  => 'floral_remove_default_mb',
				'std'         => '1',
				'heading'     => esc_html__( ' Widget remove default margin bottom', 'w9-floral-addon' ),
				'description' => __( 'Each widget has its own margin bottom property, this option will remove them.', 'w9-floral-addon' ),
			),
			
			Floral_Map_Helpers::design_options(),
			Floral_Map_Helpers::animation_css(),
			Floral_Map_Helpers::animation_duration(),
			Floral_Map_Helpers::animation_delay(),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Widget wrapper extra class', 'w9-floral-addon' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Add one or more extra classes to widget wrapper.', 'w9-floral-addon' )
			)
		);
	}
}

      