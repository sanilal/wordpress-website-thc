<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_empty_space.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 *
 * @var $this WPBakeryShortCode_VC_Empty_space
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$height = $show_overlay = $overlay_color = $add_bg_img = $bg_img_id = $bg_img_size = $img_size = $img_size_custom = $bg_img_ratio = $bg_img_position = $el_class = $css = $tablet_css = $mobile_css = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );
if (empty($height) || $height === 'auto' ) {
	$height = 'auto';
} else {
	$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
	// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
	
	$regexr = preg_match( $pattern, $height, $matches );
	$value  = isset( $matches[1] ) ? (float) $matches[1] : (float) WPBMap::getParam( 'vc_empty_space', 'height' );
	$unit   = isset( $matches[2] ) ? $matches[2] : 'px';
	$height = $value . $unit;
}

//var_dump($height);
$inline_css = ( (float) $height >= 0.0 ) ? ' style="height: ' . esc_attr( $height ) . '"' : '';

$class              = array(
	'vc_empty_space',
	( $show_overlay === '1' ) ? 'floral-overlay-container' : '',
	$this->getExtraClass( $el_class ),
	vc_shortcode_custom_css_class( $css ),
	vc_shortcode_custom_css_class( $tablet_css ),
	vc_shortcode_custom_css_class( $mobile_css ),
);
$css_class          = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, floral_clean_html_classes( $class ), $this->settings['base'], $atts );
$inner_class        = array(
	'vc_empty_space_inner',
	! empty( $bg_img_position ) ? $bg_img_position : 'bgp-center-center'
);
$inner_inline_style = array();
//var_dump( $bg_img_id );
$inner_inline_style[] = 'height: 100%';
if ( ! empty( $bg_img_id ) && ! empty( $img_size ) && ! empty( $bg_img_ratio ) ) {
	if ( $img_size === 'custom' ) {
		$img_size = ! empty( $img_size_custom ) ? $img_size_custom : '1280x720';
	}
	$img_attr = array();
	if ( $bg_img_ratio != 'original' ) {
		$img_attr['ratio'] = $bg_img_ratio;
	}
	$img_attr['alt']      = 'background-image';
	$img_id               = preg_replace( '/[^\d]/', '', $bg_img_id );
	$inner_inline_style[] = 'background-image: url(' . Floral_Image::get_resize_image_url( $img_id, $img_size, $img_attr ) . ')';
}

switch ( $bg_img_size ) {
	case 'cover':
	case 'contain':
		$inner_inline_style['background-size'] = 'background-size: ' . $bg_img_size;
		break;
	case 'repeat':
	case 'no-repeat':
		$inner_inline_style['background-repeat'] = 'background-repeat: ' . $bg_img_size;
		break;
	default:
		$inner_inline_style['background-size'] = 'background-size: cover';
}

?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" <?php echo $inline_css; ?> >
	<?php
	if ( $add_bg_img !== '1' ) {
		?>
		<span class="vc_empty_space_inner"></span>
		<?php
	} else { ?>
		<div class="<?php floral_the_clean_html_classes( $inner_class ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inner_inline_style ); ?>></div>
	<?php }
	
	if ( $show_overlay === '1' ) {
		$overlay_inline_style = !empty($overlay_color) ? 'background-color: ' . $overlay_color : '';
		?>
		<div class="overlay-object" <?php echo Floral_Map_Helpers::get_inline_style( $overlay_inline_style ); ?>></div>
	<?php } ?>
</div>