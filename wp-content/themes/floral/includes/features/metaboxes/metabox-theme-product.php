<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-theme-product.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Envato rating
 * Last Update
 * Change log URL
 * Documentation URL
 * Browse Support
 * Live Demo URL
 * PURCHASE URL
 *
 */
$sections[] = array(
    'title'  => esc_html__( 'Theme Product', 'floral' ),
    'icon'   => 'el-icon-screen',
    'fields' => array(
        array(
            'id'       => 'meta-tp-summary',
            'type'     => 'editor',
            'title'    => esc_html__( 'Theme product summary', 'floral' ),
            'subtitle' => esc_html__( 'This will be appear when you view the product in archive template.', 'floral' ),
            'args'     => array(
                'teeny'         => true,
                'textarea_rows' => 10,
                'media_buttons' => false,
            )
        ),
        array(
            'id'       => 'meta-tp-type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Theme product type', 'floral' ),
            'subtitle' => esc_html__( 'Choose theme product type.', 'floral' ),
            'desc'     => '',
            'default'  => 'premium',
            'options'  => array(
                'premium' => esc_html__( 'Premium' , 'floral'),
                'free'    => esc_html__( 'Free', 'floral')
            )
        ),
        array(
            'id'       => 'meta-tp-price',
            'type'     => 'text',
            'title'    => esc_html__( 'Price', 'floral' ),
            'subtitle' => esc_html__( 'Enter theme product price belong with the currency at first.', 'floral' ),
            'desc'     => '',
            'default'  => '',
            'required' => array( 'meta-tp-type', '=', 'premium' )
        ),
        array(
            'id'         => 'meta-tp-rate',
            'type'       => 'slider',
            'title'      => esc_html__( 'Envato rating', 'floral' ),
            'subtitle'   => esc_html__( 'Enter envato rating form 0.0 to 5.0.', 'floral' ),
            'default'    => 2.5,
            'min'        => 0,
            'max'        => 5,
            'step'       => 0.01,
            'resolution' => 0.01
        ),
        array(
            'id'          => 'meta-tp-last-update',
            'type'        => 'date',
            'title'       => esc_html__( 'Last update', 'floral' ),
            'default'     => '',
            'placeholder' => 'Pick a date'
        ),
        array(
            'id'       => 'meta-tp-docs-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Documentation URL', 'floral' ),
            'subtitle' => esc_html__( 'Enter documentation url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'meta-tp-change-log-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Change log URL', 'floral' ),
            'subtitle' => esc_html__( 'Enter theme change log url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'meta-tp-browser-support',
            'type'     => 'text',
            'title'    => esc_html__( 'Browser support', 'floral' ),
            'subtitle' => esc_html__( 'Enter browser support of the theme.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'meta-tp-live-demo-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Live demo URL', 'floral' ),
            'subtitle' => esc_html__( 'Enter live demo url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'meta-tp-purchase-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Purchase URL', 'floral' ),
            'subtitle' => esc_html__( 'Enter theme purchase or download url.', 'floral' ),
            'desc'     => '',
            'default'  => '',
            'required' => array( 'meta-tp-type', '=', 'premium' )
        ),
        array(
            'id'       => 'meta-tp-download-file',
            'type'     => 'media',
            'url'      => true,
            'mode'     => false,
            'title'    => esc_html__( 'Download file', 'floral' ),
            'subtitle' => esc_html__( 'Choose download file.', 'floral' ),
            'desc'     => '',
            'default'  => '',
            'required' => array( 'meta-tp-type', '=', 'free' )
        ),
    )
);