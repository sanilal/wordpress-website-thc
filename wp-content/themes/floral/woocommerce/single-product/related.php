<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

if ( $related_products ) :
	
	// layout
//	$archive_display_type = Floral_Woocommerce::get_current_product_archive_display_type();
	$blog_loop_class = array( 'product-style-standard' );
	
	
	//$archive_blog_display_columns  = floral_get_option( 'product-archive-display-columns', '', '3' );
	
	$single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
	if ( ! in_array( $single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
		$single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
		if ( floral_is_meta_default_value( $single_sidebar ) ) {
			$single_sidebar = floral_get_option( 'product-single-sidebar', '', 'left' );
		}
	}
	$single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
	if ( floral_is_meta_default_value( $single_sidebar_left ) ) {
		$single_sidebar_left = floral_get_option( 'product-single-sidebar-left', '', 'sidebar-1' );
	}
	
	$single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
	if ( floral_is_meta_default_value( $single_sidebar_right ) ) {
		$single_sidebar_right = floral_get_option( 'product-single-sidebar-right', '', 'sidebar-2' );
	}
	$display_left  = ( $single_sidebar == 'left' || $single_sidebar == 'both' ) && is_active_sidebar( $single_sidebar_left );
	$display_right = ( $single_sidebar == 'right' || $single_sidebar == 'both' ) && is_active_sidebar( $single_sidebar_right );
	
	$archive_blog_display_columns  = 4;
	$archive_article_wrapper_class = array();
	
	if ( $display_left || $display_right ) {
		$archive_blog_display_columns    = 3;
		$archive_article_wrapper_class[] = 'col-md-4 col-sm-6 col-xs-12';
	} else {
		$archive_article_wrapper_class[] = 'col-md-3 col-sm-4 col-xs-12';
	}
	
	
	$blog_loop_class[] = 'blog-columns-' . $archive_blog_display_columns;
	
	$related_class = array();
	?>

	<div class="related products <?php floral_the_clean_html_classes( $related_class ); ?>">
		<h2 class="__section-title"><?php esc_html_e( 'Related products', 'floral' ); ?></h2>
		<div class="products-loop row <?php floral_the_clean_html_classes( $blog_loop_class ); ?>">
			<?php woocommerce_product_loop_start(); ?>
			
			<?php foreach ( $related_products as $related_product ) : ?>
				<div class="loop-item article-wrapper <?php floral_the_clean_html_classes( $archive_article_wrapper_class ); ?>">
					<?php
					$post_object = get_post( $related_product->get_id() );
					
					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					wc_get_template_part( 'content', 'product' ); ?>
				</div>
			<?php endforeach; ?>
			
			<?php woocommerce_product_loop_end(); ?>

		</div>
	</div>

<?php endif;

wp_reset_postdata();
