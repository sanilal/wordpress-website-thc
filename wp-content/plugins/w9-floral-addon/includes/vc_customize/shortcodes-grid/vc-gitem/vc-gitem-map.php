<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-gitem-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $shortcodes array
 */

$shortcodes['vc_gitem'] = array(
    'name'                    => __( 'Grid Item', 'w9-floral-addon' ),
    'base'                    => 'vc_gitem',
    'is_container'            => true,
    'icon'                    => 'icon-wpb-gitem',
    'content_element'         => false,
    'show_settings_on_create' => false,
    'category'                => __( 'Content', 'w9-floral-addon' ),
    'description'             => __( 'Main grid item', 'w9-floral-addon' ),
    'admin_enqueue_js'        => array( Floral_Addon::plugin_url() . 'assets/js/vc-custom.js' ),
    'params'                  => array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Normal block width', 'w9-floral-addon' ),
            'description' => __( 'Define width or normal block if have "Additional Block" left or right it.', 'w9-floral-addon' ),
            'param_name'  => 'normal_block_width',
            'value'       => array(
                '1/12'  => 'floral-normal-block-1-12',
                '2/12'  => 'floral-normal-block-2-12',
                '3/12'  => 'floral-normal-block-3-12',
                '4/12'  => 'floral-normal-block-4-12',
                '5/12'  => 'floral-normal-block-5-12',
                '6/12'  => 'floral-normal-block-6-12',
                '7/12'  => 'floral-normal-block-7-12',
                '8/12'  => 'floral-normal-block-8-12',
                '9/12'  => 'floral-normal-block-9-12',
                '10/12'  => 'floral-normal-block-10-12',
                '11/12'  => 'floral-normal-block-10-12',
                '5%'  => 'floral-normal-block-5',
                '10%' => 'floral-normal-block-10',
                '15%' => 'floral-normal-block-15',
                '20%' => 'floral-normal-block-20',
                '25%' => 'floral-normal-block-25',
                '30%' => 'floral-normal-block-30',
                '35%' => 'floral-normal-block-35',
                '40%' => 'floral-normal-block-40',
                '45%' => 'floral-normal-block-45',
                '50%' => 'floral-normal-block-50',
                '55%' => 'floral-normal-block-55',
                '60%' => 'floral-normal-block-60',
                '65%' => 'floral-normal-block-65',
                '70%' => 'floral-normal-block-70',
                '75%' => 'floral-normal-block-75',
                '80%' => 'floral-normal-block-80',
                '85%' => 'floral-normal-block-85',
                '90%' => 'floral-normal-block-90',
                '95%' => 'floral-normal-block-95',
            ),
            'std'=> 'floral-normal-block-50'
        ),
        
        array(
            'type'        => 'multi-select',
            'heading'     => __( 'Horizontal become vertical in screen width', 'w9-floral-addon' ),
            'description' => __( 'Avalable when have "Additional Block" left or right "Normal Block" only.', 'w9-floral-addon' ),
            'param_name'  => 'become_normal_in_screen',
            'options'     => array(
                'floral-vertical-xxs'  => __( 'From 0px to 479px', 'w9-floral-addon' ),
                'floral-vertical-xs'  => __( 'From 480px to 767px', 'w9-floral-addon' ),
                'floral-vertical-sm'  => __( 'From 768px to 991px', 'w9-floral-addon' ),
                'floral-vertical-md'  => __( 'From 992px to 1199px', 'w9-floral-addon' ),
                'floral-vertical-lg'  => __( 'From 1200px to 1600px', 'w9-floral-addon' ),
                'floral-vertical-xlg' => __( 'From 1600px', 'w9-floral-addon' ),
            )
        ),
        
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-floral-addon' ),
            'param_name' => 'css',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
        ),
    ),
    'js_view'                 => 'VcGitemView',
    'post_type'               => Vc_Grid_Item_Editor::postType(),
);