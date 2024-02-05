<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-button-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once Floral_Addon::plugin_dir() . 'includes/vc_customize/shortcodes/floral-button/floral-button.php';
global $vc_gitem_add_link_param;
$btn_action = $vc_gitem_add_link_param;
$btn_action['value'][__( 'Meta URL Key', 'w9-floral-addon' )] = 'meta-key';
$button_param = Floral_SC_Button::map()['params'];
foreach ($button_param as $index=>$param){
    if(isset($param['param_name']) && $param['param_name'] == 'btn_link'){
        $button_param[$index]['dependency'] = array(
            'element' => 'gitem_btn_link',
            'value' => 'custom'
        );
    }
}

$shortcodes[Floral_SC_Gitem_Button::SC_BASE]  = (array(
    'name'           => __( 'Floral Button', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Button::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Button with common action', 'w9-floral-addon' ),
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-bold',
    'php_class_name' => 'Floral_SC_Gitem_Button',
    'params'         => array_merge(
        array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Button URL', 'w9-floral-addon' ),
                'param_name' => 'gitem_btn_link',
                'value' => array(
                    __( 'None', 'w9-floral-addon' ) => 'none',
                    __( 'Post Link', 'w9-floral-addon') => 'post_link',
                    __( 'Meta Key', 'w9-floral-addon' ) => 'meta_key',
                    __( 'Custom' , 'w9-floral-addon') => 'custom',
                    __( 'Link to booking page' , 'w9-floral-addon') => 'booking-page',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Meta key', 'w9-floral-addon' ),
                'param_name' => 'gitem_btn_link_meta',
                'dependency' => array(
                    'element' => 'gitem_btn_link',
                    'value' => array( 'meta_key' ),
                ),
                'description' => __( 'Fill meta key contain url.', 'w9-floral-addon' ),
            ),
        ),
        $button_param
    ),
));