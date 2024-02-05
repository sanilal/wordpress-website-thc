<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-gitem-zone-a-maps.php
 * @time    : 9/29/16 10:15 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $shortcodes array
 */

$vc_gitem_zone_a_params = $shortcodes['vc_gitem_zone_a']['params'];

$link_position = 0;
foreach ( $vc_gitem_zone_a_params as $key => $param ) {
    if ( isset( $param['param_name'] ) && $param['param_name'] === 'height_mode' ) {
        $shortcodes['vc_gitem_zone_a']['params'][$key] = array(
            'type'        => 'dropdown',
            'heading'     => __( 'Height mode', 'w9-floral-addon' ),
            'param_name'  => 'height_mode',
            'value'       => array(
                '1:1'                               => '1-1',
                __( 'Original', 'w9-floral-addon' ) => 'original',
                '4:3'                               => '4-3',
                '3:4'                               => '3-4',
                '3:2'                               => '3-2',
                '2:3'                               => '2-3',
                '16:9'                              => '16-9',
                '9:16'                              => '9-16',
                __( 'Custom', 'w9-floral-addon' )   => 'custom',
            ),
            'description' => __( 'Sizing proportions for height and width. Select "Original" to scale image without cropping.', 'w9-floral-addon' ),
        );
    }
    
    if ( isset( $param['param_name'] ) && $param['param_name'] === 'link' ) {
        $link_position = $key;
    }
}

array_splice( $shortcodes['vc_gitem_zone_a']['params'], intval( $link_position ) + 1, 0, array(
    array(
        'type'       => 'checkbox',
        'param_name' => 'link_target',
        'heading'    => __( 'Open link in new tab?', 'w9-floral-addon' ),
        'value'      => array(
            __( 'Yes, please!', 'w9-floral-addon' ) => 'yes',
        ),
        'std'        => '',
        'dependency' => array(
            'element' => 'link',
            'value' => 'post_link'
        )
    )
) );
