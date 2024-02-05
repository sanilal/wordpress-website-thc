<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: footer.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template_prefix = floral_get_template_prefix();
/*-------------------------------------
	 BEFORE FOOTER CONTENT TEMPLATE
---------------------------------------*/
$template_before_footer = floral_get_meta_or_option( 'content-template-before-footer', '', null, $template_prefix );

if ( !empty( $template_before_footer ) && $template_before_footer !== '__none__' ) {
    echo floral_get_post_content_by_name( $template_before_footer, 'content-template' );
}


/*-------------------------------------
	DEFAULT FOOTER
---------------------------------------*/
$footer_template = floral_get_meta_or_option( 'footer-enable', '', '', $template_prefix );

switch ( $footer_template ) {
    case 'simple':
        floral_get_template_part( 'footer/footer-default' );
        break;
    case 'custom':
        $footer_content_template = floral_get_meta_or_option( 'footer-content-template', '', null, $template_prefix );
        if ( !empty( $footer_content_template ) ) {
            echo floral_get_post_content_by_name( $footer_content_template, 'content-template' );
        }
        break;
    case 'off':
        return;
}

/*-------------------------------------
	 AFTER FOOTER CONTENT TEMPLATE
---------------------------------------*/
$template_after_footer = floral_get_meta_or_option( 'content-template-after-footer', '', null, $template_prefix );

if ( !empty( $template_after_footer ) && $template_after_footer !== '__none__' ) {
    echo floral_get_post_content_by_name( $template_after_footer, 'content-template' );
}