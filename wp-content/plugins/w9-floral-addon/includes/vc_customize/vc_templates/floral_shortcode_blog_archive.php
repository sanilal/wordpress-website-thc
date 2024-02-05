<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_blog_archive.php
 * @time    : 4/9/2017 3:44 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Blog_Archive
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$ba_display_type = $ba_display_style = $ba_display_columns = $ba_item_header = $ba_item_image_size = $ba_item_image_ratio = $ba_item_image_action = $ba_show_date = $ba_show_author = $ba_show_category = $ba_show_tags = $ba_show_comments = $ba_show_social_share = $ba_paging_type = $ba_paging_style = $ba_paging_align = $el_class = $css = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$class_blog_archive = array(
	$el_class,
	vc_shortcode_custom_css_class( $css )
);

$blog_archive_content_args['display-type']  = $ba_display_type;
$blog_archive_content_args['display-style'] = $ba_display_style;

$blog_loop_class   = array( 'blog-type-' . $ba_display_type );
$blog_loop_class[] = ! empty( $ba_display_style ) ? 'blog-' . $ba_display_style : '';

$blog_loop_class[] = 'paging-' . $ba_paging_type;

$archive_article_wrapper_class = array();
if ( in_array( $ba_display_type, array( 'masonry', 'grid' ) ) ) {
	$blog_loop_class[] = 'blog-columns-' . $ba_display_columns;
	$blog_loop_class[] = 'row';
	switch ( $ba_display_columns ) {
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
// Archive navigation
//
$archive_paging_type = !empty($ba_paging_type) ? $ba_paging_type : 'default';
$archive_paging_args = array();
if ($archive_paging_type === 'default') {
	$archive_paging_args['style'] = !empty($ba_paging_style) ? $ba_paging_style : 'style-2';
	$archive_paging_args['align'] = !empty($ba_paging_type) ? $ba_paging_align : 'center';
}

//
//Header enable
//
if ( $ba_item_header == 0 ) {
	$blog_archive_content_args['enable-header'] = false;
	$blog_loop_class[]                          = 'no-header';
} else {
	$blog_archive_content_args['enable-header'] = true;
}
//
// Get the image size
//
if ( ! empty( $ba_item_image_size ) ) {
	$blog_archive_content_args['image-size'] = $ba_item_image_size;
} else {
	$blog_archive_content_args['image-size'] = 'floral_1170';
}
//
// Get the image ratio
//
if ( ! empty( $ba_item_image_ratio ) ) {
	$blog_archive_content_args['image-ratio'] = $ba_item_image_ratio;
} else {
	$blog_archive_content_args['image-ratio'] = 'original';
}
//
// Get Image Action
//
if ( ! empty( $ba_item_image_action ) ) {
	$blog_archive_content_args['image-action'] = $ba_item_image_action;
} else {
	$blog_archive_content_args['image-action'] = 'none';
}

$blog_archive_content_args['post-meta'] = array(
	'date'         => $ba_show_date,
	'author'       => $ba_show_author,
	'comments'     => $ba_show_comments,
	'categories'   => $ba_show_category,
	'tags'         => $ba_show_tags,
	'social-share' => $ba_show_social_share,
);
?>

<div class="floral-blog-archive <?php floral_the_clean_html_classes( $class_blog_archive ) ?>">
	<div class="main-archive-inner">
		<div class="posts-loop blog-loop <?php floral_the_clean_html_classes( $blog_loop_class ) ?>">
<!--			--><?php
			$archive_args = array(
				'post_type' => 'post',    // get only posts
			);
			
			query_posts($archive_args);

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
			endif;
//			wp_reset_postdata(); ?>
		</div>
		<?php
		// Post navigation
		Floral_Blog::the_post_navigation( $archive_paging_type, $archive_paging_args );
		?>
	</div>
</div>
