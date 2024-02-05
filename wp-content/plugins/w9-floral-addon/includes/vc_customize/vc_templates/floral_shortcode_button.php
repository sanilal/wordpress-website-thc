<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_button.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $atts
 * @var $this Floral_SC_Button
 */

$btn_text = $btn_link = $btn_ff = $btn_style = $btn_shape = $btn_size = $btn_custom_size = $btn_custom_padding_lr = $btn_custom_width = $btn_alignment =
$btn_add_icon = $btn_icon_align = $type = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial =
$btn_icon_effect = $btn_text_moving = $btn_icon_size = $btn_text_color = $btn_text_custom_color = $btn_bgc = $btn_bgc_custom_color =
$btn_bgc_gradient_1 = $btn_bgc_gradient_2 = $btn_bgc_gradient_angle = $btn_border_color = $btn_border_custom_color =
$btn_text_hover_color = $btn_text_hover_custom_color = $btn_bgc_hover_color = $btn_bgc_hover_custom_color =
$btn_border_hover_color = $btn_border_hover_custom_color = $btn_box_shadow_color = $btn_box_shadow_custom_color = $btn_hover_effect = $btn_down_effect = $btn_opacity_effect =
$btn_custom_onclick = $btn_content_template_popup = $btn_sidebar_popup = $btn_custom_onclick_code = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

extract( $atts );

// Button Wrapper
$css                  = vc_shortcode_custom_css_class( $css );
$class_button_wrapper = array(
    $css,
    $btn_alignment,
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    $btn_text_color . '-link-color',
    $btn_text_hover_color . '-link-hover-color',
);
$internal_style       = array();
$btn_unique_class     = uniqid( 'floral-btn-' );

// Button
$class_button = array(
    $btn_unique_class,
    $btn_ff,
    $btn_style,
    $btn_shape,
    $btn_size,
    $btn_icon_effect,
    $btn_hover_effect,
    $btn_bgc . '-bgc',
);

// custom color style
if ( $btn_text_color === 'custom' && !empty( $btn_text_custom_color ) ) {
//    $internal_style[".$btn_unique_class"][] = 'color: ' . $btn_text_custom_color . '!important';
    $internal_style[".$btn_unique_class"][] = 'color: ' . $btn_text_custom_color;
}

// custom background color
if ( $btn_bgc === 'custom' && !empty( $btn_bgc_custom_color ) ) {
//    $internal_style[".$btn_unique_class:after"][] = 'background-color: ' . $btn_bgc_custom_color. '!important';
    $internal_style[".$btn_unique_class:after"][] = 'background-color: ' . $btn_bgc_custom_color;
} elseif ( $btn_bgc === 'gradient' ) {
    $color_1 = Floral_Map_Helpers::get_color_value( $btn_bgc_gradient_1 );
    $color_2 = Floral_Map_Helpers::get_color_value( $btn_bgc_gradient_2 );
    //$btn_bgc_gradient_angle
    if ( !( $btn_bgc_gradient_angle = floatval( $btn_bgc_gradient_angle ) ) ) {
        $btn_bgc_gradient_angle = 45;
    }

    $internal_style[".$btn_unique_class:before"][] = 'border: none';
    $internal_style[".$btn_unique_class:before"][] = 'background-color: ' . $color_1;
    $internal_style[".$btn_unique_class:before"][] = 'background-image: -webkit-linear-gradient(' . ( 90 - $btn_bgc_gradient_angle ) . 'deg, ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
    $internal_style[".$btn_unique_class:before"][] = 'background-image: linear-gradient(' . $btn_bgc_gradient_angle . 'deg, ' . $color_1 . ' 0%, ' . $color_2 . ' 100%)';
}

if ( $btn_style === 'btn-style-border-1' || $btn_style === 'btn-style-border-2' ) {
    $class_button[] = $btn_border_color . '-border-color';
    $class_button[] = $btn_border_hover_color . '-hover-border-color';
    
    // custom border color
    if ( $btn_border_color === 'custom' && !empty( $btn_border_custom_color ) ) {
//        $internal_style[".$btn_unique_class"][] = 'border-color: ' . $btn_border_custom_color . ' !important';
        $internal_style[".$btn_unique_class"][] = 'border-color: ' . $btn_border_custom_color;
    }
    
    // custom border hover color
    if ( $btn_border_hover_color === 'custom' && !empty( $btn_border_hover_custom_color ) ) {
//        $internal_style[".$btn_unique_class:hover"][] = 'border-color: ' . $btn_border_hover_custom_color . ' !important';
        $internal_style[".$btn_unique_class:hover"][] = 'border-color: ' . $btn_border_hover_custom_color;
    }
}

