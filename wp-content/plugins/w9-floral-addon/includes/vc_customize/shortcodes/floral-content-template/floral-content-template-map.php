<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-content-template-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


/*
 * Content Templpate Visual Composer
 * Outside Row
 */

if ( is_admin() && ( !defined( 'DOING_AJAX' ) && ( !post_type_exists( Floral_CPT_Content_Template::CPT_SLUG ) || floral_get_current_post_type() == Floral_CPT_Content_Template::CPT_SLUG ) ) ) {
    return;
}

$content_template_list = floral_get_content_template_list( true, false );
$content_template_list = array_merge(array( __( '__ Select Content Template __', 'w9-floral-addon' ) => ''), $content_template_list);

vc_map( array(
    'name'             => esc_html__( 'Floral Content Template', 'w9-floral-addon' ),
    'base'             => Floral_SC_Content_Template::SC_BASE,
    'class'            => '',
    'icon'             => 'w9 w9-ico-arrows-squares',
    'category'         => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'description'      => __( 'Use content template in page', 'w9-floral-addon' ),
    'php_class_name'   => 'Floral_SC_Content_Template',
    'params'           => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Content template', 'w9-floral-addon' ),
            'param_name'  => 'template',
            'admin_label' => true,
            'value'       => $content_template_list,
            'description' => __( 'Select the content template will be displayed in this section.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'hidden',
            'heading'     => __( 'Outside row', 'w9-floral-addon' ),
            'param_name'  => 'outside_row',
            'description' => __( 'Make this content template outside the row.', 'w9-floral-addon' ),
            'std'         => 'true'
        ),
    ),
    'js_view'          => 'FloralContentTemplateView',
    'admin_enqueue_js' => array( Floral_Addon::plugin_url() . 'assets/js/vc-custom.js' ),
) );