<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_portfolio_page_title.php
 * @time    : 8/29/16 4:41 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$page_title_align =
$title_font_family =
$title_font_size =
$subtitle_font_family =
$subtitle_font_size =
$add_button = '';
$el_class         = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( Floral_SC_Portfolio_Page_Title::SC_BASE, $atts );
extract( $atts );

$sc_classes = array(
    'floral-portfolio-page-title',
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);

if ( !empty( $page_title_align ) ) {
    $sc_classes[] = $page_title_align;
}

$title_inline_style = "";
if ( !empty( $title_font_size ) ) {
    $title_inline_style = 'font-size:' . $title_font_size;
}else{
    $title_font_size = '70px';
}
$subtitle_inline_style = "";
if ( !empty( $subtitle_font_size ) ) {
    $subtitle_inline_style = 'font-size:' . $subtitle_font_size;
}else{
    $subtitle_font_size = '20px';
}


if ( $add_button === 'yes' ) {
    $button_atts             = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Button::SC_BASE, $atts );
    $url                     = urlencode( floral_get_meta_option( 'portfolio-project-url' ) );
    $target                  = urlencode( '_blank' );
    $button_atts['btn_link'] = sprintf( 'url:%s||target:%s|', $url, $target );
}

$video_popup = floral_get_meta_option('portfolio-video');

?>
<div class="<?php floral_the_clean_html_classes( $sc_classes ); ?>">
    <?php if(!empty($video_popup)): ?>
        <div class="__video-popup-wrapper">
            <a href="<?php echo esc_url($video_popup); ?>" data-rel="prettyPhoto" class="prettyPhoto" data-width="1000" data-height="562.5"><i class="floral-inline-icon w9 w9-ico-play38"></i></a>
        </div>
    <?php endif; ?>
    
    <h1 class="__title fw-bold responsive-font-size <?php esc_attr_e($title_font_family) ?>" style="<?php esc_attr_e( $title_inline_style ) ?>" data-resize=<?php echo esc_attr(json_encode(array('font_size' => array('minFontSize'=> 20, 'maxFontSize' => floatval($title_font_size))))); ?>>
        <?php the_title(); ?>
    </h1>
    <p class="__subtitle responsive-font-size <?php esc_attr_e($subtitle_font_family) ?>" style="<?php esc_attr_e( $subtitle_inline_style ) ?>"  data-resize=<?php echo esc_attr(json_encode(array('font_size' => array('minFontSize'=> 16, 'maxFontSize' => floatval($subtitle_font_size))))); ?>>
        <span><?php echo get_the_term_list( get_the_ID(), Floral_CPT_Portfolio::TAX_SLUG, '', ', ', ' / ' ); ?></span>
        <span><?php the_date() ?></span>
    </p>
    <?php if ( $add_button === 'yes' ) {
        $button = Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Button::SC_BASE )->output( $button_atts );
        echo sprintf( '<div class="__button-wrapper">%s</div>', $button );
    } ?>
</div>
