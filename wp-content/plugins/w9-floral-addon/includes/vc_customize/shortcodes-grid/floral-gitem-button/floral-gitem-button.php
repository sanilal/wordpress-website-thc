<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-button.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_SC_Gitem_Button extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_gitem_button';
	
	public function __construct( $settings ) {
		parent::__construct( $settings );
		
		add_filter( 'vc_gitem_template_attribute_floral_gitem_button', array( $this, 'floral_gitem_button' ), 10, 2 );
	}
	
	public function floral_gitem_button( $value, $data ) {
		/**
		 * @var null|Wp_Post $post ;
		 * @var string       $data ;
		 */
		extract( array_merge( array(
			'post' => null,
			'data' => '',
		), $data ) );
		$atts = array();
		parse_str( $data, $atts );
		$atts = array_merge( array(
			'gitem_btn_link'      => 'post_link',
			'gitem_btn_link_meta' => '',
		), $atts );
		
		$gitem_btn_link      = $atts['gitem_btn_link'];
		$gitem_btn_link_meta = $atts['gitem_btn_link_meta'];
		
		$booking_page_url = '#';
		$booking_page  = floral_get_option( 'service-booking-page' );
		if ( ! empty( $booking_page ) ) {
			$booking_page_url = esc_url($booking_page );
		}
		
		if ( $gitem_btn_link == 'post_link' ) {
			$atts['btn_link'] = 'url:' . urlencode( get_the_permalink( $post->ID ) );
		} elseif ( $gitem_btn_link == 'meta_key' ) {
			$atts['btn_link'] = 'url:' . urlencode( get_post_meta( $post->ID, $gitem_btn_link_meta, true ) );
		} elseif ( $gitem_btn_link == 'booking-page' ) {
			$atts['btn_link'] = 'url:' . urlencode( $booking_page_url );
		} elseif ( $gitem_btn_link == 'none' ) {
			$atts['btn_link'] = '';
		}
		
		return Vc_Shortcodes_Manager::getInstance()->getElementClass( 'floral_shortcode_' . 'button' )->output( $atts );
	}
}

