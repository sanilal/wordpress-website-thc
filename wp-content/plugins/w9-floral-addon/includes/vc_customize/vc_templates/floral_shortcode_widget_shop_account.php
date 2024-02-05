<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_widget_shop_account.php
 * @time    : 10/7/2016 4:02 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Widget_Shop_Account
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Widget param
$title = $module_type = $link_to = $custom_link = $floral_extra_widget_classes = $floral_remove_default_mb = '';

// Widget wrapper param
$css = $animation_css = $animation_duration = $animation_delay = $el_class = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$widget_atts = array(
	'title'       => $title,
	'module_type' => $module_type,
	'link_to'     => $link_to,
	'custom_link' => $custom_link
);

$widget_wrapper_class = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

$widget_class   = array();
$widget_class[] = $floral_extra_widget_classes;
if ( ! empty( $floral_remove_default_mb ) ) {
	$widget_class[] = 'mb-0-i';
}

$args = array(
	'before_widget' => '<div class="floral-widget %s ' . floral_clean_html_classes( $widget_class ) . '">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="floral-widget-title">',
	'after_title'   => '</h3>'
);
?>
<div class="floral-sc-widget floral-widget-wrapper <?php floral_the_clean_html_classes( $widget_wrapper_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php the_widget( 'Floral_Widget_Shop_Account', $widget_atts, $args ); ?>
</div>