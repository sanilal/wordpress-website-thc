<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-line-chart-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map(
    array(
        'name'        => __( 'Line Chart', 'w9-floral-addon' ),
        'base'        => 'vc_line_chart',
        'class'       => '',
        'icon'        => 'w9 w9-ico-ecommerce-graph3',
        'category'    => __( 'Content', 'w9-floral-addon' ),
        'description' => __( 'Line and Bar charts', 'w9-floral-addon' ),
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
                    __( 'Line', 'w9-floral-addon' ) => 'line',
                    __( 'Bar', 'w9-floral-addon' )  => 'bar',
                ),
                'std'         => 'bar',
                'description' => __( 'Select type of chart.', 'w9-floral-addon' ),
                'admin_label' => true,
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
                'type'        => 'textfield',
                'heading'     => __( 'X-axis values', 'w9-floral-addon' ),
                'param_name'  => 'x_values',
                'description' => __( 'Enter values for axis (Note: separate values with ";").', 'w9-floral-addon' ),
                'value'       => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
            ),
            array(
                'type'       => 'param_group',
                'heading'    => __( 'Values', 'w9-floral-addon' ),
                'param_name' => 'values',
                'value'      => urlencode( json_encode( array(
                    array(
                        'title'        => __( 'One', 'w9-floral-addon' ),
                        'y_values'     => '10; 15; 20; 25; 27; 25; 23; 25',
                        'custom_color' => '#666',
                    ),
                    array(
                        'title'        => __( 'Two', 'w9-floral-addon' ),
                        'y_values'     => '25; 18; 16; 17; 20; 25; 30; 35',
                        'custom_color' => '#999',
                    ),
                ) ) ),
                'params'     => array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => __( 'Title', 'w9-floral-addon' ),
                        'param_name'  => 'title',
                        'description' => __( 'Enter title for chart dataset.', 'w9-floral-addon' ),
                        'admin_label' => true,
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => __( 'Y-axis values', 'w9-floral-addon' ),
                        'param_name'  => 'y_values',
                        'description' => __( 'Enter values for axis (Note: separate values with ";").', 'w9-floral-addon' ),
                    ),
                    array(
                        'type'               => 'dropdown',
                        'heading'            => __( 'Color', 'w9-floral-addon' ),
                        'param_name'         => 'color',
                        'description'        => __( 'Select chart color.', 'w9-floral-addon' ),
                        'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
                        'param_holder_class' => 'vc_colored-dropdown',
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => __( 'Custom color', 'w9-floral-addon' ),
                        'param_name'  => 'custom_color',
                        'description' => __( 'Select custom chart color.', 'w9-floral-addon' ),
                        'dependency'  => array(
                            'element' => 'color',
                            'value'   => 'custom'
                        ),
                    ),
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
    )
);