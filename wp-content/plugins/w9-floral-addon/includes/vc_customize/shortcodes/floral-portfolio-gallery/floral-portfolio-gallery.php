<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-gallery.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !class_exists( 'Floral_SC_Portfolio_Gallery' ) ) {
    class Floral_SC_Portfolio_Gallery extends WPBakeryShortCode {
        const SC_BASE = 'floral_shortcode_portfolio_gallery';
    }
}