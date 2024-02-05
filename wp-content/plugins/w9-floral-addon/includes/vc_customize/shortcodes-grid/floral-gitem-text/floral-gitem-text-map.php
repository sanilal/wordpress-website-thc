<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-text-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$shortcodes[Floral_SC_Gitem_Text::SC_BASE] = (array(
    'name'           => __( 'Floral Text', 'w9-floral-addon' ),
    'base'           => Floral_SC_Gitem_Text::SC_BASE,
    'category'       => __( 'Elements', 'w9-floral-addon' ), //Use same name with JS composer
    'description'    => __( 'Output text with from meta info', 'w9-floral-addon' ),
    'post_type'      => Vc_Grid_Item_Editor::postType(),
    'class'          => 'vc-show-detail',
    'icon'           => 'fa fa-file-text',
    'php_class_name' => 'Floral_SC_Gitem_Text',
    'params'         => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Text display', 'w9-floral-addon' ),
                'description' => __( 'Control text display with another feature, object in post grid.', 'w9-floral-addon' ),
                'param_name'  => 'text_display',
                'value'       => array(
                    __( 'Block', 'w9-floral-addon' )  => 'block',
                    __( 'Inline', 'w9-floral-addon' ) => 'inline',
                ),
                'std' => 'block'
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Get label from', 'w9-floral-addon' ),
                'param_name' => 'label_type',
                'value' => array(
                    __( 'None', 'w9-floral-addon' )=> 'none',
//                    __('From Meta List', 'w9-floral-addon') => 'meta_list',
                    __('From Meta Key', 'w9-floral-addon') => 'meta_key',
                    __('Static', 'w9-floral-addon') => 'static',
                ),
                'std' => 'static'
            ),
            // Todo: List this in update
//            array(
//                'type' => 'dropdown',
//                'heading' => __( 'Label meta list', 'w9-floral-addon' ),
//                'param_name' => 'label_meta_list',
//                'value' => array(
//                    'meta',
//                    'met3',
//                    'met4',
//                ),
//                'dependency' => array(
//                    'element' => 'label_type',
//                    'value' => array('meta_list')
//                )
//            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('Label meta key', 'w9-floral-addon'),
                'param_name' => 'label_meta_key',
                'dependency' => array(
                    'element' => 'label_type',
                    'value' => array('meta_key')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('Static label', 'w9-floral-addon'),
                'param_name' => 'label_static',
                'dependency' => array(
                    'element' => 'label_type',
                    'value' => array('static')
                )
            ),
            //TExt
            array(
                'type' => 'dropdown',
                'heading' => __( 'Get text from', 'w9-floral-addon' ),
                'param_name' => 'text_type',
                'value' => array(
                    __( 'None', 'w9-floral-addon' )=> 'none',
//                    __('From Meta List', 'w9-floral-addon') => 'meta_list',
                    __('From Meta Key', 'w9-floral-addon') => 'meta_key',
                    __('Static', 'w9-floral-addon') => 'static',
                ),
                'std' => 'static'
            ),
            //Todo: List it in update
//            array(
//                'type' => 'dropdown',
//                'heading' => __( 'Text meta list', 'w9-floral-addon' ),
//                'param_name' => 'text_meta_list',
//                'value' => array(
//                    'meta',
//                    'met3',
//                    'met4',
//                ),
//                'dependency' => array(
//                    'element' => 'text_type',
//                    'value' => array('meta_list')
//                )
//            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('Text meta key', 'w9-floral-addon'),
                'param_name' => 'text_meta_key',
                'dependency' => array(
                    'element' => 'text_type',
                    'value' => array('meta_key')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('Static text', 'w9-floral-addon'),
                'param_name' => 'text_static',
                'dependency' => array(
                    'element' => 'text_type',
                    'value' => array('static')
                )
            ),
            //URL
            array(
                'type' => 'dropdown',
                'heading' => __( 'Get URL from', 'w9-floral-addon' ),
                'param_name' => 'url_type',
                'value' => array(
                    __( 'None', 'w9-floral-addon' )=> 'none',
//                    __('From Meta List', 'w9-floral-addon') => 'meta_list',
                    __('From Meta Key', 'w9-floral-addon') => 'meta_key',
                    __('Static', 'w9-floral-addon') => 'static',
                ),
                'std' => 'static'
            ),
            //Todo: List it on update
//            array(
//                'type' => 'dropdown',
//                'heading' => __( 'URL meta list', 'w9-floral-addon' ),
//                'param_name' => 'url_meta_list',
//                'value' => array(
//                    'meta',
//                    'met3',
//                    'met4',
//                ),
//                'dependency' => array(
//                    'element' => 'url_type',
//                    'value' => array('meta_list')
//                )
//            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('URL meta key', 'w9-floral-addon'),
                'param_name' => 'url_meta_key',
                'dependency' => array(
                    'element' => 'url_type',
                    'value' => array('meta_key')
                )
            ),
            array(
                'type' => 'textfield',
                'heading' =>  __('Static URL', 'w9-floral-addon'),
                'param_name' => 'url_static',
                'dependency' => array(
                    'element' => 'url_type',
                    'value' => array('static')
                )
            ),
            Floral_Map_Helpers::extra_class(),
            Floral_Map_Helpers::design_options(),
        )
    ),
));