<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_portfolio_about.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Portfolio_About
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( 'floral_shortcode_portfolio_about', $atts );
extract( $atts );


$sc_classes = array(
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);

$about_title = floral_get_meta_option( 'portfolio-about-title' );
$about_content = floral_get_meta_option( 'portfolio-about-content' )
?>
<div class="floral-portfolio-about-wrapper <?php floral_the_clean_html_classes( $sc_classes ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ) ?>>
    <h2 class="s-font"><?php echo esc_html( $about_title ); ?></h2>
    <p class="fz-14"><?php echo wp_kses_post( $about_content ) ?></p>
</div>
