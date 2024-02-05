<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: wc-vc-shortcodes-map.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! floral_is_woocommerce_active() ) {
	return;
}

$args = array(
	'type'         => 'post',
	'child_of'     => 0,
	'parent'       => '',
	'orderby'      => 'id',
	'order'        => 'ASC',
	'hide_empty'   => false,
	'hierarchical' => 1,
	'exclude'      => '',
	'include'      => '',
	'number'       => '',
	'taxonomy'     => 'product_cat',
	'pad_counts'   => false,

);

$order_by_values = array(
	'',
	__( 'Date', 'w9-floral-addon' )          => 'date',
	__( 'ID', 'w9-floral-addon' )            => 'ID',
	__( 'Author', 'w9-floral-addon' )        => 'author',
	__( 'Title', 'w9-floral-addon' )         => 'title',
	__( 'Modified', 'w9-floral-addon' )      => 'modified',
	__( 'Random', 'w9-floral-addon' )        => 'rand',
	__( 'Comment count', 'w9-floral-addon' ) => 'comment_count',
	__( 'Menu order', 'w9-floral-addon' )    => 'menu_order',
);

$order_way_values = array(
	'',
	__( 'Descending', 'w9-floral-addon' ) => 'DESC',
	__( 'Ascending', 'w9-floral-addon' )  => 'ASC',
);

$display_type = array(
	'type'        => 'dropdown',
	'heading'     => esc_html__( 'Display type', 'w9-floral-addon' ),
	'param_name'  => 'display_type',
	'admin_label' => true,
	'value'       => array(
		esc_html__( 'Style 1 (standard)', 'w9-floral-addon' ) => 'standard',
		esc_html__( 'Style 2', 'w9-floral-addon' )            => 'style-2',
		esc_html__( 'Style 3', 'w9-floral-addon' )            => 'style-3',
//		esc_html__( 'Style 4', 'w9-floral-addon' )            => 'style-4',
	),
	'std'         => 'standard',
	'description' => esc_html__( 'Select display type.', 'w9-floral-addon' )
);

$layout_style = array(
	'type'        => 'dropdown',
	'heading'     => esc_html__( 'Layout Style', 'w9-floral-addon' ),
	'param_name'  => 'layout_style',
	'admin_label' => true,
	'value'       => array(
		esc_html__( 'Grid', 'w9-floral-addon' )   => 'grid',
		esc_html__( 'Slider', 'w9-floral-addon' ) => 'slider',
	),
	'std'         => 'grid',
	'description' => esc_html__( 'Select layout style.', 'w9-floral-addon' )
);

$columns = array(
	'type'        => 'dropdown',
	'heading'     => __( 'Columns', 'w9-floral-addon' ),
	'value'       => array(
		'2' => '2',
		'3' => '3',
		'4' => '4',
	),
	'param_name'  => 'columns',
	'save_always' => true,
	'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'w9-floral-addon' ),
);

$columns_dep = array(
	'type'        => 'dropdown',
	'heading'     => __( 'Columns', 'w9-floral-addon' ),
	'value'       => array(
		'2' => '2',
		'3' => '3',
		'4' => '4',
	),
	'param_name'  => 'columns',
	'save_always' => true,
	'description' => __( 'The columns attribute controls how many columns wide the products should be before wrapping.', 'w9-floral-addon' ),
	'dependency'  => array(
		'element' => 'layout_style',
		'value'   => 'grid',
	)
);


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
	'element' => 'layout_style',
	'value'   => 'slider',
) );


// populate integrated vc_icons params.
if ( is_array( $slider_params ) && ! empty( $slider_params ) ) {
	foreach ( $slider_params as $key => $param ) {
		if ( is_array( $param ) && ! empty( $param ) ) {
			if ( isset( $param['admin_label'] ) ) {
				// remove admin label
				unset( $slider_params[ $key ]['admin_label'] );
			}
		}
	}
}

