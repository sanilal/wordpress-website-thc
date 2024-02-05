<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-test.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Test', 'floral' ),
    'desc'   => esc_html__( 'Change the footer section configuration.', 'floral' ),
    'icon'   => 'el-icon-home',
    'fields' => array(
        // Header general
        array(
            'id'       => 'meta-test-text',
            'type'     => 'text',
            'title'    => esc_html__( 'Test meta text', 'floral' ),
            'default'  => 'Test meta text',
        ),
        
        array(
            'id'       => 'meta-test-href',
            'type'     => 'text',
            'title'    => esc_html__( 'Test meta text linkr', 'floral' ),
            'default'  => esc_url( home_url( '/' ) ),
        ),

        array(
            'id'       => 'meta-test-image',
            'type'     => 'media',
            'title'    => esc_html__( 'Test image', 'floral' ),
            'default'  => '',
        ),
    
        array(
            'id'          => 'meta-test-gallery',
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
    
        array(
            'id'       => 'meta-test-embed-video-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Test meta embed Video URL', 'floral' ),
            'default'  => '',
        ),
    
        array(
            'id'       => 'meta-test-embed-video-html',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Test meta embed Video Html', 'floral' ),
            'default'  => '',
        ),
    
        array(
            'id'       => 'meta-test-embed-audio-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Test meta embed Audio Url', 'floral' ),
            'default'  => '',
        ),
    
        array(
            'id'       => 'meta-test-embed-audio-html',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Test meta embed Audio HTML', 'floral' ),
            'default'  => '',
        ),

    ) // #fields
);