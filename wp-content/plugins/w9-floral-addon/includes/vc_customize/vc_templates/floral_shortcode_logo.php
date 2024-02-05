<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_logo.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Logo
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$logo_source = '';
$logo_width  = '';
$logo_height = '';
$logo_align = '';

$el_class = '';
$css      = '';
$animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );
$sc_class = array(
    $el_class,
    $logo_align,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css )
);

?>
<div class="floral-shortcode-logo <?php floral_the_clean_html_classes( $sc_class ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <?php echo Floral_Image::logo( $logo_source, $logo_width, $logo_height ); ?>
</div>
    
