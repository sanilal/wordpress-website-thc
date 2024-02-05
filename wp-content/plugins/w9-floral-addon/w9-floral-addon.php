<?php
/**
 * Plugin Name: W9 Floral Add-on
 * Plugin URI: http://floral.9wpthemes.com
 * Description: Just an add-on of Floral Premium Wordpress Theme.
 * Version: 1.0.1
 * Author: 9WPThemes Team
 * Author URI: http://9wpthemes.com
 * Requires at least: 4.4
 *
 * Text Domain: w9-floral-addon
 * Domain Path: /languages/
 *
 * @package 9WPThemes
 * @author  9WPThemes Team
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$current_theme = wp_get_theme( get_template() );
/*-------------------------------------
    YOU MUST ACTIVE FLORAL THEME TO USE THIS ADDON
---------------------------------------*/
if ( ! $current_theme->exists() || $current_theme->get_stylesheet() !== 'floral' ) {
	add_action( 'admin_notices', function () {
		?>
		<div class="updated">
			<p>
				<strong><?php _e( 'Please install and activate Floral theme to use the Floral Add-on plugin.', 'w9-floral-addon' ); ?></strong>
			</p>
			<?php
			$screen = get_current_screen();
			if ( $screen->base !== 'themes' ): ?>
				<p>
					<a href="<?php echo esc_url( admin_url( 'themes.php' ) ); ?>"><?php echo esc_html__( 'Activate theme', 'w9-floral-addon' ); ?></a>
				</p>
			<?php endif; ?>
		</div>
		<?php
	} );
	
	return;
}


