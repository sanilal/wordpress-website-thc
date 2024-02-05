<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service.php
 * @time    : 4/20/2017 3:02 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

class Floral_SC_Service extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_service';
	
	public function __construct($settings) {
		parent::__construct($settings);
	}
	
	
}