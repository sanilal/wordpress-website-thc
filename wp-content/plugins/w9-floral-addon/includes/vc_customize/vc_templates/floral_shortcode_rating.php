<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_rating.php
 * @time    : 7/8/2017 2:08 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $atts
 * @var $this Floral_SC_Rating
 */

$rating = $star_size = $star_color = $star_rated_color = $star_rated_color_cp = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

extract( $atts );

$class_sc_rating = array(
	vc_shortcode_custom_css_class( $css ),
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css )
);
$unrated_inline  = $rated_inline = array();
$star_size = !empty($star_size) ? $star_size : '15';
$star_color = !empty($star_color) ? $star_color : '#ddd';
// unrated
$unrated_inline['size'] = 'font-size: ' . $star_size . 'px';
$unrated_inline['color'] = 'color: ' . $star_color;

// rated
if (empty($rating)) {
	$rating = '0';
}
$rating          = floatval( $rating );
$percent = $rating / 5 * 100;

$rated_inline['width'] = 'width: ' . $percent . '%';
$rated_css = $star_rated_color . '-color';
$rated_inline['color'] = (( $star_rated_color === 'custom') && !empty($star_rated_color_cp) ) ? 'color: ' . $star_rated_color_cp : '';

?>
<div class="floral-sc-rating clearfix <?php floral_the_clean_html_classes( $class_sc_rating ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>

	<div class="__rating-wrapper">
		<div class="__rating" <?php echo Floral_Map_Helpers::get_inline_style( $unrated_inline ); ?>>
			<div class="__star <?php echo $rated_css ?>" <?php echo Floral_Map_Helpers::get_inline_style( $rated_inline ); ?>></div>
		</div>
	</div>

</div>