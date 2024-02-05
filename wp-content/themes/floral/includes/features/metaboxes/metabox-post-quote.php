<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-quote.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'fields' => array(
        array(
            'id'       => 'meta-post-quote-content',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Quote', 'floral' ),
            'subtitle' => esc_html__( 'Quote content.', 'floral' ),
            'default'  => '',
        ),
        array(
            'id'      => 'meta-post-quote-author-name',
            'type'    => 'text',
            'title'   => esc_html__( 'Author name', 'floral' ),
            'default' => '',
        ),
        array(
            'id'      => 'meta-post-quote-author-url',
            'type'    => 'text',
            'title'   => esc_html__( 'Author URL', 'floral' ),
            'default' => '',
        ),
    )
);