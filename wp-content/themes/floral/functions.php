<?php
/**
 * _9WPThemes class
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package 9WPThemes
 */

/**
 * Is in dev mode or not?
 * @return bool
 */
function floral_is_dev_mode() {
    return ( defined( 'FLORAL_DEV_MODE' ) && FLORAL_DEV_MODE ) || ( isset($_GET['floral_dev_mode']) );
}

/**
 * Get theme directory
 * @return string
 */
function floral_theme_dir() {
    return trailingslashit( get_template_directory() );
}

/**
 * Get theme url
 * @return string
 */
function floral_theme_url() {
    return trailingslashit( get_template_directory_uri() );
}


// Init the theme object
$GLOBALS['floral'] = Floral();

/**
 * Class Floral_By_9WPThemes
 */
class Floral_By_9WPThemes {
    //singleton implementation
    private static $instance;
    
    /**
     * @var Floral_Templates
     */
    public $templates;
    /**
     * @var Floral_Options
     */
    public $options;
    /**
     * @var Floral_Metaboxes
     */
    public $metaboxes;
    
    /**
     * @var Floral_Breadcrumb
     */
    public $breadcrumb;
    
    
    /** get single-ton instance
     * @return Floral_By_9WPThemes
     */
    public static function get_instance() {
        if ( self::$instance == null ) {
            self::$instance = new self;
        }
        
        return self::$instance;
    }
    
    /**
     * Floral_By_9WPThemes constructor.
     */
    private function __construct() {
        $this->define_constants();
        
        $this->check_php_version();
        
        spl_autoload_register( array( $this, 'autoload_classes' ) );
        
        $this->helpers();
        
        $this->load_current_preset();
        
        $this->load_theme_options_data();
        
        $this->theme_setup();
        
        $this->after_theme_setup();
        
        $this->create_common_objects();
        
        $this->add_9wpthemes_admin_panel();
        
        $this->theme_update_checker();
        
    }
    
    private function define_constants() {
        define( 'FLORAL_THEME_OPTIONS_DEFAULT_NAME', 'floral_options' );
        define( 'FLORAL_THEME_OPTIONS_VAR', 'floral_options' );
    
        define( 'FLORAL_PRESET_LIST_KEY', 'floral_preset_list' );
        define( 'FLORAL_GLOBAL_PRESET_KEY', 'floral_global_preset' );
        define( 'FLORAL_THEME_VERSION', wp_get_theme()->get( 'Version' ) );
    }
    
