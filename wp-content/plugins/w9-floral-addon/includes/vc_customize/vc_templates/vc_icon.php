<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_icon.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $color
 * @var $custom_color
 * @var $background_style
 * @var $background_color
 * @var $custom_background_color
 * @var $size
 * @var $align
 * @var $el_class
 * @var $link
 * @var $css_animation
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Icon
 */
$type = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons =
$icon_entypo = $icon_linecons = $icon_monosocial = $color = $custom_color = $background_style =
$background_color = $custom_background_color = $size = $custom_size = $align = $link = $onclick = $image = $video_link =
$gradient_color_1 = $gradient_color_2 = $gradient_angle = $bg_gradient_color_1 = $bg_gradient_color_2 = $bg_gradient_angle =
$el_class = $css = $animation_css = $animation_duration = $animation_delay = $tablet_css = $mobile_css = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$uni_class     = uniqid( 'vc_icon-' );
$class_wrapper = array(
    $uni_class,
    $this->getExtraClass( $el_class ),
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    'vc_icon_element-align-' . $align
);

$class_inner = array(
    $color . '-color',
    'vc_icon_element-size-' . $size
);


if ( strlen( $background_style ) > 0 ) {
    $class_wrapper[] = 'vc_icon_element-have-style';
    $class_inner[]   = 'vc_icon_element-style-' . $background_style;
    $class_inner[]   = 'vc_icon_element-have-style-inner';
    
    
    if ( false !== strpos( $background_style, 'outline' ) ) {
        $background_style .= ' vc_icon_element-outline'; // if we use outline style it is border in css
    } else {
        $background_style .= ' vc_icon_element-background';
    }
}


$style = array();
$icon_style_inline = array();
if ( false !== strpos( $background_style, 'outline' ) ) {
    if ( 'custom' === $background_color ) {
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner"][] = 'border-color:' . $custom_background_color;
    } else {
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner"][] = 'border-color:' . Floral_Map_Helpers::get_color_value( $background_color );
    }
} else {
    if ( 'custom' === $background_color ) {
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner"][] = 'background-color:' . $custom_background_color;
    } else {
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner"][] = 'background-color:' . Floral_Map_Helpers::get_color_value( $background_color );
    }
}
if ( 'custom' === $size ) {
    $custom_size = floatval( $custom_size );
    if ( !empty( $custom_size ) ) {
        $icon_style_inline[]            = 'font-size: ' . $custom_size . 'px';
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-have-style-inner"][] = 'width: ' . $custom_size * 1.5 . 'px !important';
        $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-have-style-inner"][] = 'height: ' . $custom_size * 1.5 . 'px !important';
    }
}

if ( 'custom' === $color ) {
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon"][] = 'color: ' . esc_attr( $custom_color ) . ' !important';
} elseif ( 'gradient' === $color ) {
    $color_1 = Floral_Map_Helpers::get_color_value( $gradient_color_1 );
    $color_2 = Floral_Map_Helpers::get_color_value( $gradient_color_2 );
    
    if ( !( $gradient_angle = floatval( $gradient_angle ) ) ) {
        $gradient_angle = 45;
    }
    
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon:before"][] = 'background-color: ' . $color_1;
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon:before"][] = 'background-image: -webkit-linear-gradient(' . ( 90 - $gradient_angle ) . 'deg, ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon:before"][] = 'background-image: linear-gradient(' . $gradient_angle . 'deg, ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon:before"][] = '-webkit-background-clip: text';
    $style[".$uni_class.vc_icon_element-outer .vc_icon_element-inner .vc_icon_element-icon:before"][] = '-webkit-text-fill-color: transparent';
}

Floral_VC_Customize::add_custom_shortcode_css( $style );

/*-------------------------------------
	ON LICK ACTION
---------------------------------------*/
$_link_markup = '';
if ( $onclick === 'custom-link' ) {
    $url = vc_build_link( $link );
    if ( !empty( $url['url'] ) ) {
        $attr = array('class' => 'vc_icon_element-link');
        if ( !empty( $url['title'] ) ) {
            $attr['title'] = esc_attr( $url['title'] );
        }

        if ( !empty( $url['rel'] ) ) {
            $attr['rel'] = esc_attr( $url['rel'] );
        }

        if ( !empty( $url['target'] ) ) {
            $attr['target'] = esc_attr( $url['target'] );
        }

        $_link_markup = Floral_Wrap::link( '', $url['url'], $attr );
    }
}elseif ( $onclick === 'popup-search' ) {
//    $_link_markup = sprintf( 'onclick="%s"', 'floral.page.popup(\'floral-search\', \'popup\');' );
    $_link_markup = Floral_Wrap::link( '', '#', array( 'onclick' => 'floral.page.popup(\'floral-search\', \'popup\');', 'class' => 'vc_icon_element-link' ) );
} elseif ( $onclick === 'popup-image' ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );

    if ( !empty( $image ) ) {
        $img_src = wp_get_attachment_image_src( $image, 'full' );
        if ( $img_src && isset( $img_src[0] ) ) {
            $_link_markup = Floral_Wrap::link( '', $img_src[0], array( 'data-rel' => 'prettyPhoto', 'class' => 'vc_icon_element-link prettyPhoto' ) );
        }
    }
} elseif ( $onclick === 'popup-video' ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );

    if ( !empty( $video_link ) ) {
        $_link_markup = Floral_Wrap::link( '', $video_link, array( 'data-rel' => 'prettyPhoto', 'class' => 'vc_icon_element-link prettyPhoto', 'data-width' => 1000, 'data-height' => ( 1000 * 9 / 16 ) ) );
    }
}

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$_icon = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'fa fa-adjust';
?>
<div class="vc_icon_element vc_icon_element-outer <?php floral_the_clean_html_classes( $class_wrapper ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <div class="vc_icon_element-inner <?php floral_the_clean_html_classes( $class_inner ); ?>">
        <span class="vc_icon_element-icon floral-inline-icon <?php echo sprintf( '%s', $_icon ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $icon_style_inline ); ?>></span>
        <?php echo !empty( $_link_markup ) ? $_link_markup : ''; ?>
    </div>
</div>
