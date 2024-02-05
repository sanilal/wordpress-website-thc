<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-countdown.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Countdown extends WPBakeryShortCode{
    const SC_BASE = 'floral_shortcode_countdown';
    
    function shortcode( $atts, $content = null ) {
        
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
