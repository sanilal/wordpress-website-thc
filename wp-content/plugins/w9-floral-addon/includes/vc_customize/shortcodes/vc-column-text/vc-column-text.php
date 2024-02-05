<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-column-text.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'          => __( 'Text Block', 'w9-floral-addon' ),
    'icon'          => 'w9 w9-ico-basic-webpage-txt',
    'base'          => 'vc_column_text',
    'wrapper_class' => 'clearfix',
    'category'      => __( 'Content', 'w9-floral-addon' ),
    'description'   => __( 'A block of text with WYSIWYG editor', 'w9-floral-addon' ),
    'params'        => array(
        array(
            'type'       => 'textarea_html',
            'holder'     => 'div',
            'heading'    => __( 'Text', 'w9-floral-addon' ),
            'param_name' => 'content',
            'value'      => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'switcher',
            'param_name' => 'custom_list_style',
            'heading'    => __( 'Custom list style', 'w9-floral-addon' ),
            'std'        => '0'
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'unorder_list_style_type',
            'heading'    => __( 'Un-order list style type', 'w9-floral-addon' ),
            'value'      => array(
                __( 'Default (Disc)', 'w9-floral-addon' )         => 'disc',
                __( 'Circle', 'w9-floral-addon' )                 => 'circle',
                __( 'Square', 'w9-floral-addon' )                 => 'square',
                __( 'Dash', 'w9-floral-addon' )                   => 'dash',
                __( 'Number Order In Circle', 'w9-floral-addon' ) => 'number-order-in-circle'
            ),
            'dependency' => array(
                'element' => 'custom_list_style',
                'value'   => array( '1' )
            )
        ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'List style color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'list_style_color',
            'value'              => array_merge( array( __( 'Default CSS', 'w9-floral-addon' ) => '' ), Floral_Map_Helpers::get_just_colors() ),
            'description'        => esc_html__( 'Select color for text display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
            'std'                => '',
            'dependency'         => array(
                'element' => 'custom_list_style',
                'value'   => array( '1' )
            )
        ),
        Floral_Map_Helpers::extra_class(),
        /*-------------------------------------
            DESIGN OPTIONS
        ---------------------------------------*/
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile(),
        /*-------------------------------------
            ANIMATIONS
        ---------------------------------------*/
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay(),
    ),
) );
