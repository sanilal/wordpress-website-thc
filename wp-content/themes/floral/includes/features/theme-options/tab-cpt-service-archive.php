<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt-service-archive.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*-------------------------------------
	service CPT
---------------------------------------*/
$this->sections[] = array(
	'title'      => esc_html__( 'Service Archive', 'floral' ),
	'desc'       => esc_html__( 'Service Archive settings section.', 'floral' ),
	'icon'       => 'dashicons-before dashicons-share-alt',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'    => mt_rand(),
			'type'  => 'info',
			'title' => esc_html__( 'Template settings', 'floral' ),
		),
		array(
			'id'    => 'service-archive-template',
			'title' => esc_html__( 'Override default archive template', 'floral' ),
			'type'  => 'select',
			'data'  => 'pages',
		),
//		array(
//			'id'       => 'service-archive-display-type',
//			'type'     => 'select',
//			'title'    => esc_html__( 'Display type', 'floral' ),
//			'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
//			'desc'     => '',
//			'options'  => array(
//				'grid'    => esc_html__( 'Grid', 'floral' ),
//				'masonry' => esc_html__( 'Masonry', 'floral' ),
//			),
//			'default'  => 'masonry',
//			'validate' => 'not_empty'
//		),
		
		array(
			'id'    => 'service-booking-page',
			'title' => esc_html__( 'Booking page', 'floral' ),
			'subtitle' => esc_html__( 'Enter booking/reservation link here', 'floral' ),
			'type'  => 'text',
//			'data'  => 'pages',
		),
		
		array(
			'id'       => 'service-show-booking-btn',
			'type'     => 'switch',
			'title'    => esc_html__( 'Show booking button ?', 'floral' ),
//			'subtitle' => esc_html__( 'Smooth animation when scrolling the page.', 'floral' ),
			'desc'     => '',
			'default'  => 1
		),
		
		array(
			'id'       => 'service-booking-btn-tx',
			'type'     => 'text',
			'title'    => esc_html__( 'Booking Button Text', 'floral' ),
			'subtitle' => esc_html__( 'Set the text for booking button.', 'floral' ),
			'default'  => 'BOOK NOW',
//			'validate' => 'numeric'
		),
		
		array(
			'id'       => 'service-archive-display-type',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Display type', 'floral' ),
			'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'grid'    => esc_html__( 'Grid', 'floral' ),
				'masonry' => esc_html__( 'Masonry', 'floral' ),
			),
			'default'  => 'masonry',
//			'validate' => 'not_empty'
		),
		
		array(
			'id'       => 'service-archive-display-columns',
			'type'     => 'select',
			'title'    => esc_html__( 'Display columns', 'floral' ),
			'subtitle' => esc_html__( 'Choose the number of columns to display on archive pages.', 'floral' ),
			'options'  => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6',
			),
			'desc'     => esc_html__( 'Note: 6 columns available when screen bigger than 1600px, and should use layout container-xlg or larger.', 'floral' ),
			'default'  => '3',
