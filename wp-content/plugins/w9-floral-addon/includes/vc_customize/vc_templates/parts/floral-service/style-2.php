<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-2.php
 * @time    : 4/21/2017 9:17 AM
 * @author  : 9WPThemes Team
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$item_id = get_the_ID();
if ( $services_data === 'name' ) {
	$item_id = $service_list_id[ $i - 1 ];
}
$item_title = the_title( '', '', false );
if ( $services_data === 'name' ) {
	$item_title = get_the_title( $item_id );
}
//var_dump( $item_id );
?>
<div class="services-item <?php floral_the_clean_html_classes( $class_services_item ) ?>">
	<?php if ( $services_layout_type === 'layout-grid' ) {
		echo '<div class="vc_column-inner">';
	} ?>
	<div class="services-item-inner">
		<div class="item-image" style="background-image: url(<?php echo Floral_Image::get_resize_image_url( get_post_thumbnail_id( $item_id ), $services_image_size ); ?>);"></div>
		<div class="item-content-wrapper">
			<div class="item-content">
				<div class="item-content-inner">
					<div class="__category">
						<?php
						$category = get_the_terms( $item_id, Floral_CPT_Service::TAX_SLUG );
						//						var_dump($category);
						if ( ! empty( $category ) ) {
							echo '<a href="' . get_term_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a>';
						} else {
							echo '<span>&nbsp;</span>';
						}
						?>
					</div>
					<h3 class="__title">
						<a href="<?php the_permalink( $item_id ); ?>" rel="bookmark" title="<?php echo $item_title; ?>"><?php echo $item_title; ?></a>
					</h3>
					<?php if ( ! ( empty( $services_show_price ) && empty( $services_show_time ) ) ) { ?>
						<div class="__group-meta">
							<ul class="list-unstyled mb-0">
								<?php if ( $services_show_price ): ?>
									<li class="__price">
										<?php echo '<span>' . get_post_meta( $item_id, 'meta-service-price', true ) . '</span>' ?>
									</li>
								<?php endif; ?>
								<li class="__separator">/</li>
								<?php if ( $services_show_time ): ?>
									<li class="__time">
										<?php echo '<span>' . get_post_meta( $item_id, 'meta-service-time', true ) . '</span>' ?>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if ( $services_show_booking_btn ): ?>
				<div class="__booking-btn">
					<a href="<?php echo $booking_page_url; ?>" class="__btn"><?php echo esc_html( $services_booking_btn_tx ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( $services_layout_type === 'layout-grid' ) {
		echo '</div>';
	} ?>
</div>
