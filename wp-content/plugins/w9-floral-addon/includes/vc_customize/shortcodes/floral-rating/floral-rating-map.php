<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-rating-map.php
 * @time    : 7/8/2017 11:38 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => esc_html__( 'Floral Rating', 'w9-floral-addon' ),
	'base'           => Floral_SC_Rating::SC_BASE,
	'class'          => '',
	'icon'           => 'fa fa-star',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'php_class_name' => 'Floral_SC_Rating',
//	'description'    => __( 'Create team member with social profile', 'w9-floral-addon' ),
	'params'         => array(
		array(
			'type'        => 'slider',
			'heading'     => __( 'Rating', 'w9-floral-addon' ),
			'param_name'  => 'rating',
			'min'         => '1',
			'max'         => '5',
			'step'        => '0.1',
			'std'         => '5',
			'description' => __( 'Choose rating' )
		),
		
		array(
			'type'        => 'number',
			'heading'     => esc_html__( 'Star size', 'w9-floral-addon' ),
			'param_name'  => 'star_size',
			'value'       => '15',
			'description' => esc_html__( 'Enter icon size (Unit: px, Default: 15). ', 'w9-floral-addon' ),
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'star_color',
			'heading'    => __( 'Star color', 'w9-floral-addon' ),
			'std'        => '#ddd'
		),
		
		array(
			'type'       => 'dropdown',
			'param_name' => 'star_rated_color',
			'heading'    => __( 'Star (rated) color', 'w9-floral-addon' ),
			'value'      => array_merge( array(
				__( 'Default CSS', 'w9-floral-addon' )  => '__',
				__( 'Custom Color', 'w9-floral-addon' ) => 'custom',
			), Floral_Map_Helpers::get_just_colors() ),
			'param_holder_class' => 'vc_colored-dropdown',
			'std'        => 'p'
		),
		
		array(
			'type'       => 'colorpicker',
			'param_name' => 'star_rated_color_cp',
			'dependency' => array(
				'element' => 'star_rated_color',
				'value'   => 'custom'
			),
			'std'        => ''
		),
		
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay(),
		Floral_Map_Helpers::extra_class()
	)
) );


