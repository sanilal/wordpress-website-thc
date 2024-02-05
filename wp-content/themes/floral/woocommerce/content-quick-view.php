<?php
/**
 * Created by PhpStorm.
 * User: Sinzii Rosy
 * Date: 7/30/2016
 * Time: 12:04 PM
 */

remove_all_actions( 'woocommerce_after_single_product_summary' );
remove_all_actions( 'woocommerce_after_single_product' );

if ( !isset( $display ) ) {
    $display = 'block';
}
?>
<div class="quick-view-product product-single" data-product-id="<?php the_ID(); ?>" style="display: <?php echo esc_attr( $display ); ?>">
    <?php
    wc_get_template_part( 'content', 'single-product' );

    $_product = wc_get_product( get_the_ID() );
    if ( $_product->product_type === 'variable' ) {
        $underscore_path        = includes_url() . 'js/underscore.min.js';
        $wp_util_path           = includes_url() . 'js/wp-util.min.js';
        $_add_to_cart_variation = WC()->plugin_url() . '/assets/js/frontend/add-to-cart-variation.min.js';

        wc_get_template( 'single-product/add-to-cart/variation.php' );
        ?>
        <script type="text/javascript" src="<?php echo esc_url( $underscore_path ); ?>"></script>
        <script type="text/javascript" src="<?php echo esc_url( $wp_util_path ); ?>"></script>
        <script>
            if (typeof(wc_add_to_cart_variation_params) === 'undefined') {
                var wc_add_to_cart_variation_params = {
                    'i18n_no_matching_variations_text': '<?php echo esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'floral' ); ?>',
                    'i18n_make_a_selection_text'      : '<?php echo esc_attr__( 'Select product options before adding this product to your cart.', 'floral' ); ?>',
                    'i18n_unavailable_text'           : '<?php echo esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'floral' ); ?>'
                };
            }
        </script>
        <script type="text/javascript" src="<?php echo esc_url( $_add_to_cart_variation ); ?>"></script>
        <?php
    }
    ?>
</div>
