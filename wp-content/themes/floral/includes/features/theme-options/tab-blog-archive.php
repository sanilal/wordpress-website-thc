<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-blog-archive.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$this->sections[] = array(
	'title'  => esc_html__( 'Blog Settings', 'floral' ),
	'desc'   => esc_html__( 'Archive settings.', 'floral' ),
	'icon'   => 'el el-list-alt',
	'fields' => array()
);

$this->sections[] = array(
	'title'      => esc_html__( 'Blog Archive', 'floral' ),
	'desc'       => esc_html__( 'Archive settings.', 'floral' ),
	'icon'       => 'el el-folder-close',
	'subsection' => true,
	'fields'     => array(
		
		//---s
//	    array(
//		    'id'       => 'blog-archive-display-type',
//		    'type'     => 'select',
//		    'title'    => esc_html__( 'Display type', 'floral' ),
//		    'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
//		    'desc'     => '',
//		    'options'  => array(
//			    'classic' => esc_html__( 'Classic', 'floral' ),
//			    'grid'    => esc_html__( 'Grid', 'floral' ),
//			    'masonry' => esc_html__( 'Masonry', 'floral' ),
//		    ),
//		    'default'  => 'classic',
//		    'validate' => 'not_empty'
//	    ),
		array(
			'id'       => 'blog-archive-display-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Display type', 'floral' ),
			'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'wide'    => esc_html__( 'Wide', 'floral' ),
				'grid'    => esc_html__( 'Grid', 'floral' ),
				'masonry' => esc_html__( 'Masonry', 'floral' ),
			),
			'default'  => 'wide',
			'validate' => 'not_empty'
		),
		//---e
		
		// display style (type wide only)
		array(
			'id'       => 'blog-archive-display-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Display style', 'floral' ),
			'subtitle' => esc_html__( 'Select archive display style.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'style-1' => esc_html__( 'Classic', 'floral' ),
				'style-2' => esc_html__( 'Modern', 'floral' )
			),
			'default'  => 'style-1',
			'required' => array( 'blog-archive-display-type', '=', array( 'wide' ) ),
		),
		
		array(
			'id'       => 'blog-archive-display-columns',
			'type'     => 'select',
			'title'    => esc_html__( 'Display columns', 'floral' ),
			'subtitle' => esc_html__( 'Choose the number of columns to display on archive pages.', 'floral' ),
			'options'  => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			),
			'desc'     => '',
			'default'  => '3',
			'required' => array( 'blog-archive-display-type', '=', array( 'masonry', 'grid' ) ),
		),

//        array(
//            'id'       => 'blog-archive-item-separator',
//            'type'     => 'button_set',
//            'title'    => esc_html__( 'Enable separator between blog item', 'floral' ),
//            'subtitle' => esc_html__( 'Enable separator between blog item.', 'floral' ),
//            'options'  => array(
//                'on' => esc_html__( 'On', 'floral' ),
//                'off' => esc_html__( 'Off', 'floral' ),
//            ),
//            'default'  => 'on',
//        ),

//        array(
//            'id'       => 'blog-archive-item-type',
//            'type'     => 'button_set',
//            'title'    => esc_html__( 'Blog item type', 'floral' ),
//            'subtitle' => esc_html__( 'Design of blog item.', 'floral' ),
//            'options'  => array(
//                'floral-blog-item-vertical' => esc_html__( 'Vertical', 'floral' ),
//                'floral-blog-item-horizontal' => esc_html__( 'Horizontal', 'floral' ),
//            ),
//            'default'  => 'floral-blog-item-vertical',
//        ),
		
		//---s
		array(
			'id'       => 'blog-archive-item-header',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable blog item header', 'floral' ),
			'subtitle' => esc_html__( 'Enable blog item header.', 'floral' ),
			'default'  => 1
		),
		//---e
		
		array(
			'id'      => 'blog-archive-item-image-ratio',
			'type'    => 'select',
			'title'   => esc_html__( 'Blog item image ratio', 'floral' ),
//			'subtitle' => esc_html__( 'Action with the feature image of the blog item.', 'floral' ),
			'desc'    => '',
			'options' => array(
				'0.5625'        => '16x9',
				'1.77777777778' => '9x16',
				'0.42857142857' => '21x9',
				'2.33333333333' => '9x21',
				'0.75'          => '4x3',
				'1.33333333333' => '3x4',
				'0.666666667'   => '3x2',
				'1.5'           => '2x3',
				'1'             => '1x1',
				'0.5'           => '2x1',
				'2'             => '1x2',
				'original'      => esc_html__( 'Original', 'floral' ),
			),
			'default' => 'original',
		),
		
		array(
			'id'       => 'blog-archive-item-image-action',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Blog item feature image action', 'floral' ),
			'subtitle' => esc_html__( 'Action with the feature image of the blog item.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'none' => esc_html__( 'None', 'floral' ),
				'link' => esc_html__( 'Link to post', 'floral' ),
			),
			'default'  => 'link',
		),