if ( ! class_exists( 'Floral_Addon' ) ) :
	
	final class Floral_Addon {
		const VERSION = '1.0.1';
		
		/**
		 * Floral_Addon constructor.
		 */
		public function __construct() {
			/*-------------------------------------
				DEFINE CONSTANTS
			---------------------------------------*/
			$this->define_constants();
			
			/*-------------------------------------
				WE DO CUSTOMIZE THE VC
			---------------------------------------*/
			require_once( self::plugin_dir() . 'includes/vc_customize/class-floral-vc-customize.php' );
			new Floral_VC_Customize();
			
			/*-------------------------------------
				REGISTER NEW CUSTOM POST TYPE
			---------------------------------------*/
			add_action( 'floral_before_load_theme_options', array( $this, 'register_custom_post_type' ) );
			
			/*-------------------------------------
				INIT
			---------------------------------------*/
			add_action( 'init', array( $this, 'init' ), 50 );
			
			/*-------------------------------------
				LOAD WIDGETS
			---------------------------------------*/
			add_action( 'widgets_init', array( $this, 'register_floral_widgets' ) );
			
			/*-------------------------------------
				PLUGINS UPDATE CHECKER
			---------------------------------------*/
			self::plugin_update_checker();
		}
		
		
		/**
		 * Init the addon
		 */
		function init() {
			/*-------------------------------------
				CUSTOM MIME TYPES
			---------------------------------------*/
			add_filter( 'upload_mimes', array( $this, 'mime_types' ) );
			
			/*-------------------------------------
				LOAD TEXT DOMAIN
			---------------------------------------*/
			$this->load_text_domain();
		}
		
		/**
		 * define some constants
		 */
		function define_constants() {
			define( 'FLORAL_STYLE_PREFIX', 'floral-style-' );
			define( 'FLORAL_SCRIPT_PREFIX', 'floral-script-' );
			define( 'FLORAL_SC_PREFIX', 'floral_shortcode_' );
			define( 'FLORAL_SC_CATEGORY', 'Floral Elements' );
			define( 'FLORAL_PORTFOLIO_SC_CATEGORY', 'Floral Portfolio' );
		}
		
		/**
		 * Load libs
		 */
		function load_libraries() {
			/*-------------------------------------
				LOAD WPALCHEMY METABOX
			---------------------------------------*/
			if ( ! class_exists( 'WPAlchemy_MetaBox' ) ) {
				require_once self::plugin_dir() . 'includes/library/wpalchemy/MetaBox.php';
				require_once self::plugin_dir() . 'includes/library/wpalchemy/MediaAccess.php';
			}
		}
		
		/**
		 * Load text domain
		 */
		function load_text_domain() {
			load_plugin_textdomain( 'w9-floral-addon', false, self::plugin_dir() . 'languages/' );
		}
		
		/**
		 * Custom mime types
		 *
		 * @param $mimes
		 *
		 * @return mixed
		 */
		function mime_types( $mimes ) {
			$mimes['eot']  = 'application/vnd.ms-fontobject';
			$mimes['woff'] = 'application/x-font-woff';
			$mimes['ttf']  = 'application/x-font-truetype';
			$mimes['svg']  = 'image/svg+xml';
			
			return apply_filters( 'floral-addon/mime-types', $mimes );
		}
		
		
		/**
		 * Register Widget
		 *
		 * Name the widget class and its file follow this rule: Floral_Widget_{your_widget_name},
		 * class-floral-widget-{your_widget_name}.php then place it in the widgets folder.
		 *
		 * Your widget class need to extends the Floral_Widget_Base class.
		 *
		 * Add your widget class name to $widgets if you want to register it.
		 */
		function register_floral_widgets() {
			$widgets = array(
				'Floral_Widget_Posts',
				'Floral_Widget_FB_Page',
				'Floral_Widget_Social_Profiles',
				'Floral_Widget_Logo',
				'Floral_Widget_Menu',
				'Floral_Widget_Tag_Cloud',
				'Floral_Widget_Download',
				'Floral_Widget_Simple_Calendar',
				'Floral_Widget_Post_Author',
//                'Floral_Widget_Image_Info',
//                'Floral_Widget_MailChimp',
				'Floral_Widget_Twitter',
				'Floral_Widget_Shop_Account'
			);
			
			require_once( self::plugin_dir() . 'includes/widgets/class-floral-widget-base.php' );
			foreach ( $widgets as $widget ) {
				$widget_sanitized = strtolower( str_replace( '_', '-', $widget ) );
				if ( file_exists( self::plugin_dir() . 'includes/widgets/class-' . $widget_sanitized . '.php' ) ) {
					require_once( self::plugin_dir() . 'includes/widgets/class-' . $widget_sanitized . '.php' );
					register_widget( $widget );
				}
			}
		}
		
		/**
		 * Register new cpt
		 */
		function register_custom_post_type() {
			/*-------------------------------------
				   LOAD LIBRARY
			   ---------------------------------------*/
//            $this->load_libraries();
			
			/*-------------------------------------
				JUST REGISTER NEW CUSTOM POST TYPE
			---------------------------------------*/
			// CPT BASE ABSTRACT
			require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-base.php' );
			
			// CPT CONTENT TEMPLATE
			require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-content-template.php' );
			
			// CPT PORTFOLIO
//            require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-portfolio.php' );
			
			// CPT SERVICE
			require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-service.php' );
			
			// CPT EVENT
			require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-event.php' );
			
			// CPT REVIEW
//			require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-review.php' );
			
			// CPT THEME DEMO
//            require_once( self::plugin_dir() . 'includes/custom-post-type/class-floral-cpt-theme-demo.php' );
			
			// flush_rewrite_rules
			flush_rewrite_rules();
		}
		
		/**
		 * Plugin update checker
		 */
		static function plugin_update_checker() {
			require self::plugin_dir() . 'includes/library/plugin-update-checker/plugin-update-checker.php';
			PucFactory::buildUpdateChecker(
				'http://9wpthemes.com/wp-content/uploads/wp-updates/?action=get_metadata&slug=w9-floral-addon',
				__FILE__
			);
		}
		
		static function require_floral_color( $once = true ) {
			if ( $once ) {
				require_once Floral_Addon::plugin_dir() . 'includes/library/phpColors/Color.php';
			} else {
				require Floral_Addon::plugin_dir() . 'includes/library/phpColors/Color.php';
			}
		}
		
		static function plugin_dir( $file = __FILE__ ) {
			return trailingslashit( plugin_dir_path( $file ) );
		}
		
		static function plugin_url( $file = __FILE__ ) {
			return trailingslashit( plugin_dir_url( $file ) );
		}
		
		static function is_vc_active() {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			
			return is_plugin_active( 'js_composer/js_composer.php' );
		}
		
		static function is_woocommerce_active() {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			
			return is_plugin_active( 'woocommerce/woocommerce.php' );
		}
	}
	
	new Floral_Addon();
endif;


