<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service-panel-map.php
 * @time    : 7/17/2017 6:08 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

$service_names = array();
if ( is_array( $service_get_posts ) ) {
	foreach ( $service_get_posts as $item ) {
		$service_names[ $item->ID ] = $item->post_title . ' (id: ' . $item->ID .')';
	}
}
//var_dump( $service_names );

vc_map(
	array(
		'name'           => esc_html__( 'Floral Services Panel', 'w9-floral-addon' ),
		'base'           => Floral_SC_Service_Panel::SC_BASE,
		'icon'           => 'fa fa-th-list',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Service_Panel',
		'description'    => __( 'This shortcode must be used with "full-width" row', 'w9-floral-addon' ),
		'params'         => array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Style', 'w9-floral-addon' ),
				'param_name'  => 'sp_style',
				'value'       => array(
					__( 'Style 1', 'w9-floral-addon' ) => 'style-1',
					__( 'Style 2', 'w9-floral-addon' ) => 'style-2',
				),
				'description' => __( 'Select the service panel style', 'w9-floral-addon' ),
			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Service Data', 'w9-floral-addon' ),
				'param_name' => 'sp_data',
				// 'admin_label' => true,
//				'value'      => urlencode( json_encode( array(
//					array(
//						'label' => esc_html__( 'Service Item', 'w9-floral-addon' ),
//						'value' => '',
//					),
//				) ) ),
				'params'     => array(
					array(
						'type'        => 'single-select',
						'heading'     => esc_html__( 'Service Item', 'w9-floral-addon' ),
						'param_name'  => 'id',
						'options'     => $service_names,
						'admin_label' => true,
						'description' => esc_html__( 'Choose service', 'w9-floral-addon' )
					),
					Floral_Map_Helpers::get_icons_picker_type( '9wpthemes', false ),
					Floral_Map_Helpers::get_icon_picker_9wpthemes( '', false ),
					Floral_Map_Helpers::get_icon_picker_floral( '', false ),
					Floral_Map_Helpers::get_icon_picker_fontawesome( '', false ),
					Floral_Map_Helpers::get_icon_picker_openiconic( '', false ),
					Floral_Map_Helpers::get_icon_picker_typicons( '', false ),
					Floral_Map_Helpers::get_icon_picker_entypo( '', false ),
					Floral_Map_Helpers::get_icon_picker_linecons( '', false ),
					Floral_Map_Helpers::get_icon_picker_monosocial( '', false ),
				),
			),
			
			Floral_Map_Helpers::extra_class(),
			Floral_Map_Helpers::design_options(),
			Floral_Map_Helpers::animation_css(),
			Floral_Map_Helpers::animation_duration(),
			Floral_Map_Helpers::animation_delay()
		),
	)
);