// box-shadow
if ( $btn_style === 'btn-style-3d' ) {
    $class_button[] = $btn_box_shadow_color . '-box-shadow';
    
    if ( $btn_box_shadow_color === 'custom' && !empty( $btn_box_shadow_custom_color ) ) {
        $internal_style[".$btn_unique_class"][] = '-webkit-box-shadow: 0 6px ' . $btn_box_shadow_custom_color;
        $internal_style[".$btn_unique_class"][] = '-moz-box-shadow: 0 6px ' . $btn_box_shadow_custom_color;
        $internal_style[".$btn_unique_class"][] = 'box-shadow: 0 6px ' . $btn_box_shadow_custom_color;
    }
    
    if ( $btn_box_shadow_color === 'bolder' || $btn_box_shadow_color === 'lighter' ) {
        $class_button[] = $btn_bgc . '-box-shadow-' . $btn_box_shadow_color;
        if ( $btn_bgc === 'custom' && !empty( $btn_bgc_custom_color ) ) {
            $_adjusted = Floral_Map_Helpers::adjust_color( $btn_bgc_custom_color, $btn_box_shadow_color );
            if ( $_adjusted ) {
                $internal_style[".$btn_unique_class"][] = '-webkit-box-shadow: 0 6px ' . $_adjusted;
                $internal_style[".$btn_unique_class"][] = '-moz-box-shadow: 0 6px ' . $_adjusted;
                $internal_style[".$btn_unique_class"][] = 'box-shadow: 0 6px ' . $_adjusted;
            }
        }
    }
} else {
    
    // text hover color
    if ( $btn_text_hover_color === 'custom' && !empty( $btn_text_hover_custom_color ) ) {
//        $internal_style[".$btn_unique_class:hover"][] = 'color: ' . $btn_text_hover_custom_color. '!important';
        $internal_style[".$btn_unique_class:hover"][] = 'color: ' . $btn_text_hover_custom_color;
    }
    
    // bgc hover bolder or lighter
    if ( $btn_bgc_hover_color === 'bolder' || $btn_bgc_hover_color === 'lighter' ) {
        $class_button[] = $btn_bgc . '-hover-button-bgc-' . $btn_bgc_hover_color;
        if ( $btn_bgc === 'custom' && !empty( $btn_bgc_custom_color ) ) {
            $_adjusted = Floral_Map_Helpers::adjust_color( $btn_bgc_custom_color, $btn_bgc_hover_color );
            if ( $_adjusted ) {
//                $internal_style[".$btn_unique_class:hover"][] = 'background-color: ' . $_adjusted. '!important';
                $internal_style[".$btn_unique_class:hover"][] = 'background-color: ' . $_adjusted;
            }
        }
    } else {
        $class_button[] = $btn_bgc_hover_color . '-hover-button-bgc';
        
        if ( $btn_bgc_hover_color === 'custom' && !empty( $btn_bgc_hover_custom_color ) ) {
//            $internal_style[".$btn_unique_class:hover:after"][] = 'background-color: ' . $btn_bgc_hover_custom_color. '!important';
            $internal_style[".$btn_unique_class:hover:after"][] = 'background-color: ' . $btn_bgc_hover_custom_color;
        }
    }
}


/*-------------------------------------
	CUSTOM BUTTON SIZE
---------------------------------------*/
$text_size = '';
if ( !empty( $btn_custom_size ) ) {
    $internal_style[".$btn_unique_class"][] = 'font-size: ' . $btn_custom_size . ' !important';
	$text_size = 'font-size: ' . $btn_custom_size;
}

if ( !empty( $btn_custom_padding_lr ) ) {
    $internal_style[".$btn_unique_class"][] = 'padding-left: ' . $btn_custom_padding_lr . ' !important';
    $internal_style[".$btn_unique_class"][] = 'padding-right: ' . $btn_custom_padding_lr . ' !important';
}


