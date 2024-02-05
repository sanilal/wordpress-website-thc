<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: content-product-standard.php
 * @time    : 7/13/2017 4:36 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

//var_dump(get_comments_number($product->get_id()));
$has_rating = ($product->get_review_count() > 0) ? 'has-rating' : '' ;
//$has_rating = have_comments() ? 'has-rating' : '' ;

?>
<article id="product-<?php the_ID(); ?>" <?php post_class($has_rating); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<div class="product-inner">
		<div class="product-thumbnail">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked floral_woocommerce_template_quick_view - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 * @hooked woocommerce_template_loop_product_secondary_thumbnail - 13
			 * @hooked woocommerce_template_loop_product_link_open - 15
			 * @hooked woocommerce_template_loop_product_link_close - 20
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			
			/**
			 * floral_woocommerce_product_actions hook.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'floral_woocommerce_product_actions' );
			?>
		</div>
		<div class="product-info">
			<?php
			/**
			 * woocommerce_shop_loop_item_title hook.
			 * @hooked woocommerce_template_loop_product_link_open - 5
			 * @hooked woocommerce_template_loop_product_title - 10
			 * @hooked woocommerce_template_loop_product_link_close - 15
			 */
			do_action( 'woocommerce_shop_loop_item_title' );
			
			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_price - 1
			 * @hooked floral_woocommerce_template_categories - 3
			 * @hooked woocommerce_template_loop_rating - 5
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</article>