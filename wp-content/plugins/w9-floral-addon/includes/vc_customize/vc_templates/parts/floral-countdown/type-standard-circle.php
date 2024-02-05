<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: type-standard-circle.php
 * @time    : 6/9/2017 4:26 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="style-circle clearfix">
	<?php if ( $time_type === 'm-d-h-m-s' ) { ?>
		<div class="canvas-wrapper">
			<div class="canvas">
				<div class="months times">00</div>
			</div>
			<div class="title"><?php esc_html_e( 'Months', 'w9-floral-addon' ) ?></div>
		</div>
	<?php } ?>
	<div class="canvas-wrapper">
		<div class="canvas">
			<div class="days times">00</div>
		</div>
			<div class="title"><?php esc_html_e( 'Days', 'w9-floral-addon' ) ?></div>
	</div>
	<div class="canvas-wrapper">
		<div class="canvas">
			<div class="hours times">00</div>
		</div>
			<div class="title"><?php esc_html_e( 'Hours', 'w9-floral-addon' ) ?></div>
	</div>
	<div class="canvas-wrapper">
		<div class="canvas">
			<div class="minutes times">00</div>
		</div>
			<div class="title"><?php esc_html_e( 'Minutes', 'w9-floral-addon' ) ?></div>
	</div>
	<div class="canvas-wrapper">
		<div class="canvas">
			<div class="second times">00</div>
		</div>
			<div class="title"><?php esc_html_e( 'Seconds', 'w9-floral-addon' ) ?></div>
	</div>
</div>