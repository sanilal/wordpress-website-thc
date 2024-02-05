<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-1.php
 * @time    : 7/16/2017 5:35 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="__slider-1-wrapper">
	<div class="__slider-1 floral-default-slider-style">
		<?php
		while ( $products->have_posts() ) : $products->the_post();
			?>
			<div class="__item">
				<div class="__image-wrapper">
					<div class="__image">
						<?php Floral_Woocommerce::get_custom_size_thumbnail( true, '540x360' ); ?>
						<div class="__image-overlay overlay-object">
						</div>
					</div>
				</div>
			</div>
			<?php
		endwhile;
		?>
	</div>
</div>
<div class="__slider-2-wrapper">
	<div class="__slider-2 floral-default-slider-style">
		<?php
		while ( $products->have_posts() ) : $products->the_post();
			?>
			<div class="__item">
				<div class="__block-meta-1">
					<div class="__title">
						<?php
						do_action( 'woocommerce_shop_loop_item_title' );
						?>
					</div>
					<div class="__price">
						<?php
						woocommerce_template_loop_price();
						?>
					</div>
				</div>
				<div class="__short-description">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<?php
		endwhile;
		?>
	</div>
</div>
<script type="text/javascript">
	(function ($, window) {
		'use strict';
		$(document).ready(function () {
			var $container = $("<?php echo '#' . $unique_id; ?>"),
				$slider_1 = $('.__slider-1', $container),
				$slider_2 = $('.__slider-2', $container);
			$slider_1.on("init", function (event, slick) {
				$(this).children().show();
			}).slick({
				arrows        : true,
				infinite      : true,
				autoplaySpeed : 15000,
				slidesToShow  : 1,
				slidesToScroll: 1,
				variableWidth : true,
				centerMode    : true,
				focusOnSelect : true,
				draggable     : false,
				asNavFor      : $slider_2,
				responsive    : [
					{
						breakpoint: 767,
						settings  : {
							draggable: true,
							centerMode   : false,
							variableWidth: false
						}
					}
				]
			});
			$slider_2.on("init", function (event, slick) {
				$(this).children().show();
			}).slick({
				arrows        : false,
				infinite      : true,
				fade          : true,
				dots          : true,
				autoplaySpeed : 15000,
				slidesToShow  : 1,
				slidesToScroll: 1,
				asNavFor      : $slider_1
			});

		});
	})(jQuery, window);
</script>