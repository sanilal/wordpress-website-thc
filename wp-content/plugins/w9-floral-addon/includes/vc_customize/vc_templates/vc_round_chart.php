<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_round_chart.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $title
 * @var $el_class
 * @var $type
 * @var $style
 * @var $legend
 * @var $animation
 * @var $tooltips
 * @var $stroke_color
 * @var $custom_stroke_color
 * @var $stroke_width
 * @var $values
 * @var $css
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Round_Chart
 */
$el_class = $title = $type = $style = $legend = $animation = $tooltips = $stroke_color = $stroke_width = $values = $css = $custom_stroke_color = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


wp_enqueue_script( 'vc_round_chart' );

$class_to_filter = 'vc_chart vc_round-chart wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$options = array();

if ( !empty( $legend ) ) {
    $options[] = 'data-vc-legend="1"';
}

if ( !empty( $tooltips ) ) {
    $options[] = 'data-vc-tooltips="1"';
}

if ( !empty( $animation ) ) {
    $options[] = 'data-vc-animation="' . esc_attr( $animation ) . '"';
}

if ( !empty( $stroke_color ) ) {
    if ( $stroke_color !== 'custom' ) {
        $color = Floral_Map_Helpers::get_color_value( $stroke_color );
    } elseif ( !empty( $custom_stroke_color ) ) {
        $color = $custom_stroke_color;
    } else {
        $color = '#DDDDDD';
    }
    
    $options[] = 'data-vc-stroke-color="' . esc_attr( $color ) . '"';
}

if ( !empty( $stroke_width ) ) {
    $options[] = 'data-vc-stroke-width="' . esc_attr( $stroke_width ) . '"';
}

$values = (array) vc_param_group_parse_atts( $values );
$data   = array();

foreach ( $values as $k => $v ) {
    if ( $v['color'] !== 'custom' ) {
        $color = Floral_Map_Helpers::get_color_value( $v['color'] );
    } else {
        if ( !empty( $v['custom_color'] ) ) {
            $color = $v['custom_color'];
        } else {
            $color = '#999';
        }
    }
    $highlight = vc_colorCreator( $color, - 10 ); //10% darker
    
    $data[] = array(
        'value'     => intval( isset( $v['value'] ) ? $v['value'] : 0 ),
        'color'     => $color,
        'highlight' => $highlight,
        'label'     => isset( $v['title'] ) ? $v['title'] : '',
    );
}

$options[] = 'data-vc-type="' . esc_attr( $type ) . '"';
$options[] = 'data-vc-values="' . esc_attr( json_encode( $data ) ) . '"';

if ( '' !== $title ) {
    $title = '<h2 class="wpb_heading">' . $title . '</h4>';
}

$canvas_html = '<canvas class="vc_round-chart-canvas" width="1" height="1"></canvas>';
$legend_html = '';
if ( $legend ) {
    foreach ( $data as $v ) {
        $color = is_array( $v['color'] ) ? current( $v['color'] ) : $v['color'];
        $legend_html .= '<li><span style="background-color:' . $color . '"></span>' . $v['label'] . '</li>';
    }
    $legend_html = '<ul class="vc_chart-legend">' . $legend_html . '</ul>';
    $canvas_html = '<div class="vc_chart-with-legend">' . $canvas_html . '</div>';
}

$output = '
<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $options ) . '>
	' . $title . '
	<div class="wpb_wrapper">
		' . $canvas_html . $legend_html . '
	</div>' . '
</div>' . '
';

echo $output;
