<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-round-chart-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Round Chart', 'w9-floral-addon' ),
    'base'        => 'vc_round_chart',
    'class'       => '',
    'icon'        => 'w9 w9-ico-ecommerce-graph1',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Pie and Doughnat charts', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Widget title', 'w9-floral-addon' ),
            'param_name'  => 'title',
            'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-floral-addon' ),
            'admin_label' => true,
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Design', 'w9-floral-addon' ),
            'param_name'  => 'type',
            'value'       => array(
                __( 'Pie', 'w9-floral-addon' )      => 'pie',
                __( 'Doughnut', 'w9-floral-addon' ) => 'doughnut',
            ),
            'description' => __( 'Select type of chart.', 'w9-floral-addon' ),
            'admin_label' => true,
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Gap', 'w9-floral-addon' ),
            'param_name'  => 'stroke_width',
            'value'       => array(
                0 => 0,
                1 => 1,
                2 => 2,
                5 => 5,
            ),
            'description' => __( 'Select gap size.', 'w9-floral-addon' ),
            'std'         => 2,
        ),
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Outline color', 'w9-floral-addon' ),
            'param_name'         => 'stroke_color',
            'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
            'description'        => __( 'Select outline color.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'                => 'p',
            'dependency'         => array(
                'element'            => 'stroke_width',
                'value_not_equal_to' => '0',
            ),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Custom outline color', 'w9-floral-addon' ),
            'param_name'  => 'custom_stroke_color',
            'description' => __( 'Select custom outline color.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'stroke_color',
                'value'   => array( 'custom' ),
            ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Show legend?', 'w9-floral-addon' ),
            'param_name'  => 'legend',
            'description' => __( 'If checked, chart will have legend.', 'w9-floral-addon' ),
            'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            'std'         => 'yes',
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Show hover values?', 'w9-floral-addon' ),
            'param_name'  => 'tooltips',
            'description' => __( 'If checked, chart will show values on hover.', 'w9-floral-addon' ),
            'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            'std'         => 'yes',
        ),
        array(
            'type'       => 'param_group',
            'heading'    => __( 'Values', 'w9-floral-addon' ),
            'param_name' => 'values',
            'value'      => urlencode( json_encode( array(
                array(
                    'title' => __( 'One', 'w9-floral-addon' ),
                    'value' => '60',
                    'color' => 'p',
                ),
                array(
                    'title' => __( 'Two', 'w9-floral-addon' ),
                    'value' => '40',
                    'color' => 's',
                ),
            ) ) ),
            'params'     => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Title', 'w9-floral-addon' ),
                    'param_name'  => 'title',
                    'description' => __( 'Enter title for chart area.', 'w9-floral-addon' ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Value', 'w9-floral-addon' ),
                    'param_name'  => 'value',
                    'description' => __( 'Enter value for area.', 'w9-floral-addon' ),
                ),
                array(
                    'type'               => 'dropdown',
                    'heading'            => __( 'Color', 'w9-floral-addon' ),
                    'param_name'         => 'color',
                    'param_holder_class' => 'vc_colored-dropdown',
                    'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
                    'description'        => __( 'Select area color.', 'w9-floral-addon' ),
                    'std'                => 'p'
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => __( 'Custom color', 'w9-floral-addon' ),
                    'param_name'  => 'custom_color',
                    'description' => __( 'Select custom area color.', 'w9-floral-addon' ),
                    'dependency'  => array(
                        'element' => 'color',
                        'value'   => array( 'custom' ),
                    ),
                ),
            ),
            'callbacks'  => array(
                'after_add' => 'vcChartParamAfterAddCallback',
            ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Animation', 'w9-floral-addon' ),
            'description' => __( 'Select animation style.', 'w9-floral-addon' ),
            'param_name'  => 'animation',
            'value'       => getVcShared( 'animation styles' ),
            'std'         => 'easeinOutCubic',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-floral-addon' ),
            'param_name' => 'css',
            'group'      => __( 'Design Options', 'w9-floral-addon' ),
        ),
    ),
) );