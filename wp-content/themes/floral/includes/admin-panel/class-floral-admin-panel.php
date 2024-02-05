<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-admin-panel.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Admin_Panel {
    public $minimum_capability = 'manage_options';
    public $menu_slug = '_9wpthemes';
    
    public static $args;
    
    function __construct( $args = array() ) {
        $current_theme = wp_get_theme();
        if ( is_child_theme() ) {
            $current_theme = wp_get_theme( $current_theme->Template );
        }
        
        $default = array(
            'theme_name'                => $current_theme->get( 'Name' ),
            'theme_version'             => $current_theme->get( 'Version' ),
            'theme_url'                 => $current_theme->get( 'ThemeURI' ),
            'author'                    => $current_theme->get( 'Author' ),
            'author_url'                => $current_theme->get( 'AuthorURI' ),
            // general
            '9wptheme_logo_url'         => floral_theme_url() . 'includes/admin-panel/assets/images/_9wpthemes-logo.png',
            'theme_logo_url'            => floral_theme_url() . 'includes/admin-panel/assets/images/theme_logo_9wp.jpg',
            'footer_rating_url'         => 'https://themeforest.net/downloads',
            'intro_content'             => esc_html__( 'Floral is a surprisingly High Performance Multipurpose WordPress Theme suited for beauty salons, spa, massage and other health and beauty related websites. Great effort was put into making it easy to use and to be totally flexible and customizable theme. ', 'floral' ),
            //about
            'support_url'               => 'https://9wpthemes.ticksy.com/submit/',
            'docs_url'                  => 'http://docs.9wpthemes.com/floral-documentation',
            'knowledgebase_url'         => 'http://www.9wpthemes.com/knowledgebase/',
            'video_tuts_url'            => 'https://www.youtube.com/channel/UCz-OBNZNTDDamQWbkYk9vrQ',
            'fb_url'                    => 'https://www.facebook.com/9wpthemes',
            'tw_url'                    => 'https://twitter.com/themes_9',
            //changelog file
            'changelog_path'            => floral_theme_dir() . 'changelog.html',
            '9wpthemes-server-ajax-url' => 'http://9wpthemes.com/wp-admin/admin-ajax.php?activate-multi=true',
            '9wpthemes-server-rest-api' => 'http://9wpthemes.com/wp-json/wp/v2/',
//            '9wpthemes-server-rest-api' => 'http://localhost/wp/wp-9wpthemes/wp-json/wp/v2/',
//            '9wpthemes-server-ajax-url' => 'http://localhost/wp/wp-9wpthemes/wp-admin/admin-ajax.php'
        );
        
        self::$args = wp_parse_args( $args, $default );
        
        add_action( 'init', array( $this, 'init' ) );
        
        add_action( 'wp_ajax_nopriv_load_theme_product', array( __CLASS__, 'load_theme_product_using_rest_api' ) );
        add_action( 'wp_ajax_load_theme_product', array( __CLASS__, 'load_theme_product_using_rest_api' ) );
    }
    
    public function init() {
        $this->define_constants();
        
        /*
         * INCLUDE FLORAL DEMO INSTALLER
         */
        require_once floral_theme_dir() . 'includes/admin-panel/floral-install-demo/class-floral-demo-installer.php';
        
        /*
         * INCLUDE EXPORTER
         */
        require_once floral_theme_dir() . 'includes/admin-panel/floral-install-demo/class-floral-exporter.php';
        
        
        add_action( 'admin_menu', array( $this, 'admin_menus' ) );
        add_filter( 'admin_footer_text', array( $this, 'footer_info' ) );
        if ( isset( $_GET['page'] ) && $_GET['page'] == $this->menu_slug ) {
            remove_all_actions( 'admin_notices' );
            add_action( 'admin_enqueue_scripts', array( $this, '_enqueue' ) );
        }
        
        add_action( 'after_switch_theme', function () {
            wp_redirect( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=about' ) );
        } );
        
    }
    
    function define_constants() {
        define( 'FLORAL_DEMO_DATA_PATH', trailingslashit( floral_theme_dir() . 'includes/admin-panel/assets/demo-data' ) );
        define( 'FLORAL_DEMO_DATA_URL', trailingslashit( floral_theme_url() . 'includes/admin-panel/assets/demo-data' ) );
    }
    
    /**
     * Register admin menus
     */
    public function admin_menus() {
        // add top lvl menus
        $menu_page = 'add_menu_' . 'page';
        $menu_page( esc_html__( '9WPThemes', 'floral' ), esc_html__( '9WPThemes', 'floral' ), $this->minimum_capability, $this->menu_slug, array( $this, '_menu_content' ), null, 3 );
    }
    
    
    /**
     * Enqueue
     */
    public function _enqueue() {
        //
        // Main Style
        //
        wp_enqueue_style( 'wp-jquery-ui-dialog' );
        wp_enqueue_style( Floral_Enqueue::STYLE_PREFIX . 'admin-panel', floral_theme_url() . 'includes/admin-panel/assets/css/style-admin-panel' . floral_resource_suffix() . '.css' );
        
        //
        // Main Script
        //
        wp_enqueue_script( 'jquery-ui-dialog' );
        wp_enqueue_script( 'jquery-ui-progressbar' );
        wp_enqueue_script( Floral_Enqueue::SCRIPT_PREFIX . 'cross-domain-ajax', floral_theme_url() . 'assets/vendor/cross-domain-ajax/jquery.xdomainajax.js', array(), FLORAL_THEME_VERSION, false );
        wp_enqueue_script( Floral_Enqueue::SCRIPT_PREFIX . 'admin-panel', floral_theme_url() . 'includes/admin-panel/assets/js/main-admin-panel' . floral_resource_suffix() . '.js', array(), FLORAL_THEME_VERSION, true );
        wp_localize_script( Floral_Enqueue::SCRIPT_PREFIX . 'admin-panel', 'floral_ap_object', array(
            'ajax_url'               => admin_url( 'admin-ajax.php?activate-multi=true' ),
            'home_url'               => home_url( '/' ),
            'ajax_url_9wpthemes'     => self::$args['9wpthemes-server-ajax-url'],
            'rest_api_url_9wpthemes' => self::$args['9wpthemes-server-rest-api']
        ) );
        
        
    }
    
    /**
     * Menu content
     */
    function _menu_content() {
        
        $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'about';
        ?>
        <div class="floral-page-wrapper">
            <div class="page-header">
                <div class="floral-theme-info">
                    <h1 class="welcome"><?php echo sprintf( esc_html__( 'Welcome to %s', 'floral' ), self::$args['theme_name'] ); ?></h1>
                    <p class="summary"><?php echo sprintf( self::$args['intro_content'] ); ?></p>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=_9wpthemes&tab=required-plugins' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Install Plugins', 'floral' ) ?></a>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=_9wpthemes&tab=install-demo' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Install Demo Data', 'floral' ) ?></a>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=theme_options' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Theme Options', 'floral' ); ?></a>
                </div>
                <div class="floral-theme-logo">
                    <img src="<?php echo esc_url( self::$args['theme_logo_url'] ); ?>" alt="<?php echo esc_attr( self::$args['theme_name'] ); ?>">
                    <span class="version"><?php echo sprintf( esc_html__( 'Version %s', 'floral' ), self::$args['theme_version'] ); ?></span>
                </div>
            </div>
            
            <?php $this->tabs( $tab ); ?>
            
            <div class="page-content">
                <?php $this->get_view( $tab ); ?>
            </div>
        </div>
        <?php
    }
    
    
    /**
     * generate tab
     *
     * @param string $tab
     */
    public function tabs( $tab = 'about' ) {
        $check_theme_requirement = self::check_theme_requirement();
        ?>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php echo ( $tab == 'about' ) ? 'nav-tab-active' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=about' ) ); ?>">
                <?php echo esc_html__( "About", 'floral' ); ?>
            </a>
            <a class="nav-tab <?php echo ( $tab == 'required-plugins' ) ? 'nav-tab-active' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=required-plugins' ) ); ?>">
                <?php echo esc_html__( 'Install Plugins', 'floral' ); ?>
            </a>
            <a class="nav-tab <?php echo ( $tab == 'install-demo' ) ? 'nav-tab-active' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=install-demo' ) ); ?>">
                <?php echo esc_html__( 'Install Demos', 'floral' ); ?>
            </a>
            
            <a class="nav-tab <?php echo ( $tab == 'changelog' ) ? 'nav-tab-active' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=changelog' ) ); ?>">
                <?php echo esc_html__( 'Changelog', 'floral' ); ?>
            </a>
            <a class="nav-tab <?php echo ( $tab == 'other-products' ) ? 'nav-tab-active' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=other-products' ) ); ?>">
                <?php echo esc_html__( 'Our Products', 'floral' ); ?>
            </a>
            <a class="nav-tab <?php echo ( $tab == 'system-status' ) ? 'nav-tab-active' : ''; ?> <?php echo ( $check_theme_requirement == false ) ? 'warning' : ''; ?>"
               href="<?php echo esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=system-status' ) ); ?>">
                <?php echo esc_html__( 'System Status', 'floral' ); ?>
            </a>
        </h2>
        <?php
    }
    
    /**
     * Get view
     *
     * @param $tab
     */
    public function get_view( $tab ) {
        switch ( $tab ) {
            case 'install-demo':
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/install-demo.php' );
                break;
            case 'changelog':
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/changelog.php' );
                break;
            case 'other-products':
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/other-products.php' );
                break;
            case 'system-status':
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/system-status.php' );
                break;
            case 'required-plugins':
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/required-plugins.php' );
                break;
            default:
                require_once( floral_theme_dir() . 'includes/admin-panel/templates/about.php' );
                break;
        }
    }
    
    /**
     * Footer info
     */
    public function footer_info() {
        echo 'If you like <strong>' . self::$args['theme_name'] . '</strong> please leave us a <a href="' . esc_url( self::$args['footer_rating_url'] ) . '" target="_blank">★★★★★</a> rating on ThemeForest. Thanks you very much! ';
    }
    
    
    /**
     * Get System Status
     * @return array
     */
    public static function getSystemStatus() {
        global $wpdb;
        global $wp_filesystem;
        if ( empty( $wp_filesystem ) ) {
            require_once( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
        }
        
        $sys_status = array();
        
        // wordpress environment
        $sys_status['home_url']       = home_url( '/' );
        $sys_status['site_url']       = site_url();
        $sys_status['wp_content_url'] = WP_CONTENT_URL;
        $sys_status['data_writeable'] = self::make_bool_str( $wp_filesystem->is_writable( floral_theme_dir() ) );
        
        $upload_dir = wp_upload_dir();
        if ( $upload_dir['error'] === false ) {
            $sys_status['uploads_folder_writeable'] = self::make_bool_str( $wp_filesystem->is_writable( trailingslashit( $upload_dir['basedir'] ) ) );
        } else {
            $sys_status['uploads_folder_writeable'] = 'false';
        }
        
        $sys_status['wp_ver']              = get_bloginfo( 'version' );
        $sys_status['wp_multisite']        = is_multisite();
        $sys_status['permalink_structure'] = get_option( 'permalink_structure' ) ? get_option( 'permalink_structure' ) : 'Default';
        $sys_status['front_page_display']  = get_option( 'show_on_front' );
        if ( $sys_status['front_page_display'] == 'page' ) {
            $front_page_id = get_option( 'page_on_front' );
            $blog_page_id  = get_option( 'page_for_posts' );
            
            $sys_status['front_page'] = $front_page_id != 0 ? get_the_title( $front_page_id ) . ' (#' . $front_page_id . ')' : 'Unset';
            $sys_status['posts_page'] = $blog_page_id != 0 ? get_the_title( $blog_page_id ) . ' (#' . $blog_page_id . ')' : 'Unset';
        }
        
        $sys_status['wp_mem_limit']['raw']  = self::letter_to_num( WP_MEMORY_LIMIT );
        $sys_status['wp_mem_limit']['size'] = size_format( $sys_status['wp_mem_limit']['raw'] );
        
        $sys_status['db_table_prefix'] = 'Length: ' . strlen( $wpdb->prefix ) . ' - Status: ' . ( strlen( $wpdb->prefix ) > 16 ? 'ERROR: Too long' : 'Acceptable' );
        
        $sys_status['wp_debug'] = 'false';
        
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $sys_status['wp_debug'] = 'true';
        }
        
        $sys_status['wp_lang'] = get_locale();
        
        // browser info
        if ( !class_exists( 'Browser' ) ) {
            require_once floral_theme_dir() . 'includes/admin-panel/browser.php';
        }
        $browser = new Browser();
        
        $sys_status['browser'] = array(
            'agent'    => $browser->getUserAgent(),
            'browser'  => $browser->getBrowser(),
            'version'  => $browser->getVersion(),
            'platform' => $browser->getPlatform()
        );
        
        // Server info
        $sys_status['server_info'] = esc_html( $_SERVER['SERVER_SOFTWARE'] );
        $sys_status['php_ver']     = function_exists( 'phpversion' ) ? esc_html( phpversion() ) : 'phpversion() function does not exist.';
        $sys_status['abspath']     = ABSPATH;
        
        if ( function_exists( 'ini_get' ) ) {
            $sys_status['php_mem_limit']['raw']  = self::letter_to_num( ini_get( 'memory_limit' ) );
            $sys_status['php_mem_limit']['size'] = size_format( $sys_status['php_mem_limit']['raw'] );
            
            $sys_status['php_post_max_size']['raw']  = self::letter_to_num( ini_get( 'post_max_size' ) );
            $sys_status['php_post_max_size']['size'] = size_format( $sys_status['php_post_max_size']['raw'] );
            
            $sys_status['php_max_input_time']      = ini_get( 'max_input_time' );
            $sys_status['php_max_execution_time']  = ini_get( 'max_execution_time' );
            $sys_status['php_max_input_var']       = ini_get( 'max_input_vars' );
            $sys_status['max_upload_size']['raw']  = self::letter_to_num( ini_get( 'upload_max_filesize' ) );
            $sys_status['max_upload_size']['size'] = size_format( $sys_status['max_upload_size']['raw'] );
            $sys_status['php_display_errors']      = self::make_bool_str( ini_get( 'display_errors' ) );
        }
        
        $sys_status['mysql_ver'] = $wpdb->db_version();
        
        $sys_status['def_tz_is_utc'] = 'true';
        if ( date_default_timezone_get() !== 'UTC' ) {
            $sys_status['def_tz_is_utc'] = 'false';
        }
        
        // Current theme info
        $active_theme = wp_get_theme();
        
        $sys_status['theme']['name']     = $active_theme->Name;
        $sys_status['theme']['version']  = $active_theme->Version;
        $sys_status['theme']['author']   = $active_theme->Author;
        $sys_status['theme']['is_child'] = self::make_bool_str( is_child_theme() );
        
        if ( is_child_theme() ) {
            $parent_theme = wp_get_theme( $active_theme->Template );
            
            $sys_status['theme']['parent_name']    = $parent_theme->Name;
            $sys_status['theme']['parent_version'] = $parent_theme->Version;
            $sys_status['theme']['author']         = $active_theme->Author;
        }
        
        return $sys_status;
    }
    
    /**
     * @param $size
     *
     * @return int|string
     */
    private static function letter_to_num( $size ) {
        $l   = substr( $size, - 1 );
	    	$ret = (int) substr($size, 0, - 1);
        
        switch ( strtoupper( $l ) ) {
            case 'P':
                $ret *= 1024;
            case 'T':
                $ret *= 1024;
            case 'G':
                $ret *= 1024;
            case 'M':
                $ret *= 1024;
            case 'K':
                $ret *= 1024;
        }
        
        return $ret;
    }
    
    /**
     * @param $input
     *
     * @return string
     */
    public static function make_bool_str( $input ) {
        if ( $input == false || $input === 'false' || $input == 0 || $input == '0' || $input == '' || empty( $input ) ) {
            return 'false';
        } else {
            return 'true';
        }
    }
    
    /**
     * Check theme requirement
     * @return bool
     */
    public static function check_theme_requirement() {
        $fail       = array();
        $sys_status = self::getSystemStatus();
        
        // php version
        if ( version_compare( $sys_status['php_ver'], '5.4' ) == - 1 ) {
            $fail[] = esc_html__( 'PHP Version does not meet recommended requirement.', 'floral' );
        }
        // max input var
        if ( $sys_status['php_max_input_var'] < 3000 ) {
            $fail[] = esc_html__( 'PHP Max Input Var configuration does not meet recommended requirement.', 'floral' );
        }
        //memory limit
        if ( $sys_status['php_mem_limit']['raw'] < 300000000 ) {
            $fail[] = esc_html__( 'PHP Memory Limit configuration does not meet recommended requirement.', 'floral' );
        }
        //max execution time
        if ( $sys_status['php_max_execution_time'] < 300 ) {
            $fail[] = esc_html__( 'PHP Max Execution Time configuration does not meet recommended requirement.', 'floral' );
        }
        //max execution time
	    	if($sys_status['php_max_input_time'] != - 1 && $sys_status['php_max_input_time'] < 300) {
            $fail[] = esc_html__( 'PHP Max Execution Time configuration does not meet recommended requirement.', 'floral' );
        }
        // max input time
        // upload_max_filesize
        if ( $sys_status['max_upload_size']['raw'] < 64000000 ) {
            $fail[] = esc_html__( 'PHP Max Upload Size configuration does not meet recommended requirement.', 'floral' );
        }
        
        //post_max_size
        if ( $sys_status['php_post_max_size']['raw'] < 64000000 ) {
            $fail[] = esc_html__( 'PHP Post Max Size configuration does not meet recommended requirement.', 'floral' );
        }
        
        return count( $fail ) == 0;
    }
    
    /**
     * Ajax load theme products
     */
    static function load_theme_product_using_rest_api() {
        $paged    = isset( $_REQUEST['paged'] ) ? $_REQUEST['paged'] : 1;
        $post_num = isset( $_REQUEST['post_num'] ) ? $_REQUEST['post_num'] : 3;
        
        $tp_data  = '';
        $response = wp_remote_get( self::$args['9wpthemes-server-rest-api'] . 'tp-cpt?page=' . $paged . '&per_page=' . $post_num );
        if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
            echo sprintf( '%s', $tp_data );
        }
        
        $response_body = json_decode( wp_remote_retrieve_body( $response ) );
        
        if ( !is_array( $response_body ) ) {
            echo sprintf( '%s', $tp_data );
        }
        
        foreach ( $response_body as $tp ) :
            ob_start();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'product-item' ); ?>>
                <div class="product-thumbnail">
                    <div class="tp-entry-image-wrapper cell-vertical-wrapper">
                        <div class="cell-middle">
                            <?php if ( !empty( $tp->meta_tp_featured_image ) ): ?>
                                <?php echo sprintf( '%s', $tp->meta_tp_featured_image ); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url( floral_theme_url() . 'includes/admin-panel/assets/images/default-demo-screen-shot.jpg' ); ?>" alt="<?php echo sprintf( $tp->title->rendered ); ?>">
                            <?php endif; ?>
                        </div>
                    </div><!-- .entry-header -->
                </div>
                <div class="product-info">
                    <div class="tp-entry-info-wrapper">
                        <h2 class="tp-entry-title"><?php echo sprintf( '%s', $tp->title->rendered ); ?></h2>
                        <div class="tp-entry-content">
                            <?php if ( !empty( $tp->meta_tp_envato_rating ) ): ?>
                                <p class="tp-attr">
                                    <span class="attr-name"><?php echo esc_html__( 'Envato rating:', 'floral' ); ?></span>
                                    <?php
                                    $tp_rate = floatval( $tp->meta_tp_envato_rating );
                                    $i       = 0;
                                    while ( $i + 1 <= 5 ) {
                                        if ( $tp_rate >= $i + 1 ) {
                                            echo '<span class="rating"><span class="star" style="width: 100%"></span></span>';
                                        } elseif ( $tp_rate <= $i ) {
                                            echo '<span class="rating"><span class="star" style="width: 0"></span></span>';
                                        } else {
                                            $percent = ( $tp_rate - $i ) * 100;
                                            echo '<span class="rating"><span class="star" style="width: ' . $percent . '%"></span></span>';
                                        }
                                        $i ++;
                                    }
                                    ?>
                                    <span class="attr-value"><?php echo sprintf( '%s out of 5', $tp->meta_tp_envato_rating ); ?></span>
                                </p>
                            <?php endif; ?>
                            <?php if ( !empty( $tp->meta_tp_last_update ) ): ?>
                                <p class="tp-attr">
                                    <span class="attr-name"><?php echo esc_html__( 'Updated on:', 'floral' ) ?></span>
                                    <span class="attr-value"><?php echo wp_kses_post( date( 'd M, Y', strtotime( $tp->meta_tp_last_update ) ) ); ?></span>
                                </p>
                            <?php endif; ?>
                            <?php if ( !empty( $tp->meta_tp_change_log_url ) ): ?>
                                <p class="tp-attr">
                                    <span class="attr-name"><?php echo esc_html__( 'Changelog:', 'floral' ) ?></span>
                                    <span class="attr-value"><a href="<?php echo esc_url( $tp->meta_tp_change_log_url ); ?>"><?php echo esc_html__( 'Theme Changelog', 'floral' ) ?></a></span>
                                </p>
                            <?php endif; ?>
                            <?php if ( !empty( $tp->meta_tp_docs_url ) ): ?>
                                <p class="tp-attr">
                                    <span class="attr-name"><?php echo esc_html__( 'Documentation:', 'floral' ) ?></span>
                                    <span class="attr-value"><a href="<?php echo esc_url( $tp->meta_tp_docs_url ); ?>"><?php echo esc_html__( 'Theme Docs', 'floral' ) ?></a></span>
                                </p>
                            <?php endif; ?>
                            <?php if ( !empty( $tp->meta_tp_browser_support ) ): ?>
                                <p class="tp-attr">
                                    <span class="attr-name"><?php echo esc_html__( 'Browser:', 'floral' ) ?></span>
                                    <span class="attr-value"><?php echo wp_kses_post( $tp->meta_tp_browser_support ); ?></span>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="tp-entry-btn-actions">
                            <a class="button button-primary"
                               href="<?php echo esc_url( $tp->meta_tp_live_demo_url ); ?>" title="<?php echo esc_attr__( 'Live Demo', 'floral' ); ?>" target="_blank">
                                <span><?php echo esc_html__( 'Live Demo', 'floral' ); ?></span>
                            </a>
                            <?php if ( $tp->meta_tp_type == 'premium' ): ?>
                                <a class="button button-primary"
                                   href="<?php echo esc_url( $tp->meta_tp_purchase_url ); ?>" title="<?php echo esc_attr__( 'Purchase now', 'floral' ); ?>" target="_blank">
                                    <span><?php echo sprintf( esc_html__( 'Purchase %s', 'floral' ), $tp->meta_tp_price ); ?></span>
                                </a>
                            <?php else: ?>
                                <a class="button button-primary"
                                   href="<?php echo esc_url( $tp->meta_tp_download_file ); ?>" title="<?php echo esc_attr__( 'Download now', 'floral' ); ?>" target="_blank">
                                    <span><?php echo esc_html__( 'Download now', 'floral' ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div><!-- .entry-meta -->
                    </div><!-- .entry-content -->
                </div>
            </article>
            <?php
            $tp_data .= ob_get_clean();
        endforeach;
        
        echo wp_kses_post( $tp_data );
        wp_die();
    }
    
}

