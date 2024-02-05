<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: archive-event.php
 * @time    : 4/25/2017 4:16 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//
// TP archive layout
//
$event_archive_layout = isset( $_GET['layout'] ) ? $_GET['layout'] : '';
if ( ! in_array( $event_archive_layout, array( 'fullwidth', 'container', 'container-xlg', 'container-fluid' ) ) ) {
	$event_archive_layout = floral_get_option( 'event-archive-layout', '', 'container' );
}

//
// Widget title style
//

$widget_title_style = floral_get_option( 'event-archive-widget-title-style');
if (empty($widget_title_style)) {
	$widget_title_style = 'widget-title_default';
} else {
	$widget_title_style =  'widget-title_' . $widget_title_style;
}

//
// TP archive sidebar
//
$event_archive_sidebar = isset( $_GET['sidebar'] ) ? $_GET['sidebar'] : '';
if ( ! in_array( $event_archive_sidebar, array( 'left', 'right', 'both', 'none' ) ) ) {
	$event_archive_sidebar = floral_get_option( 'event-archive-sidebar', '', 'left' );
}

$event_archive_sidebar_width = isset( $_GET['sidebar-width'] ) ? $_GET['sidebar-width'] : '';
if ( ! in_array( $event_archive_sidebar_width, array( 'small', 'large' ) ) ) {
	$event_archive_sidebar_width = floral_get_option( 'event-archive-sidebar-width', '', 'small' );
}

$event_archive_sidebar_left  = floral_get_option( 'event-archive-sidebar-left', '', 'sidebar-1' );
$event_archive_sidebar_right = floral_get_option( 'event-archive-sidebar-right', '', 'sidebar-2' );

//
// Which sidebar to display
//
$display_left  = ( $event_archive_sidebar == 'left' || $event_archive_sidebar == 'both' ) && is_active_sidebar( $event_archive_sidebar_left );
$display_right = ( $event_archive_sidebar == 'right' || $event_archive_sidebar == 'both' ) && is_active_sidebar( $event_archive_sidebar_right );

