<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_google_maps.php
 * @time    : 8/26/2016 3:01 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Google_Maps
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$google_map_api_key = floral_get_option( 'google-map-api' );

if ( empty( $google_map_api_key ) ) {
    echo __( 'Google Map API Key has not been set, please set it in: Theme Options -> General Settings -> Google Map API Key.', 'w9-floral-addon' );
    
    return;
}
// enqueue scripts
wp_enqueue_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . $google_map_api_key );
wp_enqueue_script( FLORAL_SCRIPT_PREFIX . 'init-google-maps', Floral_Addon::plugin_url() . 'assets/js/floral-google-maps.js', array( 'google-maps-api' ), Floral_Addon::VERSION, true );


$map_position = $marker_on_map_position = $map_height = $map_theme = $custom_style = $zoom_level = $zoom_on_mouse_wheel = $map_marker_title = $map_type =
$draggable = $custom_marker = $markers = $el_class = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );


if ( @preg_match( '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/', $map_position, $matches ) ) {
    $cor           = explode( ',', $matches[0] );
    $data_position = array(
        'lat' => floatval( $cor[0] ),
        'lng' => floatval( $cor[1] )
    );
} else {
    echo __( 'Invalid Map Position', 'w9-floral-addon' );
    
    return;
}

if ( $map_theme === 'custom_code' ) {
    $map_theme = urldecode( base64_decode( $custom_style ) );
}

$inline_style = array();

if ( empty( $map_height ) ) {
    $map_height = '500px';
}

$inline_style[] = 'height: ' . $map_height;


$map_holder_id = uniqid( 'floral-google-map-' );

if ( !empty( $custom_marker ) ) {
    $custom_marker = ( $img_src = wp_get_attachment_image_src( $custom_marker, 'full' ) ) && isset( $img_src[0] ) ? $img_src[0] : '';
} else {
    $custom_marker = '';
}

$data_marker = array();
// marker at map position
//if ( !empty( $marker_on_map_position ) ) {
//    $current_marker   = array();
//    $current_marker[] = $data_position;
//    $current_marker[] = $map_marker_title;
//    $current_marker[] = 'drop';
//
//    $data_marker[] = $current_marker;
//}

// more markers
if ( !empty( $markers ) ) {
    $markers = (array) vc_param_group_parse_atts( $markers );
} else {
    $markers = array();
}

foreach ( $markers as $marker ) {
    $marker_position = isset( $marker['marker_position'] ) ? $marker['marker_position'] : '';
    $current_marker  = array();
    
    if ( empty( $marker_position ) ) {
        continue;
    }
    
    if ( @preg_match( '/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s*[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/', $marker_position, $matches ) ) {
        $cor              = explode( ',', $matches[0] );
        $current_marker[] = array(
            'lat' => floatval( $cor[0] ),
            'lng' => floatval( $cor[1] )
        );
    } else {
        continue;
    }
    
    $current_marker[] = isset( $marker['marker_title'] ) ? $marker['marker_title'] : '';
    $current_marker[] = isset( $marker['marker_animation'] ) ? $marker['marker_animation'] : '';
    
    $data_marker[] = $current_marker;
}


?>
<div class="floral-google-map-wrapper <?php floral_the_clean_html_classes( array( $el_class, Floral_Map_Helpers::get_class_animation( $animation_css ) ) ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_style, $animation_duration, $animation_delay ); ?>>
    <div id="<?php echo esc_attr( $map_holder_id ); ?>" class="google-map-holder"
         data-position="<?php echo esc_attr( json_encode( $data_position ) ); ?>"
         data-draggable="<?php echo esc_attr( $draggable ); ?>"
         data-zoom-level="<?php echo esc_attr( $zoom_level ); ?>"
         data-zoon-on-mouse-wheel="<?php echo esc_attr( $zoom_on_mouse_wheel ); ?>"
         data-theme="<?php echo esc_attr( $map_theme ); ?>"
         data-map-type="<?php echo esc_attr( $map_type ); ?>"
         data-custom-marker="<?php echo esc_attr( $custom_marker ); ?>"
         data-markers="<?php echo esc_attr( json_encode( $data_marker ) ); ?>" style="height: 100%;">
    </div>
</div>
<script>
    (function ($) {
        $(document).ready(function () {
            floral_gmaps.init_map('<?php echo esc_attr( $map_holder_id ); ?>');
        })
    })(jQuery);
</script>


