<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_mailchimp_signup.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$css = $animation_css = $animation_duration = $animation_delay = $el_class = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );
$widget_atts = array(
	'title'        => '',
);
$args = array(
	'before_widget' => '<div class="%s">',
);

$widget_wrapper_class = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

if ( class_exists( 'MC4WP_Form_Widget' ) ) {
	?>
	<div class="floral-sc-widget floral-widget-wrapper <?php floral_the_clean_html_classes( $widget_wrapper_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
		<?php the_widget( 'MC4WP_Form_Widget', $widget_atts, $args ); ?>
	</div>
	<?php
}
