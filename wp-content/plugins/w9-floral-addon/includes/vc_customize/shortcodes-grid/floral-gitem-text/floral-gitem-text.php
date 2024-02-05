<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-text.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Gitem_Text extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_gitem_text';
    
    public function __construct( $settings ) {
        parent::__construct( $settings );
        add_filter( 'vc_gitem_template_attribute_floral_gitem_text', array( $this, 'floral_gitem_text' ), 10, 2 );
    }
    
    public function floral_gitem_text( $value, $data ) {
        /**
         * @var null|Wp_Post $post ;
         * @var string       $data ;
         */
        extract( array_merge( array(
            'post' => null,
            'data' => '',
        ), $data ) );
        $atts = array();
        parse_str( $data, $atts );
        
        $text_display    = '';
        $label_type      = '';
        $label_meta_list = '';
        $label_meta_key  = '';
        $label_static    = '';
        $text_type       = '';
        $text_meta_list  = '';
        $text_meta_key   = '';
        $text_static     = '';
        $url_type        = '';
        $url_meta_list   = '';
        $url_meta_key    = '';
        $url_static      = '';
        $el_class        = '';
        $css             = '';
        
        
        extract( $atts );
        
        $sc_classes = array(
            $el_class,
            vc_shortcode_custom_css_class( $css ),
        );
        
        if ( $text_display == 'inline' ) {
            $sc_classes[] = 'inline-block-el';
        }
        
        if ( $label_type == 'static' ) {
            $label = $label_static;
        } elseif ( $label_type == 'meta_list' ) {
            $label = get_post_meta( $post->ID, $label_meta_list, true );
        } elseif ( $label_type == 'meta_key' ) {
            $label = get_post_meta( $post->ID, $label_meta_key, true );
        }
        
        $label = ( isset( $label ) && is_string($label) ) ? sprintf( '<span class="__label fw-semibold">%s</span>', $label ) : '';
        
        if ( $text_type == 'static' ) {
            $text = $text_static;
        } elseif ( $text_type == 'meta_list' ) {
            $text = get_post_meta( $post->ID, $text_meta_list, true );
        } elseif ( $text_type == 'meta_key' ) {
            $text = get_post_meta( $post->ID, $text_meta_key, true );
        }
        
        if ( $url_type == 'static' ) {
            $url = $url_static;
        } elseif ( $url_type == 'meta_list' ) {
            $url = get_post_meta( $post->ID, $url_meta_list, true );
        } elseif ( $url_type == 'meta_key' ) {
            $url = get_post_meta( $post->ID, $url_meta_key, true );
        }
        
        if ( isset( $url ) ) {
            $url = esc_url( $url );
            if ( isset( $text ) && !empty( $url ) ) {
                $text = Floral_Wrap::link( $text, $url, array( 'title' => $text ) );
            }
        }
        
        $text = ( isset( $text ) && is_string($text) ) ? sprintf( '<span class="__text">%s</span>', $text ) : '';
        
        return '<div class="floral-gitem-text ' . floral_clean_html_classes( $sc_classes ) . '">' . $label . ' ' . $text . '</div>';
    }
    
}



