<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-post-excerpt-map.php
 * @time    : 9/10/16 4:46 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$shortcodes[Floral_SC_Gitem_Post_Excerpt::SC_BASE] = array(
    'name'           => __( 'Floral Post Excerpt', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Post_Excerpt::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Single Image From Meta Or Custom', 'w9-floral-addon' ),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-credit-card',
    'php_class_name' => 'Floral_SC_Gitem_Post_Excerpt',
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'params'         => array(
        array(
            'type' => 'number',
            'heading' => __( 'Post Excerpt Max Character', 'w9-floral-addon' ),
            'description' => __( 'Post excerpt max character.', 'w9-floral-addon' ),
            'param_name' => 'post_excerpt_max_length',
            'std' => '100'
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Text Before Read More Link', 'w9-floral-addon' ),
            'description' => __( 'Text before read more link', 'w9-floral-addon' ),
            'param_name' => 'text_before_readmore_link',
            'std' => '... '
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Read More Label', 'w9-floral-addon' ),
            'description' => __( 'Read more text label.', 'w9-floral-addon' ),
            'param_name' => 'readmore_text',
            'std' => 'Read more'
        ),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::extra_class(),
    ),
);