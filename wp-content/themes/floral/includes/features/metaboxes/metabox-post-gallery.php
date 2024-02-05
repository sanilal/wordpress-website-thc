<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-gallery.php
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
            'id'          => 'meta-post-gallery',
            'type'        => 'slides',
            'title'       => esc_html__( 'Gallery slider', 'floral' ),
            'subtitle'    => esc_html__( 'Upload images or add from media library.', 'floral' ),
            'placeholder' => array(
                'title' => esc_html__( 'Title', 'floral' ),
            ),
            'show'        => array(
                'title'       => true,
                'description' => false,
                'url'         => false,
            )
        ),
    )
);