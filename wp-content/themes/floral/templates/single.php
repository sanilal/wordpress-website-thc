<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: single.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
// Blog single layout
//
$single_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( !in_array( $single_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
    $single_layout = floral_get_meta_option( 'single-layout', get_the_ID() );
    if ( floral_is_meta_default_value( $single_layout ) ) {
        $single_layout = floral_get_option( 'blog-single-layout', '', 'container' );
    }
}
//
// Widget title style
//

$widget_title_style                  = floral_get_meta_option( 'single-widget-title-style', get_the_ID() );
$template_general_widget_title_style = floral_get_option( 'blog-single-widget-title-style' );
if ( empty( $widget_title_style ) ) {
	if ( empty( $template_general_widget_title_style ) ) {
		$widget_title_style = 'widget-title_default';
	} else {
		$widget_title_style = 'widget-title_' . $template_general_widget_title_style;
	}
} else {
	$widget_title_style = 'widget-title_' . $widget_title_style;
}
// Blog single sidebar
//
$single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( !in_array( $single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
    $single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
    if ( floral_is_meta_default_value( $single_sidebar ) ) {
        $single_sidebar = floral_get_option( 'blog-single-sidebar', '', 'left' );
    }
}

//sidebar width
$single_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( !in_array( $single_sidebar_width, array( 'small', 'large' ) ) ) {
    $single_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID() );
    if ( floral_is_meta_default_value( $single_sidebar_width ) ) {
        $single_sidebar_width = floral_get_option( 'blog-single-sidebar-width', '', 'small' );
    }
}


$single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
if ( floral_is_meta_default_value( $single_sidebar_left ) ) {
    $single_sidebar_left = floral_get_option( 'blog-single-sidebar-left', '', 'sidebar-1' );
}

$single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
if ( floral_is_meta_default_value( $single_sidebar_right ) ) {
    $single_sidebar_right = floral_get_option( 'blog-single-sidebar-right', '', 'sidebar-2' );
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


//
// Get the image size
//

$single_item_image_size = Floral_Blog::calculate_feature_imagesize_by_layout($single_layout, $single_sidebar);
if( ! empty($single_item_image_size)) {
	$blog_single_content_args['image-size'] = $single_item_image_size;
} else {
	$blog_single_content_args['image-size'] = 'floral_1170';
}

$blog_single_content_args['post-meta'] = floral_get_option( 'blog-single-post-meta' );

/**
 * Page title
 */
floral_get_template_part( 'page-title' );
?>
<main id="site-main-single" class="site-main-single">
    <div id="primary" class="content-area <?php floral_the_clean_html_classes( array($single_layout, $widget_title_style )); ?>">
        <div class="row clearfix">
            <?php
            if ( $display_left ): ?>
                <div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
                    <?php dynamic_sidebar( $single_sidebar_left ); ?>
                </div>
            <?php endif; ?>
            
            <div class="single-content-wrapper <?php floral_the_clean_html_classes( $center_col ); ?>">
                <div class="single-content-inner">
                    <?php
                    while ( have_posts() ) : the_post();
                        
                        floral_get_template_part( 'blog/single/content', get_post_format(), $blog_single_content_args );
                    
                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>
            
            <?php if ( $display_right ): ?>
                <div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
                    <?php dynamic_sidebar( $single_sidebar_right ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div><!-- #primary -->
</main><!-- #main -->
