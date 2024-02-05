<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_portfolio_info.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Portfolio_Info
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * var $this Floral_SC_Portfolio_Info
 */
$info_list = $add_button = '';
$el_class  = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( Floral_SC_Portfolio_Info::SC_BASE, $atts );
extract( $atts );

$sc_classes = array(
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);

$inline_css       = array();
$info_list        = (array) vc_param_group_parse_atts( $info_list );
$info_string_list = array();
foreach ( $info_list as $info ) {
    $label_format = '<span class="__info-label">%s</span> ';
    $label        = isset( $info['info_label'] ) ? sprintf( $label_format, $info['info_label'] ) : '';
    
    if ( $info['info'] === 'categories' ) {
        $info_string_list[] = get_the_term_list( get_the_ID(), Floral_CPT_Portfolio::TAX_SLUG, $label, ", " );
    } elseif ( $info['info'] === 'date' ) {
        $info_string_list[] = $label . get_the_date();
    } elseif ( $info['info'] === 'client' ) {
        $portfolio_client_name = floral_get_meta_option( 'portfolio-client-name' );
        if ( !empty( $portfolio_client_name ) ) {
            $portfolio_client_url = floral_get_meta_option( 'portfolio-client-url' );
            if ( !empty( $portfolio_client_url ) ) {
                $portfolio_client_name = Floral_Wrap::link( $portfolio_client_name, $portfolio_client_url, array( 'target' => '_blank', 'title' => $portfolio_client_name ) );
            }
            $info_string_list[] = $label . $portfolio_client_name;
        }
    } elseif ( $info['info'] === 'addition-info' ) {
        $portfolio_addition_info = floral_get_meta_option( 'portfolio-addition-info' );
        if ( is_array( $portfolio_addition_info ) && !empty( $portfolio_addition_info ) ) {
            foreach ( $portfolio_addition_info as $additional_info ) {
                $content            = sprintf( $label_format, $additional_info['label'] ) . wp_kses_post( $additional_info['content'] );
                $info_string_list[] = $content;
            }
        }
    } elseif ( $info['info'] === 'share-this' ) {
        $info_string_list[] = $this->share_this();
    }
}


if ( $add_button === 'yes' ) {
    $button_atts             = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Button::SC_BASE, $atts );
    $url                     = urlencode( floral_get_meta_option( 'portfolio-project-url' ) );
    $target                  = urlencode( '_blank' );
    $button_atts['btn_link'] = sprintf( 'url:%s||target:%s|', $url, $target );
    $info_string_list[]      = Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Button::SC_BASE )->output( $button_atts );
}

//Print result

?>
<div class="floral-portfolio-info-wrapper <?php floral_the_clean_html_classes( $sc_classes ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ) ?>>
    <ul class="floral-portfolio-info-list list-unstyled">
        <?php
        foreach ( $info_string_list as $info_string ) {
            echo sprintf( '<li>%s</li>', $info_string );
        }
        ?>
    </ul>
</div>