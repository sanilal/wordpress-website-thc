<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_pricing_table.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Pricing_Table
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$layout              = '';
$special             = '';
$name                = '';
$price               = '';
$price_unit          = '';
$price_unit_position = '';
$table_features      = '';
$enable_button       = '';
$button_link         = '';
$el_class            = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$make_special = '';
if ($layout === 'layout-1' && $special === 'yes') {
	$make_special = 'special';
}

$sc_classes = array(
	$layout,
	$make_special,
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	vc_shortcode_custom_css_class( $css ),
);


$inline_css = array();

$table_features = (array) vc_param_group_parse_atts( $table_features );

$button_atts = vc_map_integrate_parse_atts( 'floral_shortcode_' . 'pricing_table', 'floral_shortcode_' . 'button', $atts );

?>
<div class="floral-pricing-table <?php floral_the_clean_html_classes( $sc_classes ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ) ?>>
	<?php if ( $layout === 'layout-1' ) { ?>
		<div class="__name"><?php echo esc_html( $name ) ?></div>
		<div class="__features">
			<?php foreach ( $table_features as $feature ): ?>
				<div class="__single-feature">
					<?php if ( isset( $feature['feature'] ) ) {
						$feature_item = $feature['feature'];
//                    if ( @preg_match( '/^#E\-8_/', $heading_title ) ) {
//                        $feature_item = @preg_replace( '/^#E\-8_/', '', $feature_item );
//                        $feature_item = urldecode( base64_decode( $feature_item ) );
//                    }
						echo sprintf( '%s', $feature_item );
					} ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="__price">
			<?php
			if ( $price_unit_position == 'left' ) {
				echo sprintf( '<span class="__price_unit">%s</span>%s', esc_html( $price_unit ), esc_html( $price ) );
			} else {
				echo sprintf( '%s<span class="__price_unit"> %s</span>', esc_html( $price ), esc_html( $price_unit ) );
			}
			?>
		</div>
		<?php if ( $enable_button === 'yes' ): ?>
			<div class="__button_wrapper">
				<?php
				echo Vc_Shortcodes_Manager::getInstance()->getElementClass( 'floral_shortcode_' . 'button' )->output( $button_atts );
				?>
			</div>
		<?php endif; ?>
	<?php } elseif ( $layout === 'layout-2' ) { ?>
		<div class="__price">
			<?php
			if ( $price_unit_position == 'left' ) {
				echo sprintf( '<small class="__price_unit">%s</small>%s', esc_html( $price_unit ), esc_html( $price ) );
			} else {
				echo sprintf( '%s<small class="__price_unit"> %s</small>', esc_html( $price ), esc_html( $price_unit ) );
			}
			?>
		</div>
		<h3 class="__name"><?php echo esc_html( $name ) ?></h3>
		<div class="__separator"></div>
		<div class="__features">
			<?php foreach ( $table_features as $feature ): ?>
				<div class="__single-feature">
					<?php if ( isset( $feature['feature'] ) ) {
						$feature_item = $feature['feature'];
//                    if ( @preg_match( '/^#E\-8_/', $heading_title ) ) {
//                        $feature_item = @preg_replace( '/^#E\-8_/', '', $feature_item );
//                        $feature_item = urldecode( base64_decode( $feature_item ) );
//                    }
						echo sprintf( '%s', $feature_item );
					} ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if ( $enable_button === 'yes' ): ?>
			<div class="__button_wrapper">
				<?php
				echo Vc_Shortcodes_Manager::getInstance()->getElementClass( 'floral_shortcode_' . 'button' )->output( $button_atts );
				?>
			</div>
		<?php endif; ?>
	<?php } ?>
</div>