<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-pie-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Pie Chart', 'w9-sprig-addon' ),
    'base'        => 'vc_pie',
    'class'       => '',
    'icon'        => 'w9 w9-ico-ecommerce-graph1',
    'category'    => __( 'Content', 'w9-sprig-addon' ),
    'description' => __( 'Animated pie chart', 'w9-sprig-addon' ),
    'params'      => array(
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Widget title', 'w9-sprig-addon' ),
            'param_name'  => 'title',
            'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-sprig-addon' ),
            'admin_label' => true,
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Value', 'w9-sprig-addon' ),
            'param_name'  => 'value',
            'description' => __( 'Enter value for graph (Note: choose range from 0 to 100).', 'w9-sprig-addon' ),
            'value'       => '50',
            'admin_label' => true,
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Label value', 'w9-sprig-addon' ),
            'param_name'  => 'label_value',
            'description' => __( 'Enter label for pie chart.', 'w9-sprig-addon' ),
//            'description' => __( 'Enter label for pie chart (Note: leaving empty will set value from "Value" field).', 'w9-sprig-addon' ),
            'value'       => '',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Units', 'w9-sprig-addon' ),
            'param_name'  => 'units',
            'description' => __( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'w9-sprig-addon' ),
        ),
	
	    array(
		    'type'             => 'number',
		    'heading'          => esc_html__( 'Border width', 'w9-floral-addon' ),
		    'param_name'       => 'border_width',
		    'value'            => '10',
		    'description'      => esc_html__( 'Set the pie chart border width (Unit: px). If this field is blank or 0, the value will be set to 10', 'w9-floral-addon' ),
	    ),
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Color', 'w9-sprig-addon' ),
            'param_name'         => 'color',
            'value'              => array_merge( Floral_Map_Helpers::get_just_colors(), array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ) ),
            'description'        => __( 'Select pie chart color.', 'w9-sprig-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'admin_label'        => true,
            'std'                => 'p',
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Custom color', 'w9-sprig-addon' ),
            'param_name'  => 'custom_color',
            'description' => __( 'Select custom color.', 'w9-sprig-addon' ),
            'dependency'  => array(
                'element' => 'color',
                'value'   => array( 'custom' ),
            ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-sprig-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-sprig-addon' ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-sprig-addon' ),
            'param_name' => 'css',
            'group'      => __( 'Design Options', 'w9-sprig-addon' ),
        ),
    ),
) );