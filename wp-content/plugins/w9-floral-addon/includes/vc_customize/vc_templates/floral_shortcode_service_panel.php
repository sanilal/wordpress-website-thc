<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_service_panel.php
 * @time    : 7/17/2017 6:09 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Service_Panel
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$sp_style = $sp_data =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$service_data = (array) vc_param_group_parse_atts( $sp_data );
//var_dump($service_data);
$class_service_panel = array(
	$sp_style,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);
$unique_id           = uniqid( 'floral-sc-service-panel-' );
wp_enqueue_script( "jquery-ui-accordion" );
wp_enqueue_script( "jquery-ui-tabs" );
?>
<div id="<?php echo $unique_id; ?>" class="floral-sc-service-panel clearfix <?php floral_the_clean_html_classes( $class_service_panel ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php
	include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-service-panel/' . $sp_style . '.php' );
	?>
</div>
