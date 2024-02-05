<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-div-content-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'                    => esc_html__( 'Floral Div Content', 'w9-floral-addon' ),
    'base'                    => Floral_SC_Div_Content::SC_BASE,
    'class'                   => '',
    'icon'                    => 'w9 w9-ico-basic-webpage-img-txt',
    'category'                => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'show_settings_on_create' => false,
    'controls'                => 'full',
    'as_child'                => array( 'only' => Floral_SC_Div_Wrapper::SC_BASE ),
    'is_container'            => true,
    'description'             => __( 'Content block of div wrapper', 'w9-floral-addon' ),
    'custom_markup'           => '',
    'admin_enqueue_js'        => array( Floral_Addon::plugin_url() . 'assets/js/vc-custom.js' ),
    'js_view'                 => 'FloralBackendVcDivContentView',
    'php_class_name'          => 'Floral_SC_Div_Content',
    'params'                  => array(
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Top position value', 'w9-floral-addon' ),
            'param_name'       => 'p_top',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6 vc_column-with-padding',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' )
        ),
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Bottom position value', 'w9-floral-addon' ),
            'param_name'       => 'p_bottom',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' )
        ),
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Left position value', 'w9-floral-addon' ),
            'param_name'       => 'p_left',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' )
        ),
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Right position value', 'w9-floral-addon' ),
            'param_name'       => 'p_right',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' )
        ),
        
        array(
            'type'       => 'slider',
            'heading'    => esc_html__( 'Opacity', 'w9-floral-addon' ),
            'param_name' => 'opacity',
            'unit'       => '',
            'min'        => '0',
            'max'        => '1.01',
            'step'       => '0.05',
            'std'        => '1',
        ),
        
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Transform code', 'w9-floral-addon' ),
            'description' => __( 'You can put transform code to div content here.<br>Transform can have more than one value and separate by " " eg: "transitionY(20px) scale(1.2)". <br>You can read more about transform <a href="http://www.w3schools.com/cssref/css3_pr_transform.asp" target="_blank">here</a>.', 'w9-floral-addon' ),
            'param_name'  => 'transform_code',
            'std'         => '',
        ),
        
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Overlay mode', 'w9-floral-addon' ),
            'description' => __( 'Overlay Mode not appear behind or above main content base on z-index and doesn\'t have spacing in the div wrapepr.' ),
            'param_name'  => 'overlay_enabled',
            'admin_label' => true,
            'value'       => '',
        ),
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Overlay width', 'w9-floral-addon' ),
            'param_name'       => 'overlay_width',
            'description'      => __( 'Can be auto or value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'std'              => '100%',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'       => array(
                'element' => 'overlay_enabled',
                'value'   => 'true',
            ),
        ),
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Overlay height', 'w9-floral-addon' ),
            'param_name'       => 'overlay_height',
            'description'      => __( 'Can be auto or value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'std'              => '100%',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'       => array(
                'element' => 'overlay_enabled',
                'value'   => 'true',
            ),
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Overlay inner content vertical align', 'w9-floral-addon' ),
            'param_name'  => 'inner_v_align',
            'description' => __( 'Select content vertical align in overlay mode.', 'w9-floral-addon' ),
            'value'       => array(
                __( 'Top', 'w9-floral-addon' )    => 'top',
                __( 'Middle', 'w9-floral-addon' ) => 'middle',
                __( 'Bottom', 'w9-floral-addon' ) => 'bottom',
            ),
            'std'         => 'middle',
            'dependency'  => array(
                'element' => 'overlay_enabled',
                'value'   => 'true',
            ),
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Overflow', 'w9-floral-addon' ),
            'param_name'  => 'overflow',
            'description' => __( 'Select option overflow for content inner overlay div.', 'w9-floral-addon' ),
            'value'       => array(
                __( 'Hidden', 'w9-floral-addon' )  => 'hidden',
                __( 'Visible', 'w9-floral-addon' ) => 'visible',
                __( 'Scroll', 'w9-floral-addon' )  => 'scroll',
                __( 'Auto', 'w9-floral-addon' )    => 'auto',
                __( 'Initial', 'w9-floral-addon' ) => 'initial',
                __( 'Inherit', 'w9-floral-addon' ) => 'inherit',
            ),
            'std'         => 'hidden',
            'dependency'  => array(
                'element' => 'overlay_enabled',
                'value'   => 'true',
            ),
        ),
        
        array(
            'type'        => 'number',
            'heading'     => __( 'Z-Index', 'w9-floral-addon' ),
            'param_name'  => 'z_index',
            'admin_label' => true,
            'std'         => '1',
            'description' => __( 'Div content with higher value will appear above lower.', 'w9-floral-addon' ),
        ),
        
        // Hover tab
        
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Hover top position value', 'w9-floral-addon' ),
            'param_name'       => 'hover_p_top',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6  vc_column-with-padding',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
    
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Hover bottom position value', 'w9-floral-addon' ),
            'param_name'       => 'hover_p_bottom',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
    
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Hover left position value', 'w9-floral-addon' ),
            'param_name'       => 'hover_p_left',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
    
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Hover right position value', 'w9-floral-addon' ),
            'param_name'       => 'hover_p_right',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6',
            'description'      => __( 'Value with it\'s unit like px, %, em... eg(20px).', 'w9-floral-addon' ),
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        array(
            'type'             => 'colorpicker',
            'heading'          => __( 'Hover color', 'w9-floral-addon' ),
            'param_name'       => 'hover_color',
            'Description'      => __( 'Text color on div wrapper is hovered.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        array(
            'type'             => 'colorpicker',
            'heading'          => __( 'Hover border color', 'w9-floral-addon' ),
            'param_name'       => 'hover_border_color',
            'Description'      => __( 'Text border color on div wrapper is hovered.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        array(
            'type'             => 'colorpicker',
            'heading'          => __( 'Hover background color', 'w9-floral-addon' ),
            'param_name'       => 'hover_background_color',
            'Description'      => __( 'Background color on div wrapper is hovered.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        array(
            'type'       => 'slider',
            'heading'    => __( 'Hover opacity', 'w9-floral-addon' ),
            'param_name' => 'hover_opacity',
            'unit'       => '',
            'min'        => '0',
            'max'        => '1.01',
            'step'       => '0.05',
            'std'        => '1',
            'group'      => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Hover transform code', 'w9-floral-addon' ),
            'description' => __( 'You can put transform code to div wrapper hover here.<br>Transform can have more than one value and separate by " " eg: "transitionY(20px) scale(1.2)". <br>You can read more about transform <a href="http://www.w3schools.com/cssref/css3_pr_transform.asp" target="_blank">here</a>.', 'w9-floral-addon' ),
            'param_name'  => 'hover_transform_code',
            'group'       => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
            'std'         => '',
        ),
        array(
            'type'        => 'number',
            'heading'     => __( 'Hover transition duration', 'w9-floral-addon' ),
            'param_name'  => 'transition_duration',
            'value'       => '',
            'std'         => '0.3',
            'description' => __( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the transition on hover. ', 'w9-floral-addon' ),
            'group'       => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'number',
            'heading'     => __( 'Hover transition delay', 'w9-floral-addon' ),
            'param_name'  => 'transition_delay',
            'value'       => '',
            'description' => __( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the transition, this is helpful if you want to chain different effects one after another above the fold.', 'w9-floral-addon' ),
            'group'       => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Hover transition timing function', 'w9-floral-addon' ),
            'param_name'  => 'transition_timing_function',
            'value'       => 'ease',
            'description' => __( 'Fill with ease, linear, ease-in, ease-out, ease-in-out or build one for you here <a href="http://cubic-bezier.com/" target="_blank">here</a>.', 'w9-floral-addon' ),
            'group'       => __( 'Div Wrapper Hovered', 'w9-floral-addon' ),
        ),
        
        //Color
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Color', 'w9-floral-addon' ),
            'param_name'  => 'color',
            'Description' => __( 'Text color of div content.', 'w9-floral-addon' ),
            'group'       => __( 'Design Options', 'w9-floral-addon' )
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