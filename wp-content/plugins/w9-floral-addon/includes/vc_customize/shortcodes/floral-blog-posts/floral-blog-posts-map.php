<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-blog-posts-map.php
 * @time    : 4/5/2017 7:33 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
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
	'element' => 'posts_layout_type',
	'value'   => 'layout-slider',
) );
$category      = array();
$categories    = get_categories();
if ( is_array( $categories ) ) {
	foreach ( $categories as $cat ) {
		$category[ $cat->slug ] = $cat->name;
	}
}
//var_dump($category);

vc_map(
	array(
		'name'           => esc_html__( 'Floral Blog Posts', 'w9-floral-addon' ),
		'base'           => Floral_SC_Blog_Posts::SC_BASE,
		'icon'           => 'dashicons-before dashicons-admin-post',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Blog_Posts',
		'params'         => array_merge(
			array(
				array(
					'type'       => 'multi-select',
					'heading'    => esc_html__( 'Categories', 'w9-floral-addon' ),
					'param_name' => 'posts_category',
					'options'    => $category
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Style', 'w9-floral-addon' ),
					'param_name'  => 'posts_style',
					'value'       => array(
						__( 'Style 1', 'w9-floral-addon' )               => 'style-1',
						__( 'Style 2', 'w9-floral-addon' )               => 'style-2',
						__( 'Style 2 (Variability)', 'w9-floral-addon' ) => 'style-2v',
						__( 'Style 3', 'w9-floral-addon' )               => 'style-3',
						__( 'Style 4', 'w9-floral-addon' )               => 'style-4',
					),
					'description' => __( 'Select the posts style', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Layout type', 'w9-floral-addon' ),
					'param_name'  => 'posts_layout_type',
					'value'       => array(
						__( 'Grid', 'w9-floral-addon' )   => 'layout-grid',
						__( 'Slider', 'w9-floral-addon' ) => 'layout-slider',
					),
					'description' => __( 'Select the layout type for the posts.', 'w9-floral-addon' ),
				),
				
				array(
					'type'       => 'checkbox',
					'heading'    => __( 'Equal height items ?', 'w9-floral-addon' ),
					'param_name' => 'posts_equal_height_items',
					'value'      => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
					'std'        => 'yes'
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort order', 'w9-floral-addon' ),
					'param_name'  => 'posts_sort_order',
					'value'       => array(
						__( 'Random', 'w9-floral-addon' )  => 'random',
						__( 'Popular', 'w9-floral-addon' ) => 'popular',
						__( 'Recent', 'w9-floral-addon' )  => 'recent',
						__( 'Oldest', 'w9-floral-addon' )  => 'oldest'
					),
					'std'         => 'recent',
					'description' => __( 'Select sorting order . ', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Total items', 'w9-floral-addon' ),
					'param_name'  => 'posts_total_items',
					'std'         => '3',
					'description' => __( 'Set max limit for items in grid or enter - 1 to display all', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'number',
					'heading'     => __( 'Column', 'w9-floral-addon' ),
					'param_name'  => 'posts_column',
					'min'         => '1',
					'max'         => '4',
					'std'         => '3',
					'description' => __( 'Set the column numbers( min: 1, max: 4)', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'posts_layout_type',
						'value'   => array( 'layout-grid' ),
					),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Image size', 'w9-floral-addon' ),
					'param_name'  => 'posts_image_size',
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
					'param_name'  => 'posts_image_ratio',
					'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
					'group'       => __( 'Meta', 'w9-floral-addon' ),
					'std'         => '0.666666667'
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show author ? ', 'w9-floral-addon' ),
					'param_name'       => 'posts_show_author',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show date ? ', 'w9-floral-addon' ),
					'param_name'       => 'posts_show_date',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show category ? ', 'w9-floral-addon' ),
					'param_name'       => 'posts_show_category',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				
				array(
					'type'             => 'switcher',
					'heading'          => __( 'Show excerpt ? ', 'w9-floral-addon' ),
					'param_name'       => 'posts_show_excerpt',
					'std'              => '1',
					'group'            => __( 'Meta', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
//					'description' => __( 'Show excerpt for posts . ', 'w9-floral-addon' )
				),
				array(
					'type'        => 'number',
					'heading'     => __( 'Excerpt length (max words)', 'w9-floral-addon' ),
					'param_name'  => 'posts_excerpt_length',
					'group'       => __( 'Meta', 'w9-floral-addon' ),
					'std'         => '50',
					'description' => __( 'Limit the excerpt length (words) . Note: this value must be less than the value of the Excerpt length in Theme Options (Theme Options > Blog Archive).', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'posts_show_excerpt',
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