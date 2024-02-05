<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-content-page.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * General Section
*/

$sections[] = array(
    'title'  => esc_html__( 'Other Options', 'floral' ),
    'desc'   => esc_html__( 'Other options for page.', 'floral' ),
    'icon'   => 'el el-cogs',
    'fields' => array(
        array(
            'id'             => 'meta-page-margin',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__( 'Page margin', 'floral' ),
            'subtitle'       => esc_html__( 'Set page margin.', 'floral' ),
            'desc'           => '',
            'left'           => false,
            'right'          => false,
            'default'        => array(),
            'output'         => array( '.site-main-page' ),
        ),
        
        array(
            'id'       => 'meta-page-comment',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable comments?', 'floral' ),
            'subtitle' => esc_html__( 'If on, the comment form will be avaliable for this page.', 'floral' ),
            'options'  => array(
                '1' => 'On',
                ''  => 'Default',
                '0' => 'Off',
            ),
            'default'  => '',
        ),

        array(
            'id'       => 'meta-slipscreen',
            'type'     => 'switch',
            'title'    => esc_html__( 'Slipscreen', 'floral' ),
            'subtitle' => esc_html__( 'Enable or disable slipscreen mode.', 'floral' ),
            'desc'     => '',
            'default'  => 0
        ),

//        array(
//            'id'       => 'meta-page-fullscreen',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Page full screen', 'floral' ),
//            'subtitle' => esc_html__( 'Enable or disable "Page Full Screen" mode. This option does not work with "Slipscreen" mode and "Page Left Title" template.', 'floral' ),
//            'desc'     => '',
//            'default'  => 0
//        )
    ),
);