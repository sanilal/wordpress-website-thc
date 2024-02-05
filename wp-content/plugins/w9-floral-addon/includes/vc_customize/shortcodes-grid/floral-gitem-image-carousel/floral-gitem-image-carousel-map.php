<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-image-carousel-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $single_image_param
 */
require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-slider-container/floral-slider-container.php';
require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-slider-container/floral-slider-container-map.php';
require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-image-carousel/floral-image-carousel.php';
require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-image-carousel/floral-image-carousel-map.php';

$image_carousel_map = vc_map_integrate_shortcode( Floral_SC_Image_Carousel::SC_BASE );
foreach ( $image_carousel_map as $index => $param ) {
    if ( isset( $param['param_name'] ) && $param['param_name'] == 'images' ) {
        $image_carousel_map[$index]['dependency'] = array(
            'element' => 'source',
            'value'   => 'static'
        );
    }
}

$shortcodes[Floral_SC_Gitem_Image_Carousel::SC_BASE] = array(
    'name'           => __( 'Floral Post Image Carousel', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Image_Carousel::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Single Image From Meta Or Custom', 'w9-floral-addon' ),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-object-ungroup',
    'php_class_name' => 'Floral_SC_Gitem_Image_Carousel',
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'params'         => array_merge(
        array(
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Get images from', 'w9-floral-addon' ),
                'param_name' => 'source',
                'value'      => array(
                    __( 'Post (post format: gallery)', 'w9-floral-addon' ) => 'meta-post-gallery',
                    __( 'Portfolio Gallery', 'w9-floral-addon' )           => 'meta-portfolio-gallery',
                    __( 'Custom', 'w9-floral-addon' )                      => 'custom',
                    __( 'Static', 'w9-floral-addon' )                      => 'static',
                )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Meta key', 'w9-floral-addon' ),
                'description' => __( 'Support gallery from redux framework only.', 'w9-floral-addon' ),
                'param_name'  => 'meta_key',
                'dependency'  => array(
                    'element' => 'source',
                    'value'   => array( 'custom' ),
                ),
            ),
        ),
        $image_carousel_map
    ),
);