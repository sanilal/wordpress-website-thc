<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-common.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Common extends Floral_Base {
	public function __construct() {
		parent::__construct();
	}
	
	protected function add_filters() {
		add_filter( 'body_class', array( __CLASS__, 'body_classes' ) );
		add_filter( 'comment_form_fields', array( __CLASS__, 'move_comment_field_to_bottom' ) );
		
//		add_filter( 'widget_title', array( __CLASS__, 'remove_default_widget_title' ), 10, 3 );
	}
	
	protected function add_actions() {
		add_action( 'get_header', array( __CLASS__, 'trigger_maintenance_mode' ) );
		add_action( 'init', array( __CLASS__, 'check_for_subscriber' ) );
//        add_action( 'floral_page_before', array( __CLASS__, 'post_counter' ) );
		
		
	}
	
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	static function body_classes( $classes ) {
		$classes[] = floral_get_current_preset();
		//Body Layout
		$classes[] = 'layout-' . floral_get_option( 'body-layout', '', 'wide' );
		// Is in maintenance mde
		if ( floral_get_option( 'maintenance-mode' ) ) {
			$classes[] = 'in-maintenance-mode';
		}
		
		if ( floral_is_rtl() || is_rtl() ) {
			$classes[] = 'rtl';
		}
		
		if ( floral_get_option( 'loading-transitions', '', 0 ) ) {
			$classes[] = 'loading-transition-enable';
		}
		
		$widget_title_style = floral_get_option( 'widget-title-style' );
		if ( empty($widget_title_style) ) {
			$classes[] = 'general-widget-title_style-1';
		} else {
			$classes[] = 'general-widget-title_' . $widget_title_style;
		}
		
		if ( floral_get_meta_option( 'slipscreen', '', '', 0 ) ) {
			$classes[] = 'slipscreen-mode-on';
		}

//        if ( floral_get_meta_option( 'page-fullscreen', '', '', 0 ) ) {
//            $classes[] = 'page-fullscreen';
//        }
		
		if ( floral_get_option( 'page-leftzone-default-open' ) == 'open' ) {
			$classes[] = 'page-leftzone-default-open';
		}
		
		if ( floral_get_option( 'page-rightzone-default-open' ) == 'open' ) {
			$classes[] = 'page-rightzone-default-open';
		}
		
		
		return apply_filters( 'floral/common/body-classes', $classes );
	}
	
	/**
	 * @param $fields
	 *
	 * @return mixed
	 * @author: @sinzii
	 */
	static function move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		
		return $fields;
	}
	
	
	/**
	 * Trigger maintenance mode
	 */
	static function trigger_maintenance_mode() {
		if ( current_user_can( 'edit_themes' ) || is_user_logged_in() ) {
			return;
		}
		$default_options = floral_get_options_by_theme_options_name( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
		if ( ! empty( $default_options['maintenance-mode'] ) )
			switch ( $default_options['maintenance-mode'] ) {
				case '1':
					wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'floral' ) . '</p>', get_bloginfo() );
					break;
				case '2':
					$maintenance_mode_page_id = $default_options['maintenance-mode-page'];
					if ( empty( $maintenance_mode_page_id ) ) {
						wp_die( '<p style="text-align:center">' . esc_html__( 'We are currently in maintenance mode, please check back shortly.', 'floral' ) . '</p>', get_bloginfo() );
					} else {
						if ( get_permalink() !== get_permalink( $maintenance_mode_page_id ) ) {
							wp_redirect( get_permalink( $maintenance_mode_page_id ) );
							die();
						}
					}
					break;
			}
	}
	
	static function check_for_subscriber() {
		if ( ! empty( $_COOKIE['already_a_subscriber'] ) ) {
			$encrypted_email = $_COOKIE['already_a_subscriber'];
			// path to file contain secure key
			$secure_key_file = floral_theme_dir() . 'includes/library/defuse-crypto/floral-secure-key.txt';
			
			$crypto = new Floral_Crypto( $secure_key_file );
			
			$email = $crypto->decrypt( $encrypted_email );
			
			if ( function_exists( 'mc4wp' ) ) {
				/**
				 * @var MC4WP_API $api
				 */
				$api = mc4wp( 'api' );
				
				$resp = $api->get_lists_for_email( $email );
				
				if ( $resp == false ) {
					unset( $_COOKIE['already_a_subscriber'] );
					setcookie( 'already_a_subscriber', '', time() - 3600 );
				}
			} else {
				unset( $_COOKIE['already_a_subscriber'] );
				setcookie( 'already_a_subscriber', '', time() - 3600 );
			}
		}
	}
	
	static function remove_default_widget_title( $title, $instance = array(), $base_id = '' ) {
		if ( empty( $instance['title'] ) ) {
			$title = '';
		}
		
		return $title;
	}
}