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

$feature_args = array();
$image_size   = Floral_Templates()->get_template_args('image-size', 'blog/single/content', '');

if(floral_get_meta_or_option('blog-single-resize-image') == '0') {
	$image_size = false;
}

if( ! empty($image_size)) {
	$feature_args['image_size'] = $image_size;
}

$blog_single_post_meta = Floral_Templates()->get_template_args( 'post-meta', 'blog/single/content', '' );
$enable_date           = $enable_comments = $enable_categories = $enable_tags = $enable_social_share = '1';
if ( is_array( $blog_single_post_meta ) && ! empty( $blog_single_post_meta ) ) {
	$enable_date = $blog_single_post_meta['date'];
	$enable_comments     = $blog_single_post_meta['comments'];
	$enable_categories   = $blog_single_post_meta['categories'];
	$enable_tags         = $blog_single_post_meta['tags'];
	$enable_social_share = $blog_single_post_meta['social-share'];
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content-wrapper">
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h3>
		<?php if ( ! ( empty( $enable_date ) && empty( $enable_categories ) ) ) { ?>
			<div class="__group-meta-1">
				<ul class="list-unstyled mb-0">
					<?php if ( $enable_date ): ?>
						<li class="entry-meta-date">
							<?php echo Floral_Wrap::link( get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
							?>
						</li>
					<?php endif; ?>
					
					<li class="__separator">/</li>
					
					<?php if ( $enable_categories ): ?>
						<li class="entry-meta-category">
<!--							--><?php //echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>'; ?>
							<?php echo get_the_category_list( ', ' ); ?>
						</li>
					<?php endif; ?>

					<li class="__separator">/</li>
					
					<?php if ( !empty( $enable_comments ) && ( comments_open() || get_comments_number() ) ) : ?>
							<li class="entry-meta-comment">
							<?php comments_popup_link(
								sprintf( '<span>%s</span>', esc_html__( 'No Comment', 'floral' ) ),
								sprintf( '<span>%s</span>', esc_html__( 'One Comment', 'floral' ) ),
								sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'floral' ) ) );
							?>
							</li>
					<?php endif; ?>
				</ul>
			</div>
		<?php } ?>
		<?php
		$entry_header = Floral_Blog::post_feature_format_auto($feature_args);
		if ( $entry_header ) {
			?>
			<div class="entry-thumbnail-wrapper">
				<?php echo sprintf( '%s', $entry_header ); ?>
			</div>
			<!-- .entry-header -->
			<?php
		}
		?>

		<div class="entry-content">
			<?php
			the_content();
			echo Floral_Blog::get_link_pages();
			?>
		</div>
		<!--Post tags-->
		<?php if ( ! ( empty( $enable_tags ) && empty( $enable_social_share ) ) ) { ?>
		<div class="__group-meta-2  clearfix">
			<?php floral_get_template_part( 'blog/single/parts/post', 'tags' );
			if ( ! empty( $enable_social_share ) ) {
				floral_get_template_part( 'blog/parts/post', 'social-share' );
			}
			?>
		</div>
		<?php } ?>
	</div><!-- .entry-content -->
	
	<?php
	
	/**
	 * Include Post Author Info
	 */
	floral_get_template_part( 'blog/single/parts/post', 'author-info' );
	
	/**
	 * Include Post Navigation Links
	 */
	floral_get_template_part( 'blog/single/parts/post', 'nav' );
	
	/**
	 * Include Comments Template
	 */
	comments_template();
	
	?>

</article><!-- #post-## -->

