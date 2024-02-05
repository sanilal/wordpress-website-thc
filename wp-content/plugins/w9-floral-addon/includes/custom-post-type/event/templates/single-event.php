<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: single-event.php
 * @time    : 4/25/2017 4:17 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//
// Event single layout
//
$event_single_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( ! in_array( $event_single_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
	$event_single_layout = floral_get_meta_option( 'single-layout', get_the_ID(), '', 'container' );
	if ( floral_is_meta_default_value( $event_single_layout ) ) {
		$event_single_layout = floral_get_option( 'event-single-layout' );
	}
}
//
// Widget title style
//

$widget_title_style                  = floral_get_meta_option( 'single-widget-title-style', get_the_ID() );
$template_general_widget_title_style = floral_get_option( 'event-single-widget-title-style' );
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
// Event single sidebar
//
$event_single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( ! in_array( $event_single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
	$event_single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
	if ( floral_is_meta_default_value( $event_single_sidebar ) ) {
		$event_single_sidebar = floral_get_option( 'event-single-sidebar' );
	}
}
$event_single_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( ! in_array( $event_single_sidebar_width, array( 'small', 'large' ) ) ) {
	$event_single_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID() );
	if ( floral_is_meta_default_value( $event_single_sidebar_width ) ) {
		$event_single_sidebar_width = floral_get_option( 'event-single-sidebar-width' );
	}
}

$event_single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
if ( floral_is_meta_default_value( $event_single_sidebar_left ) ) {
	$event_single_sidebar_left = floral_get_option( 'event-single-sidebar-left' );
}

$event_single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
if ( floral_is_meta_default_value( $event_single_sidebar_right ) ) {
	$event_single_sidebar_right = floral_get_option( 'event-single-sidebar-right' );
}

//
// Which sidebar to display
//
$display_left  = ( $event_single_sidebar == 'left' || $event_single_sidebar == 'both' ) && is_active_sidebar( $event_single_sidebar_left );
$display_right = ( $event_single_sidebar == 'right' || $event_single_sidebar == 'both' ) && is_active_sidebar( $event_single_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
	if ( $event_single_sidebar_width == 'small' ) {
		$left_col = 3;
	} else {
		$left_col = 4;
	}
}
if ( $display_right ) {
	if ( $event_single_sidebar_width == 'small' ) {
		$right_col = 3;
	} else {
		$right_col = 4;
	}
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;


////
//// Get the image size
////
//$blog_archive_content_args = array();
//if ( $display_left || $display_right ) {
//	$blog_archive_content_args['image-size'] = 'floral-blog-sidebar';
//} else {
//	$blog_archive_content_args['image-size'] = 'floral-blog-fullwidth';
//}

//
// Header
//

$enable_feature_image = floral_get_option( 'event-single-feature-image' , '', 0 );

//
// Meta
//
$event_single_post_meta = floral_get_option( 'event-single-post-meta' );
$enable_date             = $enable_comments = $enable_categories = $enable_social_share = '0';
if ( is_array( $event_single_post_meta ) && ! empty( $event_single_post_meta ) ) {
	$enable_date         = $event_single_post_meta['date'];
	$enable_comments     = $event_single_post_meta['comments'];
	$enable_categories   = $event_single_post_meta['categories'];
	$enable_social_share = $event_single_post_meta['social-share'];
}

/**
 * Include header
 */
get_header();

/**
 * Include title
 */
floral_get_template_part( 'page-title' );
?>
	<main id="site-main-single" class="site-main-single event-single">
		<div id="primary" class="content-area <?php floral_the_clean_html_classes( array($event_single_layout, $widget_title_style )); ?>">
			<div class="row clearfix">
				<?php
				if ( $display_left ): ?>
					<div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
						<?php dynamic_sidebar( $event_single_sidebar_left ); ?>
					</div>
				<?php endif; ?>

				<div class="single-content-wrapper <?php floral_the_clean_html_classes( $center_col ); ?>">
					<div class="single-content-inner">
						<?php
						while ( have_posts() ) : the_post();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-wrapper' ); ?>>
								<div class="entry-content-wrapper">
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h3>
									<?php if ( ! ( empty( $enable_date ) && empty( $enable_categories ) ) ) { ?>
										<div class="__group-meta-1">
											<ul class="list-unstyled">
												<?php if ( ! empty( $enable_date ) ): ?>
													<li class="entry-meta-date">
														<?php echo Floral_Wrap::link( get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
														?>
													</li>
												<?php endif; ?>
												<li class="__separator">/</li>
												<?php if ( ! empty( $enable_categories ) ): ?>
													<?php
													$categories = get_the_terms( get_the_ID(), Floral_CPT_Event::TAX_SLUG );
													if ( ! empty( $categories ) ) {
														?>
														<li class="entry-meta-category">
															<?php
															$list_category_links = array();
															foreach ( $categories as $category ) {
																$list_category_links[] = '<a href="' . esc_url( get_term_link( $category->term_id ) ) . '">' . $category->name . '</a>';
															}
															echo implode( ', ', $list_category_links );
															?>
														</li>
													<?php } ?>
												<?php endif; ?>
											</ul>
										</div>
									<?php }
									
									$entry_header = Floral_Blog::post_feature_format_auto();
									if ( $entry_header && ($enable_feature_image == 1) ) {
										?>
										<div class="entry-thumbnail-wrapper">
											<?php echo sprintf( '%s', $entry_header );
											$discount_tag = get_post_meta( get_the_ID(), 'meta-event-discount-tag', true );
											if ( ! empty( $discount_tag ) ) {
												?>
												<div class="__discount-tag">
													<?php echo '<span>' . $discount_tag . '</span>' ?>
													<div class="__acute-angle-1"></div>
													<div class="__acute-angle-2"></div>
												</div>
											<?php } ?>
										</div>
										<?php
									}
									?>
									<div class="entry-content">
										<?php
										the_content();
										?>
									</div>
								</div><!-- .entry-content -->
								
								<?php
								/**
								 * Include Social Share Buttons
								 */
								if ( ! empty( $enable_social_share ) ) {
									floral_get_template_part( 'blog/parts/post', 'social-share' );
								}
								
								/**
								 * Include Comments Template
								 */
								if ( ! empty( $enable_comments ) ) {
									comments_template();
								}
								?>

							</article><!-- #post-## -->
							<?php
						endwhile; // End of the loop.
						?>
					</div>
					<?php
					?>
				</div>
				
				<?php if ( $display_right ): ?>
					<div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
						<?php dynamic_sidebar( $event_single_sidebar_right ); ?>
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