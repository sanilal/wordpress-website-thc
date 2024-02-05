<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: back-to-top.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$back_to_top = floral_get_option( 'back-to-top' );
if ( empty( $back_to_top ) ) {
    return;
}
?>
<a href="#" id="floral-back-to-top"><i class="fa fa-chevron-up"></i></a>

