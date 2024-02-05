<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service-list-map.php
 * @time    : 4/24/2017 8:30 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

$service_cats      = floral_get_terms_by_tax( Floral_CPT_Service::TAX_SLUG, 'slug' );
//var_dump($service_cats);

vc_map( array(
	'name'     => __( 'Floral Service List', 'w9-floral-addon' ),
	'base'     => Floral_SC_Service_List::SC_BASE,
	'icon'     => 'fa fa-list-alt',
	'category' => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'php_class_name' => 'Floral_SC_Service_List',
	'params'   => array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Data source', 'w9-floral-addon' ),
			'param_name' => 'sl_data',
			'value'      => array(
				esc_html__( 'Create Data Manually' )   => 'manual',
				esc_html__( 'From Service Post Type' ) => 'cpt',
			),
			'std'        => 'manual',
		),
		array(
			'type'        => 'multi-select',
			'heading'     => esc_html__( 'Include (categories):', 'w9-floral-addon' ),
			'param_name'  => 'sl_category',
			'options'       => $service_cats,
			'dependency'  => array( 'element' => 'sl_data', 'value' => 'cpt' )
		),
		array(
			'type'       => 'param_group',
			'heading'    => esc_html__( 'Create Service Data', 'w9-floral-addon' ),
			'param_name' => 'sl_manual_data',
			// 'admin_label' => true,
			'value'      => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Service Item', 'w9-floral-addon' ),
					'value' => '',
				),
			) ) ),
			'dependency' => array( 'element' => 'sl_data', 'value' => 'manual' ),
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Service Name', 'w9-floral-addon' ),
					'param_name'  => 'name',
					'admin_label' => true,
					'value'       => '',
					'description' => esc_html__( 'Enter service name.', 'w9-floral-addon' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Service Time/Amount', 'w9-floral-addon' ),
					'param_name'  => 'time',
					'value'       => '',
					'admin_label' => true,
					'description' => esc_html__( 'Enter service time or amount.', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Service Price', 'w9-floral-addon' ),
					'param_name'  => 'price',
					'admin_label' => true,
					'value'       => '',
					'description' => esc_html__( 'Enter service price.', 'w9-floral-addon' )
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link (URL)', 'w9-floral-addon' ),
					'param_name' => 'link',
					'value'      => '',
				),
			),
		),
		array(
			'type'        => 'number',
			'heading'     => __( 'Total items', 'w9-floral-addon' ),
			'param_name'  => 'sl_total_items',
			'std'         => '10',
			'description' => __( 'Set max limit for items or enter - 1 to display all', 'w9-floral-addon' ),
			'dependency'  => array( 'element' => 'sl_data', 'value' => 'cpt' )
		),
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Text color', 'w9-floral-addon' ),
			'param_name'         => 'sl_tx_color',
			'param_holder_class' => 'vc_colored-dropdown',
			'value'              => Floral_Map_Helpers::get_colors(),
			'description'        => __( 'Select Color Scheme.', 'w9-floral-addon' ),
//			'edit_field_class'   => 'vc_col-sm-6 vc_column'
		),
		array(
			'type'             => 'colorpicker',
			'heading'          => __( 'Custom text color', 'w9-floral-addon' ),
			'param_name'       => 'sl_tx_custom_color',
			'value'            => '',
			'dependency'       => array(
				'element' => 'sl_tx_color',
				'value'   => 'custom'
			),
//			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
//		array(
//			'type'               => 'dropdown',
//			'heading'            => __( 'Line color', 'w9-floral-addon' ),
//			'param_name'         => 'sl_line_color',
//			'param_holder_class' => 'vc_colored-dropdown',
//			'value'              => Floral_Map_Helpers::get_colors(),
//			'description'        => __( 'Select Color Scheme.', 'w9-floral-addon' ),
//			'edit_field_class'   => 'vc_col-sm-6 vc_column'
//		),
//		array(
//			'type'             => 'colorpicker',
//			'heading'          => __( 'Custom line color', 'w9-floral-addon' ),
//			'param_name'       => 'sl_line_custom_color',
//			'value'            => '',
//			'dependency'       => array(
//				'element' => 'sl_line_color',
//				'value'   => 'custom'
//			),
//			'edit_field_class' => 'vc_col-sm-6 vc_column'
//		),
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay()
	)
) );