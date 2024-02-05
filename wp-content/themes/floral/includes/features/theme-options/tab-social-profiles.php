<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-social-profiles.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Social Profiles', 'floral' ),
    'desc'   => '',
    'icon'   => 'el el-path',
    'fields' => array(
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Social Meta Tags', 'floral' )
        ),
        array(
            'id'       => 'social-meta-tag',
            'type'     => 'switch',
            'title'    => esc_html__( 'Social meta tags', 'floral' ),
            'subtitle' => esc_html__( 'Enable the social meta head tag output.', 'floral' ),
            'desc'     => '',
            'default'  => '0'
        ),
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Social Share', 'floral' )
        ),
        array(
            'title'    => esc_html__( 'Social Share', 'floral' ),
            'id'       => 'social-sharing',
            'type'     => 'checkbox',
            'subtitle' => esc_html__( 'Show the social sharing in blog posts.', 'floral' ),

            //Must provide key => value pairs for multi checkbox options
            'options'  => array(
                'facebook'  => 'Facebook',
                'twitter'   => 'Twitter',
                'google'    => 'Google',
                'linkedin'  => 'Linkedin',
                'tumblr'    => 'Tumblr',
                'pinterest' => 'Pinterest'
            ),

            //See how default has changed? you also don't need to specify opts that are 0.
            'default'  => array(
                'twitter'   => '1',
                'facebook'  => '1',
                'google'    => '1',
                'linkedin'  => '1',
                'tumblr'    => '1',
                'pinterest' => '1'
            )
        ),
        array(
            'id'   => mt_rand(),
            'type' => 'info',
            'desc' => esc_html__( 'Social Profiles URL', 'floral' )
        ),
        array(
            'id'       => 'social-twitter-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter', 'floral' ),
            'subtitle' => esc_html__( 'Your Twitter.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-facebook-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook', 'floral' ),
            'subtitle' => esc_html__( 'Your facebook page/profile url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-dribbble-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Dribbble', 'floral' ),
            'subtitle' => esc_html__( 'Your Dribbble.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-vimeo-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Vimeo', 'floral' ),
            'subtitle' => esc_html__( 'Your Vimeo.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-tumblr-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Tumblr', 'floral' ),
            'subtitle' => esc_html__( 'Your Tumblr.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-skype-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Skype', 'floral' ),
            'subtitle' => esc_html__( 'Your Skype username.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-linkedin-url',
            'type'     => 'text',
            'title'    => esc_html__( 'LinkedIn', 'floral' ),
            'subtitle' => esc_html__( 'Your LinkedIn page/profile url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-googleplus-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Google+', 'floral' ),
            'subtitle' => esc_html__( 'Your Google+ page/profile URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-flickr-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Flickr', 'floral' ),
            'subtitle' => esc_html__( 'Your Flickr page url.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-youtube-url',
            'type'     => 'text',
            'title'    => esc_html__( 'YouTube', 'floral' ),
            'subtitle' => esc_html__( 'Your YouTube URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-pinterest-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Pinterest', 'floral' ),
            'subtitle' => esc_html__( 'Your Pinterest.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-foursquare-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Foursquare', 'floral' ),
            'subtitle' => esc_html__( 'Your Foursqaure URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-instagram-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Instagram', 'floral' ),
            'subtitle' => esc_html__( 'Your Instagram.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-github-url',
            'type'     => 'text',
            'title'    => esc_html__( 'GitHub', 'floral' ),
            'subtitle' => esc_html__( 'Your GitHub URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-xing-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Xing', 'floral' ),
            'subtitle' => esc_html__( 'Your Xing URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-behance-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Behance', 'floral' ),
            'subtitle' => esc_html__( 'Your Behance URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-deviantart-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Deviantart', 'floral' ),
            'subtitle' => esc_html__( 'Your Deviantart URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-soundcloud-url',
            'type'     => 'text',
            'title'    => esc_html__( 'SoundCloud', 'floral' ),
            'subtitle' => esc_html__( 'Your SoundCloud URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-yelp-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Yelp', 'floral' ),
            'subtitle' => esc_html__( 'Your Yelp URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-rss-url',
            'type'     => 'text',
            'title'    => esc_html__( 'RSS Feed', 'floral' ),
            'subtitle' => esc_html__( 'Your RSS Feed URL.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),
        array(
            'id'       => 'social-email-url',
            'type'     => 'text',
            'title'    => esc_html__( 'Email address', 'floral' ),
            'subtitle' => esc_html__( 'Your email address.', 'floral' ),
            'desc'     => '',
            'default'  => ''
        ),

    )
);