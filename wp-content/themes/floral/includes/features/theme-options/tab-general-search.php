<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general-search.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'      => esc_html__( 'Search', 'floral' ),
    'desc'       => esc_html__( 'Search page settings.', 'floral' ),
    'icon'       => 'el el-search',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'search-page-paging-type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Paging type', 'floral' ),
            'subtitle' => esc_html__( 'Select archive paging style.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'default'         => esc_html__( 'Default', 'floral' ),
                'load-more'       => esc_html__( 'Load More', 'floral' ),
                'infinite-scroll' => esc_html__( 'Infinite Scroll', 'floral' )
            ),
            'default'  => 'default'
        ),
        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => 'Layout configurations'
        ),
        array(
            'id'       => 'search-page-layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select page layout.', 'floral' ),
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
		    'id'       => 'search-page-widget-title-style',
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
            'id'       => 'search-page-sidebar',
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
            'id'       => 'search-page-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'search-page-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        array(
            'id'       => 'search-page-left-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'search-page-sidebar', '=', array( 'left', 'both' ) ),
        ),
        array(
            'id'       => 'search-page-right-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-2',
            'required' => array( 'search-page-sidebar', '=', array( 'right', 'both' ) ),
        ),
    
        array(
            'id'             => 'search-page-margin',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__( 'Page margin', 'floral' ),
            'subtitle'       => esc_html__( 'Set page margin.', 'floral' ),
            'desc'           => '',
            'left'           => false,
            'right'          => false,
            'default'        => array(
                'margin-top'    => '0',
                'margin-bottom' => '60px',
                'units'         => 'px',
            ),
            'output'         => array( '.search.search-results .site-main, .search.search-no-results .site-main' ),
        )
//        array(
//            'id'    => mt_rand(),
//            'type'  => 'info',
//            'title' => 'Other settings'
//        ),
//        array(
//            'id'       => 'search-page-display-type',
//            'type'     => 'select',
//            'title'    => esc_html__( 'Display type', 'floral' ),
//            'subtitle' => esc_html__( 'Select search page display type.', 'floral' ),
//            'desc'     => '',
//            'options'  => array(
//                'classic' => esc_html__( 'Classic', 'floral' ),
//                'grid'    => esc_html__( 'Grid', 'floral' ),
//                'masonry' => esc_html__( 'Masonry', 'floral' ),
//            ),
//            'default'  => 'classic',
//            'validate' => 'not_empty'
//        ),
//        array(
//            'id'       => 'search-page-search-form',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Show search form', 'floral' ),
//            'subtitle' => esc_html__( 'Set display or not display the search form.', 'floral' ),
//            'desc'     => '',
//            'default'  => '1'
//        )
    )
);