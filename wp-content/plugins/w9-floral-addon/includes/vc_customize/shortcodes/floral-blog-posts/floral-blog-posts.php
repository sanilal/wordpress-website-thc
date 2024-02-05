<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-blog-posts.php
 * @time    : 4/5/2017 7:33 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//require_once vc_path_dir( 'CONFIG_DIR', 'grids/vc-grids-functions.php' );

class Floral_SC_Blog_Posts extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_blog_posts';
	
	public function __construct($settings) {
		parent::__construct($settings);
		// add filter must be call first, some filters may take action before actions...
//		$this->add_filters();
//		$this->add_actions();
	}
	
	static function excerpt_limit_words($string, $word_limit) {
		$words = explode(' ', $string, ($word_limit + 1));
		if(count($words) > $word_limit) {
			array_pop($words);
		}
		return implode(' ', $words);
	}
	
//	function add_filters() {
//		add_filter( 'vc_autocomplete_floral_shortcode_blog_posts_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1 );
//		add_filter( 'vc_autocomplete_floral_shortcode_blog_posts_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1 );
//	}
//	function add_actions() {}
}