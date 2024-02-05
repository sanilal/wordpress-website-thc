<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-cpt.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Custom Post Type', 'floral' ),
    'desc'   => esc_html__( 'Custom post type settings section.', 'floral' ),
    'icon'   => 'dashicons-before dashicons-admin-post',
    'fields' => array(
        //Portfolio
//        array(
//            'id'    => mt_rand(),
//            'type'  => 'info',
//            'title' => esc_html__('Portfolio Settings', 'floral' ),
//        ),
//        array(
//            'id'        => 'cpt-portfolio-enable',
//            'type'      => 'switch',
//            'title'     => esc_html__( 'Portfolio enable?', 'floral' ),
//            'subtitle'  => esc_html__( 'Don\'t want to use this custom post type. Just make it off!', 'floral' ),
//            'default'   => 1,
//            'ajax_save' => false
//        ),
//        array(
//            'id'        => 'cpt-portfolio-slug',
//            'type'      => 'text',
//            'title'     => esc_html__( 'Custom portfolio slug', 'floral' ),
//            'subtitle'  => esc_html__( 'Using different Portfolio slug.', 'floral' ),
//            'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "portfolio".', 'floral' ),
//            'ajax_save' => false,
//            'required'  => array( 'cpt-portfolio-enable', '=', 1 )
//        ),
//        array(
//            'id'        => 'cpt-portfolio-name',
//            'type'      => 'text',
//            'title'     => esc_html__( 'Custom portfolio name', 'floral' ),
//            'subtitle'  => esc_html__( 'Using different Portfolio name.', 'floral' ),
//            'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Portfolio".', 'floral' ),
//            'ajax_save' => false,
//            'required'  => array( 'cpt-portfolio-enable', '=', 1 )
//        ),
//        array(
//            'id'        => 'cpt-portfolio-tax-slug',
//            'type'      => 'text',
//            'title'     => esc_html__( 'Custom portfolio category slug', 'floral' ),
//            'subtitle'  => esc_html__( 'Using different Portfolio Category slug.', 'floral' ),
//            'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "portfolio-category".', 'floral' ),
//            'ajax_save' => false,
//            'required'  => array( 'cpt-portfolio-enable', '=', 1 )
//        ),
//        array(
//            'id'        => 'cpt-portfolio-tax-name',
//            'type'      => 'text',
//            'title'     => esc_html__( 'Custom portfolio category name', 'floral' ),
//            'subtitle'  => esc_html__( 'Using different Portfolio Category name.', 'floral' ),
//            'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Portfolio Category".', 'floral' ),
//            'ajax_save' => false,
//            'required'  => array( 'cpt-portfolio-enable', '=', 1 )
//        ),
	    
	    //Service
	
	    array(
		    'id'    => mt_rand(),
		    'type'  => 'info',
		    'title' => esc_html__('Service Settings', 'floral' ),
	    ),
	    array(
		    'id'        => 'cpt-service-enable',
		    'type'      => 'switch',
		    'title'     => esc_html__( 'Service enable?', 'floral' ),
		    'subtitle'  => esc_html__( 'Don\'t want to use this custom post type. Just make it off!', 'floral' ),
		    'default'   => 1,
		    'ajax_save' => false
	    ),
	    array(
		    'id'        => 'cpt-service-slug',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom service slug', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Service slug.', 'floral' ),
		    'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "service".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-service-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-service-name',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom service name', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Service name.', 'floral' ),
		    'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Service".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-service-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-service-tax-slug',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom service category slug', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Service Category slug.', 'floral' ),
		    'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "service-category".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-service-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-service-tax-name',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom service category name', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Service Category name.', 'floral' ),
		    'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Service Category".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-service-enable', '=', 1 )
	    ),
	
	    //
	
	    array(
		    'id'    => mt_rand(),
		    'type'  => 'info',
		    'title' => esc_html__('Event CPT settings', 'floral')
	    ),
	    array(
		    'id'        => 'cpt-event-enable',
		    'type'      => 'switch',
		    'title'     => esc_html__( 'Event enable?', 'floral' ),
		    'subtitle'  => esc_html__( 'Don\'t want to use this custom post type. Just make it off!', 'floral' ),
		    'default'   => 1,
		    'ajax_save' => false
	    ),
	    array(
		    'id'        => 'cpt-event-slug',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom event slug', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Event slug.', 'floral' ),
		    'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "event".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-event-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-event-name',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom event name', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Event name.', 'floral' ),
		    'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Event".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-event-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-event-tax-slug',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom event category slug', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Event Category slug.', 'floral' ),
		    'desc'      => esc_html__( 'No space between each words, using "-" or "_" to separate each words, and all letters should be in lowercase. Default value is "event-category".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-event-enable', '=', 1 )
	    ),
	    array(
		    'id'        => 'cpt-event-tax-name',
		    'type'      => 'text',
		    'title'     => esc_html__( 'Custom event category name', 'floral' ),
		    'subtitle'  => esc_html__( 'Using different Event Category name.', 'floral' ),
		    'desc'      => esc_html__( 'Capitalize first letter of each words. Default value is "Event Category".', 'floral' ),
		    'ajax_save' => false,
		    'required'  => array( 'cpt-event-enable', '=', 1 )
	    ),
	    
	    //

//        array(
//            'id'    => mt_rand(),
//            'type'  => 'info',
//            'title' => esc_html__('Review CPT Settings', 'floral')
//        ),
//        array(
//            'id'        => 'review-enable',
//            'type'      => 'switch',
//            'title'     => esc_html__( 'Review enable?', 'floral' ),
//            'subtitle'  => esc_html__( 'Don\'t want to use this custom post type. Just make it off!', 'floral' ),
//            'default'   => 1,
//            'ajax_save' => false
//        ),
	    
	    //

//        array(
//            'id'    => mt_rand(),
//            'type'  => 'info',
//            'title' => esc_html__('Theme Demo CPT settings', 'floral')
//        ),
//        array(
//            'id'        => 'theme-demo-enable',
//            'type'      => 'switch',
//            'title'     => esc_html__( 'Theme demo enable?', 'floral' ),
//            'subtitle'  => esc_html__( 'Don\'t want to use this custom post type. Just make it off!', 'floral' ),
//            'default'   => 1,
//            'ajax_save' => false
//        ),
    ),
);

