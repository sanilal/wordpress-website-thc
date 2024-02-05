<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: archive.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
// Blog archive layout
//
$archive_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $archive_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $archive_layout = floral_get_option( 'blog-archive-layout', '', 'container' );
}

//
// Widget title style
//

$widget_title_style = floral_get_option( 'blog-archive-widget-title-style');
if (empty($widget_title_style)) {
	$widget_title_style = 'widget-title_default';
} else {
	$widget_title_style =  'widget-title_' . $widget_title_style;
}

//
// Blog archive sidebar
//
$archive_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $archive_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $archive_sidebar = floral_get_option( 'blog-archive-sidebar', '', 'left' );
}

$archive_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $archive_sidebar_width, array( 'small', 'large' ) ) ) {
    $archive_sidebar_width = floral_get_option( 'blog-archive-sidebar-width', '', 'small' );
}

$archive_sidebar_left  = floral_get_option( 'blog-archive-sidebar-left', '', 'sidebar-1' );
$archive_sidebar_right = floral_get_option( 'blog-archive-sidebar-right', '', 'sidebar-2' );

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

$left_col   = 'col-xs-12 col-md-' . $left_col;
$right_col  = 'col-xs-12 col-md-' . $right_col;
$center_col = 'col-xs-12 col-md-' . $center_col;

//
// Archive navigation
//
$archive_paging_type = isset( $_GET['arst-paging-type'] ) ? $_GET['arst-paging-type'] : floral_get_option( 'blog-archive-paging-type', '', 'default' );
$archive_paging_args = array();
if ($archive_paging_type === 'default') {
	$archive_paging_args['style'] = isset( $_GET['arst-paging-style'] ) ? $_GET['arst-paging-style'] : floral_get_option( 'blog-archive-paging-style', '', 'style-2' );
	$archive_paging_args['align'] = isset( $_GET['arst-paging-align'] ) ? $_GET['arst-paging-align'] : floral_get_option( 'blog-archive-paging-align', '', 'center' );
}

//
// Archive Display Type/Style, Blog Loop
//
$archive_display_type = floral_get_option( 'blog-archive-display-type', '', 'wide' );
$archive_display_type = isset( $_GET['display-type'] ) ? $_GET['display-type'] : $archive_display_type;
if (empty($archive_display_type)) {
	$archive_display_type = 'wide';
}
//if ( !in_array( $archive_display_type, array( 'wide', 'grid', 'masonry' ) ) ) {
//}

$archive_display_style = '';
if ($archive_display_type === 'wide') {
	
	$archive_display_style = isset( $_GET['display-style'] ) ? $_GET['display-style'] : '';
	if ( !in_array( $archive_display_style, array( 'style-1' , 'style-2' ) ) ) {
		$archive_display_style = floral_get_option( 'blog-archive-display-style', '', 'style-1' );
		$archive_display_style = !empty($archive_display_style) ? $archive_display_style : 'style-1';
	}
}

$blog_archive_content_args['display-type'] = $archive_display_type;
$blog_archive_content_args['display-style'] = $archive_display_style;

$blog_loop_class = array( 'blog-type-' . $archive_display_type );
$blog_loop_class[] = !empty($archive_display_style) ? 'blog-' . $archive_display_style : '';
if ( !$display_left && !$display_right ) {
    $blog_loop_class[] = 'no-sidebar';
}

$blog_loop_class[] = 'paging-' . $archive_paging_type;
//
//$blog_item_separator = isset( $_GET['arst-item-separator'] ) ? $_GET['arst-item-separator'] : floral_get_option( 'blog-archive-item-separator' );
//if ( $blog_item_separator === 'on' ) {
//    $blog_loop_class[] = 'blog-item-separator';
//}
//
//$blog_item_bordered = isset( $_GET['arst-item-bordered'] ) ? $_GET['arst-item-bordered'] : floral_get_option( 'blog-archive-item-bordered' );
//if ( $blog_item_bordered === 'on' ) {
//    $blog_loop_class[] = 'blog-item-bordered';
//}

//$blog_item_squared_date = isset( $_GET['arst-item-square-date'] ) ? $_GET['arst-item-square-date'] : floral_get_option( 'blog-archive-item-squared-date' );
//if ( $blog_item_squared_date === 'on' && $blog_item_bordered === 'off' ) {
//    $blog_loop_class[] = 'blog-item-squared-date';
//}

