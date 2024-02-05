<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_single_image.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $source
 * @var $image
 * @var $custom_src
 * @var $onclick
 * @var $img_size
 * @var $img_size_custom
 * @var $external_img_size
 * @var $caption
 * @var $img_link_large
 * @var $link
 * @var $img_link_target
 * @var $alignment
 * @var $el_class
 * @var $css_animation
 * @var $style
 * @var $external_style
 * @var $border_color
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Single_Image
 */
$title = $source = $image = $custom_src = $onclick = $hover_effect = $img_size = $img_size_custom = $image_ratio = $external_img_size = $external_border_color = $custom_border_color = $custom_external_border_color = $video_link =
$caption = $img_link_large = $link = $img_link_target = $alignment = $el_class = $css_animation = $style = $external_style = $border_color = $css = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

if ( $img_size == 'custom' ) {
	$img_size = $img_size_custom;
}
$click_action = $onclick;
$default_src  = vc_asset_url( 'vc/no_image.png' );

// backward compatibility. since 4.6
if ( empty( $onclick ) && isset( $img_link_large ) && 'yes' === $img_link_large ) {
	$onclick = 'img_link_large';
} elseif ( empty( $atts['onclick'] ) && ( ! isset( $atts['img_link_large'] ) || 'yes' !== $atts['img_link_large'] ) ) {
	$onclick = 'custom_link';
}

if ( 'external_link' === $source ) {
	$style = $external_style;
	
	if ( $external_border_color === 'custom' ) {
		$border_color = $custom_external_border_color;
	} else {
		$border_color = Floral_Map_Helpers::get_color_value( $external_border_color );
	}
} else {
	if ( $border_color === 'custom' ) {
		$border_color = $custom_border_color;
	} else {
		$border_color = Floral_Map_Helpers::get_color_value( $border_color );
	}
}


$img = false;

switch ( $source ) {
	case 'media_library':
	case 'featured_image':
		
		if ( 'featured_image' === $source ) {
			$post_id = get_the_ID();
			if ( $post_id && has_post_thumbnail( $post_id ) ) {
				$img_id = get_post_thumbnail_id( $post_id );
			} else {
				$img_id = 0;
			}
		} else {
			$img_id = preg_replace( '/[^\d]/', '', $image );
		}
		
		// set rectangular
		if ( preg_match( '/_circle_2$/', $style ) ) {
			$style    = preg_replace( '/_circle_2$/', '_circle', $style );
			$img_size = $this->getImageSquareSize( $img_id, $img_size );
		}
		
		if ( ! $img_size ) {
			$img_size = 'medium';
		}
		
		if ( class_exists( 'Floral_Image' ) ) {
			$img_attr      = array();
			$img_attr['extra-class'] = 'vc_single_image-img';
			if ( ! empty( $image_ratio ) && $image_ratio != 'original' ) {
				$img_attr['ratio'] = $image_ratio;
			}
			$img_attr['alt'] = 'image';
			$img['thumbnail'] = Floral_Image::get_image( $img_id, $img_size, $img_attr );
			
		} else {
			$img = wpb_getImageBySize( array(
				'attach_id'  => $img_id,
				'thumb_size' => $img_size,
				'class'      => 'vc_single_image-img',
			) );
		}
		
		
		// don't show placeholder in public version if post doesn't have featured image
		if ( 'featured_image' === $source ) {
			if ( ! $img && 'page' === vc_manager()->mode() ) {
				return;
			}
		}
		
		break;
	
	case 'external_link':
		$dimensions = vcExtractDimensions( $external_img_size );
		$hwstring   = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
		
		$custom_src = $custom_src ? esc_attr( $custom_src ) : $default_src;
		
		$img = array(
			'thumbnail' => '<img class="vc_single_image-img" ' . $hwstring . ' src="' . $custom_src . '" alt="' . __( 'External Link', 'w9-floral-addon' ) . '"/>',
		);
		break;
	
	default:
		$img = false;
}

if ( ! $img ) {
	$img['thumbnail'] = '<img class="vc_img-placeholder vc_single_image-img" src="' . $default_src . '" alt="' . __( 'Placeholder', 'w9-floral-addon' ) . '"/>';
}

$el_class = $this->getExtraClass( $el_class );

// backward compatibility
if ( vc_has_class( 'prettyphoto', $el_class ) ) {
	$onclick = 'link_image';
}

// backward compatibility. will be removed in 4.7+
if ( ! empty( $atts['img_link'] ) ) {
	$link = $atts['img_link'];
	if ( ! preg_match( '/^(https?\:\/\/|\/\/)/', $link ) ) {
		$link = 'http://' . $link;
	}
}

// backward compatibility
if ( in_array( $link, array( 'none', 'link_no' ) ) ) {
	$link = '';
}

$a_attrs = array();

$large_size = has_image_size( 'floral_1170' ) ? 'floral_1170' : 'large';

