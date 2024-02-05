<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-subzone.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * General Section
*/

$sections[] = array(
    'title'  => esc_html__( 'Sub Zone Settings', 'floral' ),
    'desc'   => esc_html__( 'Configure left, right zone of page settings.', 'floral' ),
    'icon'   => 'w9 w9-ico-arrows-expand-horizontal1',
    'fields' => array(
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Left Zone Settings', 'floral' )
        ),
        
        array(
            'id'       => 'meta-page-leftzone-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Left zone content', 'floral' ),
            'subtitle' => esc_html__( 'Choose the left zone content from sidebar list.', 'floral' ),
            'desc'     => esc_html__( 'Leave empty mean use this setting from "Theme Options".', 'floral' ),
            'data'     => 'sidebars',
            'default'  => '',
        ),
        
        array(
            'id'       => 'meta-page-leftzone-position',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Left zone position', 'floral' ),
            'subtitle' => esc_html__( 'Left zone position with page.', 'floral' ),
            'options'  => array(
                ''       => esc_html__( 'Default', 'floral' ),
                'static' => esc_html__( 'Static', 'floral' ),
                'fixed'  => esc_html__( 'Fixed', 'floral' ),
            ),
            'default'  => ''
        ),
        
        array(
            'id'       => 'meta-page-leftzone-default-open',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Left zone open in big screen', 'floral' ),
            'subtitle' => esc_html__( 'Left size zone open if window width bigger than "Left Zone Breakpoint".', 'floral' ),
            'options'  => array(
                ''      => esc_html__( 'Default', 'floral' ),
                'open'  => esc_html__( 'Open', 'floral' ),
                'close' => esc_html__( 'Close', 'floral' ),
            ),
            'default'  => ''
        ),
        
        array(
            'id'       => 'meta-page-leftzone-dismiss-position',
            'type'     => 'button_set',
            'title'    => 'Left zone dismiss position',
            'options'  => array(
                ''              => esc_html__( 'Default', 'floral' ),
                'dismiss-left'  => esc_html__( 'Left', 'floral' ),
                'dismiss-right' => esc_html__( 'Right', 'floral' ),
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss position.', 'floral' ),
            'default'  => '',
        ),
        
        
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Right Zone Settings', 'floral' )
        ),
        
        array(
            'id'       => 'meta-page-rightzone-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Right zone content', 'floral' ),
            'subtitle' => esc_html__( 'Choose the Right zone content from sidebar list.', 'floral' ),
            'desc'     => esc_html__( 'Leave empty mean use this setting from "Theme Options".', 'floral' ),
            'data'     => 'sidebars',
            'default'  => '',
        ),
        
        array(
            'id'       => 'meta-page-rightzone-position',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Right zone position', 'floral' ),
            'subtitle' => esc_html__( 'Right zone position with page.', 'floral' ),
            'options'  => array(
                ''       => esc_html__( 'Default', 'floral' ),
                'static' => esc_html__( 'Static', 'floral' ),
                'fixed'  => esc_html__( 'Fixed', 'floral' ),
            ),
            'default'  => ''
        ),

        array(
            'id'       => 'meta-page-rightzone-default-open',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Right zone open in big screen', 'floral' ),
            'subtitle' => esc_html__( 'Right size zone open if window width bigger than "Right Zone Breakpoint".', 'floral' ),
            'options'  => array(
                ''      => esc_html__( 'Default', 'floral' ),
                'open'  => esc_html__( 'Open', 'floral' ),
                'close' => esc_html__( 'Close', 'floral' ),
            ),
            'default'  => ''
        ),
        
        array(
            'id'       => 'meta-page-rightzone-dismiss-position',
            'type'     => 'button_set',
            'title'    => esc_html__('Right zone dismiss position', 'floral' ),
            'options'  => array(
                ''              => esc_html__( 'Default', 'floral' ),
                'dismiss-left'  => esc_html__( 'Left', 'floral' ),
                'dismiss-right' => esc_html__( 'Right', 'floral' ),
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss position.', 'floral' ),
            'default'  => '',
        ),
    ),
);