<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt-theme-product-archive.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*-------------------------------------
	THEME PRODUCT CPT
---------------------------------------*/
$this->sections[] = array(
    'title'      => esc_html__( 'Theme Product Archive', 'floral' ),
    'desc'       => esc_html__( 'Theme Product Archive settings section.', 'floral' ),
    'icon'       => 'dashicons-before dashicons-admin-post',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__('Template settings', 'floral' ),
        ),
        
        array(
            'id'    => 'tp-archive-template',
            'title' => esc_html__( 'Override default archive template', 'floral' ),
            'type'  => 'select',
            'data'  => 'pages',
        ),
        
        array(
            'id'       => 'tp-archive-items-per-page',
            'type'     => 'text',
            'title'    => esc_html__( 'Items per page', 'floral' ),
            'subtitle' => esc_html__( 'Default value is 8.', 'floral' ),
            'default'  => '8',
            'validate' => 'numeric'
        ),
        
        array(
            'id'       => 'tp-archive-paging-style',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Paging style', 'floral' ),
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
            'id'             => 'tp-archive-margin',
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
            'output'         => array( '.site-main-archive.theme-product-archive' )
        ),

        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__('Layout Settings', 'floral' ),
        ),
        array(
            'id'       => 'tp-archive-layout',
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
            'default'  => 'container-xlg',
            'validate' => 'not_empty'
        ),

        array(
            'id'       => 'tp-archive-sidebar',
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
            'default'  => 'left'
        ),

        array(
            'id'       => 'tp-archive-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set Sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'tp-archive-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),

        array(
            'id'       => 'tp-archive-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'tp-archive-sidebar', '=', array( 'left', 'both' ) ),
        ),

        array(
            'id'       => 'tp-archive-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-2',
            'required' => array( 'tp-archive-sidebar', '=', array( 'right', 'both' ) ),
        ),
    ),
);