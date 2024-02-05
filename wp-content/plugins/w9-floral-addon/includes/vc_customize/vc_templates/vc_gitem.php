<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_gitem.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 *
 * @var $atts
 * @var $this WPBakeryShortCode_VC_Gitem
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


$normal_block_width = '';
//$gutter_width = '';
$become_normal_in_screen = '';
$el_class                = $width = $is_end = $css = $c_zone_position = $bgimage = $height = '';

extract( shortcode_atts( array(
    'el_class'                => '',
    'width'                   => '12',
    'is_end'                  => '',
    'normal_block_width'      => 'floral-normal-block-50',
//    'gutter_width' =>'floral-gutter-30',
    'become_normal_in_screen' => '',
    'css'                     => '',
    'c_zone_position'         => '',
    'bgimage'                 => '',
    'height'                  => '',
), $atts ) );

$css_class = 'vc_grid-item vc_clearfix' . ( 'true' === $is_end ? ' vc_grid-last-item' : '' )
    . ( strlen( $el_class ) ? ' ' . $el_class : '' )
    . ' vc_col-sm-' . $width;
if ( !empty( $c_zone_position ) ) {
    $css_class .= ' vc_grid-item-zone-c-' . $c_zone_position;
}

$css_class_mini = 'vc_grid-item-mini vc_clearfix ' . vc_shortcode_custom_css_class( $css, ' ' );
//$css_class_mini .= ' ' . $gutter_width;
$css_class .= '{{ filter_terms_css_classes }}';
$css_style = '';

if ( $c_zone_position === 'left' || $c_zone_position === 'right' ) {
    $css_class_mini .= ' ' . $normal_block_width;
    if ( !empty( $become_normal_in_screen ) ) {
        foreach ( explode( '||', $become_normal_in_screen ) as $item ) {
            $css_class_mini .= ' ' . $item;
        }
    }
}

if ( 'featured' === $bgimage ) {
    $css_style = 'background-image: url(\'{{ post_image_url }}\');';
    $css_class .= ' vc_grid-item-background-cover';
}
if ( strlen( $height ) > 0 ) {
    $css_style .= 'height: ' . $height . ';';
}
$output = '<div class="' . esc_attr( $css_class ) . '"'
    . ( empty( $css_style ) ? '' : ' style="' . esc_attr( $css_style ) . '"' )
    . '><div class="' . $css_class_mini . '">' . do_shortcode( $content )
    . '</div><div class="vc_clearfix"></div></div>';
echo $output;

