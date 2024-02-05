<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-row-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$row_param = array(
    array(
        'type'       => 'dropdown',
        'heading'    => esc_html__( 'Content width', 'w9-floral-addon' ),
        'param_name' => 'content_width',
        'value'      => array(
            esc_html__( 'Container', 'w9-floral-addon' )          => 'container',
            esc_html__( 'Container Extended', 'w9-floral-addon' ) => 'container-xlg',
            esc_html__( 'Container Fluid', 'w9-floral-addon' )    => 'container-fluid',
            esc_html__( 'Full Width (Overflow Hidden)', 'w9-floral-addon' )         => 'fullwidth',
            esc_html__( 'Full Width (Overflow Visible)', 'w9-floral-addon' )         => 'fullwidth-visible',
        ),
        'std'        => 'container',
    ),
    array(
        'type'       => 'dropdown',
        'heading'    => esc_html__( 'Container width', 'w9-floral-addon' ),
        'param_name' => 'container_width',
        'value'      => array(
            esc_html__( 'Full Width', 'w9-floral-addon' )       => 'fullwidth',
            esc_html__( 'Equal To Content', 'w9-floral-addon' ) => 'equal_to_content',
        ),
        'std'        => 'fullwidth',
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Columns gap', 'w9-floral-addon' ),
        'param_name'  => 'gap',
        'value'       => array(
            '0px'  => '0',
            '1px'  => '1',
            '2px'  => '2',
            '3px'  => '3',
            '4px'  => '4',
            '5px'  => '5',
            '10px' => '10',
            '15px' => '15',
            '20px' => '20',
            '25px' => '25',
            '30px' => '30',
            '35px' => '35',
        ),
        'std'         => '0',
        'description' => esc_html__( 'Select gap between columns in row.', 'w9-floral-addon' ),
    ),

    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Remove column gutter?', 'w9-floral-addon' ),
        'param_name'  => 'no_gutter',
        'description' => esc_html__( 'If checked, the gutter between column will be removed.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
    ),
    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Full height row?', 'w9-floral-addon' ),
        'param_name'  => 'full_height',
        'description' => esc_html__( 'If checked row will be set to full height.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Columns position', 'w9-floral-addon' ),
        'param_name'  => 'columns_placement',
        'value'       => array(
            esc_html__( 'Middle', 'w9-floral-addon' )  => 'middle',
            esc_html__( 'Top', 'w9-floral-addon' )     => 'top',
            esc_html__( 'Bottom', 'w9-floral-addon' )  => 'bottom',
            esc_html__( 'Stretch', 'w9-floral-addon' ) => 'stretch',
        ),
        'description' => esc_html__( 'Select columns position within row.', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'   => 'full_height',
            'not_empty' => true,
        ),
    ),
    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Equal height?', 'w9-floral-addon' ),
        'param_name'  => 'equal_height',
        'description' => esc_html__( 'If checked columns will be set to equal height.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' )
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Content position', 'w9-floral-addon' ),
        'param_name'  => 'content_placement',
        'value'       => array(
            esc_html__( 'Default', 'w9-floral-addon' ) => '',
            esc_html__( 'Top', 'w9-floral-addon' )     => 'top',
            esc_html__( 'Middle', 'w9-floral-addon' )  => 'middle',
            esc_html__( 'Bottom', 'w9-floral-addon' )  => 'bottom',
        ),
        'description' => esc_html__( 'Select content position within columns.', 'w9-floral-addon' ),
    ),

    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Use video background?', 'w9-floral-addon' ),
        'param_name'  => 'video_bg',
        'description' => esc_html__( 'If checked, video will be used as row background.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
    ),
    array(
        'type'        => 'textfield',
        'heading'     => esc_html__( 'YouTube link', 'w9-floral-addon' ),
        'param_name'  => 'video_bg_url',
        'value'       => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
        // default video url
        'description' => esc_html__( 'Add YouTube link.', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'   => 'video_bg',
            'not_empty' => true,
        ),
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Parallax', 'w9-floral-addon' ),
        'param_name'  => 'video_bg_parallax',
        'value'       => array(
            esc_html__( 'None', 'w9-floral-addon' )      => '',
            esc_html__( 'Simple', 'w9-floral-addon' )    => 'content-moving',
            esc_html__( 'With fade', 'w9-floral-addon' ) => 'content-moving-fade',
        ),
        'description' => esc_html__( 'Add parallax type background for row.', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'   => 'video_bg',
            'not_empty' => true,
        ),
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Parallax', 'w9-floral-addon' ),
        'param_name'  => 'parallax',
        'value'       => array(
            esc_html__( 'None', 'w9-floral-addon' )      => '',
            esc_html__( 'Simple', 'w9-floral-addon' )    => 'content-moving',
            esc_html__( 'With fade', 'w9-floral-addon' ) => 'content-moving-fade',
        ),
        'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'  => 'video_bg',
            'is_empty' => true,
        ),
    ),
    array(
        'type'        => 'attach_image',
        'heading'     => esc_html__( 'Image', 'w9-floral-addon' ),
        'param_name'  => 'parallax_image',
        'value'       => '',
        'description' => esc_html__( 'Select image from media library.', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'   => 'parallax',
            'not_empty' => true,
        ),
    ),
    array(
        'type'       => 'textfield',
        'heading'    => esc_html__( 'Parallax speed', 'w9-floral-addon' ),
        'param_name' => 'parallax_speed',
        'value'      => '1.5',
        'dependency' => array( 'element' => 'parallax', 'value' => array( 'content-moving', 'content-moving-fade' ) ),
    ),


    /*-------------------------------------
        DESIGN OPTIONS
    ---------------------------------------*/
    Floral_Map_Helpers::design_options(),
    Floral_Map_Helpers::design_options_on_tablet(),
    Floral_Map_Helpers::design_options_on_mobile(),
    array(
        'type' => 'dropdown',
        'heading' => __( 'Background position', 'w9-floral-addon' ),
        'param_name' => 'background_position',
        'value' => array(
            __( 'Center Top', 'w9-floral-addon' )=> 'bgp-center-top-i',
            __( 'Center Center', 'w9-floral-addon' )=> 'bgp-center-center-i',
            __( 'Center Bottom', 'w9-floral-addon' )=> 'bgp-center-bottom-i',
            __( 'Left Top', 'w9-floral-addon' )=> 'bgp-left-top-i',
            __( 'Left Center', 'w9-floral-addon' )=> 'bgp-left-center-i',
            __( 'Left Bottom', 'w9-floral-addon' )=> 'bgp-left-bottom-i',
            __( 'Right Top', 'w9-floral-addon' )=> 'bgp-right-top-i',
            __( 'Right Center', 'w9-floral-addon' )=> 'bgp-right-center-i',
            __( 'Right Bottom', 'w9-floral-addon' )=> 'bgp-right-bottom-i',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'std' => 'bgp-center-center-i'
    ),
    /*-------------------------------------
        BACKGROUND OVERLAY
    ---------------------------------------*/
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Show background overlay', 'w9-floral-addon' ),
        'param_name'  => 'overlay_set',
        'description' => esc_html__( 'Hide or Show overlay on background images.', 'w9-floral-addon' ),
        'value'       => array(
            esc_html__( 'Hide, please', 'w9-floral-addon' )          => 'hide_overlay',
            esc_html__( 'Show Overlay Color', 'w9-floral-addon' )    => 'show_overlay_color',
            esc_html__( 'Show Overlay Image', 'w9-floral-addon' )    => 'show_overlay_image',
            esc_html__( 'Show Overlay Gradient', 'w9-floral-addon' ) => 'show_overlay_gradient',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
    ),
    array(
        'type'        => 'attach_image',
        'heading'     => esc_html__( 'Image overlay', 'w9-floral-addon' ),
        'param_name'  => 'overlay_image',
        'value'       => '',
        'description' => esc_html__( 'Upload image overlay.', 'w9-floral-addon' ),
        'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
    ),
    array(
        'type'        => 'colorpicker',
        'heading'     => esc_html__( 'Overlay color', 'w9-floral-addon' ),
        'param_name'  => 'overlay_color',
        'description' => esc_html__( 'Select color for background overlay.', 'w9-floral-addon' ),
        'value'       => '',
        'dependency'  => array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_color' ) ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
    ),

    array(
        'type'       => 'slider',
        'heading'    => __( 'Overlay opacity', 'w9-floral-addon' ),
        'param_name' => 'overlay_opacity',
        'unit'       => '',
        'min'        => '0.05',
        'max'        => '1.01',
        'step'       => '0.05',
        'std'        => '1',
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
        'dependency' => array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image', 'show_overlay_gradient' ) ),
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Overlay image background position', 'w9-floral-addon' ),
        'param_name'  => 'overlay_bg_position',
        'value'       => array(
            esc_html__( 'Center Top', 'w9-floral-addon' )    => 'bgp-center-top',
            esc_html__( 'Center Center', 'w9-floral-addon' ) => 'bgp-center-center',
            esc_html__( 'Center Bottom', 'w9-floral-addon' ) => 'bgp-center-bottom',
            esc_html__( 'Left Top', 'w9-floral-addon' )      => 'bgp-left-top',
            esc_html__( 'Left Center', 'w9-floral-addon' )   => 'bgp-left-center',
            esc_html__( 'Left Bottom', 'w9-floral-addon' )   => 'bgp-left-bottom',
            esc_html__( 'Right Top', 'w9-floral-addon' )     => 'bgp-right-top',
            esc_html__( 'Right Center', 'w9-floral-addon' )  => 'bgp-right-center',
            esc_html__( 'Right Bottom', 'w9-floral-addon' )  => 'bgp-right-bottom',
        ),
        'description' => esc_html__( 'Select content position within columns.', 'w9-floral-addon' ),
        'std'         => 'bgp-center-center',
        'dependency'  => array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
    ),
    array(
        'type'               => 'dropdown',
        'heading'            => __( 'Gradient color 1', 'w9-floral-addon' ),
        'param_name'         => 'overlay_gradient_color_1',
        'description'        => __( 'Select first color for gradient.', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'value'              => array_merge( array(__( 'Transparent', 'w9-floral-addon' ) => 'transparent'),Floral_Map_Helpers::get_just_colors()) ,
        'std'                => 'p',
        'dependency'         => array(
            'element' => 'overlay_set',
            'value'   => array( 'show_overlay_gradient' ),
        ),
        'edit_field_class'   => 'vc_col-sm-6',
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
    ),

    array(
        'type'               => 'dropdown',
        'heading'            => __( 'Gradient color 2', 'w9-floral-addon' ),
        'param_name'         => 'overlay_gradient_color_2',
        'description'        => __( 'Select second color for gradient.', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'value'              => array_merge( array(__( 'Transparent', 'w9-floral-addon' ) => 'transparent'),Floral_Map_Helpers::get_just_colors()) ,
        'std'                => 's',
        'dependency'         => array(
            'element' => 'overlay_set',
            'value'   => array( 'show_overlay_gradient' ),
        ),
        'edit_field_class'   => 'vc_col-sm-6',
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
    ),

    array(
        'type'             => 'number',
        'heading'          => __( 'Gradient angle', 'w9-floral-addon' ),
        'param_name'       => 'overlay_gradient_angle',
        'description'      => __( 'Enter the gradient angle, default value is 45.', 'w9-floral-addon' ),
        'edit_field_class' => 'vc_col-sm-6',
        'dependency'       => array(
            'element' => 'overlay_set',
            'value'   => array( 'show_overlay_gradient' ),
        ),
        'std'              => '45',
        'group'            => __( 'Design Options', 'w9-floral-addon' ),
    ),

    /*-------------------------------------
        TEXT COLORS
    ---------------------------------------*/
    array(
        'type'               => 'dropdown',
        'heading'            => esc_html__( 'Text color', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'param_name'         => 'text_color',
        'value'              => Floral_Map_Helpers::get_colors(),
        'description'        => esc_html__( 'Select color for text display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
        'std'                => 'inherit'
    ),

    array(
        'type'       => 'colorpicker',
        'heading'    => esc_html__( 'Custom text color', 'w9-floral-addon' ),
        'param_name' => 'text_custom_color',
        'value'      => '',
        'dependency' => array(
            'element' => 'text_color',
            'value'   => 'custom'
        ),
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
    ),

    /*-------------------------------------
        HEADING COLORS
    ---------------------------------------*/
    array(
        'type'               => 'dropdown',
        'heading'            => esc_html__( 'Heading color', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'param_name'         => 'heading_color',
        'value'              => Floral_Map_Helpers::get_colors(),
        'description'        => esc_html__( 'Select color for heaeding (h1, h2, h3, h4, h5, h6) display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
        'std'                => ''
    ),

    array(
        'type'       => 'colorpicker',
        'heading'    => esc_html__( 'Custom heading color', 'w9-floral-addon' ),
        'param_name' => 'heading_custom_color',
        'value'      => '',
        'dependency' => array(
            'element' => 'heading_color',
            'value'   => 'custom'
        ),
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
    ),

    /*-------------------------------------
        LINK COLORS
    ---------------------------------------*/
    array(
        'type'               => 'dropdown',
        'heading'            => esc_html__( 'Link color', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'param_name'         => 'link_color',
        'value'              => Floral_Map_Helpers::get_colors(),
        'description'        => esc_html__( 'Select color for link (a) display in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
        'std'                => ''
    ),

    array(
        'type'       => 'colorpicker',
        'heading'    => esc_html__( 'Custom link color', 'w9-floral-addon' ),
        'param_name' => 'link_custom_color',
        'value'      => '',
        'dependency' => array(
            'element' => 'link_color',
            'value'   => 'custom'
        ),
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
    ),

    /*-------------------------------------
        link hover & active color
    ---------------------------------------*/
    array(
        'type'               => 'dropdown',
        'heading'            => esc_html__( 'Link hover & active color', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'param_name'         => 'link_hover_color',
        'value'              => Floral_Map_Helpers::get_colors(),
        'description'        => esc_html__( 'Select color for link (a) when hover and active in the row. Please notice that this option will not effect with the inner element that has its own color scheme.', 'w9-floral-addon' ),
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
        'std'                => ''
    ),

    array(
        'type'       => 'colorpicker',
        'heading'    => esc_html__( 'Custom link hover & active color', 'w9-floral-addon' ),
        'param_name' => 'link_hover_custom_color',
        'value'      => '',
        'dependency' => array(
            'element' => 'link_hover_color',
            'value'   => 'custom'
        ),
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
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

    array(
        'type'        => 'number',
        'heading'     => esc_html__( 'Custom font size', 'w9-floral-addon' ),
        'param_name'  => 'custom_font_size',
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'value'       => '',
        'description' => __( 'Enter custom font-size for the column (Unit: px...).', 'w9-floral-addon' ),
        'dependency'  => array( 'element' => 'font_size', 'value' => 'custom' ),
    ),

    /*-------------------------------------
       SLOPED EDGE
   ---------------------------------------*/
    array(
        'type'        => 'buttonset',
        'heading'     => esc_html__( 'Sloped edge position', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_position',
        'description' => __( 'Where to put sloped edge on this row.', 'w9-floral-addon' ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'options'     => array(
            'none'   => 'None',
            'top'    => 'Top',
            'bottom' => 'Bottom',
            'both'   => 'Both'
        ),
        'value'       => 'none'
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Top sloped edge', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_top',
        'description' => esc_html__( 'Select top sloped edge on top of this row.', 'w9-floral-addon' ),
        'value'       => array(
            __( 'Triangle - Left', 'w9-floral-addon' )              => 'top-left',
            __( 'Triangle - Center', 'w9-floral-addon' )            => 'top-center',
            __( 'Triangle - Center - REVERSED', 'w9-floral-addon' ) => 'top-center-reversed',
            __( 'Triangle - Right', 'w9-floral-addon' )             => 'top-right',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'top', 'both' )
        ),
        'std'         => 'top-left'
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Bottom sloped edge', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_bottom',
        'description' => esc_html__( 'Select top sloped edge on bottom of this row.', 'w9-floral-addon' ),
        'value'       => array(
            __( 'Triangle - Left', 'w9-floral-addon' )              => 'bottom-left',
            __( 'Triangle - Center', 'w9-floral-addon' )            => 'bottom-center',
            __( 'Triangle - Center - REVERSED', 'w9-floral-addon' ) => 'bottom-center-reversed',
            __( 'Triangle - Right', 'w9-floral-addon' )             => 'bottom-right',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'bottom', 'both' )
        ),
        'std'         => 'bottom-left'
    ),

    array(
        'type'               => 'colorpicker',
        'heading'            => esc_html__( 'Sloped edge color', 'w9-floral-addon' ),
        'param_holder_class' => 'vc_colored-dropdown',
        'param_name'         => 'sloped_edge_color',
        'description'        => esc_html__( 'Select color for sloped edge.', 'w9-floral-addon' ),
        'group'              => __( 'Design Options', 'w9-floral-addon' ),
        'std'                => 'p',
        'dependency'         => array(
            'element'            => 'sloped_edge_position',
            'value_not_equal_to' => 'none'
        ),
    ),

    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Overlay mode?', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_overlay_mode',
        'description' => esc_html__( 'Enable the overlay mode for the sloped edge. Over the background but under the content. Turn this off to make the sloped edge go over the content.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'overlay-mode' ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'            => 'sloped_edge_position',
            'value_not_equal_to' => 'none'
        ),
        'std'         => ''
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Position mode', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_position_mode',
        'description' => esc_html__( 'Select position mode for the sloped edge.', 'w9-floral-addon' ),
        'value'       => array(
            __( 'Static', 'w9-floral-addon' )   => 'static',
            __( 'Absolute', 'w9-floral-addon' ) => 'absolute',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element'            => 'sloped_edge_position',
            'value_not_equal_to' => 'none'
        ),
        'std'         => 'static'
    ),

    array(
        'type'       => 'slider',
        'heading'    => __( 'Top sloped edge degree', 'w9-floral-addon' ),
        'param_name' => 'sloped_edge_top_degree',
        'unit'       => 'deg',
        'min'        => '0',
        'max'        => '45',
        'step'       => '1',
        'std'        => '3deg',
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
        'dependency' => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'top', 'both' )
        ),
    ),

    array(
        'type'       => 'slider',
        'heading'    => __( 'Bottom sloped edge degree', 'w9-floral-addon' ),
        'param_name' => 'sloped_edge_bottom_degree',
        'unit'       => 'deg',
        'min'        => '0',
        'max'        => '45',
        'step'       => '1',
        'std'        => '3deg',
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
        'dependency' => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'bottom', 'both' )
        ),
    ),

    /*-------------------------------------
        RESPONSIVE
    ---------------------------------------*/
    array(
        'type'        => 'switcher',
        'heading'     => esc_html__( 'Hide on desktop', 'w9-floral-addon' ),
        'param_name'  => 'hide_on_desktop',
        'description' => __( 'Screen larger than 991px.', 'w9-floral-addon' ),
        'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
        'value'       => '0',
    ),
    array(
        'type'        => 'switcher',
        'heading'     => esc_html__( 'Hide on tablet', 'w9-floral-addon' ),
        'param_name'  => 'hide_on_tablet',
        'description' => __( 'Screen from 480px to 991px.', 'w9-floral-addon' ),
        'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
        'value'       => '0',
    ),
    array(
        'type'        => 'switcher',
        'heading'     => esc_html__( 'Hide on mobile', 'w9-floral-addon' ),
        'param_name'  => 'hide_on_mobile',
        'description' => __( 'Screen smaller than 480px.', 'w9-floral-addon' ),
        'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
        'value'       => '0',
    ),

    // font-size responsive
    array(
        'type'        => 'switcher',
        'heading'     => esc_html__( 'Responsive font size', 'w9-floral-addon' ),
        'param_name'  => 'responsive_font_size',
        'description' => esc_html__( 'Enable or disable font size responsive for column.', 'w9-floral-addon' ),
        'value'       => '',
        'dependency'  => array( 'element' => 'font_size', 'value_not_equal_to' => array( '' ) ),
        'group'       => __( 'Responsive Options', 'w9-floral-addon' )
    ),

    array(
        'type'             => 'number',
        'heading'          => esc_html__( 'Responsive compressor', 'w9-floral-addon' ),
        'param_name'       => 'responsive_compressor',
        'value'            => '',
        'description'      => esc_html__( 'Enter responsive compressor (etc: 1.2, 1.5, 0.6, 0.7...). This is for responsive purpose. Default value is 1.', 'w9-floral-addon' ),
        'dependency'       => array( 'element' => 'responsive_font_size', 'value' => '1' ),
        'group'            => __( 'Responsive Options', 'w9-floral-addon' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column'
    ),

    array(
        'type'             => 'number',
        'heading'          => esc_html__( 'Minimum font size', 'w9-floral-addon' ),
        'param_name'       => 'responsive_minimum_font_size',
        'value'            => '',
        'description'      => __( 'Enter minimum font-size for the heading title (Unit: px). Default value is 20.', 'w9-floral-addon' ),
        'dependency'       => array( 'element' => 'responsive_font_size', 'value' => '1' ),
        'group'            => __( 'Responsive Options', 'w9-floral-addon' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column'
    ),


    /*-------------------------------------
        EXTRA OPTIONS
    ---------------------------------------*/
    array(
        'type'        => 'checkbox',
        'heading'     => esc_html__( 'Enable slipscreen section options?', 'w9-floral-addon' ),
        'param_name'  => 'enable_slip_section_options',
        'description' => esc_html__( 'Please tick this if you enable slipscreen mode (in the metabox below). But if the current post type doesn\'t support slipscreen mode, please don\'t.', 'w9-floral-addon' ),
        'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
    ),

    array(
        'type'        => 'textfield',
        'heading'     => esc_html__( 'Anchor', 'w9-floral-addon' ),
        'param_name'  => 'data_anchor',
        'value'       => '',
        'description' => esc_html__( 'Require*. Defines the anchor links (#example) to be shown on the URL for each section. Anchor value should be unique and  can not have the same value as any ID element on the site (or NAME element for IE).', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'enable_slip_section_options',
            'value'   => array( 'yes' )
        )
    ),

    array(
        'type'        => 'textfield',
        'heading'     => esc_html__( 'Navigation tooltip content', 'w9-floral-addon' ),
        'param_name'  => 'data_tooltip',
        'value'       => '',
        'description' => esc_html__( 'Optional*. Show navigation Tooltip for this section.', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'enable_slip_section_options',
            'value'   => array( 'yes' )
        )
    ),

    array(
        'type'        => 'el_id',
        'heading'     => esc_html__( 'Row ID', 'w9-floral-addon' ),
        'param_name'  => 'el_id',
        'description' => sprintf( esc_html__( 'Enter row ID (Note: make sure it is unique and valid according to).', 'w9-floral-addon' ) . '%s', '<a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">' . __( 'w3c specification', 'w9-floral-addon' ) . '</a>' ),
    ),
    
    
    Floral_Map_Helpers::extra_class(),
    Floral_Map_Helpers::animation_css(),
    Floral_Map_Helpers::animation_duration(),
    Floral_Map_Helpers::animation_delay()
);

vc_map( array(
    'name'                    => esc_html__( 'Row', 'w9-floral-addon' ),
    'base'                    => 'vc_row',
    'is_container'            => true,
    'icon'                    => 'w9 w9-ico-arrows-fit-vertical',
    'show_settings_on_create' => false,
    'category'                => esc_html__( 'Content', 'w9-floral-addon' ),
    'description'             => esc_html__( 'Place content elements inside the row', 'w9-floral-addon' ),
    'params'                  => $row_param,
    'js_view'                 => 'VcRowView'
) );

/*-------------------------------------
	INNER ROW
---------------------------------------*/
vc_map( array(
        'name'                    => __( 'Inner Row', 'w9-floral-addon' ),
        //Inner Row
        'content_element'         => false,
        'is_container'            => true,
        'base'                    => 'vc_row_inner',
        'icon'                    => 'w9 w9-ico-arrows-fit-vertical',
        'as_parent'               => array( 'except' => Floral_SC_Content_Template::SC_BASE ),
        'weight'                  => 1000,
        'show_settings_on_create' => false,
        'description'             => __( 'Place content elements inside the inner row', 'w9-floral-addon' ),
        'params'                  => array(
	        array(
		        'type'       => 'dropdown',
		        'heading'    => esc_html__( 'Content width', 'w9-floral-addon' ),
		        'param_name' => 'content_width',
		        'value'      => array(
			        esc_html__( 'Container', 'w9-floral-addon' )          => 'container',
			        esc_html__( 'Container Extended', 'w9-floral-addon' ) => 'container-xlg',
			        esc_html__( 'Container Fluid', 'w9-floral-addon' )    => 'container-fluid',
			        esc_html__( 'Full Width (Overflow Hidden)', 'w9-floral-addon' )         => 'fullwidth',
			        esc_html__( 'Full Width (Overflow Visible)', 'w9-floral-addon' )         => 'fullwidth-visible',
		        ),
		        'std'        => 'fullwidth-visible',
	        ),
            array(
                'type'        => 'el_id',
                'heading'     => __( 'Row ID', 'w9-floral-addon' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'w9-floral-addon' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __( 'link', 'w9-floral-addon' ) . '</a>' ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Equal height', 'w9-floral-addon' ),
                'param_name'  => 'equal_height',
                'description' => __( 'If checked columns will be set to equal height.', 'w9-floral-addon' ),
                'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Content position', 'w9-floral-addon' ),
                'param_name'  => 'content_placement',
                'value'       => array(
                    __( 'Default', 'w9-floral-addon' ) => '',
                    __( 'Top', 'w9-floral-addon' )     => 'top',
                    __( 'Middle', 'w9-floral-addon' )  => 'middle',
                    __( 'Bottom', 'w9-floral-addon' )  => 'bottom',
                ),
                'description' => __( 'Select content position within columns.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Columns gap', 'w9-floral-addon' ),
                'param_name'  => 'gap',
                'value'       => array(
                    '0px'  => '0',
                    '1px'  => '1',
                    '2px'  => '2',
                    '3px'  => '3',
                    '4px'  => '4',
                    '5px'  => '5',
                    '10px' => '10',
                    '15px' => '15',
                    '20px' => '20',
                    '25px' => '25',
                    '30px' => '30',
                    '35px' => '35',
                ),
                'std'         => '0',
                'description' => __( 'Select gap between columns in row.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => esc_html__( 'Remove column gutter?', 'w9-floral-addon' ),
                'param_name'  => 'no_gutter',
                'description' => esc_html__( 'If checked, the gutter between column will be removed.', 'w9-floral-addon' ),
                'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Disable row', 'w9-floral-addon' ),
                'param_name'  => 'disable_element', // Inner param name.
                'description' => __( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'w9-floral-addon' ),
                'value'       => array( __( 'Yes', 'w9-floral-addon' ) => 'yes' ),
            ),
            
            /*-------------------------------------
                DESIGN OPTIONS
            ---------------------------------------*/
            Floral_Map_Helpers::design_options(),
            Floral_Map_Helpers::design_options_on_tablet(),
            Floral_Map_Helpers::design_options_on_mobile(),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Background position', 'w9-floral-addon' ),
                'param_name' => 'background_position',
                'value' => array(
                    __( 'Center Top', 'w9-floral-addon' )=> 'bgp-center-top-i',
                    __( 'Center Center', 'w9-floral-addon' )=> 'bgp-center-center-i',
                    __( 'Center Bottom', 'w9-floral-addon' )=> 'bgp-center-bottom-i',
                    __( 'Left Top', 'w9-floral-addon' )=> 'bgp-left-top-i',
                    __( 'Left Center', 'w9-floral-addon' )=> 'bgp-left-center-i',
                    __( 'Left Bottom', 'w9-floral-addon' )=> 'bgp-left-bottom-i',
                    __( 'Right Top', 'w9-floral-addon' )=> 'bgp-right-top-i',
                    __( 'Right Center', 'w9-floral-addon' )=> 'bgp-right-center-i',
                    __( 'Right Bottom', 'w9-floral-addon' )=> 'bgp-right-bottom-i',
                ),
                'group'       => __( 'Design Options', 'w9-floral-addon' ),
                'std' => 'bgp-center-center-i'
            ),
            Floral_Map_Helpers::extra_class(),
            Floral_Map_Helpers::animation_css(),
            Floral_Map_Helpers::animation_duration(),
            Floral_Map_Helpers::animation_delay()
        ),
        'js_view'                 => 'VcRowView',
    )
);