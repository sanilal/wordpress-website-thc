<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-area.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template_prefix = floral_get_template_prefix();

$footer_copyright_text = floral_get_meta_or_option( 'footer-copyright-text', '', '', $template_prefix );

?>
<section class="footer-content-area">
    <?php if ( !empty( $footer_copyright_text ) ): ?>
        <p class="mb-0 text-center"><?php echo sprintf( '%s', wp_kses_post( $footer_copyright_text ) ); ?></p>
    <?php endif; ?>
</section>
