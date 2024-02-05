<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: archive-portfolio.php
 * @time    : 8/26/16 12:39 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
// TP archive layout
//
$portfolio_archive_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $portfolio_archive_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $portfolio_archive_layout = array( floral_get_option( 'portfolio-archive-layout', '', 'container' ) );
}

//
// TP archive sidebar
//
$portfolio_archive_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $portfolio_archive_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $portfolio_archive_sidebar = floral_get_option( 'portfolio-archive-sidebar', '', 'left' );
}

$portfolio_archive_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $portfolio_archive_sidebar_width, array( 'small', 'large' ) ) ) {
    $portfolio_archive_sidebar_width = floral_get_option( 'portfolio-archive-sidebar-width', '', 'small' );
}

$portfolio_archive_sidebar_left  = floral_get_option( 'portfolio-archive-sidebar-left', '', 'sidebar-1' );
$portfolio_archive_sidebar_right = floral_get_option( 'portfolio-archive-sidebar-right', '', 'sidebar-2' );

//
// Which sidebar to display
//
$display_left  = ( $portfolio_archive_sidebar == 'left' || $portfolio_archive_sidebar == 'both' ) && is_active_sidebar( $portfolio_archive_sidebar_left );
$display_right = ( $portfolio_archive_sidebar == 'right' || $portfolio_archive_sidebar == 'both' ) && is_active_sidebar( $portfolio_archive_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
    if ( $portfolio_archive_sidebar_width == 'small' ) {
        $left_col = 3;
    } else {
        $left_col = 4;
    }
}
if ( $display_right ) {
    if ( $portfolio_archive_sidebar_width == 'small' ) {
        $right_col = 3;
    } else {
        $right_col = 4;
    }
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;


$archive_gutter =  isset( $_GET['parst-gutter'] ) ? $_GET['parst-gutter'] : floral_get_option( 'portfolio-archive-gutter' );

if ( $archive_gutter !== '' ) {
    $center_col .= ' floral-gutter-' . intval($archive_gutter);
}else{
    $center_col .= ' floral-gutter-30' ;
}
//
// Archive navigation
//
$archive_paging_style = isset( $_GET['parst-paging-style'] ) ? $_GET['parst-paging-style'] : floral_get_option( 'portfolio-archive-paging-style', '', 'default' );

$portfolio_loop_class   = array();
$portfolio_loop_class[] = 'paging-' . $archive_paging_style;
//
// Archive Display Style, Blog Loop
//
$archive_display_type = isset( $_GET['display-type'] ) ? $_GET['display-type'] : '';
if ( !in_array( $archive_display_type, array( 'grid', 'masonry' ) ) ) {
    $archive_display_type = floral_get_option( 'portfolio-archive-display-type', '', 'masonry' );
}

$portfolio_loop_class[] = 'blog-style-' . $archive_display_type;
if ( !$display_left && !$display_right ) {
    $portfolio_loop_class[] = 'no-sidebar';
}

$portfolio_loop_class[] = 'paging-' . $archive_paging_style;


$archive_blog_display_columns  = isset( $_GET['parst-columns'] ) ? $_GET['parst-columns'] :  floral_get_option( 'portfolio-archive-display-columns', '', '3' );
$archive_article_wrapper_class = array();
if ( in_array( $archive_display_type, array( 'masonry', 'grid' ) ) ) {
    $portfolio_loop_class[]          = 'blog-columns-' . $archive_blog_display_columns;
    $portfolio_loop_class[]          = 'row';
    switch ( $archive_blog_display_columns ) {
        case 1:
            $archive_article_wrapper_class[] = 'col-xs-12';
            break;
        case 2:
            $archive_article_wrapper_class[] = 'col-md-6 col-sm-12 col-xs-12';
            break;
        case 3:
            $archive_article_wrapper_class[] = 'col-md-4 col-sm-6 col-xs-12';
            break;
        case 4:
            $archive_article_wrapper_class[] = 'col-md-3 col-sm-6 col-xs-12';
            break;
        case 6:
            $archive_article_wrapper_class[] = 'col-xlg-2 col-md-4 col-sm-6 col-xs-12';
            break;
    }
}


//
// Portfolio post class
//
$portfolio_post_class = array('floral-portfolio-classic-default');

//
// Item Design
//
$portfolio_item_design = isset( $_GET['parst-item-type'] ) ? $_GET['parst-item-type'] : floral_get_option( 'portfolio-archive-item-type' );
$portfolio_template    = 'content-overlay';
switch ( $portfolio_item_design ) {
    case 'simple' :
        $portfolio_template     = 'content-simple';
        $portfolio_loop_class[] = 'portfolio-items-simple';
        $portfolio_post_class = array('floral-portfolio-simple-default');
        break;
    case 'overlay':
        $portfolio_template     = 'content-overlay';
        $portfolio_loop_class[] = 'portfolio-items-overlay';
        $overlay_effect = isset( $_GET['parst-animation'] ) ? $_GET['parst-animation'] : floral_get_option('portfolio-archive-item-overlay-effect');
        $portfolio_post_class = array('floral-portfolio-overlay-default floral-overlay-container');
        if($overlay_effect !== 'none'){
            $portfolio_post_class[] = $overlay_effect;
        }
        break;
    case 'classic-vertical':
        $portfolio_template     = 'content-classic';
        $portfolio_loop_class[] = 'portfolio-items-classic-vertical';
        break;
    case 'classic-horizontal':
        $portfolio_template     = 'content-classic';
        $portfolio_loop_class[] = 'portfolio-item-classic-horizontal';
        break;
    default:
        $portfolio_template     = 'content-overlay';
        $portfolio_loop_class[] = 'portfolio-items-overlay';
}
//var_dump($portfolio_item_design);

$portfolio_separator = isset( $_GET['parst-separator'] ) ? $_GET['parst-separator'] : floral_get_option('portfolio-archive-item-separator');
if($portfolio_separator === 'on' && $portfolio_template === 'content-classic'){
    $portfolio_loop_class[] = 'portfolio-items-separator';
}

$portfolio_thumbnail_ratio = isset( $_GET['parst-image-ratio'] ) ? $_GET['parst-image-ratio'] : floral_get_option('portfolio-archive-item-image-ratio');

//
//Use direct output in code to use $_GET create demo style
//
$portfolio_archive_custom_style = '';
$portfolio_overlay_color        = isset( $_GET['parst-overlay-color'] ) ? $_GET['parst-overlay-color'] : floral_get_option( 'portfolio-archive-item-color' )['rgba'];
$portfolio_archive_custom_style .= '.portfolio-items-overlay, .portfolio-items-overlay a, .portfolio-items-overlay a:hover{color: ' . $portfolio_overlay_color . ';}';
$portfolio_overlay_bg = isset( $_GET['parst-overlay-bgc'] ) ? $_GET['parst-overlay-bgc'] : floral_get_option( 'portfolio-archive-item-overlay-color' )['rgba'];
$portfolio_archive_custom_style .= '.floral-portfolio-overlay-default .entry-content .__content-inner{background-color: ' . $portfolio_overlay_bg . ';}';

/**
 * Include header
 */
get_header();
/**
 * Include title
 */
floral_get_template_part( 'page-title' );
?>
    <main id="site-main-archive portfolio-archive" class="site-main-archive portfolio-archive" role="main">
        <div id="primary" class="content-area <?php floral_the_clean_html_classes( $portfolio_archive_layout ); ?>">
            <div class="row clearfix">
                <?php
                if ( $display_left ): ?>
                    <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                        <?php dynamic_sidebar( $portfolio_archive_sidebar_left ); ?>
                    </div>
                <?php endif; ?>
                
                <div class="main-archive-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
                    <?php
                    $filter_id = '';
                    if ( have_posts() && floral_get_option('portfolio-archive-filter-enable')) {
                        $u_id        = uniqid( 'filter-' );
                        $filter_id   = sprintf( 'data-filter-id=#%s', $u_id );
                        $term        = get_terms( array(
                            'taxonomy'   => Floral_CPT_Portfolio::TAX_SLUG,
                            'hide_empty' => true,
                        ) );
                        $filter_list = array();
                        if ( !empty( $term ) ) {
                                $portfolio_filter_align = floral_get_option('portfolio-archive-filter-align', '', '');
                            ?>
                            <ul id="<?php echo esc_attr( $u_id ) ?>" class="floral-filter-list filter-style-simple list-unstyled <?php floral_the_clean_html_classes( $portfolio_filter_align ); ?>"><?php
                                ?>
                                <li class="active">
                                    <a href="#" class="filter-link" data-filter="*"><?php echo __( 'All', 'w9-floral-addon' ) ?></a>
                                </li> <?php
                                foreach ( $term as $cat ) {
                                    echo sprintf( '<li class="hide"><a href="#" class="filter-link" data-filter=".portfolio-filter-cat-%s">%s</a></li>', $cat->slug, $cat->name );
                                }
                                ?> </ul> <?php
                        }
                    }
                    ?>
                    <div <?php echo esc_attr( $filter_id ) ?> class="posts-loop portfolio-loop <?php floral_the_clean_html_classes( $portfolio_loop_class ); ?>">
                        <?php
                        //Print Internal Style
                        echo sprintf('<style>%s</style>', $portfolio_archive_custom_style);
                        
                        //Print loop
                        if ( have_posts() ) : ?>
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                $post_attributes  = array();
                                $data_filter_info = array();
                                $this_terms       = get_the_terms( get_the_ID(), Floral_CPT_Portfolio::TAX_SLUG );
                                $filter_class     = '';
                                
                                if ( is_array( $this_terms ) ) {
                                    foreach ( $this_terms as $term ) {
                                        $filter_class       = 'portfolio-filter-cat-' . $term->slug;
                                        $data_filter_info[] = $filter_class;
                                    }
                                }
                                $wrapper_class     = array_merge( $data_filter_info, $archive_article_wrapper_class );
                                $post_attributes[] = ( sprintf( 'class="loop-item portfolio-item-wrapper %s"', floral_clean_html_classes( $wrapper_class ) ) );
                                ?>
                                <div <?php echo implode( ' ', $post_attributes ) ?>>
                                    <?php
                                    require( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/' . $portfolio_template . '.php' );
                                    ?>
                                </div>
                                <?php
                            endwhile;
                        else :
                            require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/content-none.php' );
                        endif; ?>
                    </div>
                    <?php
                    // Post navigation
                    Floral_Blog::the_post_navigation( $archive_paging_style );
                    ?>
                </div>
                
                
                <?php if ( $display_right ): ?>
                    <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                        <?php dynamic_sidebar( $portfolio_archive_sidebar_right ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- #primary -->
    </main>
<?php

/**
 * Include footer
 */
get_footer();
