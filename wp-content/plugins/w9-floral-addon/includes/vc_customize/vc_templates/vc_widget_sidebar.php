<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_widget_sidebar.php
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
 * @var $sidebar_id
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Widget_sidebar
 */
$el_class = $sidebar_id = $css = $tablet_css = $mobile_css = $animation_css = $animation_duration = $animation_delay = '';
$atts     = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $sidebar_id ) {
    return null;
}

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$el_class = $this->getExtraClass( $el_class );

ob_start();
dynamic_sidebar( $sidebar_id );
$sidebar_value = ob_get_contents();
ob_end_clean();

$sidebar_value = trim( $sidebar_value );
$sidebar_value = ( '<li' === substr( $sidebar_value, 0, 3 ) ) ? '<ul>' . $sidebar_value . '</ul>' : $sidebar_value;

$css_class = array(
    'wpb_widgetised_column',
    'wpb_content_element',
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

$output = '
	<div class="' . floral_clean_html_classes( $css_class ) . '" ' . Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ) . '>
		<div class="wpb_wrapper">
			' . $sidebar_value . '
		</div>
	</div>
';

echo sprintf( '%s', $output );
