<?php
/**
 * Created by PhpStorm.
 * User: Sinzii Rosy
 * Date: 7/29/2016
 * Time: 12:30 PM
 */

$shop_quick_view = floral_get_option( 'shop-quick-view' );
if ( empty( $shop_quick_view ) ) {
    return;
}
?>
<a class="quick-view-btn" href="<?php the_permalink( get_the_ID() ); ?>" data-toggle="tooltip" data-placement="right" data-product-id="<?php the_ID(); ?>" title="<?php echo esc_html__( 'Quick view', 'floral' ); ?>"><i class="floral-inline-icon fa fa-expand"></i></a>
