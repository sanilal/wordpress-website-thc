<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_gitem_zone_c.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 * @var $atts
 * @var $this    WPBakeryShortCode_VC_Gitem_Zone
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $content string
 */

$min_height       = '';
$text_color       = '';
$heading_color    = '';
$link_color       = '';
$link_hover_color = '';
$el_class         = $css = $render = '';
$atts             = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( 'no' === $render ) {
    echo '';
    
    return;
}
$css_class = 'vc_gitem-zone'
    . ( strlen( $this->zone_name ) ? ' vc_gitem-zone-' . $this->zone_name : '' )
    . $this->getExtraClass( $el_class );

// style class
if ( !empty( $text_color ) ) {
    $css_class .= ' ' . $text_color . '-color';
}

if ( !empty( $heading_color ) ) {
    $css_class .= ' ' . $heading_color . '-heading-color';
}

if ( !empty( $link_color ) ) {
    $css_class .= ' ' . $link_color . '-link-color';
}

if ( !empty( $link_hover_color ) ) {
    $css_class .= ' ' . $link_hover_color . '-link-hover-color';
}

$css_class_mini = 'vc_gitem-zone-mini';
$css_class .= vc_shortcode_custom_css_class( $css, ' ' );

?>
<div class="floral-gitem-zone-c-wrapper clearfix">
    <div class="<?php echo esc_attr( $css_class ) ?>" <?php if(!empty($min_height)){echo sprintf('style="min-height: %s;"', $min_height);} ?>>
        <div class="<?php echo esc_attr( $css_class_mini ) ?>">
            <?php echo do_shortcode( $content ) ?>
        </div>
    </div>
</div>

