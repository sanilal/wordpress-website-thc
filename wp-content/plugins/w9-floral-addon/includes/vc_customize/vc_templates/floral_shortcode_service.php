<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_service.php
 * @time    : 4/20/2017 3:03 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Service
 * @var $atts
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

$services_data = $services_category = $services_name = $services_style = $services_layout_type = $services_equal_height_items = $services_sort_order = $services_total_items = $services_column = $services_image_size = $services_image_ratio = $services_show_price = $services_show_time = $services_show_booking_btn = $services_booking_btn_tx =
$el_class =
$sc_loop = $sc_center = $sc_nav = $sc_dots = $sc_nav_pag_style = $sc_nav_pag_scheme_color = $sc_autoplay = $sc_autoplaytimeout =
$sc_autoplayhoverpause = $sc_mouse_wheel = $sc_start_position = $animation_in = $animation_out = $sc_auto_width = $sc_auto_height =
$sc_margin_right = $sc_pag_margin_top = $sc_items = $sc_items_desktop = $sc_items_desktop_small = $sc_items_tablet = $sc_items_tablet_small = $sc_items_mobile =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$class_services = array(
	'floral-services-' . $services_style,
	$services_layout_type,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

if ( $services_layout_type === 'layout-slider' && $services_equal_height_items === 'yes' ) {
	$class_services[] = '.owl-item-equal-height';
}

$class_services_item   = array();
$class_services_item[] = 'vc_column_container';

if ( $services_layout_type === 'layout-grid' ) {
	switch ( $services_column ) {
		case 1:
			$class_services_item[] = 'col-xs-12';
			break;
		case 2:
			$class_services_item[] = 'col-md-6 col-xs-12';
			break;
		case 3:
			$class_services_item[] = 'col-md-4 col-sm-6 col-xs-12';
			break;
		case 4:
			$class_services_item[] = 'col-md-3 col-sm-6 col-xs-12';
			break;
	}
}

// header

if ( empty( $services_image_size ) ) {
	$services_image_size = 'thumbnail';
}
if ( ( empty( $services_image_ratio ) ) || ( $services_style === 'style-2' ) ) {
	$services_image_ratio = 'original';
}

// booking url
$booking_page_url = '#book-now';
$booking_page  = floral_get_option( 'service-booking-page' );
if ( ! empty( $booking_page ) ) {
	$booking_page_url = esc_url($booking_page);
}

// Query
if ( $services_data === 'category' ) {
	$query['posts_per_page'] = $services_total_items;
} elseif ( $services_data === 'name' ) {
	$query['posts_per_page'] = - 1;
}
$query['no_found_rows']       = true;
$query['post_status']         = 'publish';
$query['ignore_sticky_posts'] = true;
$query['post_type']           = Floral_CPT_Service::CPT_SLUG;
if ( ( $services_data === 'category' ) && ( ! empty( $services_category ) ) ) {
	$query['tax_query'] = array(
		array(
			'taxonomy' => Floral_CPT_Service::TAX_SLUG,
			'terms'    => explode( '||', $services_category ),
			'field'    => 'slug',
			'operator' => 'IN'
		)
	);
}
if ( $services_data === 'category' ) {
	if ( $services_sort_order == 'random' ) {
		$query['orderby'] = 'rand';
		//} elseif ( $services_sort_order == 'popular' ) {
		//	$query['orderby'] = 'comment_count';
	} elseif ( $services_sort_order == 'recent' ) {
		$query['orderby'] = 'post_date';
		$query['order']   = 'DESC';
	} else {
		$query['orderby'] = 'post_date';
		$query['order']   = 'ASC';
	}
} elseif ( $services_data === 'name' ) {
	$query['orderby'] = 'none';
}
$r = new WP_Query( $query );

$service_list_id       = array();
$service_list_id_limit = '';
if ( ( $services_data === 'name' ) && ! empty( $services_name ) ) {
	$service_list_id       = explode( '||', $services_name );
	$service_list_id_limit = $services_total_items;
	if ( ($services_total_items == - 1) || ( count( $service_list_id ) < $services_total_items)   ) {
		$service_list_id_limit = count( $service_list_id );
	}
}

//echo( $service_list_id_limit + 1 );
//var_dump( $service_list_id );
?>
<div class="floral-sc-services clearfix <?php floral_the_clean_html_classes( $class_services ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php
	ob_start();
	if ( $r->have_posts() ) :
		if ( $services_data === 'category' ) :
			while ( $r->have_posts() ) : $r->the_post();
//				echo 'abc';
				include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-service/' . $services_style . '.php' );
			endwhile;
		elseif ( $services_data === 'name' ):
			$i            = 0;
			$display_item = ( empty( $services_name ) ) ? false : true;
			while ( $display_item ) : ;
				$i ++;
//				echo 'abc';
				if ( $i >= ( $service_list_id_limit ) ) {
					$display_item = false;
				}
				include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-service/' . $services_style . '.php' );
			endwhile;
		endif;
	endif;
	wp_reset_postdata();
	$items_content = ob_get_clean();
	/*-------------------------------------
	LAYOUT STYLE
	---------------------------------------*/
	if ( $services_layout_type === 'layout-grid' ) {
		$class_services_grid_wrapper = array( 'vc_row' );
		if ( $services_equal_height_items === 'yes' ) {
			$class_services_grid_wrapper[] = 'vc_row-o-equal-height vc_row-flex';
		}
		echo sprintf( '<div class="services-layout-grid-wrapper %s">%s</div>', floral_clean_html_classes( $class_services_grid_wrapper ), $items_content );
	} elseif ( $services_layout_type === 'layout-slider' ) {
		$slider_atts = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Slider_Container::SC_BASE, $atts );
		echo Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Slider_Container::SC_BASE )->output( $slider_atts, $items_content );
	}
	?>
</div>