//		array(
//			'id'       => 'blog-archive-item-bordered',
//			'type'     => 'button_set',
//			'title'    => esc_html__( 'Enable border wrap blog item element', 'floral' ),
//			'subtitle' => esc_html__( 'Border color defined in "Color" tab.', 'floral' ),
//			'options'  => array(
//				'on'  => esc_html__( 'On', 'floral' ),
//				'off' => esc_html__( 'Off', 'floral' ),
//			),
//			'default'  => 'off',
//			'required' => array( 'blog-archive-item-type', '=', array( 'floral-blog-item-vertical' ) ),
//		),

//		array(
//			'id'       => 'blog-archive-item-squared-date',
//			'type'     => 'button_set',
//			'title'    => esc_html__( 'Enable squared date', 'floral' ),
//			'subtitle' => esc_html__( 'Enable squared date left of content area.', 'floral' ),
//			'options'  => array(
//				'on'  => esc_html__( 'On', 'floral' ),
//				'off' => esc_html__( 'Off', 'floral' ),
//			),
//			'default'  => 'off',
//			'required' => array( 'blog-archive-item-bordered', '=', array( 'off' ) ),
//		),
		
		array(
			'id'       => 'blog-archive-post-meta',
			'type'     => 'checkbox',
			'title'    => esc_html__( 'Meta', 'floral' ),
			'subtitle' => esc_html__( 'Disable or enable meta options.', 'floral' ),
			'options'  => array(
				'date'         => esc_html__( 'Date', 'floral' ),
				'author'       => esc_html__( 'Author', 'floral' ),
				'categories'   => esc_html__( 'Categories', 'floral' ),
				'tags'         => esc_html__( 'Tags', 'floral' ),
				'comments'     => esc_html__( 'Comments', 'floral' ),
				'social-share' => esc_html__( 'Social Share', 'floral' ),
			),
			'default'  => array(
				'date'         => 1,
				'author'       => 1,
				'categories'   => 1,
				'tags'         => 0,
				'comments'     => 1,
				'social-share' => 1,
			),
		),
		
		array(
			'id'       => 'blog-archive-excerpt-length',
			'type'     => 'text',
			'title'    => esc_html__( 'Excerpt length', 'floral' ),
			'subtitle' => esc_html__( 'Limit the excerpt length (words). Default value is 50 words.', 'floral' ),
			'validate' => 'numeric',
			'default'  => ''
		),
		
		array(
			'id'       => 'blog-archive-paging-type',
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
			'id'       => 'blog-archive-paging-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Paging style', 'floral' ),
			'subtitle' => esc_html__( 'Select archive paging style.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'style-1' => esc_html__( 'Classic', 'floral' ),
				'style-2' => esc_html__( 'Modern', 'floral' ),
			),
			'required' => array( 'blog-archive-paging-type', '=', array( 'default' ) ),
			'default'  => 'style-2'
		),
		
		array(
			'id'       => 'blog-archive-paging-align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Paging align', 'floral' ),
			'subtitle' => esc_html__( 'Select archive paging align.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'left'   => esc_html__( 'left', 'floral' ),
				'center' => esc_html__( 'Center', 'floral' ),
				'right'  => esc_html__( 'Right', 'floral' ),
			),
			'required' => array( 'blog-archive-paging-type', '=', array( 'default' ) ),
			'default'  => 'center'
		),
		
		array(
			'id'             => 'blog-archive-margin',
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
			'output'         => array( '.site-main-archive' )
		),
		
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => esc_html__( 'Layout Settings', 'floral' ),
		),
		array(
			'id'       => 'blog-archive-layout',
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
			'id'       => 'blog-archive-widget-title-style',
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
			'id'       => 'blog-archive-sidebar',
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
			'id'       => 'blog-archive-sidebar-width',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Sidebar width', 'floral' ),
			'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'small' => esc_html__( 'Small (1/4)', 'floral' ),
				'large' => esc_html__( 'Large (1/3)', 'floral' )
			),
			'default'  => 'large',
			'required' => array( 'blog-archive-sidebar', '=', array( 'left', 'both', 'right' ) ),
		),
		
		
		array(
			'id'       => 'blog-archive-sidebar-left',
			'type'     => 'select',
			'title'    => esc_html__( 'Left sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'blog-archive-sidebar', '=', array( 'left', 'both' ) ),
		),
		
		array(
			'id'       => 'blog-archive-sidebar-right',
			'type'     => 'select',
			'title'    => esc_html__( 'Right sidebar', 'floral' ),
			'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
			'data'     => 'sidebars',
			'desc'     => '',
			'default'  => 'sidebar-1',
			'required' => array( 'blog-archive-sidebar', '=', array( 'right', 'both' ) ),
		),
	)
);