<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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


if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//
// Product archive layout
//
$archive_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $archive_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $archive_layout = floral_get_option( 'product-archive-layout', '', 'container' );
}

//
// Widget title style
//

$widget_title_style = floral_get_option( 'product-archive-widget-title-style');
if (empty($widget_title_style)) {
	$widget_title_style = 'widget-title_default';
} else {
	$widget_title_style =  'widget-title_' . $widget_title_style;
}

//
// Product archive sidebar
//
$archive_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $archive_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $archive_sidebar = floral_get_option( 'product-archive-sidebar', '', 'left' );
}

$archive_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $archive_sidebar_width, array( 'small', 'large' ) ) ) {
    $archive_sidebar_width = floral_get_option( 'product-archive-sidebar-width', '', 'small' );
}

$archive_sidebar_left  = floral_get_option( 'product-archive-sidebar-left', '', 'sidebar-1' );
$archive_sidebar_right = floral_get_option( 'product-archive-sidebar-right', '', 'sidebar-2' );

//
// Which sidebar to display
//
$display_left  = ( $archive_sidebar == 'left' || $archive_sidebar == 'both' ) && is_active_sidebar( $archive_sidebar_left );
$display_right = ( $archive_sidebar == 'right' || $archive_sidebar == 'both' ) && is_active_sidebar( $archive_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
    if ( $archive_sidebar_width == 'small' ) {
        $left_col = 3;
    } else {
        $left_col = 4;
    }
}
if ( $display_right ) {
    if ( $archive_sidebar_width == 'small' ) {
        $right_col = 3;
    } else {
        $right_col = 4;
    }
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;

//
// Archive navigation
//
$archive_paging_style = isset( $_GET['paging-type'] ) ? $_GET['paging-type'] : '';
if ( !in_array( $archive_paging_style, array( 'default', 'load-more', 'infinite-scroll' ) ) ) {
    $archive_paging_style = floral_get_option( 'product-archive-paging-type', '', 'default' );
}

//
// Archive Display Style, Blog Loop
//
//$archive_display_type = Floral_Woocommerce::get_current_product_archive_display_type();

$archive_display_type = 'standard';

$blog_loop_class = array( 'product-style-' . $archive_display_type );

if ( !$display_left && !$display_right ) {
    $blog_loop_class[] = 'no-sidebar';
}

$blog_loop_class[] = 'paging-' . $archive_paging_style;


$archive_blog_display_columns  = wc_get_loop_prop('columns', 3);
$archive_article_wrapper_class = array();
$blog_loop_class[]             = 'blog-columns-' . $archive_blog_display_columns;
switch ( $archive_blog_display_columns ) {
    case 2:
        $archive_article_wrapper_class[] = 'col-md-6 col-sm-12';
        break;
    case 3:
        $archive_article_wrapper_class[] = 'col-md-4 col-sm-6 col-xs-12';
        break;
    case 4:
        $archive_article_wrapper_class[] = 'col-md-3 col-sm-6 col-xs-12';
        break;
}

if ( $archive_display_type === 'modern' ) {
    $archive_article_wrapper_class[] = 'no-padding';
}

/**
 * Include header-shop
 */
get_header( 'shop' );

/**
 * include page title
 */
floral_get_template_part( 'page-title' );
?>
<main id="site-main-archive" class="site-main-archive product-archive">
    <div id="primary" class="content-area <?php floral_the_clean_html_classes( array($archive_layout, $widget_title_style) ); ?>">
        <div class="row clearfix">
            <?php
            if ( $display_left ): ?>
                <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                    <?php dynamic_sidebar( $archive_sidebar_left ); ?>
                </div>
            <?php endif; ?>
            <?php
            /**
             * woocommerce_before_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             * @hooked WC_Structured_Data::generate_website_data() - 30
             */
            //            do_action( 'woocommerce_before_main_content' );
            ?>
            
            <?php
            /**
             * woocommerce_archive_description hook.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action( 'woocommerce_archive_description' );
            ?>
            <div class="main-archive-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
                <?php if ( woocommerce_product_loop() ) : ?>
                    <div class="products-loop row <?php floral_the_clean_html_classes( $blog_loop_class ) ?>">
                        <?php
                        //	We don't show result count and catalog ordering if there is no product will display
                        if ( woocommerce_products_will_display() ) : ?>
                            <div class="products-before-loop-start mb-55 container-xlg">
                                <?php
                                /**
                                 * woocommerce_before_shop_loop hook.
                                 *
                                 * @hooked woocommerce_result_count - 20
                                 * @hooked woocommerce_catalog_ordering - 30
                                 */
                                do_action( 'woocommerce_before_shop_loop' );
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php woocommerce_product_loop_start(); ?>
                        
                        <?php if(wc_get_loop_prop('total')) :?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <div class="loop-item article-wrapper <?php floral_the_clean_html_classes( $archive_article_wrapper_class ); ?>">
                                    <?php
                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     *
                                     * @hooked WC_Structured_Data::generate_product_data() - 10
                                     */
                                    do_action('woocommerce_shop_loop');
    
                                    wc_get_template_part('content', 'product-' . $archive_display_type);
                                    ?>
                                </div>
                            <?php endwhile; // end of the loop. ?>
                        <?php endif; ?>
                        
                        <?php woocommerce_product_loop_end(); ?>
                        
                        <div class="products-after-loop-end">
                            <?php
                            /**
                             * woocommerce_after_shop_loop hook.
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            do_action( 'woocommerce_after_shop_loop' );
                            ?>
                        </div>
                    </div>
                <?php else:
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action('woocommerce_no_products_found');
                endif; ?>
            </div>
        
            <?php
            /**
             * woocommerce_after_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            //            do_action( 'woocommerce_after_main_content' );
            ?>
            
            <?php
            /**
             * woocommerce_sidebar hook.
             *
             * @hooked woocommerce_get_sidebar - 10
             */
            //                do_action( 'woocommerce_sidebar' );
            ?>
            <?php if ( $display_right ): ?>
                <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                    <?php dynamic_sidebar( $archive_sidebar_right ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- #primary -->
</main><!-- #main -->

<?php get_footer( 'shop' ); ?>
