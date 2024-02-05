<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: functions.php
 * @time    : 8/27/16 11:48 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * floral_child_theme_enqueue_styles
 */
function floral_child_theme_enqueue_styles() {
    wp_enqueue_style( 'floral-child-style', get_stylesheet_directory_uri() . '/style.css' );
}

/**
 * floral_child_theme_setup
 */
function floral_child_theme_setup() {
    $language_path = get_stylesheet_directory() . '/languages';
    if ( is_dir( $language_path ) ) {
        load_child_theme_textdomain( 'floral-child', $language_path );
    }
}

add_action( 'after_setup_theme', 'floral_child_theme_setup' );
add_action( 'wp_enqueue_scripts', 'floral_child_theme_enqueue_styles', 1000 );
// if you want to add some custom function