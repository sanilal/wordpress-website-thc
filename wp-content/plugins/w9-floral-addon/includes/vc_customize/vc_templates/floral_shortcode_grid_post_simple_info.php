<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_grid_post_simple_info.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Grid_Post_Simple_Info
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$post_info         = '';
$add_link          = '';
$output_tag        = '';
$text_style        = '';
$text_align        = '';
$text_label        = '';
$text_label_style  = '';
$text_suffix       = '';
$text_suffix_style = '';
$el_class          = '';
$css               = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );
$content = '';
//Post Author
if ( $post_info == 'author' ) {
    $content      = '{{ post_author }}';
    $atts['link'] = 'post_author';
    $link_html    = vc_gitem_create_link( $atts );
    if ( !empty( $link_html ) ) {
        $content = '<' . $link_html . '>' . $content . '</a>';
    }
};

// Categories
if ( $post_info === 'categories' ) {
    $content = '{{floral_simple_categories}}';
}

// PorfoliCategories
if ( $post_info === 'portfolio-categories' ) {
    $content = '{{floral_terms:portfolio-category}}';
}

// Comnent number
if ( $post_info === 'comment-number' ) {
    $content = '{{floral_comment_number}}';
}

// Tags
if ( $post_info === 'tags' ) {
    $content = '{{floral_simple_tags}}';
}
//Date
if ( $post_info === 'date' ) {
    $content = '{{floral_simple_date}}';
}

//Portfolio categories
if ( $post_info === 'event-social' ) {
    $content = '{{floral_event_social_link}}';
}

if ( $text_style === 'normal' ) {
    $text_style = 'text-normal';
}
if ( $text_label_style === 'normal' ) {
    $text_label_style = '';
}
if ( $text_suffix_style === 'normal' ) {
    $text_suffix_style = '';
}

$content     = '<span class="' . esc_attr( $text_style ) . '">' . $content . '</span> ';
$text_label  = empty( $text_label ) ? '' : '<span class="__label ' . esc_attr( $text_label_style ) . '">' . $text_label . '</span> ';
$text_suffix = empty( $text_suffix ) ? '' : ' <span class="__suffix ' . esc_attr( $text_suffix_style ) . '">' . $text_suffix . '</span> ';

$content       = $text_label . $content . $text_suffix;
$wrapper_class = 'floral-simple-info floral-info-' . $post_info;
echo sprintf( '<%s class="%s">%s</%s>', $output_tag, esc_attr( $el_class . $wrapper_class . vc_shortcode_custom_css_class( $css ) ) . ' ' . esc_attr( $text_align ), $content, $output_tag );