<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-page-title.php
 * @time    : 8/29/16 4:54 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !class_exists( 'Floral_SC_Portfolio_Info' ) ) {
    class Floral_SC_Portfolio_Page_Title extends WPBakeryShortCode {
        const SC_BASE = 'floral_shortcode_portfolio_page_title';
    }
}
