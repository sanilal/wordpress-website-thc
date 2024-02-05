<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-empty-space.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'                    => __( 'Empty Space', 'w9-floral-addon' ),
	'base'                    => 'vc_empty_space',
	'icon'                    => 'w9 w9-ico-arrows-shrink-vertical1',
	'show_settings_on_create' => true,
	'category'                => __( 'Content', 'w9-floral-addon' ),
	'description'             => __( 'Blank space with custom height', 'w9-floral-addon' ),
	'params'                  => array(
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Height', 'w9-floral-addon' ),
			'param_name'  => 'height',
			'value'       => '32px',
			'admin_label' => true,
			'description' => __( 'Enter empty space height (Note: CSS measurement units allowed).', 'w9-floral-addon' ),
		),
		
		array(
			'type'       => 'switcher',
			'heading'    => __( 'Show background overlay ?', 'w9-floral-addon' ),
			'param_name' => 'show_overlay',
			'std'        => '0',
//		    'edit_field_class' => 'vc_col-sm-6 vc_column',
//					'description' => __( 'Show excerpt for posts . ', 'w9-floral-addon' )
		),
		
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_html__( 'Overlay color', 'w9-floral-addon' ),
			'param_name'  => 'overlay_color',
			'description' => esc_html__( 'Select color for background overlay.', 'w9-floral-addon' ),
			'value'       => '',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'show_overlay',
				'value'   => array( '1' )
			),
		),
		
		array(
			'type'       => 'switcher',
			'heading'    => __( 'Add background image ?', 'w9-floral-addon' ),
			'param_name' => 'add_bg_img',
			'std'        => '0',
//		    'edit_field_class' => 'vc_col-sm-6 vc_column',
//					'description' => __( 'Show excerpt for posts . ', 'w9-floral-addon' )
		),
		
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image', 'w9-floral-addon' ),
			'param_name'  => 'bg_img_id',
			'value'       => '',
			'description' => __( 'Select image from media library.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'add_bg_img',
				'value'   => array( '1' ),
			),
			'admin_label' => true
		),
		
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Image size', 'w9-floral-addon' ),
			'param_name'  => 'img_size',
			'value'       => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
			'std'         => 'floral_1170',
			'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'add_bg_img',
				'value'   => array( '1' ),
			),
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Image custom size', 'w9-floral-addon' ),
			'param_name'  => 'img_size_custom',
			'std'         => '1280x720',
			'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'img_size',
				'value'   => array( 'custom' ),
			),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Image ratio', 'w9-floral-addon' ),
			'description' => __( 'Image ratio base on image size width.', 'w9-floral-addon' ),
			'param_name'  => 'bg_img_ratio',
			'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
			'std'         => 'original',
			'dependency'  => array(
				'element' => 'add_bg_img',
				'value'   => array( '1' ),
			),
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Background image size', 'w9-floral-addon' ),
			'param_name'  => 'bg_img_size',
			'value'       => array(
				esc_html__( 'Cover', 'w9-floral-addon' )     => 'cover',
				esc_html__( 'Contain', 'w9-floral-addon' )   => 'contain',
				esc_html__( 'Repeat', 'w9-floral-addon' )    => 'repeat',
				esc_html__( 'No repeat', 'w9-floral-addon' ) => 'no-repeat',
			),
			'std'         => 'cover',
			'description' => __( 'Select background image size', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'add_bg_img',
				'value'   => array( '1' ),
			),
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Background image position', 'w9-floral-addon' ),
			'param_name'  => 'bg_img_position',
			'value'       => array(
				esc_html__( 'Center Top', 'w9-floral-addon' )    => 'bgp-center-top',
				esc_html__( 'Center Center', 'w9-floral-addon' ) => 'bgp-center-center',
				esc_html__( 'Center Bottom', 'w9-floral-addon' ) => 'bgp-center-bottom',
				esc_html__( 'Left Top', 'w9-floral-addon' )      => 'bgp-left-top',
				esc_html__( 'Left Center', 'w9-floral-addon' )   => 'bgp-left-center',
				esc_html__( 'Left Bottom', 'w9-floral-addon' )   => 'bgp-left-bottom',
				esc_html__( 'Right Top', 'w9-floral-addon' )     => 'bgp-right-top',
				esc_html__( 'Right Center', 'w9-floral-addon' )  => 'bgp-right-center',
				esc_html__( 'Right Bottom', 'w9-floral-addon' )  => 'bgp-right-bottom',
			),
			'description' => esc_html__( 'Select background image position.', 'w9-floral-addon' ),
			'std'         => 'bgp-center-center',
			'admin_label' => true,
			'dependency'  => array(
				'element' => 'add_bg_img',
				'value'   => array( '1' ),
			),
		),
		
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::design_options_on_tablet(),
		Floral_Map_Helpers::design_options_on_mobile(),
	),
) );
