<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-video-map.php
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
    'element' => 'video_style',
    'value'   => 'popup'
) );

// populate integrated vc_icons params.
if ( is_array( $icons_params ) && !empty( $icons_params ) ) {
    foreach ( $icons_params as $key => $param ) {
        if ( is_array( $param ) && !empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icons_params[$key]['admin_label'] );
            }
            
            if ( isset( $param['param_name'] ) && $param['param_name'] === 'i_icon_9wpthemes' ) {
                $icons_params[$key]['std'] = 'w9 w9-ico-play-1';
            }
        }
    }
}

vc_map( array(
    'name'        => __( 'Video Player', 'w9-floral-addon' ),
    'base'        => 'vc_video',
    'icon'        => 'w9 w9-ico-video',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Embed YouTube/Vimeo player', 'w9-floral-addon' ),
    'params'      => array_merge(
        array(
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Video title', 'w9-floral-addon' ),
                'param_name'  => 'title',
                'description' => __( 'Enter text used as the title of the video.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => __( 'Video link', 'w9-floral-addon' ),
                'param_name'  => 'link',
                'value'       => 'https://vimeo.com/51589652',
                'admin_label' => true,
                'description' => sprintf( __( 'Enter link to video (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'w9-floral-addon' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Video style', 'w9-floral-addon' ),
                'description' => __( 'Select video style.', 'w9-floral-addon' ),
                'param_name'  => 'video_style',
                'admin_label' => true,
                'value'       => array(
                    __( 'Iframe', 'w9-floral-addon' ) => 'iframe',
                    __( 'Pop Up', 'w9-floral-addon' ) => 'popup'
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Video width', 'w9-floral-addon' ),
                'param_name'  => 'el_width',
                'value'       => array(
                    '100%' => '100',
                    '90%'  => '90',
                    '80%'  => '80',
                    '70%'  => '70',
                    '60%'  => '60',
                    '50%'  => '50',
                    '40%'  => '40',
                    '30%'  => '30',
                    '20%'  => '20',
                    '10%'  => '10',
                ),
                'description' => __( 'Select video width (percentage).', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'iframe'
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Video aspect ration', 'w9-floral-addon' ),
                'param_name'  => 'el_aspect',
                'value'       => array(
                    '16:9'   => '169',
                    '4:3'    => '43',
                    '2.35:1' => '235',
                ),
                'description' => __( 'Select video aspect ratio.', 'w9-floral-addon' ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Alignment', 'w9-floral-addon' ),
                'param_name'  => 'align',
                'description' => __( 'Select video alignment.', 'w9-floral-addon' ),
                'value'       => array(
                    __( 'Left', 'w9-floral-addon' )   => 'left',
                    __( 'Right', 'w9-floral-addon' )  => 'right',
                    __( 'Center', 'w9-floral-addon' ) => 'center',
                ),
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'iframe'
                )
            ),

            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Video title position', 'w9-floral-addon' ),
                'param_name'  => 'title_position',
                'description' => __( 'select video title position.', 'w9-floral-addon' ),
                'value'       => array(
                    __( 'Left Top', 'w9-floral-addon' )      => 'left-top',
                    __( 'Center Middle', 'w9-floral-addon' ) => 'center-middle',
                    __( 'Left Bottom', 'w9-floral-addon' )   => 'left-bottom',
                ),
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'popup'
                )
            ),

            array(
                'type'        => 'attach_image',
                'heading'     => __( 'Video image placeholder', 'w9-floral-addon' ),
                'description' => __( 'Select image placeholder for popup video.' , 'w9-floral-addon' ),
                'param_name'  => 'image_placeholder',
                'admin_label' => true,
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'popup'
                )
            ),


            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Image placeholder height', 'w9-floral-addon' ),
                'param_name'  => 'image_placeholder_height',
                'description' => __( 'Select video placeholder height base on ratio or custom height value.', 'w9-floral-addon' ),
                'value'       => array(
                    __( 'Base on ratio 16:9', 'w9-floral-addon' )   => '169',
                    __( 'Base on ratio 3:2', 'w9-floral-addon' )    => '32',
                    __( 'Base on ratio 2.35:1', 'w9-floral-addon' ) => '235',
                    __( 'Base on ratio 4:3', 'w9-floral-addon' )    => '43',
                    __( 'Custom', 'w9-floral-addon' )               => 'custom',
                ),
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'popup'
                )
            ),

            array(
                'type'        => 'textfield',
                'heading'     => __( 'Custom image placeholder height', 'w9-floral-addon' ),
                'param_name'  => 'image_placeholder_custom_height',
                'description' => __( 'Video image placeholder height, value with unit like 400px, 80vh...', 'w9-floral-addon' ),
                'std'         => '80vh',
                'dependency'  => array(
                    'element' => 'image_placeholder_height',
                    'value'   => 'custom'
                )
            ),


            array(
                'type'        => 'colorpicker',
                'heading'     => __( 'Image placeholder overlay color', 'w9-floral-addon' ),
                'param_name'  => 'image_placeholder_overlay',
                'description' => __( 'Picker color for overlay before video image placeholder.', 'w9-floral-addon' ),
                'std'         => 'rgba(0,0,0,0.39)',
                'dependency'  => array(
                    'element' => 'video_style',
                    'value'   => 'popup'
                )
            ) ),
        $icons_params,
        array(
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
            ) )
    ),
) );