$archive_blog_display_columns  = isset( $_GET['arst-columns'] ) ? $_GET['arst-columns'] : floral_get_option( 'blog-archive-display-columns', '', '3' );
$archive_article_wrapper_class = array();
if ( in_array( $archive_display_type, array( 'masonry', 'grid' ) ) ) {
    $blog_loop_class[] = 'blog-columns-' . $archive_blog_display_columns;
    $blog_loop_class[] = 'row';
    switch ( $archive_blog_display_columns ) {
        case 2:
            $archive_article_wrapper_class[] = 'col-md-6 col-xs-12';
            break;
        case 3:
            $archive_article_wrapper_class[] = 'col-md-4 col-sm-6 col-xs-12';
            break;
        case 4:
            $archive_article_wrapper_class[] = 'col-md-3 col-sm-6 col-xs-12';
            break;
    }
}

//
// Get Item Type
//
//$archive_item_type = isset( $_GET['arst-item-type'] ) ? $_GET['arst-item-type'] :  floral_get_option( 'blog-archive-item-type' );
//if ( !empty( $archive_item_type ) ) {
//    $blog_archive_content_args['post-item-layout'] = $archive_item_type;
//} else {
//    $blog_archive_content_args['post-item-layout'] = 'floral-blog-item-vertical';
//}
//
//Header enable
//
$enable_item_header = isset( $_GET['arst-item-header'] ) ? $_GET['arst-item-header'] :  floral_get_option('blog-archive-item-header');
if($enable_item_header == 0){
    $blog_archive_content_args['enable-header'] = false;
	$blog_loop_class[] = 'no-header';
}else{
    $blog_archive_content_args['enable-header'] = true;
}

//
// Get the image size
//
$archive_item_image_size = Floral_Blog::calculate_feature_imagesize_by_layout( $archive_layout, $archive_sidebar );
if ( !empty( $archive_item_image_size ) ) {
    $blog_archive_content_args['image-size'] = $archive_item_image_size;
} else {
    $blog_archive_content_args['image-size'] = 'floral_1170';
}
//
// Get the image ratio
//
$archive_item_image_ratio = floral_get_option( 'blog-archive-item-image-ratio' );
if ( !empty( $archive_item_image_ratio ) ) {
	$blog_archive_content_args['image-ratio'] = $archive_item_image_ratio;
} else {
	$blog_archive_content_args['image-ratio'] = 'original';
}

//
// Get Image Action
//
$archive_item_image_action = floral_get_option( 'blog-archive-item-image-action' );
if ( !empty( $archive_item_image_action ) ) {
    $blog_archive_content_args['image-action'] = $archive_item_image_action;
} else {
    $blog_archive_content_args['image-action'] = 'none';
}

$blog_archive_content_args['post-meta'] = floral_get_option( 'blog-archive-post-meta' );


/**
 * include page title
 */
floral_get_template_part( 'page-title' );
?>
<main id="site-main-archive" class="site-main-archive">
    <div id="primary" class="content-area <?php floral_the_clean_html_classes( array($archive_layout, $widget_title_style) ); ?>">
        <div class="row clearfix">
            <?php
            if ( $display_left ): ?>
                <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                    <?php dynamic_sidebar( $archive_sidebar_left ); ?>
                </div>
            <?php endif; ?>
            
            <div class="main-archive-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
                <div class="posts-loop blog-loop <?php floral_the_clean_html_classes( $blog_loop_class ) ?>">
                    <?php
                    if ( have_posts() ) :
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            ?>
                            <div class="loop-item article-wrapper <?php floral_the_clean_html_classes( $archive_article_wrapper_class ); ?>">
                                <?php
                                floral_get_template_part( 'blog/archive/content', get_post_format(), $blog_archive_content_args );
                                ?>
                            </div>
                            <?php
                        endwhile;
                    else :
                        floral_get_template_part( 'blog/archive/content', 'none' );
                    endif; ?>
                </div>
                <?php
                // Post navigation
                Floral_Blog::the_post_navigation( $archive_paging_type, $archive_paging_args );
                ?>
            </div>
            
            <?php if ( $display_right ): ?>
                <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                    <?php dynamic_sidebar( $archive_sidebar_right ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- #primary -->
</main><!-- #main -->
