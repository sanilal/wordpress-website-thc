<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-widget-tagcloud-map.php
 * @time    : 9/28/2016 9:52 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$tag_taxonomies = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
    $taxonomies = get_taxonomies();
    if ( is_array( $taxonomies ) && !empty( $taxonomies ) ) {
        foreach ( $taxonomies as $taxonomy ) {
            $tax = get_taxonomy( $taxonomy );
            if ( ( is_object( $tax ) && ( !$tax->show_tagcloud || empty( $tax->labels->name ) ) ) || !is_object( $tax ) ) {
                continue;
            }
            $tag_taxonomies[$tax->labels->name] = esc_attr( $taxonomy );
        }
    }
}

vc_map( array(
    'name'           => esc_html__( 'Floral Widget Tag Cloud', 'w9-floral-addon' ),
    'base'           => Floral_SC_Widget_Tag_Cloud::SC_BASE,
    'icon'           => 'w9 w9-ico-pricetags',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'php_class_name' => 'Floral_SC_Widget_Tag_Cloud',
    'description'    => __( 'A cloud of your most used tags.', 'w9-floral-addon' ),
    'params'         => array_merge( array(
        array(
            'type'        => 'textfield',
            'param_name'  => 'title',
            'heading'     => __( 'Widget title', 'w9-floral-addon' ),
            'description' => __( 'What text use as a widget title. Leave blank if you don\' want to show the widget title.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'taxonomy',
            'heading'     => __( 'Taxonomy', 'w9-floral-addon' ),
            'value'       => $tag_taxonomies,
            'description' => __( 'Select source for tag cloud.', 'w9-floral-addon' ),
            'admin_label' => true,
            'save_always' => true,
            'std'         => 'post_tag'
        ),
        
        array(
            'type'        => 'dropdown',
            'param_name'  => 'tag_color',
            'heading'     => __( 'Tag color', 'w9-floral-addon' ),
            'admin_label' => true,
            'value'       => array(
                __( 'Default', 'w9-floral-addon' ) => 'default',
                __( 'Custom style', 'w9-floral-addon' )       => 'custom-style',
            ),
            'std'         => 'default'
        ),
        
        //text color
        
        array(
            'type'       => 'dropdown',
            'param_name' => 'text_color',
            'heading'    => __( 'Text color', 'w9-floral-addon' ),
            'value'      => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Custom Color', 'w9-floral-addon' ) => 'custom',
            ), Floral_Map_Helpers::get_just_colors() ),
            'param_holder_class' => 'vc_colored-dropdown',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
            'std'        => 'text'
        ),
        
        array(
            'param_name' => 'text_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'text_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),
        
        array(
            'type'       => 'dropdown',
            'param_name' => 'text_hover_color',
            'heading'    => __( 'Text color - Hover', 'w9-floral-addon' ),
            'value'      => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Custom Color', 'w9-floral-addon' ) => 'custom',
            ), Floral_Map_Helpers::get_just_colors() ),
            'param_holder_class' => 'vc_colored-dropdown',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
            'std'        => 'p',
        ),
        
        array(
            'param_name' => 'text_hover_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'text_hover_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),
        
        // background color
        
        array(
            'type'       => 'dropdown',
            'param_name' => 'background_color',
            'heading'    => __( 'Background color', 'w9-floral-addon' ),
            'value'      => Floral_Map_Helpers::get_colors(),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'        => '__',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
        ),

        array(
            'param_name' => 'background_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'background_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),

        array(
            'type'       => 'dropdown',
            'param_name' => 'background_hover_color',
            'heading'    => __( 'Background hover color', 'w9-floral-addon' ),
            'value'      => Floral_Map_Helpers::get_colors(),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'        => '__',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
        ),

        array(
            'param_name' => 'background_hover_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'background_hover_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),
        
        // border color
        
        array(
            'type'       => 'dropdown',
            'param_name' => 'border_color',
            'heading'    => __( 'Border color', 'w9-floral-addon' ),
            'value'      => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Custom Color', 'w9-floral-addon' ) => 'custom',
            ), Floral_Map_Helpers::get_just_colors() ),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'        => '__',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
        ),

        array(
            'param_name' => 'border_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'border_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),

        array(
            'type'       => 'dropdown',
            'param_name' => 'border_hover_color',
            'heading'    => __( 'Border hover color', 'w9-floral-addon' ),
            'value'      => array_merge( array(
                __( 'Default CSS', 'w9-floral-addon' )  => '__',
                __( 'Custom Color', 'w9-floral-addon' ) => 'custom',
            ), Floral_Map_Helpers::get_just_colors() ),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'        => '__',
            'dependency' => array(
                'element' => 'tag_color',
                'value'   => 'custom-style'
            ),
        ),

        array(
            'param_name' => 'border_hover_color_cp',
            'type'       => 'colorpicker',
            'dependency' => array(
                'element' => 'border_hover_color',
                'value'   => 'custom'
            ),
            'std'        => ''
        ),
    ), Floral_Map_Helpers::widget_common_params() )
) );