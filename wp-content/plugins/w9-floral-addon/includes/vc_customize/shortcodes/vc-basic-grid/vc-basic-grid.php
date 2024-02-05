<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-basic-grid.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once Floral_Addon::plugin_dir() . "includes/vc_customize/shortcodes-grid/__core/floral-basic-grid-custom.php";
class Floral_SC_Basic_Grid extends Floral_Basic_Grid {
    const SC_BASE = 'vc_basic_grid';
}