    /**
     * Autoloader
     *
     * Automatically load files when their classes are required.
     */
    private function autoload_classes( $class_name ) {
        if ( class_exists( $class_name ) ) {
            return;
        }
        // sanitize the class name
        $class_name = strtolower( str_replace( '_', '-', $class_name ) );
        
        $class_path = floral_theme_dir() . 'includes/class/class-' . $class_name . '.php';
        
        if ( file_exists( $class_path ) ) {
            require_once( $class_path );
        }
    }
    
    
    /**
     * Load helper functions
     */
    private function helpers() {
        /*-------------------------------------
        	Custom functions that act independently of the theme templates.
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/extras.php' );
        
        /*-------------------------------------
        	Import image resize functions
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/library/resize/floral-resize.php' );
        
        /*-------------------------------------
        	PRESET MANAGE HELPER
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/helpers-preset.php' );
        
    }
    
    /**
     * Add 9WPThemes Wordpress admin panel
     */
    private function add_9wpthemes_admin_panel() {
        require_once( floral_theme_dir() . 'includes/admin-panel/class-floral-admin-panel.php' );
        new Floral_Admin_Panel();
    }
    
    private function check_php_version() {
        $php_version = phpversion();
        if ( version_compare( $php_version, '5.4' ) == - 1 ) {
            echo '<h3>' . wp_get_theme()->get( 'Name' ) . ' Wordpress Theme developed by 9WPThemes Team is no longer support PHP version lower than 5.4. </h3>';
            echo '<p>- You site is currently using php version <strong>' . $php_version . '</strong>.</p>';
            echo '<p>- Please contact your hosting provider or server administrator to upgrade php version.</p>';
            echo '<p>- Read more about <a href="https://wordpress.org/about/requirements/">Wordpress Requirement</a>.</p>';
            wp_die();
        }
    }
    
    /**
     * Setup the theme
     */
    private function theme_setup() {
        /*-------------------------------------
        	Required Plugins for this theme
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/theme-required-plugins.php' );
        
        /*-------------------------------------
        	Theme Setup
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/theme-setup.php' );
    }
    
    private function after_theme_setup() {
        /*-------------------------------------
        	Create extra widget options
        ---------------------------------------*/
        new Floral_Extra_Widget_Options();
        
        /*-------------------------------------
        	Create user profile field
        ---------------------------------------*/
        new Floral_User_Social_Profile();
        
        /*-------------------------------------
        	Register sidebars
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/theme-sidebars.php' );
        
        /*-------------------------------------
        	Include tax meta
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/theme-tax-meta.php' );
        
        
        new Floral_Common();
        
        new Floral_Wrap();
        
        new Floral_Blog();
        
        new Floral_AJAX();
        
        new Floral_Menu();
        
        new Floral_Enqueue();
        
        new Floral_Image();
        
        if ( floral_is_woocommerce_active() ) {
            new Floral_Woocommerce();
        }
    }
    
    private function load_current_preset() {
        $preset_list = floral_get_preset_list();
        
        // clean-up
        if ( empty( $preset_list ) || !is_array( $preset_list ) ) {
            $preset_list = array(
                FLORAL_THEME_OPTIONS_DEFAULT_NAME => esc_html__( 'Default Preset', 'floral' ),
            );
            set_theme_mod( FLORAL_PRESET_LIST_KEY, $preset_list );
        } else {
            // if the preset list does not contain the default => create one
            if ( !array_key_exists( FLORAL_THEME_OPTIONS_DEFAULT_NAME, $preset_list ) ) {
                set_theme_mod( FLORAL_PRESET_LIST_KEY, array_merge( array(
                    FLORAL_THEME_OPTIONS_DEFAULT_NAME => esc_html__( 'Default Preset', 'floral' ),
                ), $preset_list ) );
            }
        }
        
        if ( is_admin() && !empty( $_REQUEST['opt_name'] ) ) {
            $floral_current_preset = $_REQUEST['opt_name'];
            if ( !array_key_exists( $floral_current_preset, $preset_list ) ) {
                $floral_current_preset = FLORAL_THEME_OPTIONS_DEFAULT_NAME;
            }
            
            // change after, using js
            if ( isset( $_REQUEST['make_global'] ) ) {
//                set_theme_mod( FLORAL_GLOBAL_PRESET_KEY, $floral_current_preset );
                floral_set_global_preset( $floral_current_preset );
            }
        } else {
            $floral_current_preset = floral_get_global_preset();
            
            if ( $floral_current_preset === false || !array_key_exists( $floral_current_preset, $preset_list ) ) {
                $floral_current_preset = FLORAL_THEME_OPTIONS_DEFAULT_NAME;
                floral_set_global_preset( $floral_current_preset );
            }
        }
        
        // define theme options name
        global $floral_global_preset_name;
        $floral_global_preset_name = $floral_current_preset;
    }
    
    private function load_theme_options_data() {
        /*-------------------------------------
            Helper functions
        ---------------------------------------*/
        require_once( floral_theme_dir() . 'includes/common/helpers-options.php' );
        
        /*-------------------------------------
            BEFORE LOAD THEME OPTIONS
        ---------------------------------------*/
        do_action( 'floral_before_load_theme_options' );
        
        /*-------------------------------------
        	Load metabox options
        ---------------------------------------*/
        if ( !class_exists( 'ReduxFramework_extension_metaboxes' ) ) {
            require_once( floral_theme_dir() . 'includes/library/floral-option-extensions/extensions-init.php' );
        }
        
        // switch_theme_options_by_meta
        $this->switch_theme_options_by_meta();
        
        $this->metaboxes = new Floral_Metaboxes();
        
        /*-------------------------------------
        	Load theme options
        ---------------------------------------*/
        if ( !class_exists( 'ReduxFramework' ) ) {
            require_once( floral_theme_dir() . 'includes/library/floral-option-framework/class-floral-option-framework.php' );
            FloralOptionFramework::instance();
        }
        $this->options = new Floral_Options();
    }
    
    /**
     * switch_theme_options_by_meta
     */
    function switch_theme_options_by_meta() {
        // load preset from metabox or from $_GET
        if ( !is_admin() ) {
            $use_preset = isset( $_GET['use-preset'] ) ? sanitize_title( $_GET['use-preset'] ) : '';
            if ( !empty( $use_preset ) && floral_is_preset_exist( $use_preset ) ) {
                floral_set_current_preset( $use_preset );
            } else {
                if ( class_exists( 'ReduxFramework_extension_metaboxes' ) ) {
                    $post_id = ReduxFramework_extension_metaboxes::get_current_post_id();
                    
                    if ( !empty( $post_id ) ) {
                        $meta_preset = get_post_meta( $post_id, 'meta-using-preset', true );
                        if ( !empty( $meta_preset ) ) {
                            if ( floral_is_preset_exist( $meta_preset ) ) {
                                floral_set_current_preset( $meta_preset );
                            } else {
                                delete_post_meta( $post_id, 'meta-using-preset' );
                            }
                        }
                    }
                }
            }
        }
    }
    
    /**
     * create_common_objects
     */
    private function create_common_objects() {
        $this->templates  = new Floral_Templates();
        $this->breadcrumb = new Floral_Breadcrumb();
    }
    
    
    /**
     * theme_update_checker
     */
    private function theme_update_checker() {
        require floral_theme_dir() . 'includes/library/theme-updates/theme-update-checker.php';
        $theme_slug = get_template();
        new ThemeUpdateChecker(
            $theme_slug, //Theme slug. Usually the same as the name of its directory.
            'http://9wpthemes.com/wp-content/uploads/wp-updates/?action=get_metadata&slug=' . $theme_slug  //Metadata URL.
        );
    }
}

/**
 * @return Floral_By_9WPThemes
 */
function Floral() {
    return Floral_By_9WPThemes::get_instance();
}

//
// USE THESE FUNCTION IN ACTION, FILTER OR IN THEME TEMPLATE
//
/**
 * @return Floral_Options
 */
function Floral_Options() {
    return Floral()->options;
}


/**
 * @return Floral_SCSS
 */
function Floral_SCSS() {
    return Floral_Options()->compiler;
}


/**
 * @return Floral_Metaboxes
 */
function Floral_Metaboxes() {
    return Floral()->metaboxes;
}

/**
 * @return Floral_Variables
 */
function Floral_Variables() {
    return Floral_Options()->variables;
}

/**
 * @return Floral_Breadcrumb
 */
function Floral_Breadcrumb() {
    return Floral()->breadcrumb;
}

/**
 * @return Floral_Templates
 */
function Floral_Templates() {
    return Floral()->templates;
}

/**
 * @param       $slug
 * @param null  $name
 * @param array $args
 */
function floral_get_template_part( $slug, $name = null, $args = array() ) {
    Floral_Templates()->get_template_part( $slug, $name, $args );
}


// load dev mode config, remove this when deploy
if ( file_exists( floral_theme_dir() . 'includes/common/dev_mode_config.php' ) ) {
    require_once( floral_theme_dir() . 'includes/common/dev_mode_config.php' );
}