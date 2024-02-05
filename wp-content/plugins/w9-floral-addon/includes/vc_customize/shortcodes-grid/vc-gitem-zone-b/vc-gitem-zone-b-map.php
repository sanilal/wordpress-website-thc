<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-gitem-zone-c-map.php
 * @time    : 9/9/16 4:53 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $shortcodes array
 */

global $vc_gitem_add_link_param;
$link_position = 0;

foreach ( $shortcodes['vc_gitem_zone_b']['params'] as $key => $param ) {
    if ( isset( $param['param_name'] ) && $param['param_name'] === 'link' ) {
        $link_position = $key;
    }
}

array_splice( $shortcodes['vc_gitem_zone_b']['params'], intval( $link_position ) + 1, 0, array(
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

$shortcodes['vc_gitem_zone_b']['params'] = array_merge(
    $shortcodes['vc_gitem_zone_b']['params'],
    array(
        /*-------------------------------------
       TEXT COLORS
   ---------------------------------------*/
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Text color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'text_color',
            'value'              => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Transparent', 'w9-floral-addon' )  => 'transparent',
            ), Floral_Map_Helpers::get_just_colors() ),
            'description'        => esc_html__( 'Select color for text display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
            'group'              => __( 'Design Options', 'w9-floral-addon' ),
            'std'                => 'inherit'
        ),
    
        /*-------------------------------------
            HEADING COLORS
        ---------------------------------------*/
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Heading color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'heading_color',
            'value'              => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Transparent', 'w9-floral-addon' )  => 'transparent',
            ), Floral_Map_Helpers::get_just_colors() ),
            'description'        => esc_html__( 'Select color for heaeding (h1, h2, h3, h4, h5, h6) display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
            'group'              => __( 'Design Options', 'w9-floral-addon' ),
            'std'                => ''
        ),
    
        /*-------------------------------------
            LINK COLORS
        ---------------------------------------*/
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Link color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'link_color',
            'value'              => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Transparent', 'w9-floral-addon' )  => 'transparent',
            ), Floral_Map_Helpers::get_just_colors() ),
            'description'        => esc_html__( 'Select color for link (a) display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
            'group'              => __( 'Design Options', 'w9-floral-addon' ),
            'std'                => ''
        ),
    
    
        /*-------------------------------------
            link hover & active color
        ---------------------------------------*/
        array(
            'type'               => 'dropdown',
            'heading'            => esc_html__( 'Link hover & active color', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'param_name'         => 'link_hover_color',
            'value'              => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Transparent', 'w9-floral-addon' )  => 'transparent',
            ), Floral_Map_Helpers::get_just_colors() ),
            'description'        => esc_html__( 'Select color for link (a) when hover and active in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
            'group'              => __( 'Design Options', 'w9-floral-addon' ),
            'std'                => ''
        ),
    
        /*-------------------------------------
            FONT SIZE
        ---------------------------------------*/
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__( 'Font size', 'w9-floral-addon' ),
            'param_name'  => 'font_size',
            'value'       => array(
                esc_html__( 'Inherit', 'w9-floral-addon' )     => '',
                esc_html__( '12px', 'w9-floral-addon' )        => '12',
                esc_html__( '13px', 'w9-floral-addon' )        => '13',
                esc_html__( '14px', 'w9-floral-addon' )        => '14',
                esc_html__( '15px', 'w9-floral-addon' )        => '15',
                esc_html__( '16px', 'w9-floral-addon' )        => '16',
                esc_html__( '18px', 'w9-floral-addon' )        => '18',
                esc_html__( '20px', 'w9-floral-addon' )        => '20',
                esc_html__( '24px', 'w9-floral-addon' )        => '24',
                esc_html__( '26px', 'w9-floral-addon' )        => '26',
                esc_html__( '30px', 'w9-floral-addon' )        => '30',
                esc_html__( '36px', 'w9-floral-addon' )        => '36',
                esc_html__( '48px', 'w9-floral-addon' )        => '48',
                esc_html__( 'Custom Size', 'w9-floral-addon' ) => 'custom',
            ),
            'std'         => '',
            'description' => esc_html__( 'Select column font size. Please notice that this option will not effect with the inner element that has its own font-size style.', 'w9-floral-addon' ),
            'group'       => __( 'Design Options', 'w9-floral-addon' ),
        ),
    )
);