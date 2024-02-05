<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-social-profiles-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => esc_html__( 'Floral Widget Social Profiles', 'w9-floral-addon' ),
	'base'           => Floral_SC_Social_Profiles::SC_BASE,
	'icon'           => 'w9 w9-ico-facebook',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'php_class_name' => 'Floral_SC_Social_Profiles',
	'description'    => __( 'Create social share or social profile icons', 'w9-floral-addon' ),
	'params'         => array_merge( array(
		array(
			'type'        => 'textfield',
			'param_name'  => 'title',
			'heading'     => __( 'Widget title', 'w9-floral-addon' ),
			'description' => __( 'What text use as a widget title. Leave blank if you don\' want to show the widget title.', 'w9-floral-addon' ),
			'std'         => ''
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Module type', 'w9-floral-addon' ),
			'param_name'  => 'module_type',
			'value'       => array(
				__( 'Social URL', 'w9-floral-addon' ) => 'social-url',
				__( 'Share This', 'w9-floral-addon' ) => 'share-this'
			),
			'admin_label' => true,
			'std'         => 'social-url',
			'description' => __( 'Select the module type.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'multi-select',
			'heading'     => __( 'Social profiles', 'w9-floral-addon' ),
			'param_name'  => 'profiles',
			'options'     => array(
				'social-twitter-url'    => __( 'Twitter', 'w9-floral-addon' ),
				'social-facebook-url'   => __( 'Facebook', 'w9-floral-addon' ),
				'social-dribbble-url'   => __( 'Dribbble', 'w9-floral-addon' ),
				'social-vimeo-url'      => __( 'Vimeo', 'w9-floral-addon' ),
				'social-tumblr-url'     => __( 'Tumblr', 'w9-floral-addon' ),
				'social-skype-url'      => __( 'Skype', 'w9-floral-addon' ),
				'social-linkedin-url'   => __( 'LinkedIn', 'w9-floral-addon' ),
				'social-googleplus-url' => __( 'Google+', 'w9-floral-addon' ),
				'social-flickr-url'     => __( 'Flickr', 'w9-floral-addon' ),
				'social-youtube-url'    => __( 'YouTube', 'w9-floral-addon' ),
				'social-pinterest-url'  => __( 'Pinterest', 'w9-floral-addon' ),
				'social-foursquare-url' => __( 'Foursquare', 'w9-floral-addon' ),
				'social-instagram-url'  => __( 'Instagram', 'w9-floral-addon' ),
				'social-github-url'     => __( 'GitHub', 'w9-floral-addon' ),
				'social-xing-url'       => __( 'Xing', 'w9-floral-addon' ),
				'social-behance-url'    => __( 'Behance', 'w9-floral-addon' ),
				'social-deviantart-url' => __( 'Deviantart', 'w9-floral-addon' ),
				'social-soundcloud-url' => __( 'SoundCloud', 'w9-floral-addon' ),
				'social-yelp-url'       => __( 'Yelp', 'w9-floral-addon' ),
				'social-rss-url'        => __( 'RSS Feed', 'w9-floral-addon' ),
				'social-email-url'      => __( 'Email address', 'w9-floral-addon' ),
			),
			'dependency'  => array(
				'element' => 'module_type',
				'value'   => array( 'social-url' )
			),
			'std'         => 'social-twitter-url||social-facebook-url||social-googleplus-url',
			'description' => __( 'Select which profile to show out.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'textfield',
			'param_name'  => 'share_this_label',
			'heading'     => esc_html__( 'Share this label', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'module_type',
				'value'   => array( 'share-this' )
			),
			'description' => __( 'Enter share this label before icons.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'dropdown',
			'param_name'  => 'alignment',
			'heading'     => __( 'Alignment', 'w9-floral-addon' ),
			'value'       => array(
				__( 'Default', 'w9-floral-addon' ) => '',
				__( 'Inline', 'w9-floral-addon' )  => 'inline-block-el',
				__( 'Left', 'w9-floral-addon' )    => 'text-left',
				__( 'Center', 'w9-floral-addon' )  => 'text-center',
				__( 'Right', 'w9-floral-addon' )   => 'text-right',
			),
			'std'         => '',
			'admin_label' => true,
			'description' => __( 'Module alignment.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'slider',
			'param_name'  => 'icon_size',
			'min'         => '10',
			'max'         => '40',
			'step'        => '1',
			'std'         => '20',
			'heading'     => __( 'Icon size (px)', 'w9-floral-addon' ),
			'admin_label' => true,
			'description' => __( 'Select icon size, just slide the thumb.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'dropdown',
			'param_name'  => 'icon_color',
			'heading'     => __( 'Icon color', 'w9-floral-addon' ),
			'value'       => array(
				__( 'Inherit link color', 'w9-floral-addon' ) => 'inherit',
				__( 'Custom style', 'w9-floral-addon' )       => 'custom-style',
			),
			'admin_label' => true,
			'std'         => 'inherit',
			'description' => __( 'Select icon color tyle.', 'w9-floral-addon' ),
		),
		
		array(
			'type'               => 'dropdown',
			'param_name'         => 'colors',
			'heading'            => __( 'Color', 'w9-floral-addon' ),
			'value'              => array_merge( array(
				__( 'Default CSS', 'w9-floral-addon' )  => '__',
				__( 'Custom Color', 'w9-floral-addon' ) => 'custom',
			), Floral_Map_Helpers::get_just_colors() ),
			'param_holder_class' => 'vc_colored-dropdown',
			'dependency'         => array(
				'element' => 'icon_color',
				'value'   => array( 'custom-style' ),
			),
			'std'                => 'text',
			'description'        => __( 'Select icon color.', 'w9-floral-addon' ),
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'colors_cp',
			'dependency' => array(
				'element' => 'colors',
				'value'   => 'custom'
			),
			'std'        => ''
		),
		
		array(
			'type'               => 'dropdown',
			'param_name'         => 'colors_hover',
			'heading'            => __( 'Color - Hover', 'w9-floral-addon' ),
			'value'              => array_merge( array(
				__( 'Default CSS', 'w9-floral-addon' )  => '__',
				__( 'Custom Color', 'w9-floral-addon' ) => 'custom',
			), Floral_Map_Helpers::get_just_colors() ),
			'param_holder_class' => 'vc_colored-dropdown',
			'dependency'         => array(
				'element' => 'icon_color',
				'value'   => array( 'custom-style' ),
			),
			'std'                => 'p',
			'description'        => __( 'Select icon color on hover.', 'w9-floral-addon' ),
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'colors_hover_cp',
			'dependency' => array(
				'element' => 'colors_hover',
				'value'   => 'custom'
			),
			'std'        => ''
		),
		
		array(
			'type'        => 'switcher',
			'param_name'  => 'is_rounded_icon',
			'heading'     => __( 'Is rounded icon?', 'w9-floral-addon' ),
			'std'         => '0',
			'description' => __( 'Is the icon rounded?', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'slider',
			'param_name'  => 'rounded_size',
			'min'         => '20',
			'max'         => '60',
			'step'        => '1',
			'std'         => '35',
			'heading'     => __( 'Size (px)', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'is_rounded_icon',
				'value'   => array( '1' ),
//                        'not_equal_to' => '1'
			),
			'description' => __( 'Select the circle size.', 'w9-floral-addon' ),
		),
		
		array(
			'type'               => 'dropdown',
			'param_name'         => 'background_colors',
			'heading'            => __( 'Background color', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_colors(),
			'param_holder_class' => 'vc_colored-dropdown',
			'std'                => '__',
			'dependency'         => array(
				'element' => 'is_rounded_icon',
				'value'   => array( '1' ),
			),
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'background_colors_cp',
			'dependency' => array(
				'element' => 'background_colors',
				'value'   => 'custom'
			),
			'std'        => ''
		),
		
		array(
			'type'               => 'dropdown',
			'param_name'         => 'background_hover_colors',
			'heading'            => __( 'Background hover color', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_colors(),
			'param_holder_class' => 'vc_colored-dropdown',
			'std'                => '__',
			'dependency'         => array(
				'element' => 'is_rounded_icon',
				'value'   => array( '1' ),
			)
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'background_hover_colors_cp',
			'dependency' => array(
				'element' => 'background_hover_colors',
				'value'   => 'custom'
			),
			'std'        => ''
		),
		
		array(
			'type'        => 'slider',
			'param_name'  => 'spacing_between_items',
			'heading'     => __( 'Spacing between items (px)', 'w9-floral-addon' ),
			'min'         => '10',
			'max'         => '50',
			'step'        => '5',
			'std'         => '10',
			'description' => __( 'Select the spacing between items.', 'w9-floral-addon' ),
		)
	), Floral_Map_Helpers::widget_common_params() )
) );