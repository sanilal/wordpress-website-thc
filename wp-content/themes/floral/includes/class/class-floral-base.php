<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-base.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

abstract class Floral_Base {

    public function __construct() {
        // add filter must be call first, some filters may take action before actions...
        $this->add_filters();
        $this->add_actions();
    }

    protected function add_filters() {}
    protected function add_actions() {}
}