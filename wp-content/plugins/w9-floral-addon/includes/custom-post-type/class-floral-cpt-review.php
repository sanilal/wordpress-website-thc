<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-cpt-review.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_CPT_Review extends Floral_CPT_BASE {
    const CPT_SLUG = 'review';
    const CPT_DEFAULT_NAME = 'Review';
    
    const TAX_SLUG = 'review-category';
    const TAX_DEFAULT_NAME = 'Review Category';

    function __construct() {
        /*
         * LOAD OPTIONS
         */
        $review_enable = floral_get_option( 'review-enable' );
        if ( empty( $review_enable ) ) {
            return;
        }
        /*
         * CONFIG
         */
        $postype_args  = array(
            'slug' => self::CPT_SLUG,
            'name' => self::CPT_DEFAULT_NAME,
            'args' => array(
                'has_archive' => true,
                'public'      => false,
                'supports'    => 'no-support'
            )
        );
        $taxonomy_args = array(
            'slug' => self::TAX_SLUG,
            'name' => self::TAX_DEFAULT_NAME
        );
        /*
         * SETUP
         */
        parent::__construct( $postype_args, $taxonomy_args );
    }
    
    function manage_admin_columns( $columns ) {
        unset( $columns['title'] );
        unset( $columns['cb'] );

        $columns = array_merge( array(
            'cb'            => '',
            'id'            => esc_html__( 'ID', 'w9-floral-addon' ),
            'author-name'   => esc_html__( 'Author name', 'w9-floral-addon' ),
            'author-avatar' => esc_html__( 'Author avatar', 'w9-floral-addon' ),
            'author-rating' => esc_html__( 'Rating', 'w9-floral-addon' ),
            'cats'          => esc_html__( 'Categories', 'w9-floral-addon' ),
        ), $columns );

        return $columns;
    }
    
    function manage_admin_columns_values( $column, $post_id ) {
        switch ( $column ) {
            case 'id': {
                edit_post_link( sprintf( esc_html__( 'Review ID: %s', 'w9-floral-addon' ), $post_id ), '', '', $post_id, 'row-title' );
                break;
            }
            case 'author-name':
                $avatar_name = get_post_meta( $post_id, 'meta-review-author-name', true );
                if ( !empty( $avatar_name ) ) {
                    echo $avatar_name;
                }
                break;
            case 'author-avatar': {
                $avatar_id = get_post_meta( $post_id, 'meta-review-author-avatar', true );
                if ( !empty( $avatar_id ) && !empty( $avatar_id['id'] ) ) {
                    echo Floral_Image::get_image( $avatar_id['id'] );
                }
                break;
            }
            case 'author-rating':
                $avatar_rating = get_post_meta( $post_id, 'meta-review-rating', true );
                if ( !empty( $avatar_rating ) ) {
                    if ( $avatar_rating == '' ) {
                        echo esc_html__( 'No rating', 'w9-floral-addon' );
                    } else {
                        echo sprintf( esc_html__( '%s Point(s)', 'w9-floral-addon' ), $avatar_rating );
                    }
                }
                break;
            case 'cats': {
                $terms = wp_get_post_terms( get_the_ID(), array( self::TAX_SLUG ) );
                $cat   = '<ul style="margin-top: 0">';
                foreach ( $terms as $term ) {
                    $cat .= '<li><a href="' . get_term_link( $term, self::TAX_SLUG ) . '">' . $term->name . '<a/></li>';
                }
                $cat .= '</ul>';
                echo wp_kses_post( $cat );
                break;
            }
        }
    }
    
}

new Floral_CPT_Review();

