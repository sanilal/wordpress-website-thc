<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-text-separator-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$icons_params = vc_map_integrate_shortcode( 'vc_icon', 'i_', __( 'Icon', 'w9-floral-addon' ), array(
    'exclude' => array(
        'align',
        'css',
        'el_class',
        'link',
        'animation_css',
        'animation_duration',
        'animation_delay',
        'tablet_css',
        'mobile_css',
    ),
    // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
), array(
    'element' => 'add_icon',
    'value'   => 'true',
) );

// populate integrated vc_icons params.
if ( is_array( $icons_params ) && !empty( $icons_params ) ) {
    foreach ( $icons_params as $key => $param ) {
        if ( is_array( $param ) && !empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icons_params[$key]['admin_label'] );
            }
        }
    }
}


vc_map( array(
    'name'        => __( 'Separator with Text', 'w9-floral-addon' ),
    'base'        => 'vc_text_separator',
    'icon'        => 'w9 w9-ico-arrows-drag-vert',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Horizontal separator line with heading', 'w9-floral-addon' ),
    'post_type' => Vc_Grid_Item_Editor::postType(),
    'params'      => array_merge( array(
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Title', 'w9-floral-addon' ),
            'param_name'  => 'title',
            'holder'      => 'div',
            'value'       => __( 'Title', 'w9-floral-addon' ),
            'description' => __( 'Add text to separator.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => __( 'Add icon?', 'w9-floral-addon' ),
            'param_name' => 'add_icon',
        ) ), $icons_params, array(
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Title position', 'w9-floral-addon' ),
            'param_name'  => 'title_align',
            'value'       => array(
                __( 'Center', 'w9-floral-addon' ) => 'separator_align_center',
                __( 'Left', 'w9-floral-addon' )   => 'separator_align_left',
                __( 'Right', 'w9-floral-addon' )  => 'separator_align_right',
            ),
            'description' => __( 'Select title location.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Separator alignment', 'w9-floral-addon' ),
            'param_name'  => 'align',
            'value'       => array(
                __( 'Center', 'w9-floral-addon' ) => 'align_center',
                __( 'Left', 'w9-floral-addon' )   => 'align_left',
                __( 'Right', 'w9-floral-addon' )  => 'align_right',
            ),
            'description' => __( 'Select separator alignment.', 'w9-floral-addon' ),
        ),
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
            'heading'     => __( 'Custom Color', 'w9-floral-addon' ),
            'param_name'  => 'accent_color',
            'description' => __( 'Custom separator color for your element.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'color',
                'value'   => array( 'custom' ),
            ),
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
            'description' => __( 'Separator element width in percents.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'hidden',
            'param_name' => 'layout',
            'value'      => 'separator_with_text',
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-floral-addon' ),
            'param_name' => 'css',
            'group'      => __( 'Design Options', 'w9-floral-addon' ),
        ),
    ) ),
    'js_view'     => 'VcTextSeparatorView',
) );
