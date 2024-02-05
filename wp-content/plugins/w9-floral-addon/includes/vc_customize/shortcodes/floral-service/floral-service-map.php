<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service-map.php
 * @time    : 4/20/2017 3:02 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

$slider_params = vc_map_integrate_shortcode( Floral_SC_Slider_Container::SC_BASE, '', __( 'Slider', 'w9-floral-addon' ), array(
	'exclude' => array(
		'css',
		'el_class',
		'animation_css',
		'animation_duration',
		'animation_delay',
		'tablet_css',
		'mobile_css',
	),
	// we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
), array(
	'element' => 'services_layout_type',
	'value'   => 'layout-slider',
) );

$service_cats      = floral_get_terms_by_tax( Floral_CPT_Service::TAX_SLUG, 'slug' );
$service_cpt_slug  = Floral_CPT_Service::CPT_SLUG;
$service_get_posts = get_posts( array(
	'posts_per_page' => - 1,
	'post_status'    => 'any',
	'post_type'      => $service_cpt_slug,
	'post_parent'    => null
) );
$service_names = array();
if ( is_array( $service_get_posts ) ) {
	foreach ( $service_get_posts as $item ) {
		$service_names[ $item->ID ] = $item->post_title;
	}
}
//var_dump( $service_names );

vc_map(
	array(
		'name'           => esc_html__( 'Floral Services', 'w9-floral-addon' ),
		'base'           => Floral_SC_Service::SC_BASE,
		'icon'           => 'w9 w9-ico-cd',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Service',
		'params'         => array_merge(
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Data Source', 'osthemes-pure' ),
					'param_name' => 'services_data',
					'value'      => array(
						__( 'Select by categories', 'w9-floral-addon' ) => 'category',
						__( 'Select by names', 'w9-floral-addon' )      => 'name',
					),
				),
				array(
					'type'       => 'multi-select',
					'heading'    => __( 'Include (categories):', 'osthemes-pure' ),
					'param_name' => 'services_category',
					'options'    => $service_cats,
					'dependency'  => array(
						'element' => 'services_data',
						'value'   => array( 'category' ),
					),
				),
				array(
					'type'       => 'multi-select',
					'heading'    => __( 'Include (names):', 'osthemes-pure' ),
					'param_name' => 'services_name',
					'options'    => $service_names,
					'dependency'  => array(
						'element' => 'services_data',
						'value'   => array( 'name' ),
					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Style', 'w9-floral-addon' ),
					'param_name'  => 'services_style',
					'value'       => array(
						__( 'Style 1', 'w9-floral-addon' )               => 'style-1',
						__( 'Style 2', 'w9-floral-addon' )               => 'style-2',
					),
					'description' => __( 'Select the services style', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Layout type', 'w9-floral-addon' ),
					'param_name'  => 'services_layout_type',
					'value'       => array(
						__( 'Grid', 'w9-floral-addon' )   => 'layout-grid',
						__( 'Slider', 'w9-floral-addon' ) => 'layout-slider',
					),
					'description' => __( 'Select the layout type for the services.', 'w9-floral-addon' ),
				),
				
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Equal height items ?', 'w9-floral-addon' ),
					'param_name' => 'services_equal_height_items',
					'value'      => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
					'std'        => 'yes'
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort order', 'w9-floral-addon' ),
					'param_name'  => 'services_sort_order',
					'value'       => array(
						__( 'Random', 'w9-floral-addon' )  => 'random',
//						__( 'Popular', 'w9-floral-addon' ) => 'popular',
						__( 'Recent', 'w9-floral-addon' )  => 'recent',
						__( 'Oldest', 'w9-floral-addon' )  => 'oldest'
					),
					'std'         => 'recent',
					'description' => __( 'Select sorting order . ', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'services_data',
						'value'   => array( 'category' ),
					),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Total items', 'w9-floral-addon' ),
					'param_name'  => 'services_total_items',
					'std'         => '3',
					'description' => __( 'Set max limit for items or enter - 1 to display all', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Column', 'w9-floral-addon' ),
					'param_name'  => 'services_column',
					'min'         => '1',
					'max'         => '4',
					'std'         => '3',
					'description' => __( 'Set the column numbers( min: 1, max: 4)', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'services_layout_type',
						'value'   => array( 'layout-grid' ),
					),
				),
				
				// Meta
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Image size', 'w9-floral-addon' ),
					'param_name'  => 'services_image_size',
					'value'       => get_intermediate_image_sizes(),
					'std'         => 'floral_570',
					'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
					'group'       => __( 'Meta', 'w9-floral-addon' ),
//					'dependency'  => array(
//						'element' => 'source',
//						'value'   => array( 'media_library', 'featured_image' ),
//					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Image ratio', 'w9-floral-addon' ),
					'description' => __( 'Image ratio base on image size width . ', 'w9-floral-addon' ),
					'param_name'  => 'services_image_ratio',
					'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
					'group'       => __( 'Meta', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'services_style',
						'value'   => array( 'style-1' ),
					),
					'std'         => '0.666666667'
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show price ? ', 'w9-floral-addon' ),
					'param_name'       => 'services_show_price',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show time/amount ? ', 'w9-floral-addon' ),
					'param_name'       => 'services_show_time',
					'std'              => '0',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show booking button ? ', 'w9-floral-addon' ),
					'param_name'       => 'services_show_booking_btn',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
//					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Booking Button Text', 'w9-floral-addon' ),
					'param_name'  => 'services_booking_btn_tx',
					'group'       => __( 'Meta', 'w9-floral-addon' ),
					'std'         => 'BOOK NOW',
					'description' => __( 'Set the text for booking button.', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'services_show_booking_btn',
						'value'   => array( '1' ),
					),
				),
			),
			$slider_params,
			array(
				Floral_Map_Helpers::extra_class(),
				Floral_Map_Helpers::design_options(),
				Floral_Map_Helpers::animation_css(),
				Floral_Map_Helpers::animation_duration(),
				Floral_Map_Helpers::animation_delay()
			)
		),
	)
);