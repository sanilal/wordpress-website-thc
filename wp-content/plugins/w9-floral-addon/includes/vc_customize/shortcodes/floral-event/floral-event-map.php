<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-event-map.php
 * @time    : 4/25/2017 9:20 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Event::CPT_SLUG ) ) {
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
	'element' => 'event_layout_type',
	'value'   => 'layout-slider',
) );

$event_cats      = floral_get_terms_by_tax( Floral_CPT_Event::TAX_SLUG, 'slug' );
$event_cpt_slug  = Floral_CPT_Event::CPT_SLUG;
$event_get_posts = get_posts( array(
	'posts_per_page' => - 1,
	'post_status'    => 'any',
	'post_type'      => $event_cpt_slug,
	'post_parent'    => null
) );
$event_names     = array();
if ( is_array( $event_get_posts ) ) {
	foreach ( $event_get_posts as $item ) {
		$event_names[ $item->ID ] = $item->post_title;
	}
}
//var_dump( $event_names );

vc_map(
	array(
		'name'           => esc_html__( 'Floral Events', 'w9-floral-addon' ),
		'base'           => Floral_SC_Event::SC_BASE,
		'icon'           => 'dashicons-before dashicons-calendar-alt',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Event',
		'params'         => array_merge(
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Data Source', 'w9-floral-addon' ),
					'param_name' => 'event_data',
					'value'      => array(
						__( 'Select by categories', 'w9-floral-addon' ) => 'category',
						__( 'Select by names', 'w9-floral-addon' )      => 'name',
					),
				),
				array(
					'type'       => 'multi-select',
					'heading'    => __( 'Include (categories):', 'w9-floral-addon' ),
					'param_name' => 'event_category',
					'options'    => $event_cats,
					'dependency' => array(
						'element' => 'event_data',
						'value'   => array( 'category' ),
					),
				),
				array(
					'type'       => 'multi-select',
					'heading'    => __( 'Include (names):', 'w9-floral-addon' ),
					'param_name' => 'event_name',
					'options'    => $event_names,
					'dependency' => array(
						'element' => 'event_data',
						'value'   => array( 'name' ),
					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Style', 'w9-floral-addon' ),
					'param_name'  => 'event_style',
					'value'       => array(
						__( 'Style 1', 'w9-floral-addon' ) => 'style-1',
						__( 'Style 2', 'w9-floral-addon' ) => 'style-2',
					),
					'description' => __( 'Select the event style', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Layout type', 'w9-floral-addon' ),
					'param_name'  => 'event_layout_type',
					'value'       => array(
						__( 'Grid', 'w9-floral-addon' )   => 'layout-grid',
						__( 'Slider', 'w9-floral-addon' ) => 'layout-slider',
					),
					'description' => __( 'Select the layout type for the event.', 'w9-floral-addon' ),
				),
				
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Equal height items ?', 'w9-floral-addon' ),
					'param_name' => 'event_equal_height_items',
					'value'      => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
					'std'        => 'yes'
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort order', 'w9-floral-addon' ),
					'param_name'  => 'event_sort_order',
					'value'       => array(
						__( 'Random', 'w9-floral-addon' ) => 'random',
//						__( 'Popular', 'w9-floral-addon' ) => 'popular',
						__( 'Recent', 'w9-floral-addon' ) => 'recent',
						__( 'Oldest', 'w9-floral-addon' ) => 'oldest'
					),
					'std'         => 'recent',
					'description' => __( 'Select sorting order . ', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'event_data',
						'value'   => array( 'category' ),
					),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Total items', 'w9-floral-addon' ),
					'param_name'  => 'event_total_items',
					'std'         => '3',
					'description' => __( 'Set max limit for items or enter - 1 to display all', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Column', 'w9-floral-addon' ),
					'param_name'  => 'event_column',
					'min'         => '1',
					'max'         => '4',
					'std'         => '3',
					'description' => __( 'Set the column numbers( min: 1, max: 4)', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'event_layout_type',
						'value'   => array( 'layout-grid' ),
					),
				),
				
				// Meta
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Image size', 'w9-floral-addon' ),
					'param_name'  => 'event_image_size',
					'value'       => get_intermediate_image_sizes(),
					'std'         => 'floral_570',
					'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
					'group'       => __( 'Meta', 'w9-floral-addon' ),
//					'dependency'  => array(
//						'element' => 'source',
//						'value'   => array( 'media_library', 'featured_image' ),
//					),
				),
				array_merge(
					Floral_Map_Helpers::get_icons_picker_type( 'floral', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_9wpthemes( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_floral( 'flor-ico flor-ico-lotus-logo-icon', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_fontawesome( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_openiconic( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_typicons( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_entypo( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_linecons( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
				),
				array_merge(
					Floral_Map_Helpers::get_icon_picker_monosocial( '', false ),
					array( 'group' => __( 'Meta', 'w9-floral-addon' ) )
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