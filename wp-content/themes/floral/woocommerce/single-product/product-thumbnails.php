<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version       3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$product_thumb_images = array();
if ( has_post_thumbnail() && get_the_post_thumbnail_url() !== false ) {
	$props                  = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
	$product_thumb_images[] = sprintf(
		'<a href="javascript:void(0);" class="thumb-item" title="%s">%s</a>',
//        '<div class="thumb-item">%s</div>',
		esc_attr( $props['caption'] ),
		get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ), array(
			'title' => $props['title'],
			'alt'   => $props['alt'],
		) )
	);
} else {
	if ( wc_placeholder_img_src() ) {
		$product_thumb_images[] = wc_placeholder_img( apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ) );
	} else {
		$product_thumb_images[] = Floral_Image::get_placeholder_image( apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ) );
	}
}

$attachments = $product->get_gallery_image_ids();
if ( $attachments ) {
	foreach ( $attachments as $id ) {
		if ( wp_get_attachment_image_src( $id ) !== false ) {
			$props                  = wc_get_product_attachment_props( $id );
			$product_thumb_images[] = sprintf(
				'<a href="javascript:void(0);" class="thumb-item" title="%s">%s</a>',
//                '<div class="thumb-item">%s</div>',
				esc_attr( $props['caption'] ),
				wp_get_attachment_image( $id, apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ), false, array(
					'title' => $props['title'],
					'alt'   => $props['alt'],
				) )
			);
		} else {
			if ( wc_placeholder_img_src() ) {
				$product_thumb_images[] = wc_placeholder_img( apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ) );
			} else {
				$product_thumb_images[] = Floral_Image::get_placeholder_image( apply_filters( 'single_product_thumbnail_size', 'shop_thumbnail' ) );
			}
		}
	}
}

$vertical = true;
if ( defined( 'DOING_AJAX' ) ) {
	$vertical = false;
}

$sync_2_default_options = array(
	'swipeToSlide'    => true,
	'infinite'        => false,
	'slidesToShow'    => 4,
	'slidesToScroll'  => 1,
	'speed'           => 400,
	'arrows'          => false,
	'centerPadding'   => '0px',
//    'transformsEnabled' => false,
//	'asNavFor'        => '.sync-1-of-' . get_the_ID(),
	'vertical'        => $vertical,
	'verticalSwiping' => $vertical,
	'responsive'      => array(
		array(
			'breakpoint' => 1230,
			'settings'   => array(
				'slidesToShow'    => 4,
				'vertical'        => false,
				'verticalSwiping' => false,
			)
		),
		array(
			'breakpoint' => 1020,
			'settings'   => array(
				'slidesToShow'    => 3,
				'vertical'        => false,
				'verticalSwiping' => false,
			)
		),
//		array(
//			'breakpoint' => 650,
//			'settings'   => array(
//				'slidesToShow'    => 4,
//				'vertical'        => true,
//				'verticalSwiping' => true,
//			)
//		),
//		array(
//			'breakpoint' => 521,
//			'settings'   => array(
//				'slidesToShow'    => 5,
//				'vertical'        => false,
//				'verticalSwiping' => false,
//			)
//		),
//		array(
//			'breakpoint' => 400,
//			'settings'   => array(
//				'slidesToShow'    => 4,
//				'vertical'        => false,
//				'verticalSwiping' => false,
//			)
//		)
	)
);

$product_thumb_class   = array( 'sync-2-of-' . get_the_ID() );
$product_thumb_class[] = 'sync-2';

?>
	<div class="product-thumbnails slick-carousel <?php floral_the_clean_html_classes( $product_thumb_class ); ?>" data-options="<?php echo esc_attr( json_encode( $sync_2_default_options ) ); ?>">
		<?php echo implode( '', $product_thumb_images ); ?>
	</div>
<?php
