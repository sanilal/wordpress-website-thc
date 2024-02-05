<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-audio.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Post
*/

$sections[] = array(
    //'title' => esc_html__(' Settings', 'floral'),
    'icon'   => 'el-icon-screen',
    'fields' => array(
        array(
            'id'       => 'meta-post-audio-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Audio URL', 'floral' ),
            'subtitle' => esc_html__( 'Audio URL form Soundcloud or others...', 'floral' ),
            'default'  => '',
        ),
        array(
            'id'      => 'meta-post-audio-html',
            'type'    => 'textarea',
            'title'   => esc_html__( 'Embedded audio code', 'floral' ),
            'default' => '',
        ),
    )
);