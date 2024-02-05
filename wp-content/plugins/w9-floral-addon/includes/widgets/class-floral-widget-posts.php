<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-posts.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Widget_Posts extends Floral_Widget_Base {

    /**
     * Floral_Widget_Posts constructor.
     */
    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-posts',
            'name'    => esc_html__( 'Floral Posts', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-posts',
                'description' => esc_html__( 'Widget to show posts in the sidebar.', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
                    'default' => 'Posts'
                ),

                array(
                    'id'      => 'style',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Style', 'w9-floral-addon' ),
                    'options' => array(
                        'normal'    => esc_html__( 'Normal', 'w9-floral-addon' ),
                        'thumbnail' => esc_html__( 'Thumbnail', 'w9-floral-addon' )
                    ),
                    'default' => 'thumbnail'
                ),

                array(
                    'id'           => 'category',
                    'type'         => 'select',
                    'title'        => esc_html__( 'Category', 'w9-floral-addon' ),
                    'select-group' => 'get-terms-list',
                    'options'      => array(
                        'taxonomy' => 'category'
                    )
                ),

                array(
                    'id'      => 'order',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Order By', 'w9-floral-addon' ),
                    'options' => array(
                        'recent'  => esc_html__( 'Recent', 'w9-floral-addon' ),
                        'popular' => esc_html__( 'Popular', 'w9-floral-addon' ),
                        'random'  => esc_html__( 'Random', 'w9-floral-addon' ),
                        'oldest'  => esc_html__( 'Oldest', 'w9-floral-addon' ),
                    ),
                    'default' => 'recent'
                ),
                array(
                    'id'      => 'number',
                    'type'    => 'number',
                    'min'     => '1',
                    'max'     => '20',
                    'title'   => esc_html__( 'Number of posts to show (max: 20, min: 1, default: 5)', 'w9-floral-addon' ),
                    'default' => '5'
                ),
                array(
                    'id'         => 'hide_thumbnail',
                    'type'       => 'checkbox',
                    'title'      => esc_html__( 'Hide thumbnail', 'w9-floral-addon' ),
                    'dependency' => array(
                        'element'  => 'style',
                        'equal_to' => 'thumbnail',
                    )
                ),
                array(
                    'id'    => 'show_date',
                    'type'  => 'checkbox',
                    'title' => esc_html__( 'Show date', 'w9-floral-addon' )
                )
            )

        );
        parent::__construct( $args );
    }

    /**
     * Override the widget content function
     *
     * @param $args
     * @param $instance
     */
    function widget_content( $args, $instance ) {
        $style = $category = $order = $number = $hide_thumbnail = $show_date = '';
        extract( $instance, EXTR_IF_EXISTS );
        if ( !( $number = intval( $number ) ) ) {
            $number = 5;
        }

        // output the widget title
        $query_vars  = $this->get_query_vars( $category, $order, $number );
        $posts_query = new WP_Query( $query_vars );
        ob_start();
        $this->the_widget_title( $args, $instance );
        ?>
        <?php if ( $style === 'normal' ) : ?>
            <ul>
                <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                        <?php if ( $show_date ) : ?>
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php elseif ( $style === 'thumbnail' ) : ?>
            <div class="floral-widget-posts-list">
                <?php while ( $posts_query->have_posts() ): $posts_query->the_post(); ?>
                    <div class="widget-posts-item">
                        <?php if ( empty( $hide_thumbnail ) && has_post_thumbnail() && class_exists( 'Floral_Image' ) ) : ?>
                            <div class="widget-post-thumbnail">
                                <div class="__inner">
                                    <a class="__image" href="<?php the_permalink(); ?>">
                                        <?php echo Floral_Image::get_image( get_post_thumbnail_id(), '110x73' ); ?>
                                        <div class="__overlay"></div>
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="widget-post-info">
                            <div class="__inner">
                                <div class="widget-post-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                                </div>
                                <?php if ( $show_date ) : ?>
                                    <div class="widget-post-date">
                                        <?php echo get_the_date( get_option( 'date_format' ) ); ?>
                                    </div>
                                <?php endif ?>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif ?>
        <?php
        wp_reset_postdata();
        echo ob_get_clean();
    }

    /**
     * Get Query Vars for the post query
     *
     * @param $term
     * @param $order
     * @param $post_num
     *
     * @return array
     */
    public function get_query_vars( $term, $order, $post_num ) {
        $query_vars = array();

        switch ( $order ) {
            case 'random' :
                $query_vars = array(
                    'posts_per_page'      => $post_num,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'rand',
                    'order'               => 'DESC',
                    'post_type'           => 'post',
                    'tax_query'           => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-video' ),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'popular':
                $query_vars = array(
                    'posts_per_page'      => $post_num,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'comment_count',
                    'order'               => 'DESC',
                    'post_type'           => 'post',
                    'tax_query'           => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-video' ),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;

            case 'recent':
                $query_vars = array(
                    'posts_per_page'      => $post_num,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'post_date',
                    'order'               => 'DESC',
                    'post_type'           => 'post',
                    'tax_query'           => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-video' ),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'oldest':
                $query_vars = array(
                    'posts_per_page'      => $post_num,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby'             => 'post_date',
                    'order'               => 'ASC',
                    'post_type'           => 'post',
                    'tax_query'           => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-quote', 'post-format-link', 'post-format-audio', 'post-format-video' ),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
        }

        if ( $term !== 'all' ) {

            $category = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => array( $term ),
                'operator' => 'IN'
            );

            $query_vars['tax_query'][] = $category;
        }

        return $query_vars;
    }
    
}