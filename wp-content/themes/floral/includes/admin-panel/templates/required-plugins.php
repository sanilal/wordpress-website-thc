<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: required-plugins.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( isset( $GLOBALS['floral_tgmpa'] ) ) {
    /**
     * @var $tgma Floral_TGMA
     */
    $tgma = $GLOBALS['tgmpa'];
    $tgma->install_plugins_page();
} else {
    ?>
    <div class="white-board">
        <?php echo esc_html__( 'No more required plugins', 'floral' ); ?>
    </div>
    <?php
}