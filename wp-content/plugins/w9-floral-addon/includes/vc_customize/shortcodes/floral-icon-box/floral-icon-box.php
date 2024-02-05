<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-icon-box.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Icon_Box extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_icon_box';
    var $icon_default_size;

    function __construct( $settings ) {
        parent::__construct( $settings );
        $this->icon_default_size = array(
            'top-left-inline'  => 30,
            'top-right-inline' => 30,
            'text-center'      => 60,
            'left'             => 30,
            'right'            => 30,
            'bottom'           => 60,
        );
    }

}