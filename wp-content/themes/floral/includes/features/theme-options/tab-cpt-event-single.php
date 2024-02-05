<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: tab-cpt-event-single.php
 * @time    : 4/25/2017 4:26 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


/*-------------------------------------\
	SERVICE CPT
---------------------------------------*/
$this->sections[] = array(
	'title'      => esc_html__( 'Event Single', 'floral' ),
	'desc'       => esc_html__( 'Event Single settings section.', 'floral' ),
	'icon'       => 'dashicons-before dashicons-calendar-alt',
	'subsection' => true,
	'fields'     => array(
//		array(
//			'id' => 'event-single-default-content',
//			'type' => 'button_set',
//			'title' => esc_html__('Default Content', 'floral'),
//			'subtitle' => sprintf(__('Use event single default content if default content of event single is not set.<br>You can set single event content <a href="%s" target="_blank">here</a>', 'floral'), admin_url('admin.php?page=vc-general')),
//			'options' => array(
//				'on' => esc_html__('On', 'floral'),
//				'off' => esc_html__('Off', 'floral'),
//			),
//			'default' => 'on'
//		),
		array(
			'id'       => 'event-single-feature-image',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable feature image ?', 'floral' ),
//			'subtitle' => esc_html__( 'Enable event item header.', 'floral' ),
			'default'  => 0
		),
		array(
			'id'       => 'event-single-post-meta',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Meta', 'floral' ),
			'subtitle' => esc_html__( 'Disable or enable meta options.', 'floral' ),
			'options'  => array(
				'date'       => esc_html__( 'Date', 'floral' ),
				'categories' => esc_html__( 'Categories', 'floral' ),
				'comments'   => esc_html__( 'Comments', 'floral' ),
				'social-share' => esc_html__( 'Social Share', 'floral' ),
			),
			'default'  => array(
				'date'       => 1,
				'categories' => 1,
				'comments'   => 1,
				'social-share' => 1,
			),
		),
		array(
			'id'             => 'event-single-margin',
			'type'           => 'spacing',
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Margin top/bottom', 'floral' ),
			'subtitle'       => esc_html__( 'This must be numeric (no px). Leave blank for default.', 'floral' ),
			'desc'           => esc_html__( 'If you would like to override the default footer top/bottom margin, then you can do so here.', 'floral' ),
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'margin-top'    => '0',
				'margin-bottom' => '0',
				'units'         => 'px',
			),
			'output'         => array( '.site-main-single.event-single' )
		),
		
//		array(
//			'id'       => 'event-single-navigator-enabled',
//			'type'     => 'switch',
//			'title' => esc_html__('Navigator enabled', 'floral'),
//			'subtitle' => esc_html__('Enable navigator bottom of single page.', 'floral'),
//			'default' => false
//		),
		
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => esc_html__('Layout Settings', 'floral')
		),
		
		array(
			'id'       => 'event-single-layout',
			'type'     => 'select',
			'title'    => esc_html__( 'Layout', 'floral' ),
			'subtitle' => esc_html__( 'Select single event layout.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'fullwidth'       => esc_html__( 'Full Width', 'floral' ),
				'container'       => esc_html__( 'Container', 'floral' ),
				'container-xlg'   => esc_html__( 'Container Extended', 'floral' ),
				'container-fluid' => esc_html__( 'Container Fluid', 'floral' )
			),
			'default'  => 'container'
		),
		
		array(
			'id'       => 'event-single-widget-title-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Widget title style', 'floral' ),
			'subtitle' => esc_html__( 'Select widget title style. If this field is set to default, the same one on "General Tab" will take control', 'floral' ),
			'desc'     => '',
			'options'  => array(
				''        => esc_html__( 'Default', 'floral' ),
				'style-1' => esc_html__( 'Style 1', 'floral' ),
				'style-2' => esc_html__( 'Style 2', 'floral' ),
			),
			'default'  => ''
		),
		
		array(
			'id'       => 'event-single-sidebar',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar style.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'none'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-none.png' ),
				'left'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-left.png' ),
				'right' => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-right.png' ),
				'both'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-both.png' ),
			),
			'default'  => 'none'
		),
		
		array(
			'id'       => 'event-single-sidebar-width',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar width', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'small' => esc_html__( 'Small (1/4)', 'floral' ),
				'large' => esc_html__( 'Large (1/3)', 'floral' )
			),
			'default'  => 'small',
			'required' => array( 'event-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
		),
		
		array(
			'id'       => 'event-single-sidebar-left',
			'type'     => 'select',
			'title'    => esc_html__( 'Left sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'event',
			'required' => array( 'event-single-sidebar', '=', array( 'left', 'both' ) ),
		),
		
		array(
			'id'       => 'event-single-sidebar-right',
			'type'     => 'select',
			'title'    => esc_html__( 'Right sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'event',
			'required' => array( 'event-single-sidebar', '=', array( 'right', 'both' ) ),
		),
	),
);