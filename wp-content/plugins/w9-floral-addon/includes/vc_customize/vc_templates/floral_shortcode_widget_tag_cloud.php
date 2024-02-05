<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_widget_tagcloud.php
 * @time    : 9/28/2016 9:54 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Widget_Tag_Cloud
 * @var $atts
 */


if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Widget param
$title = $taxonomy = $tag_color = $text_color = $text_color_cp = $text_hover_color = $text_hover_color_cp = $background_color = $background_color_cp = $background_hover_color = $background_hover_color_cp = $border_color = $border_color_cp = $border_hover_color = $border_hover_color_cp = $floral_extra_widget_classes = $floral_remove_default_mb = '';

// Widget wrapper param
$css = $animation_css = $animation_duration = $animation_delay = $el_class = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$widget_atts = array(
    'title'                     => $title,
    'taxonomy'                  => $taxonomy,
    'tag_color'                 => $tag_color,
    'text_color'                => $text_color,
    'text_color_cp'             => $text_color_cp,
    'text_hover_color'          => $text_hover_color,
    'text_hover_color_cp'       => $text_hover_color_cp,
    'background_color'          => $background_color,
    'background_color_cp'       => $background_color_cp,
    'background_hover_color'    => $background_hover_color,
    'background_hover_color_cp' => $background_hover_color_cp,
    'border_color'              => $border_color,
    'border_color_cp'           => $border_color_cp,
    'border_hover_color'        => $border_hover_color,
    'border_hover_color_cp'     => $border_hover_color_cp
);

$widget_wrapper_class = array(
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

$widget_class   = array();
$widget_class[] = $floral_extra_widget_classes;
if ( !empty( $floral_remove_default_mb ) ) {
    $widget_class[] = 'mb-0-i';
}

$args = array(
    'before_widget' => '<div class="floral-widget %s ' . floral_clean_html_classes( $widget_class ) . '">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="floral-widget-title">',
    'after_title'   => '</h3>'
);
?>
<div class="floral-sc-widget floral-widget-wrapper <?php floral_the_clean_html_classes( $widget_wrapper_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <?php the_widget( 'Floral_Widget_Tag_Cloud', $widget_atts, $args ); ?>
</div>