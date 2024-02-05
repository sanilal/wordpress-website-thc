<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-footer.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Footer Section
*/
$content_template_list = floral_get_content_template_list();

$this->sections[] = array(
    'title'  => esc_html__( 'Footer', 'floral' ),
    'desc'   => esc_html__( 'Change the footer section configuration.', 'floral' ),
    'icon'   => 'fa fa-ellipsis-h',
    'fields' => array(
        array(
            'id'        => 'footer-override-default',
            'type'      => 'select',
            'multi'     => true,
            'title'     => esc_html__( 'Override default footer settings in', 'floral' ),
            'subtitle'  => esc_html__( 'Choose which template you need to override the default settings in here.', 'floral' ),
            'desc'      => esc_html__( 'The tabs will appear after you save the change.', 'floral' ) .
                '<br />  <strong style="color: red;">' . esc_html__( 'Notice 1: If the page doesn\'t auto refresh, please refresh the page after changing and saving this option.', 'floral' ) . '</strong> </br> <strong style="color: red;">' .
                esc_html__( 'Notice 2: If an item is removed, the options will be saved automatically after the page auto refresh, please wait a bit.', 'floral' ) . '</strong>',
            'options'   => floral_get_template_prefix( 'options_field' ),
            'default'   => array(),
            'ajax_save' => false
//            'compiler' => true,
//            'reload_on_change' => true
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Default Footer Settings', 'floral' ),
        ),
        array(
            'id'       => 'footer-enable',
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
            'id'       => 'footer-content-template',
            'type'     => 'select',
            'title'    => esc_html__( 'Footer content template', 'floral' ),
            'options'  => $content_template_list,
            'desc'     => esc_html__( 'Select content template for footer.', 'floral' ),
            'default'  => '',
            'required' => array( 'footer-enable', '=', array( 'custom' ) )
        ),

        array(
            'id'       => 'footer-copyright-text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright text', 'floral' ),
            'subtitle' => esc_html__( 'Enter the copyright text for the footer.', 'floral' ),
            'required' => array( 'footer-enable', '=', 'simple' ),
            'default'  => __( '<span class="light-color s-font fs-italic">Creative WordPress Theme made by 9WPThemes</span>', 'floral' )
        ),
        
        array(
            'id'             => 'footer-padding',
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
            'required'       => array( 'footer-enable', '=', 'simple' ),
            'output'         => array( '.site-footer .footer-content-area' )
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'title'    => esc_html__( 'Footer colors', 'floral' ),
            'required' => array( 'footer-enable', '=', 'simple' ),
        ),
        array(
            'id'       => 'footer-colors',
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
            'required' => array( 'footer-enable', '=', 'simple' ),
        ),
        
        array(
            'id'       => 'footer-background-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Footer background color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'footer-colors', '=', 'custom'
            ),
            'default'  => array(
                'color' => '#222',
                'alpha' => '1',
                'rgba'  => 'rgba(0, 0, 0, 1)'
            ),
            'compiler' => true
        ),
        
        array(
            'id'       => 'footer-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => 'footer-heading-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer heading text color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        ),
        
        array(
            'id'       => 'footer-link-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'footer-colors', '=', 'custom'
            ),
            'default'  => '#868686',
            'compiler' => true
        ),
        
        array(
            'id'       => 'footer-link-hover-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Footer link hover color', 'floral' ),
            'subtitle' => '',
            'required' => array(
                'footer-colors', '=', 'custom'
            ),
            'default'  => '#fff',
            'compiler' => true
        )
    
    ) // #fields
);