<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_portfolio_gallery.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Portfolio_Gallery
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$gallery_type = $img_size = $img_size_custom = $image_ratio = $onclick = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';


$atts = vc_map_get_attributes( Floral_SC_Portfolio_Gallery::SC_BASE, $atts );
extract( $atts );


$sc_classes = array(
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);

$inline_css = array();

$meta_value = floral_get_meta_option( 'portfolio-gallery' );
$image_list = array();
if ( !empty( $meta_value ) && is_string( $meta_value ) ) {
    $image_list = (explode(",",$meta_value));
}

if ( empty( $gallery_type ) || $gallery_type === 'slider' ) {
    $carousel_atts           = $button_atts = vc_map_integrate_parse_atts( Floral_SC_Portfolio_Gallery::SC_BASE, Floral_SC_Image_Carousel::SC_BASE, $atts );
    $carousel_atts['images'] = implode( ',', $image_list );
    echo Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Image_Carousel::SC_BASE )->output( $carousel_atts );
} else {
    //Simple gallery
    if($img_size === 'custom'){
        $img_size = $img_size_custom;
    }
    $image_atts = array();
    if(!empty($image_ratio) && $image_ratio != 'original'){
        $image_atts['ratio'] = $image_ratio;
    }
    if($onclick === 'magnific'){
        $gallery_id = uniqid('floral-gal');
        $image_atts['gallery'] = $gallery_id;
    }
    ?>
    <div class="floral-gallery floral-portfolio-gallery-simple <?php floral_the_clean_html_classes( $sc_classes ) ?>">
        <?php
        foreach ( $image_list as $image ) {
            if($onclick === 'magnific'){
                $image_rendered = Floral_Wrap::prettyphoto_image($image, $img_size, $image_atts);
            }else{
                $image_rendered = Floral_Image::get_image( $image, $img_size, $image_atts );
            }
            echo sprintf( '<div class="__image">%s</div>', $image_rendered );
        }
        ?>
    </div>
    <?php
}
