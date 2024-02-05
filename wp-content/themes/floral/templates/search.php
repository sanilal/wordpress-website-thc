<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: search.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
// Search Page layout
//
$search_page_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $search_page_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $search_page_layout = floral_get_option( 'search-page-layout', '', 'container' );
}

//
// Widget title style
//

$widget_title_style = floral_get_option( 'search-page-widget-title-style');
if (empty($widget_title_style)) {
	$widget_title_style = 'widget-title_default';
} else {
	$widget_title_style =  'widget-title_' . $widget_title_style;
}

//
// Search Page sidebar
//
$search_page_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $search_page_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $search_page_sidebar = floral_get_option( 'search-page-sidebar', '', 'left' );
}

$search_page_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $search_page_sidebar_width, array( 'small', 'large' ) ) ) {
    $search_page_sidebar_width = floral_get_option( 'search-page-sidebar-width', '', 'small' );
}

$search_page_sidebar_left  = floral_get_option( 'search-page-sidebar-left', '', 'sidebar-1' );
$search_page_sidebar_right = floral_get_option( 'search-page-sidebar-right', '', 'sidebar-2' );

//
// Which sidebar to display
//
$display_left  = ( $search_page_sidebar == 'left' || $search_page_sidebar == 'both' ) && is_active_sidebar( $search_page_sidebar_left );
$display_right = ( $search_page_sidebar == 'right' || $search_page_sidebar == 'both' ) && is_active_sidebar( $search_page_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
    if ( $search_page_sidebar_width == 'small' ) {
        $left_col = 3;
    } else {
        $left_col = 4;
    }
}
if ( $display_right ) {
    if ( $search_page_sidebar_width == 'small' ) {
        $right_col = 3;
    } else {
        $right_col = 4;
    }
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;


// Blog loop class
$blog_loop_class = array( 'blog-style-classic' );
//
// search page navigation
//
$search_page_paging_type = floral_get_option( 'search-page-paging-type', '', 'default' );

if ( !$display_left && !$display_right ) {
    $blog_loop_class[] = 'no-sidebar';
}

$blog_loop_class[] = 'paging-' . $search_page_paging_type;


/**
 * Include page title
 */
floral_get_template_part( 'page-title' );
?>

<main id="main" class="site-main">
    <section id="primary" class="content-area <?php floral_the_clean_html_classes( array($search_page_layout, $widget_title_style ) ); ?>">
        <div class="row clearfix">
            <?php
            if ( $display_left ): ?>
                <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                    <?php dynamic_sidebar( $search_page_sidebar_left ); ?>
                </div>
            <?php endif; ?>
            <div class="search-page-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
                <header class="page-header">
                    <div class="__left">
                        <h3 class="page-title fw-regular s-font"><?php printf( esc_html__( 'Search Results for: "%s"', 'floral' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
                    </div>
                    <div class="__right">
                        <div class="__wrapper">
                            <?php
                            if ( have_posts() ) :
                                global $wp_query;
                                $num_results = $wp_query->found_posts;
                                ?>
                                <span class="result">
                                <?php if ( $num_results == 1 ) : ?>
                                    <?php echo esc_html__( 'One results', 'floral' ); ?>
                                <?php else : ?>
                                    <?php printf( esc_html__( 'About %s results', 'floral' ), $num_results ); ?>
                                <?php endif; ?>
                                </span>
                            <?php endif; ?>

                            <a class="floral-search-caller" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                        </div>
                    </div>

                </header><!-- .page-header -->
                <div class="posts-loop search-page-content blog-loop <?php floral_the_clean_html_classes( $blog_loop_class ); ?>">
                    <?php
                    if ( have_posts() ) : ?>
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            ?>
                            <div class="loop-item article-wrapper">
                                <?php
                                floral_get_template_part( 'parts/content', 'search' );
                                ?>
                            </div>
                            <?php

                        endwhile;
                    else :

                        floral_get_template_part( 'blog/archive/content', 'none' );

                    endif; ?>
                </div>
            </div>

            <?php if ( $display_right ): ?>
                <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                    <?php dynamic_sidebar( $search_page_sidebar_right ); ?>
                </div>
            <?php endif; ?>
        </div>
    </section><!-- #primary -->
    <?php
    // Post navigation
    Floral_Blog::the_post_navigation( $search_page_paging_type );
    ?>
</main><!-- #main -->

