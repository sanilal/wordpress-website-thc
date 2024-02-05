<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-feature-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$shortcodes[Floral_SC_Gitem_Feature::SC_BASE] = array(
    'name'           => __( 'Floral Post Feature', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Feature::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Define simple feature in format label : content', 'w9-floral-addon' ),
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-rocket',
    'php_class_name' => 'Floral_SC_Gitem_Feature',
    'params'         => array(
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Label', 'w9-floral-addon' ),
            'param_name'  => 'label',
            'admin_label' => true,
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Post feature', 'w9-floral-addon' ),
            'description' => __( 'Select post feature, some feature not available in all post type.', 'w9-floral-addon' ),
            'param_name'  => 'post_feature',
            'value'       => array(
                __( 'Date', 'w9-floral-addon' )           => 'date',
                __( 'Categories', 'w9-floral-addon' )     => 'categories',
                __( 'Authors', 'w9-floral-addon' )        => 'author',
                __( 'Number Comment', 'w9-floral-addon' ) => 'number-comment',
                __( 'Tags', 'w9-floral-addon' )           => 'tags',
                __( 'Social Follow', 'w9-floral-addon' )  => 'social-follow',
                __( 'Terms', 'w9-floral-addon' )          => 'terms',
            ),
            'admin_label' => true,
        ),
        array(
            'type'       => 'textfield',
            'heading'    => __( 'Taxonomy', 'w9-floral-addon' ),
            'param_name' => 'taxonomy',
            'dependency' => array(
                'element' => 'post_feature',
                'value'   => 'terms'
            )
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Separator', 'w9-floral-addon' ),
            'description' => __( 'Separator between categories, term, tags.', 'w9-floral-addon' ),
            'param_name'  => 't_separator',
            'value'       => array(
                __( 'Comma', 'w9-floral-addon' ) => 'comma',
                __( 'Slash', 'w9-floral-addon' ) => 'slash',
                __( 'Minus', 'w9-floral-addon' ) => 'minus'
            ),
            'dependency'  => array(
                'element' => 'post_feature',
                'value'   => 'categories'
            )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Empty string', 'w9-floral-addon' ),
            'description' => __( 'This stirng print when feature not available.', 'w9-floral-addon' ),
            'param_name'  => 'empty_string',
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Feature display', 'w9-floral-addon' ),
            'description' => __( 'Control feature display with another feature, object in post grid.', 'w9-floral-addon' ),
            'param_name'  => 'feature_display',
            'value'       => array(
                __( 'Block', 'w9-floral-addon' )  => 'block',
                __( 'Inline', 'w9-floral-addon' ) => 'inline',
            )
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
    ),
);