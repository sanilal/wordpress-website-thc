<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-mailchimp-signup-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'           => esc_html__( 'Floral Mailchimp Signup Form', 'w9-floral-addon' ),
    'base'           => Floral_Mailchimp_Signup::SC_BASE,
    'class'          => '',
    'icon'           => 'w9 w9-ico-basic-mail-open-text',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'description'    => __('Show the mailchimp signup form', 'w9-floral-addon' ),
    'php_class_name' => 'Floral_Mailchimp_Signup',
    'params'         => array(
//        array(
//            'type'        => 'textfield',
//            'heading'     => esc_html__( 'Title', 'w9-floral-addon' ),
//            'param_name'  => 'title',
//            'admin_label' => true,
//            'value'       => '',
//        ),
	    Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );