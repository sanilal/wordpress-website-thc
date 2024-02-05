<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-breadcrumb.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Breadcrumb extends Floral_Base {
    private $crumbs;
    private $post;

    public function __construct() {
        parent::__construct();
        $this->crumbs = array();
    }


    /**
     * print_breadcrumb_html
     * @param string $class
     */
    public function print_breadcrumb_html($prepended_text = '', $class = '' ) {
        echo wp_kses_post( $this->prepare_breadcrumb_html($prepended_text, $class ) );
    }

    /**
     * get_the_crumbs
     * @return array
     */
    public function get_the_crumbs() {
        return $this->crumbs;
    }

    /**
     * prepare_breadcrumb_html
     * @param string $class
     *
     * @return string
     */
    public function prepare_breadcrumb_html($prepended_text = '', $class = '' ) {
	    unset($this->crumbs);
        $this->prepare_the_crumbs();
	    
//	    $template_prefix = floral_get_template_prefix();
//	    $get_prepended_text = floral_get_meta_or_option( 'breadcrumbs-prepended-text', '', '', $template_prefix );
	    $prepended_text = !empty($prepended_text) ? '<li class="prepended-text">' . $prepended_text . '</li>' : '';

//        var_dump($this->crumbs);
//        return sprintf( '<ul class="floral-breadcrumb list-unstyled %s" xmlns:v="http://rdf.data-vocabulary.org/#" typeof="v:Breadcrumb"> %s %s </ul>',
//            floral_clean_html_classes( $class ),
//	        $prepended_text,
//            implode( '', $this->crumbs )
//        );
	
	    return sprintf( '<ul class="floral-breadcrumb list-unstyled %s" xmlns:v="http://rdf.data-vocabulary.org/#" typeof="v:Breadcrumb"> %s </ul>',
		    floral_clean_html_classes( $class ),
		    implode( '', $this->crumbs )
	    );
    }


    /**
     * prepare_the_crumbs
     */
    private function prepare_the_crumbs() {
        /**
         * @var $wp_query WP_Query
         */
        global $wp_query;
        $this->post = get_post( $wp_query->get_queried_object_id() );

        if ( !is_front_page() ) {
            $this->crumbs[] = $this->get_single_crumb_html( esc_html__( 'Home', 'floral' ), get_home_url( '/' ), 'first' );
            if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
                $this->crumbs = array_merge( $this->crumbs, $this->get_woocommerce_crumbs() );
            } elseif ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
                $this->crumbs = array_merge( $this->crumbs, $this->get_bbpress_crumbs() );
            } elseif ( is_home() ) {
                $this->crumbs = array_merge( $this->crumbs, $this->get_post_ancestors( $this->post->post_parent ) );

                $title = floral_get_option( 'page-title-custom', '', '', floral_get_template_prefix() );
                if ( empty( $title ) ) {
                    $title = get_the_title( $this->post->ID );
                }
                $this->crumbs[] = $this->get_single_crumb_html( $title );
            } elseif ( is_singular() ) {

                $post_type_object = get_post_type_object( $this->post->post_type );

                if ( $this->post->post_type === 'post' ) {
                    $cate         = current( get_the_category( $this->post->ID ) );
                    $this->crumbs = array_merge( $this->crumbs, $this->get_term_ancestors( $cate->term_id, $cate->taxonomy ) );
                } elseif ( $this->post->post_type !== 'page' ) {
                    if ( $post_type_object->has_archive ) {
                        $this->crumbs[] = $this->get_single_crumb_html( $post_type_object->labels->name, get_post_type_archive_link( $this->post->post_type ) );
                    }

                    $get_post_tax = get_post_taxonomies( $this->post );
                    if ( !empty( $get_post_tax ) ) {
                        $tax = get_post_taxonomies( $this->post )[0];
                        if ( is_taxonomy_hierarchical( $tax ) ) {
                            $terms        = wp_get_object_terms( $this->post->ID, $tax );
                            if (isset($terms[0])) {
                                $this->crumbs = array_merge( $this->crumbs, $this->get_term_ancestors( $terms[0], $tax ) );
                            }
                        }
                    }
                }

                if ( is_post_type_hierarchical( $this->post->post_type ) || $this->post->post_type == 'attachment' ) {
                    $this->crumbs = array_merge( $this->crumbs, $this->get_post_ancestors( $this->post->post_parent ) );
                }

                $this->crumbs[] = $this->get_single_crumb_html( get_the_title() );
            } elseif ( is_tag() ) {
                $this->crumbs[] = $this->get_single_crumb_html( sprintf( esc_html__( 'Tag: &ldquo; %s &rdquo;', 'floral' ), single_tag_title( '', false ) ) );
            } elseif ( is_search() ) {
                $this->crumbs[] = $this->get_single_crumb_html( sprintf( esc_html__( 'Search results for &ldquo; %s &rdquo;', 'floral' ), get_search_query() ) );
            } elseif ( is_category() ) {
                $this->crumbs[] = $this->get_single_crumb_html( single_cat_title( '', false ) );
            } elseif ( is_tax() ) {
                $term           = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                $this->crumbs   = array_merge( $this->crumbs, $this->get_term_ancestors( $term->parent, $term->taxonomy ) );
                $this->crumbs[] = $this->get_single_crumb_html( $term->name );
            } elseif ( is_author() ) {
                $this->crumbs[] = $this->get_single_crumb_html( sprintf( esc_html__( 'Author: %s', 'floral' ), get_the_author_meta( 'display_name', $wp_query->post->post_author ) ) );
            } elseif ( is_day() ) {
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'Y' ), get_year_link( get_the_time( 'Y' ) ) );
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'F' ), get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) );
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'd' ) );
            } elseif ( is_month() ) {
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'Y' ), get_year_link( get_the_time( 'Y' ) ) );
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'F' ) );
            } elseif ( is_year() ) {
                $this->crumbs[] = $this->get_single_crumb_html( get_the_time( 'Y' ) );
            } elseif ( is_archive() ) {
                $this->crumbs[] = $this->get_single_crumb_html( post_type_archive_title( '', false ) );
            } elseif ( is_404() ) {
                $this->crumbs[] = $this->get_single_crumb_html( esc_html__( 'Page not found', 'floral' ) );
            }
        } else {
            $this->crumbs[] = $this->get_single_crumb_html( esc_html__( 'Home', 'floral' ), get_home_url( '/' ), 'home' );
        }

    }

    /**
     * get_single_crumb_html
     * @param        $title
     * @param string $link
     * @param string $class
     *
     * @return string
     */
    private function get_single_crumb_html( $title, $link = '', $class = '' ) {
        if ( empty( $link ) ) {
            $crumb = sprintf( '<span property="v:title">%s</span>', $title );
        } else {
            $crumb = sprintf( '<a href="%s" rel="v:url" property="v:title">%s</a>', $link, $title );
        }

        return sprintf( '<li class="crumb %s">%s</li>', $class, $crumb );
    }

    /**
     * get_woocommerce_crumbs
     * @return array
     */
    private function get_woocommerce_crumbs() {
        $crumbs       = array();
        $shop_page_id = wc_get_page_id( 'shop' );

        if ( get_option( 'page_on_front' ) != $shop_page_id ) {
            $shop_name = $shop_page_id ? get_the_title( $shop_page_id ) : '';
            if ( !is_shop() ) {
                $crumbs[] = $this->get_single_crumb_html( $shop_name, get_permalink( $shop_page_id ) );
            } else {
                $crumbs[] = $this->get_single_crumb_html( $shop_name );
            }
        }

        if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        } elseif ( is_product() ) {
            $terms = wc_get_product_terms( $this->post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
            if ( $terms ) {
                $current_term = $terms[0];
            }
        }

        if ( !empty( $current_term ) ) {
            if ( is_taxonomy_hierarchical( $current_term->taxonomy ) ) {
                $crumbs = array_merge( $crumbs, $this->get_term_ancestors( $current_term->parent, $current_term->taxonomy ) );
            }

            if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
                $crumbs[] = $this->get_single_crumb_html( $current_term->name );
            } else {
                $crumbs[] = $this->get_single_crumb_html( $current_term->name, get_term_link( $current_term->term_id, $current_term->taxonomy ) );
            }
        }
        if ( is_product() ) {
            $crumbs[] = $this->get_single_crumb_html( get_the_title() );
        }

        return $crumbs;
    }

    /**
     * get_bbpress_crumbs
     * @return array
     */
    private function get_bbpress_crumbs() {
        $crumbs = array();

        $post_type_object = get_post_type_object( bbp_get_forum_post_type() );

        if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() ) {
            $crumbs[] = $this->get_single_crumb_html( bbp_get_forum_archive_title(), get_post_type_archive_link( bbp_get_forum_post_type() ) );
        }

        if ( bbp_is_forum_archive() ) {
            $crumbs[] = $this->get_single_crumb_html( bbp_get_forum_archive_title() );
        } elseif ( bbp_is_topic_archive() ) {
            $crumbs[] = $this->get_single_crumb_html( bbp_get_topic_archive_title() );
        } elseif ( bbp_is_single_view() ) {
            $crumbs[] = $this->get_single_crumb_html( bbp_get_view_title() );
        } elseif ( bbp_is_single_topic() ) {

            $topic_id = get_queried_object_id();

            $crumbs = array_merge( $crumbs, $this->get_post_ancestors( bbp_get_topic_forum_id( $topic_id ) ) );

            if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() ) {
                $crumbs[] = $this->get_single_crumb_html( bbp_get_topic_title( $topic_id ), bbp_get_topic_permalink( $topic_id ) );
            } else {
                $crumbs[] = $this->get_single_crumb_html( bbp_get_topic_title( $topic_id ) );
            }

            if ( bbp_is_topic_split() ) {
                $crumbs[] = $this->get_single_crumb_html( esc_html__( 'Split', 'floral' ) );
            } elseif ( bbp_is_topic_merge() ) {
                $crumbs[] = $this->get_single_crumb_html( esc_html__( 'Merge', 'floral' ) );
            } elseif ( bbp_is_topic_edit() ) {
                $crumbs[] = $this->get_single_crumb_html( esc_html__( 'Edit', 'floral' ) );
            }
        } elseif ( bbp_is_single_reply() ) {

            $reply_id = get_queried_object_id();

            $crumbs = array_merge( $crumbs, $this->get_post_ancestors( bbp_get_reply_topic_id( $reply_id ) ) );

            if ( !bbp_is_reply_edit() ) {
                $crumbs[] = bbp_get_reply_title( $reply_id );
            } else {
                $crumbs[] = $this->get_single_crumb_html( bbp_get_reply_title( $reply_id ), bbp_get_reply_url( $reply_id ) );
                $crumbs[] = $this->get_single_crumb_html( esc_html__( 'Edit', 'floral' ) );
            }
        } elseif ( bbp_is_single_forum() ) {

            $forum_id        = get_queried_object_id();
            $forum_parent_id = bbp_get_forum_parent_id( $forum_id );

            if ( 0 !== $forum_parent_id ) {
                $crumbs = array_merge( $crumbs, $this->get_post_ancestors( $forum_parent_id ) );
            }

            $crumbs[] = bbp_get_forum_title( $forum_id );
        } elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

            if ( bbp_is_single_user_edit() ) {
                $crumbs[] = $this->get_single_crumb_html( bbp_get_displayed_user_field( 'display_name' ), bbp_get_user_profile_url() );
                $crumbs[] = $this->get_single_crumb_html( esc_html__( 'Edit', 'floral' ) );
            } else {
                $crumbs[] = $this->get_single_crumb_html( bbp_get_displayed_user_field( 'display_name' ) );
            }
        }

        return $crumbs;
    }


    /**
     * get_term_ancestors
     * @param string $parent_id
     * @param string $taxonomy
     *
     * @return array
     */
    function get_term_ancestors( $parent_id = '', $taxonomy = '' ) {
        $ancestors = array();
        if ( empty( $parent_id ) || empty( $taxonomy ) ) {
            return $ancestors;
        }
        while ( $parent_id ) {
            $parent      = get_term( $parent_id, $taxonomy );
            $ancestors[] = $this->get_single_crumb_html( $parent->name, get_term_link( $parent, $taxonomy ) );
            $parent_id   = $parent->parent;
        }
        if ( $ancestors ) {
            $ancestors = array_reverse( $ancestors );
        }

        return $ancestors;
    }

    /**
     * get_post_ancestors
     * @param string $parent_id
     *
     * @return array
     */
    function get_post_ancestors( $parent_id = '' ) {
        $ancestors = array();
        if ( $parent_id == 0 ) {
            return $ancestors;
        }
        while ( $parent_id ) {
            $page        = get_post( $parent_id );
            $ancestors[] = $this->get_single_crumb_html( get_the_title( $parent_id ), get_permalink( $parent_id ) );
            $parent_id   = $page->post_parent;
        }
        if ( $ancestors ) {
            $ancestors = array_reverse( $ancestors );
        }

        return $ancestors;
    }

}