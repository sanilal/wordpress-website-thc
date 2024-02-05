<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: archive-service.php
 * @time    : 12/14/2016 8:52 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
//
// TP archive layout
//
$service_archive_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( ! in_array( $service_archive_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
	$service_archive_layout = floral_get_option( 'service-archive-layout', '', 'container' );
}

//
// Widget title style
//

$widget_title_style = floral_get_option( 'service-archive-widget-title-style');
if (empty($widget_title_style)) {
	$widget_title_style = 'widget-title_default';
} else {
	$widget_title_style =  'widget-title_' . $widget_title_style;
}

//
// TP archive sidebar
//
$service_archive_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( ! in_array( $service_archive_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
	$service_archive_sidebar = floral_get_option( 'service-archive-sidebar', '', 'left' );
}

$service_archive_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( ! in_array( $service_archive_sidebar_width, array( 'small', 'large' ) ) ) {
	$service_archive_sidebar_width = floral_get_option( 'service-archive-sidebar-width', '', 'small' );
}

$service_archive_sidebar_left  = floral_get_option( 'service-archive-sidebar-left', '', 'sidebar-1' );
$service_archive_sidebar_right = floral_get_option( 'service-archive-sidebar-right', '', 'sidebar-2' );

//
// Which sidebar to display
//
$display_left  = ( $service_archive_sidebar == 'left' || $service_archive_sidebar == 'both' ) && is_active_sidebar( $service_archive_sidebar_left );
$display_right = ( $service_archive_sidebar == 'right' || $service_archive_sidebar == 'both' ) && is_active_sidebar( $service_archive_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
	if ( $service_archive_sidebar_width == 'small' ) {
		$left_col = 3;
	} else {
		$left_col = 4;
	}
}
if ( $display_right ) {
	if ( $service_archive_sidebar_width == 'small' ) {
		$right_col = 3;
	} else {
		$right_col = 4;
	}
}
$center_col -= ( $left_col + $right_col );

$left_col   = 'col-md-' . $left_col;
$right_col  = 'col-md-' . $right_col;
$center_col = 'col-md-' . $center_col;


$archive_gutter = isset( $_GET['parst-gutter'] ) ? $_GET['parst-gutter'] : floral_get_option( 'service-archive-gutter' );

if ( $archive_gutter !== '' ) {
	$center_col .= ' floral-gutter-' . intval( $archive_gutter );
} else {
	$center_col .= ' floral-gutter-30';
}
//
// Archive navigation
//
$archive_paging_style = isset( $_GET['parst-paging-type'] ) ? $_GET['parst-paging-type'] : floral_get_option( 'service-archive-paging-type', '', 'default' );

$service_loop_class   = array();
$service_loop_class[] = 'paging-' . $archive_paging_style;
//
// Archive Display Style, Blog Loop
//
$archive_display_type = isset( $_GET['display-type'] ) ? $_GET['display-type'] : '';
if ( ! in_array( $archive_display_type, array( 'grid', 'masonry' ) ) ) {
	$archive_display_type = floral_get_option( 'service-archive-display-type', '', 'masonry' );
}

$service_loop_class[] = 'blog-type-' . $archive_display_type;
if ( ! $display_left && ! $display_right ) {
	$service_loop_class[] = 'no-sidebar';
}

//$service_loop_class[] = 'paging-' . $archive_paging_style;


$archive_blog_display_columns  = isset( $_GET['parst-columns'] ) ? $_GET['parst-columns'] : floral_get_option( 'service-archive-display-columns', '', '3' );
$archive_article_wrapper_class = array();
if ( in_array( $archive_display_type, array( 'masonry', 'grid' ) ) ) {
	$service_loop_class[] = 'blog-columns-' . $archive_blog_display_columns;
	$service_loop_class[] = 'row';
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
// Service post class
//
$service_post_class = array( 'floral-service-classic-default' );


$service_thumbnail_ratio = isset( $_GET['parst-image-ratio'] ) ? $_GET['parst-image-ratio'] : floral_get_option( 'service-archive-item-image-ratio' );

//
// Booking btn
//

$booking_page_url = '#';
$booking_page  = floral_get_option( 'service-booking-page' );
if ( ! empty( $booking_page ) ) {
	$booking_page_url = esc_url($booking_page );
}

$services_show_booking_btn = floral_get_option( 'service-show-booking-btn' );
$services_booking_btn_tx   = floral_get_option( 'service-booking-btn-tx', '', 'BOOK NOW' );

/**
 * Include header
 */
get_header();
/**
 * Include title
 */
floral_get_template_part( 'page-title' );
?>
	<main id="site-main-archive service-archive" class="site-main-archive service-archive" role="main">
		<div id="primary" class="content-area <?php floral_the_clean_html_classes( array($service_archive_layout, $widget_title_style )); ?>">
			<div class="row clearfix">
				<?php
				if ( $display_left ): ?>
					<div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
						<?php dynamic_sidebar( $service_archive_sidebar_left ); ?>
					</div>
				<?php endif; ?>

				<div class="main-archive-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
					<?php
					$filter_id = '';
					if ( have_posts() && floral_get_option( 'service-archive-filter-enable' ) ) {
						$u_id        = uniqid( 'filter-' );
						$filter_id   = sprintf( 'data-filter-id=#%s', $u_id );
						$term        = get_terms( array(
							'taxonomy'   => Floral_CPT_Service::TAX_SLUG,
							'hide_empty' => true,
						) );
						$filter_list = array();
						if ( ! empty( $term ) ) {
							$service_filter_align = floral_get_option( 'service-archive-filter-align', '', '' );
							?>
							<ul id="<?php echo esc_attr( $u_id ) ?>" class="floral-filter-list filter-style-simple list-unstyled <?php floral_the_clean_html_classes( $service_filter_align ); ?>"><?php
								?>
								<li class="active">
									<a href="#" class="filter-link" data-filter="*"><?php echo __( 'All', 'w9-floral-addon' ) ?></a>
								</li> <?php
								foreach ( $term as $cat ) {
									echo sprintf( '<li class="hide"><a href="#" class="filter-link" data-filter=".service-filter-cat-%s">%s</a></li>', $cat->slug, $cat->name );
								}
								?> </ul> <?php
						}
					}
					?>
					<div <?php echo esc_attr( $filter_id ) ?> class="posts-loop service-loop <?php floral_the_clean_html_classes( $service_loop_class ); ?>">
						<?php
						//Print Internal Style
						
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
								$this_terms       = get_the_terms( get_the_ID(), Floral_CPT_Service::TAX_SLUG );
								$filter_class     = '';
								
								if ( is_array( $this_terms ) ) {
									foreach ( $this_terms as $term ) {
										$filter_class       = 'service-filter-cat-' . $term->slug;
										$data_filter_info[] = $filter_class;
									}
								}
								$wrapper_class     = array_merge( $data_filter_info, $archive_article_wrapper_class );
								$post_attributes[] = ( sprintf( 'class="loop-item service-item-wrapper %s"', floral_clean_html_classes( $wrapper_class ) ) );
								?>
								<div <?php echo implode( ' ', $post_attributes ) ?>>
									<article id="post-<?php the_ID(); ?>" <?php post_class( floral_clean_html_classes( $service_post_class ) ); ?>>
										<div class="floral-service-post-item-inner">
											<div class="entry-header">
												<div class="__thumbnail">
													<?php if ( empty( $services_show_booking_btn ) ): ?>
													<a href="<?php the_permalink( $item_id ); ?>">
														<?php endif; ?>
														<div class="__overlay">
															<?php if ( empty( $services_show_booking_btn ) ): ?>
																<i class="flor-ico flor-ico-icon-link"></i>
															<?php endif; ?>
														</div>
														<?php
														$thumbnail_id   = get_post_thumbnail_id();
														$thumbnail_args = array();
														if ( isset( $service_thumbnail_ratio ) ) {
															$thumbnail_args['ratio'] = $service_thumbnail_ratio;
														}
														$post_thumbnail = Floral_Image::get_image( $thumbnail_id, 'floral_1170', $thumbnail_args );
														if ( empty( $post_thumbnail ) ) {
															$post_thumbnail = Floral_Image::get_placeholder_image( '1170x' . ( ( isset( $service_thumbnail_ratio ) && floatval( $service_thumbnail_ratio ) !== 0 ) ? 1170 * $service_thumbnail_ratio : 700 ) );
														}
														echo $post_thumbnail;
														?>
														<?php if ( empty( $services_show_booking_btn ) ): ?>
													</a>
												<?php endif; ?>
												</div>
												<?php if ( $services_show_booking_btn ): ?>
													<div class="__booking-btn">
														<a href="<?php echo $booking_page_url; ?>" class="__btn"><?php echo esc_html( $services_booking_btn_tx ); ?></a>
													</div>
												<?php endif; ?>
											</div>
											<div class="entry-content text-link-color">
												<div class="entry-content-inner">
													<h3 class="__title">
														<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a>
													</h3>
													<div class="__time">
														<?php echo '<span>' . get_post_meta( get_the_ID(), 'meta-service-time', true ) . '</span>' ?>
													</div>
													<div class="__price">
														<?php echo '<span>' . get_post_meta( get_the_ID(), 'meta-service-price', true ) . '</span>' ?>
													</div>
												</div>
											</div>
									</article>
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
						<?php dynamic_sidebar( $service_archive_sidebar_right ); ?>
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