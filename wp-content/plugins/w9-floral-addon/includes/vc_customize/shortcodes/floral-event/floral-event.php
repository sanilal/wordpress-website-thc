<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-event.php
 * @time    : 4/25/2017 9:20 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Event::CPT_SLUG ) ) {
	return;
}

class Floral_SC_Event extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_event';
	
	public function __construct($settings) {
		parent::__construct($settings);
	}
	
	
}