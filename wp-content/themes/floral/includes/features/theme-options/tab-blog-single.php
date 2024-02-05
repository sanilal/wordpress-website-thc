<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-blog-single.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$this->sections[] = array(
	'title'      => esc_html__( 'Blog Single', 'floral' ),
	'desc'       => esc_html__( 'Single blog settings.', 'floral' ),
	'icon'       => 'el el-file',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'blog-single-post-meta',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Meta', 'floral' ),
			'subtitle' => esc_html__( 'Disable or enable meta options.', 'floral' ),
			'options'  => array(
				'date'         => esc_html__( 'Date', 'floral' ),
				'categories'   => esc_html__( 'Categories', 'floral' ),
				'tags'         => esc_html__( 'Tags', 'floral' ),
				'comments'     => esc_html__( 'Comments', 'floral' ),
				'social-share' => esc_html__( 'Social Share', 'floral' ),
			),
			'default'  => array(
				'date'         => 1,
				'categories'   => 1,
				'tags'         => 1,
				'comments'     => 1,
				'social-share' => 1,
			),
		),
		array(
			'id'       => 'blog-single-post-navigation',
			'type'     => 'switch',
			'title'    => esc_html__( 'Show post navigation', 'floral' ),
			'subtitle' => esc_html__( 'Enable/disable post navigation.', 'floral' ),
			'desc'     => '',
			'default'  => '1'
		),
		
		array(
			'id'       => 'blog-single-author-info',
			'type'     => 'switch',
			'title'    => esc_html__( 'Show author info', 'floral' ),
			'subtitle' => esc_html__( 'Enable/disable author info.', 'floral' ),
			'desc'     => '',
			'default'  => '1'
		),
		
		array(
			'id'       => 'blog-single-resize-image',
			'type'     => 'switch',
			'title'    => esc_html__( 'Resize post featured image', 'floral' ),
			'subtitle' => esc_html__( 'Resize post featured image or not?', 'floral' ),
			'default'  => '1'
		),
		
		array(
			'id'             => 'blog-single-margin',
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
				'margin-top'    => '0px',
				'margin-bottom' => '80px',
				'units'         => 'px',
			),
			'output'         => array( '.site-main-single' )
		),
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => esc_html__( 'Layout Settings', 'floral' ),
		),
		
		array(
			'id'       => 'blog-single-layout',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Layout', 'floral' ),
			'subtitle' => esc_html__( 'Select single blog layout.', 'floral' ),
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
			'id'       => 'blog-single-widget-title-style',
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
			'id'       => 'blog-single-sidebar',
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
			'default'  => 'right'
		),
		
		array(
			'id'       => 'blog-single-sidebar-width',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar width', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'small' => esc_html__( 'Small (1/4)', 'floral' ),
				'large' => esc_html__( 'Large (1/3)', 'floral' )
			),
			'default'  => 'large',
			'required' => array( 'blog-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
		),
		
		
		array(
			'id'       => 'blog-single-sidebar-left',
			'type'     => 'select',
			'title'    => esc_html__( 'Left sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'blog-single-sidebar', '=', array( 'left', 'both' ) ),
		),
		
		array(
			'id'       => 'blog-single-sidebar-right',
			'type'     => 'select',
			'title'    => esc_html__( 'Right sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'blog-single-sidebar', '=', array( 'right', 'both' ) ),
		),
	)
);