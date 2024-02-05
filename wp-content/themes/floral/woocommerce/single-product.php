<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version       1.6.4
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//
// Product single layout
//
$single_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $single_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $single_layout = floral_get_meta_or_option( 'single-layout', '' );
    if ( floral_is_meta_default_value( $single_layout ) ) {
        $single_layout = floral_get_option( 'product-single-layout', '', 'container' );
    }
}

//
// Widget title style
//

$widget_title_style                  = floral_get_meta_option( 'single-widget-title-style', get_the_ID() );
$template_general_widget_title_style = floral_get_option( 'product-single-widget-title-style' );
if ( empty( $widget_title_style ) ) {
	if ( empty( $template_general_widget_title_style ) ) {
		$widget_title_style = 'widget-title_default';
	} else {
		$widget_title_style = 'widget-title_' . $template_general_widget_title_style;
	}
}
//
// Product single sidebar
//
$single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
    if ( floral_is_meta_default_value( $single_sidebar ) ) {
        $single_sidebar = floral_get_option( 'product-single-sidebar', '', 'left' );
    }
}

//sidebar width
$single_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $single_sidebar_width, array( 'small', 'large' ) ) ) {
    $single_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID() );
    if ( floral_is_meta_default_value( $single_sidebar_width ) ) {
        $single_sidebar_width = floral_get_option( 'product-single-sidebar-width', '', 'small' );
    }
}


$single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
if ( floral_is_meta_default_value( $single_sidebar_left ) ) {
    $single_sidebar_left = floral_get_option( 'product-single-sidebar-left', '', 'sidebar-1' );
}

$single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
if ( floral_is_meta_default_value( $single_sidebar_right ) ) {
    $single_sidebar_right = floral_get_option( 'product-single-sidebar-right', '', 'sidebar-2' );
}


//
// Which sidebar to display
//
$display_left  = ( $single_sidebar == 'left' || $single_sidebar == 'both' ) && is_active_sidebar( $single_sidebar_left );
$display_right = ( $single_sidebar == 'right' || $single_sidebar == 'both' ) && is_active_sidebar( $single_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
    if ( $single_sidebar_width == 'small' ) {
        $left_col = 3;
    } else {
        $left_col = 4;
    }
}
if ( $display_right ) {
    if ( $single_sidebar_width == 'small' ) {
        $right_col = 3;
    } else {
        $right_col = 4;
    }
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;

//var_dump(floral_get_current_preset());
//$meta_preset = get_post_meta( get_the_ID(), 'meta-using-preset', true );
//var_dump($meta_preset);



/**
 * Include header-shop
 */
get_header( 'shop' );

/**
 * include page title
 */
floral_get_template_part( 'page-title' );
?>
<main id="site-main-single" class="site-main-single product-single">
    <div id="primary" class="content-area <?php floral_the_clean_html_classes( array($single_layout, $widget_title_style )); ?>">
        <div class="row clearfix">
            <?php
            if ( $display_left ): ?>
                <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                    <?php dynamic_sidebar( $single_sidebar_left ); ?>
                </div>
            <?php endif; ?>

            <?php
            /**
             * woocommerce_before_main_content hook.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             */
            //            do_action( 'woocommerce_before_main_content' );
            ?>
            <div class="single-content-wrapper <?php floral_the_clean_html_classes( $center_col ); ?>">
                <div class="single-content-inner">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php wc_get_template_part( 'content', 'single-product' ); ?>

                    <?php endwhile; // end of the loop. ?>
                </div>
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
            //            do_action( 'woocommerce_sidebar' );
            ?>

            <?php if ( $display_right ): ?>
                <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                    <?php dynamic_sidebar( $single_sidebar_right ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- #primary -->
</main><!-- #main -->
<?php get_footer( 'shop' ); ?>
