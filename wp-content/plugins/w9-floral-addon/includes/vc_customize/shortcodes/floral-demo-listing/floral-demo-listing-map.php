<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-counter-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'           => __( 'Floral Demo Listing', 'w9-floral-addon' ),
    'base'           => Floral_SC_Demo_Listing::SC_BASE,
    'class'          => '',
    'icon'           => 'w9 w9-ico-hotairballoon',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'description'    => __( 'Make couter group to count anything you want', 'w9-floral-addon' ),
    'php_class_name' => 'Floral_SC_Counter',
    'params'         => array(
        
        
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );