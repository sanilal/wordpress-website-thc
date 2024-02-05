<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-1.php
 * @time    : 4/21/2017 9:16 AM
 * @author  : 9WPThemes Team
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
		<div class="item-image-wrapper">
			<div class="item-image">
				<?php if ( empty( $services_show_booking_btn ) ): ?>
				<a href="<?php the_permalink( $item_id ); ?>">
					<?php endif; ?>
					<div class="__overlay">
						<?php if ( empty( $services_show_booking_btn ) ): ?>
							<i class="flor-ico flor-ico-icon-link"></i>
						<?php endif; ?>
					</div>
					<?php echo Floral_Image::get_image( get_post_thumbnail_id( $item_id ), $services_image_size, array( 'ratio' => $services_image_ratio ) ); ?>
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
		<div class="item-content-wrapper">
			<div class="item-content">
				<?php if ( $services_show_price ): ?>
				<div class="show-price">
					<?php endif; ?>
					<h3 class="__title">
						<a href="<?php the_permalink( $item_id ); ?>" rel="bookmark" title="<?php echo $item_title; ?>"><?php echo $item_title; ?></a>
					</h3>
					<?php if ( $services_show_time ): ?>
						<div class="__time">
							<?php echo '<span>' . get_post_meta( $item_id, 'meta-service-time', true ) . '</span>' ?>
						</div>
					<?php endif; ?>
					<?php if ( $services_show_price ): ?>
						<div class="__price">
							<?php echo '<span>' . get_post_meta( $item_id, 'meta-service-price', true ) . '</span>' ?>
						</div>
					<?php endif; ?>
					<?php if ( $services_show_price ): ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if ( $services_layout_type === 'layout-grid' ) {
		echo '</div>';
	} ?>
</div>
