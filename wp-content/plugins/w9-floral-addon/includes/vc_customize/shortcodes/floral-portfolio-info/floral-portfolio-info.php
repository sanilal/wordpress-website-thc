<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-info.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !class_exists( 'Floral_SC_Portfolio_Info' ) ) {
    class Floral_SC_Portfolio_Info extends WPBakeryShortCode {
        const SC_BASE = 'floral_shortcode_portfolio_info';

        public function share_this() {
            $atts = array(
                'module_type'                 => 'share-this',
                'profiles'                    => 'social-twitter-url||social-facebook-url||social-googleplus-url',
                'share_this_label'            => __( 'SHARE:', 'w9-floral-addon' ),
                'icon_size'                   => '18',
                'colors'                      => 'icon-color-text',
                'colors_hover'                => 'icon-color-hover-p',
                'is_rounded_icon'             => '0',
                'rounded_size'                => '35',
                'background_colors'           => 'none',
                'background_hover_colors'     => 'none',
                'spacing_between_items'       => '15',
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
                'name'          => __( 'Floral Social Profiles', 'w9-floral-addon' ),
                'before_widget' => '<section class="floral-widget %s ' . floral_clean_html_classes( $extra_class ) . '">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="floral-widget-title">',
                'after_title'   => '</h3>'
            );
            

            ob_start();
            the_widget( 'Floral_Widget_Social_Profiles', $atts, $args );
            return ob_get_clean();
        }
    }
}
 