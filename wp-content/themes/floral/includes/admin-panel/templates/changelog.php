<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: changelog.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


$readme_file = floral_theme_dir() . 'readme.txt';
$_readme     = array();

if ( file_exists( $readme_file ) ) {
    require_once( floral_theme_dir() . 'includes/library/extension-meta/extension-meta.php' );
    $_readme = WshWordPressPackageParser::parseReadme( floral_get_file_contents( $readme_file ), true );
}

?>
<div class="page-changelog white-board">
    <?php
    if ( !empty( $_readme ) && isset( $_readme['sections']['Changelog'] ) ):
        echo wp_kses_post( $_readme['sections']['Changelog'] );
    else:
        echo esc_html__( 'No changelog found!', 'floral' );
    endif;
    ?>
</div>
