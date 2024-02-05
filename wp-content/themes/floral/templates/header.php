<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: header.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template_prefix = floral_get_template_prefix();


/*-------------------------------------
	 BEFORE HEADER CONTENT TEMPLATE
---------------------------------------*/
$template_before_header = floral_get_meta_or_option( 'content-template-before-header', '', null, $template_prefix );

if ( !empty( $template_before_header ) && $template_before_header !== '__none__' ) {
    ?>
        <div class="floral-before-main-header">
            <?php echo floral_get_post_content_by_name( $template_before_header, 'content-template' ); ?>
        </div>
    <?php
}

/*-------------------------------------
	HEADER
---------------------------------------*/
$header_enable = floral_get_meta_or_option( 'header-enable', '', null, $template_prefix );
if ( $header_enable == 'on' ) {
    floral_get_template_part( 'header/main-nav' );
}

/*-------------------------------------
	 AFTER HEADER CONTENT TEMPLATE
---------------------------------------*/
$template_after_header = floral_get_meta_or_option( 'content-template-after-header', '', null, $template_prefix );

if ( !empty( $template_after_header ) && $template_after_header !== '__none__' ) {
    ?>
        <div class="floral-after-main-header">
             <?php echo floral_get_post_content_by_name( $template_after_header, 'content-template' );?>
        </div>
    <?php
}