<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-link.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'fields' => array(
        array(
            'id'      => 'meta-post-link-url',
            'type'    => 'textarea',
            'title'   => esc_html__( 'URL', 'floral' ),
            'default' => '',
        ),
        array(
            'id'      => 'meta-post-link-text',
            'type'    => 'text',
            'title'   => esc_html__( 'Text', 'floral' ),
            'default' => '',
        )
    )
);