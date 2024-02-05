<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-footer-template.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$content_template_list = floral_get_content_template_list();
$template_name         = floral_get_template_prefix( 'name', $template );
$template_name_lower   = strtolower( $template_name );

$this->sections[] = array(
    'title'      => $template_name . esc_html__( ' Footer', 'floral' ),
    'desc'       => sprintf( esc_html__( 'Change the %s footer section configuration.', 'floral' ), $template_name_lower ),
    'icon'       => 'fa fa-plus-circle',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => $template . 'footer-enable',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer template', 'floral' ),
            'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'floral' ),
            'options'  => array(
                'simple' => esc_html__( 'Simple', 'floral' ),
                'custom' => esc_html__( 'Content Template', 'floral' ),
                'off'    => esc_html__( 'Off', 'floral' )
            ),
            'default'  => 'simple',
        ),

        array(
            'id'       => $template . 'footer-content-template',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer content template', 'floral' ),
            'options'  => $content_template_list,
            'desc'     => esc_html__( 'Select content template for footer.', 'floral' ),
            'default'  => '',
            'required' => array( $template . 'footer-enable', '=', array( 'custom' ) )
        ),
        
        array(
            'id'       => $template . 'footer-copyright-text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright text', 'floral' ),
            'subtitle' => esc_html__( 'Enter the copyright text for the footer.', 'floral' ),
            'required' => array( $template . 'footer-enable', '=', 'simple' ),
            'default'  => __( '<span class="light-color s-font fs-italic">Creative WordPress Theme made by 9WPThemes</span>', 'floral' )
        ),
        
        array(
            'id'             => $template . 'footer-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__( 'Padding top/bottom', 'floral' ),
            'subtitle'       => esc_html__( 'This must be numeric (no px). Leave blank for default.', 'floral' ),
            'desc'           => esc_html__( 'If you would like to override the default footer top/bottom padding, then you can do so here.', 'floral' ),
            'left'           => false,
            'right'          => false,
            'default'        => array(
	            'padding-top'    => '18px',
	            'padding-bottom' => '18px',
                'units'          => 'px',
            ),
            'required'       => array( $template . 'footer-enable', '=', 'simple' ),
            'output'         => array( '.site-footer.' . $template . ' .footer-content-area' )
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'title'    => esc_html__( 'Footer Colors', 'floral' ),
            'required' => array( $template . 'footer-enable', '=', 'simple' ),
        ),
        array(
            'id'       => $template . 'footer-colors',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer colors style', 'floral' ),
            'subtitle' => esc_html__( 'Choose footer color style.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'gray'   => esc_html__( 'Gray', 'floral' ),
                'light'  => esc_html__( 'Light', 'floral' ),
                'dark'   => esc_html__( 'Dark', 'floral' ),
                'custom' => esc_html__( 'Custom', 'floral' ),
            ),
            'default'  => 'gray',
            'compiler' => true,
            'required' => array( $template . 'footer-enable', '=', 'simple' ),
        ),
        
        array(
            'id'       => $template . 'footer-background-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Footer background color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                $template . 'footer-colors', '=', 'custom'
            ),
            'default'  => array(
                'color' => '#222',
                'alpha' => '1',
                'rgba'  => 'rgba(0, 0, 0, 1)'
            ),
            'compiler' => true
        ),
        
        array(
            'id'       => $template . 'footer-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                $template . 'footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => $template . 'footer-heading-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer heading text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                $template . 'footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        ),
        
        array(
            'id'       => $template . 'footer-link-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                $template . 'footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => $template . 'footer-link-hover-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link hover color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                $template . 'footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        )
    
    ) // #fields
);