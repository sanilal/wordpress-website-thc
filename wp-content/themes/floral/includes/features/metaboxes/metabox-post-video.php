<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-video.php
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
//	'title' => esc_html__(' Settings', 'floral'),
    'icon'   => 'el-icon-screen',
    'fields' => array(
        array(
            'id'       => 'meta-post-video-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Video URL', 'floral' ),
            'subtitle' => esc_html__( 'YouTube or Vimeo video URL.', 'floral' ),
            'default'  => '',
        ),
        array(
            'id'       => 'meta-post-video-html',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Embedded video', 'floral' ),
            'subtitle' => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo.', 'floral' ),
            'default'  => '',
        ),
    )
);