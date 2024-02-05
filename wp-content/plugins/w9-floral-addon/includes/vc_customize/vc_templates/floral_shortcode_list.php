<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_list.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_List
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$values                          = '';
$list_style                      = '';
$list_text_fw                    = '';
$list_icon_align                 = '';
$font_size                       = '';
$list_icon                       = '';
$list_icon_type                  = '';
$list_icon_image                 = '';
$icon_color                      = '';
$icon_custom_color               = '';
$list_icon_size                  = '';
$list_item_spacing               = '';
$list_icon_fix_vertical_position = '';
$list_icon_text_spacing          = '';

$type = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial = '';

$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$sc_classes = array(
	'list-style-' . $list_style,
	'list-item-spacing-' . $list_item_spacing,
	'list-' . $list_icon_align,
	$list_text_fw,
	$el_class,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	vc_shortcode_custom_css_class( $css ),
);


$default_icon = '';
if ( ( $list_icon === 'yes' ) && ( $list_icon_type === 'type-icon-lib' ) ) {
	vc_icon_element_fonts_enqueue( $type );
	$default_icon = isset( ${"icon_$type"} ) ? ${"icon_$type"} : '';
}

$icon_inline_css = array();
//var_dump( $list_icon_image );
if ( ( $list_icon === 'yes' ) && ( $list_icon_type === 'type-bgi' ) && ! empty( $list_icon_image ) ) {
	$default_icon = 'icon-type-bgi';
	$img_id                              = preg_replace( '/[^\d]/', '', $list_icon_image );
	$icon_inline_css['background-image'] = 'background-image: url(' . Floral_Image::get_resize_image_url( $img_id, 'floral_tiny', array( 'ratio' => '1' ) ) . ')';
}
if ( ! empty( $list_icon_size ) && $list_icon_size !== '100%' ) {
	$icon_inline_css[] = 'font-size: ' . $list_icon_size;
}
if ( $icon_color === 'custom' ) {
	$icon_inline_css[] = 'color: ' . $icon_custom_color;
}

if ( ! empty( $list_icon_fix_vertical_position ) && $list_icon_fix_vertical_position !== '0px' ) {
	$icon_inline_css[] = 'top: ' . $list_icon_fix_vertical_position;
}

if ( $list_icon_text_spacing !== '0.8em' ) {
	if ( $list_icon_align === 'align-icon-left' ) {
		$icon_inline_css[] = 'margin-right: ' . $list_icon_text_spacing;
	} elseif ( $list_icon_align === 'align-icon-right' ) {
		$icon_inline_css[] = 'margin-left: ' . $list_icon_text_spacing;
	}
}

if ( ! empty( $values ) ) {
	$values = (array) vc_param_group_parse_atts( $values );
} else {
	$values = array();
}

?>
<ul class="floral-list <?php floral_the_clean_html_classes( $sc_classes ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php foreach ( $values as $item ):
		$item_icon = $default_icon;
	
		if ( isset( $item['add_icon'] ) && ( $item['add_icon'] === 'yes' ) ) {
			if ( ( $item['icon_type'] === 'type-icon-lib' ) && ( ! empty( $item[ 'icon_' . $item['type'] ] ) ) ) {
				vc_icon_element_fonts_enqueue( $item['type'] );
				$item_icon = $item[ 'icon_' . $item['type'] ];
				$icon_inline_css['background-image'] = '';
			}
			// for icon using background image
			if ( ( $item['icon_type'] === 'type-bgi' ) && ! empty( $item['image'] ) ) {
				$item_icon = 'icon-type-bgi';
				$item_img_id                         = preg_replace( '/[^\d]/', '', $item['image'] );
				$icon_inline_css['background-image'] = 'background-image: url(' . Floral_Image::get_resize_image_url( $item_img_id, 'floral_tiny', array( 'ratio' => '1' ) ) . ')';
			}
		}
		
		$item_title = isset( $item['title'] ) ? $item['title'] : '';
		
		$icon_content = '';
		if ( ! empty( $item_icon ) ) {
			$icon_content = '<i class="floral-inline-icon ' . floral_clean_html_classes( array(
					$icon_color . '-color',
					$item_icon
				) ) . '" ' . Floral_Map_Helpers::get_inline_style( $icon_inline_css ) . '></i>';
		}
		
		$item_content = '<span>' . $item_title . '</span>';
		// icon alignment
		if ( $list_icon_align === 'align-icon-left' ) {
			$item_content = $icon_content . $item_content;
		} elseif ( $list_icon_align === 'align-icon-right' ) {
			$item_content = $item_content . $icon_content;
		}
		
		if ( isset( $item['item_link'] ) ) {
			$link     = vc_build_link( $item['item_link'] );
			$a_href   = ! empty( $link['url'] ) ? $link['url'] : '';
			$a_title  = ! empty( $link['title'] ) ? $link['title'] : '';
			$a_target = ! empty( $link['target'] ) ? $link['target'] : '_self';
			$a_rel    = ! empty( $link['rel'] ) ? $link['rel'] : '';
			
			if ( $a_href !== '' ) {
				$item_content = Floral_Wrap::link( $item_content, $a_href, array(
					'title'  => $a_title,
					'target' => $a_target,
					'rel'    => $a_rel
				) );
			}
		}
		
		?>
		<li class="list-item ls-005"><?php echo sprintf( '%s', $item_content ); ?></li>
	<?php endforeach; ?>
</ul>