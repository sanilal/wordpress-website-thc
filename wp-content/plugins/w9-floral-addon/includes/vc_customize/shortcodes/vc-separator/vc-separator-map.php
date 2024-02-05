<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-separator-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


vc_map( array(
    'name'                    => __( 'Separator', 'w9-floral-addon' ),
    'base'                    => 'vc_separator',
    'icon'                    => 'w9 w9-ico-arrows-horizontal',
    'show_settings_on_create' => true,
    'category'                => __( 'Content', 'w9-floral-addon' ),
    'description'             => __( 'Horizontal separator line', 'w9-floral-addon' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
    'params'                  => array(
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Color', 'w9-floral-addon' ),
            'param_name'         => 'color',
            'value'              => Floral_Map_Helpers::get_colors(),
            'std'                => 'p',
            'description'        => __( 'Select color of separator.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Custom border color', 'w9-floral-addon' ),
            'param_name'  => 'accent_color',
            'description' => __( 'Select border color for your element.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'color',
                'value'   => array( 'custom' ),
            ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Alignment', 'w9-floral-addon' ),
            'param_name'  => 'align',
            'value'       => array(
                __( 'Center', 'w9-floral-addon' ) => 'align_center',
                __( 'Left', 'w9-floral-addon' )   => 'align_left',
                __( 'Right', 'w9-floral-addon' )  => 'align_right',
            ),
            'description' => __( 'Select separator alignment.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Style', 'w9-floral-addon' ),
            'param_name'  => 'style',
            'value'       => getVcShared( 'separator styles' ),
            'description' => __( 'Separator display style.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Border width', 'w9-floral-addon' ),
            'param_name'  => 'border_width',
            'value'       => getVcShared( 'separator border widths' ),
            'description' => __( 'Select border width (pixels).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Element width', 'w9-floral-addon' ),
            'param_name'  => 'el_width',
            'value'       => getVcShared( 'separator widths' ),
            'description' => __( 'Select separator width (percentage).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-floral-addon' ),
            'param_name' => 'css',
            'group'      => __( 'Design Options', 'w9-floral-addon' ),
        ),
    ),
) );