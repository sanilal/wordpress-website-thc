<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: exporter.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once floral_theme_dir() . 'includes/admin-panel/floral-install-demo/class-floral-exporter.php';

?>
<div class="page-exporter">
    <div class="white-board">
        <h2>Export Demo Data</h2>
        <a href="<?php echo esc_url( admin_url( 'export.php' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Export Demo Data', 'floral' ); ?></a>
        <a href="<?php echo esc_url( admin_url( 'export.php' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Export Option Data', 'floral' ); ?></a>
        <a href="<?php echo esc_url( admin_url( 'export.php' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Export Update Data', 'floral' ); ?></a>
        <a href="<?php echo esc_url( admin_url( 'export.php' ) ); ?>" class="button button-primary"><?php echo esc_html__( 'Export All', 'floral' ); ?></a>
    </div>
</div>
