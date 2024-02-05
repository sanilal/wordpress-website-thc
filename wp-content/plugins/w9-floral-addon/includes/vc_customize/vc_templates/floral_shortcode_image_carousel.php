<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_image_carousel.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Image_Carousel
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$images          = '';
$img_size        = '';
$img_size_custom = '';
$image_ratio     = '';
$onclick         = '';
$atts            = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$slider_atts = vc_map_integrate_parse_atts( $this::SC_BASE, 'floral_shortcode_' . 'slider_container', $atts );

if ( $img_size === 'custom' ) {
    $img_size = ( empty( $img_size_custom ) ) ? 'floral_1170' : $img_size_custom;
}
$images = explode( ',', $images );
$args   = array();
if ( !empty( $image_ratio ) ) {
    $args['ratio'] = $image_ratio;
}
$image_render = '';
$gallery_id = uniqid('floral-gal');
$args['gallery'] = $gallery_id;

if ( $onclick === 'magnific' ) {
    foreach ( $images as $image ) {
        $image_render .= Floral_Wrap::prettyphoto_image( $image, $img_size, $args );
    }
} else {
    foreach ( $images as $image ) {
        $image_render .= Floral_Image::get_image( $image, $img_size, $args );
    }
}

echo Vc_Shortcodes_Manager::getInstance()->getElementClass( 'floral_shortcode_' . 'slider_container' )->output( $slider_atts, $image_render );