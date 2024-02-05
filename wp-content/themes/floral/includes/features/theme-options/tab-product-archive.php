<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-product-archive.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Shop', 'floral' ),
    'desc'   => esc_html__( 'Shop (Woocommerce) settings.', 'floral' ),
    'icon'   => 'w9 w9-ico-shopper29',
    'fields' => array(
        // cart icon
        array(
            'id'       => 'shop-cart-icon',
            'type'     => 'button_set',
            'title'    => esc_html__('Cart icon', 'floral' ),
            'options'  => array(
                'flor-ico flor-ico-icon-bag'   => '<i class="flor-ico flor-ico-icon-bag"></i>',
                'flor-ico flor-ico-icon-bag-alt'   => '<i class="flor-ico flor-ico-icon-bag-alt"></i>',
                'w9 w9-ico-shopper29'   => '<i class="w9 w9-ico-shopper29"></i>',
                'w9 w9-ico-svg-icon-02' => '<i class="w9 w9-ico-svg-icon-02"></i>',
                'flor-ico flor-ico-icon-cart-alt' => '<i class="flor-ico flor-ico-icon-cart-alt"></i>',
                'flor-ico flor-ico-icon-cart'    => '<i class="flor-ico flor-ico-icon-cart"></i>',
//                'w9 w9-ico-svg-icon-16' => '<i class="w9 w9-ico-svg-icon-16"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite cart icon.', 'floral' ),
            'default'  => 'flor-ico flor-ico-icon-bag',
            'compiler' => true
        ),
        
        array(
            'id'       => 'shop-quick-view',
            'type'     => 'switch',
            'title'    => esc_html__( 'Quick view', 'floral' ),
            'subtitle' => esc_html__( 'Turn on or off product quick view feature.', 'floral' ),
            'default'  => 1
        ),

//        array(
//            'id'       => 'shop-quick-view-nav',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Quick view navigation', 'floral' ),
//            'subtitle' => esc_html__( 'Turn on or off product quick view navigation feature.', 'floral' ),
//            'default'  => 0,
//            'required' => array(
//                'shop-quick-view',
//                '=',
//                1
//            )
//        ),

        /*-------------------------------------
        	MINI CART
        ---------------------------------------*/
        array(
            'id'       => 'shop-mini-cart-ajax-actions',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mini cart ajax actions', 'floral' ),
            'subtitle' => esc_html__( 'Using ajax for actions in mini cart.', 'floral' ),
            'default'  => 0,
        ),

        array(
            'id'       => 'shop-mini-cart-scrollbar-start',
            'type'     => 'text',
            'title'    => esc_html__( 'Mini cart scrollbar start', 'floral' ),
            'subtitle' => esc_html__( 'Enter amount of item show be shown in the mini cart, if number of item in the cart greater than this value, the scroll bar will be appeared. Default value is 3.', 'floral' ),
            'desc'     => esc_html__( 'If you find that changing this option does not work, please try to add an item to the cart to refresh the session storage.', 'floral' ),
            'validate' => 'numeric',
            'default'  => '3'
        ),
    )
);