switch ( $onclick ) {
	case 'img_link_large':
		
		if ( 'external_link' === $source ) {
			$link = $custom_src;
		} else {
			$link = wp_get_attachment_image_src( $img_id, $large_size );
			$link = $link[0];
		}
		
		break;
	
	case 'link_image':
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		
		$a_attrs['class'] = 'prettyphoto';
//        $a_attrs['data-rel'] = 'prettyPhoto[rel-__-' . rand() . ']';
		$a_attrs['data-rel'] = 'prettyPhoto';
		
		// backward compatibility
		if ( vc_has_class( 'prettyphoto', $el_class ) ) {
			// $link is already defined
		} elseif ( 'external_link' === $source ) {
			$link = $custom_src;
		} else {
			$link = wp_get_attachment_image_src( $img_id, $large_size );
			$link = $link[0];
		}
		
		break;
	
	case 'custom_link':
		// $link is already defined
		break;
	
	case 'zoom':
		wp_enqueue_script( 'vc_image_zoom' );
		
		if ( 'external_link' === $source ) {
			$large_img_src = $custom_src;
		} else {
			$large_img_src = wp_get_attachment_image_src( $img_id, $large_size );
			if ( $large_img_src ) {
				$large_img_src = $large_img_src[0];
			}
		}
		
		$img['thumbnail'] = str_replace( '<img ', '<img data-vc-zoom="' . $large_img_src . '" ', $img['thumbnail'] );
		
		break;
	case 'popup-video':
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		
		if ( ! empty( $video_link ) ) {
			$link                   = $video_link;
			$a_attrs['data-rel']         = 'prettyPhoto';
			$a_attrs['class']       = 'prettyPhoto';
			$a_attrs['data-width']  = 1000;
			$a_attrs['data-height'] = ( 1000 * 9 / 16 );
		}
		
		break;
}

// backward compatibility
if ( vc_has_class( 'prettyphoto', $el_class ) ) {
	$el_class = vc_remove_class( 'prettyphoto', $el_class );
}

//$border_color = ( '' !== $border_color ) ? ' vc_box_border_' . $border_color : '';

$wrapperClass = 'vc_single_image-wrapper ' . $style;

//var_dump($click_action);
$hover_overlay = '';
if ( ! empty( $click_action ) && ( $hover_effect === 'yes' ) ) {
	if ($onclick === 'link_image') {
		$hover_overlay = '<div class="__overlay"><i class="flor-ico flor-ico-icon-zoom-in-alt"></i></div>';
	} else {
		$hover_overlay = '<div class="__overlay"><i class="flor-ico flor-ico-icon-link"></i></div>';
	}
}
if ( $link ) {
	$a_attrs['href']   = $link;
	$a_attrs['target'] = $img_link_target;
	if ( ! empty( $a_attrs['class'] ) ) {
		$wrapperClass .= ' ' . $a_attrs['class'];
		unset( $a_attrs['class'] );
	}
	$html = '<a ' . vc_stringify_attributes( $a_attrs ) . ' class="' . $wrapperClass . '">' . $hover_overlay . $img['thumbnail'] . '</a>';
} else {
	$html = '<div class="' . $wrapperClass . '">' . $hover_overlay . $img['thumbnail'] . '</div>';
}

$uni_class       = uniqid( 'vc_image-' );
$class_to_filter = 'wpb_single_image ' . $uni_class . ' vc_align_' . $alignment . ' ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
if ( in_array( $source, array( 'media_library', 'featured_image' ) ) && 'yes' === $add_caption ) {
	$post    = get_post( $img_id );
	$caption = $post->post_excerpt;
} else {
	if ( 'external_link' === $source ) {
		$add_caption = 'yes';
	}
}

if ( 'yes' === $add_caption && '' !== $caption ) {
	$html .= '<figcaption class="vc_figure-caption">' . esc_html( $caption ) . '</figcaption>';
}
// border color
$internal_style = array();
if ( $border_color ) {
	if ( strpos( $style, 'box_outline' ) !== false ) {
		$internal_style[".$uni_class.wpb_single_image .vc_single_image-wrapper.vc_box_outline"][]        = 'border-color: ' . $border_color;
		$internal_style[".$uni_class.wpb_single_image .vc_single_image-wrapper.vc_box_outline_circle"][] = 'border-color: ' . $border_color;
	}
	
	if ( strpos( $style, 'box_border' ) !== false ) {
		$internal_style[".$uni_class.wpb_single_image .vc_single_image-wrapper.vc_box_border"][]        = 'background-color: ' . $border_color;
		$internal_style[".$uni_class.wpb_single_image .vc_single_image-wrapper.vc_box_border_circle"][] = 'background-color: ' . $border_color;
	}
	
	if ( strpos( $style, 'border-out' ) !== false ) {
		$internal_style[".$uni_class.wpb_single_image .vc_single_image-wrapper:after"][] = 'border-color: ' . $border_color;
	}
}

Floral_VC_Customize::add_custom_shortcode_css( $internal_style );

$output = '
	<div class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_singleimage_heading' ) ) . '
		<figure class="wpb_wrapper vc_figure">
			' . $html . '
		</figure>
	</div>
';

echo $output;
