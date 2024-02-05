<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: param-single-select.php
 * @time    : 7/17/2017 4:34 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_add_shortcode_param( 'single-select', 'floral_param_type_single_select' );

function floral_param_type_single_select( $settings, $value ) {
	$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
	$type       = isset( $settings['type'] ) ? $settings['type'] : '';
	$options    = isset( $settings['options'] ) ? (array) $settings['options'] : array();
	
	$class = array( $param_name, $type . '_field' );
	
	ob_start();
	?>
	<input type="hidden" class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>" id="<?php echo esc_attr( $param_name ); ?>" name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	<select class="widefat single-select2"
	        id="<?php echo esc_attr( $param_name ); ?>"
	        data-value="<?php echo esc_attr( $value ) ?>">
		<?php foreach ( $options as $option_key => $option_value ) : ?>
			<option value="<?php echo esc_attr( $option_key ); ?>"><?php echo esc_html( $option_value ); ?></option>
		<?php endforeach; ?>
	</select>
	<script>
		(function($) {
			'use strict';

			$(document).ready(function() {
				if (typeof (floral_admin) !== 'undefined') {
					floral_admin.widget_select2();
				}
			});
		})(jQuery);
	</script>
	<?php
	return ob_get_clean();
}