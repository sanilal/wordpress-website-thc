<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: theme-setup.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

add_action( 'after_setup_theme', 'floral_setup' );
add_action( 'after_setup_theme', 'floral_content_width', 0 );
add_action( 'upgrader_process_complete', 'floral_regenerate_css_after_theme_update', 100, 2 );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function floral_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on 9WPThemes, use a find and replace
     * to change 'floral' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'floral', floral_theme_dir() . 'languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'floral' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'image', 'gallery', 'video', 'audio', 'quote', 'link', 'aside'
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'floral_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    // Declare WooCommerce support
    add_theme_support( 'woocommerce' );
    
    // Register Nav Menu
    floral_register_nav_menus();
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function floral_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'floral_content_width', 960 );
}


/**
 * Register nav menus
 */
function floral_register_nav_menus() {
    register_nav_menus( array(
        'primary' => 'Primary Menu'
    ) );
}

/**
 * floral_regenerate_css_after_theme_update
 *
 * @param $_this
 * @param $data
 */
function floral_regenerate_css_after_theme_update( $_this, $data ) {
    if ( is_array( $data ) && isset( $data['action'] ) && isset( $data['type'] ) && isset( $data['theme'] ) ) {
        if ( $data['action'] === 'update' && $data['type'] === 'theme' ) {
            if ( $data['theme'] === get_template() ) {
                echo sprintf( '<p>%s</p>', esc_html__( 'Start Regenerate CSS.', 'floral' ) );
                Floral_SCSS()->set_variables( Floral_Variables()->get_variables() );
                $rs = Floral_SCSS()->compile_all();
                
                if ( $rs ) {
                    echo sprintf( '<p>%s</p>', esc_html__( 'Regenerate CSS Successful.', 'floral' ) );
                } else {
                    echo sprintf( '<p>%s</p>', esc_html__( 'Regenerate CSS Fail, please try to re-generate css after theme update in Theme Options.', 'floral' ) );
                }
            }
        }
    }
}

