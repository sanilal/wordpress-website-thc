<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_content_template.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Content_Template
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$template = '';
$atts     = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

echo ( !empty( $template ) ) ? floral_get_post_content_by_name( $template, 'content-template' ) : '';