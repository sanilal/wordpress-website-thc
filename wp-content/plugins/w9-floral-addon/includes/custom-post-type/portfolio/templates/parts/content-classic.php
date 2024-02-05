<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-classic.php
 * @time    : 9/22/16 9:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * @var $portfolio_post_class
 * @var $portfolio_thumbnail_ratio
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( floral_clean_html_classes( $portfolio_post_class ) ); ?>>
    <div class="floral-portfolio-post-item-inner">
        <div class="entry-header">
            <div class="entry-thumbnail">
                <?php
                $thumbnail_id   = get_post_thumbnail_id();
                $thumbnail_args = array();
                if(isset($portfolio_thumbnail_ratio)){
                    $thumbnail_args['ratio'] = $portfolio_thumbnail_ratio;
                }
                $post_thumbnail = Floral_Image::get_image( $thumbnail_id, 'floral_1170', $thumbnail_args );
                if ( empty( $post_thumbnail ) ) {
                    $post_thumbnail = Floral_Image::get_placeholder_image( '1170x' . ( ( isset( $portfolio_thumbnail_ratio ) && floatval( $portfolio_thumbnail_ratio ) !== 0 ) ? 1170 * $portfolio_thumbnail_ratio : 700 ) );
                }
                
                echo Floral_Wrap::link( $post_thumbnail, get_permalink(), array( 'title' => get_the_title() ) );
                ?>
            </div>
        </div>
        <div class="entry-content text-link-color">
            <h3 class="entry-title">
                <?php
                $title = get_the_title();
                $title = Floral_Wrap::link( $title, get_permalink(), array( 'title' => $title ) );
                echo wp_kses_post( $title );
                ?>
            </h3>
            <?php
            //Portfolio about content
            $portfolio_about_content = floral_get_meta_option( 'portfolio-about-content' );
            if ( !empty( $portfolio_about_content ) ) {
                ?>
                <div class="entry-excerpt">
                <p><?php
                    echo get_the_excerpt();
                    ?></p>
                </div><?php
            }
            
            //Portfolio website link
            $portfolio_website = floral_get_meta_option( 'portfolio-client-url' );
            if ( !empty( $portfolio_website ) ) {
                ?>
                <div class="entry-website">
                    <span class="fw-semibold"><?php echo __( 'Website:', 'w9-floral-addon' ) ?> </span>
                    <a href="<?php echo esc_url( $portfolio_website ) ?>"><?php echo esc_html( $portfolio_website ); ?></a>
                </div>
                <?php
            }
            
            //Entry follow
            ?>
            <div class="entry-follow">
                <?php $atts = array(
                    'module_type'                 => 'share-this',
                    'profiles'                    => 'social-twitter-url||social-facebook-url||social-googleplus-url',
                    'share_this_label'            => __( 'Share:', 'w9-floral-addon' ),
                    'icon_size'                   => '14',
                    'colors'                      => 'icon-color-text-meta',
                    'colors_hover'                => 'icon-color-hover-p',
                    'is_rounded_icon'             => '0',
                    'rounded_size'                => '16',
                    'background_colors'           => 'none',
                    'background_hover_colors'     => 'none',
                    'spacing_between_items'       => '5',
                    'floral_extra_widget_classes' => '',
                    'floral_remove_default_mb'    => '1',
                );
                
                $extra_class   = array( 'floral-widget-social-profiles' );
                $extra_class[] = $atts['floral_extra_widget_classes'];
                if ( !empty( $atts['floral_remove_default_mb'] ) ) {
                    $extra_class[] = 'mb-0-i';
                }
                
                $args = array(
                    'id'            => 'floral-widget-social-profiles',
                    'name'          => __( 'Floral Portfolio Share', 'w9-floral-addon' ),
                    'before_widget' => '<div class="floral-widget %s ' . floral_clean_html_classes( $extra_class ) . '">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3 class="floral-widget-title">',
                    'after_title'   => '</h3>'
                );
                
                the_widget( 'Floral_Widget_Social_Profiles', $atts, $args );
                ?>
            </div>
        </div>
    </div>
</article>