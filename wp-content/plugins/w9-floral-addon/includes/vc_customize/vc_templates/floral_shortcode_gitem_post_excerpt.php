<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_gitem_post_excerpt.php
 * @time    : 9/9/16 4:01 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $this Floral_SC_Gitem_Post_Excerpt
 */

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

?>

{{floral_gitem_post_excerpt:<?php echo http_build_query( $atts ) ?>}}