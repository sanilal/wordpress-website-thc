<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-simple.php
 * @time    : 9/22/16 9:55 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * @var $portfolio_post_class
 * @var $portfolio_thumbnail_ratio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( floral_clean_html_classes( $portfolio_post_class ) ); ?>>
	<div class="floral-portfolio-post-item-inner">
		<div class="entry-header">
			<div class="entry-thumbnail">
				<?php
				$thumbnail_id   = get_post_thumbnail_id();
				$thumbnail_args = array();
				if ( isset( $portfolio_thumbnail_ratio ) ) {
					$thumbnail_args['ratio'] = $portfolio_thumbnail_ratio;
				}
				$post_thumbnail = '<div class="__overlay"><i class="fa fa-link"></i></div>' . Floral_Image::get_image( $thumbnail_id, 'floral_1170', $thumbnail_args );
				if ( empty( $post_thumbnail ) ) {
					$post_thumbnail = Floral_Image::get_placeholder_image( '1170x' . ( ( isset( $portfolio_thumbnail_ratio ) && floatval( $portfolio_thumbnail_ratio ) !== 0 ) ? 1170 * $portfolio_thumbnail_ratio : 700 ) );
				}
				
				echo Floral_Wrap::link( $post_thumbnail, get_permalink(), array( 'title' => get_the_title() ) );
				?>
			</div>
		</div>
		<?php
		$show_title = isset( $_GET['parst-show-title'] ) ? $_GET['parst-show-title'] : floral_get_option( 'portfolio-archive-show-title', '', 'yes' );
		if ( $show_title === 'yes' ) {
			?>
			<div class="entry-content text-link-color">
				<h3 class="entry-title">
					<?php
					$title = get_the_title();
					$title = Floral_Wrap::link( $title, get_permalink(), array( 'title' => $title ) );
					echo wp_kses_post( $title );
					?>
				</h3>
			</div>
		<?php }; ?>
	</div>
</article>