//			'required' => array( 'service-archive-display-type', '=', array( 'masonry', 'grid' ) ),
		),
		
		array(
			'id'       => 'service-archive-gutter',
			'type'     => 'select',
			'title'    => esc_html__( 'Service columns spacing', 'floral' ),
			'subtitle' => esc_html__( 'Spacing between service columns.', 'floral' ),
			'options'  => array(
				'0'  => '0px',
				'1'  => '1px',
				'2'  => '2px',
				'3'  => '3px',
				'4'  => '4px',
				'5'  => '5px',
				'10' => '10px',
				'15' => '15px',
				'20' => '20px',
				'25' => '25px',
				'30' => '30px',
				'35' => '35px',
				'40' => '40px',
				'45' => '45px',
				'50' => '50px',
				'55' => '55px',
				'60' => '60px',
			),
			'default'  => '30'
		),
		
		array(
			'id'       => 'service-archive-filter-enable',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable filter', 'floral' ),
			'subtitle' => esc_html__( 'Enable page filter.', 'floral' ),
			'default'  => true,
			'required' => array( 'service-archive-display-type', '=', array( 'masonry', 'grid' ) ),
		),
		
		array(
			'id'       => 'service-archive-filter-align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Filter align', 'floral' ),
			'options'  => array(
				'text-left'   => esc_html__( 'Left', 'floral' ),
				'text-center' => esc_html__( 'Center', 'floral' ),
				'text-right'  => esc_html__( 'Right', 'floral' ),
			),
			'default'  => 'text-center',
			'required' => array( 'service-archive-filter-enable', '=', array( true ) ),
		),
		
		array(
			'id'       => 'service-archive-items-per-page',
			'type'     => 'text',
			'title'    => esc_html__( 'Items per page', 'floral' ),
			'subtitle' => esc_html__( 'Default value is 8.', 'floral' ),
			'default'  => '8',
			'validate' => 'numeric'
		),
		
		array(
			'id'       => 'service-archive-paging-type',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Paging type', 'floral' ),
			'subtitle' => esc_html__( 'Select archive paging type.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'default'         => esc_html__( 'Default', 'floral' ),
				'load-more'       => esc_html__( 'Load More', 'floral' ),
				'infinite-scroll' => esc_html__( 'Infinite Scroll', 'floral' )
			),
			'default'  => 'default'
		),
		
		array(
			'id'             => 'service-archive-margin',
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
				'margin-bottom' => '55px',
				'units'         => 'px',
			),
			'output'         => array( '.site-main-archive.service-archive' )
		),
	
		//Image ratio
		array(
			'id'      => 'service-archive-item-image-ratio',
			'type'    => 'select',
			'title'   => esc_html__( 'Image Ratio', 'floral' ),
			'options' => array(
				'auto'          => esc_html__( 'Auto', 'floral' ),
				'0.5625'        => '16x9',
				'1.77777777778' => '9x16',
				'0.42857142857' => '21x9',
				'2.33333333333' => '9x21',
				'0.75'          => '4x3',
				'1.33333333333' => '3x4',
				'0.666666667'   => '3x2',
				'1.5'           => '2x3',
				'1'             => '1x1',
				'2'             => '1x2',
				'0.5'           => '2x1',
			),
			'default' => '0.666666667'
		),
		
		array(
			'id'    => mt_rand(),
			'type'  => 'info',
			'title' => esc_html__( 'Layout Settings', 'floral' ),
		),
		
		array(
			'id'       => 'service-archive-layout',
			'type'     => 'select',
			'title'    => esc_html__( 'Layout', 'floral' ),
			'subtitle' => esc_html__( 'Select archive layout.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'fullwidth'       => esc_html__( 'Full Width', 'floral' ),
				'container'       => esc_html__( 'Container', 'floral' ),
				'container-xlg'   => esc_html__( 'Container Extended', 'floral' ),
				'container-fluid' => esc_html__( 'Container Fluid', 'floral' )
			),
			'default'  => 'container',
			'validate' => 'not_empty'
		),
		
		array(
			'id'       => 'service-archive-widget-title-style',
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
			'id'       => 'service-archive-sidebar',
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
			'id'       => 'service-archive-sidebar-width',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar width', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'small' => esc_html__( 'Small (1/4)', 'floral' ),
				'large' => esc_html__( 'Large (1/3)', 'floral' )
			),
			'default'  => 'small',
			'required' => array( 'service-archive-sidebar', '=', array( 'left', 'both', 'right' ) ),
		),
		
		array(
			'id'       => 'service-archive-sidebar-left',
			'type'     => 'select',
			'title'    => esc_html__( 'Left sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'service-archive-sidebar', '=', array( 'left', 'both' ) ),
		),
		
		array(
			'id'       => 'service-archive-sidebar-right',
			'type'     => 'select',
			'title'    => esc_html__( 'Right sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-2',
			'required' => array( 'service-archive-sidebar', '=', array( 'right', 'both' ) ),
		),
	),
);