<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-countdown-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
        'name'           => __( 'Floral Countdown', 'w9-floral-addon' ),
        'base'           => Floral_SC_Countdown::SC_BASE,
        'class'          => '',
        'icon'           => 'w9 w9-ico-basic-alarm',
        'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
        'php_class_name' => 'Floral_SC_Countdown',
        'params'         => array(
            
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Type', 'w9-floral-addon' ),
                'param_name'  => 'cd_type',
                'admin_label' => true,
                'value'       => array(
                    esc_html__( 'Standard', 'w9-floral-addon' )     => 'standard',
                    esc_html__( 'Progress Bar', 'w9-floral-addon' ) => 'progressbar',
                ),
                'description' => esc_html__( 'Select countdown type.', 'w9-floral-addon' )
            ),
	
	        array(
		        'type'        => 'dropdown',
		        'heading'     => esc_html__( 'Style', 'w9-floral-addon' ),
		        'param_name'  => 'cd_style',
		        'admin_label' => true,
		        'value'       => array(
			        esc_html__( 'Rectangle', 'w9-floral-addon' )     => 'type-standard-rectangle',
			        esc_html__( 'Circle', 'w9-floral-addon' ) => 'type-standard-circle',
		        ),
		        'description' => esc_html__( 'Select countdown style.', 'w9-floral-addon' ),
		        'dependency' => array(
			        'element' => 'cd_type',
			        'value'   => array( 'standard' )
		        )
	        ),
	
	        array(
		        'type'        => 'dropdown',
		        'heading'     => esc_html__( 'Time type', 'w9-floral-addon' ),
		        'param_name'  => 'time_type',
		        'admin_label' => true,
		        'value'       => array(
			        esc_html__( 'Month - Day - Hour - Min - Sec', 'w9-floral-addon' )     => 'm-d-h-m-s',
			        esc_html__( 'Day - Hour - Min - Sec', 'w9-floral-addon' ) => 'd-h-m-s',
		        ),
		        'description' => esc_html__( 'Select countdown time type.', 'w9-floral-addon' ),
		        'dependency' => array(
			        'element' => 'cd_type',
			        'value'   => array( 'standard' )
		        )
	        ),
            
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_time_remaining',
                'value'      => array( esc_html__( 'Show time remaining', 'w9-floral-addon' ) => 'yes' ),
                'dependency' => array(
                    'element' => 'cd_type',
                    'value'   => array( 'progressbar' )
                )
            ),
            
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__( 'Title', 'w9-floral-addon' ),
                'param_name' => 'progress_bar_title',
                'value'      => '',
                'dependency' => array(
                    'element' => 'cd_type',
                    'value'   => array( 'progressbar' )
                ),
                
                'std' => 'PROCESS STATUS',
            ),
            
            array(
                'type'             => 'datepicker',
                'heading'          => esc_html__( 'Time - Start (* Required)', 'w9-floral-addon' ),
                'param_name'       => 'time_start',
                'edit_field_class' => 'vc_col-sm-6',
                'value'            => '',
                'dependency'       => array(
                    'element' => 'cd_type',
                    'value'   => array( 'progressbar' )
                )
            ),
            array(
                'type'             => 'datepicker',
                'heading'          => esc_html__( 'Time - Finish (* Required)', 'w9-floral-addon' ),
                'param_name'       => 'time_finish',
                'edit_field_class' => 'vc_col-sm-6',
                'value'            => '',
            ),
            // Style - standard
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Background color', 'w9-floral-addon' ),
                'param_name'         => 'standard_bgc',
                'group'              => __( 'Style (Standard) ', 'w9-floral-addon' ),
                'description'        => __( 'Select background color.', 'w9-floral-addon' ),
