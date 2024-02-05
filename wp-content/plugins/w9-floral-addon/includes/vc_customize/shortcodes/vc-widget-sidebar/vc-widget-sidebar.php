<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-widget-sidebar.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Widgetised Sidebar', 'w9-floral-addon' ),
    'base'        => 'vc_widget_sidebar',
    'class'       => 'wpb_widget_sidebar_widget',
    'icon'        => 'w9 w9-ico-ecommerce-receipt',
    'category'    => __( 'Structure', 'w9-floral-addon' ),
    'description' => __( 'WordPress widgetised sidebar', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'        => 'widgetised_sidebars',
            'heading'     => __( 'Sidebar', 'w9-floral-addon' ),
            'param_name'  => 'sidebar_id',
            'admin_label' => true,
            'description' => __( 'Select widget area to display.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
        ),
        /*-------------------------------------
    	DESIGN OPTIONS
        ---------------------------------------*/
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile(),
        /*-------------------------------------
        	ANIMATIONS
        ---------------------------------------*/
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay(),
    ),
) );