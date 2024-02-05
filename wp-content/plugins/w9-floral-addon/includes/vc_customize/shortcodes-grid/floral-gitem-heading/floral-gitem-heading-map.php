<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-heading-map.php
 * @time    : 9/9/16 12:17 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-heading/floral-heading.php';
global $vc_gitem_add_link_param;
$heading_link = $vc_gitem_add_link_param;
$heading_link['value'][__( 'Meta URL Key', 'w9-floral-addon' )] = 'meta-key';
$heading_params = Floral_SC_Heading::map()['params'];
foreach ($heading_params as $index=>$param){
    if(isset($param['param_name']) && $param['param_name'] == 'heading_title_data_source'){
        $heading_params[$index]['value'] = array(
            esc_html__( 'Custom Content', 'w9-floral-addon' )          => 'custom-content',
            esc_html__( 'Post Title', 'w9-floral-addon' ) => 'post-title',
        );
    }
    if(isset($param['param_name']) && $param['param_name'] == 'heading_link'){
        $heading_params[$index]['dependency'] = array(
            'element' => 'gitem_heading_link',
            'value' => 'custom',
        );
    }
}

$shortcodes[Floral_SC_Gitem_Heading::SC_BASE]  = (array(
    'name'           => __( 'Floral Heading', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Heading::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Create awesome heading', 'w9-floral-addon' ),
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'class'          => 'vc-show-detail',
    'icon'           => 'w9 w9-ico-software-font-underline ',
    'php_class_name' => 'Floral_SC_Gitem_Heading',
    'params'         => array_merge(
        array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Heading URL', 'w9-floral-addon' ),
                'param_name' => 'gitem_heading_link',
                'value' => array(
                    __( 'None', 'w9-floral-addon' ) => 'none',
                    __( 'Post Link', 'w9-floral-addon') => 'post_link',
                    __( 'Meta Key', 'w9-floral-addon' ) => 'meta_key',
                    __( 'Custom' , 'w9-floral-addon') => 'custom',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Meta key', 'w9-floral-addon' ),
                'param_name' => 'gitem_heading_link_meta',
                'dependency' => array(
                    'element' => 'gitem_heading_link',
                    'value' => array( 'meta_key' ),
                ),
                'description' => __( 'Fill meta key contain url.', 'w9-floral-addon' ),
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'link_target',
                'heading'    => __( 'Open link in new tab?', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Yes, please!', 'w9-floral-addon' ) => 'yes',
                ),
                'std'        => '',
                'dependency' => array(
                    'element' => 'gitem_heading_link',
                    'value' => array('meta_key', 'post_link')
                )
            )
        ),
        $heading_params
    ),
));