<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-post-meta-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'           => __( 'Floral Post Meta', 'w9-floral-addon' ),
    'base'           => Floral_SC_Post_Meta::SC_BASE,
    'php_class_name' => 'Floral_SC_Post_Meta',
    'icon'           => 'w9 w9-ico-basic-info',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'description'    => __( 'Get common meta info from single post, page and other single custom post type', 'w9-floral-addon' ),
    'params'         => array(
        array(
            'type'        => 'param_group',
            'heading'     => __( 'Info fields', 'w9-floral-addon' ),
            'param_name'  => 'info_list',
            'description' => __( 'Select info use in this shortcode.', 'w9-floral-addon' ),
            'value'       => urlencode( json_encode( array(
                array(
                    'info'       => 'date',
                    'info_label' => __( 'Posted at:', 'w9-floral-addon' ),
                ),
                array(
                    'info'       => 'categories',
                    'info_label' => __( 'Posted in:', 'w9-floral-addon' ),
                )
            ) ) ),
            'params'      => array(
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Info', 'w9-floral-addon' ),
                    'param_name'  => 'info',
                    'admin_label' => true,
                    'value'       => array(
                        __( 'Date', 'w9-floral-addon' )       => 'date',
                        __( 'Author', 'w9-floral-addon' )     => 'author',
                        __( 'Categories', 'w9-floral-addon' ) => 'categories',
                        __( 'Tags', 'w9-floral-addon' )       => 'tags',
                        __( 'Comments', 'w9-floral-addon' )   => 'comments',
                    ),
                ),
                array(
                    'type'       => 'textfield',
                    'heading'    => __( 'Info label', 'w9-floral-addon' ),
                    'param_name' => 'info_label',
                    'std'        => ''
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Date format', 'w9-floral-addon' ),
                    'param_name'  => 'date_format',
                    'description' => sprintf( __( 'Config the date format, leave blank to use default. Read the %s for more information', 'w9-floral-addon' ), '<a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Wordpress Codex</a>' ),
                    'dependency'  => array(
                        'element' => 'info',
                        'value'   => array( 'date' )
                    )
                ),
                array(
                    'type'             => 'number',
                    'heading'          => __( 'Number of items to show', 'w9-floral-addon' ),
                    'param_name'       => 'number_items',
                    'description'      => __( 'Config number of items to show, leave blank to show all.', 'w9-floral-addon' ),
                    'dependency'       => array(
                        'element' => 'info',
                        'value'   => array( 'categories', 'tags' )
                    ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),

                array(
                    'type'             => 'textfield',
                    'param_name'       => 'item_separator',
                    'heading'          => __( 'Items separator' , 'w9-floral-addon' ),
                    'std'              => ', ',
                    'description'      => __( 'Enter the separator between each items. Default is ", ".' , 'w9-floral-addon' ),
                    'dependency'       => array(
                        'element' => 'info',
                        'value'   => array( 'categories', 'tags' )
                    ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column'
                ),
            ),
        ),
        array(
            'type'             => 'textfield',
            'param_name'       => 'meta_separator',
            'heading'          => __( 'Info separator' , 'w9-floral-addon' ),
            'std'              => '/',
            'description'      => __( 'Enter the separator between each info.' , 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'admin_label'      => true
        ),
        
        array(
            'type'             => 'dropdown',
            'param_name'       => 'meta_font_family',
            'heading'          => __( 'Font family' , 'w9-floral-addon' ),
            'value'            => array(
                __( 'Inherit', 'w9-floral-addon' )        => '',
                __( 'Primary Font', 'w9-floral-addon' )   => 'p-font',
                __( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
                __( 'Third Font', 'w9-floral-addon' )     => 't-font',
            ),
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'admin_label'      => true
        ),
        
        array(
            'type'             => 'dropdown',
            'param_name'       => 'meta_text_transform',
            'heading'          => __( 'Text transform' , 'w9-floral-addon' ),
            'value'            => array(
                __( 'Initial', 'w9-floral-addon' )    => 'text-initial',
                __( 'UPPERCASE', 'w9-floral-addon' )  => 'text-uppercase',
                __( 'lowercase', 'w9-floral-addon' )  => 'text-lowercase',
                __( 'Capitalize', 'w9-floral-addon' ) => 'text-capitalize',
            ),
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'dropdown',
            'param_name'       => 'meta_label_fw',
            'heading'          => __( 'Label font weight' , 'w9-floral-addon' ),
            'value'            => array(
                __( 'Inherit', 'w9-floral-addon' )         => 'fw-inherit',
                __( 'Light (300)', 'w9-floral-addon' )     => 'fw-light',
                __( 'Regular (400)', 'w9-floral-addon' )   => 'fw-regular',
                __( 'Medium (500)', 'w9-floral-addon' )    => 'fw-medium',
                __( 'Semi Bold (600)', 'w9-floral-addon' ) => 'fw-semibold',
                __( 'Bold (700)', 'w9-floral-addon' )      => 'fw-bold',
            ),
            'std'              => 'fw-inherit',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'dropdown',
            'param_name'       => 'meta_info_fw',
            'heading'          => __( 'Info font weight' , 'w9-floral-addon' ),
            'value'            => array(
                __( 'Inherit', 'w9-floral-addon' )         => 'fw-inherit',
                __( 'Light (300)', 'w9-floral-addon' )     => 'fw-light',
                __( 'Regular (400)', 'w9-floral-addon' )   => 'fw-regular',
                __( 'Medium (500)', 'w9-floral-addon' )    => 'fw-medium',
                __( 'Semi Bold (600)', 'w9-floral-addon' ) => 'fw-semibold',
                __( 'Bold (700)', 'w9-floral-addon' )      => 'fw-bold',
            ),
            'std'              => 'fw-inherit',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__( 'Font size', 'w9-floral-addon' ),
            'param_name'       => 'meta_font_size',
            'value'            => array(
                esc_html__( 'Inherit', 'w9-floral-addon' )     => '',
                '10px'                                         => '10',
                '11px'                                         => '11',
                '12px'                                         => '12',
                '13px'                                         => '13',
                '14px'                                         => '14',
                '15px'                                         => '15',
                '16px'                                         => '16',
                '17px'                                         => '17',
                '18px'                                         => '18',
                '19px'                                         => '19',
                '20px'                                         => '20',
                esc_html__( 'Custom Size', 'w9-floral-addon' ) => 'custom',
            ),
            'std'              => 'fz-30',
            'description'      => esc_html__( 'Select font size.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'admin_label'      => true
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Custom font size', 'w9-floral-addon' ),
            'param_name'       => 'meta_custom_size',
            'value'            => '',
            'description'      => esc_html__( 'Enter custom font-size (unit: px).', 'w9-floral-addon' ),
            'dependency'       => array( 'element' => 'meta_font_size', 'value' => 'custom' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Info items spacing', 'w9-floral' ),
            'description'      => esc_html__( 'Select spacing between each info. Not include the separator width.', 'w9-floral-addon' ),
            'param_name'       => 'meta_spacing',
            'value'            => array(
                'None' => '0',
                '5px'  => '5',
                '10px' => '10',
                '15px' => '15',
                '20px' => '20',
                '25px' => '25',
                '30px' => '30',
            ),
            'std'              => '5',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'        => 'switcher',
            'heading'     => esc_html__( 'Responsive font size', 'w9-floral-addon' ),
            'param_name'  => 'responsive_size',
            'description' => esc_html__( 'Enable or disable font size responsive.', 'w9-floral-addon' ),
            'value'       => '',
            'dependency'  => array( 'element' => 'meta_font_size', 'value_not_equal_to' => array( '' ) ),
            'group'       => __( 'Responsive', 'w9-floral-addon' ),
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Responsive compressor', 'w9-floral-addon' ),
            'param_name'       => 'scale_ratio',
            'value'            => '',
            'description'      => esc_html__( 'Enter responsive compressor (etc: 1.2, 1.5, 0.6, 0.7...). This is for responsive purpose. Default value is 1.', 'w9-floral-addon' ),
            'dependency'       => array( 'element' => 'responsive_size', 'value' => '1' ),
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Minimum font size', 'w9-floral-addon' ),
            'param_name'       => 'minimum_size',
            'value'            => '',
            'description'      => esc_html__( 'Enter minimum font-size (unit px). Default value is 20..', 'w9-floral-addon' ),
            'dependency'       => array( 'element' => 'responsive_size', 'value' => '1' ),
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::design_options_on_tablet(),
        Floral_Map_Helpers::design_options_on_mobile(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );