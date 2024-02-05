<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-fb-page.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Widget_FB_Page extends Floral_Widget_Base {

    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-fb-page',
            'name'    => 'Floral Facebook Page',
            'options' => array(
                'classname' => 'floral-widget-fb-page'
            ),
            'fields'  => array(
                array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => esc_html__( 'Title', 'w9-floral-addon' ),
                ),
                array(
                    'id'    => 'page_url',
                    'type'  => 'text',
                    'title' => esc_html__( 'Facebook Page URL', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'width',
                    'type'  => 'number',
                    'min'   => '180',
                    'max'   => '500',
                    'title' => esc_html__( 'Width (Min: 180 to Max: 500)', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'height',
                    'type'  => 'number',
                    'min'   => '70',
                    'title' => esc_html__( 'Height (Min: 70)', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'user_small_header',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Use small header', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'adapt_to_container',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Adapt the width to fit the outer container.', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'hide_cover',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Hide page cover', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'show_facepile',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Show profile photos when friends like this', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'show_timeline',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Show page timeline', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'show_events',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Show page events', 'w9-floral-addon' )
                ),
                array(
                    'id'    => 'show_messages',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Show page messages', 'w9-floral-addon' )
                )
            )
        );
        parent::__construct( $args );
    }

    public function widget_content( $args, $instance ) {
        $page_url = $width = $height = $user_small_header = $adapt_to_container = $hide_cover = $show_facepile = $show_timeline = $show_events = $show_messages = '';
        extract( $instance, EXTR_IF_EXISTS );

        $width  = absint( $width );
        $height = absint( $height );

        $fb_page_data = array();

        $fb_page_data[] = sprintf( 'data-href="%s"', esc_url( $page_url ) );
        if ( !empty( $width ) ) {
            $fb_page_data[] = sprintf( 'data-width="%s"', $width );
        }
        if ( !empty( $height ) ) {
            $fb_page_data[] = sprintf( 'data-height="%s"', $height );
        }

        $fb_page_data[] = sprintf( 'data-small-header="%s"', empty( $user_small_header ) ? 'false' : 'true' );
        $fb_page_data[] = sprintf( 'data-adapt-container-width="%s"', empty( $adapt_to_container ) ? 'false' : 'true' );
        $fb_page_data[] = sprintf( 'data-hide-cover="%s"', empty( $hide_cover ) ? 'false' : 'true' );
        $fb_page_data[] = sprintf( 'data-show-facepile="%s"', empty( $show_facepile ) ? 'false' : 'true' );

        // Facebook data tab
        $data_tabs = array();
        if ( !empty( $show_timeline ) ) {
            $data_tabs[] = 'timeline';
        }
        if ( !empty( $show_events ) ) {
            $data_tabs[] = 'events';
        }
        if ( !empty( $show_messages ) ) {
            $data_tabs[] = 'messages';
        }

        if ( count( $data_tabs ) > 0 ) {
            $fb_page_data[] = sprintf( 'data-tabs="%s"', implode( ',', $data_tabs ) );
        }

        ob_start();
        //output the widget title
        $this->the_widget_title( $args, $instance );
        ?>
        <div class="floral-facebook-page fb-page" <?php echo implode( ' ', $fb_page_data ); ?>>
            <div class="fb-xfbml-parse-ignore">
                <a href="<?php echo esc_url( $page_url ); ?>"> <?php echo esc_url( $page_url ); ?> </a>
            </div>
        </div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <?php
        echo ob_get_clean();
    }


}