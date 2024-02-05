<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_demo_listing.php
 * @time    : 10/13/16 3:54 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$sc_classes = array(
    'floral-theme-demo-wrapper',
    $el_class,
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    vc_shortcode_custom_css_class( $css ),
);
$args       = array(
    'post_type'      => 'theme-demo',
    'posts_per_page' => - 1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
);
?>
<div class="<?php floral_the_clean_html_classes( $sc_classes ) ?>">
    <?php
    $q = new WP_Query( $args );
    if ( $q->have_posts() ):
        //while
        
        $catlist = get_terms( array(
            'taxonomy' => 'theme-demo-category'
        ) );
        ?>
        <ul class="floral-demo-filter mb-lg-75 mb-50">
            <?php
            if ( is_array( $catlist ) && !empty( $catlist ) ) {
                echo sprintf( '<li><a class="__filter-item active" href="#" data-filter="%s">%s</a></li>', '*', __( 'All', 'w9-floral-addon' ) );
                foreach ( $catlist as $single_cat ) {
                    echo sprintf( '<li><a class="__filter-item" href="#" data-filter="%s">%s</a></li>', $single_cat->slug, $single_cat->name );
                }
            }
            ?>
        </ul>
        <div class="floral-theme-demo-content">
            <?php
            while ( $q->have_posts() ):
                $q->the_post();
                $thumbnail_id = get_post_thumbnail_id();
                $demo_url     = floral_get_meta_option( 'theme-demo-url', get_the_ID() );
                $thumbnail    = Floral_Image::get_image( $thumbnail_id, 'floral_370' );
                $filter_class = '';
                $cats         = get_the_terms( get_the_ID(), 'theme-demo-category' );
                if ( is_array( $cats ) && !empty( $cats ) ) {
                    foreach ( $cats as $key => $cat ) {
                        $filter_class .= ' ' . $cat->slug;
                    }
                }
                
                // Post
                ?>
                <div class="floral-theme-demo-column col-lg-3 col-md-4 col-sm-6 col-xs-12 <?php echo $filter_class ?>">
                    <div class="floral-theme-demo">
                        <div class="__thumbnail">
                            <?php echo Floral_Wrap::link( $thumbnail, $demo_url, array( 'target' => '_blank' ) ); ?>
                        </div>
                        <h4 class="__title">
                            <?php echo sprintf( '<a href="%s" title="%s" target="_blank">%2$s</a>', $demo_url, get_the_title() ); ?>
                        </h4>
                    </div>
                    <?php
                    ?>
                </div>
                <?php
            endwhile;
            ?>
        </div>
        <?php
        //end while
        wp_reset_postdata();
    else:
        echo __( 'There are not any theme demo in your site', 'w9-floral-addon' );
    endif;
    ?>
</div>

