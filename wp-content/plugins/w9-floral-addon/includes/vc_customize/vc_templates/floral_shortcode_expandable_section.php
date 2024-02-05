<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_expandable_section.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Expandable_Section
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$es_active_state = $es_animation = $el_class = $es_expand_label = $es_spacing = $inner_container = $es_content_max_width = $es_toggle_button_size =
$es_expand_add_icon = $expand_type = $expand_icon_9wpthemes = $expand_icon_fontawesome = $expand_icon_openiconic = $expand_icon_typicons = $expand_icon_entypo = $expand_icon_linecons = $expand_icon_monosocial =
$es_expand_text_color = $es_expand_bgc = $es_collapse_label =
$es_collapse_add_icon = $collapse_type = $collapse_icon_9wpthemes = $collapse_icon_fontawesome = $collapse_icon_openiconic = $collapse_icon_typicons = $collapse_icon_entypo = $collapse_icon_linecons = $collapse_icon_monosocial =
$es_collapse_text_color = $es_collapse_bgc =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

if ( empty( $es_active_state ) ) {
	$es_active_state = 'collapse';
}

$uni_class     = uniqid( 'floral-expandable-section-' );
$class_wrapper = array(
	$uni_class,
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	vc_shortcode_custom_css_class( $css ),
	'es-state-' . $es_active_state,
	'es-toggle-btn-' . $es_toggle_button_size
);

if ( empty( $es_expand_label ) ) {
	$es_expand_label = __( 'View Less', 'w9-floral-addon' );
}

if ( empty( $es_collapse_label ) ) {
	$es_collapse_label = __( 'View Less', 'w9-floral-addon' );
}

$state_label = $es_active_state === 'expand' ? $es_expand_label : $es_collapse_label;

$__icon_markup       = '';
$__icon_expand_class = 'hide';
if ( $es_expand_add_icon === 'yes' ) {
	vc_icon_element_fonts_enqueue( $expand_type );
	$__icon_expand_class = isset( ${'expand_icon_' . $expand_type} ) ? esc_attr( ${'expand_icon_' . $expand_type} ) : 'w9 w9-ico-uparrows15';
	
}

$__icon_collapse_class = 'hide';
if ( $es_collapse_add_icon === 'yes' ) {
	vc_icon_element_fonts_enqueue( $collapse_type );
	$__icon_collapse_class = isset( ${'collapse_icon_' . $collapse_type} ) ? esc_attr( ${'collapse_icon_' . $collapse_type} ) : 'w9 w9-ico-downarrows10';
}

// data expand button
$data_class_expand = array(
	$es_expand_text_color . '-color',
	$es_expand_bgc . '-bgc'
);

$data_class_collapse = array(
	$es_collapse_text_color . '-color',
	$es_collapse_bgc . '-bgc'
);


$class_expand_button = array();

if ( $es_active_state === 'expand' ) {
	$class_expand_button = $data_class_expand;
	$__icon_markup       = sprintf( '<i class="floral-inline-icon %s"></i>', $__icon_expand_class );
	$display             = 'block';
} else {
	$class_expand_button = $data_class_collapse;
	$__icon_markup       = sprintf( '<i class="floral-inline-icon %s"></i>', $__icon_collapse_class );
	$display             = 'none';
}

// toggle animation
if ( empty( $es_animation ) ) {
	$es_animation = 'slide';
}
// internal style
$internal_style = array();
if ( ! empty( $es_content_max_width ) ) {
	$internal_style[".$uni_class.floral-expandable-section .toggle-content-container-inner"][] = 'max-width: ' . $es_content_max_width;
}

if ( $es_spacing !== '' ) {
	$internal_style[".$uni_class.floral-expandable-section .toggle-content"][] = 'margin-top: ' . $es_spacing . 'px';
}

Floral_VC_Customize::add_custom_shortcode_css( $internal_style );

?>
<div class="floral-expandable-section <?php floral_the_clean_html_classes( $class_wrapper ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<div class="expand-toggle-button <?php floral_the_clean_html_classes( $class_expand_button ); ?>" data-class-expand="<?php floral_the_clean_html_classes( $data_class_expand ); ?>" data-class-collapse="<?php floral_the_clean_html_classes( $data_class_collapse ); ?>" data-toggle-animation="<?php echo esc_attr( $es_animation ); ?>">
		<div class="button-content text-center" data-expand-label="<?php echo esc_attr( $es_expand_label ); ?>" data-expand-icon="<?php echo esc_attr( $__icon_expand_class ); ?>" data-collapse-label="<?php echo esc_attr( $es_collapse_label ); ?>" data-collapse-icon="<?php echo esc_attr( $__icon_collapse_class ); ?>">
			<?php echo ! empty( $__icon_markup ) ? $__icon_markup : ''; ?>
			<span class="state-label text-uppercase fz-14 ls-005 fw-semibold"><?php echo esc_html( $state_label ); ?></span>
		</div>
	</div>
	<div class="toggle-content" style="display: <?php echo esc_attr( $display ); ?>">
		<div class="<?php echo $inner_container ?>">
			<div class="toggle-content-container-inner block-align-center">
				<?php echo wpb_js_remove_wpautop( $content ); ?>
			</div>
		</div>
	</div>
</div>




