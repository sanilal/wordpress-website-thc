<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-thumbnail-slider-map.php
 * @time    : 12/13/2016 4:47 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => __( 'Floral Thumbnail Slider', 'w9-floral-addon' ),
	'base'           => Floral_SC_Thumbnail_Slider::SC_BASE,
	'php_class_name' => 'Floral_SC_Thumbnail_Slider',
	'icon'           => 'w9 w9-ico-pictures',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_PORTFOLIO_SC_CATEGORY ),
	'description'    => __('CPT Service and CPT Portfolio only!', 'w9-floral-addon' ),
//	'post_type'      => Floral_CPT_Portfolio::CPT_SLUG,
	'params'         => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider 1 - Image size', 'w9-floral-addon' ),
			'param_name' => 's1_img_size',
			'value' => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
			'std' => 'floral_1170',
			'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'w9-floral-addon' ),
			'param_name' => 's1_img_size_custom',
			'std' => '1280x720',
			'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'w9-floral-addon' ),
			'dependency' => array(
				'element' => 's1_img_size',
				'value' => array( 'custom'),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Slider 1 - Image ratio', 'w9-floral-addon' ),
			'description' => __( 'Image ratio base on image size width.', 'w9-floral-addon' ),
			'param_name'  => 's1_image_ratio',
			'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
			'std'         => '0.5'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider 2 - Image size', 'w9-floral-addon' ),
			'param_name' => 's2_img_size',
			'value' => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
			'std' => 'floral_270',
			'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'w9-floral-addon' ),
			'param_name' => 's2_img_size_custom',
			'std' => '320x180',
			'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'w9-floral-addon' ),
			'dependency' => array(
				'element' => 's2_img_size',
				'value' => array( 'custom'),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Slider 2 - Image ratio', 'w9-floral-addon' ),
			'description' => __( 'Image ratio base on image size width.', 'w9-floral-addon' ),
			'param_name'  => 's2_image_ratio',
			'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
			'std'         => '0.5625'
		),
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay()
	)
) );