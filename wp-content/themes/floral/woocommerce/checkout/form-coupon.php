<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
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

if( ! wc_coupons_enabled() || ! empty(WC()->cart->applied_coupons)) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="coupon-form-wrapper">
	<?php
	if(empty(WC()->cart->applied_coupons)) { ?>
			<div class="woocommerce-form-coupon-toggle">
		  <?php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', __('Have a coupon?', 'floral') . ' <a href="#" class="showcoupon">' . __('Click here to enter your code', 'floral') . '</a>'), 'notice'); ?>
			</div>
	<?php } ?>
	<form class="checkout_coupon" method="post" style="display:none">
		
		<p><?php esc_html_e('If you have a coupon code, please apply it below.', 'floral'); ?></p>

        <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'floral' ); ?>" id="coupon_code" value="" />
        </p>

		<p class="form-row form-row-last">
			<button type="submit" class="button" name="apply_coupon"
							value="<?php esc_attr_e('Apply', 'floral'); ?>"><?php esc_html_e('Apply', 'floral'); ?></button>
		</p>

        <div class="clear"></div>
    </form>
</div>