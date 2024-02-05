<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-image-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $single_image_param
 */

$shortcodes[Floral_SC_Gitem_Image::SC_BASE] = array(
    'name'           => __( 'Floral Post Image', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Image::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Single Image From Meta Or Custom', 'w9-floral-addon' ),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-image',
    'php_class_name' => 'Floral_SC_Gitem_Image',
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'params'         => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Image source', 'w9-floral-addon' ),
            'param_name'  => 'source',
            'value'       => array(
                __( 'Featured Image', 'w9-floral-addon' ) => 'featured_image',
                __( 'Meta Key', 'w9-floral-addon' )       => 'meta_key',
                __( 'Media library', 'w9-floral-addon' )  => 'media_library',
            ),
            'std'         => 'media_library',
            'description' => __( 'Select image source.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'textfield',
            'heading'    => __( 'Meta key', 'w9-floral-addon' ),
            'param_name' => 'meta_key',
            'dependency' => array(
                'element' => 'source',
                'value'   => array( 'meta_key' ),
            ),
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
            'type'        => 'dropdown',
            'heading'     => __( 'Image size', 'w9-floral-addon' ),
            'param_name'  => 'img_size',
            'value'       => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
            'std' => 'floral_1170',
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
            'description' => __( 'Image ratio base on image size width', 'w9-floral-addon' ),
            'param_name'  => 'image_ratio',
            'value'       => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
            'std'         => 'original'
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => __( 'Image action', 'w9-floral-addon' ),
            'param_name' => 'action',
            'value'      => array(
                __( 'None', 'w9-floral-addon' )      => 'none',
                __( 'Post link', 'w9-floral-addon' ) => 'post_link',
                __( 'Meta URL', 'w9-floral-addon' ) => 'meta_url',
                __( 'Light box', 'w9-floral-addon' ) => 'light_box',
                __( 'Post link & Light box', 'w9-floral-addon' ) => 'post_link_and_light_box',
            )
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'link_target',
            'heading'    => __( 'Open link in new tab?', 'w9-floral-addon' ),
            'value'      => array(
                __( 'Yes, please!', 'w9-floral-addon' ) => 'yes',
            ),
            'std'        => '',
            'dependency' => array(
                'element' => 'action',
                'value' => array('meta_url', 'post_link', 'post_link_and_light_box')
            )
        ),
        array(
            'type'       => 'textfield',
            'heading'    => __( 'Meta key', 'w9-floral-addon' ),
            'param_name' => 'meta_url',
            'dependency' => array(
                'element' => 'action',
                'value'   => array( 'meta_url' ),
            ),
        ),
	    array(
		    'type'        => 'checkbox',
		    'heading'     => __( 'Add hover effect?', 'w9-floral-addon' ),
		    'param_name'  => 'add_hover_effect',
		    'description' => __( 'Add image hover effect.', 'w9-floral-addon' ),
		    'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
		    'std'         => 'yes',
		    'dependency' => array(
			    'element' => 'action',
			    'value_not_equal_to'   => array('none', 'post_link_and_light_box')
		    ),
	    ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
    ),
);