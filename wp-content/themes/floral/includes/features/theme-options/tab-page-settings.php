<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-page-settings.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Pages', 'floral' ),
    'desc'   => esc_html__( 'Pages settings.', 'floral' ),
    'icon'   => 'dashicons-before dashicons-media-document',
    'fields' => array(
        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__('Layout configurations', 'floral' ),
        ),
        array(
            'id'       => 'page-layout',
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
            'default'  => 'fullwidth'
        ),
	
	    array(
		    'id'       => 'page-widget-title-style',
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
            'id'       => 'page-sidebar',
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
            'id'       => 'page-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'page-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        array(
            'id'       => 'page-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'page-sidebar', '=', array( 'left', 'both' ) ),
        ),
        array(
            'id'       => 'page-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-2',
            'required' => array( 'page-sidebar', '=', array( 'right', 'both' ) ),
        ),
        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__('Other settings', 'floral' ),
        ),
        array(
            'id'       => 'page-comment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Page comment', 'floral' ),
            'subtitle' => esc_html__( 'Enable/Disable page comment.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),
        array(
            'id'             => 'page-margin',
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
                'margin-bottom' => '100px',
                'margin-top'    => '',
                'units'         => 'px',
            ),
            'output'         => array( '.site-main-page' ),
        )
    )
);