<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-product-single.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'      => esc_html__( 'Product Single', 'floral' ),
    'desc'       => esc_html__( 'Single product settings.', 'floral' ),
    'icon'       => 'el el-file',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'product-single-sale-flash',
            'type'     => 'switch',
            'title'    => esc_html__('Sale flash', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide sale flash in product single page.', 'floral' ),
            'default'  => '1'
        ),
        array(
            'id'       => 'product-single-add-to-cart-btn',
            'type'     => 'switch',
            'title'    => esc_html__( 'Add-to-cart button', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide the add-to-cart button in product single page.', 'floral' ),
            'default'  => 1
        ),
        array(
            'id'       => 'product-single-product-rating',
            'type'     => 'switch',
            'title'    => esc_html__( 'Product rating', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide product rating.', 'floral' ),
            'default'  => 1
        ),

        array(
            'id'       => 'product-single-product-meta',
            'type'     => 'switch',
            'title'    => esc_html__( 'Product meta', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide product meta.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),

        array(
            'id'       => 'product-single-sharing-icons',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sharing icons', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide sharing icons.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),

        array(
            'id'       => 'product-single-related-products',
            'type'     => 'switch',
            'title'    => esc_html__( 'Related products', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide related products.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),

        array(
            'id'       => 'product-single-related-products-amount',
            'type'     => 'text',
            'title'    => esc_html__( 'Amount of related products', 'floral' ),
            'subtitle' => esc_html__( 'Number of related products to show.', 'floral' ),
            'validate' => 'number',
            'default'  => '4',
            'required' => array(
                'product-single-related-products', '=', '1'
            )
        ),

//        array(
//            'id'       => 'product-single-mouse-wheel',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Slide image by mouse-wheel', 'floral' ),
//            'subtitle' => esc_html__( 'Turn on this feature, allow you to slide the image slider in product single by using mouse wheel.', 'floral' ),
//            'desc'     => '',
//            'default'  => '1'
//        ),

        array(
            'id'             => 'product-single-margin',
            'type'           => 'spacing',
            'mode'           => 'margin',
            'units'          => 'px',
            'units_extended' => 'false',
            'title'          => esc_html__( 'Margin top/bottom', 'floral' ),
            'subtitle'       => esc_html__( 'This must be numeric (no px). Leave blank for default.', 'floral' ),
            'desc'           => esc_html__( 'If you would like to override the default footer top/bottom margin, then you can do so here.', 'floral' ),
            'left'           => false,
            'right'          => false,
            'default'        => array(
                'margin-top'    => '120px',
                'margin-bottom' => '80px',
                'units'         => 'px',
            ),
            'output'         => array( '.site-main-single.product-single' )
        ),
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Layout Settings', 'floral' )
        ),


        array(
            'id'       => 'product-single-layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select single product layout.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'fullwidth'       => esc_html__( 'Full Width', 'floral' ),
                'container'       => esc_html__( 'Container', 'floral' ),
                'container-xlg'   => esc_html__( 'Container Extended', 'floral' ),
                'container-fluid' => esc_html__( 'Container Fluid', 'floral' )
            ),
            'default'  => 'container'
        ),
	
	    array(
		    'id'       => 'product-single-widget-title-style',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Widget title style', 'floral' ),
		    'subtitle' => esc_html__( 'Select widget title style. If this field is set to default, the same one on "General Tab" will take control', 'floral' ),
		    'desc'     => '',
		    'options'  => array(
			    ''        => esc_html__( 'Default', 'floral' ),
			    'style-1' => esc_html__( 'Style 1', 'floral' ),
			    'style-2' => esc_html__( 'Style 2', 'floral' ),
		    ),
		    'default'  => ''
	    ),

        array(
            'id'       => 'product-single-sidebar',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar style.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'none'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-none.png' ),
                'left'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-left.png' ),
                'right' => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-right.png' ),
                'both'  => array( 'title' => '', 'img' => floral_theme_url() . 'assets/images/sidebar-both.png' ),
            ),
            'default'  => 'none'
        ),

        array(
            'id'       => 'product-single-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'product-single-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),


        array(
            'id'       => 'product-single-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'product-single-sidebar', '=', array( 'left', 'both' ) ),
        ),

        array(
            'id'       => 'product-single-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'product-single-sidebar', '=', array( 'right', 'both' ) ),
        ),
    )
);