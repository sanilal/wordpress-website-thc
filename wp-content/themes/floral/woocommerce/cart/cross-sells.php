<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $cross_sells ) :
	$blog_loop_class = array( 'product-style-standard' );
	$archive_blog_display_columns = 4;
	$archive_article_wrapper_class = array();
	$blog_loop_class[] = 'blog-columns-' . $archive_blog_display_columns;
	switch ( $archive_blog_display_columns ) {
		case 2:
			$archive_article_wrapper_class[] = 'col-md-6 col-sm-12';
			break;
		case 3:
			$archive_article_wrapper_class[] = 'col-md-4 col-sm-6 col-xs-12';
			break;
		case 4:
			$archive_article_wrapper_class[] = 'col-md-3 col-sm-6 col-xs-12';
			break;
	}
	?>

	<div class="cross-sells">

		<h2 class="__section-title"><?php esc_html_e( 'You may be interested in&hellip;', 'floral' ) ?></h2>
		<div class="products-loop row <?php floral_the_clean_html_classes( $blog_loop_class ); ?>">
			<?php woocommerce_product_loop_start(); ?>
			
			<?php foreach ( $cross_sells as $cross_sell ) : ?>
				<div class="loop-item article-wrapper <?php floral_the_clean_html_classes( $archive_article_wrapper_class ); ?>">
					<?php
					$post_object = get_post( $cross_sell->get_id() );
					
					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					wc_get_template_part( 'content', 'product' ); ?>
				</div>
			<?php endforeach; ?>
			
			<?php woocommerce_product_loop_end(); ?>

		</div>
	</div>

<?php endif;

wp_reset_postdata();
