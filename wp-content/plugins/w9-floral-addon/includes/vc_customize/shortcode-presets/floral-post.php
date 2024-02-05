<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-post.php
 * @time    : 9/12/16 9:58 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$presets_settings['vc_basic_grid'] = array(
    array(
        'name'     => __( 'Post Slider 3 Item Vertical Style 01 | Background Dark ', 'w9-floral-addon' ),
//            'default'  => true,
        'settings' => array (
            'post_type' => 'post',
            'max_items' => '10',
            'style' => 'slider',
            'special_item' => '%5B%7B%22element_width%22%3A%221%22%2C%22item%22%3A%22673%22%7D%5D',
            'paging_design' => 'floral-pagination',
            'paging_color' => 'light',
            'item' => 'floralPostListing_VerticalStyle01',
            'grid_id' => 'vc_gid:1473675580196-66a680f8-e38f-0',
        ),
    ),
    array(
        'name'     => __( 'Post Slider 2 Item Horizontal Style 01 | Background Light ', 'w9-floral-addon' ),
//            'default'  => true,
        'settings' => array (
            'post_type' => 'post',
            'max_items' => '10',
            'style' => 'slider',
            'element_width' => '6',
            'special_item' => '%5B%7B%22element_width%22%3A%221%22%2C%22item%22%3A%22673%22%7D%5D',
            'paging_design' => 'floral-pagination',
            'paging_color' => 'meta-text',
            'item' => 'floralPostListing_HorizontalStyle01',
            'grid_id' => 'vc_gid:1473675580200-2744f7e3-9ed2-6',
        ),
    ),
    array(
        'name'     => __( 'Post Slider 2 Item Horizontal Style 02 | Background Dark', 'w9-floral-addon' ),
//            'default'  => true,
        'settings' => array (
            'post_type' => 'post',
            'max_items' => '10',
            'style' => 'slider',
            'element_width' => '6',
            'special_item' => '%5B%7B%22element_width%22%3A%221%22%2C%22item%22%3A%22673%22%7D%5D',
            'paging_design' => 'floral-pagination',
            'paging_color' => 'light',
            'item' => 'floralPostListing_HorizontalStyle02',
            'grid_id' => 'vc_gid:1473675580202-4bd0f1e9-0185-2',
        ),
    ),
);