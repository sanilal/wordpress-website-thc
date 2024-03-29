<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: twitterclient.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once('twitteroauth.php');
class TwitterClient {

    private $api_call;
    function __construct($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret) {
        $this->api_call = new TwitterOAuth(
            $consumer_key,
            $consumer_secret,
            $oauth_token,
            $oauth_token_secret
        );
    }

    function getTweet($screen_name, $total_tweet){
        $fetchedTweets = $this->api_call->get(
            'statuses/user_timeline',
            array(
                'screen_name'     => $screen_name,
                'count'           => $total_tweet,
                'replies_excl' => 'on'
            )
        );
        if($this->api_call->http_code == 200)
            return $fetchedTweets;
        else
            return '';
    }

    function sanitize_links($tweet) {
        if(isset($tweet->retweeted_status)) {
            $rt_section = current(explode(":", $tweet->text));
            $text = $rt_section.": ";
            $text .= $tweet->retweeted_status->text;
        } else {
            $text = $tweet->text;
        }
        $text = preg_replace('/((http)+(s)?:\/\/[^<>\s]+)/i', '<a href="$0" target="_blank" rel="nofollow">$0</a>', $text );
        $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">@$1</a>', $text );
        $text = preg_replace('/[#]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/search?q=%23$1" target="_blank" rel="nofollow">$0</a>', $text );
        return $text;

    }
    function get_the_time($time){
        $diff = human_time_diff($time,current_time('timestamp'));
        echo  esc_html__("About ",'w9-floral-addon') . esc_html($diff) . esc_html__(" ago",'w9-floral-addon');
    }
}