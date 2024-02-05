<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_div_content.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Div_Content
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$p_top                      = '';
$p_bottom                   = '';
$p_left                     = '';
$p_right                    = '';
$z_index                    = '';
$opacity                    = '';
$transform_code             = '';
$overlay_enabled            = '';
$overlay_width              = '';
$overlay_height             = '';
$inner_v_align              = '';
$overflow                   = '';
$hover_p_top                = '';
$hover_p_bottom             = '';
$hover_p_left               = '';
$hover_p_right              = '';
$hover_opacity              = '';
$hover_transform_code       = '';
$color                      = '';
$hover_color                = '';
$hover_border_color         = '';
$hover_background_color     = '';
$transition_duration        = '';
$transition_delay           = '';
$transition_timing_function = '';

$el_class = $css = $tablet_css = $mobile_css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$unique_class = uniqid( 'floral-div-content-style-' );
$sc_classes   = array(
    $unique_class,
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
);

$css_values       = array();
$hover_css_values = array();

if ( trim($p_top) !== '' ) {
    $css_values[] =   'top: ' . $p_top;
}
if ( trim($p_bottom) !== '' ) {
    $css_values[] =   'bottom: ' . $p_bottom;
}
if ( trim($p_left) !== '' ) {
    $css_values[] =   'left: ' . $p_left;
}
if ( trim($p_right) !== '' ) {
    $css_values[] =   'right: ' . $p_right;
}

if ( trim($hover_p_top) !== '' ) {
    $hover_css_values[] =   'top: ' . $hover_p_top;
}
if ( trim($hover_p_bottom) !== '' ) {
    $hover_css_values[] =   'bottom: ' . $hover_p_bottom;
}
if ( trim($hover_p_left) !== '' ) {
    $hover_css_values[] =   'left: ' . $hover_p_left;
}
if ( trim($hover_p_right) !== '' ) {
    $hover_css_values[] =   'right: ' . $hover_p_right;
}

if ( $color !== '' ) {
    $css_values[] = 'color: ' . $color;
}
if ( $z_index !== '' ) {
    $css_values[] = 'z-index: ' . $z_index;
}
if ( $opacity !== '' ) {
    $css_values[] = 'opacity: ' . $opacity;
}
if ( $transform_code !== '' ) {
    $transform_code = esc_attr( $transform_code );
    $css_values[]   = '-ms-transform: ' . $transform_code;
    $css_values[]   = '-webkit-transform: ' . $transform_code;
    $css_values[]   = 'transform: ' . $transform_code;
}

//Overlay CSS
if ( $overlay_enabled === 'true' ) {
    $sc_classes[] = 'floral-overlay-enabled';
    if ( $overlay_width !== '' ) {
        $css_values[] = 'width: ' . $overlay_width;
    }
    if ( $overlay_height !== '' ) {
        $css_values[] = 'height: ' . $overlay_height;
    }
    if ( $overflow !== '' ) {
        $css_values[] = 'overflow: ' . $overflow;
    }
    if ( $inner_v_align !== '' ) {
        $sc_classes[] = 'floral-overlay-inner-content-' . $inner_v_align;
    }
}

//Hover CSS

if ( $hover_transform_code !== '' ) {
    $hover_transform_code = esc_attr( $hover_transform_code );
    $hover_css_values[]   = '-ms-transform: ' . $hover_transform_code;
    $hover_css_values[]   = '-webkit-transform: ' . $hover_transform_code;
    $hover_css_values[]   = 'transform: ' . $hover_transform_code;
}

if ( $hover_color !== '' ) {
    $hover_css_values[] = 'color: ' . $hover_color;
}
if ( $hover_border_color !== '' ) {
    $hover_css_values[] = 'border-color: ' . $hover_border_color;
}
if ( $hover_background_color !== '' ) {
    $hover_css_values[] = 'background-color: ' . $hover_background_color;
    $hover_css_values[] = 'background-image: none';
}
if ( $hover_opacity !== '' && $hover_opacity != $opacity ) {
    $hover_css_values[] = 'opacity: ' . $hover_opacity;
}

$unique_selector = '.' . $unique_class;
$elem_css        = array( $unique_selector => $css_values );
if ( !empty( $hover_css_values ) ) {
    $unique_hover_selector            = '.floral-div-wrapper:hover > ' . $unique_selector;
    $elem_css[$unique_hover_selector] = $hover_css_values;
}

$inline_css        = array();
$transition_string = '';
if ( $transition_duration !== '' ) {
    $transition_string .= $transition_duration . 's ';
} else {
    $transition_string .= '0.3s ';
}
if ( $transition_delay !== '' ) {
    $transition_string .= $transition_delay . 's ';
}
if ( $transition_timing_function !== '' ) {
    $transition_string .= $transition_timing_function;
}
if ( $transition_string !== '' ) {
    $inline_css[] = '-webkit-transition: all ' . $transition_string;
    $inline_css[] = '-moz-transition: all ' . $transition_string;
    $inline_css[] = '-o-transition: all ' . $transition_string;
    $inline_css[] = 'transition: all ' . $transition_string;
}


Floral_VC_Customize::add_custom_shortcode_css( $elem_css );

?>
<div class="floral-div-content <?php floral_the_clean_html_classes( $sc_classes ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ); ?>>
    <div class="floral-div-content-inner">
        <?php if ( $overlay_enabled == 'true' ): ?>
            <div class="floral-overlay-content">
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php else: ?>
            <?php echo do_shortcode( $content ); ?>
        <?php endif; ?>
    </div>
</div>