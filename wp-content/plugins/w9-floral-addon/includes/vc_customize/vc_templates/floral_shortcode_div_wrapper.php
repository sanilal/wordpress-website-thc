<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_div_wrapper.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Div_Wrapper
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$unique_class = $min_height = $height = $max_height = $horizontal_align =$tablet_css = $mobile_css = $fixed_ratio = $min_width = $width = $max_width = $overflow = $sticky_enabled = $sticky_start = $sticky_stop = $sticky_z_index = '';
$el_class     = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$sc_classes = array(
    $unique_class,
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
);

$inline_css = array();
if ( $min_height !== '' ) {
    $inline_css[] = 'min-height: ' . $min_height;
}
if ( $height !== '' ) {
    $inline_css[] = 'height: ' . $height;
}
if ( $max_height !== '' ) {
    $inline_css[] = 'max-height: ' . $max_height;
}
if ( $min_width !== '' ) {
    $inline_css[] = 'min-width: ' . $min_width;
}
if ( $width !== '' ) {
    $inline_css[] = 'width: ' . $width;
}
if ( $max_width !== '' ) {
    $inline_css[] = 'max-width: ' . $max_width;
}
if ( $overflow != '' ) {
    $inline_css[] = 'overflow: ' . $overflow;
}

if ( $fixed_ratio != 'none' ) {
    $inline_css[] = 'padding-top: ' . intval( $fixed_ratio ) * 100 . '%';
}

if(!empty($horizontal_align)){
    $sc_classes[] = $horizontal_align;
}

$sticky_string = '';
if ( $sticky_enabled === 'true' ) {
    $sc_classes[]   = 'floral-sticky-enabled';
    $sticky_setting = array();
    
    if ( $sticky_start !== '' ) {
        $sticky_setting[] = 'topSpacing: ' . $sticky_start;
    }
    if ( $sticky_stop !== '' ) {
        $sticky_setting[] = 'bottomSpacing: ' . $sticky_stop;
    }
    if ( $sticky_z_index !== '' ) {
        $sticky_setting[] = 'zIndex: ' . $sticky_z_index;
    }
    if ( !empty( $sticky_setting ) ) {
        $sticky_string = sprintf( 'data-sticky-setting="%s"', implode( ',', $sticky_setting ) );
    }
}

//Render HTML
$html = '';
$html .= '<div class="floral-div-wrapper clearfix ' . floral_clean_html_classes( $sc_classes ) . '" '
    . Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ) . ' ' . $sticky_string . '>';
$html .= do_shortcode( $content );
$html .= '</div>';

echo sprintf( '%s', $html );