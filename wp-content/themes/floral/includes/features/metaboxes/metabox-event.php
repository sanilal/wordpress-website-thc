<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-event.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Event Settings', 'floral' ),
    'desc'   => esc_html__( 'Change the event section configuration.', 'floral' ),
    'icon'   => 'dashicons-before dashicons-calendar-alt',
    'fields' => array(
	    array(
		    'id' => 'meta-event-discount-tag',
		    'title' => esc_html__( 'Discount tag', 'floral' ),
		    'subtitle' => esc_html__( 'Enter discount tag content.', 'floral' ),
		    'type' => 'text',
	    ),
    )
);