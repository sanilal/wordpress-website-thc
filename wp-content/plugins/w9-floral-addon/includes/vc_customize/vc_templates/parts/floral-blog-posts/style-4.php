<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-4.php
 * @time    : 6/26/2017 10:17 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>

<div class="entry-content-wrapper">
	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h3>
	<?php if ( ! ( ! $posts_show_date && ! $posts_show_author ) ) { ?>
		<div class="__group-meta-2">
			<ul class="list-unstyled mb-0">
				<?php if ( $posts_show_date ): ?>
					<li class="entry-meta-date">
						<?php echo Floral_Wrap::link( get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
						?>
					</li>
				<?php endif; ?>
				<li class="__separator">/</li>
				<?php if ( $posts_show_author ): ?>
					<li class="entry-meta-author">
						<?php printf( '<a class="author vcard" href="%1$s">%2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php } ?>
	
	<?php if ( $posts_show_category ):
		$category = get_the_category();
		?>
		<div class="entry-meta-category">
			<span><?php echo __( 'In:', 'w9-floral-addon' ) . ' ' ?></span><?php echo get_the_category_list( ', ' ); ?>
		</div>
	<?php endif; ?>
	
	<?php
	if ( ! post_password_required() ) {
		$the_excerpt = get_the_excerpt();
		if ( ! empty( $posts_excerpt_length ) ) {
			$the_excerpt = Floral_SC_Blog_Posts::excerpt_limit_words( get_the_excerpt(), $posts_excerpt_length );
		}
		if ( $posts_show_excerpt ) {
			echo sprintf( '<div class="entry-content">%s <span class="__dot">...</span></div>', $the_excerpt );
		}
	}
	?>
</div>