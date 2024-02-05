<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: page-title.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template_prefix = floral_get_template_prefix();

/*-------------------------------------
	WHICH TEMPLATE TO SHOW
---------------------------------------*/
$default_title = null;
if (is_single()) {
	$default_title = esc_html__('Blog','floral');
}
$page_title_template =  floral_get_meta_or_option( 'page-title-enable', '', $default_title, $template_prefix );

switch ( $page_title_template ) {
    case 'simple':
        floral_get_template_part( 'title/title-default' );
        break;
    case 'custom':
        ?> <div class="floral-pagetitle-wrapper container-fluid"><?php
        $page_title_content_template = isset($_GET['title-template'])  ? $_GET['title-template'] : floral_get_meta_or_option( 'page-title-content-template', '', null, $template_prefix );
        if ( !empty( $page_title_content_template ) ) {
            echo floral_get_post_content_by_name( $page_title_content_template, 'content-template' );
        }
        ?> </div> <?php
        break;
    case 'off':
        return;
}

/*-------------------------------------
	 AFTER PAGE TITLE CONTENT TEMPLATE
---------------------------------------*/
$template_after_page_title = isset($_GET['after-title-template'])  ? $_GET['after-title-template'] : floral_get_meta_or_option( 'content-template-after-page-title', '', null, $template_prefix );
?> <div class="floral-after-pagetitle-wrapper container-fluid"><?php
    if ( !empty( $template_after_page_title ) && $template_after_page_title !== '__none__' ) {
        echo floral_get_post_content_by_name( $template_after_page_title, 'content-template' );
    }
?> </div>