<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: single-portfolio.php
 * @time    : 8/26/16 12:39 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
// Portfolio single layout
//
$portfolio_single_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $portfolio_single_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $portfolio_single_layout = floral_get_meta_option( 'single-layout', get_the_ID(), '', 'container' );
    if ( floral_is_meta_default_value( $portfolio_single_layout ) ) {
        $portfolio_single_layout = floral_get_option( 'portfolio-single-layout' );
    }
}
//
// Portfolio single sidebar
//
$portfolio_single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $portfolio_single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $portfolio_single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
    if ( floral_is_meta_default_value( $portfolio_single_sidebar ) ) {
        $portfolio_single_sidebar = floral_get_option( 'portfolio-single-sidebar' );
    }
}
$portfolio_single_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $portfolio_single_sidebar_width, array( 'small', 'large' ) ) ) {
    $portfolio_single_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID() );
    if ( floral_is_meta_default_value( $portfolio_single_sidebar_width ) ) {
        $portfolio_single_sidebar_width = floral_get_option( 'portfolio-single-sidebar-width' );
    }
}

$portfolio_single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
if ( floral_is_meta_default_value( $portfolio_single_sidebar_left ) ) {
    $portfolio_single_sidebar_left = floral_get_option( 'portfolio-single-sidebar-left' );
}

$portfolio_single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
if ( floral_is_meta_default_value( $portfolio_single_sidebar_right ) ) {
    $portfolio_single_sidebar_right = floral_get_option( 'portfolio-single-sidebar-right' );
}

//
// Which sidebar to display
//
$display_left  = ( $portfolio_single_sidebar == 'left' || $portfolio_single_sidebar == 'both' ) && is_active_sidebar( $portfolio_single_sidebar_left );
$display_right = ( $portfolio_single_sidebar == 'right' || $portfolio_single_sidebar == 'both' ) && is_active_sidebar( $portfolio_single_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
    if ( $portfolio_single_sidebar_width == 'small' ) {
        $left_col = 3;
    } else {
        $left_col = 4;
    }
}
if ( $display_right ) {
    if ( $portfolio_single_sidebar_width == 'small' ) {
        $right_col = 3;
    } else {
        $right_col = 4;
    }
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;


/**
 * Include header
 */
get_header();

/**
 * Include title
 */
floral_get_template_part( 'page-title' );
?>
    <main id="site-main-single" class="site-main-single portfolio-single">
        <div id="primary" class="content-area <?php floral_the_clean_html_classes( $portfolio_single_layout ); ?>">
            <div class="row clearfix">
                <?php
                if ( $display_left ): ?>
                    <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                        <?php dynamic_sidebar( $portfolio_single_sidebar_left ); ?>
                    </div>
                <?php endif; ?>
                
                <div class="single-content-wrapper <?php floral_the_clean_html_classes( $center_col ); ?>">
                    <div class="single-content-inner">
                        <?php
                            while ( have_posts() ) : the_post();
                                the_content();
                             endwhile; // End of the loop.
                        ?>
                    </div>
                    <?php
                        $nav_enabled = floral_get_option('portfolio-single-navigator-enabled');
                        if($nav_enabled){
                            require( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/portfolio-nav.php' );
                        }
                    ?>
                </div>
                
                <?php if ( $display_right ): ?>
                    <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                        <?php dynamic_sidebar( $portfolio_single_sidebar_right ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- #primary -->
    </main><!-- #main -->

<?php

/**
 * Include footer
 */
get_footer();