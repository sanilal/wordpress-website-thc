<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;



// Ensure visibility
if ( empty( $product ) || !$product->is_visible() ) {
    return;
}
?>
<article id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
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
             * @hooked floral_woocommerce_show_product_loop_quick_view - 10
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
        <div class="product-info mt-15">
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
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</article>
