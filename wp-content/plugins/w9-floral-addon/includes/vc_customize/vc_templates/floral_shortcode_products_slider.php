<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_products_slider.php
 * @time    : 7/16/2017 2:36 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @var $atts
 * @var $this Floral_SC_Products_Slider
 */
//$total_items = $orderby = $order = $category =
$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts                     = vc_map_get_attributes( $this::SC_BASE, $atts );
$atts['operator']         = 'IN';
$unique_id                = uniqid( 'floral-sc-products-slider-' );
$class_sc_products_slider = array(
	vc_shortcode_custom_css_class( $css ),
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

?>
<div id="<?php echo $unique_id; ?>" class="floral-sc-products-slider clearfix <?php floral_the_clean_html_classes( $class_sc_products_slider ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php
	$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
	$meta_query    = WC()->query->get_meta_query();
	$query_args    = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'orderby'             => $ordering_args['orderby'],
		'order'               => $ordering_args['order'],
		'posts_per_page'      => $atts['total_items'],
		'meta_query'          => $meta_query,
		'tax_query'           => WC()->query->get_tax_query(),
	);
	$loop_name     = 'product_cat';
	
	$query_args = Floral_SC_Products_Slider::add_categories_args( $query_args, $atts['categories'], $atts['operator'] );
	if ( isset( $ordering_args['meta_key'] ) ) {
		$query_args['meta_key'] = $ordering_args['meta_key'];
	}
	//product
	global $woocommerce_loop;
	$products       = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name ) );
	$query_args     = apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name );
	$transient_name = 'wc_loop' . substr( md5( json_encode( $query_args ) . $loop_name ), 28 ) . WC_Cache_Helper::get_transient_version( 'product_query' );
	$products       = get_transient( $transient_name );
	
	if ( false === $products || ! is_a( $products, 'WP_Query' ) ) {
		$products = new WP_Query( $query_args );
		set_transient( $transient_name, $products, DAY_IN_SECONDS * 30 );
	}
	
	ob_start();
	
	if ( $products->have_posts() ) {
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-products-slider/' . 'style-1' . '.php' );
		
	} else {
		do_action( "woocommerce_shortcode_{$loop_name}_loop_no_results", $atts );
	}
	$product_loop = ob_get_clean();
	echo $product_loop;
	woocommerce_reset_loop();
	wp_reset_postdata();
	// product
	WC()->query->remove_ordering_args();
	?>
</div>