$this->sections[] = array(
    'title'      => esc_html__( 'Product Archive', 'floral' ),
    'desc'       => esc_html__( 'Product archive settings.', 'floral' ),
    'icon'       => 'el el-folder-close',
    'subsection' => true,
    'fields'     => array(
//        array(
//            'id'       => 'product-archive-display-type',
//            'type'     => 'select',
//            'title'    => esc_html__( 'Display type', 'floral' ),
//            'subtitle' => esc_html__( 'Select archive display type.', 'floral' ),
//            'desc'     => '',
//            'options'  => array(
//                'simple' => esc_html__( 'Simple', 'floral' ),
//                'classic' => esc_html__( 'Classic', 'floral' ),
//                'modern'  => esc_html__( 'Modern', 'floral' ),
//            ),
//            'default'  => 'simple'
//        ),
        
        array(
            'id'       => 'product-archive-display-columns',
            'type'     => 'select',
            'title'    => esc_html__( 'Display columns', 'floral' ),
            'subtitle' => esc_html__( 'Choose the number of columns to display on archive pages.', 'floral' ),
            'options'  => array(
                '2' => '2',
                '3' => '3',
                '4' => '4'
            ),
            'desc'     => '',
            'default'  => '3'
        ),
        
        array(
            'id'       => 'product-archive-item-per-page',
            'type'     => 'text',
            'title'    => esc_html__( 'Item per page', 'floral' ),
            'subtitle' => esc_html__( 'Enter amount of item per page. Default value is 12.', 'floral' ),
            'validate' => 'numeric',
            'default'  => '12'
        ),
        array(
            'id'       => 'product-archive-paging-type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Paging type', 'floral' ),
            'subtitle' => esc_html__( 'Select archive paging type.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'default'         => esc_html__( 'Default', 'floral' ),
                'load-more'       => esc_html__( 'Load More', 'floral' ),
                'infinite-scroll' => esc_html__( 'Infinite Scroll', 'floral' )
            ),
            'default'  => 'default'
        ),
        
        array(
            'id'             => 'product-archive-margin',
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
                'margin-top'    => '80px',
                'margin-bottom' => '0',
                'units'         => 'px',
            ),
            'output'         => array( '.site-main-archive.product-archive' )
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Layout Settings', 'floral' ),
        ),
        array(
            'id'       => 'product-archive-layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select archive layout.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'fullwidth'       => esc_html__( 'Full Width', 'floral' ),
                'container'       => esc_html__( 'Container', 'floral' ),
                'container-xlg'   => esc_html__( 'Container Extended', 'floral' ),
                'container-fluid' => esc_html__( 'Container Fluid', 'floral' )
            ),
            'default'  => 'container-xlg',
            'validate' => 'not_empty'
        ),
	
	    array(
		    'id'       => 'product-archive-widget-title-style',
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
            'id'       => 'product-archive-sidebar',
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
            'id'       => 'product-archive-sidebar-width',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Sidebar width', 'floral' ),
            'subtitle' => esc_html__( 'Set sidebar width.', 'floral' ),
            'desc'     => '',
            'options'  => array(
                'small' => esc_html__( 'Small (1/4)', 'floral' ),
                'large' => esc_html__( 'Large (1/3)', 'floral' )
            ),
            'default'  => 'small',
            'required' => array( 'product-archive-sidebar', '=', array( 'left', 'both', 'right' ) ),
        ),
        
        array(
            'id'       => 'product-archive-sidebar-left',
            'type'     => 'select',
            'title'    => esc_html__( 'Left sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default left sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'product-archive-sidebar', '=', array( 'left', 'both' ) ),
        ),
        
        array(
            'id'       => 'product-archive-sidebar-right',
            'type'     => 'select',
            'title'    => esc_html__( 'Right sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the default right sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-2',
            'required' => array( 'product-archive-sidebar', '=', array( 'right', 'both' ) ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Other Settings', 'floral' )
        ),
        array(
            'id'       => 'product-archive-sale-flash',
            'type'     => 'switch',
            'title'    => esc_html__('Sale flash', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide sale flash in product archive page.', 'floral' ),
            'default'  => '1'
        ),
        array(
            'id'       => 'product-archive-add-to-cart-btn',
            'type'     => 'switch',
            'title'    => esc_html__( 'Add-to-cart button', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide the add-to-cart button in product archive page.', 'floral' ),
            'default'  => 1
        ),
        array(
            'id'       => 'product-archive-show-result-count',
            'type'     => 'switch',
            'title'    => esc_html__( 'Result count', 'floral' ),
            'subtitle' => esc_html__( 'Show/hide result count in product archive page.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),
        array(
            'id'       => 'product-archive-show-catalog-ordering',
            'type'     => 'switch',
            'title'    => esc_html__( 'Catalog ordering', 'floral' ),
            'subtitle' => esc_html__( 'Show/hide catalog ordering in product archive page.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),
        array(
            'id'       => 'product-archive-show-rating',
            'type'     => 'switch',
            'title'    => esc_html__( 'Product rating', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide product rating in product archive page.', 'floral' ),
            'desc'     => '',
            'default'  => '1'
        ),
        array(
            'id'       => 'product-archive-secondary-image-on-hover',
            'type'     => 'switch',
            'title'    => esc_html__( 'Product secondary image on hover', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide secondary image when hover on the product image in archive product page.', 'floral' ),
            'desc'     => esc_html__( 'This feature will get the first item of Product Gallery, if your product does not have any image in Product Gallery, this feature will not work for that product.', 'floral' ),
            'default'  => '1'
        ),
    )
);