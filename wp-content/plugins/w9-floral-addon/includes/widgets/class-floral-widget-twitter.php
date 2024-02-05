<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-twitter.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Widget_Twitter extends Floral_Widget_Base {
    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-twitter',
            'name'    => esc_html__( 'Floral Twitter', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-twitter',
                'description' => esc_html__( 'Display your latest tweets.', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'user_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'User Name', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'consumer_key',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Consumer Key', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'consumer_secret',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Consumer Secret', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'access_token',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Access Token', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'access_token_secret',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Access Token Secret', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'    => 'time_to_store',
                    'type'  => 'number',
                    'min'   => '0',
                    'title' => esc_html__( 'Time To Store (unit: minute)', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'total_feed',
                    'type'  => 'number',
                    'min'   => '1',
                    'title' => esc_html__( 'Total Feed', 'w9-floral-addon' )
                ),
            )
        );

        parent::__construct( $args );
    }

    public function widget_content( $args, $instance ) {
        require_once( 'twitter/twitterclient.php' );
        $user_name = $consumer_key = $consumer_secret = $access_token = $access_token_secret = $time_to_store = $total_feed = '';
        extract( $instance, EXTR_IF_EXISTS );

        $transient_feed_tweet = 'transient_feed_tweet';
        if ( !empty( $time_to_store ) && is_numeric( $time_to_store ) ) {
            $fetchedTweets = get_transient( $transient_feed_tweet );
        } else {
            delete_transient( $transient_feed_tweet );
        }

        $twitterClient = new TwitterClient( trim( $consumer_key ), trim( $consumer_secret ), trim( $access_token ), trim( $access_token_secret ) );

        if ( !isset( $fetchedTweets ) || !$fetchedTweets ) {
            $fetchedTweets = $twitterClient->getTweet( trim( $user_name ), $total_feed );
            if ( !empty( $time_to_store ) && is_numeric( $time_to_store ) ) {
                set_transient( $transient_feed_tweet, $fetchedTweets, 60 * $time_to_store );
            }
        }

        $limitToDisplay = 0;
        if ( !empty( $fetchedTweets ) && is_array( $fetchedTweets ) ) {
            $limitToDisplay = min( $total_feed, count( $fetchedTweets ) );
        }


        ob_start();
        if ( $limitToDisplay > 0 ) {
            $this->the_widget_title( $args, $instance );
            for ( $i = 0; $i < $limitToDisplay; $i ++ ) {
                $tweet = $fetchedTweets[$i];
                $text  = $twitterClient->sanitize_links( $tweet );
                $time  = $tweet->created_at;
                $time  = date_parse( $time );
                $uTime = mktime( $time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year'] );
                ?>
                <div class="widget-twitter-item">
                    <i class="fa fa-twitter"></i>
                    <div class="twitter-content">
                        <?php echo wp_kses_post( $text ); ?>
                        <span class="twitter-time"><?php $twitterClient->get_the_time( $uTime ) ?></span>
                    </div>

                </div>
                <?php
            }
        }
        echo ob_get_clean();
    }

}
