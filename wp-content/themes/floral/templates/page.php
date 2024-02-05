<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: page.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//
// Page layout
//
$page_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( ! in_array( $page_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
	$page_layout = floral_get_meta_option( 'single-layout', get_the_ID(), '', '' );
	if ( floral_is_meta_default_value( $page_layout ) ) {
		$page_layout = floral_get_option( 'page-layout', '', 'container' );
	}
}
//
// Widget title style
//

$widget_title_style                  = floral_get_meta_option( 'single-widget-title-style', get_the_ID() );
$template_general_widget_title_style = floral_get_option( 'page-widget-title-style' );
if ( empty( $widget_title_style ) ) {
	if ( empty( $template_general_widget_title_style ) ) {
		$widget_title_style = 'widget-title_default';
	} else {
		$widget_title_style = 'widget-title_' . $template_general_widget_title_style;
	}
} else {
	$widget_title_style = 'widget-title_' . $widget_title_style;
}

//
// Page sidebar
//
$page_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( ! in_array( $page_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
	$page_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID(), '', '' );
	if ( floral_is_meta_default_value( $page_sidebar ) ) {
		$page_sidebar = floral_get_option( 'page-sidebar', '', 'left' );
	}
}

$page_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( ! in_array( $page_sidebar_width, array( 'small', 'large' ) ) ) {
	$page_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID(), '', '' );
	if ( floral_is_meta_default_value( $page_sidebar_width ) ) {
		$page_sidebar_width = floral_get_option( 'page-sidebar-width', '', 'small' );
	}
}

$page_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID(), '', '' );
if ( floral_is_meta_default_value( $page_sidebar_left ) ) {
	$page_sidebar_left = floral_get_option( 'page-sidebar-left', '', 'sidebar-1' );
}

$page_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID(), '', '' );
if ( floral_is_meta_default_value( $page_sidebar_right ) ) {
	$page_sidebar_right = floral_get_option( 'page-sidebar-right', '', 'sidebar-2' );
}

//
// Which sidebar to display
//
$display_left  = ( $page_sidebar == 'left' || $page_sidebar == 'both' ) && is_active_sidebar( $page_sidebar_left );
$display_right = ( $page_sidebar == 'right' || $page_sidebar == 'both' ) && is_active_sidebar( $page_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
	if ( $page_sidebar_width == 'small' ) {
		$left_col = 3;
	} else {
		$left_col = 4;
	}
}
if ( $display_right ) {
	if ( $page_sidebar_width == 'small' ) {
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
 * Include page title
 */
floral_get_template_part( 'page-title' );
?>
<main id="site-main-page" class="site-main-page">
	<div id="primary" class="content-area <?php floral_the_clean_html_classes( array($page_layout, $widget_title_style )); ?>">
		<div class="row clearfix">
			<?php
			if ( $display_left ): ?>
				<div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
					<?php dynamic_sidebar( $page_sidebar_left ); ?>
				</div>
			<?php endif; ?>

			<div class="main-page-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
				<div class="page-content">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						floral_get_template_part( 'parts/content', 'page' );
					endwhile;
					?>
				</div>
				<?php
				//                 If comments are open or we have at least one comment, load up the comment template.
				$page_comment = floral_get_meta_or_option( 'page-comment' );
				if ( ! empty( $page_comment ) ) :
					comments_template();
				endif;
				?>
			</div>
			
			<?php if ( $display_right ): ?>
				<div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
					<?php dynamic_sidebar( $page_sidebar_right ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div><!-- #primary -->
</main><!-- #main -->
