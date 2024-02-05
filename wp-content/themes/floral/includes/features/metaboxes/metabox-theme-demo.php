<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-theme-demo.php
 * @time    : 8/28/16 5:39 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Theme Product', 'floral' ),
    'icon'   => 'el-icon-screen',
    'fields' => array(
        array(
            'id'    => 'meta-theme-demo-url',
            'title' => esc_html__( 'Theme demo URL', 'floral' ),
            'subtitle' => esc_html__( 'Fill URL of theme demo.', 'floral' ),
            'type'  => 'text',
        )
    )
);