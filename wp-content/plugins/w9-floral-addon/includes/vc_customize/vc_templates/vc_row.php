<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_row.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $str_el_id
 * @var $content_width
 * @var $container_width
 * @var $overlay_set
 * @var $overlay_image
 * @var $overlay_color
 * @var $overlay_opacity
 * @var $parallax_speed
 * @var $animation_css
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $main_nav_container
 * @var $full_height
 * @var $equal_height
 * @var $flex_row
 * @var $columns_placement
 * @var $content_placement
 * @var $gap
 * @var $no_gutter
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $overlay_bg_position
 * @var $this    WPBakeryShortCode_VC_Row
 */
$str_el_id = $content_width = $container_width = $background_position = $overlay_set = $overlay_image = $overlay_color = $text_color =
$overlay_opacity = $overlay_gradient_color_1 = $overlay_gradient_color_2 = $overlay_gradient_angle =
$parallax_speed = $animation_css = $animation_duration = $animation_delay =
$el_class = $full_height = $equal_height = $flex_row = $columns_placement = $text_color = $text_custom_color =
$heading_color = $heading_custom_color = $link_color = $link_custom_color = $link_hover_color = $link_hover_custom_color =
$content_placement = $gap = $no_gutter = $parallax = $parallax_image = $css = $tablet_css = $mobile_css =
$hide_on_desktop = $hide_on_tablet = $hide_on_mobile =
$font_size = $custom_font_size = $responsive_font_size = $responsive_compressor = $responsive_minimum_font_size =
$sloped_edge_position = $sloped_edge_color = $sloped_edge_top_degree = $sloped_edge_bottom_degree =
$sloped_edge_overlay_mode = $sloped_edge_top = $sloped_edge_bottom = $sloped_edge_position_mode =
$el_id = $video_bg = $video_bg_url = $video_bg_parallax = $overlay_bg_position = $enable_slip_section_options = $data_anchor = $data_tooltip = '';

$output = $after_output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/*-------------------------------------
    DISPLAY SECTION DISPLAY OUT OF THE ROW
---------------------------------------*/
$regex_content = '/\[floral_shortcode_content_template(.*?)\](.*?)/';
$_matches      = array();

if ( preg_match_all( $regex_content, $content, $matches ) ) {
    if ( !empty( $matches[0] ) && is_array( $matches[0] ) ) {
        $_matches = $matches[0];
    }
}

if ( !empty( $_matches ) ) {
    foreach ( $_matches as $template ) {
        echo wpb_js_remove_wpautop( $template );
    }

    return;
}

// ---------------------------------------------------------

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$uni_class       = uniqid( 'vc_row-' );
$section_classes = array(
    'vc_row',
    'floral-section',
    $el_class,
    $uni_class,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

//if($background_position != 'bgp-center-center-i'){
if(!empty($background_position)){
    $section_classes[] = esc_attr($background_position);
}


$css_classes = array(
    'vc_row',
    'wpb_row', //deprecated
    'vc_row-fluid',
);

// style class
if ( !empty( $text_color ) ) {
    $css_classes[] = $text_color . '-color';
}

if ( !empty( $heading_color ) ) {
    $css_classes[] = $heading_color . '-heading-color';
}

if ( !empty( $link_color ) ) {
    $css_classes[] = $link_color . '-link-color';
}

if ( !empty( $link_hover_color ) ) {
    $css_classes[] = $link_hover_color . '-link-hover-color';
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) || $video_bg || $parallax ) {
    $css_classes[] = 'vc_row-has-fill';
}

if ( $gap !== '' ) {
    $css_classes[] = 'vc_column-gap-' . $gap;
}

$section_attributes = array();
/*-------------------------------------
	BUILD ATTRIBUTES FOR WRAPPER
---------------------------------------*/
if ( !empty( $full_height ) ) {
    $css_classes[] = 'floral-fullheight';
    if ( !empty( $columns_placement ) ) {
        $flex_row      = true;
        $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
    }
}

if ( !empty( $equal_height ) ) {
    $flex_row      = true;
    $css_classes[] = ' vc_row-o-equal-height';
}

if ( !empty( $content_placement ) ) {
    $flex_row      = true;
    $css_classes[] = ' vc_row-o-content-' . $content_placement;
}

if ( !empty( $flex_row ) ) {
    $css_classes[] = ' vc_row-flex';
}

if ( !empty( $no_gutter ) ) {
    $css_classes[] = 'vc_row-column-no-gutter';
}


