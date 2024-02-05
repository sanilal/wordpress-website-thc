<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-3.php
 * @time    : 4/7/2017 12:50 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>

<div class="entry-content-wrapper">
	<div class="__group-content-1 clearfix">
		<?php if ( $posts_show_date ) { ?>
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
			<div class="__group-meta-3">
				<ul class="list-unstyled">
					<?php if ( $posts_show_author ): ?>
						<li class="entry-meta-author">
							<?php printf( '<a class="author vcard" href="%1$s">%2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
						</li>
					<?php endif; ?>
					<li class="__separator">/</li>
					<?php if ( $posts_show_category ):
						$category = get_the_category();
						?>
						<li class="entry-meta-category">
							<span><?php echo __( 'In:', 'w9-floral-addon' ) . ' ' ?></span><?php echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>'; ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
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
