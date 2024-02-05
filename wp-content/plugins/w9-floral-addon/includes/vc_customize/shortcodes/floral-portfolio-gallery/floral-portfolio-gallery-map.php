<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-gallery-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( is_admin() && ( !defined( 'DOING_AJAX' ) && ( !post_type_exists( Floral_CPT_Portfolio::CPT_SLUG ) || floral_get_current_post_type() !== Floral_CPT_Portfolio::CPT_SLUG ) ) ) {
    return;
}

$gallery_param = vc_map_integrate_shortcode( Floral_SC_Image_Carousel::SC_BASE, '', '', array(
    'exclude' => array(
        'images',
    ) ),
    array(
        'element' => 'gallery_type',
        'value'   => 'slider'
    )
);

foreach ( $gallery_param as $key => $param ) {
    if ( isset( $param['param_name'] ) && in_array( $param['param_name'], array(
            'img_size',
            'image_ratio',
            'onclick',
            'el_class',
            'css',
            'animation_css',
            'animation_duration',
            'animation_delay' ) )
    ) {
        unset( $gallery_param[$key]['dependency'] );
    }
}


vc_map( array(
    'name'           => __( 'Floral Portfolio Gallery', 'w9-floral-addon' ),
    'base'           => Floral_SC_Portfolio_Gallery::SC_BASE,
    'php_class_name' => 'Floral_SC_Portfolio_Gallery',
    'icon'           => 'w9 w9-ico-software-layout-8boxes',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_PORTFOLIO_SC_CATEGORY ),
    'description'    => __( 'Build gallery that you use in single gallery', 'w9-floral-addon' ),
    'post_type'      => Floral_CPT_Portfolio::CPT_SLUG,
    'params'         => array_merge(
        array(
            array(
                'type'       => 'dropdown',
                'param_name' => 'gallery_type',
                'heading'    => __( 'Gallery type', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Slider', 'w9-floral-addon' ) => 'slider',
                    __( 'Simple', 'w9-floral-addon' ) => 'simple',
                ),
                'std'        => 'slider',
            )
        ),
        $gallery_param )
) );