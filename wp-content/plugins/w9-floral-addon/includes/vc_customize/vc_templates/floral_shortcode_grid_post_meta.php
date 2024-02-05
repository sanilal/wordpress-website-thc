<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_grid_post_meta.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Grid_Post_Meta
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$output_type = '';
$meta_key    = '';
$el_class    = '';

//Text Variables
$text_label     = '';
$text_link      = '';
$text_meta_href = '';
$text_target    = '';
$text_tag       = '';

//Image - Image Carousel Variables
$image_size        = '';
$custom_image_size = '';
$image_ratio       = '';
$image_onclick     = '';

//Embed Variables
$embed_type       = '';
$embed_format     = '';
$video_ratio      = '';
$audio_max_height = '';
$css              = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$sc_class = array(
    $el_class,
    vc_shortcode_custom_css_class( $css ),
);

//Text Meta
if ( $output_type === 'text' && !empty( $meta_key ) ) {
    $output = sprintf( '{{ floral_post_meta_text:%s||%s||%s||%s||%s }}', $meta_key, $text_label, $text_tag, $text_meta_href, $text_target );
} //Text Link
elseif ( $output_type === 'link' && !empty( $text_link ) ) {
    $output = sprintf( '{{ floral_post_meta_link:%s||%s||%s||%s||%s }}', $text_link, $text_label, $text_tag, $text_meta_href, $text_target );
}

//Image size
if ( $image_size === 'custom' ) {
    if ( empty( $custom_image_size ) ) {
        $image_size = 'medium';
    } else {
        $image_size = $custom_image_size;
    }
} //Image Meta
elseif ( $output_type === 'image' && !empty( $meta_key ) ) {
    $output = sprintf( '{{ floral_post_meta_image:%s||%s||%s||%s }}', $meta_key, $image_size, $image_ratio, $image_onclick );
} //Carousel Meta
elseif ( $output_type === 'gallery' && !empty( $meta_key ) ) {
    $output = sprintf( '{{ floral_post_meta_gallery:%s||%s||%s||%s }}', $meta_key, $image_size, $image_ratio, $image_onclick );
} //Embed Meta
elseif ( $output_type === 'embed' && !empty( $meta_key ) ) {
    $output = sprintf( '{{ floral_post_meta_embed:%s||%s||%s||%s||%s }}', $meta_key, $embed_type, $embed_format, $video_ratio, $audio_max_height );
}

if ( isset( $output ) ) {
    if ( $output_type === 'text' || $output_type === 'link' ) {
        echo sprintf( '<span class="%s">%s</span>', floral_clean_html_classes( $sc_class ), $output );
    } else {
        echo sprintf( '<div class="%s">%s</div>', floral_clean_html_classes( $sc_class ), $output );
    }
}