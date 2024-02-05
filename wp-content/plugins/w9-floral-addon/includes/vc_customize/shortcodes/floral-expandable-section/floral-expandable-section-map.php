<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-expandable-section-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'                    => esc_html__( 'Floral Expandable Section', 'w9-floral-addon' ),
    'base'                    => Floral_SC_Expandable_Section::SC_BASE,
    'icon'                    => 'w9 w9-ico-arrows-expand',
    'category'                => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'as_parent'               => array( 'except' => Floral_SC_Expandable_Section::SC_BASE ),
    'content_element'         => true,
    'show_settings_on_create' => true,
    'description'             => __( 'Create an expandable section', 'w9-floral-addon' ),
    'js_view'                 => 'VcColumnView',
    'php_class_name'          => 'Floral_SC_Expandable_Section',
    'params'                  => array(
        array(
            'type'        => 'buttonset',
            'heading'     => esc_html__( 'Active state', 'w9-floral-addon' ),
            'param_name'  => 'es_active_state',
            'admin_label' => true,
            'options'     => array(
                'expand'   => __( 'Expand', 'w9-floral-addon' ),
                'collapse' => __( 'Collapse', 'w9-floral-addon' )
            ),
            'std'         => 'collapse'
        ),
        
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Toggle button size', 'w9-floral-addon' ),
            'param_name' => 'es_toggle_button_size',
            'value'      => array(
                __( 'Small', 'w9-floral-addon' ) => 'small',
                __( 'Large', 'w9-floral-addon' ) => 'large',
            ),
            'std'        => 'large'
        ),
        
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__( 'Expand animation', 'w9-floral-addon' ),
            'param_name' => 'es_animation',
            'value'      => array(
                __( 'Slide', 'w9-floral-addon' ) => 'slide',
                __( 'Fade', 'w9-floral-addon' )  => 'fade',
            ),
            'std'        => 'slide'
        ),
        
        array(
            'type'        => 'number',
            'heading'     => esc_html__( 'Spacing between toggle button and content', 'w9-floral-addon' ),
            'param_name'  => 'es_spacing',
            'description' => esc_html__( 'Enter a spacing between the toggle button and the content (not include px). Default value is 50.', 'w9-floral-addon' ),
            'value'       => '50'
        ),
	
	    array(
		    'type'       => 'dropdown',
		    'heading'    => esc_html__( 'Inner container', 'w9-floral-addon' ),
		    'param_name' => 'inner_container',
		    'value'      => array(
			    esc_html__( 'Container', 'w9-floral-addon' )          => 'container',
			    esc_html__( 'Container Extended', 'w9-floral-addon' ) => 'container-xlg',
			    esc_html__( 'Container Fluid', 'w9-floral-addon' )    => 'container-fluid',
			    esc_html__( 'Full Width', 'w9-floral-addon' )         => '__',
		    ),
		    'std'        => '__'
	    ),
        
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Content max width', 'w9-floral-addon' ),
            'param_name'  => 'es_content_max_width',
            'description' => esc_html__( 'Set max-width attribute for the content (etc: 300px, 50%...).', 'w9-floral-addon' ),
            'std'         => ''
        ),
        
        Floral_Map_Helpers::extra_class(),
        
        /*-------------------------------------
        	EXPAND STATE
        ---------------------------------------*/
        array(
            'type'        => 'textfield',
            'heading'     => __('Label text', 'w9-floral-addon' ),
            'param_name'  => 'es_expand_label',
            'std'         => __( 'View Less', 'w9-floral-addon' ),
            'admin_label' => true,
            'group'       => __( 'Expand State', 'w9-floral-addon' )
        ),
        
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__( 'Add icon?', 'w9-floral-addon' ),
            'param_name' => 'es_expand_add_icon',
            'value'      => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            'group'      => __( 'Expand State', 'w9-floral-addon' ),
            'std'        => 'yes'
        ),
        array_merge( Floral_Map_Helpers::get_icons_picker_type( '9wpthemes', false, 'expand_' ), array( 'dependency' => array( 'element' => 'es_expand_add_icon', 'value' => 'yes' ), 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_9wpthemes( 'w9 w9-ico-uparrows15', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_fontawesome( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_openiconic( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_typicons( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_entypo( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_linecons( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_monosocial( '', false, 'expand_' ), array( 'group' => __( 'Expand State', 'w9-floral-addon' ) ) ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Text color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'es_expand_text_color',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'description'        => esc_html__( 'Select text color for the expand state.', 'w9-floral-addon' ),
            'group'              => __( 'Expand State', 'w9-floral-addon' ),
            'std'                => 'text'
        ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Background color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'es_expand_bgc',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'description'        => esc_html__( 'Select background color for the expand state.', 'w9-floral-addon' ),
            'group'              => __( 'Expand State', 'w9-floral-addon' ),
            'std'                => 'light'
        ),
        
        
        /*-------------------------------------
        	COLLAPSE STATE
        ---------------------------------------*/
        array(
            'type'        => 'textfield',
            'heading'     => __('Label text', 'w9-floral-addon' ),
            'param_name'  => 'es_collapse_label',
            'std'         => __( 'View More', 'w9-floral-addon' ),
            'admin_label' => true,
            'group'       => __( 'Collapse State', 'w9-floral-addon' )
        ),
        
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__( 'Add icon?', 'w9-floral-addon' ),
            'param_name' => 'es_collapse_add_icon',
            'value'      => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            'group'      => __( 'Collapse State', 'w9-floral-addon' ),
            'std'        => 'yes'
        ),
        array_merge( Floral_Map_Helpers::get_icons_picker_type( '9wpthemes', false, 'collapse_' ), array( 'dependency' => array( 'element' => 'es_collapse_add_icon', 'value' => 'yes' ), 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_9wpthemes( 'w9 w9-ico-downarrows10', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_fontawesome( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_openiconic( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_typicons( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_entypo( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_linecons( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        array_merge( Floral_Map_Helpers::get_icon_picker_monosocial( '', false, 'collapse_' ), array( 'group' => __( 'Collapse State', 'w9-floral-addon' ) ) ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Text color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'es_collapse_text_color',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'description'        => esc_html__( 'Select text color for the collapse state.', 'w9-floral-addon' ),
            'group'              => __( 'Collapse State', 'w9-floral-addon' ),
            'std'                => 'light'
        ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Background color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'es_collapse_bgc',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'description'        => esc_html__( 'Select background color for the collapse state.', 'w9-floral-addon' ),
            'group'              => __( 'Collapse State', 'w9-floral-addon' ),
            'std'                => 'p'
        ),
        
        /*-------------------------------------
        	EXTRA OPTIONS
        ---------------------------------------*/
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );