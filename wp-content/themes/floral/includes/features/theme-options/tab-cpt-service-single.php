<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt-service-single.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*-------------------------------------\
	SERVICE CPT
---------------------------------------*/
$this->sections[] = array(
    'title'      => esc_html__( 'Service Single', 'floral' ),
    'desc'       => esc_html__( 'Service Single settings section.', 'floral' ),
    'icon'       => 'dashicons-before dashicons-share-alt',
    'subsection' => true,
    'fields'     => array(
//        array(
//            'id' => 'service-single-default-content',
//            'type' => 'button_set',
//            'title' => esc_html__('Default Content', 'floral'),
//            'subtitle' => sprintf(__('Use service single default content if default content of service single is not set.<br>You can set single service content <a href="%s" target="_blank">here</a>', 'floral'), admin_url('admin.php?page=vc-general')),
//            'options' => array(
//                'on' => esc_html__('On', 'floral'),
//                'off' => esc_html__('Off', 'floral'),
//            ),
//            'default' => 'on'
//        ),
	    array(
		    'id'       => 'service-single-feature-image',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable feature image ?', 'floral' ),
//			'subtitle' => esc_html__( 'Enable service item header.', 'floral' ),
		    'default'  => 0
	    ),
	    array(
		    'id'       => 'service-single-post-meta',
		    'type'     => 'checkbox',
		    'title'    => esc_html__( 'Meta', 'floral' ),
		    'subtitle' => esc_html__( 'Disable or enable meta options.', 'floral' ),
		    'options'  => array(
			    'date'       => esc_html__( 'Date', 'floral' ),
			    'categories' => esc_html__( 'Categories', 'floral' ),
//			    'comments'   => esc_html__( 'Comments', 'floral' ),
//			    'related' => esc_html__( 'Related service', 'floral' ),
		    ),
		    'default'  => array(
			    'date'       => 1,
			    'categories' => 1,
//			    'comments'   => 1,
//			    'social-share' => 1,
		    ),
	    ),
	
	    array(
		    'id'       => 'service-single-related',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Related services', 'floral' ),
			'subtitle' => esc_html__( 'Show or hide related services.', 'floral' ),
		    'default'  => 1
	    ),
	
	    array(
		    'id'       => 'service-single-related-amount',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Amount of related services', 'floral' ),
		    'subtitle' => esc_html__( 'Number of related services to show.', 'floral' ),
		    'default'  => '4',
		    'validate' => 'numeric',
		    'required' => array( 'service-single-related', '=', array( 1 ) ),
	    ),
	
	    array(
		    'id'       => 'service-single-related-col',
		    'type'     => 'select',
		    'title'    => esc_html__( 'Related services - display columns', 'floral' ),
		    'options'  => array(
			    '1' => '1',
			    '2' => '2',
			    '3' => '3',
			    '4' => '4',
		    ),
//		    'desc'     => esc_html__( 'Note: 6 columns available when screen bigger than 1600px, and should use layout container-xlg or larger.', 'floral' ),
		    'default'  => '4',
		    'required' => array( 'service-single-related', '=', array( 1 ) ),
//			'required' => array( 'service-archive-display-type', '=', array( 'masonry', 'grid' ) ),
	    ),
        
        array(
            'id'             => 'service-single-margin',
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
            'output'         => array( '.site-main-single.service-single' )
        ),
        
//        array(
//            'id'       => 'service-single-navigator-enabled',
//            'type'     => 'switch',
//            'title' => esc_html__('Navigator enabled', 'floral'),
//            'subtitle' => esc_html__('Enable navigator bottom of single page.', 'floral'),
//            'default' => false
//        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Layout Settings', 'floral')
        ),

        array(
            'id'       => 'service-single-layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select single service layout.', 'floral' ),
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
		    'id'       => 'service-single-widget-title-style',
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
            'id'       => 'service-single-sidebar',
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
            'id'       => 'service-single-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'service-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        
        array(
            'id'       => 'service-single-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'service',
            'required' => array( 'service-single-sidebar', '=', array( 'left', 'both' ) ),
        ),

        array(
            'id'       => 'service-single-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'service',
            'required' => array( 'service-single-sidebar', '=', array( 'right', 'both' ) ),
        ),
    ),
);