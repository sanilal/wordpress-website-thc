<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-1.php
 * @time    : 4/25/2017 9:21 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$item_id = get_the_ID();
if ( $event_data === 'name' ) {
	$item_id = $event_list_id[ $i - 1 ];
}
$item_title = the_title( '', '', false );
if ( $event_data === 'name' ) {
	$item_title = get_the_title( $item_id );
}
//var_dump( $item_id );
?>
<div class="event-item <?php floral_the_clean_html_classes( $class_event_item ) ?>">
	<?php if ( $event_layout_type === 'layout-grid' ) {
		echo '<div class="vc_column-inner">';
	} ?>
	<div class="item-content-wrapper" style="background-image: url(<?php echo Floral_Image::get_resize_image_url( get_post_thumbnail_id( $item_id ), $event_image_size ); ?>);">
		<div class="item-content">
			<div class="item-content-inner">
				<div class="__icon">
					<i class="<?php echo $_icon; ?>"></i>
				</div>
				<h3 class="__title">
					<a href="<?php the_permalink( $item_id ); ?>" rel="bookmark" title="<?php echo $item_title; ?>"><?php echo $item_title; ?></a>
				</h3>
			</div>
			<div class="__category">
				<div class="__line"></div>
				<?php
				$category = get_the_terms( $item_id, Floral_CPT_Event::TAX_SLUG );
				//						var_dump($category);
				if ( ! empty( $category ) ) {
					echo '<h5><a href="' . get_term_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a></h5>';
				} else {
					echo '<h5><span>&nbsp;</span></h5>';
				}
				?>
				<div class="__line"></div>
			</div>
		</div>
	</div>
	<?php if ( $event_layout_type === 'layout-grid' ) {
		echo '</div>';
	} ?>
</div>
