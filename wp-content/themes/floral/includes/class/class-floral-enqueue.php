<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-enqueue.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Enqueue extends Floral_Base {
	/*
	 * Just the prefix
	 */
	const STYLE_PREFIX = 'floral-style-';
	const SCRIPT_PREFIX = 'floral-script-';
	
	
	/**
	 * Floral_Enqueue constructor.
	 */
	public function __construct() {
		parent::__construct();
	}
	
	protected function add_actions() {
		//admin
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_styles' ), 100 );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_scripts' ), 100 );
		//front-end
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_front_end_styles' ), 100 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_front_end_scripts' ), 100 );
		
		// custom redux output
//        add_action( 'wp_head', array( __CLASS__, 'custom_redux_output' ), 300 );
		
		
		//user custom css
		add_action( 'wp_head', array( __CLASS__, 'output_custom_singular_style' ), 300 );
		add_action( 'wp_head', array( __CLASS__, 'output_user_custom_css' ), 999 );
		add_action( 'wp_footer', array( __CLASS__, 'output_user_custom_js' ), 999 );
		
		//custom redux style
		add_action( 'redux-enqueue-' . floral_get_current_preset(), array( __CLASS__, 'enqueue_redux_custom' ) );
		add_action( 'redux/metaboxes/' . floral_get_current_preset() . '/enqueue', array(
			__CLASS__,
			'enqueue_redux_custom'
		) );
		
		add_action( 'redux-enqueue-' . floral_get_current_preset(), array( __CLASS__, 'enqueue_redux_custom_script' ) );