// button custom width
if ( !empty( $btn_custom_width ) ) {
    $internal_style[".$btn_unique_class"][] = 'width: ' . $btn_custom_width . ' !important';
}

//Link
$btn_link = vc_build_link( $btn_link );
$a_href   = !empty( $btn_link['url'] ) ? $btn_link['url'] : '#';
$a_title  = !empty( $btn_link['title'] ) ? $btn_link['title'] : '';
$a_target = !empty( $btn_link['target'] ) ? $btn_link['target'] : '_self';

/*-------------------------------------
	BUTTON ICON
---------------------------------------*/
$icon_ = '';
if ( $btn_add_icon == '1' ) {
    $class_button[] = $btn_icon_align;
    vc_icon_element_fonts_enqueue( $type );
    $icon_ = isset( ${"icon_$type"} ) ? ${"icon_$type"} : '';
    
    // icon size
    $btn_icon_size = intval( str_replace( '%', '', $btn_icon_size ) );
    
    $class_button[] = 'btn-scale-' . $btn_icon_size;
}

// on click action, etc: console.log('hello world');
$_on_click_code = '';
if ( $btn_custom_onclick === 'custom' ) {
    $_on_click_code = sprintf( 'onclick="%s"', $btn_custom_onclick_code );
} elseif ( $btn_custom_onclick === 'toggle-pagezone-left' ) {
    $_on_click_code = sprintf( 'onclick="%s"', 'floral.page.page_leftzone();' );
} elseif ( $btn_custom_onclick === 'toggle-pagezone-right' ) {
    $_on_click_code = sprintf( 'onclick="%s"', 'floral.page.page_rightzone();' );
} elseif ( $btn_custom_onclick === 'popup-search' ) {
    $_on_click_code = sprintf( 'onclick="%s"', 'floral.page.popup(\'floral-search\', \'popup\');' );
} elseif ( $btn_custom_onclick === 'popup-sidebar' ) {
    //Add to popup list
    $popup    = array(
        'type'    => 'sidebar',
        'content' => $btn_sidebar_popup
    );
    $popup_id = floral_add_popup_item( $popup );
    // Render onclick action
    $_on_click_code = sprintf( 'onclick="floral.page.popup(\'%s\', \'%s\')"', $popup['type'], $popup['content'] );
} elseif ( $btn_custom_onclick === 'popup-content-template' ) {
    //Add to popup list
    $popup    = array(
        'type'    => 'content-template',
        'content' => $btn_content_template_popup,
    );
    $popup_id = floral_add_popup_item( $popup );
    // Render onclick action
    $_on_click_code = sprintf( 'onclick="floral.page.popup(\'%s\', \'%s\')"', $popup['type'], $popup['content'] );
}

/*-------------------------------------
	BUTTON ON FOCUS EFFECT
---------------------------------------*/
if ( $btn_down_effect === 'yes' ) {
    $class_button[] = 'btn-down-effect';
}

if ( !empty( $btn_opacity_effect ) && $btn_opacity_effect != '1' ) {
    $internal_style[".$btn_unique_class:active"][] = 'opacity: ' . $btn_opacity_effect . ' !important';
}

Floral_VC_Customize::add_custom_shortcode_css( $internal_style );
?>
<div class="floral-button-wrapper <?php floral_the_clean_html_classes( $class_button_wrapper ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <a class="floral-btn <?php floral_the_clean_html_classes( $class_button ); ?>"
       href="<?php echo esc_url( $a_href ) ?>"
       title="<?php echo esc_attr( $a_title ); ?>"
        <?php echo !empty( $_on_click_code ) ? $_on_click_code : ''; ?>
       target="<?php echo esc_attr( $a_target ); ?>">
        <?php if ( !empty( $icon_ ) && $btn_icon_align == 'align-icon-left' ): ?>
            <i class="<?php echo esc_attr( $icon_ ); ?>"></i>
        <?php endif; ?>
        <?php if ( !empty( $btn_text ) ): ?>
			<span <?php
	        echo  Floral_Map_Helpers::get_inline_style( $text_size );
	        ?>><?php echo esc_html( $btn_text ); ?></span>
        <?php endif; ?>
        <?php if ( !empty( $icon_ ) && $btn_icon_align == 'align-icon-right' ): ?>
            <i class="<?php echo esc_attr( $icon_ ); ?>"></i>
        <?php endif; ?>
    </a>
</div>
