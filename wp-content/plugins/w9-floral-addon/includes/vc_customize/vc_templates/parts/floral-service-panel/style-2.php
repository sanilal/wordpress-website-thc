<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-2.php
 * @time    : 7/18/2017 10:09 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
if ( sizeof( $service_data ) < 5 ) {
	echo __( 'The service items amount must be larger than 4', 'w9-floral-addon' );
} else {
	?>
	<div class="__service-panel-inner">
		<div class="__slider-1-wrapper">
			<div class="__slider-1 __syn-slider floral-default-slider-style">
				<?php
				foreach ( $service_data as $item ) :
					?>
					<div class="__slider-item">
						<div class="__image">
							<?php echo Floral_Image::get_image( get_post_thumbnail_id( $item['id'] ), 'floral_570', array( 'ratio' => '1' ) ); ?>
						</div>
					</div>
					<?php
				endforeach; ?>
			</div>
		</div>
		<div class="__slider-2-wrapper">
			<div class="__slider-2 __syn-slider floral-default-slider-style">
				<?php
				$i = 0;
				foreach ( $service_data as $item ) :
					$i ++;
					?>
					<div class="__slider-item">
						<div class="__index s-font">
							<?php
							echo sprintf( "%02d", $i );
							?>
							<div class="__line"></div>
						</div>
						<div class="__title s-font"><?php
							echo get_the_title( $item['id'] )
							?></div>
						<div class="__group-meta">
							<?php echo '<span class="__price">' . get_post_meta( $item['id'], 'meta-service-price', true ) . '</span>' ?>
							<span class="__divide">|</span>
							<?php echo '<span class="__time">' . get_post_meta( $item['id'], 'meta-service-time', true ) . '</span>' ?>
						</div>
						<div class="__excerpt"><?php
							echo get_the_excerpt( $item['id'] )
							?></div>
						<div class="__button">
							<a href="<?php the_permalink( $item['id'] ); ?>" class="__service-link"><?php echo __( 'Learn More', 'w9-floral-addon' ) ?></a>
						</div>
					</div>
					<?php
				endforeach; ?>
			</div>
		</div>
		<div class="__slider-3-wrapper">
			<div class="__dot __dot-1"></div>
			<div class="__dot __dot-2"></div>
			<div class="__line">
			</div>
			<div class="__slider-3 __syn-slider floral-default-slider-style">
				<?php
				foreach ( $service_data as $item ) :
					?>
					<div class="__slider-item __service-item">
						<div class="__slider-item-inner">
							<div class="__image">
								<?php echo Floral_Image::get_image( get_post_thumbnail_id( $item['id'] ), 'floral_270', array( 'ratio' => '1' ) ); ?>
							</div>
							<div class="__title"><?php echo get_the_title( $item['id'] ) ?></div>
						</div>
					</div>
					<?php
				endforeach;
				?>
			</div>
		</div>
		<script type="text/javascript">
			(function ($, window) {
				'use strict';
				$(document).ready(function () {
					var $container = $("<?php echo '#' . $unique_id; ?>"),
						$syn_slider = $('.__syn-slider', $container),
						$slider_1 = $('.__slider-1', $container),
						$slider_2 = $('.__slider-2', $container),
						$slider_3 = $('.__slider-3', $container);
					$slider_1.on("init", function (event, slick) {
						$(this).children().show();
					}).slick({
						arrows        : false,
						infinite      : true,
						fade          : true,
						swipe         : false,
						autoplaySpeed : 15000,
						slidesToShow  : 1,
						slidesToScroll: 1,
						asNavFor      : $syn_slider
					});
					$slider_2.on("init", function (event, slick) {
						$(this).children().show();
					}).slick({
						arrows        : false,
						infinite      : true,
						fade          : true,
						autoplaySpeed : 15000,
						swipe         : false,
						slidesToShow  : 1,
						slidesToScroll: 1,
						asNavFor      : $syn_slider
					});
					$slider_3.on("init", function (event, slick) {
						$(this).children().show();
					}).slick({
						arrows        : false,
						infinite      : true,
						autoplaySpeed : 15000,
						slidesToShow  : 4,
						slidesToScroll: 1,
						focusOnSelect : true,
						draggable     : false,
						asNavFor      : $syn_slider,
						responsive    : [
							{
								breakpoint: 991,
								settings  : {
									arrows      : true,
									draggable   : true,
									fade        : true,
									slidesToShow: 1
								}
							}
						]
					});

				});
			})(jQuery, window);
		</script>

	</div>
	<?php
}
?>