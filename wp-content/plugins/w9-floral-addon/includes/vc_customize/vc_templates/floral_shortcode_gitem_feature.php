<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_gitem_feature.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $this Floral_SC_Gitem_Feature
 */

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

?>
{{floral_gitem_feature:<?php echo http_build_query( $atts ) ?>}}
 