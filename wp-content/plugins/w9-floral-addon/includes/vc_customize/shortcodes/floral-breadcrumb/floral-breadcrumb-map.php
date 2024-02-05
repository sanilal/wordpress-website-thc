<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-breadcrumb-map.php
 * @time    : 1/7/2017 11:58 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map(
	array(
		'name'           => esc_html__( 'Floral Breadcrumb', 'w9-floral-addon' ),
		'base'           => Floral_SC_Breadcrumb::SC_BASE,
		'icon'           => 'w9 w9-ico-dot-3',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Breadcrumb',
//		'description'    => __( 'Floral widget download', 'w9-floral-addon' ),
		'params'         => array(
//			array(
//				'type'       => 'textfield',
//				'param_name' => 'prepended_text',
//				'heading'    => __( 'Prepended text', 'w9-floral-addon' ),
//				'std'        => __( 'You are here:', 'w9-floral-addon' )
//			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'heading'    => __( 'Text color', 'w9-floral-addon' ),
				'value'      => array_merge( array(
					__( 'Default CSS', 'w9-floral-addon' )  => '__',
					__( 'Custom Color', 'w9-floral-addon' ) => 'custom',
				), Floral_Map_Helpers::get_just_colors() ),
				'param_holder_class' => 'vc_colored-dropdown',
				'std'        => 'light'
			),
			
			array(
				'type'       => 'colorpicker',
				'param_name' => 'text_color_cp',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => 'custom'
				),
				'std'        => ''
			),
			
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_color',
				'heading'    => __( 'Background color', 'w9-floral-addon' ),
				'std'        => 'rgba(0, 0, 0, 0.4)'
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'position',
				'admin_label' => true,
				'heading'     => __( 'Breadcrumbs position', 'w9-floral-addon' ),
				'value'       => array(
					__( 'Left', 'w9-floral-addon' )    => 'left',
					__( 'Right', 'w9-floral-addon' )    => 'right'
				),
				'std'         => 'left'
			),
			Floral_Map_Helpers::extra_class(),
			Floral_Map_Helpers::design_options(),
			Floral_Map_Helpers::animation_css(),
			Floral_Map_Helpers::animation_duration(),
			Floral_Map_Helpers::animation_delay()
		),
	)
);