<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-team.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Team extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_team';

    public static function get_team_social_list() {
        return array(
            'facebook'       => array(
                'label' => __( 'Facebook', 'w9-floral-addon' ),
                'icon'  => 'fa fa-facebook'
            ),
            'twitter'        => array(
                'label' => __( 'Twitter', 'w9-floral-addon' ),
                'icon'  => 'fa fa-twitter'
            ),
            'dribbble'       => array(
                'label' => __( 'Dribbble', 'w9-floral-addon' ),
                'icon'  => 'fa fa-dribbble'
            ),
            'vimeo'          => array(
                'label' => __( 'Vimeo', 'w9-floral-addon' ),
                'icon'  => 'fa fa-vimeo-square'
            ),
            'tumblr'         => array(
                'label' => __( 'Tumblr', 'w9-floral-addon' ),
                'icon'  => 'fa fa-tumblr'
            ),
            'skype_username' => array(
                'label' => __( 'Skype', 'w9-floral-addon' ),
                'icon'  => 'fa fa-skype'
            ),
            'linkedin'       => array(
                'label' => __( 'LinkedIn', 'w9-floral-addon' ),
                'icon'  => 'fa fa-linkedin'
            ),
            'googleplus'     => array(
                'label' => __( 'Google+', 'w9-floral-addon' ),
                'icon'  => 'w9 w9-ico-gplus'
            ),
            'flickr'         => array(
                'label' => __( 'Flickr', 'w9-floral-addon' ),
                'icon'  => 'fa fa-flickr'
            ),
            'youtube'        => array(
                'label' => __( 'YouTube', 'w9-floral-addon' ),
                'icon'  => 'fa fa-youtube'
            ),
            'pinterest'      => array(
                'label' => __( 'Pinterest', 'w9-floral-addon' ),
                'icon'  => 'fa fa-pinterest'
            ),
            'foursquare'     => array(
                'label' => __( 'Foursquare', 'w9-floral-addon' ),
                'icon'  => 'fa fa-foursquare'
            ),
            'instagram'      => array(
                'label' => __( 'Instagram', 'w9-floral-addon' ),
                'icon'  => 'fa fa-instagram'
            ),
            'github'         => array(
                'label' => __( 'GitHub', 'w9-floral-addon' ),
                'icon'  => 'fa fa-github'
            ),
            'xing'           => array(
                'label' => __( 'Xing', 'w9-floral-addon' ),
                'icon'  => 'fa fa-xing'
            ),
            'behance'        => array(
                'label' => __( 'Behance', 'w9-floral-addon' ),
                'icon'  => 'fa fa-behance'
            ),
            'deviantart'     => array(
                'label' => __( 'Deviantart', 'w9-floral-addon' ),
                'icon'  => 'fa fa-deviantart'
            ),
            'soundcloud'     => array(
                'label' => __( 'SoundCloud', 'w9-floral-addon' ),
                'icon'  => 'fa fa-soundcloud'
            ),
            'yelp'           => array(
                'label' => __( 'Yelp', 'w9-floral-addon' ),
                'icon'  => 'fa fa-yelp'
            ),
            'rss'            => array(
                'label' => __( 'RSS Feed', 'w9-floral-addon' ),
                'icon'  => 'fa fa-rss'
            )
        );
    }
}
