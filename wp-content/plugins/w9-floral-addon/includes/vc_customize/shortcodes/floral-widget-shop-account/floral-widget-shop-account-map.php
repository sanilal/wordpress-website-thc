<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-widget-shop-account-map.php
 * @time    : 10/7/2016 3:44 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map(
	array(
		'name'           => esc_html__( 'Floral Widget Shop Account', 'w9-floral-addon' ),
		'base'           => Floral_SC_Widget_Shop_Account::SC_BASE,
		'icon'           => 'w9 w9-ico-profile-male',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Widget_Shop_Account',
		'description'    => __( 'Widget for WooCommerce "my account"', 'w9-floral-addon' ),
		'params'         => array_merge( array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => __( 'Widget title', 'w9-floral-addon' ),
				'description' => __( 'What text use as a widget title. Leave blank if you don\' want to show the widget title.', 'w9-floral-addon' ),
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'module_type',
				'heading'    => __( 'Module type', 'w9-floral-addon' ),
				'value'      => array(
					__( 'Link', 'w9-floral-addon' )  => 'link',
					__( 'Popup', 'w9-floral-addon' ) => 'popup',
				),
				'std'        => 'link'
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'link_to',
				'heading'    => __( 'Link to', 'w9-floral-addon' ),
				'value'      => array(
					__( 'Link to "My account" page', 'w9-floral-addon' ) => 'my-account',
					__( 'Custom link', 'w9-floral-addon' )               => 'custom',
				),
				'dependency' => array(
					'element' => 'module_type',
					'value'   => 'link'
				),
				'std'        => 'my-account'
			),
			
			array(
				'type'       => 'textfield',
				'param_name' => 'custom_link',
				'heading'    => __( 'Custom link', 'w9-floral-addon' ),
				'dependency' => array(
					'element' => 'link_to',
					'value'   => 'custom'
				),
				'std'        => ''
			),
		), Floral_Map_Helpers::widget_common_params() )
	)
);