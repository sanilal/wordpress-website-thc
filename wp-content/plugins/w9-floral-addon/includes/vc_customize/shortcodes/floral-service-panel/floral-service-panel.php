<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service-panel.php
 * @time    : 7/17/2017 6:08 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

class Floral_SC_Service_Panel extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_service_panel';
	
	public function __construct($settings) {
		parent::__construct($settings);
	}
	
	
}
