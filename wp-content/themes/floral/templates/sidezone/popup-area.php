<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: popup-area.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


?>
<div class="floral-popup-area hide">
    <?php
    $popup_list = floral_get_popup_list();
    if ( is_array( $popup_list ) && !empty( $popup_list ) ) {
        foreach ( $popup_list as $popup ) {
            if ( $popup['type'] === 'sidebar' ) {
                ?>
                <div class="floral-popup floral-popup-sidebar" data-popup-type="sidebar" data-popup-content="<?php echo esc_html( $popup['content'] ) ?>" id="<?php echo esc_attr( $popup['id'] ) ?>">
                    <div class="sidebar floral-sidebar-popup">
                        <?php dynamic_sidebar( $popup['content'] ); ?>
                    </div>
                </div>
                <?php
            } elseif ( $popup['type'] === 'content-template' ) {
                ?>
                <div class="floral-popup floral-popup-content-template" data-popup-type="content-template" data-popup-content="<?php echo esc_html( $popup['content'] ) ?>" id="<?php echo esc_attr( $popup['id'] ) ?>">
                    <div class="floral-content-template-popup">
                        <?php echo floral_get_post_content_by_name( $popup['content'], 'content-template' ) ?>
                    </div>
                </div>
                <?php
            } elseif ( floral_is_woocommerce_active() && function_exists( 'wc_get_template_part' ) ) {
                if ( $popup['type'] === 'woo-login' ) {
                    ?>
                    <div class="floral-popup floral-popup-woo-login" data-popup-type="woo-login" data-popup-content="<?php echo esc_html( $popup['content'] ) ?>" id="<?php echo esc_attr( $popup['id'] ) ?>">
                        <?php wc_get_template_part( 'myaccount/form', 'login' ); ?>
                    </div>
                    <?php
                } elseif ( $popup['type'] === 'woo-register' && get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
                    ?>
                    <div class="floral-popup floral-popup-woo-register" data-popup-type="woo-register" data-popup-content="<?php echo esc_html( $popup['content'] ) ?>" id="<?php echo esc_attr( $popup['id'] ) ?>">
                        <?php wc_get_template_part( 'myaccount/form', 'login' ); ?>
                    </div>
                    <?php
                }
            }
        }
    }
    $nav_result_type = floral_get_option( 'nav-search-result-type' );
    ?>
    <div class="floral-popup floral-popup-search <?php echo ( $nav_result_type == 'ajax' ) ? 'search-type-ajax' : '' ?>" id="floral-search-popup">
        <div class="container" id="floral-ajax-search-container">
            <div class="floral-search-form-wrapper">
                <?php get_search_form(); ?>
                <button title="Close (Esc)" type="button" class="mfp-close"><i class="w9 w9-ico-close"></i></button>
            </div>
            <div class="floral-ajax-search-content">
                <div class="__result"></div>
                <div class="__loading">
                    <div class="cell-vertical-wrapper">
                        <div class="cell-middle text-center">
                            <?php echo esc_html__( 'Loading...', 'floral' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

