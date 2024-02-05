<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_column.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 *
 * $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Column
 */
$el_class = $css = $tablet_css = $background_position = $mobile_css = $width = $offset = $animation_css = $animation_duration = $animation_delay =
$font_size = $custom_font_size = $responsive_font_size = $responsive_compressor = $responsive_minimum_font_size = $text_color = $text_custom_color =
$heading_color = $heading_custom_color = $link_color = $link_custom_color = $link_hover_color = $link_hover_custom_color =
$sloped_edge_position = $sloped_edge_left = $sloped_edge_right = $sloped_edge_color = $sloped_edge_overlay_mode =
$sloped_edge_left_degree = $sloped_edge_right_degree =
$text_align = $max_width = $horizontal_align = $vertical_align = $text_align_on_tablet = $text_align_on_mobile = '';
$output   = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$uni_class   = uniqid( 'wpb_column-' );
$css_classes = array(
    $this->getExtraClass( $el_class ),
    'wpb_column',
    'vc_column_container',
    $uni_class,
    $width,
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

//if($background_position != 'bgp-center-center-i'){
if(!empty($background_position)){
    $css_classes[] = esc_attr($background_position);
}

$inner_css_class = array(
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    $horizontal_align,
    $text_align,
    $text_align_on_tablet,
    $text_align_on_mobile
);

// style class
if ( !empty( $text_color ) ) {
    $inner_css_class[] = $text_color . '-color';
}

if ( !empty( $heading_color ) ) {
    $inner_css_class[] = $heading_color . '-heading-color';
}

if ( !empty( $link_color ) ) {
    $inner_css_class[] = $link_color . '-link-color';
}

if ( !empty( $link_hover_color ) ) {
    $inner_css_class[] = $link_hover_color . '-link-hover-color';
}


$style_inner = array();
switch ( $vertical_align ) {
    case 'block-align-top':
        $style_inner[] = 'align-self: flex-start';
        break;
    case 'block-align-middle':
        $style_inner[] = 'align-self: center';
        break;
    case 'block-align-bottom':
        $style_inner[] = 'align-self: flex-end';
        break;
}

/*-------------------------------------
	FONT SIZE
---------------------------------------*/
$data_responsive_fz = array();
if ( !empty( $font_size ) ) {
    if ( !empty( $responsive_font_size ) ) {
        $inner_css_class[] = 'responsive-font-size';
        
        
        if ( $font_size == 'custom' ) {
            $data_responsive_fz['font_size']['maxFontSize'] = intval( $custom_font_size );
        } else {
            $data_responsive_fz['font_size']['maxFontSize'] = intval( $font_size );
        }
        
        if ( !empty( $responsive_minimum_font_size ) ) {
            $data_responsive_fz['font_size']['minFontSize'] = intval( $responsive_minimum_font_size );
        }
        
        $responsive_compressor = ( !empty( $responsive_compressor ) && floatval( $responsive_compressor ) ) ? floatval( $responsive_compressor ) : 1;
        
        $data_responsive_fz['compressor'] = $responsive_compressor;
    } else {
        $inner_css_class[] = 'fz-' . $font_size;
        
        if ( $font_size === 'custom' ) {
            $style_inner[] = 'font-size: ' . $custom_font_size . 'px';
        }
    }
}

/*-------------------------------------
	CUSTOM STYLE
---------------------------------------*/
$vc_column_style = array();

// custom Text color
if ( $text_color == 'custom' && !empty( $text_custom_color ) ) {
    $vc_column_style[".$uni_class"] = 'color: ' . $text_custom_color;
}
// custom heading color
if ( $heading_color == 'custom' && !empty( $heading_custom_color ) ) {
    $vc_column_style[".$uni_class h1, .$uni_class h2, .$uni_class h3, .$uni_class h4, .$uni_class h5, .$uni_class h6"] = 'color: ' . $heading_custom_color;
}
// custom link color
if ( $link_color == 'custom' && !empty( $link_custom_color ) ) {
    $vc_column_style[".$uni_class a"] = 'color: ' . $link_custom_color;
}

// custom link hover & active
if ( $link_hover_color == 'custom' && !empty( $link_hover_custom_color ) ) {
    $vc_column_style[".$uni_class a:hover, .$uni_class a:active"] = 'color: ' . $link_hover_custom_color;
}

Floral_VC_Customize::add_custom_shortcode_css( $vc_column_style );

// max width
$max_width = trim( $max_width );
if ( !empty( $max_width ) ) {
    $style_inner[] = 'max-width: ' . $max_width;
}
// column has fill
if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) ) {
    $css_classes[] = 'vc_col-has-fill';
}

/*-------------------------------------
	SLOPED EDGE
---------------------------------------*/
$sloped_edge_left_markup  = '';
$sloped_edge_right_markup = '';
if ( $sloped_edge_position !== 'none' ) {
    $css_classes[] = 'sloped-edge-enabled';
    
    
    if ( $sloped_edge_position === 'left' || $sloped_edge_position === 'both' ) {
        $sloped_edge_left_degree = intval( str_replace( array( 'deg' ), '', $sloped_edge_left_degree ) );
        $sloped_edge_left_markup = Floral_Map_Helpers::get_triangle_svg( $sloped_edge_left, $sloped_edge_left_degree, $sloped_edge_color, true, array( 'left-edge', $sloped_edge_overlay_mode ) );
    }
    
    if ( $sloped_edge_position === 'right' || $sloped_edge_position === 'both' ) {
        $sloped_edge_right_degree = intval( str_replace( array( 'deg' ), '', $sloped_edge_right_degree ) );
        $sloped_edge_right_markup = Floral_Map_Helpers::get_triangle_svg( $sloped_edge_right, $sloped_edge_right_degree, $sloped_edge_color, true, array( 'right-edge', $sloped_edge_overlay_mode ) );
    }
}

/*-------------------------------------
	OUTPUT
---------------------------------------*/
$wrapper_attributes = array();

$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ) . '>';
$output .= $sloped_edge_left_markup;
$output .= '<div class="vc_column-inner ' . esc_attr( floral_clean_html_classes( $inner_css_class ) ) . '" ' . Floral_Map_Helpers::get_inline_style( $style_inner ) . ' data-resize="' . esc_attr( json_encode( $data_responsive_fz ) ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= $sloped_edge_right_markup;
$output .= '</div>';

echo $output;
