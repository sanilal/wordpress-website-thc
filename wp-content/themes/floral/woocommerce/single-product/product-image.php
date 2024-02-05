<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$product_images = array();

if ( has_post_thumbnail() && get_the_post_thumbnail_url() !== false ) {
	$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
	$product_images[] = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title' => $props['title'],
		'alt'   => $props['alt'],
	) );
} else {
	if ( wc_placeholder_img_src() ) {
		$product_thumb_images[] = wc_placeholder_img( apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
	} else {
		$product_images[] = Floral_Image::get_placeholder_image( apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
	}
}

$attachments = $product->get_gallery_image_ids();
if ( $attachments ) {
	foreach ( $attachments as $id ) {
		if ( wp_get_attachment_image_src( $id ) !== false ) {
			$props            = wc_get_product_attachment_props( $id );
			$product_images[] = wp_get_attachment_image( $id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, array(
				'title' => $props['title'],
				'alt'   => $props['alt'],
			) );
		} else {
			if ( wc_placeholder_img_src() ) {
				$product_thumb_images[] = wc_placeholder_img( apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			} else {
				$product_images[] = Floral_Image::get_placeholder_image( apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			}
		}
	}
}

$sync_1_default_options = array(
	'infinite'     => false,
	'slidesToShow' => 1,
	'dots'         => false,
	'arrows'       => false,
	'speed'        => 400,
//    'fade'         => true,
//	'asNavFor'     => '.sync-2-of-' . get_the_ID(),

);
$product_images_class   = array( 'sync-1-of-' . get_the_ID() );
$product_images_class[] = 'sync-1';
//if ( floral_get_option( 'product-single-mouse-wheel' ) ) {
//	wp_enqueue_script( Floral_Enqueue::SCRIPT_PREFIX . 'jquery.mouse-wheel' );
//	$product_images_class[] = 'mouse-wheel-enabled';
//}

?>
	<div id="<?php echo 'product-item-images-slide-show-' . get_the_ID() ?>" class="product-item-images-slide-show">
		<div class="product-item-images-inner slick-carousel <?php floral_the_clean_html_classes( $product_images_class ); ?>" data-options="<?php echo esc_attr( json_encode( $sync_1_default_options ) ); ?>">
			<?php
			if ( ! empty( $product_images ) ) {
				echo implode( '', $product_images );
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'floral' ) ), $post->ID );
			}
			?>
		</div>
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
<?php

