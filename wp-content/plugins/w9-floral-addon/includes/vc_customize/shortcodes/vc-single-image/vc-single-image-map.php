<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-single-image-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$single_image_param = array(
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Image source', 'w9-floral-addon' ),
		'param_name'  => 'source',
		'value'       => array(
			__( 'Media library', 'w9-floral-addon' )  => 'media_library',
			__( 'External link', 'w9-floral-addon' )  => 'external_link',
			__( 'Featured Image', 'w9-floral-addon' ) => 'featured_image',
		),
		'std'         => 'media_library',
		'description' => __( 'Select image source.', 'w9-floral-addon' ),
	),
	array(
		'type'        => 'attach_image',
		'heading'     => __( 'Image', 'w9-floral-addon' ),
		'param_name'  => 'image',
		'value'       => '',
		'description' => __( 'Select image from media library.', 'w9-floral-addon' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => 'media_library',
		),
		'admin_label' => true
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'External link', 'w9-floral-addon' ),
		'param_name'  => 'custom_src',
		'description' => __( 'Select external link.', 'w9-floral-addon' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => 'external_link',
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
			'element' => 'source',
			'value'   => array( 'media_library', 'featured_image' ),
		),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Image size', 'w9-floral-addon' ),
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
		'param_name'  => 'image_ratio',
		'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
		'std'         => 'original'
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Image size', 'w9-floral-addon' ),
		'param_name'  => 'external_img_size',
		'value'       => '',
		'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'w9-floral-addon' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => 'external_link',
		),
	),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Caption', 'w9-floral-addon' ),
		'param_name'  => 'caption',
		'description' => __( 'Enter text for image caption.', 'w9-floral-addon' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => 'external_link',
		),
	),
	array(
		'type'        => 'checkbox',
		'heading'     => __( 'Add caption?', 'w9-floral-addon' ),
		'param_name'  => 'add_caption',
		'description' => __( 'Add image caption.', 'w9-floral-addon' ),
		'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => array( 'media_library', 'featured_image' ),
		),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Image alignment', 'w9-floral-addon' ),
		'param_name'  => 'alignment',
		'value'       => array(
			__( 'Inherit', 'w9-floral-addon' ) => '_',
			__( 'Left', 'w9-floral-addon' )    => 'left',
			__( 'Right', 'w9-floral-addon' )   => 'right',
			__( 'Center', 'w9-floral-addon' )  => 'center',
		),
		'std'         => '_',
		'description' => __( 'Select image alignment.', 'w9-floral-addon' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Image style', 'w9-floral-addon' ),
		'param_name'  => 'style',
		'value'       => array_merge(
			getVcShared( 'single image styles' ),
			array(
				__( 'Border Out Left', 'w9-floral-addon' )  => 'vc_border-out-left',
				__( 'Border Out Right', 'w9-floral-addon' ) => 'vc_border-out-right'
			)
		),
		'description' => __( 'Select image display style.', 'js_comopser' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => array( 'media_library', 'featured_image' ),
		),
		'admin_label' => true
	),

	array(
		'type'        => 'dropdown',
		'heading'     => __( 'Image style', 'w9-floral-addon' ),
		'param_name'  => 'external_style',
		'value'       => getVcShared( 'single image external styles' ),
		'description' => __( 'Select image display style.', 'js_comopser' ),
		'dependency'  => array(
			'element' => 'source',
			'value'   => 'external_link',
		),
	),
	array(
		'type'               => 'dropdown',
		'heading'            => __( 'Border color', 'w9-floral-addon' ),
		'param_name'         => 'border_color',
		'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
		'std'                => 'p',
		'dependency'         => array(
			'element' => 'style',
			'value'   => array(
				'vc_box_border',
				'vc_box_border_circle',
				'vc_box_outline',
				'vc_box_outline_circle',
				'vc_box_border_circle_2',
				'vc_box_outline_circle_2',
				'vc_border-out-left',
				'vc_border-out-right',
			),
		),
		'description'        => __( 'Border color.', 'w9-floral-addon' ),
		'param_holder_class' => 'vc_colored-dropdown',
	),
	
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Custom border color', 'w9-floral-addon' ),
		'param_name' => 'custom_border_color',
		'value'      => '',
		'dependency' => array(
			'element' => 'border_color',
			'value'   => 'custom'
		),
	),
	
	array(
		'type'               => 'dropdown',
		'heading'            => __( 'Border color', 'w9-floral-addon' ),
		'param_name'         => 'external_border_color',
		'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
		'std'                => 'p',
		'dependency'         => array(
			'element' => 'external_style',
			'value'   => array(
				'vc_box_border',
				'vc_box_border_circle',
				'vc_box_outline',
				'vc_box_outline_circle',
			),
		),
		'description'        => __( 'Border color.', 'w9-floral-addon' ),
		'param_holder_class' => 'vc_colored-dropdown',
	),
	
	array(
		'type'       => 'colorpicker',
		'heading'    => esc_html__( 'Custom border color', 'w9-floral-addon' ),
		'param_name' => 'custom_external_border_color',
		'value'      => '',
		'dependency' => array(
			'element' => 'external_border_color',
			'value'   => 'custom'
		),
	),
	
	
	array(
		'type'        => 'dropdown',
		'heading'     => __( 'On click action', 'w9-floral-addon' ),
		'param_name'  => 'onclick',
		'value'       => array(
			__( 'None', 'w9-floral-addon' )                => '',
			__( 'Link to large image', 'w9-floral-addon' ) => 'img_link_large',
			__( 'Open prettyPhoto', 'w9-floral-addon' )    => 'link_image',
			__( 'Open custom link', 'w9-floral-addon' )    => 'custom_link',
			__( 'Popup video', 'w9-floral-addon' )         => 'popup-video',
//            __( 'Zoom', 'w9-floral-addon' )                => 'zoom',
		),
		'description' => __( 'Select action for click action.', 'w9-floral-addon' ),
		'std'         => '',
	),
	
	array(
		'type'        => 'checkbox',
		'heading'     => __( 'Add hover effect?', 'w9-floral-addon' ),
		'param_name'  => 'hover_effect',
		'description' => __( 'Add image hover effect.', 'w9-floral-addon' ),
		'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
		'std'         => '',
		'dependency' => array(
			'element' => 'onclick',
			'not_empty'   => true
		),
	),
	
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Video link', 'w9-floral-addon' ),
		'param_name'  => 'video_link',
		'value'       => 'https://vimeo.com/51589652',
		'description' => sprintf( __( 'Enter link to video (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'w9-floral-addon' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
		'dependency'  => array(
			'element' => 'onclick',
			'value'   => 'popup-video'
		),
	),
	
	array(
		'type'        => 'href',
		'heading'     => __( 'Image link', 'w9-floral-addon' ),
		'param_name'  => 'link',
		'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'w9-floral-addon' ),
		'dependency'  => array(
			'element' => 'onclick',
			'value'   => 'custom_link',
		),
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Link target', 'w9-floral-addon' ),
		'param_name' => 'img_link_target',
		'value'      => vc_target_param_list(),
		'dependency' => array(
			'element' => 'onclick',
			'value'   => array( 'custom_link', 'img_link_large' ),
		),
	),
	vc_map_add_css_animation(),
	array(
		'type'        => 'textfield',
		'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
		'param_name'  => 'el_class',
		'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
	),
	array(
		'type'       => 'css_editor',
		'heading'    => __( 'CSS box', 'w9-floral-addon' ),
		'param_name' => 'css',
		'group'      => __( 'Design Options', 'w9-floral-addon' ),
	),
//    Floral_Map_Helpers::animation_css(),
//    Floral_Map_Helpers::animation_duration(),
//    Floral_Map_Helpers::animation_delay(),
	// backward compatibility. since 4.6
	array(
		'type'       => 'hidden',
		'param_name' => 'img_link_large',
	),
);

vc_map(
	array(
		'name'        => __( 'Single Image', 'w9-floral-addon' ),
		'base'        => 'vc_single_image',
		'icon'        => 'w9 w9-ico-basic-picture',
		'category'    => __( 'Content', 'w9-floral-addon' ),
		'description' => __( 'Simple image with CSS animation.', 'w9-floral-addon' ),
		'params'      => $single_image_param,
	)
);