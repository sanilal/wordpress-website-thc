<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-ctf7-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !floral_is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
    return;
}

$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
    foreach ( $cf7 as $cform ) {
        $contact_forms[$cform->post_title] = $cform->ID;
    }
} else {
    $contact_forms[__( 'No contact forms found', 'w9-floral-addon' )] = 0;
}

vc_map( array(
    'base'        => 'contact-form-7',
    'name'        => __( 'Contact Form 7', 'w9-floral-addon' ),
    'icon'        => 'w9 w9-ico-basic-mail-multiple',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Place Contact Form7', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Select contact form', 'w9-floral-addon' ),
            'param_name'  => 'id',
            'value'       => $contact_forms,
            'save_always' => true,
            'description' => __( 'Choose previously created contact form from the drop down list.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'checkbox',
            'heading'     => __( 'Use floating-tip style?', 'w9-floral-addon' ),
            'param_name'  => 'html_class',
            'admin_label' => true,
            'description' => __( 'Floating tip style.', 'w9-floral-addon' ),
            'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'use-floating-validation-tip' )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Search title', 'w9-floral-addon' ),
            'param_name'  => 'title',
            'admin_label' => true,
            'description' => __( 'Enter optional title to search if no ID selected or cannot find by ID.', 'w9-floral-addon' ),
        ),
    ),
) );