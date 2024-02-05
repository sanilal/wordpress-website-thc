<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_progress_bar.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $title
 * @var $values
 * @var $units
 * @var $bgcolor
 * @var $custombgcolor
 * @var $custombgbarcolor
 * @var $customtxtcolor
 * @var $customvaluetxtcolor
 * @var $options
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$layout_style = $values = $units = $bgcolor = $custom_barvalue_bgcolor_type = $custom_barvalue_bgcolor_normal = $custom_barvalue_bgcolor_gradient_1 = $custom_barvalue_bgcolor_gradient_2 = $custom_bar_bgcolor = $custom_txtcolor = $custom_value_txtcolor = $custom_value_bgcolor = $options = $el_class = $css = $tablet_css = $mobile_css = '';
$output       = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = $this->convertAttributesToNewProgressBar( $atts );
extract( $atts );
//echo '<pre>';
//var_export($atts);
//echo '</pre>';

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = array();
$options     = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}

$custom_barvalue_bgcolor = $custom_value_inline_css = $custom_value_inline_css_color = $custom_value_inline_css_bgcolor = $custom_value_nib = '';
if ( 'custom' === $bgcolor ) {
	if ( ( $custom_barvalue_bgcolor_type === 'normal' ) && ( '' !== $custom_barvalue_bgcolor_normal ) ) {
		$custom_barvalue_bgcolor = ' style="' . vc_get_css_color( 'background-color', $custom_barvalue_bgcolor_normal ) . '"';
	} else {
		if ( ( $custom_barvalue_bgcolor_type === 'gradient' ) && ( '' !== $custom_barvalue_bgcolor_gradient_1 ) && ( '' !== $custom_barvalue_bgcolor_gradient_2 ) ) {
			$custom_barvalue_bgcolor = 'style="' . esc_attr( implode( '; ', Floral_Map_Helpers::get_gradient_inline_style( $custom_barvalue_bgcolor_gradient_1, $custom_barvalue_bgcolor_gradient_2 ) ) ) . '"';
		}
	}
	
	if ( '' !== $custom_bar_bgcolor ) {
		$custom_bar_bgcolor = ' style="' . vc_get_css_color( 'background-color', $custom_bar_bgcolor ) . '"';
	}
	if ( '' !== $custom_txtcolor ) {
		$custom_txtcolor = ' style="' . vc_get_css_color( 'color', $custom_txtcolor ) . '"';
	}
	$custom_value_inline_css_attr = array();
	
	if ( '' !== $custom_value_txtcolor ) {
		$custom_value_inline_css_color  = vc_get_css_color( 'color', $custom_value_txtcolor );
		$custom_value_inline_css_attr[] = $custom_value_inline_css_color;
	}
	if ( ( '' !== $custom_value_bgcolor ) && ( $layout_style == 'style3' ) ) {
		$custom_value_inline_css_bgcolor = vc_get_css_color( 'background-color', $custom_value_bgcolor );
		$custom_value_inline_css_attr[]  = $custom_value_inline_css_bgcolor;
		$custom_value_nib                = ' style="' . vc_get_css_color( 'border-top-color', $custom_value_bgcolor ) . '"';
	}
	if ( ! empty( $custom_value_inline_css_attr ) ) {
		$custom_value_inline_css = ' style="' . esc_attr( implode( ' ', $custom_value_inline_css_attr ) ) . '"';
	}
	$bgcolor = '';
} else {
	$custom_barvalue_bgcolor_type       = '';
	$custom_barvalue_bgcolor_normal     = '';
	$custom_barvalue_bgcolor_gradient_1 = '';
	$custom_barvalue_bgcolor_gradient_2 = '';
	$custom_bar_bgcolor                 = '';
	$custom_txtcolor                    = '';
	$custom_value_txtcolor              = '';
	$bgcolor                            = 'vc_progress-bar-color-' . esc_attr( $bgcolor );
	$el_class                           .= ' ' . $bgcolor;
}

