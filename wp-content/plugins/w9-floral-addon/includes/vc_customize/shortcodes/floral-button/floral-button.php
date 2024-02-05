<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-button.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Button extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_button';
    
    public static function map() {
        return array(
            'name'           => esc_html__( 'Floral Button', 'w9-floral-addon' ),
            'base'           => Floral_SC_Button::SC_BASE,
            'class'          => '',
            'icon'           => 'w9 w9-ico-arrows-keyboard-cmd-29',
            'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
            'description'    => 'Create awesome button',
            'php_class_name' => 'Floral_SC_Button',
            'params'         => array(
                //
                // General Group
                //
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Text', 'w9-floral-addon' ),
                    'param_name'  => 'btn_text',
                    'admin_label' => true,
                    'value'       => 'The button text',
                ),
                array(
                    'type'       => 'vc_link',
                    'heading'    => esc_html__( 'Link (URL)', 'w9-floral-addon' ),
                    'param_name' => 'btn_link',
                    'value'      => '',
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Font family', 'w9-floral-addon' ),
                    'param_name'  => 'btn_ff',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Primary Font', 'w9-floral-addon' )   => 'p-font',
                        esc_html__( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
                        esc_html__( 'Third Font', 'w9-floral-addon' )     => 't-font',
                    ),
                    'std'         => 's-font',
                    'description' => esc_html__( 'Select button style.', 'w9-floral-addon' )
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Style', 'w9-floral-addon' ),
                    'param_name'  => 'btn_style',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Classic', 'w9-floral-addon' )    => 'btn-style-solid',
                        esc_html__( 'Border 1px', 'w9-floral-addon' ) => 'btn-style-border-1',
                        esc_html__( 'Border 2px', 'w9-floral-addon' ) => 'btn-style-border-2',
                        esc_html__( '3D', 'w9-floral-addon' )         => 'btn-style-3d',
                    ),
                    'description' => esc_html__( 'Select button style.', 'w9-floral-addon' )
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Shape', 'w9-floral-addon' ),
                    'param_name'  => 'btn_shape',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Square', 'w9-floral-addon' )    => 'btn-shape-square',
                        esc_html__( 'Rounded 1', 'w9-floral-addon' ) => 'btn-shape-rounded-1',
                        esc_html__( 'Rounded 2', 'w9-floral-addon' ) => 'btn-shape-rounded-2',
//                esc_html__( 'Circle 50%', 'w9-floral-addon' )   => 'btn-shape-circle'
                    ),
                    'description' => esc_html__( 'Select button shape type.', 'w9-floral-addon' )
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Size', 'w9-floral-addon' ),
                    'param_name'  => 'btn_size',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Extra Small', 'w9-floral-addon' ) => 'btn-size-xs',
                        esc_html__( 'Small', 'w9-floral-addon' )       => 'btn-size-sm',
                        esc_html__( 'Medium', 'w9-floral-addon' )      => 'btn-size-md',
                        esc_html__( 'Large', 'w9-floral-addon' )       => 'btn-size-lg',
                        esc_html__( 'Extra Large', 'w9-floral-addon' ) => 'btn-size-xlg',
                    ),
                    'description' => esc_html__( 'The Custom Size option currently does not support add icon.', 'w9-floral-addon' ),
                    'std'         => 'btn-size-md'
                ),
                /*-------------------------------------
                    CUSTOM SIZE
                ---------------------------------------*/
                array(
                    'type'             => 'textfield',
                    'heading'          => esc_html__( 'Custom font size', 'w9-floral-addon' ),
                    'param_name'       => 'btn_custom_size',
                    'value'            => '',
                    'description'      => esc_html__( 'Enter custom font-size for the button (etc: 20px, 10em...).', 'w9-floral-addon' ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),


                array(
                    'type'             => 'textfield',
                    'heading'          => esc_html__( 'Custom padding left/right', 'w9-floral-addon' ),
                    'param_name'       => 'btn_custom_padding_lr',
                    'value'            => '',
                    'description'      => esc_html__( 'Leave blank if you want to use default padding (ect: 20px, 2em, ...).', 'w9-floral-addon' ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),

                /*-------------------------------------
                    CUSTOM BUTTON WIDTH
                ---------------------------------------*/
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__( 'Custom button width', 'w9-floral-addon' ),
                    'param_name'  => 'btn_custom_width',
                    'value'       => '',
                    'description' => esc_html__( 'Enter custom button width (etc: 100%, 200px, ....). This option may break your site on small screen size devices, please be careful!', 'w9-floral-addon' ),
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Alignment', 'w9-floral-addon' ),
                    'param_name'  => 'btn_alignment',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__( 'Inherit', 'w9-floral-addon' ) => '',
                        esc_html__( 'Inline', 'w9-floral-addon' ) => 'inline-block-el',
                        esc_html__( 'Left', 'w9-floral-addon' )   => 'text-left',
                        esc_html__( 'Center', 'w9-floral-addon' ) => 'text-center',
                        esc_html__( 'Right', 'w9-floral-addon' )  => 'text-right',
                    ),
                    'description' => esc_html__( 'Select the button alignment.', 'w9-floral-addon' )
                ),


                /*-------------------------------------
                    ICON
                ---------------------------------------*/
                array(
                    'type'       => 'switcher',
                    'heading'    => esc_html__( 'Add icon?', 'w9-floral-addon' ),
                    'param_name' => 'btn_add_icon',
                ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon alignment', 'w9-floral-addon' ),
                    'description' => esc_html__( 'Select icon alignment.', 'w9-floral-addon' ),
                    'param_name'  => 'btn_icon_align',
                    'value'       => array(
                        esc_html__( 'Left', 'w9-floral-addon' )  => 'align-icon-left',
                        esc_html__( 'Right', 'w9-floral-addon' ) => 'align-icon-right',
                    ),
                    'group'       => __( 'Icon', 'w9-floral-addon' ),
                    'dependency'  => array( 'element' => 'btn_add_icon', 'value' => '1' ),
                ),
                array_merge( Floral_Map_Helpers::get_icons_picker_type(), array( 'group' => __( 'Icon', 'w9-floral-addon' ), 'dependency' => array( 'element' => 'btn_add_icon', 'value' => '1' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_9wpthemes(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_floral(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_fontawesome(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_openiconic(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_typicons(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_entypo(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_linecons(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),
                array_merge( Floral_Map_Helpers::get_icon_picker_monosocial(), array( 'group' => __( 'Icon', 'w9-floral-addon' ) ) ),

                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Icon effect', 'w9-floral-addon' ),
                    'description' => esc_html__( 'Select icon effect.', 'w9-floral-addon' ),
                    'param_name'  => 'btn_icon_effect',
                    'value'       => array(
                        esc_html__( 'None', 'w9-floral-addon' )                    => 'icon-effect-none',
                        esc_html__( 'Inner Out', 'w9-floral-addon' )               => 'icon-effect-inner-out',
                        esc_html__( 'Inner Out, Text Moving', 'w9-floral-addon' )  => 'icon-effect-inner-out-text',
                        esc_html__( 'Outer In', 'w9-floral-addon' )                => 'icon-effect-outer-in',
                        esc_html__( 'Outer In, Text Moving', 'w9-floral-addon' )   => 'icon-effect-outer-in-text',
                        esc_html__( 'Top Down, Text Out', 'w9-floral-addon' )      => 'icon-effect-top-down-text',
                        esc_html__( 'Bottom Up, Text Out', 'w9-floral-addon' )     => 'icon-effect-bottom-up-text',
                        esc_html__( 'Left To Right, Text Out', 'w9-floral-addon' ) => 'icon-effect-left2right-text',
                        esc_html__( 'Right To Left, Text Out', 'w9-floral-addon' ) => 'icon-effect-right2left-text',
                    ),
                    'group'       => __( 'Icon', 'w9-floral-addon' ),
                    'dependency'  => array( 'element' => 'btn_add_icon', 'value' => '1' ),
                ),

                array(
                    'type'       => 'slider',
                    'heading'    => esc_html__( 'Icon size', 'w9-floral-addon' ),
                    'param_name' => 'btn_icon_size',
                    'unit'       => '%',
                    'min'        => '50',
                    'max'        => '200',
                    'step'       => '5',
                    'std'        => '100%',
                    'group'      => __( 'Icon', 'w9-floral-addon' ),
                    'dependency' => array( 'element' => 'btn_add_icon', 'value' => '1' ),
                ),

                //
                // Color Group
                //
                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Text color', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_text_color',
                    'value'              => Floral_Map_Helpers::get_colors(),
                    'description'        => esc_html__( 'Select color for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'std'                => 'light'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom text color', 'w9-floral-addon' ),
                    'param_name' => 'btn_text_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_text_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Background color', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_bgc',
                    'value'              => array_merge( Floral_Map_Helpers::get_colors(), array( __( 'Gradient', 'w9-floral-addon' ) => 'gradient' ) ),
                    'description'        => esc_html__( 'Select background color for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'std'                => 'p'
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Gradient color 1', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_bgc_gradient_1',
                    'value'              => Floral_Map_Helpers::get_just_colors(),
                    'description'        => esc_html__( 'Select background gradient color 1 for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'std'                => 'p',
                    'dependency'         => array(
                        'element' => 'btn_bgc',
                        'value'   => 'gradient'
                    ),
                    'edit_field_class'   => 'vc_col-sm-6 vc_column'
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Gradient color 2', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_bgc_gradient_2',
                    'value'              => Floral_Map_Helpers::get_just_colors(),
                    'description'        => esc_html__( 'Select background gradient color 2 for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'std'                => 's',
                    'dependency'         => array(
                        'element' => 'btn_bgc',
                        'value'   => 'gradient'
                    ),
                    'edit_field_class'   => 'vc_col-sm-6 vc_column'
                ),

                array(
                    'type'             => 'number',
                    'heading'          => __( 'Gradient angle', 'w9-floral-addon' ),
                    'param_name'       => 'btn_bgc_gradient_angle',
                    'description'      => __( 'Enter the gradient angle, default value is 45.', 'w9-floral-addon' ),
                    'group'            => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'       => array(
                        'element' => 'btn_bgc',
                        'value'   => 'gradient'
                    ),
                    'std'              => '45',
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),


                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom background color', 'w9-floral-addon' ),
                    'param_name' => 'btn_bgc_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_bgc',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Border color', 'w9-floral-addon' ),
                    'param_name'         => 'btn_border_color',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'value'              => Floral_Map_Helpers::get_colors(),
                    'description'        => esc_html__( 'Select border color for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'         => array( 'element' => 'btn_style', 'value' => array( 'btn-style-border-1', 'btn-style-border-2' ) ),
                    'std'                => 'transparent'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom border color', 'w9-floral-addon' ),
                    'param_name' => 'btn_border_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_border_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Text hover color', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_text_hover_color',
                    'value'              => Floral_Map_Helpers::get_colors(),
                    'description'        => esc_html__( 'Select hover color for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'         => array( 'element' => 'btn_style', 'value_not_equal_to' => array( 'btn-style-3d' ) ),
                    'std'                => 'none'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom text hover color', 'w9-floral-addon' ),
                    'param_name' => 'btn_text_hover_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_text_hover_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Background hover color', 'w9-floral-addon' ),
                    'param_name'         => 'btn_bgc_hover_color',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'value'              => array_merge( array(
                        esc_html__( 'Bolder', 'w9-floral-addon' )  => 'bolder',
                        esc_html__( 'Lighter', 'w9-floral-addon' ) => 'lighter'
                    ), Floral_Map_Helpers::get_colors() ),
                    'description'        => esc_html__( 'Select background hover color for your button. Notice: the option Bolder and Lighter will not work if the current background color is gradient.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'         => array( 'element' => 'btn_style', 'value_not_equal_to' => array( 'btn-style-3d' ) ),
                    'std'                => 'none'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom background hover color', 'w9-floral-addon' ),
                    'param_name' => 'btn_bgc_hover_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_bgc_hover_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),

                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Border hover color', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_border_hover_color',
                    'value'              => Floral_Map_Helpers::get_colors(),
                    'description'        => esc_html__( 'Select border hover color for your button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'         => array( 'element' => 'btn_style', 'value' => array( 'btn-style-border-1', 'btn-style-border-2' ) ),
                    'std'                => 'none'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom border hover color', 'w9-floral-addon' ),
                    'param_name' => 'btn_border_hover_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_border_hover_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),
                // box shadow color
                array(
                    'type'               => 'dropdown',
                    'heading'            => esc_html__( 'Box shadow color', 'w9-floral-addon' ),
                    'param_holder_class' => 'vc_colored-dropdown',
                    'param_name'         => 'btn_box_shadow_color',
                    'value'              => array_merge( array(
                        esc_html__( 'Bolder Than Background', 'w9-floral-addon' )  => 'bolder',
                        esc_html__( 'Lighter Than Background', 'w9-floral-addon' ) => 'lighter'
                    ), Floral_Map_Helpers::get_colors() ),
                    'description'        => esc_html__( 'Select box-shadow color for your 3D style button.', 'w9-floral-addon' ),
                    'group'              => __( 'Colors', 'w9-floral-addon' ),
                    'dependency'         => array( 'element' => 'btn_style', 'value' => array( 'btn-style-3d' ) ),
                    'std'                => 'bolder'
                ),

                array(
                    'type'       => 'colorpicker',
                    'heading'    => esc_html__( 'Custom box shadow color', 'w9-floral-addon' ),
                    'param_name' => 'btn_box_shadow_custom_color',
                    'value'      => '',
                    'dependency' => array(
                        'element' => 'btn_box_shadow_color',
                        'value'   => 'custom'
                    ),
                    'group'      => __( 'Colors', 'w9-floral-addon' ),
                ),


                // Effects action
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Background hover effect', 'w9-floral-addon' ),
                    'param_name'  => 'btn_hover_effect',
                    'value'       => array(
                        esc_html__( 'Default', 'w9-floral-addon' )                => 'hover-effect-default',
                        esc_html__( 'Top Down', 'w9-floral-addon' )               => 'hover-effect-top-down',
                        esc_html__( 'Bottom Up', 'w9-floral-addon' )              => 'hover-effect-bottom-up',
                        esc_html__( 'Left To Right', 'w9-floral-addon' )          => 'hover-effect-left2right',
                        esc_html__( 'Right To Left', 'w9-floral-addon' )          => 'hover-effect-right2left',
                        esc_html__( 'Rotate Down From Left', 'w9-floral-addon' )  => 'hover-effect-rotate-left',
                        esc_html__( 'Rotate Down From Right', 'w9-floral-addon' ) => 'hover-effect-rotate-right',
                        esc_html__( 'Middle Out 1', 'w9-floral-addon' )           => 'hover-effect-middle-out-1',
                        esc_html__( 'Middle Out 2', 'w9-floral-addon' )           => 'hover-effect-middle-out-2',
                        esc_html__( 'Middle Out 3', 'w9-floral-addon' )           => 'hover-effect-middle-out-3',
                        esc_html__( 'Center Out', 'w9-floral-addon' )             => 'hover-effect-center-out',
                    ),
                    'description' => esc_html__( 'Select background hover color for your button.', 'w9-floral-addon' ),
                    'group'       => __( 'Effects', 'w9-floral-addon' ),
                    'dependency'  => array( 'element' => 'btn_style', 'value_not_equal_to' => array( 'btn-style-3d' ) ),
                ),
                array(
                    'type'        => 'checkbox',
                    'heading'     => __( 'Button down on active', 'w9-floral-addon' ),
                    'param_name'  => 'btn_down_effect',
                    'description' => __( 'Enable or disable on click or active effect.', 'w9-floral-addon' ),
                    'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
                    'group'       => __( 'Effects', 'w9-floral-addon' ),
                ),
                array(
                    'type'       => 'slider',
                    'heading'    => __( 'Button opacity on active', 'w9-floral-addon' ),
                    'param_name' => 'btn_opacity_effect',
                    'unit'       => '',
                    'min'        => '0.1',
                    'max'        => '1.01',
                    'step'       => '0.05',
                    'std'        => '1',
                    'group'      => __( 'Effects', 'w9-floral-addon' ),
                ),
                // Extra options
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Advanced on click action', 'w9-floral-addon' ),
                    'param_name'  => 'btn_custom_onclick',
                    'description' => __( 'Insert inline onclick javascript action.', 'w9-floral-addon' ),
                    'value'       => array(
                        __( 'None', 'w9-floral-addon' )                   => 'none',
                        __( 'Toggle Page Left Zone', 'w9-floral-addon' )  => 'toggle-pagezone-left',
                        __( 'Toggle Page Right Zone', 'w9-floral-addon' ) => 'toggle-pagezone-right',
                        __( 'Popup Search', 'w9-floral-addon' )           => 'popup-search',
                        __( 'Popup Sidebar', 'w9-floral-addon' )          => 'popup-sidebar',
                        __( 'Popup Content Template', 'w9-floral-addon' ) => 'popup-content-template',
                        __( 'Custom', 'w9-floral-addon' ) => 'custom',
                    ),
                ),
    
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Content template popup', 'w9-floral-addon' ),
                    'param_name' => 'btn_content_template_popup',
                    'value' => floral_get_content_template_list(true),
                    'dependency' => array(
                        'element' => 'btn_custom_onclick',
                        'value' => 'popup-content-template',
                    )
                ),
    
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Sidebar popup', 'w9-floral-addon' ),
                    'param_name' => 'btn_sidebar_popup',
                    'value' => floral_get_sidebar_list(true),
                    'dependency' => array(
                        'element' => 'btn_custom_onclick',
                        'value' => 'popup-sidebar'
                    )
                ),
    
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'On click code', 'w9-floral-addon' ),
                    'param_name'  => 'btn_custom_onclick_code',
                    'description' => __( 'Enter onclick action code.', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element'   => 'btn_custom_onclick',
                        'value' => 'custom'
                    ),
                ),

                Floral_Map_Helpers::extra_class(),
                Floral_Map_Helpers::design_options(),
                Floral_Map_Helpers::animation_css(),
                Floral_Map_Helpers::animation_duration(),
                Floral_Map_Helpers::animation_delay()
            )
        );
    }
}

