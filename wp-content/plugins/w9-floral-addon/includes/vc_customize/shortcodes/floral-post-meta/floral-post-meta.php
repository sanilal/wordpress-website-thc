<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-post-meta.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Post_Meta extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_post_meta';

    
    public function get_meta_label( $content, $extra_class ) {
        if ( !empty( $content ) ) {
            return '<span class="meta-label ' . floral_clean_html_classes( $extra_class ) . '">' . $content . '</span>';
        }

        return '';
    }

    /**
     * get_post_date
     *
     * @param        $id
     * @param string $date_format
     *
     * @return string
     */
    public function get_post_date( $id, $date_format = '' ) {
        if ( empty( $id ) ) {
            $id = get_the_ID();
        }
        
        if ( empty( $date_format ) ) {
            $date_format = get_option( 'date_format' );
        }
        
        return Floral_Wrap::link( get_the_date( $date_format, $id ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
    }

    /**
     * get_post_author
     * @return string
     */
    public function get_post_author() {
        return sprintf( '<a class="author vcard" href="%1$s">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );
    }

    /**
     * get_post_categories
     *
     * @param        $id
     * @param string $num_items
     *
     * @param string $item_separator
     *
     * @return string|WP_Error
     */
    public function get_post_categories( $id, $num_items = '', $item_separator = ', ' ) {
        $taxes = get_post_taxonomies( $id );
        if ( !empty( $taxes ) ) {
            return $this->get_term_list_limit( $id, $taxes[0], $num_items, $item_separator );
        }

        return '';
    }

    /**
     * get_post_tags
     *
     * @param        $id
     * @param string $num_items
     *
     * @param string $item_separator
     *
     * @return string|WP_Error
     */
    public function get_post_tags( $id, $num_items = '', $item_separator = ', ' ) {
        return $this->get_term_list_limit( $id, 'post_tag', $num_items, $item_separator );
    }

    /**
     * get_term_list_limit
     *
     * @param        $id
     * @param        $taxonomy
     * @param bool   $num_items
     *
     * @param string $item_separator
     *
     * @return string|WP_Error
     */
    function get_term_list_limit( $id, $taxonomy, $num_items = false, $item_separator = ', ' ) {
        $terms = get_the_terms( $id, $taxonomy );

        if ( !is_wp_error( $terms ) && !empty( $terms ) ) {
            $links = array();

            foreach ( $terms as $id => $term ) {
                if ( $num_items && $id >= $num_items ) {
                    break;
                }

                $link = get_term_link( $term, $taxonomy );
                if ( is_wp_error( $link ) ) {
                    return $link;
                }
                $links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
            }

            return join( $item_separator, $links );
        }

        return '';
    }
    
    public function get_meta_items() {
        
    }
}