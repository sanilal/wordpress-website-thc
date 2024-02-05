<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package 9WPThemes
 */

$display_type  = Floral_Templates()->get_template_args( 'display-type', 'blog/archive/content', 'wide' );
$display_style = Floral_Templates()->get_template_args( 'display-style', 'blog/archive/content', 'style-1' );
//var_dump( $display_type . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $display_style );


$feature_args = array();
$image_size   = Floral_Templates()->get_template_args( 'image-size', 'blog/archive/content', '' );
$image_ratio  = Floral_Templates()->get_template_args( 'image-ratio', 'blog/archive/content', 'original' );
$image_action = Floral_Templates()->get_template_args( 'image-action', 'blog/archive/content', '' );
if ( ! empty( $image_size ) ) {
	$feature_args['image_size'] = $image_size;
}
if ( ! empty( $image_ratio ) ) {
	$feature_args['image_ratio'] = $image_ratio;
}
if ( ! empty( $image_action ) ) {
	$feature_args['action'] = $image_action;
}

//var_dump( $display_type . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $display_style . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $image_ratio );

$post_item_layout = Floral_Templates()->get_template_args( 'post-item-layout', 'blog/archive/content', '' );
$enable_header    = Floral_Templates()->get_template_args( 'enable-header', 'blog/archive/content', '' );

//$blog_archive_post_meta = floral_get_option( 'blog-archive-post-meta' );
$blog_archive_post_meta = Floral_Templates()->get_template_args( 'post-meta', 'blog/archive/content', '' );
$enable_date            = $enable_author = $enable_comments = $enable_categories = $enable_tags = $enable_social_share = '0';
if ( is_array( $blog_archive_post_meta ) && ! empty( $blog_archive_post_meta ) ) {
	$enable_date         = $blog_archive_post_meta['date'];
	$enable_author       = $blog_archive_post_meta['author'];
	$enable_comments     = $blog_archive_post_meta['comments'];
	$enable_categories   = $blog_archive_post_meta['categories'];
	$enable_tags         = $blog_archive_post_meta['tags'];
	$enable_social_share = $blog_archive_post_meta['social-share'];
}
$enable_date         = isset( $_GET['arst-e-date'] ) ? $_GET['arst-e-date'] : $enable_date;
$enable_author       = isset( $_GET['arst-e-aut'] ) ? $_GET['arst-e-aut'] : $enable_author;
$enable_comments     = isset( $_GET['arst-e-com'] ) ? $_GET['arst-e-com'] : $enable_comments;
$enable_categories   = isset( $_GET['arst-e-cat'] ) ? $_GET['arst-e-cat'] : $enable_categories;
$enable_tags         = isset( $_GET['arst-e-tag'] ) ? $_GET['arst-e-tag'] : $enable_tags;
$enable_social_share = isset( $_GET['arst-e-soc'] ) ? $_GET['arst-e-soc'] : $enable_social_share;

// excerpt
$the_excerpt = get_the_excerpt();
if ( isset( $_GET['arst-trim-excerpt'] ) ) {
	$words = explode( ' ', $the_excerpt, ( $_GET['arst-trim-excerpt'] + 1 ) );
	if ( count( $words ) > $_GET['arst-trim-excerpt'] ) {
		array_pop( $words );
	}
	$the_excerpt = implode( ' ', $words );
}
//var_dump($the_excerpt);

