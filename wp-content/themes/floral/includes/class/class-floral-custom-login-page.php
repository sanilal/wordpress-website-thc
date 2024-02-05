<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-custom-login-page.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Custom_Login_Page extends Floral_Base {

    public function __construct() {
        parent::__construct();
    }

    function add_filters() {
        add_filter( 'login_headerurl', array( $this, 'custom_login_logo_url' ) );
        add_filter( 'login_headertitle', array( $this, 'custom_login_logo_url_title' ) );
    }

    function add_actions() {
        add_action( 'login_enqueue_scripts', array( $this, 'custom_login_logo' ) );
    }

    function custom_login_logo() { ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo floral_theme_url(); ?>assets/images/_9wpthemes-logo.png);
            }
        </style>
    <?php }

    function custom_login_logo_url() {
        return esc_url(home_url( '/' ));
    }

    function custom_login_logo_url_title() {
        return esc_html__( '9WPThemes - High End Flexible Wordpress Theme', 'floral' );
    }
}