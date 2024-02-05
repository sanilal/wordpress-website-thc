<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-portfolio.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Portfolio', 'floral' ),
    'desc'   => esc_html__( 'Change the portfolio section configuration.', 'floral' ),
    'icon'   => 'dashicons-before dashicons-awards',
    'fields' => array(
        // Header general
        array(
            'id'       => 'meta-portfolio-about-title',
            'type'     => 'text',
            'title'    => esc_html__( 'Portfolio about title', 'floral' ),
            'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'floral' ),
            'default'  => esc_html__( 'About the project', 'floral' ),
        ),
        array(
            'id' => 'meta-portfolio-about-content',
            'type' => 'textarea',
            'title' => esc_html__( 'Portfolio about content', 'floral' ),
            'subtitle' => esc_html__( 'Allow some html tag inside: <a>, <br/>, <strong>, <em>.', 'floral' ),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' =>'meta-portfolio-client-name',
            'type' => 'text',
            'title' => esc_html__( 'Client name', 'floral' ),
        ),
        array(
            'id' =>'meta-portfolio-client-url',
            'type' => 'text',
            'title' => esc_html__( 'Client URL', 'floral' ),
        ),
        array(
            'id' =>'meta-portfolio-project-url',
            'type' => 'text',
            'title' => esc_html__( 'Project URL', 'floral' ),
        ),
//        array(
//            'id' =>'meta-portfolio-video',
//            'type' => 'text',
//            'subtitle' => esc_html__( 'Enter link to video (Note: read more about available formats at WordPress <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">codex page</a>).', 'floral' ),
//            'title' => esc_html__( 'Video URL', 'floral' ),
//        ),
        array(
            'id'=>'meta-portfolio-addition-info',
            'type' => 'multi_label_text',
            'title' => esc_html__('Addition info', 'floral'),
            'validate' => 'text',
            'subtitle' => esc_html__('Addition info for this label, can be print in shortcode portfolio setting.', 'floral'),
        ),
//        array(
//            'id'          => 'meta-portfolio-gallery',
//            'type'        => 'slides',
//            'title'       => esc_html__( 'Gallery slider', 'floral' ),
//            'subtitle'    => esc_html__( 'Upload images or add from media library.', 'floral' ),
//            'placeholder' => array(
//                'title' => esc_html__( 'Title', 'floral' ),
//            ),
//            'show'        => array(
//                'title'       => true,
//                'description' => false,
//                'url'         => false,
//            )
//        ),
	    array(
		    'id'          => 'meta-portfolio-gallery',
		    'type'        => 'gallery',
		    'title'       => esc_html__( 'Gallery slider', 'floral' ),
		    'subtitle'    => esc_html__( 'Upload images or add from media library.', 'floral' ),
	    ),
    
    ) // #fields
);
