<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_pie.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $value
 * @var $units
 * @var $color
 * @var $custom_color
 * @var $label_value
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$title = $el_class = $value = $border_width = $units = $color = $custom_color = $label_value = $css = '';
$atts  = $this->convertOldColorsToNew( $atts );
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'vc_pie_custom',Floral_Addon::plugin_url() . 'assets/js/vc_chart_custom.js', array( 'jquery',
	'waypoints',
	'progressCircle', ), Floral_Addon::VERSION, true );

if ( $color != '' ) {
    if ( $color !== 'custom' ) {
        $color = Floral_Map_Helpers::get_color_value( $color );
    } else {
        $color = $custom_color;
    }
} else {
    $color = '#999';
}

//var_dump($border_width);

if ( empty($border_width) || ($border_width == 0 )) {
	$border_width = '10';
}
$back_border_width =  $border_width + 1;
//var_dump($back_border_width);

$class_to_filter = 'vc_pie_chart wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class= "' . esc_attr( $css_class ) . '" data-pie-value="' . esc_attr( $value ) . '" data-pie-label-value="' . '' . '" data-pie-units="' . esc_attr( $units ) . '" data-pie-color="' . esc_attr( $color ) . '" ' . 'data-pie-border-width="' . esc_attr( $border_width ) .'">';
$output .= '<div class="wpb_wrapper">';
$output .= '<div class="vc_pie_wrapper">';
//$output .= '<span class="vc_pie_chart_back" style="border-color: ' . esc_attr( $color ) . '; border-width: ' . esc_attr( $back_border_width ) . 'px' .'"></span>';
$output .= '<span class="vc_pie_chart_back" style="border-width: ' . esc_attr( $back_border_width ) . 'px' .'"></span>';
$output .= '<span class="vc_pie_chart_value"><span class="__inner"><span class="__value"></span><span class="__label">'. $label_value .'</span></span></span></span>';
$output .= '<canvas width="101" height="101"></canvas>';
$output .= '</div>';

if ( '' !== $title ) {
    $output .= '<h4 class="wpb_heading wpb_pie_chart_heading">' . $title . '</h4>';
}

$output .= '</div>';
$output .= '</div>';

echo $output;
