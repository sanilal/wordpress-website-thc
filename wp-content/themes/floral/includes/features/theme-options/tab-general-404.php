<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general-404.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'      => esc_html__( '404 Error', 'floral' ),
    'desc'       => esc_html__( '404 Error page settings.', 'floral' ),
    'icon'       => 'el el-error',
    'subsection' => true,
    'fields'     => array(
//	    array(
//		    'id'       => '-404-image',
//		    'type'     => 'media',
//		    'url'      => true,
//		    'title'    => esc_html__( 'Image source', 'floral' ),
//		    'default'  => array(
//			    'url' => floral_theme_url(). 'assets/images/404-img.png'
//		    ),
//	    ),
        array(
            'id'      => '-404-title',
            'type'    => 'text',
            'title'   => esc_html__( '404 title', 'floral' ),
            'default' => esc_html__('404!', 'floral'),
        ),
        array(
            'id'      => '-404-subtitle',
            'type'    => 'textarea',
            'title'   => esc_html__( '404 subtitle', 'floral' ),
            'default' => esc_html__('Sorry! Page Not Found!', 'floral'),
        ),
	
	    array(
		    'id'      => '-404-go-back-text',
		    'type'    => 'text',
		    'title'   => esc_html__( 'Go back text', 'floral' ),
		    'subtitle'    => esc_html__( 'Enter the text of "go back" button.', 'floral' ),
		    'default' => esc_html__('Home', 'floral'),
	    ),
        
        array(
            'id'      => '-404-go-back-url',
            'type'    => 'text',
            'title'   => esc_html__( 'Go back link', 'floral' ),
            'desc'    => esc_html__( 'Default value is your homepage url.', 'floral' ),
            'default' => '',
        ),
	
	    array(
		    'id'             => '-404-page-padding',
		    'type'           => 'spacing',
		    'mode'           => 'padding',
		    'units'          => 'px',
		    'units_extended' => 'false',
		    'title'          => esc_html__( 'Page padding', 'floral' ),
		    'subtitle'       => esc_html__( 'Set page padding.', 'floral' ),
		    'desc'           => '',
		    'left'           => false,
		    'right'          => false,
		    'default'        => array(
			    'padding-top'    => '230px',
			    'padding-bottom' => '300px',
			    'units'         => 'px',
		    ),
		    'output'         => array( '.error404 .site-main-page' ),
	    ),

        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__( '404 colors style configuration', 'floral' )
        ),
//        array(
//            'id'       => '-404-page-text-color',
//            'type'     => 'button_set',
//            'title'    => esc_html__( 'Text color', 'floral' ),
//            'subtitle' => esc_html__( 'Choose text color for 404 page.', 'floral' ),
//            'desc'     => '',
//            'options'  => array(
//                ''            => esc_html__( 'Inherit', 'floral' ),
//                'p-color'     => esc_html__( 'Primary', 'floral' ),
//                's-color'     => esc_html__( 'Secondary', 'floral' ),
//                'light-color' => esc_html__( 'Light', 'floral' ),
//                'dark-color'  => esc_html__( 'Dark', 'floral' )
//            ),
//            'default'  => '',
//        ),
        array(
            'id'       => '-404-bg-image',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Background image', 'floral' ),
            'subtitle' => esc_html__( 'Upload your background image for 404 site.', 'floral' ),
            'desc'     => '',
        ),
        array(
            'id'      => '-404-overlay',
            'type'    => 'button_set',
            'title'   => esc_html__( 'Overlay', 'floral' ),
            'desc'    => '',
            'options' => array(
                ''              => esc_html__( 'None', 'floral' ),
                'overlay-light' => esc_html__( 'Light', 'floral' ),
                'overlay-dark'  => esc_html__( 'Dark', 'floral' )
            ),
            'default' => '',
        ),

        array(
            'id'            => '-404-overlay-opacity',
            'type'          => 'slider',
            'title'         => esc_html__( 'Overlay opacity', 'floral' ),
            'subtitle'      => esc_html__( 'Set overlay opacity value for 404 site.', 'floral' ),
            'desc'          => '',
            'min'           => 0,
            'max'           => 1,
            'step'          => .1,
            'default'       => .5,
            'resolution'    => 0.1,
            'display_value' => 'text'
        ),

//        array(
//            'id'       => '-404-page-overlay-color',
//            'type'     => 'color_rgba',
//            'title'    => esc_html__( 'Page overlay color', 'floral' ),
//            'subtitle' => esc_html__( 'Set overlay color for page.', 'floral' ),
//            'default'  => array(
//                'color' => '#fff',
//                'alpha' => 0.1,
//                'rgba'  => 'rgba(255, 255, 255, 0.1)'
//            ),
//            'validate' => 'colorrgba',
//        ),
    )
);