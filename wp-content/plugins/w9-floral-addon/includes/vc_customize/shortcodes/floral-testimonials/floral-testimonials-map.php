<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-testimonials-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$testimonial_params = array();

$manual_creation_params = array(
    'type'       => 'param_group',
    'heading'    => __( 'Testimonials', 'w9-floral-addon' ),
    'param_name' => 'testimonial_values',
    'value'      => '',
    'params'     => array(
        array(
            'type'        => 'textarea',
            'heading'     => __( 'Quote content', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_content',
            'description' => __( 'Enter quote content.', 'w9-floral-addon' )
        ),

        array(
            'type'        => 'slider',
            'heading'     => __( 'Rating', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_rate',
            'min'         => '1',
            'max'         => '5',
            'step'        => '0.1',
            'std'         => '5',
            'description' => __( 'Choose rating. Note: Do not use this option if you set Style to Floral ', 'w9-floral-addon' )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Author name', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_author_name',
            'admin_label' => true,
            'description' => __( 'Enter author name.', 'w9-floral-addon' )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Author job', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_author_job',
            'admin_label' => true,
            'description' => __( 'Enter author job.', 'w9-floral-addon' )
        ),
        array(
            'type'        => 'vc_link',
            'heading'     => __( 'Author url', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_author_url',
            'description' => __( 'Enter author url.', 'w9-floral-addon' )
        ), array(
            'type'        => 'attach_image',
            'heading'     => __( 'Author avatar', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_author_avatar',
            'description' => __( 'Enter author avatar.', 'w9-floral-addon' )
        ),
    ),
    'dependency' => array(
        'element' => 'testimonial_source',
        'value'   => array( 'review-manual' )
    )
);

$content_source_param = array(
    'type'        => 'dropdown',
    'heading'     => __( 'Review source', 'w9-floral-addon' ),
    'param_name'  => 'testimonial_source',
    'value'       => array(
        __( 'Manual Creation', 'w9-floral-addon' ) => 'review-manual',
    ),
    'description' => __( 'Choose reviews source. You can enable review custom post type to pull data from it.' , 'w9-floral-addon' )
);

$content_review_params = array();

if ( post_type_exists( Floral_CPT_Review::CPT_SLUG ) ) {
    $content_source_param['value'][__( 'From Review CPT', 'w9-floral-addon' )] = 'review-cpt';

    $review_cats           = floral_get_terms_by_tax( Floral_CPT_Review::TAX_SLUG, 'slug' );
    $content_review_params = array(
        array(
            'type'        => 'multi-select',
            'heading'     => __( 'Review category', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_category',
            'admin_label' => true,
            'options'     => $review_cats,
            'dependency'  => array(
                'element' => 'testimonial_source',
                'value'   => array( 'review-cpt' )
            )
        ),
        array(
            'type'        => 'number',
            'heading'     => __( 'Number of items', 'w9-floral-addon' ),
            'param_name'  => 'testimonial_items',
            'value'       => '',
            'description' => __( 'Enter number of items to show. Default value is 6. Enter -1 to show all.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element' => 'testimonial_source',
                'value'   => array( 'review-cpt' )
            )
        )
    );
}


$testimonial_params[] = $content_source_param;
$testimonial_params[] = $manual_creation_params;
$testimonial_params   = array_merge( $testimonial_params, $content_review_params );

$slider_params = vc_map_integrate_shortcode( Floral_SC_Slider_Container::SC_BASE, '', __( 'Slider', 'w9-floral-addon' ), array(
    'exclude' => array(
        'css',
        'el_class',
        'animation_css',
        'animation_duration',
        'animation_delay',
        'tablet_css',
        'mobile_css',
    ),
    // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
), array(
    'element' => 'testimonial_layout',
    'value'   => 'layout-slider',
) );


vc_map( array(
    'name'           => __( 'Floral Testimonials', 'w9-floral-addon' ),
    'base'           => Floral_SC_Testimonials::SC_BASE,
    'icon'           => 'w9 w9-ico-quote',
    'description'    => __( 'Create testimonial.', 'w9-floral-addon' ),
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'php_class_name' => 'Floral_SC_Testimonials',
    'params'         => array_merge(
        $testimonial_params,
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Style', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_style',
                'admin_label' => true,
                'value'       => array(
                    __( 'Floral', 'w9-floral-addon' ) => 'style-floral',
                    __( 'Simple', 'w9-floral-addon' ) => 'style-simple',
                    __( 'Flat', 'w9-floral-addon' )   => 'style-flat',
                    __( 'Modern', 'w9-floral-addon' ) => 'style-modern',
                ),
                'description' => __( 'Select Testimonial Style.', 'w9-floral-addon' )
            ),
            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Border box shadow', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_border_box_shadow',
                'value'       => array( __( 'Show border box shadow?', 'w9-floral-addon' ) => 'yes' ),
                'description' => __( 'Show border box shadow, this option only work on style flat.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'testimonial_style',
                    'value'   => array( 'style-floral' )
                )
            ),

            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Author avatar', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_show_author_avatar',
                'value'       => array( __( 'Show author avatar?', 'w9-floral-addon' ) => 'yes' ),
                'description' => __( 'Show author avatar or not.', 'w9-floral-addon' ),
                'std'         => 'yes'
            ),

            array(
                'type'        => 'checkbox',
                'heading'     => __( 'Rating', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_show_author_rating',
                'value'       => array( __( 'Show rating?', 'w9-floral-addon' ) => 'yes' ),
                'description' => __( 'Show rating or not.', 'w9-floral-addon' ),
                'std'         => '',
                'dependency'  => array(
	                'element' => 'testimonial_style',
	                'value_not_equal_to'   => array( 'style-floral' )
                )
            ),

            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Main color scheme', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_color_scheme',
                'value'       => array(
                    __( 'Dark', 'w9-floral-addon' )  => 'color-dark',
                    __( 'Light', 'w9-floral-addon' ) => 'color-light' ),
                'std'         => 'color-dark',
                'dependency'  => array(
	                'element' => 'testimonial_style',
	                'value_not_equal_to'   => array( 'style-floral' )
                ),
                'description' => __( 'Select color scheme.', 'w9-floral-addon' )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Layout', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_layout',
                'admin_label' => true,
                'value'       => array(
                    __( 'Grid', 'w9-floral-addon' )   => 'layout-grid',
                    __( 'Slider', 'w9-floral-addon' ) => 'layout-slider',
                ),
                'description' => __( 'Select Testimonial Style.', 'w9-floral-addon' )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Columns', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_columns',
                'value'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'description' => __( 'Select number of columns to be displayed.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'testimonial_layout',
                    'value'   => array( 'layout-grid' )
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => __( 'Spacing', 'w9-floral-addon' ),
                'param_name'  => 'testimonial_spacing',
                'value'       => array(
                    '5px'  => '5',
                    '10px' => '10',
                    '15px' => '15',
                    '20px' => '20',
                    '25px' => '25',
                    '30px' => '30',
                ),
                'description' => __( 'Select the spacing between items.', 'w9-floral-addon' ),
                'dependency'  => array(
                    'element' => 'testimonial_layout',
                    'value'   => array( 'layout-grid' )
                )
            ),
            Floral_Map_Helpers::extra_class(),
        ),
        $slider_params,
        array(
            Floral_Map_Helpers::design_options(),
            Floral_Map_Helpers::animation_css(),
            Floral_Map_Helpers::animation_duration(),
            Floral_Map_Helpers::animation_delay()
        )
    )
) );


