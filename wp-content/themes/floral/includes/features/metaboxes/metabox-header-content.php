<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: metabox-header-content.php
 * @time    : 5/16/2017 7:31 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$sections[] = array(
	'title'  => esc_html__( 'Header Content', 'floral' ),
	'desc'   => esc_html__( 'Modify the content of the header.', 'floral' ),
	'icon'   => 'el el-puzzle',
	'fields' => array(
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => esc_html__( 'Header Content Settings', 'floral' ),
		),
		
		array(
			'id'       => 'meta-nav-module-desktop-custom',
			'type'     => 'switch',
			'title'    => esc_html__( 'Custom nav module in desktop?', 'floral' ),
			'default'  => 0,
		),
		
		array(
			'id'      => 'meta-nav-module-desktop',
			'type'    => 'sorter',
			'title'   => esc_html__( 'Nav module in desktop', 'floral' ),
			'desc'    => esc_html__( 'Select nav module appear in normal desktop nav, you also use this for sorter position of module in nav.', 'floral' ),
			'options' => array(
				'enabled'  => array(
					'logo'      => esc_html__( 'Logo', 'floral' ),
					'main-menu' => esc_html__( 'Main Menu', 'floral' ),
					'search'    => esc_html__( 'Search', 'floral' ),
					'cart'      => esc_html__( 'Cart', 'floral' ),
				),
				'disabled' => array(
					'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
					'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
					'popup'            => esc_html__( 'Popup', 'floral' ),
					'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
				)
			),
			'required' => array( 'meta-nav-module-desktop-custom', '=', array( 1 ) ),
		),
		
		array(
			'id'       => 'meta-nav-module-desktop-sticky-custom',
			'type'     => 'switch',
			'title'    => esc_html__( 'Custom sticky nav module in desktop?', 'floral' ),
			'default'  => 0,
		),
		
		array(
			'id'       => 'meta-nav-module-desktop-sticky',
			'type'     => 'sorter',
			'title'    => esc_html__( 'Nav module in desktop sticky nav', 'floral' ),
			'subtitle' => esc_html__( 'Select nav module appear in sticky nav in desktop screen, you also use this for sorter position of module in nav.', 'floral' ),
			'options'  => array(
				'enabled'  => array(
					'logo'      => esc_html__( 'Logo', 'floral' ),
					'main-menu' => esc_html__( 'Main Menu', 'floral' ),
					'search'    => esc_html__( 'Search', 'floral' ),
					'cart'      => esc_html__( 'Cart', 'floral' ),
				),
				'disabled' => array(
					'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
					'popup'            => esc_html__( 'Popup', 'floral' ),
					'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
					'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
				)
			),
			'required' => array( 'meta-nav-module-desktop-sticky-custom', '=', array( 1 ) ),
		),
		
		array(
			'id'       => 'meta-nav-module-mobile-custom',
			'type'     => 'switch',
			'title'    => esc_html__( 'Custom nav module in mobile?', 'floral' ),
			'default'  => 0,
		),
		
		array(
			'id'      => 'meta-nav-module-mobile',
			'type'    => 'sorter',
			'title'   => esc_html__( 'Nav module in mobile', 'floral' ),
			'desc'    => esc_html__( 'Select nav module appear in sticky nav in desktop screen, you also use this for sorter position of module in nav.', 'floral' ),
			'options' => array(
				'enabled'  => array(
					'logo'            => esc_html__( 'Logo', 'floral' ),
					'toggle-leftzone' => esc_html__( 'Toggle Left Zone', 'floral' ),
				),
				'disabled' => array(
					'search'           => esc_html__( 'Search', 'floral' ),
					'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
					'cart'             => esc_html__( 'Cart', 'floral' ),
					'popup'            => esc_html__( 'Popup', 'floral' ),
					'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
				)
			),
			'required' => array( 'meta-nav-module-mobile-custom', '=', array( 1 ) ),
		),
		
		array(
			'id'      => 'meta-nav-module-desktop-biggest',
			'type'    => 'select',
			'title'   => esc_html__( 'Biggest module in desktop screen', 'floral' ),
			'desc'     => esc_html__( 'Leave empty mean use this setting from "Theme Options".', 'floral' ),
			'options' => array(
				''                        => esc_html__( 'Default', 'floral' ),
				'logo'             => esc_html__( 'Logo', 'floral' ),
				'main-menu'        => esc_html__( 'Main Menu', 'floral' ),
				'cart'             => esc_html__( 'Cart', 'floral' ),
				'search'           => esc_html__( 'Search', 'floral' ),
				'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
				'popup'            => esc_html__( 'Popup', 'floral' ),
				'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
				'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
			),
			'default' => ''
		),
		
		array(
			'id'      => 'meta-nav-module-desktop-biggest-align',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Biggest module in desktop screen align', 'floral' ),
			'options' => array(
				''    => esc_html__( 'Default', 'floral' ),
				'nav-item-desktop-left'   => esc_html__( 'Left', 'floral' ),
				'nav-item-desktop-center' => esc_html__( 'Center', 'floral' ),
				'nav-item-desktop-right'  => esc_html__( 'Right', 'floral' ),
			),
			'default' => ''
		),
		
		array(
			'id'      => 'meta-nav-module-mobile-biggest',
			'type'    => 'select',
			'title'   => esc_html__( 'Biggest module in mobile screen', 'floral' ),
			'desc'     => esc_html__( 'Leave empty mean use this setting from "Theme Options".', 'floral' ),
			'options' => array(
				''                        => esc_html__( 'Default', 'floral' ),
				'logo'             => esc_html__( 'Logo', 'floral' ),
				'cart'             => esc_html__( 'Cart', 'floral' ),
				'search'           => esc_html__( 'Search', 'floral' ),
				'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
				'popup'            => esc_html__( 'Popup', 'floral' ),
				'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
				'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
			),
			'default' => '',
		),
		
		array(
			'id'      => 'meta-nav-module-mobile-biggest-align',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Biggest module in mobile screen align', 'floral' ),
			'options' => array(
				''    => esc_html__( 'Default', 'floral' ),
				'nav-item-mobile-left'   => esc_html__( 'Left', 'floral' ),
				'nav-item-mobile-center' => esc_html__( 'Center', 'floral' ),
				'nav-item-mobile-right'  => esc_html__( 'Right', 'floral' ),
			),
			'default' => ''
		),
		
		array(
			'id'       => 'meta-nav-custom-content',
			'type'     => 'textarea',
			'title'    => esc_html__( 'Custom content', 'floral' ),
			'subtitle' => esc_html__( 'Define your custom Content to nav module "Custom Content".', 'floral' ),
			'desc'     => esc_html__( 'Content can be raw HTML, shortcode string or mix of them.', 'floral' ),
			'default'  => ''
		)

	
	) // #fields
);