$class_to_filter = 'vc_progress_bar wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . vc_shortcode_custom_css_class( $tablet_css, ' ' ) . vc_shortcode_custom_css_class( $mobile_css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="h-progress-bar ' . esc_attr( $layout_style ) . ' ' . esc_attr( $css_class ) . '">';
//$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );
$values           = (array) vc_param_group_parse_atts( $values );
$max_value        = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line                     = $data;
	$new_line['value']            = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label']            = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['barvalue_bgcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custom_barvalue_bgcolor;
	$new_line['bar_bgcolor']      = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custom_bar_bgcolor;
	$new_line['txtcolor']         = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custom_txtcolor;
	$new_line['value_inline_css'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custom_value_inline_css;
	$new_line['value_nib']        = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custom_value_nib;
	if ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) {
		if ( isset( $data['custom_single_barvalue_bgcolor_type'] ) ) {
			
			if ( ( $data['custom_single_barvalue_bgcolor_type'] === 'normal' ) && ( isset( $data['custom_single_barvalue_bgcolor_normal'] ) ) ) {
				$new_line['barvalue_bgcolor'] = ' style="background-color: ' . esc_attr( $data['custom_single_barvalue_bgcolor_normal'] ) . ';"';
			} else {
				if (isset( $data['custom_single_barvalue_bgcolor_gradient_1'] ) && isset( $data['custom_single_barvalue_bgcolor_gradient_2'] ) ) {
					if ( ( $data['custom_single_barvalue_bgcolor_type'] === 'gradient' ) && ( '' !== $data['custom_single_barvalue_bgcolor_gradient_1'] ) && ( '' !== $data['custom_single_barvalue_bgcolor_gradient_2'] ) ) {
						$new_line['barvalue_bgcolor'] = 'style="' . esc_attr( implode( '; ', Floral_Map_Helpers::get_gradient_inline_style( $data['custom_single_barvalue_bgcolor_gradient_1'], $data['custom_single_barvalue_bgcolor_gradient_2'] ) ) ) . ';"';
					}
				}
			}
		}
		
		if ( isset( $data['custom_single_bar_bgcolor'] ) ) {
			$new_line['bar_bgcolor'] = ' style="background-color: ' . esc_attr( $data['custom_single_bar_bgcolor'] ) . ';"';
		}
		if ( isset( $data['custom_single_txtcolor'] ) ) {
			$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['custom_single_txtcolor'] ) . ';"';
		}
		$value_inline_css_attr = array();
		
		$value_inline_css_attr[] = isset( $data['custom_single_value_txtcolor'] ) ? 'color: ' . esc_attr( $data['custom_single_value_txtcolor'] ) . ';' : $custom_value_inline_css_color;
		
		if ( isset( $data['custom_single_value_bgcolor'] ) && ( $layout_style == 'style3' ) ) {
			$value_inline_css_attr[] = 'background-color: ' . esc_attr( $data['custom_single_value_bgcolor'] ) . ';';
			$new_line['value_nib']   = ' style="border-top-color: ' . esc_attr( $data['custom_single_value_bgcolor'] ) . ';"';
		} else {
			$value_inline_css_attr[] = $custom_value_inline_css_bgcolor;
		}
		
		if ( ! empty( $value_inline_css_attr ) ) {
			$new_line['value_inline_css'] = ' style="' . esc_attr( implode( ' ', $value_inline_css_attr ) ) . '"';
		}
	}
	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}


foreach ( $graph_lines_data as $line ) {
	$unit = ( '' !== $units ) ? ' <span class="vc_label_units"' . $line['value_inline_css'] . '>' . $line['value'] . $units . '<b' . ( ( $layout_style == 'style3' ) ? $line['value_nib'] : '' ) . '></b></span>' : '';
	
	$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
			' vc_progress-bar-color-' . $line['color'] : '' )
	           . '"' . $line['bar_bgcolor'] . '>';
	
	if ( $layout_style == 'style1' ) {
		$output .= '<small class="vc_label"' . $line['txtcolor'] . '><span class="progress-bar-title">' . $line['label'] . $unit . '</span></small>';
	} elseif ( $layout_style == 'style2' ) {
		$output .= '<small class="vc_label"' . $line['txtcolor'] . '><span class="progress-bar-title">' . $line['label'] . '</span>' . $unit . '</small>';
	} else {
		$output .= '<small class="vc_label"' . $line['txtcolor'] . '><span class="progress-bar-title">' . $line['label'] . '</span></small>';
	}
	
	if ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['barvalue_bgcolor'] . '>';
	
	if ( ( $layout_style == 'style3' ) && ( '' !== $units ) ) {
		$output .= $unit;
	}
	$output .= '</span></div>';
}
$output .= '</div>';
echo ! empty( $output ) ? $output : '';