<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-logo.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Logo extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_logo';
    
    public static function map() {
        return array(
            'name'           => __( 'Floral Logo', 'w9-floral-addon' ),
            'base'           => Floral_SC_Logo::SC_BASE,
            'class'          => '',
            'icon'           => 'w9 w9-ico-software-transform-bezier',
            'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
            'description'    => __('Get site logo (upload in theme option)', 'w9-floral-addon' ),
            'php_class_name' => 'Floral_SC_Logo',
            'params'         => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => __('Choose logo source', 'w9-floral-addon' ),
                    'param_name'  => 'logo_source',
                    'description' => 'Choose logo is defined in theme option or redefine <a href="' . admin_url( 'page=theme_options&tab=7' ) . '">here</a>.',
                    'value'       => array(
                        __( 'Logo', 'w9-floral-addon' )          => 'logo',
                        __( 'Logo Option 1', 'w9-floral-addon' ) => 'logo-option-1',
                        __( 'Logo Option 2', 'w9-floral-addon' ) => 'logo-option-2',
                        __( 'Logo Option 3', 'w9-floral-addon' ) => 'logo-option-3',
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Logo width', 'w9-floral-addon' ),
                    'description' => __( 'Define logo width in px , can fill number like 100, 200, 240 or auto.', 'w9-floral-addon' ),
                    'param_name' => 'logo_width',
                    'std' => 'auto',
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Logo height', 'w9-floral-addon' ),
                    'description' => __( 'Define logo width in px , can fill number like 100, 200, 240 or auto.', 'w9-floral-addon' ),
                    'param_name' => 'logo_height',
                    'std' => 'auto',
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Logo align', 'w9-floral-addon' ),
                    'description' => __( 'Define logo align left, right or center.', 'w9-floral-addon' ),
                    'param_name' => 'logo_align',
                    'std' => '__',
                    'value' => array(
                        __( 'Inherit From Text Align', 'w9-floral-addon' ) => '__',
                        __( 'Left', 'w9-floral-addon' )  => 'text-left',
                        __( 'Right ', 'w9-floral-addon' )  => 'text-right',
                        __( 'Center', 'w9-floral-addon' )  => 'text-center',
                    ),
                    'edit_field_class' => 'vc_col-sm-6'
                ),
                Floral_Map_Helpers::extra_class(),
                Floral_Map_Helpers::design_options(),
                Floral_Map_Helpers::animation_css(),
                Floral_Map_Helpers::animation_duration(),
                Floral_Map_Helpers::animation_delay(),
            )
        );
    }
}