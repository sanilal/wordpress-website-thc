<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: single-service.php
 * @time    : 12/14/2016 8:53 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//
// Service single layout
//
$service_single_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( ! in_array( $service_single_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
	$service_single_layout = floral_get_meta_option( 'single-layout', get_the_ID(), '', 'container' );
	if ( floral_is_meta_default_value( $service_single_layout ) ) {
		$service_single_layout = floral_get_option( 'service-single-layout' );
	}
}
//
// Widget title style
//

$widget_title_style                  = floral_get_meta_option( 'single-widget-title-style', get_the_ID() );
$template_general_widget_title_style = floral_get_option( 'service-single-widget-title-style' );
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
// Service single sidebar
//
$service_single_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( ! in_array( $service_single_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
	$service_single_sidebar = floral_get_meta_option( 'single-sidebar', get_the_ID() );
	if ( floral_is_meta_default_value( $service_single_sidebar ) ) {
		$service_single_sidebar = floral_get_option( 'service-single-sidebar' );
	}
}
$service_single_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( ! in_array( $service_single_sidebar_width, array( 'small', 'large' ) ) ) {
	$service_single_sidebar_width = floral_get_meta_option( 'single-sidebar-width', get_the_ID() );
	if ( floral_is_meta_default_value( $service_single_sidebar_width ) ) {
		$service_single_sidebar_width = floral_get_option( 'service-single-sidebar-width' );
	}
}

$service_single_sidebar_left = floral_get_meta_option( 'single-sidebar-left', get_the_ID() );
if ( floral_is_meta_default_value( $service_single_sidebar_left ) ) {
	$service_single_sidebar_left = floral_get_option( 'service-single-sidebar-left' );
}

$service_single_sidebar_right = floral_get_meta_option( 'single-sidebar-right', get_the_ID() );
if ( floral_is_meta_default_value( $service_single_sidebar_right ) ) {
	$service_single_sidebar_right = floral_get_option( 'service-single-sidebar-right' );
}

//
// Which sidebar to display
//
$display_left  = ( $service_single_sidebar == 'left' || $service_single_sidebar == 'both' ) && is_active_sidebar( $service_single_sidebar_left );
$display_right = ( $service_single_sidebar == 'right' || $service_single_sidebar == 'both' ) && is_active_sidebar( $service_single_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
	if ( $service_single_sidebar_width == 'small' ) {
		$left_col = 3;
	} else {
		$left_col = 4;
	}
}
if ( $display_right ) {
	if ( $service_single_sidebar_width == 'small' ) {
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
// Header
//

$enable_feature_image = floral_get_option('service-single-feature-image', '', 0);

//
// Meta
//
$service_single_post_meta = floral_get_option( 'service-single-post-meta' );
$enable_date              = $enable_categories = '0';
if ( is_array( $service_single_post_meta ) && ! empty( $service_single_post_meta ) ) {
	$enable_date       = $service_single_post_meta['date'];
	$enable_categories = $service_single_post_meta['categories'];
//	$enable_comments     = $service_single_post_meta['comments'];
//	$enable_social_share = $service_single_post_meta['social-share'];
}

$show_related_service = floral_get_option( 'service-single-related' );
//var_dump($show_related_service == true);
$related_amount       = $related_col = '';
if ( $show_related_service == true ) {
	$related_amount = floral_get_option( 'service-single-related-amount' );
	$related_col    = floral_get_option( 'service-single-related-col', '', 4 );
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
	<main id="site-main-single" class="site-main-single service-single">
		<div id="primary" class="content-area <?php floral_the_clean_html_classes( array($service_single_layout, $widget_title_style )); ?>">
			<div class="row clearfix">
				<?php
				if ( $display_left ): ?>
					<div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
						<?php dynamic_sidebar( $service_single_sidebar_left ); ?>
					</div>
				<?php endif; ?>

				<div class="single-content-wrapper <?php floral_the_clean_html_classes( $center_col ); ?>">
					<div class="single-content-inner">
						<?php
						while ( have_posts() ) : the_post(); ?>
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
													$categories = get_the_terms( get_the_ID(), Floral_CPT_Service::TAX_SLUG );
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
									if ( $entry_header && ( $enable_feature_image == 1 ) ) {
										?>
										<div class="entry-thumbnail-wrapper">
											<?php echo sprintf( '%s', $entry_header ); ?>
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
								 * Include related service
								 */
								if ( $show_related_service == true ) {
									include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/single-related-item.php' );
								}
								?>

							</article><!-- #post-## -->
							<?php
						endwhile; // End of the loop.
						?>
					</div>
				</div>
				
				<?php if ( $display_right ): ?>
					<div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
						<?php dynamic_sidebar( $service_single_sidebar_right ); ?>
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