//        add_action( 'redux/page/' . floral_get_current_preset() . '/enqueue', array() );
	}
	
	
	static function enqueue_front_end_styles() {
		global $post;
		/*-------------------------------------
			FONT AWESOME
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'font-awesome',
			floral_theme_url() . 'assets/vendor/font-awesome-4.6.1/css/font-awesome' . floral_resource_suffix() . '.css',
			array(),
			'4.6.1' );
		
		/*-------------------------------------
			9WPTHEME ICONS
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . '9wpthemes-icons',
			floral_theme_url() . 'assets/vendor/_9wpthemes-icons/styles' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		
		/*-------------------------------------
			FLORAL ICONS
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'floral-icons',
			floral_theme_url() . 'assets/vendor/floral-icons/styles' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		
		
		/*-------------------------------------
			PLUGINS VENDOR INCLUDE INE ONE FILE
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'vendor',
			floral_theme_url() . 'assets/css/vendor' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		
		/*-------------------------------------
			SLICK CAROUSEL FOR WOOCOMMERCE MODULE
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'slick-carousel',
			floral_theme_url() . 'assets/vendor/slick-carousel/slick' . floral_resource_suffix() . '.css',
			array(), FLORAL_THEME_VERSION );
		
		
		/*-------------------------------------
			PANEL SELECTOR
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'panel-selector',
			floral_theme_url() . 'assets/css/panel-selector' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		
		/*-------------------------------------
			FULLPAGE
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'fullpage',
			floral_theme_url() . 'assets/vendor/fullPage_js/jquery.fullpage' . floral_resource_suffix() . '.css',
			array(),
			'2.8.2' );
		
		/*-------------------------------------
			RTL CSS
		---------------------------------------*/
		if ( floral_is_rtl() || is_rtl() ) {
			wp_register_style(
				self::STYLE_PREFIX . 'rtl',
				floral_theme_url() . 'rtl' . floral_resource_suffix() . '.css',
				array(),
				FLORAL_THEME_VERSION );
		}
		
		/*-------------------------------------
			THIS THEME STYLESHEET
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'main',
			floral_get_current_blog_css_file_path(),
			array(),
			FLORAL_THEME_VERSION );
		
		/*-------------------------------------
			THIS THEME STYLESHEET
		---------------------------------------*/
		
		
		// Enqueue all of them
		wp_enqueue_style( self::STYLE_PREFIX . 'font-awesome' );
		wp_enqueue_style( self::STYLE_PREFIX . '9wpthemes-icons' );
		wp_enqueue_style( self::STYLE_PREFIX . 'floral-icons' );
		wp_enqueue_style( self::STYLE_PREFIX . 'vendor' );
		
//		if ( in_array( 'woocommerce', get_body_class() ) || in_array( 'woocommerce-page', get_body_class() ) ) {
//			wp_enqueue_style( self::STYLE_PREFIX . 'slick-carousel' );
//		}
		
		if ( floral_get_option( 'panel-selector' ) == 1 ) {
			wp_enqueue_style( self::STYLE_PREFIX . 'panel-selector' );
		}
		
		if ( floral_get_meta_option( 'slipscreen', '', '', 0 ) ) {
			wp_enqueue_style( self::STYLE_PREFIX . 'fullpage' );
		}
		
		wp_enqueue_style( self::STYLE_PREFIX . 'main' );
		
		if ( floral_is_rtl() || is_rtl() ) {
			wp_enqueue_style( self::STYLE_PREFIX . 'rtl' );
		}
	}
	
	static function enqueue_front_end_scripts() {
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'vendor',
			floral_theme_url() . 'assets/js/vendor' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		/*-------------------------------------
			SLICK CAROUSEL FOR WOOCOMMERCE MODULE
		---------------------------------------*/
		wp_register_script(
			self::SCRIPT_PREFIX . 'slick-carousel',
			floral_theme_url() . 'assets/vendor/slick-carousel/slick' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'smooth-scroll',
			floral_theme_url() . 'assets/vendor/smooth-scroll/SmoothScroll' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'panel-selector',
			floral_theme_url() . 'assets/js/panel-selector.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'jquery.mouse-wheel',
			floral_theme_url() . 'assets/vendor/mouse-wheel/jquery.mousewheel' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'jquery.fullpage',
			floral_theme_url() . 'assets/vendor/fullPage_js/jquery.fullpage' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'jquery.fullpage-helper',
			floral_theme_url() . 'assets/vendor/fullPage_js/scrolloverflow' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );
		
		wp_register_script(
			self::SCRIPT_PREFIX . 'main',
			floral_theme_url() . 'assets/js/main' . floral_resource_suffix() . '.js',
			array('jquery'), FLORAL_THEME_VERSION, true );

//      enqueue them all
//		wp_  enqueue  _script( 'jquery' );
		
		/*-------------------------------------
			Vendor
		---------------------------------------*/
		wp_enqueue_script( self::SCRIPT_PREFIX . 'vendor' );
		
		/*-------------------------------------
			SLICK
		---------------------------------------*/
//		if ( in_array( 'woocommerce', get_body_class() ) || in_array( 'woocommerce-page', get_body_class() ) ) {
//			wp_enqueue_script( self::SCRIPT_PREFIX . 'slick-carousel' );
//		}
		
		/*-------------------------------------
			SMOOTH SCROLL
		---------------------------------------*/
		if ( floral_get_option( 'smooth-scroll' ) == '1' ) {
			wp_enqueue_script( self::SCRIPT_PREFIX . 'smooth-scroll' );
		}
		/*-------------------------------------
			COMMENT REPLY
		---------------------------------------*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
//		if ( floral_get_option( 'panel-selector' ) == 1 ) {
//			wp_enqueue_script( self::SCRIPT_PREFIX . 'panel-selector' );
//		}
		
		if ( floral_get_meta_option( 'slipscreen', '', '', 0 ) ) {
			wp_enqueue_script( self::SCRIPT_PREFIX . 'jquery.fullpage-helper' );
			wp_enqueue_script( self::SCRIPT_PREFIX . 'jquery.fullpage' );
		}
		
		wp_enqueue_script( self::SCRIPT_PREFIX . 'main' );
		wp_localize_script( self::SCRIPT_PREFIX . 'main', 'floral_main_vars',
			array(
				'ajax_url'                           => admin_url( 'admin-ajax.php' ),
				'floral_theme_url'                   => floral_theme_url(),
				'floral_sticky_show_up'              => floral_get_option( 'nav-sticky-show-up', 'top', '' ),
				'floral_scroll_set_submenu_position' => floral_get_option( 'scroll-set-submenu-position', '', 1 ),
				'error_message'                      => esc_html__( '<span style="color: red;">There was an unexpected error occurred!</span>', 'floral' )
			)
		);
	}
	
	static function enqueue_admin_styles() {
		wp_register_style( self::STYLE_PREFIX . 'select2', floral_theme_url() . 'assets/vendor/select2/css/select2' . floral_resource_suffix() . '.css', array(), FLORAL_THEME_VERSION );
		wp_register_style( self::STYLE_PREFIX . 'style-admin', floral_theme_url() . 'assets/css/style-admin' . floral_resource_suffix() . '.css', array(), FLORAL_THEME_VERSION );
		/*-------------------------------------
		   FONT AWESOME
	   ---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'font-awesome',
			floral_theme_url() . 'assets/vendor/font-awesome-4.6.1/css/font-awesome' . floral_resource_suffix() . '.css',
			array(), '4.6.1' );
		
		/*-------------------------------------
			9WPTHEME ICONS
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . '9wpthemes-icons',
			floral_theme_url() . 'assets/vendor/_9wpthemes-icons/styles' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		/*-------------------------------------*/
		
		/*-------------------------------------
			FLORAL ICONS
		---------------------------------------*/
		wp_register_style(
			self::STYLE_PREFIX . 'floral-icons',
			floral_theme_url() . 'assets/vendor/floral-icons/styles' . floral_resource_suffix() . '.css',
			array(),
			FLORAL_THEME_VERSION );
		/*-------------------------------------*/
		
		wp_enqueue_style( self::STYLE_PREFIX . 'font-awesome' );
		wp_enqueue_style( self::STYLE_PREFIX . '9wpthemes-icons' );
		wp_enqueue_style( self::STYLE_PREFIX . 'floral-icons' );
		// check for redux select2-css
		if ( ! wp_style_is( 'select2-css' ) ) {
			wp_enqueue_style( self::STYLE_PREFIX . 'select2' );
		}
		wp_enqueue_style( self::STYLE_PREFIX . 'style-admin' );
		
		/*-------------------------------------
		     COLOR PICKER
		---------------------------------------*/
		wp_enqueue_style( 'wp-color-picker' );
		
		/*-------------------------------------
		     JQUERY-UI-DIALOG
		---------------------------------------*/
		wp_enqueue_style('wp-jquery-ui-dialog');
	}
	
	/**
	 * Redux Custom
	 */
	static function enqueue_redux_custom() {
		/*-------------------------------------
		  CUSTOM REDUX STYLE
		---------------------------------------*/
		wp_dequeue_style( 'redux-admin-css' );
		wp_register_style(
			self::STYLE_PREFIX . 'redux-admin-css',
			floral_theme_url() . 'assets/css/custom-redux-admin' . '.min' . '.css',
			array() );
		wp_enqueue_style( self::STYLE_PREFIX . 'redux-admin-css' );
		
		wp_dequeue_style( 'redux-fields-css' );
		wp_register_style(
			self::STYLE_PREFIX . 'redux-fields-css',
			floral_theme_url() . 'assets/css/custom-redux-fields' . '.min' . '.css',
			array() );
		wp_enqueue_style( self::STYLE_PREFIX . 'redux-fields-css' );
		
		wp_dequeue_style( 'jquery-ui-css' );
		wp_register_style(
			self::STYLE_PREFIX . 'jquery-ui-css',
			floral_theme_url() . 'assets/css/custom-redux-jquery-ui' . '.min' . '.css',
			array() );
		wp_enqueue_style( self::STYLE_PREFIX . 'jquery-ui-css' );
	}
	
	/**
	 * Enqueue redux custom script
	 */
	static function enqueue_redux_custom_script() {
		wp_register_script( self::SCRIPT_PREFIX . 'redux-extend',
			floral_theme_url() . 'assets/js/main-redux-extend.js',
			array(),
			FLORAL_THEME_VERSION, true );
		
		
		wp_enqueue_script( self::SCRIPT_PREFIX . 'redux-extend' );
		wp_localize_script( self::SCRIPT_PREFIX . 'redux-extend', 'floral_redux_extend_vars',
			array(
				'validation_error_message'      => '<span class="message" style="color: red;">' . esc_html__( 'Invalid preset name, please try an other one!', 'floral' ) . '</span>',
				'error_message'                 => '<span class="message" style="color: red;">' . esc_html__( 'There was an unexpected error occurred!', 'floral' ) . '</span>',
				'confirm_remove_preset_message' => esc_html__( 'Are you sure to remove this preset?', 'floral' )
			)
		);
	}
	
	/**
	 * Enqueue admin script
	 */
	static function enqueue_admin_scripts() {
		wp_register_script( self::SCRIPT_PREFIX . 'select2', floral_theme_url() . 'assets/vendor/select2/js/select2.full.min.js', array(), FLORAL_THEME_VERSION, true );
		wp_register_script( self::SCRIPT_PREFIX . 'main-admin', floral_theme_url() . 'assets/js/main-admin' . floral_resource_suffix() . '.js', array(), FLORAL_THEME_VERSION, true );
		
		
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		} else {
			wp_enqueue_script( 'media-upload' );
		}
		
		//Use for icon picker and ...
		wp_enqueue_script( 'jquery-ui-dialog' );
		// check for redux select2
		if ( ! wp_script_is( 'select2-js' ) ) {
			wp_enqueue_script( self::SCRIPT_PREFIX . 'select2' );
		}
		wp_enqueue_script( self::SCRIPT_PREFIX . 'main-admin' );
		wp_localize_script( self::SCRIPT_PREFIX . 'main-admin', 'floral_main_admin_vars',
			array(
				'ajax_url'         => admin_url( 'admin-ajax.php' ),
				'floral_theme_url' => floral_theme_url(),
			)
		);
		
		/*-------------------------------------
		    COLOR PICKER
		---------------------------------------*/
		wp_enqueue_script( 'wp-color-picker' );
	}
	
	static function output_user_custom_css() {
		$user_custom_css = floral_get_option( 'custom-css' );
		if ( $user_custom_css ) {
			try {
				$variables = Floral_Variables()->get_variables();
				Floral_SCSS()->set_variables( $variables );
				$formatter = floral_resource_suffix() ? 'compressed' : 'expanded';
				Floral_SCSS()->compiler->setLineNumberStyle( null );
				Floral_SCSS()->compiler->setFormatter( 'Leafo\ScssPhp\Formatter\\' . ( $formatter ? ucfirst( $formatter ) : 'Nested' ) );
				$css = Floral_SCSS()->compiler->compile( $user_custom_css );
				
				echo sprintf( '<style id="%suser-custom-css">%s</style>', self::STYLE_PREFIX, floral_resource_suffix() ? floral_minify_css( $css ) : $css );
			} catch ( Exception $e ) {
				echo sprintf( '<style id="%suser-custom-css">/* %s */ %s</style>', self::STYLE_PREFIX, $e->getMessage(), floral_resource_suffix() ? floral_minify_css( $user_custom_css ) : $user_custom_css );
			}
		}
	}
	
	static function output_user_custom_js() {
		$user_custom_js = floral_get_option( 'custom-js' );
		if ( $user_custom_js ) {
			echo sprintf( '<script id="%suser-custom-js">%s</script>', self::SCRIPT_PREFIX, floral_resource_suffix() ? floral_minify_js( $user_custom_js ) : $user_custom_js );
		}
	}
	
	static function output_custom_singular_style() {
		$variables = Floral_Variables()->get_variables();
		
		$custom_style_file = floral_theme_dir() . 'assets/scss/custom-style.scss';
		Floral_SCSS()->set_variables( $variables );
		$formatter = floral_resource_suffix() ? 'compressed' : 'expanded';
		$css       = Floral_SCSS()->compile( $custom_style_file, false, $formatter );
		
		echo sprintf( '<style id="%scustom-style">%s</style>', self::STYLE_PREFIX, $css );
	}
}