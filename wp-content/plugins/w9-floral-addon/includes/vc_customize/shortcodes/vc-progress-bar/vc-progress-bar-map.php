<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-progress-bar-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Progress Bar', 'w9-floral-addon' ),
    'base'        => 'vc_progress_bar',
    'icon'        => 'w9 w9-ico-music-mixer',
    'category'    => FLORAL_SC_CATEGORY,
    'description' => __( 'Animated progress bar', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Layout style', 'w9-floral-addon' ),
            'param_name'  => 'layout_style',
            'admin_label' => true,
            'value'       => array(
                __( 'Standard', 'w9-floral-addon' )      => 'style1',
                __( 'Text inner bar', 'w9-floral-addon' ) => 'style2',
                __( 'Text move', 'w9-floral-addon' )      => 'style3' ),
            'std'         => 'style1',
            'description' => __( 'Select Layout Style.', 'w9-floral-addon' )
        ),
//        array(
//            'type'        => 'textfield',
//            'heading'     => __( 'Widget title', 'w9-floral-addon' ),
//            'param_name'  => 'title',
//            'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-floral-addon' )
//        ),
        array(
            'type'        => 'param_group',
            'heading'     => __( 'Values', 'w9-floral-addon' ),
            'param_name'  => 'values',
            'description' => __( 'Enter values for graph - value, title and color.', 'w9-floral-addon' ),
            'value'       => urlencode( json_encode( array(
                array(
                    'label' => __( 'Development', 'w9-floral-addon' ),
                    'value' => '90',
                ),
                array(
                    'label' => __( 'Design', 'w9-floral-addon' ),
                    'value' => '80',
                ),
                array(
                    'label' => __( 'Marketing', 'w9-floral-addon' ),
                    'value' => '70',
                ),
            ) ) ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Label', 'w9-floral-addon' ),
                    'param_name'  => 'label',
                    'description' => __( 'Enter text used as title of bar.', 'w9-floral-addon' ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Value', 'w9-floral-addon' ),
                    'param_name'  => 'value',
                    'description' => __( 'Enter value of bar.', 'w9-floral-addon' ),
                    'admin_label' => true,
                ),
                array(
                    'type'               => 'dropdown',
                    'heading'            => __( 'Color', 'w9-floral-addon' ),
                    'param_name'         => 'color',
                    'value'              => array(
                            __( 'Default', 'w9-floral-addon' ) => ''
                        ) + array(
                            __( 'Primary Color', 'w9-floral-addon' )       => 'p',
                            __( 'Secondary Color', 'w9-floral-addon' )     => 's',
                            __( 'Gradient: Pri - Sec', 'w9-floral-addon' ) => 'gradient-p-to-s',
                            __( 'Gradient: Sec - Pri', 'w9-floral-addon' ) => 'gradient-s-to-p',
                            __( 'Custom Color', 'w9-floral-addon' )        => 'custom',
                            __( 'Dark #000', 'w9-floral-addon' )           => 'dark',
                            __( 'Gray #222', 'w9-floral-addon' )           => 'gray2',
                            __( 'Gray #444', 'w9-floral-addon' )           => 'gray4',
                            __( 'Gray #666', 'w9-floral-addon' )           => 'gray6',
                            __( 'Gray #888', 'w9-floral-addon' )           => 'gray8',
                        ) + floral_get_most_used_colors( 'name_key' ),
                    'description'        => __( 'Select single bar background color.', 'w9-floral-addon' ),
                    'admin_label'        => true,
                    'param_holder_class' => 'vc_colored-dropdown'
                ),
                // custom single bar value bg
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Custom bar color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_single_barvalue_bgcolor_type',
                    'description' => __( 'Select custom single bar value background color.', 'w9-floral-addon' ),
                    'value'       => array(
                        __( 'Normal background color', 'w9-floral-addon' ) => 'normal',
                        __( 'Gradient background', 'w9-floral-addon' )     => 'gradient'
                    ),

                    'dependency' => array(
                        'element' => 'color',
                        'value'   => array( 'custom' )
                    )
                ),
                array(
                    'type'       => 'colorpicker',
                    'param_name' => 'custom_single_barvalue_bgcolor_normal',
                    'dependency' => array(
                        'element' => 'custom_single_barvalue_bgcolor_type',
                        'value'   => array( 'normal' )
                    ),
                ),
                array(
                    'type'             => 'colorpicker',
                    'description'      => __( 'Gradient color 1.', 'w9-floral-addon' ),
                    'param_name'       => 'custom_single_barvalue_bgcolor_gradient_1',
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency'       => array(
                        'element' => 'custom_single_barvalue_bgcolor_type',
                        'value'   => array( 'gradient' )
                    ),
                ),
                array(
                    'type'             => 'colorpicker',
                    'description'      => __( 'Gradient color 2.', 'w9-floral-addon' ),
                    'param_name'       => 'custom_single_barvalue_bgcolor_gradient_2',
                    'edit_field_class' => 'vc_col-sm-6',
                    'dependency'       => array(
                        'element' => 'custom_single_barvalue_bgcolor_type',
                        'value'   => array( 'gradient' )
                    ),
                ),
                // end - custom single bar value bg
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_single_bar_bgcolor',
                    'description' => __( 'Select custom single bar background color.', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => array( 'custom' )
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom label text color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_single_txtcolor',
                    'description' => __( 'Select custom single bar label text color.', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => array( 'custom' )
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom value text color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_single_value_txtcolor',
                    'description' => __( 'Select custom single bar value text color.', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => array( 'custom' )
                    ),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom value background color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_single_value_bgcolor',
                    'description' => __( 'Select custom single bar value background color. This option works only with layout "Text move".', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => array( 'custom' )
                    ),
                )
            ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Units', 'w9-floral-addon' ),
            'param_name'  => 'units',
            'std'         => '%',
            'description' => __( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'w9-floral-addon' )
        ),
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Color', 'w9-floral-addon' ),
            'param_name'         => 'bgcolor',
            'value'              => array(
                    __( 'Primary Color', 'w9-floral-addon' )       => 'p',
                    __( 'Secondary Color', 'w9-floral-addon' )     => 's',
                    __( 'Gradient: Pri - Sec', 'w9-floral-addon' ) => 'gradient-p-to-s',
                    __( 'Gradient: Sec - Pri', 'w9-floral-addon' ) => 'gradient-s-to-p',
                    __( 'Custom Color', 'w9-floral-addon' )        => 'custom',
                    __( 'Dark #000', 'w9-floral-addon' )           => 'dark',
                    __( 'Gray #222', 'w9-floral-addon' )           => 'gray2',
                    __( 'Gray #444', 'w9-floral-addon' )           => 'gray4',
                    __( 'Gray #666', 'w9-floral-addon' )           => 'gray6',
                    __( 'Gray #888', 'w9-floral-addon' )           => 'gray8',
                ) + floral_get_most_used_colors( 'name_key' ),
            'description'        => __( 'Select bar background color.', 'w9-floral-addon' ),
            'admin_label'        => true,
            'param_holder_class' => 'vc_colored-dropdown',
        ),
        // custom bars value background color
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Bar value custom background color', 'w9-floral-addon' ),
            'param_name'  => 'custom_barvalue_bgcolor_type',
            'description' => __( 'Select custom background color for bars value.', 'w9-floral-addon' ),
            'value'       => array(
                __( 'Normal background color', 'w9-floral-addon' ) => 'normal',
                __( 'Gradient background', 'w9-floral-addon' )     => 'gradient'
            ),
            'dependency'  => array(
                'element' => 'bgcolor',
                'value'   => array( 'custom' )
            )
        ),
        array(
            'type'       => 'colorpicker',
            'param_name' => 'custom_barvalue_bgcolor_normal',
            'dependency' => array( 'element' => 'custom_barvalue_bgcolor_type', 'value' => array( 'normal' ) )
        ),
        array(
            'type'             => 'colorpicker',
            'description'      => __( 'Gradient color 1.', 'w9-floral-addon' ),
            'param_name'       => 'custom_barvalue_bgcolor_gradient_1',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'       => array(
                'element' => 'custom_barvalue_bgcolor_type',
                'value'   => array( 'gradient' )
            ),
        ),
        array(
            'type'             => 'colorpicker',
            'description'      => __( 'Gradient color 2.', 'w9-floral-addon' ),
            'param_name'       => 'custom_barvalue_bgcolor_gradient_2',
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'       => array(
                'element' => 'custom_barvalue_bgcolor_type',
                'value'   => array( 'gradient' )
            ),
        ),
        // end - custom bars value background color
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Bar custom background color', 'w9-floral-addon' ),
            'param_name'  => 'custom_bar_bgcolor',
            'description' => __( 'Select custom background color for bars.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'bgcolor',
                'value'   => array( 'custom' )
            )
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Bar custom label text color', 'w9-floral-addon' ),
            'param_name'  => 'custom_txtcolor',
            'description' => __( 'Select custom label text color for bars.', 'w9-floral-addon' ),
            'dependency'  => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Bar custom value text color', 'w9-floral-addon' ),
            'param_name'  => 'custom_value_txtcolor',
            'description' => __( 'Select custom value text color for bars.', 'w9-floral-addon' ),
            'dependency'  => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Bar custom value background color', 'w9-floral-addon' ),
            'param_name'  => 'custom_value_bgcolor',
            'description' => __( 'Select custom value background color for bar. This option work only with layout "Text move".', 'w9-floral-addon' ),
            'dependency'  => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => __( 'Options', 'w9-floral-addon' ),
            'param_name' => 'options',
            'description' => __( 'Note: These options won\'t work with bar value background color set to gradient.', 'w9-floral-addon' ),
            'value'      => array(
                __( 'Add stripes', 'w9-floral-addon' )                                          => 'striped',
                __( 'Add animation (Note: visible only with striped bar).', 'w9-floral-addon' ) => 'animated'
            )
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile()
    )
) );