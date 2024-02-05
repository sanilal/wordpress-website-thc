<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_breadcrumb.php
 * @time    : 1/7/2017 2:26 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $atts
 * @var $this Floral_SC_Breadcrumb
 */

$prepended_text = $text_color = $text_color_cp = $background_color = $position = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

extract( $atts );

$class_sc_breadcrumb_wrapper = array(
	$css,
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	$text_color . '-color',
	$position
);

$class_sc_breadcrumb_inline = array();
if ( ( $text_color === 'custom' ) && ! empty( $text_color_cp ) ) {
	$class_sc_breadcrumb_inline[] = 'color: ' . $text_color_cp;
}
//
//if ( ! empty( $background_color ) ) {
//	$class_sc_breadcrumb_inline[] = 'background-color: ' . $background_color;
//}

$shape_background_color = array();
$shape_background_color['rect'] = $shape_background_color['slope'] = '';

if ( ! empty( $background_color ) ) {
	$shape_background_color['rect'] = 'style="background-color: ' . $background_color . ';"';
	$shape_background_color['slope'] = 'style="fill: ' . $background_color . ';"';
}

?>
<div class="floral-sc-breadcrumb clearfix <?php floral_the_clean_html_classes( $class_sc_breadcrumb_wrapper ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<div class="floral-breadcrumb-wrapper" <?php echo Floral_Map_Helpers::get_inline_style( $class_sc_breadcrumb_inline ); ?>>
		<?php Floral_Breadcrumb()->print_breadcrumb_html( $prepended_text, 'no-mb' ); ?>
		<div class="__shape">
			<div class="__rect" <?php echo $shape_background_color['rect'] ?>></div>
			<div class="__slope">
				<svg height="100%" width="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
					<?php if ( $position === 'left' ) { ?>
						<polygon points="0,0 0,100 100,100" <?php echo $shape_background_color['slope'] ?> />
					<?php } else { ?>
						<polygon points="0,100 100,100 100,0" <?php echo $shape_background_color['slope'] ?> />
					<?php } ?>
				</svg>
			</div>
		</div>
	</div>
</div>


