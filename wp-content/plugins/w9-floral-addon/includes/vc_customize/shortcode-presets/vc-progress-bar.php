<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: vc-progress-bar.php
 * @time    : 9/8/2016 12:04 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$presets_settings['vc_progress_bar'] = array(
    array(
        'name'     => __( 'Preset 1 (Text move, primary color)', 'w9-floral-addon' ),
        'default'  => false,
        'settings' => array (
            'layout_style' => 'style3',
            'title' => '',
            'values' => '%5B%7B%22label%22%3A%22Creative%20Design%22%2C%22value%22%3A%2285%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Photography%22%2C%22value%22%3A%2280%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Branding%20Design%22%2C%22value%22%3A%2290%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Illustration%22%2C%22value%22%3A%2282%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%5D',
            'units' => '%',
            'bgcolor' => 'p',
            'custom_barvalue_bgcolor_type' => 'normal',
            'custom_barvalue_bgcolor_normal' => '',
            'custom_barvalue_bgcolor_gradient_1' => '',
            'custom_barvalue_bgcolor_gradient_2' => '',
            'custom_bar_bgcolor' => '',
            'custom_txtcolor' => '',
            'custom_value_txtcolor' => '',
            'custom_value_bgcolor' => '',
            'options' => '',
            'el_class' => '',
            'css' => '',
            'tablet_css' => '',
            'mobile_css' => '',
        )
    ),
    array(
        'name'     => __( 'Preset 2 (Text move, light color)', 'w9-floral-addon' ),
        'default'  => false,
        'settings' => array (
            'layout_style' => 'style3',
            'title' => '',
            'values' => '%5B%7B%22label%22%3A%22Creative%20Design%22%2C%22value%22%3A%2285%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Photography%22%2C%22value%22%3A%2280%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Branding%20Design%22%2C%22value%22%3A%2290%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%2C%7B%22label%22%3A%22Illustration%22%2C%22value%22%3A%2282%22%2C%22custom_single_barvalue_bgcolor_type%22%3A%22normal%22%7D%5D',
            'units' => '%',
            'bgcolor' => 'custom',
            'custom_barvalue_bgcolor_type' => 'normal',
            'custom_barvalue_bgcolor_normal' => '#ffffff',
            'custom_barvalue_bgcolor_gradient_1' => '',
            'custom_barvalue_bgcolor_gradient_2' => '',
            'custom_bar_bgcolor' => 'rgba(255,255,255,0.4)',
            'custom_txtcolor' => '#ffffff',
            'custom_value_txtcolor' => '',
            'custom_value_bgcolor' => '',
            'options' => '',
            'el_class' => '',
            'css' => '',
            'tablet_css' => '',
            'mobile_css' => '',
        )
    ),
);