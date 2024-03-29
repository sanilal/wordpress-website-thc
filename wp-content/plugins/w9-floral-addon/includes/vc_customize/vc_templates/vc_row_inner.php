<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_row_inner.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content_width
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row_Inner
 */
$content_width = '';
$el_class        = $equal_height = $background_position = $no_gutter = $content_placement = $css = $tablet_css = $mobile_css = $el_id = '';
$disable_element = $animation_css = $animation_duration = $animation_delay = '';
$output          = $after_output = '';
$atts            = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_inner',
    'vc_row-fluid',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);


//if($background_position != 'bgp-center-center-i'){
if(!empty($background_position)){
    $css_classes[] = esc_attr($background_position);
}

if ( 'yes' === $disable_element ) {
    if ( vc_is_page_editable() ) {
        $css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
    } else {
        return '';
    }
}


if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
    $css_classes[] = 'vc_row-has-fill';
}

if ( !empty( $atts['gap'] ) ) {
    $css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( !empty( $equal_height ) ) {
    $flex_row      = true;
    $css_classes[] = 'vc_row-o-equal-height';
}

if ( !empty( $content_placement ) ) {
    $flex_row      = true;
    $css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( !empty( $no_gutter ) ) {
    $css_classes[] = 'vc_row-column-no-gutter';
}

if ( !empty( $flex_row ) ) {
    $css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( !empty( $el_id ) ) {
    $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay );

$output .= '<div class="' . $content_width . '" >';
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div></div>';
$output .= $after_output;

echo $output;
