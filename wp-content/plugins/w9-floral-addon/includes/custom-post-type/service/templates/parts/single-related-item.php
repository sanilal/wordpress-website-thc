<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: single-related-item.php
 * @time    : 4/26/2017 1:44 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


$categories_listing = get_the_terms( get_the_ID(), Floral_CPT_Service::TAX_SLUG );
//var_dump( $categories_listing );
if ( ! empty( $categories_listing ) ) {
	$query_related['no_found_rows']       = true;
	$query_related['post_status']         = 'publish';
	$query_related['ignore_sticky_posts'] = true;
	$query_related['post_type']           = Floral_CPT_Service::CPT_SLUG;
	$query_related['posts_per_page']      = ! empty( $related_amount ) ? $related_amount : 4;
	$query_related['tax_query']           = array(
		array(
			'taxonomy' => Floral_CPT_Service::TAX_SLUG,
			'terms'    => $categories_listing[0]->slug,
			'field'    => 'slug',
			'operator' => 'IN'
		)
	);
	$query_related['post__not_in']        = array( get_the_ID() );
	$query_related['orderby']             = 'post_date';
	$query_related['order']               = 'ASC';
	
	
	$class_services = array(
		'floral-services-style-1',
		'layout-grid',
	);
	
	$class_services_item   = array();
	$class_services_item[] = 'vc_column_container';
	if ( empty( $related_col ) ) {
		$related_col = 4;
	}
	
	switch ( $related_col ) {
		case 1:
			$class_services_item[] = 'col-xs-12';
			break;
		case 2:
			$class_services_item[] = 'col-md-6 col-xs-12';
			break;
		case 3:
			$class_services_item[] = 'col-md-4 col-sm-6 col-xs-12';
			break;
		case 4:
			$class_services_item[] = 'col-md-3 col-sm-6 col-xs-12';
			break;
	}
	//vars
	
	$booking_page_url = '#';
	$booking_page  = floral_get_option( 'service-booking-page' );
	if ( ! empty( $booking_page ) ) {
		$booking_page_url = esc_url($booking_page );
	}
	
	$services_show_booking_btn = floral_get_option( 'service-show-booking-btn' );
	$services_booking_btn_tx   = floral_get_option( 'service-booking-btn-tx', '', 'BOOK NOW' );
	
	$services_show_price = $services_show_time = $services_show_price = true;
	
	$services_image_size  = 'floral_570';
	$services_image_ratio = '0.666666667';
	
	$r = new WP_Query( $query_related );
	?>
	<div class="related-service-block">

		<h5 class="related-service-title"><?php
		  echo __( 'Related Sevices:', 'w9-floral-addon' );
		?></h5>
		<div class="floral-sc-services clearfix <?php floral_the_clean_html_classes( $class_services ) ?>">
			<?php
			ob_start();
			if ( $r->have_posts() ) :
				
				while ( $r->have_posts() ) : $r->the_post();
					$item_id    = get_the_ID();
					$item_title = the_title( '', '', false );
//var_dump( $item_id );
					?>
					<div class="services-item <?php floral_the_clean_html_classes( $class_services_item ) ?>">

						<div class="vc_column-inner">
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
						</div>

					</div>
					<?php
				endwhile;
			
			endif;
			wp_reset_postdata();
			$items_content               = ob_get_clean();
			$class_services_grid_wrapper = array( 'vc_row', 'vc_row-o-equal-height vc_row-flex' );
			echo sprintf( '<div class="services-layout-grid-wrapper %s">%s</div>', floral_clean_html_classes( $class_services_grid_wrapper ), $items_content );
			?>
		</div>
	</div>
<?php } ?>