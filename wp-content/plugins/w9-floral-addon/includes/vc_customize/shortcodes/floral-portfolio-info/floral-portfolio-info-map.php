<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-info-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( is_admin() && ( !defined( 'DOING_AJAX' ) && ( !post_type_exists( Floral_CPT_Portfolio::CPT_SLUG ) || floral_get_current_post_type() !== Floral_CPT_Portfolio::CPT_SLUG ) ) ) {
    return;
}


$button_param = vc_map_integrate_shortcode( Floral_SC_Button::SC_BASE, '', __( 'Button', 'w9-floral-addon' ), array(
    'exclude' => array(
        'btn_link',
        'btn_custom_onclick',
        'btn_custom_onclick_code',
        'css',
        'el_class',
        'animation_css',
        'animation_duration',
        'animation_delay',
        'css_inline',
    ),
),
    
    array(
        'element' => 'add_button',
        'value'   => 'yes'
    )
);

foreach ( $button_param as $key => $single_param ) {
    if ( isset( $single_param['param_name'] ) && $single_param['param_name'] === 'btn_text' ) {
        $button_param[$key]['std'] = __( 'Visit Project', 'w9-floral-addon' );
    }

    if ( isset( $single_param['param_name'] ) && $single_param['param_name'] === 'btn_icon_size' ) {
        $button_param[$key]['std'] = '135%';
    }


}

vc_map( array(
    'name'           => __( 'Floral Portfolio Info', 'w9-floral-addon' ),
    'base'           => Floral_SC_Portfolio_Info::SC_BASE,
    'php_class_name' => 'Floral_SC_Portfolio_Info',
    'icon'           => 'w9 w9-ico-software-layout-8boxes',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_PORTFOLIO_SC_CATEGORY ),
    'description'    => __('Get common meta info from single portfolio', 'w9-floral-addon' ),
    'post_type'      => Floral_CPT_Portfolio::CPT_SLUG,
    'params'         => array_merge(
        array(
            array(
                'type'        => 'param_group',
                'heading'     => __( 'Info fields', 'w9-floral-addon' ),
                'param_name'  => 'info_list',
                'description' => __( 'Select info use in this shortcode.', 'w9-floral-addon' ),
                'value'       => urlencode( json_encode( array(
                    array(
                        'info'       => 'date',
                        'info_label' => __( 'DATE:', 'w9-floral-addon' ),
                    ),
                    array(
                        'info'       => 'client',
                        'info_label' => __( 'CLIENT:', 'w9-floral-addon' ),
                    ),
                    array(
                        'info'       => 'categories',
                        'info_label' => __( 'CATEGORY:', 'w9-floral-addon' ),
                    ),
                    array(
                        'info' => 'addition-info',
                    ),
                    array(
                        'info'       => 'share-this',
                        'info_label' => __( 'SHARE:', 'w9-floral-addon' ),
                    ),
                ) ) ),
                'params'      => array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __( 'Info', 'w9-floral-addon' ),
                        'param_name'  => 'info',
                        'admin_label' => true,
                        'value'       => array(
                            __( 'Categories', 'w9-floral-addon' )      => 'categories',
                            __( 'Date', 'w9-floral-addon' )            => 'date',
                            __( 'Client', 'w9-floral-addon' )          => 'client',
                            __( 'Additional info', 'w9-floral-addon' ) => 'addition-info',
                            __( 'Share This', 'w9-floral-addon' )      => 'share-this',
                        ),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => __('Label', 'w9-floral-addon' ),
                        'param_name'  => 'info_label',
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'            => 'info',
                            'value_not_equal_to' => array( 'addition-info' )
                        )
                    )
                ),
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Add button', 'w9-floral-addon' ),
                'param_name'  => 'add_button',
                'description' => __('Add button link to Project URL below portfolio info.', 'w9-floral-addon' ),
                'admin_label' => true,
                'value'       => array(
                    __( 'Yes, Please!', 'w9-floral-addon' ) => 'yes'
                ),
                'default'     => 'true',
            ),
            Floral_Map_Helpers::extra_class(),
        ),
        $button_param,
        array(
            Floral_Map_Helpers::design_options(),
            Floral_Map_Helpers::animation_css(),
            Floral_Map_Helpers::animation_duration(),
            Floral_Map_Helpers::animation_delay() )
    ) ) );