//Print Layout
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix ' . esc_attr( $post_item_layout ) ); ?>>
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
					<?php if ( ( $display_type === 'wide' ) && ( $display_style === 'style-2' ) && ( ! empty( $enable_date ) ) ) { ?>
						<div class="floral-square-date">
							<div class="__day">
								<?php echo get_the_time( 'j' ) ?>
							</div>
							<div class="__separator"></div>
							<div class="__month">
								<?php echo get_the_time( 'M' ) ?>
							</div>
						</div>
					<?php } ?>
				</header>
				<!-- .entry-header -->
				<?php
			}
		}
		
		//Entry Content (type Wide)
		//==============================
		if ( $display_type === 'wide' ) {
			?>
			<div class="entry-content-wrapper">
				<?php
				// title (start)
				if ( ( ( $display_style === 'style-1' ) && ! $enable_header ) || ( $display_style === 'style-2' ) ) { ?>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3>
				<?php }
				// title (end)
				
				// group meta (start)
				if ( ! ( empty( $enable_date ) && empty( $enable_categories ) ) ) { ?>
					<div class="__group-meta-1">
						<ul class="list-unstyled">
							<?php if ( ! empty( $enable_date ) && ( ( $display_style === 'style-1' ) || ( ( $display_style === 'style-2' ) && ! $enable_header ) ) ): ?>
								<li class="entry-meta-date">
									<?php echo Floral_Wrap::link( get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
									?>
								</li>
							<?php endif; ?>
							<li class="__separator">/</li>
							<?php if ( ! empty( $enable_categories ) ): ?>
								<li class="entry-meta-category">
									<?php echo get_the_category_list( ', ' ); ?>
								</li>
							<?php endif; ?>
						</ul>
					</div>
				<?php }
				// group meta (end)
				
				// title - 2 (start)
				if ( ( $display_style === 'style-1' ) && $enable_header ) { ?>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h3>
				<?php }
				// title -2 (end)
				
				
				if ( ! post_password_required() ) {
					if ( ! empty( $the_excerpt ) ) {
						echo sprintf( '<div class="entry-content">%s</div>', $the_excerpt );
					}
				}
				?>
				<?php if ( ! empty( $enable_tags ) ): ?>
					<div class="entry-meta-tags-wrapper">
						<?php if ( has_tag() ):
							the_tags( '<div class="entry-meta-tags"><span><i class="fa fa-tags p-color"></i>' . esc_html__( 'Tags:', 'floral' ) . '</span>', ', ', '</div>' ); ?>
						<?php else: ?>
							<div class="entry-meta-tags">
								<span><i class="fa fa-tags p-color"></i><?php echo esc_html__( 'Tags: No tag.', 'floral' ) ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="__group-meta-2 clearfix">
					<?php if ( ! empty( $enable_author ) ): ?>
						<div class="entry-meta-author">
							<span><?php esc_html_e( 'By', 'floral' ); ?></span> <?php printf( '<a class="author vcard" href="%1$s">%2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $enable_comments ) && ( comments_open() || get_comments_number() ) ) : ?>
						<div class="entry-meta-comment">
							<?php comments_popup_link(
								sprintf( '<span>%s</span>', esc_html__( '0 Comment', 'floral' ) ),
								sprintf( '<span>%s</span>', esc_html__( '1 Comment', 'floral' ) ),
								sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'floral' ) ) ); ?>
						</div>
					<?php endif;
					if ( ! empty( $enable_social_share ) ) {
						floral_get_template_part( 'blog/parts/post', 'social-share' );
					}
					?>
				</div>
			</div>
			<!-- .entry-content -->
		<?php }
		//==============================
		
		//Entry Content (type Grid and Masonry)
		//==============================
		if ( $display_type === 'masonry' || $display_type === 'grid' ) {
			?>
			<div class="entry-content-wrapper">
				<div class="__group-content-1 clearfix">
					<?php if ( ! empty( $enable_date ) ) { ?>
						<div class="floral-square-date">
							<div class="__day">
								<?php echo get_the_time( 'j' ) ?>
							</div>
							<div class="__separator"></div>
							<div class="__month">
								<?php echo get_the_time( 'M' ) ?>
							</div>
						</div>
					<?php } ?>
					<div class="__inner-group-content-1">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="__group-meta-1">
							<ul class="list-unstyled">
								<?php if ( ! empty( $enable_author ) ): ?>
									<li class="entry-meta-author">
										<?php printf( '<a class="author vcard" href="%1$s">%2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
									</li>
								<?php endif; ?>
								<li class="__separator">/</li>
								<?php if ( ! empty( $enable_comments ) && ( comments_open() || get_comments_number() ) ) : ?>
									<li class="entry-meta-comment">
										<?php comments_popup_link(
											sprintf( '<span>%s</span>', esc_html__( '0 Comment', 'floral' ) ),
											sprintf( '<span>%s</span>', esc_html__( '1 Comment', 'floral' ) ),
											sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'floral' ) ) ); ?>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php if ( ! empty( $enable_categories ) ): ?>
					<div class="entry-meta-category">
						<span><?php echo esc_html__( 'In:', 'floral' ) . ' ' ?></span><?php echo get_the_category_list( ', ' ); ?>
					</div>
				<?php endif; ?>
				<?php
				if ( ! post_password_required() ) {
					if ( ! empty( $the_excerpt ) ) {
						echo sprintf( '<div class="entry-content">%s</div>', $the_excerpt );
					}
				}
				?>
				<?php if ( ! empty( $enable_tags ) ): ?>
					<div class="entry-meta-tags-wrapper">
						<?php if ( has_tag() ):
							the_tags( '<div class="entry-meta-tags"><span><i class="fa fa-tags p-color"></i>' . esc_html__( 'Tags:', 'floral' ) . '</span>', ', ', '</div>' ); ?>
						<?php else: ?>
							<div class="entry-meta-tags">
								<span><i class="fa fa-tags p-color"></i><?php echo esc_html__( 'Tags: No tag.', 'floral' ) ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif;
				if ( ! empty( $enable_social_share ) ) {
					floral_get_template_part( 'blog/parts/post', 'social-share' );
				}
				?>
			</div>
			<!-- .entry-content -->
		<?php }
		//============================== ?>
	</div>
</article>
<!-- #post-## -->
