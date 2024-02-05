<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_gitem_heading.php
 * @time    : 9/9/16 12:20 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $this Floral_SC_Gitem_Heading
 */

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

?>

{{floral_gitem_heading:<?php echo http_build_query( $atts ) ?>}}