<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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
 * @version 3.3.0
 */
if( ! defined('ABSPATH')) {
    exit;
}

?>

<div class="cart_list_wrapper">
    <?php do_action('woocommerce_before_mini_cart'); ?>
    <ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>" data-scrollbar-start="<?php echo esc_attr(floral_get_option('shop-mini-cart-scrollbar-start', '', 3)) ?>">
        
        <?php if( ! WC()->cart->is_empty()) : ?>
            
            <?php
            foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                
                if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                    $thumbnail    = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    if(empty($thumbnail)) {
                        if(wc_placeholder_img_src()) {
                            $thumbnail = wc_placeholder_img(apply_filters('single_product_thumbnail_size', 'shop_thumbnail'));
                        } else {
                            $thumbnail = Floral_Image::get_placeholder_image(apply_filters('single_product_thumbnail_size', 'shop_thumbnail'));
                        }
                    }
                    $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                    <li class="<?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <div class="product-item-wrapper">
                            <?php if(empty($product_permalink)) : ?>
                                <div class="product-item-thumbnail">
                                    <div class="thumbnail">
                                        <?php echo $thumbnail; ?>
                                    </div>
                                    <?php
                                    echo apply_filters(
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove" title="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="floral-inline-icon w9 w9-ico-close-1"></i></a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            __('Remove this item', 'floral'),
                                            esc_attr($product_id),
                                            esc_attr($cart_item_key),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                                <div class="product-item-info">
                                    <span class="product-item">
                                        <?php echo esc_html($product_name); ?>
                                    </span>
                                    <?php
                                    $cat_count = sizeof(get_the_terms($product_id, 'product_cat'));
                                    
                                    if($cat_count > 0) {
                                        echo sprintf(wc_get_product_category_list($product_id, ', ', '<span class="product-category posted_in">', '</span>'));
                                    }
                                    ?>
    
                                    <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                </div>
                            <?php else : ?>
                                <div class="product-item-thumbnail">
                                    <a class="thumbnail" href="<?php echo esc_url($product_permalink); ?>">
                                        <?php echo $thumbnail; ?>
                                    </a>
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove" title="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="floral-inline-icon w9 w9-ico-close-1"></i></a>',
                                            esc_url(WC()->cart->get_remove_url($cart_item_key)),
                                            __('Remove this item', 'floral'),
                                            esc_attr($product_id),
                                            esc_attr($cart_item_key),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                                <div class="product-item-info">
                                    <a class="product-item" href="<?php echo esc_url($product_permalink); ?>">
                                        <?php echo esc_html($product_name); ?>
                                    </a>
                                    <?php
                                    $cat_count = sizeof(get_the_terms($product_id, 'product_cat'));
                                    
                                    if($cat_count > 0) {
                                        echo sprintf(wc_get_product_category_list($product_id, ', ', '<span class="product-category posted_in">', '</span>'));
                                    }
                                    ?>
    
                                    <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        
                        <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity" data-quantity="' . esc_attr($cart_item['quantity']) . '">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); ?>
                    </li>
                    <?php
                }
            }
            ?>
        <?php else : ?>
            <li class="woocommerce-mini-cart__empty-message empty"><?php esc_html_e('No products in the cart.', 'floral'); ?></li>
        <?php endif; ?>

    </ul><!-- end product list -->
    
    <?php if( ! WC()->cart->is_empty()) : ?>

        <div class="total">
            <div class="cart-actions">
                <a class="empty-cart" href="<?php echo esc_url(Floral_Woocommerce::get_empty_cart_url()); ?>"><?php echo esc_html__('Empty cart', 'floral'); ?></a>
            </div>
            <span class="sub-total"><?php esc_html_e('Sub total', 'floral'); ?>: <strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong></span>
        </div>
        
        <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

        <p class="buttons clearfix">
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="view-cart wc-forward">
                <!--                <i class="--><?php //echo esc_attr( floral_get_option( 'shop-cart-icon' ) ); ?><!--"></i>-->
                <i class="fa fa-shopping-cart"></i>
                <span><?php esc_html_e('View Cart', 'floral'); ?></span>
            </a>
            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout wc-forward"><?php esc_html_e('Checkout', 'floral'); ?></a>
        </p>
    
    <?php endif; ?>
    <div class="block-loader-inner" style="display: none;">
        <div class="sk-spinner sk-spinner-pulse"></div>
    </div>
    
    <?php do_action('woocommerce_after_mini_cart'); ?>
</div>