<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-column-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$param_column = array(
    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Text align', 'w9-floral-options' ),
        'param_name'  => 'text_align',
        'value'       => array(
            __( 'Inherit', 'w9-floral-addon' ) => '',
            __( 'Left', 'w9-floral-addon' )    => 'text-left',
            __( 'Center', 'w9-floral-addon' )  => 'text-center',
            __( 'Right', 'w9-floral-addon' )   => 'text-right',
            __( 'Justify', 'w9-floral-addon' ) => 'text-justify',
        ),
        'std'         => '',
        'description' => esc_html__( 'You\'ll find the responsive options for text align in tab Responsive Options.', 'w9-floral-addon' ),
    ),

    array(
        'type'        => 'textfield',
        'heading'     => esc_html__( 'Max width', 'w9-floral-addon' ),
        'param_name'  => 'max_width',
        'description' => esc_html__( 'Set max-width attribute for the column (etc: 300px, 50%...).', 'w9-floral-addon' ),
        'std'         => ''
    ),
    array(
        'type'       => 'dropdown',
        'heading'    => __( 'Horizontal align', 'w9-floral-options' ),
        'param_name' => 'horizontal_align',
        'value'      => array(
            __( 'None', 'w9-floral-addon' )   => '',
            __( 'Left', 'w9-floral-addon' )   => 'block-align-left',
            __( 'Center', 'w9-floral-addon' ) => 'block-align-center',
            __( 'Right', 'w9-floral-addon' )  => 'block-align-right',
        ),
        'std'        => ''
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Vertical align', 'w9-floral-options' ),
        'param_name'  => 'vertical_align',
        'value'       => array(
            __( 'None', 'w9-floral-addon' )   => '',
            __( 'Top', 'w9-floral-addon' )    => 'block-align-top',
            __( 'Middle', 'w9-floral-addon' ) => 'block-align-middle',
            __( 'Bottom', 'w9-floral-addon' ) => 'block-align-bottom',
        ),
        'std'         => '',
        'description' => __( '<strong>Notice: This option is only works when the wrapper row has option Equal Height enabled.</strong>' , 'w9-floral-addon' )
    ),
    Floral_Map_Helpers::extra_class(),
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
        'description' => __( 'Where to put sloped edge on this row. Notice: This option require the option Column Equal Height in the outer row enabled.', 'w9-floral-addon' ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'options'     => array(
            'none'  => 'None',
            'left'  => 'Left',
            'right' => 'Right',
            'both'  => 'Both'
        ),
        'value'       => 'none'
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Left sloped edge', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_left',
        'description' => esc_html__( 'Select left sloped edge on left of this row.', 'w9-floral-addon' ),
        'value'       => array(
            __( 'Triangle - Top', 'w9-floral-addon' )               => 'left-top',
            __( 'Triangle - Middle', 'w9-floral-addon' )            => 'left-middle',
            __( 'Triangle - Middle - REVERSED', 'w9-floral-addon' ) => 'left-middle-reversed',
            __( 'Triangle - Bottom', 'w9-floral-addon' )            => 'left-bottom',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'left', 'both' )
        ),
        'std'         => 'left-top'
    ),

    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__( 'Right sloped edge', 'w9-floral-addon' ),
        'param_name'  => 'sloped_edge_right',
        'description' => esc_html__( 'Select left sloped edge on right of this row.', 'w9-floral-addon' ),
        'value'       => array(
            __( 'Triangle - Top', 'w9-floral-addon' )               => 'right-top',
            __( 'Triangle - Middle', 'w9-floral-addon' )            => 'right-middle',
            __( 'Triangle - Middle - REVERSED', 'w9-floral-addon' ) => 'right-middle-reversed',
            __( 'Triangle - Bottom', 'w9-floral-addon' )            => 'right-bottom',
        ),
        'group'       => __( 'Design Options', 'w9-floral-addon' ),
        'dependency'  => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'right', 'both' )
        ),
        'std'         => 'right-top'
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
        'type'       => 'slider',
        'heading'    => __( 'Left sloped edge degree', 'w9-floral-addon' ),
        'param_name' => 'sloped_edge_left_degree',
        'unit'       => 'deg',
        'min'        => '0',
        'max'        => '45',
        'step'       => '1',
        'std'        => '3deg',
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
        'dependency' => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'left', 'both' )
        ),
    ),

    array(
        'type'       => 'slider',
        'heading'    => __( 'Right sloped edge degree', 'w9-floral-addon' ),
        'param_name' => 'sloped_edge_right_degree',
        'unit'       => 'deg',
        'min'        => '0',
        'max'        => '45',
        'step'       => '1',
        'std'        => '3deg',
        'group'      => __( 'Design Options', 'w9-floral-addon' ),
        'dependency' => array(
            'element' => 'sloped_edge_position',
            'value'   => array( 'right', 'both' )
        ),
    ),


    /*-------------------------------------
    	RESPONSIVE
    ---------------------------------------*/

    array(
        'type'        => 'dropdown',
        'heading'     => __( 'Width', 'w9-floral-addon' ),
        'param_name'  => 'width',
        'value'       => array(
            __( '1 column - 1/12', 'w9-floral-addon' )    => '1/12',
            __( '2 columns - 1/6', 'w9-floral-addon' )    => '1/6',
            __( '3 columns - 1/4', 'w9-floral-addon' )    => '1/4',
            __( '4 columns - 1/3', 'w9-floral-addon' )    => '1/3',
            __( '5 columns - 5/12', 'w9-floral-addon' )   => '5/12',
            __( '6 columns - 1/2', 'w9-floral-addon' )    => '1/2',
            __( '7 columns - 7/12', 'w9-floral-addon' )   => '7/12',
            __( '8 columns - 2/3', 'w9-floral-addon' )    => '2/3',
            __( '9 columns - 3/4', 'w9-floral-addon' )    => '3/4',
            __( '10 columns - 5/6', 'w9-floral-addon' )   => '5/6',
            __( '11 columns - 11/12', 'w9-floral-addon' ) => '11/12',
            __( '12 columns - 1/1', 'w9-floral-addon' )   => '1/1',
        ),
        'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
        'description' => __( 'Select column width.', 'w9-floral-addon' ),
        'std'         => '1/1',
    ),
    array(
        'type'        => 'column_offset',
        'heading'     => __( 'Responsiveness', 'w9-floral-addon' ),
        'param_name'  => 'offset',
        'group'       => __( 'Responsive Options', 'w9-floral-addon' ),
        'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'w9-floral-addon' ),
    ),

    array(
        'type'             => 'dropdown',
        'heading'          => __( 'Text align on tablet devices', 'w9-floral-options' ),
        'param_name'       => 'text_align_on_tablet',
        'value'            => array(
            __( 'Inherit Form The Larger Size', 'w9-floral-addon' ) => '',
            __( 'Left', 'w9-floral-addon' )                         => 'text-left-on-tablet',
            __( 'Center', 'w9-floral-addon' )                       => 'text-center-on-tablet',
            __( 'Right', 'w9-floral-addon' )                        => 'text-right-on-tablet',
            __( 'Justify', 'w9-floral-addon' )                      => 'text-justify-on-tablet',
        ),
        'std'              => '',
        'description'      => esc_html__( 'Screen width from 480px to 991px.', 'w9-floral-addon' ),
        'group'            => __( 'Responsive Options', 'w9-floral-addon' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column'
    ),

    array(
        'type'             => 'dropdown',
        'heading'          => __( 'Text align on mobile devices', 'w9-floral-options' ),
        'param_name'       => 'text_align_on_mobile',
        'value'            => array(
            __( 'Inherit Form The Larger Size', 'w9-floral-addon' ) => '',
            __( 'Left', 'w9-floral-addon' )                         => 'text-left-on-mobile',
            __( 'Center', 'w9-floral-addon' )                       => 'text-center-on-mobile',
            __( 'Right', 'w9-floral-addon' )                        => 'text-right-on-mobile',
            __( 'Justify', 'w9-floral-addon' )                      => 'text-justify-on-mobile',
        ),
        'std'              => '',
        'description'      => esc_html__( 'Screen width smaller than 480px.', 'w9-floral-addon' ),
        'group'            => __( 'Responsive Options', 'w9-floral-addon' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column'
    ),
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
    Floral_Map_Helpers::animation_css(),
    Floral_Map_Helpers::animation_duration(),
    Floral_Map_Helpers::animation_delay(),
);

vc_map( array(
    'name'            => __( 'Column', 'w9-floral-addon' ),
    'base'            => 'vc_column',
    'icon'            => 'w9 w9-ico-software-layout-3columns',
    'is_container'    => true,
    'content_element' => false,
    'description'     => __( 'Place content elements inside the column.', 'w9-floral-addon' ),
    'params'          => $param_column,
    'js_view'         => 'VcColumnView',
) );

vc_map( array(
    'name'                      => __( 'Inner Column', 'w9-floral-addon' ),
    'base'                      => 'vc_column_inner',
    'icon'                      => 'icon-wpb-row',
    'class'                     => '',
    'wrapper_class'             => '',
    'controls'                  => 'full',
    'allowed_container_element' => false,
    'content_element'           => false,
    'is_container'              => true,
    'description'               => __( 'Place content elements inside the inner column.', 'w9-floral-addon' ),
    'params'                    => $param_column,
    'js_view'                   => 'VcColumnView',
) );