<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_widget_menu.php
 * @time    : 9/26/2016 9:33 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Widget_Menu
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Widget param
$title = $menu_id = $menu_slug = $menu_type = $menu_horizontal_submenu = $menu_tree_arrow = $menu_tree_icon = $menu_horizontal_submenu_color = $menu_fontsize = $menu_sub_reduce_fontsize = $menu_fontweight = $menu_text_align = $menu_text_transform = $menu_item_spacing = $enable_listing_icon = $icon_type = $icon_9wpthemes = $icon_floral = $icon_fontawesome = $icon_color = $menu_number_column = $floral_extra_widget_classes = $floral_remove_default_mb = '';

// Widget wrapper param
$css = $animation_css = $animation_duration = $animation_delay = $el_class = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$nav = get_term_by( 'slug', $menu_slug, 'nav_menu' );
if ( empty( $nav ) ) {
	return;
}
$menu_id = $nav->term_id;

$menu_list_icon = $menu_list_icon_color = '';
if ( ( $menu_type === 'floral-widget-vertical-menu' ) && ( $enable_listing_icon === 'yes' ) && ! empty ( ${"icon_$icon_type"} ) ) {
	$menu_list_icon       = ${"icon_$icon_type"};
	$menu_list_icon_color = $icon_color;
}


$widget_atts = array(
	'title'                         => $title,
	'menu_id'                       => $menu_id,
	'menu_type'                     => $menu_type,
	'menu_horizontal_submenu'       => $menu_horizontal_submenu,
	'menu_horizontal_submenu_color' => $menu_horizontal_submenu_color,
	'menu_fontsize'                 => $menu_fontsize,
	'$menu_sub_reduce_fontsize'     => $menu_sub_reduce_fontsize,
	'menu_fontweight'               => $menu_fontweight,
	'menu_text_align'               => $menu_text_align,
	'menu_text_transform'           => $menu_text_transform,
	'menu_tree_arrow'               => $menu_tree_arrow,
	'menu_tree_icon'                => $menu_tree_icon,
	'menu_item_spacing'             => $menu_item_spacing,
	'menu_list_icon'                => $menu_list_icon,
	'menu_list_icon_color'          => $menu_list_icon_color,
	'menu_number_column'            => $menu_number_column
);

$widget_wrapper_class = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

$widget_class   = array();
$widget_class[] = $floral_extra_widget_classes;
if ( ! empty( $floral_remove_default_mb ) ) {
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
	<?php the_widget( 'Floral_Widget_Menu', $widget_atts, $args ); ?>
</div>