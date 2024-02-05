<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-image-carousel-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$slider_setting_map = vc_map_integrate_shortcode( Floral_SC_Slider_Container::SC_BASE , '', __( 'Slider', 'w9_sping_addon' ),null);

vc_map(
    array(
        'name' => __( 'Floral Images Carousel', 'w9-floral-addon' ),
        'base' => Floral_SC_Image_Carousel::SC_BASE,
        'php_class_name' => 'Floral_SC_Image_Carousel',
        'icon' => 'w9 w9-ico-basic-picture-multiple',
        'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
        'description' => __( 'Animated carousel with images', 'w9-floral-addon' ),
        'params' => array_merge(array(
            array(
                'type' => 'attach_images',
                'heading' => __( 'Images', 'w9-floral-addon' ),
                'param_name' => 'images',
                'admin_label' => true,
                'value' => '',
                'description' => __( 'Select images from media library.', 'w9-floral-addon' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Image size', 'w9-floral-addon' ),
                'param_name' => 'img_size',
                'value' => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
                'std' => 'floral_1170',
                'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image size', 'w9-floral-addon' ),
                'param_name' => 'img_size_custom',
                'std' => '1280x720',
                'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'w9-floral-addon' ),
                'dependency' => array(
                    'element' => 'img_size',
                    'value' => array( 'custom'),
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
                'type' => 'dropdown',
                'heading' => __( 'On click action', 'w9-floral-addon' ),
                'param_name' => 'onclick',
                'value' => array(
                    __( 'None', 'w9-floral-addon' ) => 'link_no',
                    __( 'Open Pretty Photo', 'w9-floral-addon' ) => 'magnific',
                ),
                'description' => __( 'Select action for click event.', 'w9-floral-addon' ),
            ),
        ), $slider_setting_map)
    )
);