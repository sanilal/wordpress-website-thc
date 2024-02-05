<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: woocommerce.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Override default woocommerce function
 */

if ( !function_exists( 'woocommerce_template_loop_product_title' ) ) {

    /**
     * Show the product title in the product loop. By default this is an H3.
     */
    function woocommerce_template_loop_product_title() {
        echo '<h3 class="product-title fw-semibold fz-14">' . get_the_title() . '</h3>';
    }
}


if ( !function_exists( 'woocommerce_get_product_thumbnail' ) ) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @subpackage    Loop
     *
     * @param string $size        (default: 'shop_catalog')
     * @param int    $deprecated1 Deprecated since WooCommerce 2.0 (default: 0)
     * @param int    $deprecated2 Deprecated since WooCommerce 2.0 (default: 0)
     *
     * @return string
     */
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
        global $post;
        $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

        if ( has_post_thumbnail() && get_the_post_thumbnail_url() !== false ) {
            $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );

            return get_the_post_thumbnail( $post->ID, $image_size, array(
                'title' => $props['title'],
                'alt'   => $props['alt'],
            ) );
        } elseif ( wc_placeholder_img_src() ) {
            return wc_placeholder_img( $image_size );
        } else {
            return Floral_Image::get_placeholder_image( $image_size );
        }
    }
}