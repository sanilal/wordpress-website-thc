<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt-portfolio-single.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*-------------------------------------\
	PORTFOLIO CPT
---------------------------------------*/
$this->sections[] = array(
    'title'      => esc_html__( 'Portfolio Single', 'floral' ),
    'desc'       => esc_html__( 'Portfolio Single settings section.', 'floral' ),
    'icon'       => 'dashicons-before dashicons-awards',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'portfolio-single-default-content',
            'type' => 'button_set',
            'title' => esc_html__('Default Content', 'floral'),
            'subtitle' => sprintf(__('Use portfolio single default content if default content of portfolio single is not set.<br>You can set single portfolio content <a href="%s" target="_blank">here</a>', 'floral'), admin_url('admin.php?page=vc-general')),
            'options' => array(
                'on' => esc_html__('On', 'floral'),
                'off' => esc_html__('Off', 'floral'),
            ),
            'default' => 'on'
        ),
//        array(
//            'id' => 'portfolio-single-page-title-background',
//            'type' => 'background',
//            'title' => esc_html__( 'Portfolio single page title background', 'floral' ),
//            'subtitle' => esc_html__( 'Porfolio single background.', 'floral' ),
//            'output' => array('.floral-portfolio-title-row'),
//            'default' => array(
//                'background-image' => floral_theme_url() . 'assets/images/portfolio-page-title-bg.jpg',
//                'background-size' => 'cover',
//                'background-position' => 'center center',
//            ),
//        ),
        array(
            'id'             => 'portfolio-single-margin',
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
            'output'         => array( '.site-main-single.portfolio-single' )
        ),
        
        array(
            'id'       => 'portfolio-single-navigator-enabled',
            'type'     => 'switch',
            'title' => esc_html__('Navigator enabled', 'floral'),
            'subtitle' => esc_html__('Enable navigator bottom of single page.', 'floral'),
            'default' => false
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Layout Settings', 'floral')
        ),

        array(
            'id'       => 'portfolio-single-layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select single portfolio layout.', 'floral' ),
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
            'id'       => 'portfolio-single-sidebar',
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
            'id'       => 'portfolio-single-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'portfolio-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        
        array(
            'id'       => 'portfolio-single-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'portfolio-single-sidebar', '=', array( 'left', 'both' ) ),
        ),

        array(
            'id'       => 'portfolio-single-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'portfolio-single-sidebar', '=', array( 'right', 'both' ) ),
        ),
    ),
);