<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-service-list.php
 * @time    : 4/24/2017 8:28 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

class Floral_SC_Service_List extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_service_list';
	
	public function __construct($settings) {
		parent::__construct($settings);
	}
}