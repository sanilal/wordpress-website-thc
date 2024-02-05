<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: type-standard-rectangle.php
 * @time    : 6/9/2017 4:25 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<div class="style-rectangle clearfix">
	<?php if($time_type === 'm-d-h-m-s') { ?>
	<div class="canvas">
		<span class="months times">00</span>
		<span class="separator"></span>
		<span class="title"><?php esc_html_e( 'Months', 'w9-floral-addon' ) ?></span>
	</div>
	<?php } ?>
	<div class="canvas">
		<span class="days times">00</span>
		<span class="separator"></span>
		<span class="title"><?php esc_html_e( 'Days', 'w9-floral-addon' ) ?></span>
	</div>
	<div class="canvas">
		<span class="hours times">00</span>
		<span class="separator"></span>
		<span class="title"><?php esc_html_e( 'Hours', 'w9-floral-addon' ) ?></span>
	</div>
	<div class="canvas">
		<span class="minutes times">00</span>
		<span class="separator"></span>
		<span class="title"><?php esc_html_e( 'Minutes', 'w9-floral-addon' ) ?></span>
	</div>
	<div class="canvas">
		<span class="second times">00</span>
		<span class="separator"></span>
		<span class="title"><?php esc_html_e( 'Seconds', 'w9-floral-addon' ) ?></span>
	</div>
</div>