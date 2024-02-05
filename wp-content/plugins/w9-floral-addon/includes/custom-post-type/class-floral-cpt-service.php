<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: class-floral-cpt-service.php
 * @time    : 12/13/2016 6:20 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_CPT_Service extends Floral_CPT_BASE {
	const CPT_SLUG = 'service';
	const CPT_DEFAULT_NAME = 'Service';
	
	const TAX_SLUG = 'service-category';
	const TAX_DEFAULT_NAME = 'Service Category';
	
	function __construct() {
		/*
		 * LOAD OPTIONS
		 */
		$service_enable = floral_get_option( 'cpt-service-enable' );
		if ( ! $service_enable ) {
			return;
		}
		
		$service_slug     = Floral_CPT_BASE::uglify( floral_get_option( 'cpt-service-slug' ) );
		$service_tax_slug = Floral_CPT_BASE::uglify( floral_get_option( 'cpt-service-tax-slug' ) );
		
		$service_name     = Floral_CPT_BASE::beautify( floral_get_option( 'cpt-service-name' ) );
		$service_tax_name = Floral_CPT_BASE::beautify( floral_get_option( 'cpt-service-tax-name' ) );
		
		/*
		 * CONFIG
		 */
		$postype_args = array(
			'slug' => self::CPT_SLUG,
			'name' => ( ! empty( $service_name ) ) ? $service_name : self::CPT_DEFAULT_NAME,
			'args' => array(
				'has_archive' => true,
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
				'menu_icon'   => 'dashicons-share-alt'
			)
		);
		
		if ( ! empty( $service_slug ) ) {
			$postype_args['args']['rewrite'] = array( 'slug' => $service_slug, 'with_front' => true );
		}
		
		// tax
		
		$taxonomy_args = array(
			'slug' => self::TAX_SLUG,
			'name' => ( ! empty( $service_tax_name ) ) ? $service_tax_name : self::TAX_DEFAULT_NAME,
		);
		
		if ( ! empty( $service_tax_slug ) ) {
			$taxonomy_args['args']['rewrite'] = array( 'slug' => $service_tax_slug );
		}
		/*
		 * SETUP
		 */
		parent::__construct( $postype_args, $taxonomy_args );
		add_action( 'pre_get_posts', array( $this, 'set_items_per_page' ), 5 );
	}
	
	/**
	 * Register single template
	 *
	 * @param $single_template
	 *
	 * @return string
	 */
	function register_single_template( $single_template ) {
		$post_type = get_post_type();
		if ( $post_type == self::CPT_SLUG ) {
			return Floral_Addon::plugin_dir( __FILE__ ) . 'service/templates/single-service.php';
		}
		
		return $single_template;
	}
	
	/**
	 * Register archive template
	 *
	 * @param $archive_template
	 *
	 * @return string
	 */
	function register_archive_template( $archive_template ) {
		if ( is_archive() && self::CPT_SLUG == get_post_type() ) {
			$service_override_default_archive_id = floral_get_option( 'service-archive-template' );
			if ( ! empty( $service_override_default_archive_id ) ) {
				wp_redirect( get_permalink( $service_override_default_archive_id ) );
			} else {
				$template = Floral_Addon::plugin_dir( __FILE__ ) . 'service/templates/archive-service.php';
				if ( file_exists( $template ) ) {
					return $template;
				}
			}
		}
		
		return $archive_template;
	}
	
	/**
	 * Add admin columns
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	function manage_admin_columns( $columns ) {
		$new = array();
		
		foreach ( $columns as $key => $value ) {
			$new[ $key ] = $value;
			if ( $key == 'title' ) {
				$new['thumbnail'] = __( 'Service Thumbnail', 'w9-floral-addon' );
				$new['cats']      = __( 'Service Categories', 'w9-floral-addon' );
			}
		}
		
		return $new;
	}
	
	/**
	 * Manage admin columns values
	 *
	 * @param $column
	 * @param $post_id
	 */
	function manage_admin_columns_values( $column, $post_id ) {
		if ( $column == 'thumbnail' ) {
			$post_thumnail_id = get_post_thumbnail_id( $post_id );
			if ( $post_thumnail_id ) {
				echo Floral_Image::get_image( $post_thumnail_id );
			} else {
				echo __( 'No Image', 'w9-floral-addon' );
			}
		}
		
		if ( $column == 'cats' ) {
			$terms = wp_get_post_terms( get_the_ID(), array( self::TAX_SLUG ) );
			$cat   = '<ul style="margin-top: 0">';
			foreach ( $terms as $term ) {
				$cat .= '<li><a href="' . get_term_link( $term, self::TAX_SLUG ) . '">' . $term->name . '<a/></li>';
			}
			$cat .= '</ul>';
			echo wp_kses_post( $cat );
		}
	}
	
	/**
	 * set_items_per_page
	 *
	 * @param $query WP_Query
	 */
	function set_items_per_page( $query ) {
		if ( ( is_tax(self::TAX_SLUG) || is_post_type_archive( self::CPT_SLUG )) && $query->is_main_query() && ! is_admin() ) {
			
			$service_items_per_page = floral_get_option( 'service-archive-items-per-page' );
			if ( empty( $service_items_per_page ) ) {
				$service_items_per_page = 8;
			}
			// show 50 posts on custom taxonomy pages
			$query->set( 'posts_per_page', $service_items_per_page );
		}
	}
}

new Floral_CPT_Service();