$has_video_bg = ( !empty( $video_bg ) && !empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
    $parallax          = $video_bg_parallax;
    $parallax_image    = $video_bg_url;
    $section_classes[] = ' vc_video-bg-container';
    wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( !empty( $parallax ) ) {
    wp_enqueue_script( 'vc_jquery_skrollr_js' );
    $section_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
    $section_classes[]    = 'vc_general vc_parallax vc_parallax-' . $parallax;
    if ( false !== strpos( $parallax, 'fade' ) ) {
        $section_classes[]    = 'js-vc_parallax-o-fade';
        $section_attributes[] = 'data-vc-parallax-o-fade="on"';
    } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
        $section_classes[] = 'js-vc_parallax-o-fixed';
    }
}

if ( !empty( $parallax_image ) ) {
    if ( $has_video_bg ) {
        $parallax_image_src = $parallax_image;
    } else {
        $parallax_image_id  = preg_replace( '/[^\d]/', '', $parallax_image );
        $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
        if ( !empty( $parallax_image_src[0] ) ) {
            $parallax_image_src = $parallax_image_src[0];
        }
    }
    $section_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( !$parallax && $has_video_bg ) {
    $section_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}


/*-------------------------------------
    OVERLAY COLOR OR IMAGE OR GRADIENT
---------------------------------------*/
$overlay_vc = '';
if ( $overlay_set != 'hide_overlay' ) {
    $section_classes[] = 'overlay-wrapper';
    $overlay_style     = array();
    if ( $overlay_set == 'show_overlay_color' ) {
        $overlay_style[] = 'background-color: ' . esc_attr( $overlay_color );
    } elseif ( $overlay_set == 'show_overlay_image' ) {
        $image_attributes = wp_get_attachment_image_src( $overlay_image, 'full' );
        $overlay_style[]  = 'background-image: url(\'' . esc_url( $image_attributes[0] ) . '\')';
        $overlay_style[]  = 'opacity: ' . esc_attr( $overlay_opacity );
    } elseif ( $overlay_set == 'show_overlay_gradient' ) {
        $color_1 = Floral_Map_Helpers::get_color_value( $overlay_gradient_color_1 );
        $color_2 = Floral_Map_Helpers::get_color_value( $overlay_gradient_color_2 );

        if ( !( $overlay_gradient_angle = floatval( $overlay_gradient_angle ) ) ) {
            $overlay_gradient_angle = 45;
        }
        
        $overlay_style   = Floral_Map_Helpers::get_gradient_inline_style( $color_1, $color_2, $overlay_gradient_angle );
        $overlay_style[] = 'opacity: ' . esc_attr( $overlay_opacity );
    }
    
    $overlay_vc = '<div class="overlay-object ' . $overlay_bg_position . '" ' . Floral_Map_Helpers::get_inline_style( $overlay_style ) . '></div>';
}


if ( !empty( $el_id ) ) {
    $section_attributes[] = 'id="' . esc_attr( $el_id ) . '" ';
}

/*-------------------------------------
	ROW CONTENT WIDTH
---------------------------------------*/
switch ( $content_width ) {
    case 'container':
        $style_layout = 'container';
        break;
    case 'container-xlg':
        $style_layout = 'container-xlg';
        break;
    case 'container-fluid':
        $style_layout = 'container-fluid';
        break;
	case 'fullwidth-visible':
		$style_layout = 'fullwidth-visible';
		break;
    default:
        $style_layout = 'fullwidth';
}

if ( $container_width == 'equal_to_content' ) {
    $section_classes[] = $style_layout;
}

/*-------------------------------------
	RESPONSIVE
---------------------------------------*/
if ( !empty( $hide_on_desktop ) ) {
    $section_classes[] = 'hide-on-desktop';
}

if ( !empty( $hide_on_tablet ) ) {
    $section_classes[] = 'hide-on-tablet';
}

if ( !empty( $hide_on_mobile ) ) {
    $section_classes[] = 'hide-on-mobile';
}

/*-------------------------------------
	FONT SIZE & RESPONSIVE
---------------------------------------*/
$data_responsive_fz = array();
if ( !empty( $font_size ) ) {
    if ( !empty( $responsive_font_size ) ) {
        $css_classes[] = 'responsive-font-size';

        if ( $font_size === 'custom' ) {
            $data_responsive_fz['font_size']['maxFontSize'] = intval( $custom_font_size );
        } else {
            $data_responsive_fz['font_size']['maxFontSize'] = intval( $font_size );
        }

        if ( !empty( $responsive_minimum_font_size ) ) {
            $data_responsive_fz['font_size']['minFontSize'] = intval( $responsive_minimum_font_size );
        }

        $responsive_compressor = ( !empty( $responsive_compressor ) && floatval( $responsive_compressor ) ) ? floatval( $responsive_compressor ) : 1;

        $data_responsive_fz['compressor'] = $responsive_compressor;
    } else {
        $css_classes[] = 'fz-' . $font_size;
        if ( $font_size === 'custom' ) {
            $style_inner[] = 'font-size: ' . $custom_font_size . 'px';
        }
    }
}

/*-------------------------------------
	CUSTOM STYLE
---------------------------------------*/
$vc_row_style = array();

// custom Text color
if ( $text_color === 'custom' && !empty( $text_custom_color ) ) {
    $vc_row_style[".$uni_class"] = 'color: ' . $text_custom_color;
}
// custom heading color
if ( $heading_color === 'custom' && !empty( $heading_custom_color ) ) {
    $vc_row_style[".$uni_class h1, .$uni_class h2, .$uni_class h3, .$uni_class h4, .$uni_class h5, .$uni_class h6"] = 'color: ' . $heading_custom_color;
}
// custom link color
if ( $link_color === 'custom' && !empty( $link_custom_color ) ) {
    $vc_row_style[".$uni_class a"] = 'color: ' . $link_custom_color;
}

// custom link hover & active
if ( $link_hover_color === 'custom' && !empty( $link_hover_custom_color ) ) {
    $vc_row_style[".$uni_class a:hover, .$uni_class a:active"] = 'color: ' . $link_hover_custom_color;
}

/*-------------------------------------
	SLOPED EDGE
---------------------------------------*/
$sloped_edge_top_markup    = '';
$sloped_edge_bottom_markup = '';
if ( $sloped_edge_position !== 'none' ) {
    $section_classes[] = 'sloped-edge-enabled';

    $position = ( !empty( $sloped_edge_position_mode ) && $sloped_edge_position_mode === 'static' ) ? false : true;
    
    if ( $sloped_edge_position === 'top' || $sloped_edge_position === 'both' ) {
        $sloped_edge_top_degree = intval( str_replace( array( 'deg' ), '', $sloped_edge_top_degree ) );
        $sloped_edge_top_markup = Floral_Map_Helpers::get_triangle_svg( $sloped_edge_top, $sloped_edge_top_degree, $sloped_edge_color, $position, array( 'top-edge', $sloped_edge_overlay_mode ) );
    }
    
    if ( $sloped_edge_position === 'bottom' || $sloped_edge_position === 'both' ) {
        $sloped_edge_bottom_degree = intval( str_replace( array( 'deg' ), '', $sloped_edge_bottom_degree ) );
        $sloped_edge_bottom_markup = Floral_Map_Helpers::get_triangle_svg( $sloped_edge_bottom, $sloped_edge_bottom_degree, $sloped_edge_color, $position, array( 'bottom-edge', $sloped_edge_overlay_mode ) );
    }
}

// ---------------------------------------------------------
$section_class        = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $section_classes ) ), $this->settings['base'], $atts ) );
$section_attributes[] = Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay );
$section_attributes[] = 'class="' . esc_attr( trim( $section_class ) ) . '"';
if ( $enable_slip_section_options === 'yes' ) {
    if ( !empty( $data_anchor ) ) {
        $section_attributes[] = 'data-anchor="' . esc_attr( trim( $data_anchor ) ) . '"';
    }
    if ( !empty( $data_tooltip ) ) {
        $section_attributes[] = 'data-navigation-tooltip="' . esc_attr( $data_tooltip ) . '"';
    }
}

Floral_VC_Customize::add_custom_shortcode_css( $vc_row_style );
?>
    <section <?php echo implode( ' ', $section_attributes ); ?>>
        <?php
        echo sprintf( '%s', $overlay_vc );
        echo sprintf( '%s', $sloped_edge_top_markup );
        ?>
        <?php if ( $container_width != 'equal_to_content' ) {
            echo '<div class="' . esc_attr( $style_layout ) . '">';
        } ?>
        <div class="<?php echo floral_clean_html_classes( $css_classes ) ?>" <?php echo ( !empty( $data_responsive_fz ) ) ? 'data-resize="' . esc_attr( json_encode( $data_responsive_fz ) ) . '"' : ''; ?>>
            <?php echo wpb_js_remove_wpautop( $content ); ?>
        </div>
        <?php if ( $container_width != 'equal_to_content' ) {
            echo '</div>';
        } ?>
        <?php echo sprintf( '%s', $sloped_edge_bottom_markup ); ?>
    </section>
<?php


