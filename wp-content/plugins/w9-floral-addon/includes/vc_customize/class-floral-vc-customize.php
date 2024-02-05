<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-vc-customize.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_VC_Customize {
	private $shortcodes;
	private $shortcodes_grid;
	
	static private $custom_shortcodes_css;
	
	function __construct() {
		// only load shortcode and vc customize if js_composer is activated
		if ( ! Floral_Addon::is_vc_active() || ! class_exists( 'Vc_Manager' ) ) {
			return;
		}
		
		/*-------------------------------------
			GRID SHORTCODES TO LOAD
		---------------------------------------*/
		$this->shortcodes_grid = array(
			'vc-gitem-zone-a',
			'vc-gitem-zone-b',
			'vc-gitem-zone-c',
			'vc-gitem',
			'floral-gitem-button',
			'floral-gitem-heading',
			'floral-gitem-post-excerpt',
			'floral-gitem-text',
			'floral-gitem-feature',
			'floral-gitem-image',
			'floral-gitem-image-carousel',
			'floral-gitem-feature-block',
			'floral-gitem-block',
		);
		
		/*-------------------------------------
				WHICH SHORTCODES TO LOAD
		---------------------------------------*/
		$this->shortcodes = array(
			// Core SC
			'floral-slider-container',
			'floral-button',
			'floral-heading',
			
			//Header shortcode
			'floral-logo',
			
			
			//Content Template
			'floral-content-template',
			
			// Custom VC
			'vc-row',
			'vc-column',
			'vc-empty-space',
			'vc-pageable-container',
			'vc-tta-accordion',
			'vc-tta-tabs',
			'vc-tta-tour',
			'vc-message-box',
			'vc-ctf7',
			'vc-pie',
			'vc-line-chart',
			'vc-round-chart',
			'vc-icon',
			'vc-video',
			'vc-separator',
			'vc-text-separator',
			'vc-gmaps',
			'vc-progress-bar',
			'vc-basic-grid',
			'vc-media-grid',
			'vc-masonry-grid',
			'vc-masonry-media-grid',
			'vc-widget-sidebar',
//            'vc-column-text',
			'vc-single-image',
			
			// Widget
			'floral-social-profiles',
			'floral-widget-menu',
//            'floral-widget-download',
			'floral-widget-tag-cloud',
			'floral-widget-shop-account',
			
			// woocommerce vc shortcode
			'wc-vc-shortcodes',
			
			//Wrapper
			'floral-div-content',
			'floral-div-wrapper',
			
			// General SC
			'floral-image-carousel',
			'floral-icon-box',
			'floral-counter',
			'floral-list',
//            'floral-testimonials',
//            'floral-pricing-table',
			'floral-team',
			'floral-expandable-section',
			'floral-countdown',
			'floral-breadcrumb',
			'floral-post-meta',
			'floral-rating',
			'floral-google-maps',
			'floral-products-slider',
//            'floral-demo-listing',
			
			//blog
//	        'floral-blog-archive',
			'floral-blog-posts',
			
			//Portfolio Shortcode
//            'floral-portfolio-page-title',
//            'floral-portfolio-about',
//            'floral-portfolio-info',
//            'floral-portfolio-gallery',
			
			//Service
			'floral-service',
			'floral-service-list',
			'floral-service-panel',
			
			//Event
			'floral-event',
			
			// Other
//	        'floral-thumbnail-slider',
			'floral-mailchimp-signup'
		);
		
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		add_action( 'init', array( $this, 'init' ), 48 );
		
		/*
		 * OVERRIDE WOOCOMMERCE SHORTCODE
		 */
		if ( Floral_Addon::is_woocommerce_active() ) {
			remove_action( 'init', array( 'WC_Shortcodes', 'init' ) );
			
			require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'class-floral-wc-shortcodes.php' );
			add_action( 'init', array( 'Floral_WC_Shortcodes', 'init' ), 100 );
		}
		
	}
	
	function after_setup_theme() {
		/*-------------------------------------
			SET UP VC
		---------------------------------------*/
		self::set_up_vc();
		
		/*-------------------------------------
		   LOAD HELPERS
		---------------------------------------*/
		self::load_helpers();
		/*-------------------------------------
			REGISTER NEW PARAM TYPE FOR VC
		---------------------------------------*/
		self::register_new_param_type();
		
		/*-------------------------------------
			Register 9WPThemes & Floral icons
		---------------------------------------*/
		add_filter( 'vc_iconpicker-type-9wpthemes', array( $this, 'vc_iconpicker_type_9wpthemes' ) );
		add_filter( 'vc_iconpicker-type-floral', array( $this, 'vc_iconpicker_type_floral' ) );
		
		/*-------------------------------------
			LOAD GRID SHORTCODE
		---------------------------------------*/
		$this->load_grid_shortcodes();
		
		/*-------------------------------------
			LOAD GRID SHORTCODE MAP
		---------------------------------------*/
		add_filter( 'vc_grid_item_shortcodes', array( $this, 'load_grid_shortcodes_map' ) );
		
		/*-------------------------------------
			VC GRID PREDEFINE TEMPLATE
		---------------------------------------*/
		add_filter( 'vc_grid_item_predefined_templates', array( __CLASS__, 'vc_grid_item_predefined_templates' ) );
		
		/*-------------------------------------
			MANAGER SHORTCODE PRESET SETTING
		---------------------------------------*/
		add_action( 'vc_after_init', array( __CLASS__, 'register_shortcode_settings_preset' ) );
		
		/*-------------------------------------
			MANAGER VISUAL COMPOSER TEMPLATE
		---------------------------------------*/
		add_filter( 'vc_load_default_templates', array( __CLASS__, 'vc_load_default_templates' ) );
		
		
		/*-------------------------------------
			DEFAULT CONTENT
		---------------------------------------*/
		if ( is_admin() ) {
			add_action( 'admin_init', array( __CLASS__, 'default_content' ), 7 );
		}
	}
	
	/**
	 * Run at init hook
	 */
	function init() {
		/*-------------------------------------
			REMOVE USELESS ELEMENT OF VC
		---------------------------------------*/
		self::remove_useless_elements();
		
		/*-------------------------------------
			LOAD VC SHORTCODES
		---------------------------------------*/
		$this->load_shortcodes();
		
		/*-------------------------------------
			UPDATE VC ICONS
		---------------------------------------*/
		self::update_vc_icon();
		
		/*-------------------------------------
			HOOKS
		---------------------------------------*/
		add_action( 'wp_enqueue_scripts', array( __CLASS__, '_enqueue_front_end' ), 50 );
//        add_action( 'wp_enqueue_scripts', array( __CLASS__, '_print_most_used_color_helper_classes' ), 99 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, '_enqueue_admin' ), 50 );
		
		/*-------------------------------------
			CUSTOM VC EDITOR
		---------------------------------------*/
		add_action( 'vc_base_register_admin_css', array( __CLASS__, 'register_custom_vc' ) );
		add_action( 'vc_backend_editor_enqueue_js_css', array( __CLASS__, 'enqueue_custom_vc' ) );
		add_action( 'vc_backend_editor_enqueue_js_css', array( __CLASS__, '_print_custom_vc_css' ) );
		
		
		add_action( 'vc_frontend_editor_render', array( __CLASS__, 'register_custom_vc' ) );
		add_action( 'vc_frontend_editor_render', array( __CLASS__, 'enqueue_custom_vc' ) );
		add_action( 'vc_load_iframe_jscss', array( __CLASS__, 'register_custom_vc' ) );
		add_action( 'vc_load_iframe_jscss', array( __CLASS__, 'enqueue_custom_vc' ) );
		
		add_action( 'wp_footer', array( __CLASS__, 'print_shortcodes_css' ) );
		/*-------------------------------------
			ADD CUSTOM VC EDITOR SCRIPT
		---------------------------------------*/
		add_filter( 'vc_edit_form_enqueue_script', array( __CLASS__, 'custom_vc_editor_script' ) );
	}
	
	
	/**
	 * Loading vc customization
	 */
	static function set_up_vc() {
		// set is as a theme
		vc_manager()->setIsAsTheme();
		
		// Disable Updater
		vc_manager()->disableUpdater();
		
		//disable frontend editor
		vc_disable_frontend();
		
		// Set default postypes where vc editor is enable.
		$post_types = array(
			'content-template',
			'page',
			'post',
			Floral_CPT_Event::CPT_SLUG,
			Floral_CPT_Service::CPT_SLUG
		);
		vc_manager()->setEditorDefaultPostTypes( $post_types );
//        vc_manager()->setEditorPostTypes( $post_types );
		
		// set custom shortcodes template dir
		vc_manager()->setCustomUserShortcodesTemplateDir( Floral_Addon::plugin_dir( __FILE__ ) . '/vc_templates' );
	}
	
	/**
	 * LOAD VC HELPERS
	 */
	static function load_helpers() {
		// load shorcode map helper
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'helpers/map-helpers.php' );
	}
	
	/**
	 * Remove use less elements of visual composers
	 */
	static function remove_useless_elements() {
		vc_remove_element( 'vc_accordion' );
		vc_remove_element( 'vc_accordion_tab' );
		vc_remove_element( 'vc_button' );
		vc_remove_element( 'vc_carousel' );
		vc_remove_element( 'vc_cta_button' );
		vc_remove_element( 'vc_cta_button2' );
		vc_remove_element( 'vc_posts_grid' );
		vc_remove_element( 'vc_cta' );
		vc_remove_element( 'vc_tab' );
		vc_remove_element( 'vc_tabs' );
		vc_remove_element( 'vc_tour' );
		vc_remove_element( 'vc_button2' );
//        vc_remove_element( 'vc_btn' );
//        vc_remove_element( 'vc_custom_heading' );
	
	}
	
	static function update_vc_icon() {
		vc_map_update( 'vc_tweetmeme', 'icon', 'w9 w9-ico-twitter' );
		vc_map_update( 'vc_column_text', 'icon', 'w9 w9-ico-basic-spread-text' );
		vc_map_update( 'vc_facebook', 'icon', 'w9 w9-ico-facebook' );
		vc_map_update( 'vc_googleplus', 'icon', 'w9 w9-ico-googleplus' );
		vc_map_update( 'vc_pinterest', 'icon', 'w9 w9-ico-basic-share' );
		vc_map_update( 'vc_toggle', 'icon', 'w9 w9-ico-arrows-question' );
		vc_map_update( 'vc_gallery', 'icon', 'w9 w9-ico-pictures' );
		vc_map_update( 'vc_images_carousel', 'icon', 'w9 w9-ico-185066-picture-streamline' );
		vc_map_update( 'vc_custom_heading', 'icon', 'w9 w9-ico-software-font-size' );
		vc_map_update( 'vc_btn', 'icon', 'w9 w9-ico-arrows-keyboard-cmd-29' );
//        vc_map_update( 'vc_cta', 'icon', 'w9 w9-ico-basic-bolt' );
		vc_map_update( 'vc_posts_slider', 'icon', 'w9 w9-ico-software-pathfinder-exclude' );
		vc_map_update( 'vc_raw_html', 'icon', 'w9 w9-ico-arrows-fit-vertical' );
		vc_map_update( 'vc_raw_js', 'icon', 'w9 w9-ico-arrows-fit-vertical' );
		vc_map_update( 'vc_flickr', 'icon', 'w9 w9-ico-185064-picture-streamline' );
		vc_map_update( 'rev_slider_vc', 'icon', 'w9 w9-ico-software-layers2' );
		vc_map_update( 'woocommerce_cart', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'woocommerce_checkout', 'icon', 'w9 w9-ico-ecommerce-banknotes' );
		vc_map_update( 'woocommerce_my_account', 'icon', 'w9 w9-ico-basic-notebook' );
		vc_map_update( 'woocommerce_order_tracking', 'icon', 'w9 w9-ico-ecommerce-bag-refresh' );
		vc_map_update( 'featured_products', 'icon', 'w9 w9-ico-ecommerce-gift' );
		vc_map_update( 'product', 'icon', 'w9 w9-ico-ecommerce-sale' );
		vc_map_update( 'products', 'icon', 'w9 w9-ico-ecommerce-sales' );
		vc_map_update( 'add_to_cart', 'icon', 'w9 w9-ico-ecommerce-bag-plus' );
		vc_map_update( 'add_to_cart_url', 'icon', 'w9 w9-ico-ecommerce-bag-cloud' );
		vc_map_update( 'product_page', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'product_category', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'product_categories', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'sale_products', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'best_selling_products', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'top_rated_products', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'product_attribute', 'icon', 'w9 w9-ico-ecommerce-bag' );
		vc_map_update( 'rev_slider', 'icon', 'w9 w9-ico-software-layers2' );
		vc_map_update( 'vc_wp_search', 'icon', 'w9 w9-ico-search' );
		vc_map_update( 'vc_wp_meta', 'icon', 'w9 w9-ico-puzzle' );
		vc_map_update( 'vc_wp_recentcomments', 'icon', 'w9 w9-ico-185079-bubble-comment-streamline-talk' );
		vc_map_update( 'vc_wp_calendar', 'icon', 'w9 w9-ico-basic-calendar' );
		vc_map_update( 'vc_wp_pages', 'icon', 'w9 w9-ico-basic-webpage-txt' );
		vc_map_update( 'vc_wp_tagcloud', 'icon', 'w9 w9-ico-pricetags' );
		vc_map_update( 'vc_wp_custommenu', 'icon', 'w9 w9-ico-menu53' );
		vc_map_update( 'vc_wp_text', 'icon', 'w9 w9-ico-basic-sheet-txt' );
		vc_map_update( 'vc_wp_posts', 'icon', 'w9 w9-ico-basic-postcard' );
		vc_map_update( 'vc_wp_categories', 'icon', 'w9 w9-ico-basic-bookmark' );
		vc_map_update( 'vc_wp_archives', 'icon', 'w9 w9-ico-basic-sheet' );
		vc_map_update( 'vc_wp_rss', 'icon', 'w9 w9-ico-basic-rss' );
	}
	
	/**
	 * Register new param type for vc
	 */
	static function register_new_param_type() {
		/*-------------------------------------
			PARAM TYPE - NUMBER
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-number.php' );
		
		/*-------------------------------------
			PARAM TYPE - MULTI SELECT
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-multi-select.php' );
		
		/*-------------------------------------
		PARAM TYPE - SINGLE SELECT
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-single-select.php' );
		
		/*-------------------------------------
			PARAM TYPE - MEDIA
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-media.php' );
		
		/*-------------------------------------
			PARAM TYPE - SWITCHER
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-switcher.php' );
		
		/*-------------------------------------
		   PARAM TYPE - BUTTONSET
	   ---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-buttonset.php' );
		
		/*-------------------------------------
		   PARAM TYPE - SLIDER
	   ---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-slider.php' );
		
		/*-------------------------------------
		   PARAM TYPE - UNIQUE CLASS
	   ---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-unique-class.php' );
		
		/*-------------------------------------
			PARAM TYPE - DATE PICKER
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-datepicker.php' );
		
		/*-------------------------------------
			CSS EDITOR LITE
		---------------------------------------*/
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'param-type/param-css_editor_lite.php' );
		
	}
	
	/**
	 * Load basic requirement of grid shortcode
	 */
	function load_grid_shortcodes() {
		//Require __core
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcodes-grid/__core/floral-grids-common.php' );
		require_once( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcodes-grid/__core/floral-gitem-template-attribute.php' );
		
		//Add grid shortcode
		foreach ( $this->shortcodes_grid as $shortcode ) {
			if ( empty( $shortcode ) ) {
				continue;
			}
			$shortcode_path = Floral_Addon::plugin_dir( __FILE__ ) . "shortcodes-grid/{$shortcode}/{$shortcode}.php";
			
			if ( file_exists( $shortcode_path ) ) {
				require_once( $shortcode_path );
			}
		}
	}
	
	/**
	 * Map shortcode of floral grid shortcode with filter
	 *
	 * @param $shortcodes
	 *
	 * @return mixed
	 */
	function load_grid_shortcodes_map( $shortcodes ) {
		foreach ( $this->shortcodes_grid as $shortcode ) {
			if ( empty( $shortcode ) ) {
				continue;
			}
			$shortcode_path = Floral_Addon::plugin_dir() . "includes/vc_customize/shortcodes-grid/{$shortcode}/{$shortcode}-map.php";
			
			if ( file_exists( $shortcode_path ) ) {
				include( $shortcode_path );
			}
		}
		
		return $shortcodes;
	}
	
	/**
	 * Config default content for post
	 *
	 * @param $content
	 * @param $post
	 *
	 * @return string
	 */
	static function default_content() {
		if ( class_exists( 'Vc_Settings' ) ) {
			$default_content_settings = Vc_Settings::get( 'default_template_post_type' );
			if ( $default_content_settings === false ) {
				$default_content_settings = array();
			}
//            var_dump($default_content_settings);
			//Set content for portfolio setting
//            if ( !isset( $default_content_settings['portfolio'] ) && floral_get_option( 'portfolio-single-default-content' ) === 'on' ) {
//                $default_content_settings['portfolio'] = 'default_templates::0';
//            }
//
//	        if ( !isset( $default_content_settings['service'] ) && floral_get_option( 'service-single-default-content' ) === 'on' ) {
//		        $default_content_settings['service'] = 'default_templates::1';
//	        }
			
			if ( ! empty( $default_content_settings ) ) {
				Vc_Settings::set( 'default_template_post_type', $default_content_settings );
			}
		}
	}
	
	/**
	 * Load all shortcodes
	 */
	function load_shortcodes() {
		// Load all shortcode class
		foreach ( $this->shortcodes as $shortcode ) {
			if ( empty( $shortcode ) ) {
				continue;
			}
			$shortcode_path = Floral_Addon::plugin_dir( __FILE__ ) . "shortcodes/{$shortcode}/{$shortcode}.php";
			
			if ( file_exists( $shortcode_path ) ) {
				require_once( $shortcode_path );
			}
		};
		
		// load shortcode map
		foreach ( $this->shortcodes as $shortcode ) {
			if ( empty( $shortcode ) ) {
				continue;
			}
			$shortcode_map_path = Floral_Addon::plugin_dir( __FILE__ ) . "shortcodes/{$shortcode}/{$shortcode}-map.php";
			if ( file_exists( $shortcode_map_path ) ) {
				require_once( $shortcode_map_path );
			}
		};
	}
	
	
	/**
	 * Enqueue front end
	 */
	static function _enqueue_front_end() {
		/*-------------------------------------
			 Enqueue default js_composer file to sure content template ok in all case
		---------------------------------------*/
		wp_enqueue_style( 'js_composer_front' );
		
		/*-------------------------------------
			REGISTER ANIMATE
		---------------------------------------*/
		wp_register_style( FLORAL_STYLE_PREFIX . 'animate', Floral_Addon::plugin_url() . 'assets/css/animate' . floral_resource_suffix() . '.css', array(), '3.5.1' );
		
		/*-------------------------------------
			VC Extends
		---------------------------------------*/
		wp_enqueue_style(
			FLORAL_STYLE_PREFIX . 'vc-extends',
			Floral_Addon::plugin_url() . 'assets/css/vc-extends' . floral_resource_suffix() . '.css',
			array(), Floral_Addon::VERSION );
	}
	
	static function _enqueue_admin() {
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-slider' );
	}
	
	static function register_custom_vc() {
		wp_register_style(
			FLORAL_STYLE_PREFIX . 'custom-vc-editor',
			Floral_Addon::plugin_url() . 'assets/css/custom-vc' . '.min' . '.css',
			array(), null );
	}
	
	static function enqueue_custom_vc() {
		wp_enqueue_style(
			FLORAL_STYLE_PREFIX . 'jquery-ui-timepicker-addon',
			Floral_Addon::plugin_url() . 'assets/vendor/jquery-timepicker-addon/jquery-ui-timepicker-addon' . '.min' . '.css',
			array(), null );
		
		wp_enqueue_script(
			FLORAL_SCRIPT_PREFIX . 'jquery-ui-timepicker-addon',
			Floral_Addon::plugin_url() . 'assets/vendor/jquery-timepicker-addon/jquery-ui-timepicker-addon.js',
			array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-slider' ), FLORAL_THEME_VERSION, true );
		
		/*-------------------------------------
			CUSTOM VC EDITOR
		---------------------------------------*/
		wp_enqueue_style( FLORAL_STYLE_PREFIX . 'custom-vc-editor' );
	}
	
	static function vc_grid_item_predefined_templates( $templates ) {
		$grid_item_predefined_templates = array();
		include ( Floral_Addon::plugin_dir( __FILE__ ) ) . 'predefined-templates/post_grid_predefined_templates.php';
		
		return $grid_item_predefined_templates;
	}
	
	
	/**
	 * Manager Visual Composet Template
	 */
	static function vc_load_default_templates( $default_template ) {
		$predefined_templates_list = array();
		include ( Floral_Addon::plugin_dir( __FILE__ ) ) . 'predefined-templates/default-content.php';
		include ( Floral_Addon::plugin_dir( __FILE__ ) ) . 'predefined-templates/page-title.php';
		include ( Floral_Addon::plugin_dir( __FILE__ ) ) . 'predefined-templates/shortcodes.php';
		include ( Floral_Addon::plugin_dir( __FILE__ ) ) . 'predefined-templates/footers.php';
		
		return $predefined_templates_list;
	}
	
	/**
	 * Manager Vc Grid Template
	 */
	static function manage_vcgrid_template() {
	
	}
	
	/**
	 * Manager Shortcode preset
	 */
	static function register_shortcode_settings_preset() {
		$presets_settings = array();
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/floral-button.php' );
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/floral-heading.php' );
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/floral-slider.php' );
//        include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/floral-testimonial.php' );
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/floral-post.php' );
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'shortcode-presets/vc-progress-bar.php' );
		
		foreach ( $presets_settings as $preset => $preset_settings ) {
			foreach ( $preset_settings as $setting ) {
				if ( ! isset( $setting['default'] ) ) {
					$setting['default'] = false;
				}
				do_action( 'vc_register_settings_preset', $setting['name'], $preset, $setting['settings'], $setting['default'] );
			}
		}
	}
	
	/**
	 * Custom vc css
	 */
	static function _print_custom_vc_css() {
		$p_color         = floral_get_option( 'primary-color' );
		$s_color         = floral_get_option( 'secondary-color' );
		$text_color      = floral_get_option( 'text-color' );
		$meta_text_color = floral_get_option( 'meta-text-color' );
		$border_color    = floral_get_option( 'border-color', 'rgba' );
		
		
		$most_used_colors = floral_get_most_used_colors( 'key_color' );
		$__css            = '';
		if ( ! empty( $most_used_colors ) && is_array( $most_used_colors ) ) {
			foreach ( $most_used_colors as $key => $color ) {
				$__css .= "div.vc_colored-dropdown .$key, div.vc_colored-dropdown .$key .select2-choice {background-color: $color !important; color: #fff;}";
				$__css .= ".select2-results li.select2-result.$key .select2-result-label {min-width: 150px}";
				$__css .= ".select2-results li.select2-result.$key .select2-result-label:after {background-color: $color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}";
			}
		}
		
		$css = <<<CSS
    div.vc_colored-dropdown select.p + .select2-container .select2-selection__rendered {
        background-color: $p_color !important;
        color: #fff;
    }
    
    div.vc_colored-dropdown select.s + .select2-container .select2-selection__rendered {
        background-color: $s_color !important;
        color: #fff;
    }
    
    div.vc_colored-dropdown select.gradient-p-to-s + .select2-container .select2-selection__rendered {
        background: -webkit-linear-gradient(left, $p_color, $s_color);
        background: -o-linear-gradient(right, $p_color, $s_color);
        background: -moz-linear-gradient(right, $p_color, $s_color);
        background: linear-gradient(to right, $p_color, $s_color); 
        color: #fff;
    }
    div.vc_colored-dropdown select.gradient-s-to-p + .select2-container .select2-selection__rendered {
        background: -webkit-linear-gradient(left, $s_color, $p_color);
        background: -o-linear-gradient(right, $s_color, $p_color);
        background: -moz-linear-gradient(right, $s_color, $p_color);
        background: linear-gradient(to right, $s_color, $p_color); 
        color: #fff;
    }
    
    div.vc_colored-dropdown select.text + .select2-container .select2-selection__rendered {
        background-color: $text_color !important;
        color: #fff;
    }
    
    div.vc_colored-dropdown select.meta-text + .select2-container .select2-selection__rendered {
        background-color: $meta_text_color !important;
        color: #fff;
    }
    
    div.vc_colored-dropdown select.border + .select2-container .select2-selection__rendered {
        background-color: $border_color !important;
        color: #222;
    }
    
    span.vc_colored .select2-results li.select2-results__option[id$="-p"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-p"]:after {background-color: $p_color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-s"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-s"]:after {background-color: $s_color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-gradient-p-to-s"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-gradient-p-to-s"]:after {        background: -webkit-linear-gradient(left, $p_color, $s_color);background: -o-linear-gradient(right, $p_color, $s_color);background: -moz-linear-gradient(right, $p_color, $s_color);background: linear-gradient(to right, $p_color, $s_color);content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-gradient-s-to-p"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-gradient-s-to-p"]:after {        background: -webkit-linear-gradient(left, $s_color, $p_color);background: -o-linear-gradient(right, $s_color, $p_color);background: -moz-linear-gradient(right, $s_color, $p_color);background: linear-gradient(to right, $s_color, $p_color);content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-text"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-text"]:after {background-color: $text_color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-meta-text"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-meta-text"]:after {background-color: $meta_text_color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    span.vc_colored .select2-results li.select2-results__option[id$="-border"] {min-width: 150px}
    span.vc_colored .select2-results li.select2-results__option[id$="-border"]:after {background-color: $border_color;content: '';display: inline-block;position: absolute;top: 0;left: 150px;width: 100%;height: 100%;}
    
    $__css
CSS;
		echo sprintf( '<style id="%scustom-vc-css">%s</style>', FLORAL_STYLE_PREFIX, floral_minify_css( $css ) );
	}
	
	/**
	 * _print_most_used_color_helper_classes
	 */
	static function _print_most_used_color_helper_classes() {
		$most_used_colors = floral_get_most_used_colors( 'key_color' );
		
		$__css = '';
		if ( ! empty( $most_used_colors ) && is_array( $most_used_colors ) ) {
			foreach ( $most_used_colors as $key => $color ) {
				$bolder  = Floral_Map_Helpers::adjust_color( $color, 'bolder' );
				$lighter = Floral_Map_Helpers::adjust_color( $color, 'lighter' );
				
				$__css .= ".$key-color {color: $color;}";
				$__css .= ".$key-hover-color:hover {color: $color;}";
				
				// bgc
				$__css .= ".$key-bgc {background-color: $color;}";
				$__css .= ".$key-hover-bgc:hover {background-color: $color;}";
				$__css .= ".$key-hover-button-bgc:hover {background-color: transparent;}";
				$__css .= ".$key-hover-button-bgc:hover:after {background-color: $color; background-image: none;}";
				// bolder
				$__css .= ".$key-bgc-bolder {background-color: $bolder;}";
				$__css .= ".$key-hover-bgc-bolder:hover {background-color: $bolder;}";
				$__css .= ".$key-hover-button-bgc-bolder:hover {background-color: transparent;}";
				$__css .= ".$key-hover-button-bgc-bolder:hover:after {background-color: $bolder; background-image: none;}";
				//lighter
				$__css .= ".$key-bgc-lighter {background-color: $lighter;}";
				$__css .= ".$key-hover-bgc-lighter:hover {background-color: $lighter;}";
				$__css .= ".$key-hover-button-bgc-lighter:hover {background-color: transparent;}";
				$__css .= ".$key-hover-button-bgc-lighter:hover:after {background-color: $lighter; background-image: none;}";
				//border
				$__css .= ".$key-border-color {border-color: $color;}";
				$__css .= ".$key-hover-border-color:hover {border-color: $color;}";
				$__css .= ".$key-hover-border-color:hover {border-color: $color;}";
				//box shadow
				$__css .= ".$key-box-shadow {-webkit-box-shadow: 0 6px $color; -moz-box-shadow: 0 6px $color;	box-shadow: 0 6px $color;}";
				$__css .= ".$key-box-shadow-bolder {-webkit-box-shadow: 0 6px $bolder; -moz-box-shadow: 0 6px $bolder;	box-shadow: 0 6px $bolder;}";
				$__css .= ".$key-box-shadow-lighter {-webkit-box-shadow: 0 6px $lighter; -moz-box-shadow: 0 6px $lighter;	box-shadow: 0 6px $lighter;}";
				// heading color
				$__css .= ".$key-heading-color h1, .$key-heading-color h2, .$key-heading-color h3, .$key-heading-color h4, .$key-heading-color h5, .$key-heading-color h6 {color: $color}";
				//link color
				$__css .= ".$key-link-color a {color: $color;}";
				$__css .= ".$key-link-hover-color a:hover, .$key-link-hover-color a:active {color: $color;}";
			}
		}
		
		echo sprintf( '<style id="%smost-used-colors">%s</style>', FLORAL_STYLE_PREFIX, floral_minify_css( $__css ) );
	}
	
	/**
	 * add_responsive_shortcode_css
	 *
	 * @param string $tablet_css
	 * @param string $mobile_css
	 */
	static function add_responsive_shortcode_css( &$tablet_css = '', &$mobile_css = '' ) {
		if ( self::$custom_shortcodes_css == null ) {
			self::$custom_shortcodes_css = array();
		}
		
		if ( ! empty( $tablet_css ) ) {
			$tablet_css                                  = @preg_replace( '/vc_custom/', 'tablet_vc_custom', $tablet_css, 1 );
			self::$custom_shortcodes_css['tablet_css'][] = $tablet_css;
		}
		
		if ( ! empty( $mobile_css ) ) {
			$mobile_css                                  = @preg_replace( '/vc_custom/', 'mobile_vc_custom', $mobile_css, 1 );
			self::$custom_shortcodes_css['mobile_css'][] = $mobile_css;
		}
	}
	
	/**
	 * add_custom_shortcode_css
	 *
	 * @param $style
	 */
	static function add_custom_shortcode_css( $style ) {
		if ( self::$custom_shortcodes_css == null ) {
			self::$custom_shortcodes_css = array();
		}
		
		if ( ! empty( $style ) ) {
			if ( is_string( $style ) ) {
				self::$custom_shortcodes_css['css'][] = $style;
			}
			
			if ( is_array( $style ) ) {
				$_css = '';
				foreach ( $style as $handler => $prop ) {
					if ( is_string( $prop ) ) {
						$_css .= sprintf( '%s {%s;}', $handler, $prop );
					}
					
					if ( is_array( $prop ) ) {
						$_css .= sprintf( '%s {%s;}', $handler, implode( '; ', $prop ) );
					}
				}
				self::$custom_shortcodes_css['css'][] = $_css;
			}
		}
	}
	
	/**
	 * print_shortcodes_css
	 */
	static function print_shortcodes_css() {
		$_css       = ( isset( self::$custom_shortcodes_css['css'] ) && is_array( self::$custom_shortcodes_css['css'] ) && ( self::$custom_shortcodes_css['css'] = array_unique( self::$custom_shortcodes_css['css'], SORT_REGULAR ) ) ) ? implode( '', self::$custom_shortcodes_css['css'] ) : '';
		$tablet_css = ( isset( self::$custom_shortcodes_css['tablet_css'] ) && is_array( self::$custom_shortcodes_css['tablet_css'] ) && ( self::$custom_shortcodes_css['tablet_css'] = array_unique( self::$custom_shortcodes_css['tablet_css'], SORT_REGULAR ) ) ) ? implode( '', self::$custom_shortcodes_css['tablet_css'] ) : '';
		$mobile_css = ( isset( self::$custom_shortcodes_css['mobile_css'] ) && is_array( self::$custom_shortcodes_css['mobile_css'] ) && ( self::$custom_shortcodes_css['mobile_css'] = array_unique( self::$custom_shortcodes_css['mobile_css'], SORT_REGULAR ) ) ) ? implode( '', self::$custom_shortcodes_css['mobile_css'] ) : '';
		if ( empty( $tablet_css ) && empty( $mobile_css ) && empty( $_css ) ) {
			return;
		}
		
		$css = <<<CSS
        $_css
        @media (max-width: 991px) and (min-width: 480px) {
            $tablet_css
        }
        
        @media (max-width: 479px) {
            $mobile_css;        
        }
CSS;
		echo sprintf( '<style>%s</style>', ( $css ) );
	}
	
	/**
	 * Include VC Edit Form EXTEND JS FOR CSS EDITOR LITE AND COLOR SELECT
	 *
	 * @param $scripts
	 *
	 * @return array
	 */
	static function custom_vc_editor_script( $scripts ) {
		$scripts[] = Floral_Addon::plugin_url() . 'assets/js/vc-edit-form-extend.js';
		
		return $scripts;
	}

	function vc_iconpicker_type_9wpthemes( $icons ) {
		return array_merge( $icons, Floral_Icons::get_theme_base_icons() );
	}
	
	function vc_iconpicker_type_floral( $icons ) {
		return array_merge( $icons, Floral_Icons::get_theme_floral_icons() );
	}
}


