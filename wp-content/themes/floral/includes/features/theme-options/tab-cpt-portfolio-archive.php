<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt-portfolio-archive.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*-------------------------------------
	PORTFOLIO CPT
---------------------------------------*/
$this->sections[] = array(
	'title'      => esc_html__( 'Portfolio Archive', 'floral' ),
	'desc'       => esc_html__( 'Portfolio Archive settings section.', 'floral' ),
	'icon'       => 'dashicons-before dashicons-awards',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'    => mt_rand(),
			'type'  => 'info',
			'title' => esc_html__( 'Template settings', 'floral' ),
		),
		array(
			'id'    => 'portfolio-archive-template',
			'title' => esc_html__( 'Override default archive template', 'floral' ),
			'type'  => 'select',
			'data'  => 'pages',
		),
		array(
			'id'       => 'portfolio-archive-display-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Display type', 'floral' ),
			'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'grid'    => esc_html__( 'Grid', 'floral' ),
				'masonry' => esc_html__( 'Masonry', 'floral' ),
			),
			'default'  => 'grid',
			'validate' => 'not_empty'
		),
		
		array(
			'id'       => 'portfolio-archive-display-columns',
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
			'default'  => '4',
			'required' => array( 'portfolio-archive-display-type', '=', array( 'masonry', 'grid' ) ),
		),
		
		array(
			'id'       => 'portfolio-archive-gutter',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio columns spacing', 'floral' ),
			'subtitle' => esc_html__( 'Spacing between portfolio columns.', 'floral' ),
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
			'id'       => 'portfolio-archive-filter-enable',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable filter', 'floral' ),
			'subtitle' => esc_html__( 'Enable page filter.', 'floral' ),
			'default'  => true,
			'required' => array( 'portfolio-archive-display-type', '=', array( 'masonry', 'grid' ) ),
		),
		
		array(
			'id'       => 'portfolio-archive-filter-align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Filter align', 'floral' ),
			'options'  => array(
				'text-left'   => esc_html__( 'Left', 'floral' ),
				'text-center' => esc_html__( 'Center', 'floral' ),
				'text-right'  => esc_html__( 'Right', 'floral' ),
			),
			'default'  => 'text-left',
			'required' => array( 'portfolio-archive-filter-enable', '=', array( true ) ),
		),
		
		array(
			'id'       => 'portfolio-archive-items-per-page',
			'type'     => 'text',
			'title'    => esc_html__( 'Items per page', 'floral' ),
			'subtitle' => esc_html__( 'Default value is 8.', 'floral' ),
			'default'  => '8',
			'validate' => 'numeric'
		),
		
		array(
			'id'       => 'portfolio-archive-paging-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Paging style', 'floral' ),
			'subtitle' => esc_html__( 'Select archive paging style.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'default'         => esc_html__( 'Default', 'floral' ),
				'load-more'       => esc_html__( 'Load More', 'floral' ),
				'infinite-scroll' => esc_html__( 'Infinite Scroll', 'floral' )
			),
			'default'  => 'infinite-scroll'
		),
		
		array(
			'id'             => 'portfolio-archive-margin',
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
				'margin-bottom' => '80px',
				'units'         => 'px',
			),
			'output'         => array( '.site-main-archive.portfolio-archive' )
		),
		
		array(
			'id'    => mt_rand(),
			'type'  => 'info',
			'title' => esc_html__( 'Item Design', 'floral' ),
		),
		
		//Item type
		array(
			'id'       => 'portfolio-archive-item-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Archive item type', 'floral' ),
			'subtitle' => esc_html__( 'Select archive item type.', 'floral' ),
			'desc'     => esc_html__( 'Note: Classic Horizontal layout can be change to Classic Vertical when columns with too small', 'floral' ),
			'options'  => array(
				'simple'            => esc_html__( 'Simple', 'floral' ),
				'overlay'            => esc_html__( 'Overlay', 'floral' ),
				'classic-vertical'   => esc_html__( 'Classic Vertical', 'floral' ),
				'classic-horizontal' => esc_html__( 'Classic Horizontal', 'floral' ),
			),
			'default'  => 'simple',
			'validate' => 'not_empty'
		),
		
		
		array(
			'id'       => 'portfolio-archive-item-separator',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Enable separator between portfolio item', 'floral' ),
			'subtitle' => esc_html__( 'Enable separator between portfolio item.', 'floral' ),
			'options'  => array(
				'on'  => esc_html__( 'On', 'floral' ),
				'off' => esc_html__( 'Off', 'floral' ),
			),
			'default'  => 'on',
			'required' => array(
				array( 'portfolio-archive-item-type', '!=', 'overlay' ),
				array( 'portfolio-archive-item-type', '!=', 'simple' ),
			),
		),
		
		//Overlay color
		array(
			'id'       => 'portfolio-archive-item-color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Portolfio item color', 'floral' ),
			'subtitle' => esc_html__( 'Choose portfolio color.', 'floral' ),
			'default'  => array(
				'color' => '#ffffff',
				'alpha' => '1',
			),
			'required' => array(
				'portfolio-archive-item-type',
				'=',
				'overlay'
			)
		),
		array(
			'id'       => 'portfolio-archive-item-overlay-color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Portolfio item overlay color', 'floral' ),
			'subtitle' => esc_html__( 'Choose portfolio overlay color.', 'floral' ),
			'default'  => array(
				'color' => '#000000',
				'alpha' => '0.8',
			),
			'required' => array(
				'portfolio-archive-item-type',
				'=',
				'overlay'
			)
		),
		
		array(
			'id'             => 'portfolio-archive-item-overlay-offset',
			'type'           => 'spacing',
			'output'         => array( '.floral-portfolio-overlay-default .entry-content' ),
			'mode'           => 'padding',
			'units'          => 'px',
			'all'            => true,
			'units_extended' => 'false',
			'title'          => esc_html__( 'Overlay offset', 'floral' ),
			'subtitle'       => esc_html__( 'Choose portfolio overlay offset in px.', 'floral' ),
			'default'        => array(
				'padding' => '30px',
				'units'   => 'px',
			),
			
			'required' => array(
				'portfolio-archive-item-type',
				'=',
				'overlay'
			)
		),
		
		//Overlay Effect
		array(
			'id'       => 'portfolio-archive-item-overlay-effect',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio overlay appear effect', 'floral' ),
			'subtitle' => esc_html__( 'Choose overlay appear effect', 'floral' ),
			'options'  => array(
				'none'                       => esc_html__( 'None', 'floral' ),
				'__hoverdir'                 => esc_html__( 'Hover Dir', 'floral' ),
				'__animation-fade-in'        => esc_html__( 'Fade In', 'floral' ),
				'__animation-fade-in-left'   => esc_html__( 'Fade In Left', 'floral' ),
				'__animation-fade-in-right'  => esc_html__( 'Fade In Right', 'floral' ),
				'__animation-fade-in-top'    => esc_html__( 'Fade In Top', 'floral' ),
				'__animation-fade-in-bottom' => esc_html__( 'Fade In Bottom', 'floral' ),
				'__animation-zoom-in'        => esc_html__( 'Zoom In', 'floral' ),
				'__animation-flip-in-x'      => esc_html__( 'Flip In X', 'floral' ),
				'__animation-flip-in-y'      => esc_html__( 'Flip In Y', 'floral' ),
			),
			'default'  => '__hoverdir',
			'required' => array(
				'portfolio-archive-item-type',
				'=',
				'overlay'
			)
		),
		
		// Show Title
		array(
			'id'       => 'portfolio-archive-show-title',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Show item title ?', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'yes'         => esc_html__( 'Yes', 'floral' ),
				'no'       => esc_html__( 'No', 'floral' ),
			),
			'required' => array(
				array( 'portfolio-archive-item-type', '=', 'simple' ),
			),
			'default'  => 'yes'
		),
		
		//Image ratio
		array(
			'id'      => 'portfolio-archive-item-image-ratio',
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
			'id'       => 'portfolio-archive-layout',
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
			'id'       => 'portfolio-archive-sidebar',
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
			'id'       => 'portfolio-archive-sidebar-width',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar width', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'small' => esc_html__( 'Small (1/4)', 'floral' ),
				'large' => esc_html__( 'Large (1/3)', 'floral' )
			),
			'default'  => 'small',
			'required' => array( 'portfolio-archive-sidebar', '=', array( 'left', 'both', 'right' ) ),
		),
		
		array(
			'id'       => 'portfolio-archive-sidebar-left',
			'type'     => 'select',
			'title'    => esc_html__( 'Left sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'portfolio-archive-sidebar', '=', array( 'left', 'both' ) ),
		),
		
		array(
			'id'       => 'portfolio-archive-sidebar-right',
			'type'     => 'select',
			'title'    => esc_html__( 'Right sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-2',
			'required' => array( 'portfolio-archive-sidebar', '=', array( 'right', 'both' ) ),
		),
	),
);