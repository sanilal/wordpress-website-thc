<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-page-title-map.php
 * @time    : 8/29/16 4:40 PM
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
    
    if(isset($single_param['admin_label'])){
        unset($button_param[$key]['admin_label']);
    }
    
    if ( isset( $single_param['param_name'] ) && $single_param['param_name'] === 'btn_text' ) {
        $button_param[$key]['std'] = __( 'Visit Project', 'w9-floral-addon' );
    }
    
    if ( isset( $single_param['param_name'] ) && $single_param['param_name'] === 'btn_icon_size' ) {
        $button_param[$key]['std'] = '135%';
    }
    
    
}

vc_map( array(
    'name'           => __( 'Floral Portfolio Page Title', 'w9-floral-addon' ),
    'base'           => Floral_SC_Portfolio_Page_Title::SC_BASE,
    'php_class_name' => 'Floral_SC_Portfolio_Page_Title',
    'icon'           => 'w9 w9-ico-software-layout-8boxes',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_PORTFOLIO_SC_CATEGORY ),
    'description'    => __( 'Get common meta info from single portfolio', 'w9-floral-addon' ),
    'post_type'      => Floral_CPT_Portfolio::CPT_SLUG,
    'params'         => array_merge(
        array(
            // Page Title Align
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Page title align', 'w9-floral-addon' ),
                'param_name' => 'page_title_align',
                'value'      => array(
                    __( 'Left', 'w9-floral-addon' )   => 'text-left',
                    __( 'Right', 'w9-floral-addon' )  => 'text-right',
                    __( 'Center', 'w9-floral-addon' ) => 'text-center',
                ),
                'std' => 'text-center'
            ),
            
            // Portfolio title font family
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Title font family', 'w9-floral-addon' ),
                'description' => __( 'Choose font family for title.', 'w9-floral-addon' ),
                'param_name' => 'title_font_family',
                'value' => array(
                    __( 'Primary Font', 'w9-floral-addon' ) => 'p-font',
                    __( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
                    __( 'Third Font', 'w9-floral-addon' )     => 't-font',
                ),
                'std' => 's-font'
            ),
            
            // Portfolio title Font Size
            array(
                'type'       => 'slider',
                'heading'    => __( 'Title font size', 'w9-floral-addon' ),
                'description' => __( 'Font size for title text.', 'w9-floral-addon' ),
                'param_name' => 'title_font_size',
                'unit'       => 'px',
                'min'        => '16',
                'max'        => '120',
                'step'       => '1',
                'std'        => '70px'
            ),
            
            //Portfolio subtitle font family
            array(
                'type'       => 'dropdown',
                'heading'    => __( 'Sub title font family', 'w9-floral-addon' ),
                'description' => __( 'Choose font family for sub title.', 'w9-floral-addon' ),
                'param_name' => 'subtitle_font_family',
                'value' => array(
                    __( 'Primary Font', 'w9-floral-addon' ) => 'p-font',
                    __( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
                    __( 'Third Font', 'w9-floral-addon' )     => 't-font',
                ),
                'std' => 's-font'
            ),
            
            // Portfolio subtitle Font Size
            array(
                'type'       => 'slider',
                'heading'    => __( 'Sub title font size', 'w9-floral-addon' ),
                'param_name' => 'subtitle_font_size',
                'unit'       => 'px',
                'min'        => '16',
                'max'        => '60',
                'step'       => '1',
                'std'        => '20px'
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Add button', 'w9-floral-addon' ),
                'param_name'  => 'add_button',
                'description' => __( 'Add button link to Project URL below portfolio info.', 'w9-floral-addon' ),
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
