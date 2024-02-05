<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-product-footer.php
 * @time    : 9/28/16 4:27 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Footer Section
*/
//$template = get_template
$content_template_list = floral_get_content_template_list();

$sections[] = array(
    'title'  => esc_html__( 'Footer', 'floral' ),
    'desc'   => esc_html__( 'Change the footer section configuration.', 'floral' ),
    'icon'   => 'fa fa-ellipsis-h',
    'fields' => array(
        array(
            'id'       => 'meta-footer-enable',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer template', 'floral' ),
            'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'floral' ),
            'options'  => array(
                ''       => esc_html__( 'Default', 'floral' ),
                'simple' => esc_html__( 'Simple', 'floral' ),
                'custom' => esc_html__( 'Content Template', 'floral' ),
                'off'    => esc_html__( 'Off', 'floral' )
            ),
            'default'  => '',
        ),

        array(
            'id'       => 'meta-footer-content-template',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer content template', 'floral' ),
            'options'  => $content_template_list,
            'desc'     => esc_html__( 'Select content template for page title.', 'floral' ),
            'default'  => '',
            'required' => array( 'meta-footer-enable', '=', array( 'custom', '' ) )
        ),
        
        array(
            'id'       => 'meta-footer-copyright-text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright text', 'floral' ),
            'subtitle' => esc_html__( 'Enter the copyright text for the footer.', 'floral' ),
            'required' => array( 'meta-footer-enable', '=', array( 'simple', '' ) ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'title'    => esc_html__( 'Footer colors', 'floral' ),
            'required' => array( 'meta-footer-enable', '=', array( 'simple', '' ) ),
        ),
        array(
            'id'       => 'meta-footer-colors',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer colors', 'floral' ),
            'subtitle' => esc_html__( 'Choose footer color style.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'gray'   => esc_html__( 'Gray', 'floral' ),
                'light'  => esc_html__( 'Light', 'floral' ),
                'dark'   => esc_html__( 'Dark', 'floral' ),
                'custom' => esc_html__( 'Custom', 'floral' ),
            ),
            'default'  => '',
            'compiler' => true,
            'required' => array( 'meta-footer-enable', '=', array( 'simple', '' ) ),
        ),
        
        array(
            'id'       => 'meta-footer-background-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Footer Background Color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'meta-footer-colors', '=', 'custom'
            ),
            'default'  => array(
                'color' => '#222',
                'alpha' => '1',
                'rgba'  => 'rgba(0, 0, 0, 1)'
            ),
            'compiler' => true
        ),
        
        array(
            'id'       => 'meta-footer-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'meta-footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => 'meta-footer-heading-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer heading text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'meta-footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        ),
        
        array(
            'id'       => 'meta-footer-link-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'meta-footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => 'meta-footer-link-hover-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link hover color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'meta-footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        )
    
    ) // #fields
);