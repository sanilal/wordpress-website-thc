<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-message-box-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$pixel_icons   = vc_pixel_icons();
$custom_colors = array(
    __( 'Floral Informational', 'w9-floral-addon' )  => 'floral-info',
    __( 'Floral Warning', 'w9-floral-addon' )        => 'floral-warning',
    __( 'Floral Success', 'w9-floral-addon' )        => 'floral-success',
    __( 'Floral Error', 'w9-floral-addon' )          => 'floral-danger',
    __( 'Floral Notice', 'w9-floral-addon' )         => 'floral-notice',
    __( 'Informational', 'w9-floral-addon' )         => 'info',
    __( 'Warning', 'w9-floral-addon' )               => 'warning',
    __( 'Success', 'w9-floral-addon' )               => 'success',
    __( 'Error', 'w9-floral-addon' )                 => 'danger',
    __( 'Informational Classic', 'w9-floral-addon' ) => 'alert-info',
    __( 'Warning Classic', 'w9-floral-addon' )       => 'alert-warning',
    __( 'Success Classic', 'w9-floral-addon' )       => 'alert-success',
    __( 'Error Classic', 'w9-floral-addon' )         => 'alert-danger',
);

vc_map( array(
    'name'        => __( 'Message Box', 'w9-floral-addon' ),
    'base'        => 'vc_message',
    'icon'        => 'w9 w9-ico-basic-postcard-multiple',
    'category'    => __( 'Content', 'w9-floral-addon' ),
    'description' => __( 'Notification box', 'w9-floral-addon' ),
    'params'      => array(
        array(
            'type'               => 'params_preset',
            'heading'            => __( 'Message box presets', 'w9-floral-addon' ),
            'param_name'         => 'color',
            // due to backward compatibility, really it is message_box_type
            'value'              => '',
            'options'            => array(
                array(
                    'label'  => __( 'Custom', 'w9-floral-addon' ),
                    'value'  => '',
                    'params' => array(),
                ),
                array(
                    'label'  => __( 'Informational', 'w9-floral-addon' ),
                    'value'  => 'info',
                    'params' => array(
                        'message_box_color' => 'info',
                        'type'              => 'fontawesome',
                        'icon_fontawesome'  => 'fa fa-info-circle',
                    ),
                ),
                array(
                    'label'  => __( 'Warning', 'w9-floral-addon' ),
                    'value'  => 'warning',
                    'params' => array(
                        'message_box_color' => 'warning',
                        'type'              => 'fontawesome',
                        'icon_fontawesome'  => 'fa fa-exclamation-triangle',
                    ),
                ),
                array(
                    'label'  => __( 'Success', 'w9-floral-addon' ),
                    'value'  => 'success',
                    'params' => array(
                        'message_box_color' => 'success',
                        'type'              => 'fontawesome',
                        'icon_fontawesome'  => 'fa fa-check',
                    ),
                ),
                array(
                    'label'  => __( 'Error', 'w9-floral-addon' ),
                    'value'  => 'danger',
                    'params' => array(
                        'message_box_color' => 'danger',
                        'type'              => 'fontawesome',
                        'icon_fontawesome'  => 'fa fa-times',
                    ),
                ),
                array(
                    'label'  => __( 'Informational Classic', 'w9-floral-addon' ),
                    'value'  => 'alert-info',
                    // due to backward compatibility
                    'params' => array(
                        'message_box_color' => 'alert-info',
                        'type'              => 'pixelicons',
                        'icon_pixelicons'   => 'vc_pixel_icon vc_pixel_icon-info',
                    ),
                ),
                array(
                    'label'  => __( 'Warning Classic', 'w9-floral-addon' ),
                    'value'  => 'alert-warning',
                    // due to backward compatibility
                    'params' => array(
                        'message_box_color' => 'alert-warning',
                        'type'              => 'pixelicons',
                        'icon_pixelicons'   => 'vc_pixel_icon vc_pixel_icon-alert',
                    ),
                ),
                array(
                    'label'  => __( 'Success Classic', 'w9-floral-addon' ),
                    'value'  => 'alert-success',
                    // due to backward compatibility
                    'params' => array(
                        'message_box_color' => 'alert-success',
                        'type'              => 'pixelicons',
                        'icon_pixelicons'   => 'vc_pixel_icon vc_pixel_icon-tick',
                    ),
                ),
                array(
                    'label'  => __( 'Error Classic', 'w9-floral-addon' ),
                    'value'  => 'alert-danger',
                    // due to backward compatibility
                    'params' => array(
                        'message_box_color' => 'alert-danger',
                        'type'              => 'pixelicons',
                        'icon_pixelicons'   => 'vc_pixel_icon vc_pixel_icon-explanation',
                    ),
                ),
            ),
            'description'        => __( 'Select predefined message box design or choose "Custom" for custom styling.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_message-type vc_colored-dropdown',
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Size', 'w9-floral-addon' ),
            'param_name'  => 'message_box_size',
            // due to backward compatibility message_box_shape
            'std'         => 'mini',
            'value'       => array(
                __( 'Mini', 'w9-floral-addon' )  => 'mini',
                __( 'Large', 'w9-floral-addon' ) => 'large',
            ),
            'description' => __( 'Select message box size.', 'w9-floral-addon' ),
        ),
        
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Style', 'w9-floral-addon' ),
            'param_name'  => 'message_box_style',
            'value'       => getVcShared( 'message_box_styles' ),
            'description' => __( 'Select message box design style.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Shape', 'w9-floral-addon' ),
            'param_name'  => 'style',
            // due to backward compatibility message_box_shape
            'std'         => 'rounded',
            'value'       => array(
                __( 'Square', 'w9-floral-addon' )  => 'square',
                __( 'Rounded', 'w9-floral-addon' ) => 'rounded',
                __( 'Round', 'w9-floral-addon' )   => 'round',
            ),
            'description' => __( 'Select message box shape.', 'w9-floral-addon' ),
            'admin_label' => true
        ),
        array(
            'type'               => 'dropdown',
            'heading'            => __( 'Color', 'w9-floral-addon' ),
            'param_name'         => 'message_box_color',
            'value'              => $custom_colors + getVcShared( 'colors' ),
            'description'        => __( 'Select message box color.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_message-type vc_colored-dropdown',
            'admin_label'        => true
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => __( 'Icon library', 'w9-floral-addon' ),
            'value'       => array(
                __( '9WPThemes', 'w9-floral-addon' )    => '9wpthemes',
                __( 'Font Awesome', 'w9-floral-addon' ) => 'fontawesome',
                __( 'Open Iconic', 'w9-floral-addon' )  => 'openiconic',
                __( 'Typicons', 'w9-floral-addon' )     => 'typicons',
                __( 'Entypo', 'w9-floral-addon' )       => 'entypo',
                __( 'Linecons', 'w9-floral-addon' )     => 'linecons',
                __( 'Pixel', 'w9-floral-addon' )        => 'pixelicons',
                __( 'Mono Social', 'w9-floral-addon' )  => 'monosocial',
            ),
            'param_name'  => 'type',
            'description' => __( 'Select icon library.', 'w9-floral-addon' ),
        ),
        Floral_Map_Helpers::get_icon_picker_9wpthemes(),
        Floral_Map_Helpers::get_icon_picker_fontawesome(),
        Floral_Map_Helpers::get_icon_picker_openiconic(),
        Floral_Map_Helpers::get_icon_picker_typicons(),
        Floral_Map_Helpers::get_icon_picker_entypo(),
        Floral_Map_Helpers::get_icon_picker_linecons(),
        Floral_Map_Helpers::get_icon_picker_monosocial(),
        array(
            'type'        => 'iconpicker',
            'heading'     => __( 'Icon', 'w9-floral-addon' ),
            'param_name'  => 'icon_pixelicons',
            'settings'    => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type'      => 'pixelicons',
                'source'    => $pixel_icons,
            ),
            'dependency'  => array(
                'element' => 'type',
                'value'   => 'pixelicons',
            ),
            'description' => __( 'Select icon from library.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'textarea_html',
            'holder'     => 'div',
            'class'      => 'messagebox_text',
            'heading'    => __( 'Message text', 'w9-floral-addon' ),
            'param_name' => 'content',
            'value'      => __( '<p>I am message box. Click edit button to change this text.</p>', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => __( 'Message font family', 'w9-floral-addon' ),
            'param_name' => 'messagebox_ff',
            'value'      => array(
                __( 'Inherit', 'w9-floral-addon' )        => '',
                __( 'Primary Font', 'w9-floral-addon' )   => 'p-font',
                __( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
                __( 'Third Font', 'w9-floral-addon' )     => 't-font',
            ),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => __( 'Message font size', 'w9-floral-addon' ),
            'param_name' => 'messagebox_fz',
            'value'      => array(
                __( 'Inherit', 'w9-floral-addon' ) => '',
                '10px'                             => 'fz-10',
                '11px'                             => 'fz-11',
                '12px'                             => 'fz-12',
                '13px'                             => 'fz-13',
                '14px'                             => 'fz-14',
                '15px'                             => 'fz-15',
                '16px'                             => 'fz-16',
                '17px'                             => 'fz-17',
                '18px'                             => 'fz-18',
                '19px'                             => 'fz-19',
                '20px'                             => 'fz-20',
                '21px'                             => 'fz-21',
                '22px'                             => 'fz-22',
                '23px'                             => 'fz-23',
                '24px'                             => 'fz-24',
                '25px'                             => 'fz-25',
                '26px'                             => 'fz-26',
                '27px'                             => 'fz-27',
                '28px'                             => 'fz-28',
                '29px'                             => 'fz-29',
                '30px'                             => 'fz-30',
            ),
        ),
        array(
            'type'        => 'switcher',
            'param_name'  => 'message_box_dismissible',
            'heading'     => __( 'Message box dismissible?', 'w9-floral-addon' ),
            'std'         => '1',
            'admin_label' => true
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
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );