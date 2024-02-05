<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-slider-container.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Slider_Container extends WPBakeryShortCodesContainer {
    const SC_BASE = 'floral_shortcode_slider_container';
}


if ( !function_exists( 'floral_sc_slider_container' ) ) {
    function floral_sc_slider_container( $content, array $attr = array() ) {
        $var = '';
        foreach ( $attr as $key => $value ) {
            $var .= sprintf( ' %s="%s"', $key, $value );
        }
        
        echo do_shortcode( "[floral_shortcode_slider_container $var]" . $content . "[/floral_shortcode_slider_container]" );
    }
}