<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-blog-archive.php
 * @time    : 4/9/2017 3:41 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_SC_Blog_Archive extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_blog_archive';
	
	public function __construct($settings) {
		parent::__construct($settings);
	}
}