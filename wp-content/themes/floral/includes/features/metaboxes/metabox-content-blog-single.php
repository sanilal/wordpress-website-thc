<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-content-blog-single.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Other Options', 'floral' ),
    'desc'   => esc_html__( 'Other options for blog single.', 'floral' ),
    'icon'   => 'el el-cogs',
    'fields' => array(
        array(
            'id'       => 'meta-blog-single-resize-image',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Resize post featured image?', 'floral' ),
            'subtitle' => esc_html__( 'Resize post featured image for this single post or not?', 'floral' ),
            'options'  => array(
                '1' => 'On',
                ''  => 'Default',
                '0' => 'Off',
            ),
            'default'  => '',
        ),
    ),
);