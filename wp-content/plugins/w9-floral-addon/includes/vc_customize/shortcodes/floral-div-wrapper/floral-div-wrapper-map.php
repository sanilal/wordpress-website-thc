<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-div-wrapper-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'                      => __( 'Floral Div Wrapper', 'w9-floral-addon' ),
    'base'                      => Floral_SC_Div_Wrapper::SC_BASE,
    'class'                     => '',
    'icon'                      => 'w9 w9-ico-basic-webpage-img-txt',
    'category'                  => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'controls'                  => array(),
    'as_parent'                 => array( 'only' => Floral_SC_Div_Content::SC_BASE ),
    'show_settings_on_create'   => false,
    'content_element'         => true,
    'admin_enqueue_js'          => array( Floral_Addon::plugin_url() . 'assets/js/vc-custom.js' ),
    'js_view'                   => 'FloralBackendVcDivWrapperView',
    'description'               => __( 'Wrapper block of content, with some helper function', 'w9-floral-addon' ),
    'default_content'           => '[floral_shortcode_div_content][/floral_shortcode_div_content]',
    'php_class_name'            => 'Floral_SC_Div_Wrapper',
    'params'                    => array(
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Min height', 'w9-floral-addon' ),
            'param_name'       => 'min_height',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4 vc_column-with-padding',
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Height', 'w9-floral-addon' ),
            'param_name'       => 'height',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Max height', 'w9-floral-addon' ),
            'param_name'       => 'max_height',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Min width', 'w9-floral-addon' ),
            'param_name'       => 'min_width',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Width', 'w9-floral-addon' ),
            'param_name'       => 'width',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Max width', 'w9-floral-addon' ),
            'param_name'       => 'max_width',
            'value'            => '',
            'description'      => __( 'Value with unit like px, %, em, cm... eg:(100px).', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Horizontal Align', 'w9-floral-addon' ),
            'param_name'       => 'horizontal_align',
            'value'            => array(
                __( 'Default', 'w9-floral-addon' ) => 'floral-div-wrapper-align-default',
                __( 'Left', 'w9-floral-addon' ) => 'floral-div-wrapper-align-left',
                __( 'Right', 'w9-floral-addon' ) => 'floral-div-wrapper-align-right',
                __( 'Center', 'w9-floral-addon' ) => 'floral-div-wrapper-align-center',
            ),
//            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Fix ratio', 'w9-floral-addon' ),
            'param_name'       => 'fixed_ratio',
            'value'            => array_merge(
                array(__( 'None', 'w9-floral-addon' ) => 'none'),
                Floral_Image::get_floral_ratio_list()
            ),
            'description'      => __( 'Pick suitable ratio for div wrapper. Div wrapper can keep ratio only when all div inside is in overlay mode', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-12',
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Overflow', 'w9-floral-addon' ),
            'param_name'  => 'overflow',
            'value'       => array(
                __( 'Hidden', 'w9-floral-addon' )  => 'hidden',
                __( 'Visible', 'w9-floral-addon' ) => 'visible',
                __( 'Scroll', 'w9-floral-addon' )  => 'scroll',
                __( 'Auto', 'w9-floral-addon' )    => 'auto',
                __( 'Initial', 'w9-floral-addon' ) => 'initial',
                __( 'Inherit', 'w9-floral-addon' ) => 'inherit',
            ),
            'std'         => 'hidden',
            'description' => __( 'How div wrapper display content in its area.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Sticky enabled', 'w9-floral-addon' ),
            'param_name'  => 'sticky_enabled',
            'admin_label' => true,
            'value'       => '',
            'description' => __( 'Enabled sticky for this div.', 'w9-floral-addon' ),
        ),
        array(
            'type'             => 'number',
            'heading'          => __( 'Sticky start', 'w9-floral-addon' ),
            'param_name'       => 'sticky_start',
            'value'            => '',
            'dependency'       => array(
                'element' => 'sticky_enabled',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'suffix'           => __( 'px', 'w9-floral-addon' ),
        ),

        array(
            'type'             => 'number',
            'heading'          => __( 'Sticky stop', 'w9-floral-addon' ),
            'description'      => __( 'From bottom of page.', 'w9-floral-addon' ),
            'param_name'       => 'sticky_stop',
            'value'            => '',
            'dependency'       => array(
                'element' => 'sticky_enabled',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'suffix'           => __( 'px', 'w9-floral-addon' ),
        ),

        array(
            'type'             => 'number',
            'heading'          => __( 'Sticky z-index', 'w9-floral-addon' ),
            'param_name'       => 'sticky_z_index',
            'value'            => '',
            'std'              => '500',
            'dependency'       => array(
                'element' => 'sticky_enabled',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'description'      => __( 'Object with higher z-index appear above ones lower.', 'w9-floral-addon' ),
        ),

        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );