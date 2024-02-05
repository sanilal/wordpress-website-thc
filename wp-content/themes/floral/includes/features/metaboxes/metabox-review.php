<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-review.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Quote content
 * Rating
 * Author name
 * Author job
 * Author avatar
 */

$sections[] = array(
    //'title' => esc_html__(' Settings', 'floral'),
    'icon'   => 'el-icon-screen',
    'fields' => array(
        array(
            'id'       => 'meta-review-content',
            'type'     => 'editor',
            'title'    => esc_html__( 'Review content', 'floral' ),
            'subtitle' => esc_html__( 'Enter review content.', 'floral' ),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 10,
                'media_buttons' => false,
            )
        ),
        array(
            'id'         => 'meta-review-rating',
            'type'       => 'slider',
            'title'      => esc_html__( 'Rating', 'floral' ),
            'default'    => 2.5,
            'min'        => 0,
            'max'        => 5,
            'step'       => 0.01,
            'resolution' => 0.01
        ),

        array(
            'id'       => 'meta-review-author-name',
            'type'     => 'text',
            'title'    => esc_html__( 'Author name', 'floral' ),
            'subtitle' => esc_html__( 'Enter author name of the review.', 'floral' ),
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'meta-review-author-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Author URL', 'floral' ),
            'subtitle' => esc_html__( 'Enter author url of the review.', 'floral' ),
            'desc'     => '',
            'default'  => '',
        ),

        array(
            'id'       => 'meta-review-author-job',
            'type'     => 'text',
            'title'    => esc_html__( 'Author job', 'floral' ),
            'subtitle' => esc_html__( 'Enter author job of the review.', 'floral' ),
            'desc'     => '',
            'default'  => '',
        ),
        array(
            'id'       => 'meta-review-author-avatar',
            'type'     => 'media',
            'title'    => esc_html__( 'Author avatar', 'floral' ),
            'subtitle' => esc_html__( 'Pick an avatar of the author.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
    )
);