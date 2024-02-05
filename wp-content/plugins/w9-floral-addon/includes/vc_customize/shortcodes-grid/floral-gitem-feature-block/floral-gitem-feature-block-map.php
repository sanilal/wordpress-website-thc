<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-feature-block-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$shortcodes[Floral_SC_Gitem_Feature_Block::SC_BASE] = ( array(
    'name'           => __( 'Floral Post Feature Block', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Feature_Block::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Get post feature in block style', 'w9-floral-addon' ),
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-object-group',
    'php_class_name' => 'Floral_SC_Gitem_Feature_Block',
    'params'         => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Output type', 'w9-floral-addon' ),
            'param_name'  => 'output_type',
            'admin_label' => true,
            'value'       => array(
                __( 'Image', 'w9-floral-addon' )               => 'image',
                __( 'Image Carousel', 'w9-floral-addon' )      => 'gallery',
                __( 'Video', 'w9-floral-addon' )               => 'video',
                __( 'Audio', 'w9-floral-addon' )               => 'audio',
                __( 'Auto by post format', 'w9-floral-addon' ) => 'embed',
            ),
            'std'         => 'text'
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Image source', 'w9-floral-addon'),
            'param_name' => 'output_type',
            'admin_label' => true,
            'value' => array(
                __( 'Post Thumbnail', 'w9-floral-addon' ) => 'post_thumbnail',
                __( 'Single Image From Post Type', 'w9-floral-addon' ) => 'post_thumbnail',
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => __('Video source', 'w9-floral-addon'),
            'param_name' => 'output_type',
            'admin_label' => true,
            'value' => array(
                __( 'Post format video', 'w9-floral-addon' ) => '',
            )
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
    ),
) );