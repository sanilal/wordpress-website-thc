<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_line_chart.php
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
 * @var $legend
 * @var $animation
 * @var $tooltips
 * @var $x_values
 * @var $values
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Line_Chart
 */
$el_class = $title = $type = $legend = $tooltips = $animation = $x_values = $values = $css = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


wp_enqueue_script( 'vc_line_chart' );

$class_to_filter = 'vc_chart vc_line-chart wpb_content_element';
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
    $options[] = 'data-vc-animation="' . $animation . '"';
}

$values = (array) vc_param_group_parse_atts( $values );
$data   = array(
    'labels'   => explode( ';', trim( $x_values, ';' ) ),
    'datasets' => array(),
);

foreach ( $values as $k => $v ) {

    if ( isset( $v['color'] ) ) {
        if ( $v['color'] !== 'custom' ) {
            $color = Floral_Map_Helpers::get_color_value( $v['color'] );
        } else {
            $color = $v['custom_color'];
        }
        $highlight = vc_colorCreator( $color, - 10 ); //10% darker
    } else {
        $color     = 'grey';
        $highlight = 'grey';
    }

    // don't use gradients for lines
    if ( 'line' === $type ) {
        $color      = is_array( $color ) ? end( $color ) : $color;
        $highlight  = is_array( $highlight ) ? end( $highlight ) : $highlight;
        $rgb        = vc_hex2rgb( $color );
        $fill_color = 'rgba(' . $rgb[0] . ', ' . $rgb[1] . ', ' . $rgb[2] . ', 0.1)';
    } else {
        $fill_color = $color;
    }
    
    $stroke_color           = $color;
    $highlight_stroke_color = $highlight;

    $data['datasets'][] = array(
        'label'                => isset( $v['title'] ) ? $v['title'] : '',
        'fillColor'            => $fill_color,
        'strokeColor'          => $stroke_color,
        'pointColor'           => $color,
        'pointStrokeColor'     => $color,
        'highlightFill'        => $highlight,
        'highlightStroke'      => $highlight_stroke_color,
        'pointHighlightFill'   => $highlight_stroke_color,
        'pointHighlightStroke' => $highlight_stroke_color,
        'data'                 => explode( ';', isset( $v['y_values'] ) ? trim( $v['y_values'], ';' ) : '' ),
    );
}

$options[] = 'data-vc-type="' . esc_attr( $type ) . '"';
$options[] = 'data-vc-values="' . htmlentities( json_encode( $data ) ) . '"';

if ( '' !== $title ) {
    $title = '<h2 class="wpb_heading">' . $title . '</h4>';
}

$canvas_html = '<canvas class="vc_line-chart-canvas" width="1" height="1"></canvas>';
$legend_html = '';
if ( $legend ) {
    foreach ( $data['datasets'] as $v ) {
        $color = is_array( $v['pointColor'] ) ? current( $v['pointColor'] ) : $v['pointColor'];
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
