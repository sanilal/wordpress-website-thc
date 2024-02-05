<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_testimonials.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Testimonials
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$testimonial_source = $testimonial_values = $testimonial_category = $testimonial_items = $testimonial_style =
$testimonial_border_box_shadow = $testimonial_show_author_avatar = $testimonial_show_author_rating = $testimonial_color_scheme =
$testimonial_layout = $testimonial_columns = $testimonial_spacing = $el_class =
$sc_loop = $sc_center = $sc_nav = $sc_dots = $sc_nav_pag_style = $sc_nav_pag_scheme_color = $sc_autoplay = $sc_autoplaytimeout =
$sc_autoplayhoverpause = $sc_mouse_wheel = $sc_start_position = $animation_in = $animation_out = $sc_auto_width = $sc_auto_height =
$sc_margin_right = $sc_pag_margin_top = $sc_items = $sc_items_desktop = $sc_items_desktop_small = $sc_items_tablet = $sc_items_tablet_small = $sc_items_mobile =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

//class
if ($testimonial_style === 'style-floral' ) {
    $testimonial_color_scheme = '';
}

$class_testimonials = array(
    $testimonial_style,
    $testimonial_color_scheme,
    $testimonial_layout,
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    Floral_Map_Helpers::get_class_animation( $animation_css )
);

if ( $testimonial_border_box_shadow === 'yes' ) {
    $class_testimonials[] = 'border-box-shadow-enabled';
}

if ( $testimonial_layout == 'layout-slider' && $sc_center == '1' ) {
    $class_testimonials[] = 'slider-center-mode';
}

?>
<div class="floral-testimonials <?php floral_the_clean_html_classes( $class_testimonials ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( array(), $animation_duration, $animation_delay ); ?>>
    <?php
    ob_start();
    if ( $testimonial_source === 'review-cpt' ) :
        if ( !empty( $testimonial_category ) ) :
            $testimonial_category = explode( '||', $testimonial_category );
            
            $testimonial_items = !empty( $testimonial_items ) ? intval( $testimonial_items ) : 6;
            
            $query_vars = array(
                'posts_per_page' => $testimonial_items,
                'post_type'      => Floral_CPT_Review::CPT_SLUG,
                'orderby'        => 'date',
                'order'          => 'ASC',
                'post_status'    => 'publish',
                'tax_query'      => array(
                    array(
                        'taxonomy' => Floral_CPT_Review::TAX_SLUG,
                        'field'    => 'slug',
                        'terms'    => $testimonial_category,
                        'operator' => 'IN'
                    )
                )
            );
            $query      = new WP_Query( $query_vars );
            
            if ( $query->have_posts() ):
                while ( $query->have_posts() ): $query->the_post();
                    $testimonial_content       = get_post_meta( get_the_ID(), 'meta-review-content', true );
                    $testimonial_rate          = get_post_meta( get_the_ID(), 'meta-review-rating', true );
                    $testimonial_author_name   = get_post_meta( get_the_ID(), 'meta-review-author-name', true );
                    $testimonial_author_url    = get_post_meta( get_the_ID(), 'meta-review-author-url', true );
                    $testimonial_author_job    = get_post_meta( get_the_ID(), 'meta-review-author-job', true );
                    $testimonial_author_avatar = get_post_meta( get_the_ID(), 'meta-review-author-avatar', true );
                    
                    $testimonial_author_avatar = ( !empty( $testimonial_author_avatar ) && !empty( $testimonial_author_avatar['id'] ) ) ? $testimonial_author_avatar['id'] : '';
                    
                    // url
                    $testimonial_author_url = ( !empty( $testimonial_author_url ) ) ? $testimonial_author_url : '#';
                    $a_href                 = $testimonial_author_url;
                    $a_title                = '';
                    $a_target               = '_self';
                    
                    /*-------------------------------------
                        REQUIRE STYLE TEMPLATE
                    ---------------------------------------*/
                    include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-testimonials/' . $testimonial_style . '.php' );
                endwhile;
            endif;
            wp_reset_postdata();
        endif;
    elseif ( $testimonial_source === 'review-manual' ):
        $testimonial_values = (array) vc_param_group_parse_atts( $testimonial_values );
        foreach ( $testimonial_values as $id => $testimonial ) :
            $testimonial_content       = !empty( $testimonial['testimonial_content'] ) ? $testimonial['testimonial_content'] : '';
            $testimonial_rate          = !empty( $testimonial['testimonial_rate'] ) ? $testimonial['testimonial_rate'] : '';
            $testimonial_author_name   = !empty( $testimonial['testimonial_author_name'] ) ? $testimonial['testimonial_author_name'] : '';
            $testimonial_author_job    = !empty( $testimonial['testimonial_author_job'] ) ? $testimonial['testimonial_author_job'] : '';
            $testimonial_author_avatar = !empty( $testimonial['testimonial_author_avatar'] ) ? $testimonial['testimonial_author_avatar'] : '';
            
            // url
            $testimonial_author_url = !empty( $testimonial['testimonial_author_url'] ) ? $testimonial['testimonial_author_url'] : '';
            $testimonial_author_url = vc_build_link( $testimonial_author_url );
            $a_href                 = !empty( $testimonial_author_url['url'] ) ? $testimonial_author_url['url'] : '#';
            $a_title                = !empty( $testimonial_author_url['title'] ) ? $testimonial_author_url['title'] : '';
            $a_target               = !empty( $testimonial_author_url['target'] ) ? $testimonial_author_url['target'] : '_self';
            
            /*-------------------------------------
                REQUIRE STYLE TEMPLATE
            ---------------------------------------*/
            include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-testimonials/' . $testimonial_style . '.php' );
        endforeach;
    endif;
    
    $items_content = ob_get_clean();
    
    
    /*-------------------------------------
    	LAYOUT STYLE
    ---------------------------------------*/
    if ( $testimonial_layout === 'layout-grid' ) {
        $class_ts_grid = array( 'ts-grid-columns-' . $testimonial_columns, 'ts-grid-spacing-' . $testimonial_spacing );
        echo sprintf( '<div class="ts-style-grid-wrapper %s">%s</div>', floral_clean_html_classes( $class_ts_grid ), $items_content );
    } elseif ( $testimonial_layout === 'layout-slider' ) {
        $slider_atts = vc_map_integrate_parse_atts( $this::SC_BASE, Floral_SC_Slider_Container::SC_BASE, $atts );
        echo Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Slider_Container::SC_BASE )->output( $slider_atts, $items_content );
    }
    ?>
</div>
