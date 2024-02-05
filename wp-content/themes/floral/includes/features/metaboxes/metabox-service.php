<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-service.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Service', 'floral' ),
    'desc'   => esc_html__( 'Change the service section configuration.', 'floral' ),
    'icon'   => 'dashicons-before dashicons-share-alt',
    'fields' => array(
//	    array(
//		    'id'          => 'meta-service-gallery',
//		    'type'        => 'gallery',
//		    'title'       => esc_html__( 'Gallery slider', 'floral' ),
//		    'subtitle'    => esc_html__( 'Upload images or add from media library.', 'floral' ),
//	    ),
	    array(
		    'id'       => 'meta-service-price',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Price', 'floral' ),
		    'subtitle' => esc_html__( 'Set service price attribute (must contain a currency symbol).', 'floral' )
	    ),
	    array(
		    'id'       => 'meta-service-time',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Time/Amount', 'floral' ),
		    'subtitle' => esc_html__( 'Enter service time/amount attribute.', 'floral' )
	    ),
    )
);
