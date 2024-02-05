<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-content-template.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Content Template
*/

$content_template_list = floral_get_content_template_list();

$this->sections[] = array(
    'title'  => esc_html__( 'Content Template', 'floral' ),
    'desc'   => sprintf( esc_html__( 'Select content template for some specific position in page or %s here.', 'floral' ), '<a href="' . admin_url( '/post-new.php?post_type=content-template' ) . '" target="_blank">' . esc_html__( 'create new', 'floral' ) . '</a>' ),
    'icon'   => 'dashicons-before dashicons-format-aside',
    'fields' => array(
        
        array(
            'id'        => 'content-template-override-default',
            'type'      => 'select',
            'multi'     => true,
            'title'     => esc_html__( 'Override default content template settings in', 'floral' ),
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
            'subtitle' => esc_html__( 'Header Area', 'floral' ),
        ),
        // Before header
        array(
            'id'      => 'content-template-before-header',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for before header area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for before header area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),
        
        // After header
        array(
            'id'      => 'content-template-after-header',
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
            'id'      => 'content-template-after-page-title',
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
            'id'      => 'content-template-before-footer',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for before footer area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for before footer area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),
        
        
        // After footer
        array(
            'id'      => 'content-template-after-footer',
            'type'    => 'select',
            'title'   => esc_html__( 'Content template for after footer area', 'floral' ),
            'desc'    => esc_html__( 'Select content template for after footer area.', 'floral' ),
            'options' => $content_template_list,
            'default' => '',
        ),
    
    ), // #fields
);