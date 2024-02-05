<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_message.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 *
 * @todo add $icon_... defaults
 * @todo add $icon_typicons and etc
 *
 * @var $atts
 * @var $el_class
 * @var $message_box_style
 * @var $style
 * @var $color
 * @var $message_box_color
 * @var $css_animation
 * @var $type
 * @var $icon_fontawesome
 * @var $content - shortcode content
 * @var $css
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Message
 */
$el_class         = $message_box_color = $message_box_style = $style = $css = $color = $css_animation = $type = $message_box_size =
$messagebox_ff = $messagebox_fz = $message_box_dismissible = $animation_css = $animation_duration = $animation_delay = '';
$icon_9wpthemes   = $icon_floral = $icon_fontawesome = $icon_linecons = $icon_openiconic = $icon_typicons = $icon_entypo = '';
$defaultIconClass = 'fa fa-adjust';
$atts             = $this->convertAttributesToMessageBox2( $atts );
$atts             = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$elementClass = array(
    'base'          => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_message_box', $this->settings['base'], $atts ),
    'style'         => 'vc_message_box-' . $message_box_style,
    'shape'         => 'vc_message_box-' . $style,
    'size'          => 'vc_message_box-size-' . $message_box_size,
    'color'         => ( strlen( $color ) > 0 && false === strpos( 'alert', $color ) ) ? 'vc_color-' . $color : 'vc_color-' . $message_box_color,
    'css_animation' => Floral_Map_Helpers::get_class_animation( $css_animation ),
);

if ( !empty( $messagebox_ff ) ) {
    $elementClass[] = $messagebox_ff;
}

if ( !empty( $messagebox_fz ) ) {
    $elementClass[] = $messagebox_fz;
}

if ( !empty( $message_box_dismissible ) ) {
    $elementClass[] = 'dismissible-element';
}


$class_to_filter = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $elementClass ) );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Pick up icons
$iconClass = isset( ${'icon_' . $type} ) ? ${'icon_' . $type} : $defaultIconClass;
switch ( $color ) {
    case 'info':
        $type      = 'fontawesome';
        $iconClass = 'fa fa-info-circle';
        break;
    case 'alert-info':
        $type      = 'pixelicons';
        $iconClass = 'vc_pixel_icon vc_pixel_icon-info';
        break;
    case 'success':
        $type      = 'fontawesome';
        $iconClass = 'fa fa-check';
        break;
    case 'alert-success':
        $type      = 'pixelicons';
        $iconClass = 'vc_pixel_icon vc_pixel_icon-tick';
        break;
    case 'warning':
        $type      = 'fontawesome';
        $iconClass = 'fa fa-exclamation-triangle';
        break;
    case 'alert-warning':
        $type      = 'pixelicons';
        $iconClass = 'vc_pixel_icon vc_pixel_icon-alert';
        break;
    case 'danger':
        $type      = 'fontawesome';
        $iconClass = 'fa fa-times';
        break;
    case 'alert-danger':
        $type      = 'pixelicons';
        $iconClass = 'vc_pixel_icon vc_pixel_icon-explanation';
        break;
    case 'alert-custom':
    default:
        break;
}

// Enqueue needed font for icon element
if ( 'pixelicons' !== $type ) {
    vc_icon_element_fonts_enqueue( $type );
}
?>
<div class="<?php echo esc_attr( $css_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ) ?>>
    <div class="vc_message_box-icon"><i class="<?php echo esc_attr( $iconClass ); ?>"></i>
    </div><?php echo wpb_js_remove_wpautop( $content, true ); ?>
</div>
