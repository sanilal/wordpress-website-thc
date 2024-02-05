<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-post-image.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
//    'title' => esc_html__(' Settings', 'floral'),
//    'icon' => 'fa fa-image',
    'fields' => array(
        array(
            'id'        => 'meta-post-image-url',
            'type'      => 'media',
            'title'     => esc_html__('Image URL', 'floral'),
            'subtitle'  => esc_html__('Using for image post.', 'floral'),
        ),
    )
);