<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general-subzone.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * General Section
*/

$this->sections[] = array(
    'title'  => esc_html__( 'Sub Zone Settings', 'floral' ),
    'desc'   => esc_html__( 'Configure left, right zone of page settings.', 'floral' ),
    'icon'   => 'w9 w9-ico-arrows-expand-horizontal1',
    'fields' => array(
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Popup Zone Settings', 'floral' )
        ),
        
        array(
            'id'       => 'page-popup-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Popup zone color', 'floral' ),
            'output'   => array( 'color' => '.floral-popup' ),
            'default'  => '#fff',
            'validate' => 'color',
        ),
        
        array(
            'id'       => 'page-popup-link-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Popup zone link color', 'floral' ),
            'output'   => array( '.floral-popup a' ),
            'compiler' => true,
            'default'  => array(
                'regular' => '#fff',
                'hover'   => '#fff',
                'active'  => '#fff',
            )
        ),
        
        array(
            'id'      => 'page-popup-background',
            'type'    => 'background',
            'title'   => esc_html__( 'Popup zone background', 'floral' ),
            'output'  => array( '.floral-popup' ),
            'default' => array(
                'background-color' => 'transparent',
            )
        ),
        
        array(
            'id'      => 'page-popup-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Popup zone background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.mfp-bg' ),
            'default' => array(
                'color' => '#000000',
                'alpha' => '0.95'
            ),
        ),
        
        array(
            'id'       => 'page-popup-sidebar-width',
            'type'     => 'dimensions',
            'height'   => false,
            'title'    => esc_html__( 'Popup sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Content width if popup content is sidebar.', 'floral' ),
            'units'    => 'px',
            'output'   => '.floral-popup-sidebar',
            'default'  => array( 'width' => '400px' ),
            'compiler' => true,
        ),
        
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Left Zone Settings', 'floral' )
        ),
        
        array(
            'id'       => 'page-leftzone-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Left zone sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the left zone content from sidebar list.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-subzone-left',
        ),
        
        array(
            'id'       => 'page-leftzone-bottom-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Left zone bottom sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the left zone content from sidebar list.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-subzone-left-bottom',
        ),
        
        array(
            'id'       => 'page-leftzone-width',
            'type'     => 'dimensions',
            'height'   => false,
            'title'    => esc_html__( 'Left zone width', 'floral' ),
            'subtitle' => esc_html__( 'Choose the left zone width.', 'floral' ),
            'units'    => 'px',
            'default'  => array( 'width' => '300px' ),
            'compiler' => true,
        ),
        
        array(
            'id'       => 'page-leftzone-position',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Left zone position', 'floral' ),
            'subtitle' => esc_html__( 'Left zone position with page.', 'floral' ),
            'options'  => array(
                'static' => esc_html__( 'Static', 'floral' ),
                'fixed'  => esc_html__( 'Fixed', 'floral' ),
            ),
            'default'  => 'fixed'
        ),
        
        array(
            'id'       => 'page-leftzone-breakpoint',
            'type'     => 'dimensions',
            'height'   => false,
            'title'    => esc_html__( 'Left zone breakpoint', 'floral' ),
            'subtitle' => esc_html__( 'Left zone get left page spacing when open with window width bigger than left zone breakpoint.', 'floral' ),
            'units'    => 'px',
            'default'  => array( 'width' => '1500px' ),
            'compiler' => true,
        ),
        
        array(
            'id'       => 'page-leftzone-default-open',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Left zone open in big screen', 'floral' ),
            'subtitle' => esc_html__( 'Left size zone open if window width bigger than "Left Zone Breakpoint".', 'floral' ),
            'options'  => array(
                'open'  => esc_html__( 'Open', 'floral' ),
                'close' => esc_html__( 'Close', 'floral' ),
            ),
            'default'  => 'close'
        ),
        
        array(
            'id'       => 'page-leftzone-dismiss-position',
            'type'     => 'button_set',
            'title'    => esc_html__('Left zone dismiss position', 'floral' ),
            'options'  => array(
                'dismiss-left'  => esc_html__( 'Left', 'floral' ),
                'dismiss-right' => esc_html__( 'Right', 'floral' ),
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss position.', 'floral' ),
            'default'  => 'dismiss-right',
        ),
        
        array(
            'id'       => 'page-leftzone-dismiss-icon',
            'type'     => 'button_set',
            'title'    => esc_html__('Left zone dismiss icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-close'             => '<i class="w9 w9-ico-close"></i>',
                'w9 w9-ico-close-1'           => '<i class="w9 w9-ico-close-1"></i>',
                'w9 w9-ico-cancel-circled'    => '<i class="w9 w9-ico-cancel-circled"></i>',
                'w9 w9-ico-back'              => '<i class="w9 w9-ico-back"></i>',
                'w9 w9-ico-arrows-move-left'  => '<i class="w9 w9-ico-arrows-move-left"></i>',
                'w9 w9-ico-arrows-move-right' => '<i class="w9 w9-ico-arrows-move-right"></i>',
                'w9 w9-ico-right'             => '<i class="w9 w9-ico-right"></i>',
                'w9 w9-ico-left'              => '<i class="w9 w9-ico-left"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss icon.', 'floral' ),
            'default'  => 'w9 w9-ico-close',
        ),
        
        array(
            'id'       => 'page-leftzone-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Left zone color', 'floral' ),
            'output'   => array( 'color' => '.page-leftzone' ),
            'default'  => '#fff',
            'validate' => 'color',
        ),
        
        array(
            'id'       => 'page-leftzone-link-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Page left zone link color', 'floral' ),
            'output'   => array( '.page-leftzone a' ),
            'compiler' => true,
            'default'  => array(
                'regular' => '#fff', // blue
                'hover'   => '#fff', // red
                'active'  => '#fff',  // purple
            )
        ),
        
        array(
            'id'      => 'page-leftzone-background',
            'type'    => 'background',
            'title'   => esc_html__( 'Page left zone background', 'floral' ),
            'output'  => array( '.page-leftzone' ),
            'default' => array(
                'background-color' => 'transparent',
            )
        ),
        
        array(
            'id'      => 'page-leftzone-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Page left zone background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.page-leftzone .zone-content' ),
            'default' => array(
                'color' => '#000000',
                'alpha' => '0.95'
            ),
        ),
        
        array(
            'id'      => 'page-leftzone-border',
            'type'    => 'border',
            'title'   => esc_html__( 'left zone border', 'floral' ),
            'output'  => array( '.page-leftzone' ),
            'all'     => false,
            'default' => array(
                'border-color'  => '#eeeeee',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-left'   => '0px'
            )
        ),
        
        array(
            'id'             => 'page-leftzone-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'output'         => array( '.page-leftzone .zone-content, .page-leftzone .dismiss-zone' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Page left zone padding', 'floral' ),
            'default'        => array(
                'padding-left'   => '30px',
                'padding-right'  => '30px',
                'padding-top'    => '30px',
                'padding-bottom' => '25px',
                'units'          => 'px',
            )
        ),
        
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Right Zone Settings', 'floral' )
        ),
        
        array(
            'id'       => 'page-rightzone-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Right zone sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the Right zone content from sidebar list.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-subzone-right',
        ),
        
        array(
            'id'       => 'page-rightzone-bottom-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Right zone bottom sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the Right zone content from sidebar list.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-subzone-right-bottom',
        ),
        
        array(
            'id'       => 'page-rightzone-width',
            'type'     => 'dimensions',
            'height'   => false,
            'title'    => esc_html__( 'Right zone width', 'floral' ),
            'subtitle' => esc_html__( 'Choose the Right zone width.', 'floral' ),
            'units'    => 'px',
            'default'  => array( 'width' => '300px' ),
            'compiler' => true,
        ),
        
        array(
            'id'       => 'page-rightzone-position',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Right zone position', 'floral' ),
            'subtitle' => esc_html__( 'Right zone position with page.', 'floral' ),
            'options'  => array(
                'static' => esc_html__( 'Static', 'floral' ),
                'fixed'  => esc_html__( 'Fixed', 'floral' ),
            ),
            'default'  => 'fixed'
        ),
        
        array(
            'id'       => 'page-rightzone-breakpoint',
            'type'     => 'dimensions',
            'height'   => false,
            'title'    => esc_html__( 'Right zone breakpoint', 'floral' ),
            'subtitle' => esc_html__( 'Right zone get Right page spacing when open with window width bigger than Right zone breakpoint.', 'floral' ),
            'units'    => 'px',
            'default'  => array( 'width' => '1500px' ),
            'compiler' => true,
        ),
        
        array(
            'id'       => 'page-rightzone-default-open',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Right zone open in big screen', 'floral' ),
            'subtitle' => esc_html__( 'Right size zone open if window width bigger than "Right Zone Breakpoint".', 'floral' ),
            'options'  => array(
                'open'  => esc_html__( 'Open', 'floral' ),
                'close' => esc_html__( 'Close', 'floral' ),
            ),
            'default'  => 'close'
        ),
        
        array(
            'id'       => 'page-rightzone-dismiss-position',
            'type'     => 'button_set',
            'title'    => esc_html__('Right zone dismiss position', 'floral' ),
            'options'  => array(
                'dismiss-left'  => esc_html__( 'Left', 'floral' ),
                'dismiss-right' => esc_html__( 'Right', 'floral' ),
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss position.', 'floral' ),
            'default'  => 'dismiss-left',
        ),
        
        array(
            'id'       => 'page-rightzone-dismiss-icon',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Right zone dismiss icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-close'             => '<i class="w9 w9-ico-close"></i>',
                'w9 w9-ico-close-1'           => '<i class="w9 w9-ico-close-1"></i>',
                'w9 w9-ico-cancel-circled'    => '<i class="w9 w9-ico-cancel-circled"></i>',
                'w9 w9-ico-back'              => '<i class="w9 w9-ico-back"></i>',
                'w9 w9-ico-arrows-move-left'  => '<i class="w9 w9-ico-arrows-move-left"></i>',
                'w9 w9-ico-arrows-move-right' => '<i class="w9 w9-ico-arrows-move-right"></i>',
                'w9 w9-ico-right'             => '<i class="w9 w9-ico-right"></i>',
                'w9 w9-ico-left'              => '<i class="w9 w9-ico-left"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite dismiss icon.', 'floral' ),
            'default'  => 'w9 w9-ico-close',
        ),
        
        array(
            'id'       => 'page-rightzone-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Right zone color', 'floral' ),
            'output'   => array( 'color' => '.page-rightzone' ),
            'default'  => '#ffffff',
            'validate' => 'color',
        ),
        
        array(
            'id'       => 'page-rightzone-link-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Page right zone link color', 'floral' ),
            'output'   => array( '.page-rightzone a' ),
            'compiler' => true,
            'default'  => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
                'active'  => '#ffffff',
            )
        ),
        
        array(
            'id'      => 'page-rightzone-background',
            'type'    => 'background',
            'title'   => esc_html__( 'Page right zone background', 'floral' ),
            'output'  => array( '.page-rightzone' ),
            'default' => array(
                'background-color' => 'transparent',
            )
        ),
        
        array(
            'id'      => 'page-rightzone-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Page right zone background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.page-rightzone .zone-content' ),
            'default' => array(
                'color' => '#000000',
                'alpha' => '0.95'
            ),
        ),
        
        array(
            'id'      => 'page-rightzone-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Right zone border', 'floral' ),
            'output'  => array( '.page-rightzone' ),
            'all'     => false,
            'default' => array(
                'border-color'  => '#eeeeee',
                'border-style'  => 'solid',
                'border-top'    => '0px',
                'border-right'  => '0px',
                'border-bottom' => '0px',
                'border-Right'  => '0px'
            )
        ),
        
        array(
            'id'             => 'page-rightzone-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'output'         => array( '.page-rightzone .zone-content, .page-rightzone .dismiss-zone' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Page right zone padding', 'floral' ),
            'default'        => array(
                'padding-left'  => '30px',
                'padding-right'  => '30px',
                'padding-top'    => '30px',
                'padding-bottom' => '25px',
                'units'          => 'px',
            )
        ),
    ),
);