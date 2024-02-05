<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: other-products.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

?>
<div class="page-other-products">
    <div class="product-list"></div>
    <div class="white-board">
        <div class="load-more-product">
            <div class="loading-image">
                <img src="<?php echo esc_url( floral_theme_url() . 'includes/admin-panel/assets/images/loading.gif' ); ?>" alt="<?php echo esc_attr('Loading...', 'floral'); ?>">
            </div>
            <a href="#" data-paged="1" class="button button-primary" id="tp-load-more"><?php echo esc_html__( 'See More Products', 'floral' ); ?></a>
        </div>
    </div>
</div>