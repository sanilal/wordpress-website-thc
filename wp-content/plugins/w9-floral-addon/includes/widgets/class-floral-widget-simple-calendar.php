<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: class-floral-widget-simple-calendar.php
 * @time    : 5/11/2017 11:16 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Widget_Simple_Calendar extends Floral_Widget_Base {
	/**
	 * Floral_Widget_Logo constructor.
	 */
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-simple-calendar',
			'name'    => esc_html__( 'Floral Simple Calendar', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-widget-simple-calendar',
				'description' => esc_html__( 'Display a simple calendar.', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
			)
		
		);
		parent::__construct( $args );
	}
	
	public function widget_content( $args, $instance ) {
//		$a ='';
//		extract( $instance, EXTR_IF_EXISTS );
		$this->the_widget_title( $args, $instance );
//		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		$uni_id = uniqid( 'floral-calendar-' );
		ob_start();
		$days = array (
			__( 'Sun', 'w9-floral-addon' ),
			__( 'Mon', 'w9-floral-addon' ),
			__( 'Tue', 'w9-floral-addon' ),
			__( 'Wed', 'w9-floral-addon' ),
			__( 'Thu', 'w9-floral-addon' ),
			__( 'Fri', 'w9-floral-addon' ),
			__( 'Sat', 'w9-floral-addon' ),
		);
		?>
		<div class="floral-calendar" id="<?php echo $uni_id;?>"></div>
		<script>
			!function(a){"use strict";a(document).ready(function(){a(<?php echo '\'#' . $uni_id . '\'' ?>).datepicker({inline:!0,firstDay:1,showOtherMonths:!0,dayNamesMin:<?php echo json_encode($days);?>})})}(jQuery);
//			$(<?php //echo '\'#' . $uni_id . '\'' ?>//).datepicker({
//				inline: true,
//				firstDay: 1,
//				showOtherMonths: true,
//				dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
//			});
		</script>
		<?php
		echo ob_get_clean();
	}
}