/*-------------------------------------
	RECENT PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Recent products', 'w9-floral-addon' ),
	'base'        => 'recent_products',
	'icon'        => 'w9 w9-ico-ecommerce-bag-check',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'Lists recent products', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'per_page',
			'description' => __( 'The "per_page" shortcode determines how many products to show on the page', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
	), $slider_params ),
) );

/*-------------------------------------
	FEATURED PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Featured products', 'w9-floral-addon' ),
	'base'        => 'featured_products',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'Display products set as "featured"', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'param_name'  => 'per_page',
			'save_always' => true,
			'description' => __( 'The "per_page" shortcode determines how many products to show on the page.', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
	), $slider_params )
) );

/*-------------------------------------
	SALE PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Sale products', 'w9-floral-addon' ),
	'base'        => 'sale_products',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'List all products on sale', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'per_page',
			'description' => __( 'How much items per page to show.', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
	), $slider_params )
) );

/*-------------------------------------
	BEST SELLING PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Best Selling Products', 'w9-floral-addon' ),
	'base'        => 'best_selling_products',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'List best selling products on sale', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'param_name'  => 'per_page',
			'save_always' => true,
			'description' => __( 'How much items per page to show.', 'w9-floral-addon' ),
		),
		$columns_dep,
	), $slider_params )
) );

/*-------------------------------------
	TOP RATED PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Top Rated Products', 'w9-floral-addon' ),
	'base'        => 'top_rated_products',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'List all products on sale', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'param_name'  => 'per_page',
			'save_always' => true,
			'description' => __( 'How much items per page to show.', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
	), $slider_params )
) );

/*-------------------------------------
	PRODUCT ATTRIBUTE
---------------------------------------*/
$attributes_tax = wc_get_attribute_taxonomies();
$attributes     = array();
foreach ( $attributes_tax as $attribute ) {
	$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
}
vc_map( array(
	'name'        => __( 'Product Attribute', 'w9-floral-addon' ),
	'base'        => 'product_attribute',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'List products with an attribute shortcode', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'param_name'  => 'per_page',
			'save_always' => true,
			'description' => __( 'How much items per page to show.', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Attribute', 'w9-floral-addon' ),
			'param_name'  => 'attribute',
			'value'       => $attributes,
			'save_always' => true,
			'description' => __( 'List of product taxonomy attribute.', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'checkbox',
			'heading'     => __( 'Filter', 'w9-floral-addon' ),
			'param_name'  => 'filter',
			'value'       => array( 'empty' => 'empty' ),
			'save_always' => true,
			'description' => __( 'Taxonomy values.', 'w9-floral-addon' ),
			'dependency'  => array(
				'callback' => 'vcWoocommerceProductAttributeFilterDependencyCallback',
			),
		),
	), $slider_params )
) );

/*-------------------------------------
	PRODUCT
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Product', 'w9-floral-addon' ),
	'base'        => 'product',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'Show a single product by ID or SKU', 'w9-floral-addon' ),
	'params'      => array(
		$display_type,
		array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Select identificator', 'w9-floral-addon' ),
			'param_name'  => 'id',
			'description' => __( 'Input product ID or product SKU or product title to see suggestions.', 'w9-floral-addon' ),
		),
		array(
			'type'       => 'hidden',
			// This will not show on render, but will be used when defining value for autocomplete
			'param_name' => 'sku',
		),
	)
) );

/*-------------------------------------
	PRODUCTS
---------------------------------------*/
vc_map( array(
	'name'        => __( 'Products', 'w9-floral-addon' ),
	'base'        => 'products',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'Show multiple products by ID or SKU.', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'std'         => 'title',
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s. Default by Title', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s. Default by ASC', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'autocomplete',
			'heading'     => __( 'Products', 'w9-floral-addon' ),
			'param_name'  => 'ids',
			'settings'    => array(
				'multiple'      => true,
				'sortable'      => true,
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' => true,
			'description' => __( 'Enter List of Products.', 'w9-floral-addon' ),
		),
		array(
			'type'       => 'hidden',
			'param_name' => 'skus',
		),
	), $slider_params )
) );

/*-------------------------------------
	PRODUCT CATEGORY
---------------------------------------*/
// All this move to product
$categories = get_categories( $args );

