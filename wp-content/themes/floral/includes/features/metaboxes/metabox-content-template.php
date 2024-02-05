<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-content-template.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$content_template_list = floral_get_content_template_list();

$content_template_list = array_merge( array( '__none__' => esc_html__( '__None__', 'floral' ), '-1' => esc_html__( '__Default__', 'floral' ) ), $content_template_list );

$sections[] = array(
    'title'  => esc_html__( 'Content Template', 'floral' ),
    'desc'   => sprintf( esc_html__( 'Select content template for some specific position in page or %s here.', 'floral' ), '<a href="' . admin_url( '/post-new.php?post_type=content-template' ) . '" target="_blank">' . esc_html__( 'create new', 'floral' ) . '</a>' ),
    'icon'   => 'dashicons-before dashicons-format-aside',
    'fields' => array(

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Header Area', 'floral' ),
        ),
        // Before header
        array(
            'id'      => 'meta-content-template-before-header',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for before header area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for before header area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),

        // After header
        array(
            'id'      => 'meta-content-template-after-header',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for after header area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for after header area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Page Title Area', 'floral' ),
        ),

        // After page title
        array(
            'id'      => 'meta-content-template-after-page-title',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for after page title area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for after page title area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Footer Area', 'floral' ),
        ),

        // Before footer
        array(
            'id'      => 'meta-content-template-before-footer',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for before footer area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for before footer area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),


        // After footer
        array(
            'id'      => 'meta-content-template-after-footer',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for after footer area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for after footer area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),

    ), // #fields
);