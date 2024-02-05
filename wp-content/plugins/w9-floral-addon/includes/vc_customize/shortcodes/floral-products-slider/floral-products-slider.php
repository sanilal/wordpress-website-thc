<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-products-slider.php
 * @time    : 7/16/2017 2:33 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_SC_Products_Slider extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_products_slider';
	
	static function add_categories_args( $args, $categories, $operator ) {
		if ( ! empty( $categories ) ) {
			if ( empty( $args['tax_query'] ) ) {
				$args['tax_query'] = array();
			}
			$args['tax_query'][] = array(
				array(
					'taxonomy' => 'product_cat',
					'terms'    => array_map( 'sanitize_title', explode( '||', $categories ) ),
					'field'    => 'slug',
					'operator' => $operator
				)
			);
		}
		
		return $args;
	}
}