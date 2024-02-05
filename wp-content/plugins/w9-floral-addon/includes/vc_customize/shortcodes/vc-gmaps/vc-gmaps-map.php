<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-gmaps-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Google Maps', 'w9-floral-addon' ),
    'base'        => 'vc_gmaps',
    'icon'        => 'w9 w9-ico-basic-map',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Map block', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Widget title', 'w9-floral-addon' ),
            'param_name'  => 'title',
            'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textarea_safe',
            'heading'     => __( 'Map embed iframe', 'w9-floral-addon' ),
            'param_name'  => 'link',
            'value'       => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6304.829986131271!2d-122.4746968033092!3d37.80374752160443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586e6302615a1%3A0x86bd130251757c00!2sStorey+Ave%2C+San+Francisco%2C+CA+94129!5e0!3m2!1sen!2sus!4v1435826432051" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'description' => sprintf( __( 'Visit %s to create your map (Step by step: 1) Find location 2) Click the cog symbol in the lower right corner and select "Share or embed map" 3) On modal window select "Embed map" 4) Copy iframe code and paste it).' ), '<a href="https://www.google.com/maps" target="_blank">' . __( 'Google maps', 'w9-floral-addon' ) . '</a>' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Map height', 'w9-floral-addon' ),
            'param_name'  => 'size',
            'value'       => 'standard',
            'admin_label' => true,
            'description' => __( 'Enter map height (in pixels or leave empty for responsive map).', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => __( 'Color filter', 'w9-floral-addon' ),
            'param_name' => 'filter',
            'value'      => array(
                __( 'None', 'w9-floral-addon' )       => '',
                __( 'GrayScale', 'w9-floral-addon' )  => 'grayscale',
                __( 'Brightness', 'w9-floral-addon' ) => 'brightness',
                __( 'Sepia', 'w9-floral-addon' )      => 'sepia',
            ),
            'std'        => ''
        ),
        array(
            'type'       => 'slider',
            'heading'    => __( 'Filter value', 'w9-floral-addon' ),
            'param_name' => 'filter_value',
            'unit'       => '%',
            'min'        => '10',
            'max'        => '100',
            'step'       => '5',
            'std'        => '100%',
            'dependency' => array(
                'element'            => 'filter',
                'value_not_equal_to' => array( '' )
            )
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