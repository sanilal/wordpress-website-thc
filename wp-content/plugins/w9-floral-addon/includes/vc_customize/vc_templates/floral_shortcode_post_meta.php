<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_post_meta.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Post_Meta
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// if current template is not singular
if ( !is_singular() ) {
    return;
}

global $post;
$_id = $post->ID;
if ( !$_id ) {
    return;
}

$info_list = $meta_separator = $meta_text_transform = $meta_label_fw = $meta_info_fw = $meta_font_size = $meta_font_family =
$meta_custom_size = $meta_spacing = $responsive_size = $scale_ratio = $minimum_size = $el_class = $css =
$tablet_css = $mobile_css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

$wrapper_class = array(
    $meta_text_transform,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

$inline_css = array();
if ( !empty( $meta_font_size ) ) {
    $wrapper_class[] = 'fz-' . $meta_font_size;
    // custom size
    if ( $meta_font_size === 'custom' ) {
        $inline_css[] = 'font-size: ' . $meta_custom_size . 'px';
    }

    $data_resize_options = array();

    if ( !empty( $responsive_size ) ) {
        $wrapper_class[] = 'responsive-font-size';

        if ( $meta_font_size === 'custom' ) {
            $data_resize_options['font_size']['maxFontSize'] = floatval( $meta_custom_size );
        } else {
            $data_resize_options['font_size']['maxFontSize'] = floatval( $meta_font_size );
        }

        if ( !empty( $minimum_size ) ) {
            $data_resize_options['font_size']['minFontSize'] = floatval( $minimum_size );
        }

        $scale_ratio = ( !empty( $scale_ratio ) && floatval( $scale_ratio ) ) ? floatval( $scale_ratio ) : 1;

        $data_resize_options['compressor'] = $scale_ratio;
    }
}

if ( !empty( $meta_font_family ) ) {
    $wrapper_class[] = $meta_font_family;
}

if ( !empty( $meta_spacing ) ) {
    $wrapper_class[] = 'meta-spacing-items-' . $meta_spacing;
}

if ( !empty( $info_list ) ) {
    $info_list = (array) vc_param_group_parse_atts( $info_list );
} else {
    $info_list = array();
}

/*-------------------------------------
	GET META ITEMS
---------------------------------------*/
$meta_items = array();
foreach ( $info_list as $id => $info ):
    if ( !isset( $info['info'] ) || !in_array( $info['info'], array( 'date', 'author', 'categories', 'tags', 'comments' ) ) ) {
        continue;
    }
    $type = $info['info'];

    $label                  = isset( $info['info_label'] ) ? $info['info_label'] : '';

    ob_start();
    switch ( $type ) {
        case 'date':
            $date_format = isset( $info['date_format'] ) ? $info['date_format'] : '';
            ?>
            <span class="meta-item meta-date">
                <?php echo $this->get_meta_label( $label, array( $meta_label_fw ) ); ?>
                <span class="meta-content <?php echo esc_attr( $meta_info_fw ); ?>">
                    <?php echo $this->get_post_date( $_id, $date_format ); ?>
                </span>
            </span>
            <?php
            break;
        case 'author':
            ?>
            <span class="meta-item meta-author">
                <?php echo $this->get_meta_label( $label, array( $meta_label_fw ) ); ?>
                <span class="meta-content <?php echo esc_attr( $meta_info_fw ); ?>">
                    <?php echo $this->get_post_author(); ?>
                </span>
            </span>
            <?php
            break;
        case 'categories':
            $number_item = isset( $info['number_items'] ) ? $info['number_items'] : '';
            $item_separator = isset( $info['item_separator'] ) ? $info['item_separator'] : ', ';
            ?>
            <span class="meta-item meta-categories">
                <?php echo $this->get_meta_label( $label, array( $meta_label_fw ) ); ?>
                <span class="meta-content <?php echo esc_attr( $meta_info_fw ); ?>">
                    <?php echo $this->get_post_categories( $_id, $number_item, $item_separator ); ?>
                </span>
            </span>
            <?php
            break;
        case 'tags':
            $number_item = isset( $info['number_items'] ) ? $info['number_items'] : '';
            $item_separator = isset( $info['item_separator'] ) ? $info['item_separator'] : ', ';
            ?>
            <span class="meta-item meta-tags">
                <?php echo $this->get_meta_label( $label, array( $meta_label_fw ) ); ?>
                <span class="meta-content <?php echo esc_attr( $meta_info_fw ); ?>">
                    <?php echo $this->get_post_tags( $_id, $number_item, $item_separator ); ?>
                </span>
            </span>
            <?php
            break;
        case 'comments':
            ?>
            <span class="meta-item meta-comments">
                <?php echo $this->get_meta_label( $label, array( $meta_label_fw ) ); ?>
                <span class="meta-content <?php echo esc_attr( $meta_info_fw ); ?>">
                    <?php comments_popup_link(
                        sprintf( '<span>%s</span>', esc_html__( 'No Comment', 'w9-floral-addon' ) ),
                        sprintf( '<span>%s</span>', esc_html__( 'One Comment', 'w9-floral-addon' ) ),
                        sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'w9-floral-addon' ) ) ) ?>
                </span>
            </span>
            <?php
            break;
    }

    $meta_items[] = ob_get_clean();
endforeach;
?>
<div class="floral-post-meta <?php floral_the_clean_html_classes( $wrapper_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ); ?> <?php echo !empty( $data_resize_options ) ? 'data-resize="' . esc_attr( json_encode( $data_resize_options ) ) . '"' : ''; ?>>
    <?php echo implode( $meta_separator, $meta_items ); ?>
</div>

