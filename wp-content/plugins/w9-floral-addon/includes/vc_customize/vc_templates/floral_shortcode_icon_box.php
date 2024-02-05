<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_icon_box.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Icon_Box
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$type = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons =
$icon_entypo = $icon_linecons = $icon_monosocial = $ib_i_style = $ib_i_style_rounded_align = $ib_i_style_normal_align = $ib_i_size = $ib_title =
$ib_sub_title = $ib_description = $ib_link = $ib_i_color = $ib_i_gradient_color_1 = $ib_i_gradient_color_2 = $ib_i_gradient_angle = $ib_i_bgc = $ib_i_hover_color = $ib_i_hover_bgc  = $ib_tx_color  = $el_class = $css = $tablet_css = $mobile_css =
$animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );
// class
$ib_unique_class = uniqid( 'floral-ib-' );

$ib_i_rounded_style = '';
$ib_i_rounded_align_list = array('left','top-center', 'right');

if ( ( in_array($ib_i_style_rounded_align, $ib_i_rounded_align_list) ) && ($ib_i_style === 'rounded') ) {
    $ib_i_rounded_style = 'ib-i-bgc-' . $ib_i_bgc . ' ' . 'ib-i-hover-color-' . $ib_i_hover_color . ' ' . 'ib-i-hover-bgc-' . $ib_i_hover_bgc;
}

$ib_i_align = ($ib_i_style === 'rounded') ? $ib_i_style_rounded_align : $ib_i_style_normal_align;

//var_dump($ib_i_rounded_style);
$class_icon_box = array(
    $ib_unique_class,
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    'default',
	'style-' . $ib_i_style,
    $ib_i_align,
    $ib_i_rounded_style,
    'ib-tx-color-' . $ib_tx_color,
);
if ( $ib_i_color !== 'gradient' ) {
    $class_icon_box[] = 'ib-i-color-' . $ib_i_color;
}


// icon size

$internal_style = array();

$ib_i_size       = intval( str_replace( '%', '', $ib_i_size ) );
$ib_i_size_scale = empty( $ib_i_size ) ? 1 : $ib_i_size / 100;
if ( ( in_array($ib_i_style_rounded_align, $ib_i_rounded_align_list) ) && ($ib_i_style === 'rounded') ) {
    $ib_i_size_scale = 1;
}

if ( isset( $this->icon_default_size[$ib_i_align] ) && $ib_i_size_scale !== 1 ) {
    $ib_i_size = $ib_i_size_scale * $this->icon_default_size[$ib_i_align];

    $internal_style[".$ib_unique_class .__icon i"][] = 'font-size: ' . $ib_i_size . 'px !important';
}

// Gradient color
if ( $ib_i_color === 'gradient' ) {
    $gradient_1 = Floral_Map_Helpers::get_color_value( $ib_i_gradient_color_1 );
    $gradient_2 = Floral_Map_Helpers::get_color_value( $ib_i_gradient_color_2 );

    if ( !( $ib_i_gradient_angle = floatval( $ib_i_gradient_angle ) ) ) {
        $ib_i_gradient_angle = 45;
    }
    
    $internal_style[".$ib_unique_class .__icon i:before"][] = 'background-color: ' . $gradient_1;
    $internal_style[".$ib_unique_class .__icon i:before"][] = 'background-image: -webkit-linear-gradient(' . ( 90 - $ib_i_gradient_angle ) . 'deg, ' . $gradient_1 . ' 0%, ' . $gradient_2 . ' 100%)';
    $internal_style[".$ib_unique_class .__icon i:before"][] = 'background-image: linear-gradient(' . $ib_i_gradient_angle . 'deg, ' . $gradient_1 . ' 0%, ' . $gradient_2 . ' 100%)';
    $internal_style[".$ib_unique_class .__icon i:before"][] = '-webkit-background-clip: text';
    $internal_style[".$ib_unique_class .__icon i:before"][] = '-webkit-text-fill-color: transparent';
}

//var_dump($internal_style);
Floral_VC_Customize::add_custom_shortcode_css( $internal_style );

// ib link
$ib_link  = vc_build_link( $ib_link );
$a_href   = !empty( $ib_link['url'] ) ? $ib_link['url'] : '#';
$a_title  = !empty( $ib_link['title'] ) ? $ib_link['title'] : '';
$a_target = !empty( $ib_link['target'] ) ? $ib_link['target'] : '_self';

// icon
vc_icon_element_fonts_enqueue( $type );
$icon_ = !empty ( ${"icon_$type"} ) ? ${"icon_$type"} : '';


?>
<div class="floral-icon-box <?php floral_the_clean_html_classes( $class_icon_box ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <?php if ( !empty( $ib_i_align ) && $ib_i_align !== 'bottom' ) : ?>
        <div class="__header">
            <div class="__icon">
                <a title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>" href="<?php echo esc_url( $a_href ) ?>">
                    <?php if ( $type !== '' ) : ?>
                        <i class="<?php echo esc_attr( $icon_ ) ?>"></i>
                    <?php endif; ?>
                </a>
            </div>
            <?php if ( !empty( $ib_title ) ): ?>
                <h3 class="__title">
                    <a title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>" href="<?php echo esc_url( $a_href ) ?>"><?php echo esc_html( $ib_title ) ?></a>
                </h3>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ( ( $ib_i_align === 'bottom' ) && !empty( $ib_title ) ) : ?>
        <h3 class="__title">
            <?php echo esc_html( $ib_title ) ?>
        </h3>
    <?php endif; ?>


<!--    --><?php //if ( !empty( $ib_sub_title ) ): ?>
<!--        <span class="__sub-title">--><?php //echo esc_html( $ib_sub_title ) ?><!--</span>-->
<!--    --><?php //endif;

    if ( $ib_i_align === 'bottom' ) : ?>
        <div class="__icon">
            <?php if ( $type !== '' ) : ?>
                <i class="<?php echo esc_attr( $icon_ ) ?>"></i>
            <?php endif; ?>
        </div>
        <div class="__link">
            <a title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>" href="<?php echo esc_url( $a_href ) ?>"><?php echo esc_html( $a_title ) ?></a>
        </div>
    <?php endif;

    if ( !empty( $ib_description ) ):?>
        <p class="__text"><?php echo wp_kses_post( $ib_description ) ?></p>
    <?php endif; ?>
</div>