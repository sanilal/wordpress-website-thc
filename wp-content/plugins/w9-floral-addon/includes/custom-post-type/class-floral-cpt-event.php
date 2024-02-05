<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-cpt-event.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_CPT_Event extends Floral_CPT_BASE {
	const CPT_SLUG = 'event';
	const CPT_DEFAULT_NAME = 'Event';
	
	const TAX_SLUG = 'event-category';
	const TAX_DEFAULT_NAME = 'Event Category';
	
	function __construct() {
		/*
		 * LOAD OPTIONS
		 */
		$event_enable = floral_get_option( 'cpt-event-enable' );
		if ( ! $event_enable ) {
			return;
		}
		
		$event_slug     = Floral_CPT_BASE::uglify( floral_get_option( 'cpt-event-slug' ) );
		$event_tax_slug = Floral_CPT_BASE::uglify( floral_get_option( 'cpt-event-tax-slug' ) );
		
		$event_name     = Floral_CPT_BASE::beautify( floral_get_option( 'cpt-event-name' ) );
		$event_tax_name = Floral_CPT_BASE::beautify( floral_get_option( 'cpt-event-tax-name' ) );
		
		/*
		 * CONFIG
		 */
		$postype_args = array(
			'slug' => self::CPT_SLUG,
			'name' => ( ! empty( $event_name ) ) ? $event_name : self::CPT_DEFAULT_NAME,
			'args' => array(
				'has_archive' => true,
				'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
				'menu_icon'   => 'dashicons-calendar-alt'
			)
		);
		
		if ( ! empty( $event_slug ) ) {
			$postype_args['args']['rewrite'] = array( 'slug' => $event_slug, 'with_front' => true );
		}
		
		// tax
		
		$taxonomy_args = array(
			'slug' => self::TAX_SLUG,
			'name' => ( ! empty( $event_tax_name ) ) ? $event_tax_name : self::TAX_DEFAULT_NAME,
		);
		
		if ( ! empty( $event_tax_slug ) ) {
			$taxonomy_args['args']['rewrite'] = array( 'slug' => $event_tax_slug );
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
			return Floral_Addon::plugin_dir( __FILE__ ) . 'event/templates/single-event.php';
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
			$event_override_default_archive_id = floral_get_option( 'event-archive-template' );
			if ( ! empty( $event_override_default_archive_id ) ) {
				wp_redirect( get_permalink( $event_override_default_archive_id ) );
			} else {
				$template = Floral_Addon::plugin_dir( __FILE__ ) . 'event/templates/archive-event.php';
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
				$new['thumbnail'] = __( 'Event Thumbnail', 'w9-floral-addon' );
				$new['cats']      = __( 'Event Categories', 'w9-floral-addon' );
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
			
			$event_items_per_page = floral_get_option( 'event-archive-items-per-page' );
			if ( empty( $event_items_per_page ) ) {
				$event_items_per_page = 8;
			}
			// show 50 posts on custom taxonomy pages
			$query->set( 'posts_per_page', $event_items_per_page );
		}
	}
}

new Floral_CPT_Event();

