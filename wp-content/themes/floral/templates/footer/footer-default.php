<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: footer-default.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template_prefix = floral_get_template_prefix();

//
// Footer Class
//
$footer_class = array( $template_prefix );

//footer colors
$footer_colors = 'footer-' . floral_get_meta_or_option( 'footer-colors', '', 'dark', $template_prefix );

$footer_class[] = $footer_colors;

?>

<footer id="colophon" class="site-footer <?php floral_the_clean_html_classes( $footer_class ); ?>">
    <div id="footer-content-wrapper">
        <?php
        /**
         * Include footer copyright area
         */
        floral_get_template_part( 'footer/content-area' );
        ?>
    </div>
</footer><!-- #colophon -->