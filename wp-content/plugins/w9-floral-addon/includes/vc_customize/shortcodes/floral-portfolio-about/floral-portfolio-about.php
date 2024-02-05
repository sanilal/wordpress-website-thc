<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-about.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if(!class_exists('Floral_SC_Portfolio_About')){
    class Floral_SC_Portfolio_About extends WPBakeryShortCode{
        const SC_BASE = 'floral_shortcode_portfolio_about';
    }
}