$product_categories_dropdown = array();
Floral_Map_Helpers::getCategoryChildsFull( 0, 0, $categories, 0, $product_categories_dropdown );
//var_dump($product_categories_dropdown);
vc_map( array(
	'name'        => __( 'Product category', 'w9-floral-addon' ),
	'base'        => 'product_category',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __( 'WooCommerce', 'w9-floral-addon' ),
	'description' => __( 'Show multiple products in a category', 'w9-floral-addon' ),
	'params'      => array_merge( array(
		$layout_style,
		$display_type,
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Per page', 'w9-floral-addon' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'per_page',
			'description' => __( 'How much items per page to show.', 'w9-floral-addon' ),
		),
		$columns_dep,
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Category', 'w9-floral-addon' ),
			'value'       => $product_categories_dropdown,
			'param_name'  => 'category',
			'save_always' => true,
			'description' => __( 'Product category list.', 'w9-floral-addon' ),
		),
	), $slider_params )
) );
/*-------------------------------------
	FlORAL PRODUCTS SLIDER
---------------------------------------*/
$product_categories_multi_select =array();
Floral_Map_Helpers::get_categories_for_param_multi_select( 0,0,$categories,0, $product_categories_multi_select );
vc_map( array(
	'name'           => esc_html__( 'Floral Products Slider', 'w9-floral-addon' ),
	'base'           => Floral_SC_Products_Slider::SC_BASE,
	'class'          => '',
	'icon'           => 'w9 w9-ico-shopper29',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'php_class_name' => 'Floral_SC_Products_Slider',
	'description'    => __( 'Must be used with "full-width" row', 'w9-floral-addon' ),
	'params'         => array(
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Total items', 'w9-floral-addon' ),
			'value'       => 12,
			'save_always' => true,
			'param_name'  => 'total_items',
			'description' => __( 'How much items to show.', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Order by', 'w9-floral-addon' ),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Sort order', 'w9-floral-addon' ),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'w9-floral-addon' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
		),
		array(
			'type'        => 'multi-select',
			'heading'     => __( 'Categories', 'w9-floral-addon' ),
			'options'       => $product_categories_multi_select,
			'param_name'  => 'categories',
			'save_always' => true,
			'description' => __( 'Product category list.', 'w9-floral-addon' ),
		),
		
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay(),
		Floral_Map_Helpers::extra_class()
	)
) );

/*-------------------------------------
	PRODUCT CATEGORIES
---------------------------------------*/
vc_map(array(
	'name'        => __('Product categories', 'w9-floral-addon'),
	'base'        => 'product_categories',
	'icon'        => 'icon-wpb-woocommerce',
	'category'    => __('WooCommerce', 'w9-floral-addon'),
	'description' => __('Display product categories loop', 'w9-floral-addon'),
	'params'      => array(
		array(
			'type'        => 'textfield',
			'heading'     => __('Number', 'w9-floral-addon'),
			'param_name'  => 'number',
			'description' => __('The `number` field is used to display the number of products.', 'w9-floral-addon'),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __('Order by', 'w9-floral-addon'),
			'param_name'  => 'orderby',
			'value'       => $order_by_values,
			'save_always' => true,
			'description' => sprintf(__('Select how to sort retrieved products. More at %s.', 'w9-floral-addon'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>'),
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __('Sort order', 'w9-floral-addon'),
			'param_name'  => 'order',
			'value'       => $order_way_values,
			'save_always' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', 'w9-floral-addon'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>'),
		),
		$columns,
		array(
			'type'        => 'textfield',
			'heading'     => __('Number', 'w9-floral-addon'),
			'param_name'  => 'hide_empty',
			'description' => __('Hide empty', 'w9-floral-addon'),
		),
		array(
			'type'        => 'autocomplete',
			'heading'     => __('Categories', 'w9-floral-addon'),
			'param_name'  => 'ids',
			'settings'    => array(
				'multiple' => true,
				'sortable' => true,
			),
			'save_always' => true,
			'description' => __('List of product categories', 'w9-floral-addon'),
		),
	),
));