//
// Calculate sidebar columns
//
$left_col   = 0;
$right_col  = 0;
$center_col = 12;
if ( $display_left ) {
	if ( $event_archive_sidebar_width == 'small' ) {
		$left_col = 3;
	} else {
		$left_col = 4;
	}
}
if ( $display_right ) {
	if ( $event_archive_sidebar_width == 'small' ) {
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
// Archive navigation
//
$archive_paging_type = isset( $_GET['parst-paging-type'] ) ? $_GET['parst-paging-type'] : floral_get_option( 'event-archive-paging-type', '', 'default' );
$archive_paging_args = array();
if ( $archive_paging_type === 'default' ) {
	$archive_paging_args['style'] = isset( $_GET['arst-paging-style'] ) ? $_GET['arst-paging-style'] : floral_get_option( 'event-archive-paging-style', '', 'style-2' );
	$archive_paging_args['align'] = isset( $_GET['arst-paging-align'] ) ? $_GET['arst-paging-align'] : floral_get_option( 'event-archive-paging-align', '', 'center' );
}

$event_loop_class   = array();
$event_loop_class[] = 'paging-' . $archive_paging_type;
//
// Archive Display Style, Blog Loop
//

if ( ! $display_left && ! $display_right ) {
	$event_loop_class[] = 'no-sidebar';
}

$event_loop_class[] = 'paging-' . $archive_paging_type;
//
// Event post class
//
$event_post_class = array( 'floral-event-classic-default' );

//
// Event header
//
$enable_item_header = isset( $_GET['arst-item-header'] ) ? $_GET['arst-item-header'] : floral_get_option( 'event-archive-item-header' );
if ( $enable_item_header == 0 ) {
	$enable_header      = false;
	$event_loop_class[] = 'no-header';
} else {
	$enable_header = true;
}

$enable_discount_tag = floral_get_option( 'event-archive-discount-tag', '', 1 );

//feature image
$archive_item_image_size = Floral_Blog::calculate_feature_imagesize_by_layout( $event_archive_layout, $event_archive_sidebar );
if ( ! empty( $archive_item_image_size ) ) {
	$image_size = $archive_item_image_size;
} else {
	$image_size = 'floral_1170';
}

$archive_item_image_ratio = isset( $_GET['parst-image-ratio'] ) ? $_GET['parst-image-ratio'] : floral_get_option( 'event-archive-item-image-ratio' );
if ( ! empty( $archive_item_image_ratio ) ) {
	$image_ratio = $archive_item_image_ratio;
} else {
	$image_ratio = 'original';
}
$feature_args                = array();
$feature_args['image_size']  = $image_size;
$feature_args['image_ratio'] = $image_ratio;
$feature_args['action']      = 'link';

// meta

$event_archive_post_meta = floral_get_option( 'event-archive-post-meta' );
$enable_date             = $enable_comments = $enable_categories = $enable_social_share = '0';
if ( is_array( $event_archive_post_meta ) && ! empty( $event_archive_post_meta ) ) {
	$enable_date         = $event_archive_post_meta['date'];
	$enable_comments     = $event_archive_post_meta['comments'];
	$enable_categories   = $event_archive_post_meta['categories'];
	$enable_social_share = $event_archive_post_meta['social-share'];
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
	<main id="site-main-archive event-archive" class="site-main-archive event-archive" role="main">
		<div id="primary" class="content-area <?php floral_the_clean_html_classes( array($event_archive_layout, $widget_title_style ) ); ?>">
			<div class="row clearfix">
				<?php
				if ( $display_left ): ?>
					<div class="sidebar sidebar-left hidden-sm hidden-xs <?php floral_the_clean_html_classes( $left_col ); ?>">
						<?php dynamic_sidebar( $event_archive_sidebar_left ); ?>
					</div>
				<?php endif; ?>

				<div class="main-archive-inner <?php floral_the_clean_html_classes( $center_col ); ?>">
					<div class="posts-loop event-loop <?php floral_the_clean_html_classes( $event_loop_class ); ?>">
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
								$post_attributes   = array();
								$wrapper_class     = array();
								$post_attributes[] = ( sprintf( 'class="loop-item event-item-wrapper %s"', floral_clean_html_classes( $wrapper_class ) ) );
								?>
								<div class="loop-item article-wrapper">
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
										<div class="floral-article-inner">
											<?php
											if ( $enable_header ) {
												//Entry header
												$entry_header = Floral_Blog::post_feature_format_auto( $feature_args );
												if ( $entry_header ) {
													?>
													<header class="entry-header">
														<div class="entry-thumbnail-wrapper">
															<?php echo sprintf( '%s', $entry_header ); ?>
														</div>
														<?php if ( $enable_discount_tag ):
															$discount_tag = get_post_meta( get_the_ID(), 'meta-event-discount-tag', true );
															if ( ! empty( $discount_tag ) ) {
																?>
																<div class="__discount-tag">
																	<?php echo '<span>' . $discount_tag . '</span>' ?>
																	<div class="__acute-angle-1"></div>
																	<div class="__acute-angle-2"></div>
																</div>
																<?php
															}
														endif; ?>
													</header>
													<!-- .entry-header -->
													<?php
												}
											}
											?>
											<div class="entry-content-wrapper">
												<?php
												if ( $enable_header ) { ?>
													<h3 class="entry-title">
														<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
													</h3>
												<?php }
												
												if ( ! ( empty( $enable_date ) && empty( $enable_categories ) ) ) { ?>
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
													<?php
												}
												
												if ( ! post_password_required() ) {
													$the_excerpt = get_the_excerpt();
													if ( ! empty( $the_excerpt ) ) {
														echo sprintf( '<div class="entry-content">%s</div>', $the_excerpt );
													}
												}
												?>

												<div class="__group-meta-2 clearfix">
													<?php
													if ( ! empty( $enable_social_share ) ) {
														floral_get_template_part( 'blog/parts/post', 'social-share' );
													}
													
													if ( ! empty( $enable_comments ) && ( comments_open() || get_comments_number() ) ) : ?>
														<div class="entry-meta-comment">
															<?php comments_popup_link(
																sprintf( '<span>%s</span>', esc_html__( '0 Comment', 'floral' ) ),
																sprintf( '<span>%s</span>', esc_html__( '1 Comment', 'floral' ) ),
																sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'floral' ) ) ); ?>
														</div>
													<?php endif;
													?>
												</div>
											</div>
											<!-- .entry-content -->
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
					Floral_Blog::the_post_navigation( $archive_paging_type, $archive_paging_args );
					?>
				</div>
				
				
				<?php if ( $display_right ): ?>
					<div class="sidebar sidebar-right hidden-sm hidden-xs <?php floral_the_clean_html_classes( $right_col ); ?>">
						<?php dynamic_sidebar( $event_archive_sidebar_right ); ?>
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