//                'admin_label'        => true,
                'param_holder_class' => 'vc_colored-dropdown',
                'value'              => Floral_Map_Helpers::get_colors(),
                'dependency'         => array(
                    'element' => 'cd_type',
                    'value'   => array( 'standard' )
                ),
                'std'                => '__'
            ),
            array(
                'type'       => 'colorpicker',
                'param_name' => 'standard_custom_bgc',
                'dependency' => array(
                    'element' => 'standard_bgc',
                    'value'   => array( 'custom' )
                ),
                'group'      => __( 'Style (Standard) ', 'w9-floral-addon' )
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Text color', 'w9-floral-addon' ),
                'param_name'         => 'standard_tx_color',
                'description'        => __( 'Select text color.', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_colored-dropdown',
                'value'              => array_merge( array(
                    __( 'Default CSS', 'w9-floral-addon' )  => '__',
                ), Floral_Map_Helpers::get_just_colors() ),
                'std'                => '__',
                'dependency'         => array(
                    'element' => 'cd_type',
                    'value'   => array( 'standard' )
                ),
                'group'              => __( 'Style (Standard) ', 'w9-floral-addon' )
            ),
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Separator color', 'w9-floral-addon' ),
                'param_name'         => 'standard_separator_color',
                'description'        => __( 'Select separator color.', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_colored-dropdown',
                'value'              => array_merge( array(
                    __( 'Default CSS', 'w9-floral-addon' )  => '__',
                ), Floral_Map_Helpers::get_just_colors() ),
                'std'                => '__',
                'dependency'         => array(
                    'element' => 'cd_style',
                    'value'   => array( 'type-standard-rectangle' )
                ),
                'group'              => __( 'Style (Standard) ', 'w9-floral-addon' )
            ),
	
	        array(
		        'type'               => 'dropdown',
		        'heading'            => __( 'Border color', 'w9-floral-addon' ),
		        'param_name'         => 'standard_border_color',
		        'description'        => __( 'Select border color.', 'w9-floral-addon' ),
		        'param_holder_class' => 'vc_colored-dropdown',
		        'value'              => array_merge( array(
			        __( 'Default CSS', 'w9-floral-addon' )  => '__',
		        ), Floral_Map_Helpers::get_just_colors() ),
		        'std'                => '__',
		        'dependency'         => array(
			        'element' => 'cd_style',
			        'value'   => array( 'type-standard-circle' )
		        ),
		        'group'              => __( 'Style (Standard) ', 'w9-floral-addon' )
	        ),
	
	        array(
		        'type'               => 'dropdown',
		        'heading'            => __( 'Outline color', 'w9-floral-addon' ),
		        'param_name'         => 'standard_outline_color',
		        'description'        => __( 'Select outline color.', 'w9-floral-addon' ),
		        'param_holder_class' => 'vc_colored-dropdown',
		        'value'              => array_merge( array(
			        __( 'Default CSS', 'w9-floral-addon' )  => '__',
		        ), Floral_Map_Helpers::get_just_colors() ),
		        'std'                => '__',
		        'dependency'         => array(
			        'element' => 'cd_style',
			        'value'   => array( 'type-standard-circle' )
		        ),
		        'group'              => __( 'Style (Standard) ', 'w9-floral-addon' )
	        ),
            
            // Style - progressbar
            
	        array(
                'type'               => 'dropdown',
                'heading'            => __( 'Bar color', 'w9-floral-addon' ),
                'param_name'         => 'progressbar_bar_color',
                'group'              => __( 'Style (Progressbar) ', 'w9-floral-addon' ),
                'description'        => __( 'Select bar color.', 'w9-floral-addon' ),
//                'admin_label'        => true,
                'param_holder_class' => 'vc_colored-dropdown',
                'value'              => array_merge( array(
                    __( 'Default CSS', 'w9-floral-addon' )  => '__',
                    __( 'Custom Color', 'w9-floral-addon' ) => 'custom',
                ), Floral_Map_Helpers::get_just_colors() ),
                'dependency'         => array(
                    'element' => 'cd_type',
                    'value'   => array( 'progressbar' )
                ),
                'std'                => '__'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Bar current value color', 'w9-floral-addon' ),
                'param_name' => 'progressbar_bar_current_value_color',
                'dependency' => array(
                    'element' => 'progressbar_bar_color',
                    'value'   => array( 'custom' )
                ),
                'group'      => __( 'Style (Progressbar) ', 'w9-floral-addon' )
            ),
            
            array(
                'type'       => 'colorpicker',
                'heading'    => __( 'Bar total value color', 'w9-floral-addon' ),
                'param_name' => 'progressbar_bar_total_value_color',
                'dependency' => array(
                    'element' => 'progressbar_bar_color',
                    'value'   => array( 'custom' )
                ),
                'group'      => __( 'Style (Progressbar) ', 'w9-floral-addon' )
            ),
            
            array(
                'type'               => 'dropdown',
                'heading'            => __( 'Text color', 'w9-floral-addon' ),
                'param_name'         => 'progressbar_tx_color',
                'description'        => __( 'Select text color.', 'w9-floral-addon' ),
                'param_holder_class' => 'vc_colored-dropdown',
                'value'              => array_merge( array(
                    __( 'Default CSS', 'w9-floral-addon' )  => '__',
                ), Floral_Map_Helpers::get_just_colors() ),
                'std'                => '__',
                'dependency'         => array(
                    'element' => 'cd_type',
                    'value'   => array( 'progressbar' )
                ),
                'group'              => __( 'Style (Progressbar) ', 'w9-floral-addon' )
            ),
            Floral_Map_Helpers::extra_class(),
            Floral_Map_Helpers::design_options(),
            Floral_Map_Helpers::design_options_on_tablet(),
            Floral_Map_Helpers::design_options_on_mobile()
        )
    )
);
