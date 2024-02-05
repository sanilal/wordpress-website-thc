<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-user-social-profile.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_User_Social_Profile extends Floral_Base {
    private $social_field;

    public function __construct() {
        parent::__construct();
        $this->social_field = array(
            'facebook_url'   => array(
                'label'       => esc_html__( 'Facebook', 'floral' ),
                'description' => esc_html__( 'Your Facebook page/profile url', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-facebook'
            ),
            'twitter_url'    => array(
                'label'       => esc_html__( 'Twitter', 'floral' ),
                'description' => esc_html__( 'Your Twitter', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-twitter'
            ),
            'dribbble_url'   => array(
                'label'       => esc_html__( 'Dribbble', 'floral' ),
                'description' => esc_html__( 'Your Dribbble URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-dribbble'
            ),
            'vimeo_url'      => array(
                'label'       => esc_html__( 'Vimeo', 'floral' ),
                'description' => esc_html__( 'Your Vimeo URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-vimeo-square'
            ),
            'tumblr_url'     => array(
                'label'       => esc_html__( 'Tumblr', 'floral' ),
                'description' => esc_html__( 'Your Tumblr URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-tumblr'
            ),
            'skype_username' => array(
                'label'       => esc_html__( 'Skype', 'floral' ),
                'description' => esc_html__( 'Your Skype username', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-skype'
            ),
            'linkedin_url'   => array(
                'label'       => esc_html__( 'LinkedIn', 'floral' ),
                'description' => esc_html__( 'Your LinkedIn page/profile url', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-linkedin'
            ),
            'googleplus_url' => array(
                'label'       => esc_html__( 'Google+', 'floral' ),
                'description' => esc_html__( 'Your Google+ page/profile URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-google-plus'
            ),
            'flickr_url'     => array(
                'label'       => esc_html__( 'Flickr', 'floral' ),
                'description' => esc_html__( 'Your Flickr page url', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-flickr'
            ),
            'youtube_url'    => array(
                'label'       => esc_html__( 'YouTube', 'floral' ),
                'description' => esc_html__( 'Your YouTube URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-youtube'
            ),
            'pinterest_url'  => array(
                'label'       => esc_html__( 'Pinterest', 'floral' ),
                'description' => esc_html__( 'Your Pinterest URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-pinterest'
            ),
            'foursquare_url' => array(
                'label'       => esc_html__( 'Foursquare', 'floral' ),
                'description' => esc_html__( 'Your Foursqaure URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-foursquare'
            ),
            'instagram_url'  => array(
                'label'       => esc_html__( 'Instagram', 'floral' ),
                'description' => esc_html__( 'Your Instagram URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-instagram'
            ),
            'github_url'     => array(
                'label'       => esc_html__( 'GitHub', 'floral' ),
                'description' => esc_html__( 'Your GitHub URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-github'
            ),
            'xing_url'       => array(
                'label'       => esc_html__( 'Xing', 'floral' ),
                'description' => esc_html__( 'Your Xing URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-xing'
            ),
            'behance_url'    => array(
                'label'       => esc_html__( 'Behance', 'floral' ),
                'description' => esc_html__( 'Your Behance URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-behance'
            ),
            'deviantart_url' => array(
                'label'       => esc_html__( 'Deviantart', 'floral' ),
                'description' => esc_html__( 'Your Deviantart URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-deviantart'
            ),
            'soundcloud_url' => array(
                'label'       => esc_html__( 'SoundCloud', 'floral' ),
                'description' => esc_html__( 'Your SoundCloud URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-soundcloud'
            ),
            'yelp_url'       => array(
                'label'       => esc_html__( 'Yelp', 'floral' ),
                'description' => esc_html__( 'Your Yelp URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-yelp'
            ),
            'rss_url'        => array(
                'label'       => esc_html__( 'RSS Feed', 'floral' ),
                'description' => esc_html__( 'Your RSS Feed URL', 'floral' ),
                'type'        => 'text',
                'icon'        => 'fa fa-rss'
            )
        );
    }

    public function add_actions() {
        add_action( 'show_user_profile', array( $this, 'show_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'show_fields' ) );

        add_action( 'personal_options_update', array( $this, 'save_data' ) );
        add_action( 'edit_user_profile_update', array( $this, 'save_data' ) );
    }

    public function get_user_social_meta_fields() {
        return $this->social_field;
    }
    
    public function show_fields( $user ) {
        ?>
        <h3><?php echo esc_html__( 'Social Profiles', 'floral' ); ?></h3>
        <table class="form-table">
            <?php foreach ( $this->social_field as $key => $field ) : ?>
                <tr>
                    <th>
                        <label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
                    </th>
                    <td>
                        <?php if ( !empty( $field['type'] ) && 'select' == $field['type'] ) : ?>
                            <select name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" class="<?php echo( !empty( $field['class'] ) ? $field['class'] : '' ); ?>" style="width: 25em;">
                                <?php
                                $selected = esc_attr( get_user_meta( $user->ID, $key, true ) );
                                foreach ( $field['options'] as $option_key => $option_value ) : ?>
                                    <option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $selected, $option_key, true ); ?>><?php echo esc_attr( $option_value ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php else : ?>
                            <input type="text" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( get_user_meta( $user->ID, $key, true ) ); ?>" class="<?php echo( !empty( $field['class'] ) ? $field['class'] : 'regular-text' ); ?>" />
                        <?php endif; ?>
                        <br />
                        <span class="description"><?php echo wp_kses_post( $field['description'] ); ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php
    }

    public function save_data( $user_id ) {
        foreach ( $this->social_field as $key => $field ) {
            if ( isset( $_POST[$key] ) ) {
                update_user_meta( $user_id, $key, sanitize_text_field( $_POST[$key] ) );
            }
        }
    }

}