<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

/**
 * woocommerce_before_single_product hook.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	
	return;
}

$product_class = array( 'product' );
$product_row   = array( 'row' );

if ( defined( 'DOING_AJAX' ) ) {
	$product_class[] = 'quick-view-template';
} else {
	$product_row[] = 'mb-50';
	$product_row[] = 'mb-sm-max-30';
	$product_row[] = 'mb-xxs-max-10';
}

?>

<article itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
				 id="product-<?php the_ID(); ?>" <?php wc_product_class($product_class); ?>>
	<div class="<?php floral_the_clean_html_classes($product_row) ?>">
		<div class="product-item-images-wrapper col-md-6 col-sm-12">
			<div class="product-item-images">
				<?php
				/**
				 * woocommerce_before_single_product_summary hook.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
		</div>

		<div class="product-item-summary-wrapper col-md-6 col-sm-12">
			<div class="product-summary entry-summary">
				
				<?php
				/**
				 * woocommerce_single_product_summary hook.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
		 		*/
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div><!-- .summary -->
	</div>
	
	<?php
	/**
	 * woocommerce_after_single_product_summary hook.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article>

<?php do_action( 'woocommerce_after_single_product' ); ?>
