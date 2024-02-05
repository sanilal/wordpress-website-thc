<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_gitem_text.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 *
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $this Floral_SC_Gitem_Text
 */

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
?>

{{floral_gitem_text:<?php echo http_build_query( $atts ) ?>}}