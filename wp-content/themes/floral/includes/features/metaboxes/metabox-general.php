<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-general.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'General Settings', 'floral' ),
    'desc'   => esc_html__( 'Change the general layout settings. Leave all as blank if you want to use the default options from Theme Options.', 'floral' ),
    'icon'   => 'el-icon-lines',
    'fields' => array(
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Options Preset', 'floral' ),
        ),
        array(
            'id'       => 'meta-using-preset',
            'type'     => 'select',
            'title'    => esc_html__( 'Use preset', 'floral' ),
            'subtitle' => esc_html__( 'Select the preset that the page will use.', 'floral' ),
            'desc'     => '',
            'options'  => floral_get_preset_list(),
            'default'  => ''
        ),

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Body Background', 'floral' ),
        ),

        array(
            'id'       => 'meta-site-content-background',
            'type'     => 'background',
            'title'    => esc_html__( 'Site content background', 'floral' ),
            'subtitle' => esc_html__( 'Config the style for site content background.', 'floral' ),
            'output'   => array( '#page.site' ), // An array of CSS selectors to apply this font style to dynamically
            'default'  => array(
                'background-color'      => '',
                'background-repeat'     => 'no-repeat',
                'background-position'   => 'center center',
                'background-attachment' => 'fixed',
                'background-size'       => 'cover'
            ),
        ),
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('General Layout', 'floral' ),
        ),
        array(
            'id'       => 'meta-single-layout',
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
            'default'  => ''
        ),
	
	    array(
		    'id'       => 'meta-single-widget-title-style',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Widget title style', 'floral' ),
		    'subtitle' => esc_html__( 'Select widget title style.', 'floral' ),
		    'desc'     => '',
		    'options'  => array(
			    ''        => esc_html__( 'Default', 'floral' ),
			    'style-1' => esc_html__( 'Style 1', 'floral' ),
			    'style-2' => esc_html__( 'Style 2', 'floral' ),
		    ),
		    'default'  => ''
	    ),
        
        array(
            'id'       => 'meta-single-sidebar',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar style.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                ''      => array( 'title' => 'Default', 'img' => floral_theme_url() . 'assets/images/sidebar-default.jpg' ),
                'none'  => array( 'title' => 'None', 'img' => floral_theme_url() . 'assets/images/sidebar-none.png' ),
                'left'  => array( 'title' => 'Left', 'img' => floral_theme_url() . 'assets/images/sidebar-left.png' ),
                'right' => array( 'title' => 'Right', 'img' => floral_theme_url() . 'assets/images/sidebar-right.png' ),
                'both'  => array( 'title' => 'Both', 'img' => floral_theme_url() . 'assets/images/sidebar-both.png' ),
            ),
            'default'  => ''
        ),
        array(
            'id'       => 'meta-single-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                ''      => esc_html__( 'Default', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => '',
            'required' => array( 'meta-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        array(
            'id'       => 'meta-single-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => '',
            'required' => array( 'meta-single-sidebar', '=', array( 'left', 'both' ) ),
        ),
        array(
            'id'       => 'meta-single-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => '',
            'required' => array( 'meta-single-sidebar', '=', array( 'right', 'both' ) ),
        ),
    ),
);