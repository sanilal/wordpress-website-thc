<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_event.php
 * @time    : 4/25/2017 9:21 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Event::CPT_SLUG ) ) {
	return;
}

$event_data = $event_category = $event_name = $event_style = $event_layout_type = $event_equal_height_items = $event_sort_order = $event_total_items = $event_column = $event_image_size =
$type = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial =
$el_class =
$sc_loop = $sc_center = $sc_nav = $sc_dots = $sc_nav_pag_style = $sc_nav_pag_scheme_color = $sc_autoplay = $sc_autoplaytimeout =
$sc_autoplayhoverpause = $sc_mouse_wheel = $sc_start_position = $animation_in = $animation_out = $sc_auto_width = $sc_auto_height =
$sc_margin_right = $sc_pag_margin_top = $sc_items = $sc_items_desktop = $sc_items_desktop_small = $sc_items_tablet = $sc_items_tablet_small = $sc_items_mobile =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$class_event = array(
	'floral-event-' . $event_style,
	$event_layout_type,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

if ( $event_layout_type === 'layout-slider' && $event_equal_height_items === 'yes' ) {
	$class_event[] = '.owl-item-equal-height';
}

$class_event_item   = array();
$class_event_item[] = 'vc_column_container';

if ( $event_layout_type === 'layout-grid' ) {
	switch ( $event_column ) {
		case 1:
			$class_event_item[] = 'col-xs-12';
			break;
		case 2:
			$class_event_item[] = 'col-md-6 col-xs-12';
			break;
		case 3:
			$class_event_item[] = 'col-md-4 col-sm-6 col-xs-12';
			break;
		case 4:
			$class_event_item[] = 'col-md-3 col-sm-6 col-xs-12';
			break;
	}
}

// header

if ( empty( $event_image_size ) ) {
	$event_image_size = 'thumbnail';
}
if ( ( empty( $event_image_ratio ) ) || ( $event_style === 'style-2' ) ) {
	$event_image_ratio = 'original';
}

// booking url
$booking_page_url = '#';
$booking_page_id  = floral_get_option( 'event-booking-page' );
if ( ! empty( $booking_page_id ) ) {
	$booking_page_url = get_page_link( $booking_page_id );
}

// Query
if ( $event_data === 'category' ) {
	$query['posts_per_page'] = $event_total_items;
} elseif ( $event_data === 'name' ) {
	$query['posts_per_page'] = - 1;
}
$query['no_found_rows']       = true;
$query['post_status']         = 'publish';
$query['ignore_sticky_posts'] = true;
$query['post_type']           = Floral_CPT_Event::CPT_SLUG;
if ( ( $event_data === 'category' ) && ( ! empty( $event_category ) ) ) {
	$query['tax_query'] = array(
		array(
			'taxonomy' => Floral_CPT_Event::TAX_SLUG,
			'terms'    => explode( '||', $event_category ),
			'field'    => 'slug',
			'operator' => 'IN'
		)
	);
}
if ( $event_data === 'category' ) {
	if ( $event_sort_order == 'random' ) {
		$query['orderby'] = 'rand';
		//} elseif ( $event_sort_order == 'popular' ) {
		//	$query['orderby'] = 'comment_count';
	} elseif ( $event_sort_order == 'recent' ) {
		$query['orderby'] = 'post_date';
		$query['order']   = 'DESC';
	} else {
		$query['orderby'] = 'post_date';
		$query['order']   = 'ASC';
	}
} elseif ( $event_data === 'name' ) {
	$query['orderby'] = 'none';
}
$r = new WP_Query( $query );

$event_list_id       = array();
$event_list_id_limit = '';
if ( ( $event_data === 'name' ) && ! empty( $event_name ) ) {
	$event_list_id       = explode( '||', $event_name );
	$event_list_id_limit = $event_total_items;
	if ( ($event_total_items == - 1) || ( count( $event_list_id ) < $event_total_items)   ) {
		$event_list_id_limit = count( $event_list_id );
	}
}

vc_icon_element_fonts_enqueue( $type );
$_icon = isset( ${'icon_' . $type} ) ? esc_attr( ${'icon_' . $type} ) : 'flor-ico flor-ico-lotus-logo-icon';

//echo( $event_list_id_limit + 1 );
//var_dump( $event_list_id );
?>
<div class="floral-sc-event clearfix <?php floral_the_clean_html_classes( $class_event ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php
	ob_start();
	if ( $r->have_posts() ) :
		$order = 0;
		if ( $event_data === 'category' ) :
			while ( $r->have_posts() ) : $r->the_post();
				$order ++;
//				echo 'abc';
				include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-event/' . $event_style . '.php' );
			endwhile;
		elseif ( $event_data === 'name' ):
			$i            = 0;
			$display_item = ( empty( $event_name ) ) ? false : true;
			while ( $display_item ) : ;
				$order ++;
				$i ++;
//				echo 'abc';
				if ( $i >= ( $event_list_id_limit ) ) {
					$display_item = false;
				}
				include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-event/' . $event_style . '.php' );
			endwhile;
		endif;
	endif;
	wp_reset_postdata();
	$items_content = ob_get_clean();
	/*-------------------------------------
	LAYOUT STYLE
	---------------------------------------*/
	if ( $event_layout_type === 'layout-grid' ) {
		$class_event_grid_wrapper = array( 'vc_row' );
		if ( $event_equal_height_items === 'yes' ) {
			$class_event_grid_wrapper[] = 'vc_row-o-equal-height vc_row-flex';
		}
		echo sprintf( '<div class="event-layout-grid-wrapper %s">%s</div>', floral_clean_html_classes( $class_event_grid_wrapper ), $items_content );
	} elseif ( $event_layout_type === 'layout-slider' ) {
		$slider_atts = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Slider_Container::SC_BASE, $atts );
		echo Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Slider_Container::SC_BASE )->output( $slider_atts, $items_content );
	}
	?>
</div>