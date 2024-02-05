<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_blog_posts.php
 * @time    : 4/5/2017 3:48 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Blog_Posts
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$posts_category = $posts_style = $posts_layout_type = $posts_equal_height_items = $posts_sort_order = $posts_total_items = $posts_column = $posts_image_size =
$posts_image_ratio = $posts_show_author = $posts_show_date = $posts_show_category = $posts_show_excerpt = $posts_excerpt_length =
$el_class =
$sc_loop = $sc_center = $sc_nav = $sc_dots = $sc_nav_pag_style = $sc_nav_pag_scheme_color = $sc_autoplay = $sc_autoplaytimeout =
$sc_autoplayhoverpause = $sc_mouse_wheel = $sc_start_position = $animation_in = $animation_out = $sc_auto_width = $sc_auto_height =
$sc_margin_right = $sc_pag_margin_top = $sc_items = $sc_items_desktop = $sc_items_desktop_small = $sc_items_tablet = $sc_items_tablet_small = $sc_items_mobile =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$class_blog_posts = array(
	'floral-blog-posts-' . $posts_style,
	$posts_layout_type,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

if ($posts_layout_type === 'layout-slider' && $posts_equal_height_items === 'yes') {
	$class_blog_posts[] = '.owl-item-equal-height';
}

$class_posts_item   = array();
$class_posts_item[] = 'vc_column_container';

if ( $posts_layout_type === 'layout-grid' ) {
	switch ( $posts_column ) {
		case 1:
			$class_posts_item[] = 'col-xs-12';
			break;
		case 2:
			$class_posts_item[] = 'col-md-6 col-xs-12';
			break;
		case 3:
			$class_posts_item[] = 'col-md-4 col-sm-6 col-xs-12';
			break;
		case 4:
			$class_posts_item[] = 'col-md-3 col-sm-6 col-xs-12';
			break;
	}
}

// header

$feature_args = array();
if ( ! empty( $posts_image_size ) ) {
	$feature_args['image_size'] = $posts_image_size;
}
if ( ! empty( $posts_image_ratio ) ) {
	$feature_args['image_ratio'] = $posts_image_ratio;
}

$feature_args['action'] = 'link'; // 'link' or 'none'

// Query
$query['posts_per_page']      = $posts_total_items;
$query['no_found_rows']       = true;
$query['post_status']         = 'publish';
$query['ignore_sticky_posts'] = true;
$query['post_type']           = 'post';
if ( ! empty( $posts_category ) ) {
	$query['tax_query'] = array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio' ),
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'category',
			'terms'    => explode( '||', $posts_category ),
			'field'    => 'slug',
			'operator' => 'IN'
		)
	);
} else {
	$query['tax_query'] = array(
		array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio' ),
			'operator' => 'NOT IN'
		)
	);
}
if ( $posts_sort_order == 'random' ) {
	$query['orderby'] = 'rand';
} elseif ( $posts_sort_order == 'popular' ) {
	$query['orderby'] = 'comment_count';
} elseif ( $posts_sort_order == 'recent' ) {
	$query['orderby'] = 'post_date';
	$query['order']   = 'DESC';
} else {
	$query['orderby'] = 'post_date';
	$query['order']   = 'ASC';
}
$r = new WP_Query( $query );
?>
<div class="floral-blog-posts clearfix <?php floral_the_clean_html_classes( $class_blog_posts ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
	<?php
	ob_start();
	if ( $r->have_posts() ) :
		$i = 0;
		?>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<div class="posts-item <?php floral_the_clean_html_classes( $class_posts_item ) ?>">
			<?php if ( $posts_layout_type === 'layout-grid' ) {
				echo '<div class="vc_column-inner">';
			} ?>
			<div class="posts-item-inner">
				<?php
				if ( $posts_style === 'style-2v' ) {
					$i ++;
					if ( ( $i !== 0 ) && ( $i % 2 === 0 ) ) {
						include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-blog-posts/style-2.php' );
					}
				}
				?>
				<div class="entry-header">
					<div class="entry-thumbnail-wrapper">
						<?php echo sprintf( '%s', Floral_Blog::post_feature_format_auto( $feature_args ) ); ?>
					</div>
				</div>
				<?php
				if ( in_array( $posts_style, array( 'style-1', 'style-2', 'style-3', 'style-4' ) ) ) {
					include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-blog-posts/' . $posts_style . '.php' );
				}
				if ( ( ( $i === 0 ) || ( $i % 2 === 1 ) ) && $posts_style === 'style-2v' ) {
					include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-blog-posts/style-2.php' );
				}
				?>
			</div>
			<?php if ( $posts_layout_type === 'layout-grid' ) {
				echo '</div>';
			} ?>
		</div>
	<?php endwhile;
	endif;
	wp_reset_postdata();
	$items_content = ob_get_clean();
	/*-------------------------------------
	LAYOUT STYLE
	---------------------------------------*/
	if ( $posts_layout_type === 'layout-grid' ) {
		$class_posts_grid_wrapper = array( 'vc_row' );
		if ($posts_equal_height_items === 'yes') {
			$class_posts_grid_wrapper[] = 'vc_row-o-equal-height vc_row-flex';
		}
		echo sprintf( '<div class="posts-layout-grid-wrapper %s">%s</div>', floral_clean_html_classes( $class_posts_grid_wrapper ), $items_content );
	} elseif ( $posts_layout_type === 'layout-slider' ) {
		$slider_atts = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Slider_Container::SC_BASE, $atts );
		echo Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Slider_Container::SC_BASE )->output( $slider_atts, $items_content );
	}
	?>
</div>