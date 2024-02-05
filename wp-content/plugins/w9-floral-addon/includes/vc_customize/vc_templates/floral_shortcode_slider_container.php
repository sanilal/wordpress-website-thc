<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_slider_container.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Slider_Container
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sc_loop = $sc_center = $sc_autoplay = $sc_autoplaytimeout = $sc_nav = $sc_dots = $sc_nav_pag_style = $sc_nav_pag_scheme_color =
$sc_margin_right = $sc_autoplayhoverpause = $sc_items = $sc_mouse_wheel = $sc_start_position = $animation_in = $sc_pag_margin_top =
$animation_out = $sc_items_desktop = $sc_items_desktop_small = $sc_items_tablet = $sc_items_tablet_small = $sc_auto_width = $sc_auto_height =
$sc_items_mobile = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

// class
$class_sc = array(
    'owl-carousel',
    $el_class,
    $sc_nav_pag_style,
    $sc_nav_pag_scheme_color,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);

if ( $sc_mouse_wheel == '1' ) {
    wp_enqueue_script( FLORAL_SCRIPT_PREFIX . 'jquery.mouse-wheel' );
    $class_sc[] = 'mouse-wheel-enabled';
}

// data-options
$data_options               = array();
$data_options['loop']       = ( $sc_loop == '1' ) ? true : false;
$data_options['center']     = ( $sc_center == '1' ) ? true : false;
$data_options['nav']        = ( $sc_nav == '1' ) ? true : false;
$data_options['dots']       = ( $sc_dots == '1' ) ? true : false;
$data_options['autoWidth']  = ( $sc_auto_width == '1' ) ? true : false;
$data_options['autoHeight'] = ( $sc_auto_height == '1' ) ? true : false;
if ( !empty( $sc_margin_right ) ) {
    $data_options['margin'] = intval( str_replace( 'px', '', $sc_margin_right ) );
}

if ( !empty( $sc_start_position ) ) {
    $data_options['startPosition'] = $sc_start_position;
}
if ( !empty( $animation_in ) ) {
    wp_enqueue_style( FLORAL_STYLE_PREFIX . 'animate' );
    $data_options['animateIn'] = $animation_in;
}
if ( !empty( $animation_out ) ) {
    wp_enqueue_style( FLORAL_STYLE_PREFIX . 'animate' );
    $data_options['animateOut'] = $animation_out;
}

$data_options['autoplay']           = ( $sc_autoplay == '1' ) ? true : false;
$data_options['autoplayHoverPause'] = ( $sc_autoplayhoverpause == '1' ) ? true : false;
if ( !empty( $sc_autoplaytimeout ) ) {
    $data_options['autoplayTimeout'] = intval( $sc_autoplaytimeout );
}

$data_responsive = array();

if ( $sc_items_desktop === 'inherit' ) {
    $sc_items_desktop = $sc_items;
}
if ( $sc_items_desktop_small === 'inherit' ) {
    $sc_items_desktop_small = $sc_items_desktop;
}
if ( $sc_items_tablet === 'inherit' ) {
    $sc_items_tablet = $sc_items_desktop_small;
}
if ( $sc_items_tablet_small === 'inherit' ) {
    $sc_items_tablet_small = $sc_items_tablet;
}
if ( $sc_items_mobile === 'inherit' ) {
    $sc_items_mobile = $sc_items_tablet_small;
}

if ( $sc_items_mobile !== '' ) {
    $data_responsive['0']['items'] = intval( $sc_items_mobile );
}
if ( $sc_items_tablet_small !== '' ) {
    $data_responsive['480']['items'] = intval( $sc_items_tablet_small );
}
if ( $sc_items_tablet !== '' ) {
    $data_responsive['768']['items'] = intval( $sc_items_tablet );
}
if ( $sc_items_desktop_small !== '' ) {
    $data_responsive['992']['items'] = intval( $sc_items_desktop_small );
}
if ( $sc_items_desktop !== '' ) {
    $data_responsive['1200']['items'] = intval( $sc_items_desktop );
}
if ( $sc_items !== '' ) {
    $data_responsive['1600']['items'] = intval( $sc_items );
}
$data_options['responsive'] = $data_responsive;

if ( !empty( $sc_pag_margin_top ) ) {
    
    if ( !$sc_pag_margin_top = floatval( $sc_pag_margin_top ) ) {
        $sc_pag_margin_top = 20;
    }
    
    $uni_class  = uniqid( 'floral-slider-container-' );
    $class_sc[] = $uni_class;
    
    if ( $sc_pag_margin_top > 0 ) {
        Floral_VC_Customize::add_custom_shortcode_css( array(
            ".$uni_class .owl-dots" => 'margin-top: ' . $sc_pag_margin_top . 'px'
        ) );
    } else {
        Floral_VC_Customize::add_custom_shortcode_css( array(
            ".$uni_class .owl-dots" => array( 'position: relative', 'top: ' . $sc_pag_margin_top . 'px' ),
        ) );
    }
}

?>
<div class="floral-slider-container <?php floral_the_clean_html_classes( $class_sc ); ?>"
     data-options="<?php echo esc_attr( json_encode( $data_options ) ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <?php echo do_shortcode( $content ) ?>
</div>