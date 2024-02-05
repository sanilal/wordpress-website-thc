<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: style-1.php
 * @time    : 7/17/2017 5:40 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="__left-panel">
	<ul class="__left-panel-inner mCustomScrollbar">
		<?php
		foreach ( $service_data as $item ) :
			if (!empty($item['id'])) {
				$item_icon = '';
				if ( ( ! empty( $item[ 'icon_' . $item['type'] ] ) ) ) {
					vc_icon_element_fonts_enqueue( $item['type'] );
					$item_icon = $item[ 'icon_' . $item['type'] ];
				}
				?>
				<li class="__tab-header-item">
					<a href="<?php echo '#' . $unique_id . '-' . $item['id'] ?>" class="__tab-header-item-inner">
						<div class="__icon"><i class="<?php echo $item_icon ?>"></i></div>
						<div class="__service-name"><?php echo get_the_title( $item['id'] ) ?></div>
					</a>
				</li>
				<?php
			}
		endforeach;
		?>
	</ul>
</div>
<div class="__right-panel">
	<?php
	foreach ( $service_data as $item ) :
	if (!empty($item['id'])) {
		?>
		<div class="__tab-header-mobile-item"><?php
			echo get_the_title( $item['id'] )
			?></div>
		<div class="__tab-body-item" id="<?php echo $unique_id . '-' . $item['id'] ?>">
			<div class="__title"><?php
				echo get_the_title( $item['id'] )
				?></div>
			<div class="__excerpt"><?php
				echo get_the_excerpt( $item['id'] )
				?></div>
			<div class="__button">
				<a href="<?php the_permalink( $item['id'] ); ?>" class="__service-link"><?php echo __( 'Learn More', 'w9-floral-addon' ) ?></a>
			</div>
		</div>
		<?php }
	endforeach; ?>
</div>
<script type="text/javascript">
	(function ($, window) {
		'use strict';
		$(document).ready(function () {
			var $container = $("<?php echo '#' . $unique_id; ?>");

			$(".__right-panel", $container).accordion({
				heightStyle: "content"
			});
			$container.tabs();
		});

	})(jQuery, window);
</script>
