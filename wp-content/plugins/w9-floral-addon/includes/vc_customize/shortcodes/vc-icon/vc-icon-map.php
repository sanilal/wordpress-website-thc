<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-icon-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'        => __( 'Icon', 'w9-floral-addon' ),
    'base'        => 'vc_icon',
    'icon'        => 'w9 w9-ico-basic-pencil-ruler',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Eye catching icons from libraries', 'w9-floral-addon' ),
    'params'      => array(
        Floral_Map_Helpers::get_icons_picker_type(),
        Floral_Map_Helpers::get_icon_picker_9wpthemes(),
        Floral_Map_Helpers::get_icon_picker_floral(),
        Floral_Map_Helpers::get_icon_picker_fontawesome(),
        Floral_Map_Helpers::get_icon_picker_openiconic(),
        Floral_Map_Helpers::get_icon_picker_typicons(),
        Floral_Map_Helpers::get_icon_picker_entypo(),
        Floral_Map_Helpers::get_icon_picker_linecons(),
        Floral_Map_Helpers::get_icon_picker_monosocial(),
        
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Icon color', 'w9-floral-addon' ),
            'param_name'         => 'color',
            'value'              => array_merge( Floral_Map_Helpers::get_colors(), array( __( 'Gradient', 'w9-floral-addon' ) => 'gradient' ) ),
            'description'        => __( 'Select icon color.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Custom color', 'w9-floral-addon' ),
            'param_name'  => 'custom_color',
            'description' => __( 'Select custom icon color.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'color',
                'value'   => 'custom',
            ),
        ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Gradient color 1', 'w9-floral-addon' ),
            'param_name'         => 'gradient_color_1',
            'description'        => __( 'Select first color for gradient.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'std'                => 'p',
            'dependency'         => array(
                'element' => 'color',
                'value'   => array( 'gradient' ),
            ),
            'edit_field_class'   => 'vc_col-sm-6',
        ),
        
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Gradient color 2', 'w9-floral-addon' ),
            'param_name'         => 'gradient_color_2',
            'description'        => __( 'Select second color for gradient.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'std'                => 's',
            'dependency'         => array(
                'element' => 'color',
                'value'   => array( 'gradient' ),
            ),
            'edit_field_class'   => 'vc_col-sm-6',
        ),
        
        array(
            'type'             => 'number',
            'heading'          => __( 'Gradient angle', 'w9-floral-addon' ),
            'param_name'       => 'gradient_angle',
            'description'      => __( 'Enter the gradient angle, default value is 45.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency'       => array(
                'element' => 'color',
                'value'   => array( 'gradient' ),
            ),
            'std'              => '45'
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Background shape', 'w9-floral-addon' ),
            'param_name'  => 'background_style',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )            => '',
                __( 'Circle', 'w9-floral-addon' )          => 'rounded',
                __( 'Square', 'w9-floral-addon' )          => 'boxed',
                __( 'Rounded', 'w9-floral-addon' )         => 'rounded-less',
                __( 'Outline Circle', 'w9-floral-addon' )  => 'rounded-outline',
                __( 'Outline Square', 'w9-floral-addon' )  => 'boxed-outline',
                __( 'Outline Rounded', 'w9-floral-addon' ) => 'rounded-less-outline',
            ),
            'description' => __( 'Select background shape and style for icon.', 'w9-floral-addon' ),
        ),
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Background color', 'w9-floral-addon' ),
            'param_name'         => 'background_color',
            'value'              => Floral_Map_Helpers::get_colors(),
            'std'                => 'grey',
            'description'        => __( 'Select background color for icon.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'dependency'         => array(
                'element'   => 'background_style',
                'not_empty' => true,
            ),
        ),
        array(
            'type'        => 'colorpicker',
            'heading'     => __( 'Custom background color', 'w9-floral-addon' ),
            'param_name'  => 'custom_background_color',
            'description' => __( 'Select custom icon background color.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'background_color',
                'value'   => 'custom',
            ),
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Size', 'w9-floral-addon' ),
            'param_name'  => 'size',
            'value'       => array_merge( getVcShared( 'sizes' ), array( 'Extra Large' => 'xl', 'Custom Size' => 'custom' ) ),
            'std'         => 'md',
            'description' => __( 'Icon size.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'number',
            'heading'     => __( 'Custom icon size', 'w9-floral-addon' ),
            'param_name'  => 'custom_size',
            'description' => __( 'Enter the custom size for the icon. The unit is px. Currently does not support other units. (etc: 20, 50).', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'size',
                'value'   => 'custom'
            )
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Icon alignment', 'w9-floral-addon' ),
            'param_name'  => 'align',
            'value'       => array(
                __( 'Left', 'w9-floral-addon' )   => 'left',
                __( 'Right', 'w9-floral-addon' )  => 'right',
                __( 'Center', 'w9-floral-addon' ) => 'center',
            ),
            'description' => __( 'Select icon alignment.', 'w9-floral-addon' ),
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'On click action', 'w9-floral-addon' ),
            'param_name'  => 'onclick',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )             => '',
                __( 'Open custom link', 'w9-floral-addon' ) => 'custom-link',
                __( 'Popup image', 'w9-floral-addon' )      => 'popup-image',
                __( 'Popup search', 'w9-floral-addon' )      => 'popup-search',
                __( 'Popup video', 'w9-floral-addon' )      => 'popup-video',
            ),
            'description' => __( 'Select action for click action.', 'w9-floral-addon' ),
            'std'         => '',
        ),
        
        array(
            'type'        => 'vc_link',
            'heading'     => __( 'URL (Link)', 'w9-floral-addon' ),
            'param_name'  => 'link',
            'description' => __( 'Add link to icon.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'onclick',
                'value'   => 'custom-link'
            )
        ),
        
        array(
            'type'        => 'attach_image',
            'heading'     => __( 'Image', 'w9-floral-addon' ),
            'param_name'  => 'image',
            'value'       => '',
            'description' => __( 'Select image from media library.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'onclick',
                'value'   => 'popup-image',
            ),
        ),
        
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Video link', 'w9-floral-addon' ),
            'param_name'  => 'video_link',
            'value'       => 'https://vimeo.com/51589652',
            'description' => sprintf( __( 'Enter link to video (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'w9-floral-addon' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
            'dependency'  => array(
                'element' => 'onclick',
                'value'   => 'popup-video'
            ),
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay(),
    ),
    'js_view'     => 'VcIconElementView_Backend',
) );