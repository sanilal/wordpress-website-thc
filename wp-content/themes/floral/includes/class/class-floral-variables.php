<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-variables.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Variables {
    private $variables;
    
    public function __construct() {
        $this->variables = array();
    }
    
    private function check_and_process_array( $varlist ) {
        foreach ( $varlist as $key => $val ) {
            if ( is_array( $val ) ) {
                foreach ( $val as $subkey => $value ) {
                    $varlist[$key . '-' . $subkey] = $value;
                }
                unset( $varlist[$key] );
            }
        }
        
        return $varlist;
    }
    
    public function get_variables() {
        $this->variables = array_merge(
            $this->get_general_vars(),
            $this->get_page_sidezone_variable(),
            $this->get_header_vars(),
            $this->get_page_title_vars(),
            $this->get_footer_vars()
        );
        
        return $this->check_and_process_array( $this->variables );
    }
    
    public function add_variable( $name, $value ) {
        $this->variables = array_merge( $this->variables, array( $name, $value ) );
    }
    
    public function remove_variable( $name ) {
        if ( isset( $this->variables[$name] ) ) {
            unset( $this->variables[$name] );
        }
    }
    
    public function get_page_sidezone_variable() {
        $page_sidezone_var                              = array();
        $page_sidezone_var['floral-page-leftzone-width']       = floral_get_option( 'page-leftzone-width', 'width', '300px' );
        $page_sidezone_var['floral-page-leftzone-breakpoint']  = floral_get_option( 'page-leftzone-breakpoint', 'width', '1500px' );
        $page_sidezone_var['floral-page-rightzone-width']      = floral_get_option( 'page-rightzone-width', 'width', '300px' );
        $page_sidezone_var['floral-page-rightzone-breakpoint'] = floral_get_option( 'page-rightzone-breakpoint', 'width', '1500px' );
        
        return $page_sidezone_var;
    }
    
    public function get_header_vars() {
        $header_vars                                        = array();
        $header_vars['floral-default-nav-item-color']              = floral_get_option( 'default-nav-item-color', 'regular', '#fff' );
        $header_vars['floral-default-nav-menu-item-padding-left']  = floral_get_option( 'default-nav-menu-item-padding', 'padding-left', '20px' );
        $header_vars['floral-default-nav-menu-item-padding-right'] = floral_get_option( 'default-nav-menu-item-padding', 'padding-right', '20px' );

//        // Header menu setting
//        $header_vars['floral-menu-item-color']          = floral_get_meta_or_option( 'menu-item-color', null, '#444' );
//        $header_vars['floral-menu-item-hover-bg-color'] = floral_get_meta_or_option( 'menu-item-hover-bg-color', null, 'transparent' );
//
//        // Sticky menu
//        $header_vars['floral-sticky-menu-item-color']          = floral_get_meta_or_option( 'sticky-menu-item-color', null, '#444' );
//        $header_vars['floral-sticky-menu-item-hover-bg-color'] = floral_get_meta_or_option( 'sticky-menu-item-hover-bg-color', null, 'transparent' );
        
        //Sub menu
        $floral_menu_sub_item_size_default = array(
            'width'  => '240px',
            'height' => '50px',
            'units'  => 'px'
        );
        
        $header_vars['floral-menu-sub-item-size']  = floral_get_meta_or_option( 'menu-sub-item-size', '', $floral_menu_sub_item_size_default );
        $header_vars['floral-menu-sub-item-color'] = floral_get_meta_or_option( 'menu-sub-item-color', '', 'transparent' );
//        $header_vars['floral-menu-sub-item-hover-bg-color'] = floral_get_meta_or_option( 'menu-sub-item-hover-bg-color', 'rgba', 'transparent' );
        
        //Mobile menu
        $header_vars['floral-header-nav-breakpoint']         = floral_get_meta_or_option( 'header-nav-breakpoint', 'width', '992px' );
        $header_vars['floral-mobile-menu-item-color'] = floral_get_meta_or_option( 'mobile-menu-item-color', 'regular', '#444' );
        
        return $header_vars;
    }
    
    public function get_page_title_vars() {
        $page_title_vars = array();
        // page title size
//        $header_vars['floral-page-title-padding-top']    = floral_get_meta_or_option( 'page-title-padding', 'padding-top', '120px', $template_prefix );
//        $header_vars['floral-page-title-padding-bottom'] = floral_get_meta_or_option( 'page-title-padding', 'padding-bottom', '120px', $template_prefix );
//        $header_vars['floral-page-title-margin-bottom']  = floral_get_meta_or_option( 'page-title-margin-bottom', 'margin-bottom', '80px', $template_prefix );
        // Page title style
        $template_prefix = floral_get_template_prefix();
        // page title style
        $meta             = true;
        $page_title_style = floral_get_meta_option( 'page-title-style' );
        if ( floral_is_meta_default_value( $page_title_style ) ) {
            $meta             = false;
            $page_title_style = floral_get_option( 'page-title-style', '', 'bg-gray-lighter', $template_prefix );
        }
        switch ( $page_title_style ) {
            case 'bg-gray-lighter':
                $page_title_text_color = '#444';
                $page_title_bg_color   = '#eeeeee';
                break;
            case 'bg-gray':
                $page_title_text_color = '#222';
                $page_title_bg_color   = '#999';
                break;
            case 'bg-dark-lighter':
                $page_title_text_color = '#fff';
                $page_title_bg_color   = '#444';
                break;
            case 'bg-dark':
                $page_title_text_color = '#fff';
                $page_title_bg_color   = '#000';
                break;
            case 'bg-white':
                $page_title_text_color = '#222';
                $page_title_bg_color   = '#fff';
                break;
            case 'bg-dark-alpha-30':
                $page_title_text_color = '#fff';
                $page_title_bg_color   = 'rgba(0, 0, 0, 0.3)';
                break;
            case 'bg-dark-alpha-50':
                $page_title_text_color = '#fff';
                $page_title_bg_color   = 'rgba(0, 0, 0, 0.5)';
                break;
            case 'bg-dark-alpha-70':
                $page_title_text_color = '#fff';
                $page_title_bg_color   = 'rgba(0, 0, 0, 0.7)';
                break;
            case 'bg-light-alpha-30':
                $page_title_text_color = '#444';
                $page_title_bg_color   = 'rgba(255, 255, 255, 0.3)';
                break;
            case 'bg-light-alpha-50':
                $page_title_text_color = '#444';
                $page_title_bg_color   = 'rgba(255, 255, 255, 0.5)';
                break;
            case 'bg-light-alpha-70':
                $page_title_text_color = '#444';
                $page_title_bg_color   = 'rgba(255, 255, 255, 0.7)';
                break;
            case 'bg-custom':
                if ( $meta ) {
                    $page_title_text_color = floral_get_meta_option( 'page-title-text-color', '', '', '#444' );
                    $page_title_bg_color   = floral_get_meta_option( 'page-title-bg-color', '', 'rgba', '#f6f6f6' );
                } else {
                    $page_title_text_color = floral_get_option( 'page-title-text-color', '', '#444', $template_prefix );
                    $page_title_bg_color   = floral_get_option( 'page-title-bg-color', 'rgba', '#f6f6f6', $template_prefix );
                }
                break;
            default:
                $page_title_text_color = '#444';
                $page_title_bg_color   = '#f6f6f6';
        }
        
        $page_title_vars['floral-page-title-text-color'] = $page_title_text_color;
        $page_title_vars['floral-page-title-bg-color']   = $page_title_bg_color;
        
        return $page_title_vars;
    }
    
    public function get_footer_vars() {
        $footer_vars = array();
        // footer colors
        $footer_colors   = floral_get_meta_option( 'footer-colors', '', 'dark' );
        $meta            = true;
        $template_prefix = floral_get_template_prefix();
        
        if ( empty( $footer_colors ) ) {
            $footer_colors = floral_get_option( 'footer-colors', '', 'dark', $template_prefix );
            $meta          = false;
        }
        switch ( $footer_colors ) {
            case 'gray':
                $footer_vars['floral-footer-background-color']   = '#222';
                $footer_vars['floral-footer-text-color']         = '#888';
                $footer_vars['floral-footer-heading-text-color'] = '#fff';
                $footer_vars['floral-footer-link-color']         = '#fff';
                $footer_vars['floral-footer-link-hover-color']   = '#fff';
                break;
            case 'dark':
                $footer_vars['floral-footer-background-color']   = '#000';
                $footer_vars['floral-footer-text-color']         = '#888';
                $footer_vars['floral-footer-heading-text-color'] = '#fff';
                $footer_vars['floral-footer-link-color']         = '#fff';
                $footer_vars['floral-footer-link-hover-color']   = '#fff';
                break;
            case 'light':
                $footer_vars['floral-footer-background-color']   = '#fff';
                $footer_vars['floral-footer-text-color']         = '#888';
                $footer_vars['floral-footer-heading-text-color'] = '#000';
                $footer_vars['floral-footer-link-color']         = '#000';
                $footer_vars['floral-footer-link-hover-color']   = '#000';
                break;
            case 'custom':
                if ( $meta ) {
                    $footer_vars['floral-footer-background-color']   = floral_get_meta_option( 'footer-background-color', '', 'rgba', 'rgba(0, 0, 0, 1)' );
                    $footer_vars['floral-footer-text-color']         = floral_get_meta_option( 'footer-text-color', '', '', '#868686' );
                    $footer_vars['floral-footer-heading-text-color'] = floral_get_meta_option( 'footer-heading-text-color', '', '', '#fff' );
                    $footer_vars['floral-footer-link-color']         = floral_get_meta_option( 'footer-link-color', '', '', '#868686' );
                    $footer_vars['floral-footer-link-hover-color']   = floral_get_meta_option( 'footer-link-hover-color', '', '', '#fff' );
                } else {
                    $footer_vars['floral-footer-background-color']   = floral_get_option( 'footer-background-color', 'rgba', 'rgba(0, 0, 0, 1)', $template_prefix );
                    $footer_vars['floral-footer-text-color']         = floral_get_option( 'footer-text-color', '', '#868686', $template_prefix );
                    $footer_vars['floral-footer-heading-text-color'] = floral_get_option( 'footer-heading-text-color', '', '#fff', $template_prefix );
                    $footer_vars['floral-footer-link-color']         = floral_get_option( 'footer-link-color', '', '#868686', $template_prefix );
                    $footer_vars['floral-footer-link-hover-color']   = floral_get_option( 'footer-link-hover-color', '', '#fff', $template_prefix );
                }
                break;
            default:
                $footer_vars['floral-footer-background-color']   = '#222';
                $footer_vars['floral-footer-text-color']         = '#888';
                $footer_vars['floral-footer-heading-text-color'] = '#fff';
                $footer_vars['floral-footer-link-color']         = '#fff';
                $footer_vars['floral-footer-link-hover-color']   = '#fff';
        }
        
        return $footer_vars;
    }
    
    public function get_general_vars() {
        $general_vars = array();
        //timing
        $general_vars['floral-transition-time']     = '0.3s';
        $general_vars['floral-transition-longtime'] = '0.6s';
        $general_vars['floral-theme-url']           = '"' . floral_theme_url() . '"';
        // base colors
        $general_vars['floral-primary-color']   = floral_get_option( 'primary-color', '', '#FFBF00' );
        $general_vars['floral-secondary-color'] = floral_get_option( 'secondary-color', '', '#8C008C' );
//        $general_vars['floral-dark-color']      = floral_get_option( 'dark-color', '', '#222' );
//        $general_vars['floral-light-color']     = floral_get_option( 'light-color', '', '#fff' );
        $general_vars['floral-text-color']      = floral_get_option( 'text-color', '', '#444' );
        $general_vars['floral-meta-text-color'] = floral_get_option( 'meta-text-color', '', '#666' );
        $general_vars['floral-border-color']    = floral_get_option( 'border-color', 'rgba', 'rgba(128, 128, 128, 0.2)' );
        // base font family
        $general_vars['floral-primary-font']   = floral_get_option( 'primary-font', 'font-family', "'Raleway'" );
        $general_vars['floral-secondary-font'] = floral_get_option( 'secondary-font', 'font-family', "'Montserrat'" );
        $general_vars['floral-third-font'] = floral_get_option( 'third-font', 'font-family', "'Playfair Display'" );
        // page margin bottom
        
        /*-------------------------------------
        	CART ICON CONTENT
        ---------------------------------------*/
//        switch ( floral_get_option( 'shop-cart-icon' ) ) {
//            case 'w9 w9-ico-shopper29':
//                $cart_icon = '"\7e"';
//                break;
//            case 'w9 w9-ico-shopping111':
//                $cart_icon = '"\5c"';
//                break;
//            case 'w9 w9-ico-basket-1':
//                $cart_icon = '"\e029"';
//                break;
//            case 'w9 w9-ico-svg-icon-02':
//                $cart_icon = '"\39"';
//                break;
//            case 'w9 w9-ico-svg-icon-16':
//                $cart_icon = '"\e140"';
//                break;
//            default:
//                $cart_icon = '"\7e"';
//        }
//        $general_vars['floral-shop-cart-icon-content'] = $cart_icon;
        $general_vars['floral-input-style']            = floral_get_option( 'input-style', '', "normal" );
        /*-------------------------------------
        	MOST USED COLORS
        ---------------------------------------*/
        $most_used_colors = floral_get_most_used_colors( 'key_color' );
        $__map            = array();
        if ( !empty( $most_used_colors ) && is_array( $most_used_colors ) ) {
            foreach ( $most_used_colors as $key => $color ) {
                if ( empty( $color ) ) {
                    continue;
                }
                
                $__map[] = sprintf( '%s: %s', $key, $color );
            }
        }
        $general_vars['floral-most-used-colors'] = sprintf( '(%s)', implode( ',', $__map ) );
        
        
        return $general_vars;
    }
}