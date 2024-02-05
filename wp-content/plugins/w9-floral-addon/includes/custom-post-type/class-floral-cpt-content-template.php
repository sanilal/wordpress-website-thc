<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-cpt-content-template.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_CPT_Content_Template extends Floral_CPT_BASE {
    const CPT_SLUG = 'content-template';
    const CPT_NAME = 'Content template';

    const TAX_SLUG = 'content-template-category';
    const TAX_NAME = 'Content Template Category';

    function __construct() {

        /*
         * CONFIG
         */
        $postype_args = array(
            'slug' => self::CPT_SLUG,
            'name' => self::CPT_NAME,
            'args' => array(
                'public'              => is_user_logged_in() ? true : false,
                'publicly_queryable'  => is_user_logged_in() ? true : false,
                'exclude_from_search' => true,
                'show_ui'             => true,
                'query_var'           => true,
//                'menu_position' =>25,
                'menu_icon'           => 'dashicons-format-aside',
                /* you can specify its url slug */
                'has_archive'         => false,
                'capability_type'     => 'post',
                'hierarchical'        => true,
                'rewrite'             => false,
                'supports'            => array(
                    'title',
                    'editor',
                    'author',
                )
            )
        );
        
        $taxonomy_args = array(
            'slug' => self::TAX_SLUG,
            'name' => self::TAX_NAME,
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
            'cb'     => '',
            'id'     => esc_html__( 'ID', 'w9-floral-addon' ),
            'title'  => esc_html__( 'Title', 'w9-floral-addon' ),
            'cats'   => esc_html__( 'Content Template Categories', 'w9-floral-addon' ),
            'author' => esc_html__( 'Author name', 'w9-floral-addon' )
        ), $columns );

        return $columns;
    }
    
    
    function register_single_template( $single_template ) {
        $post_type = get_post_type();
        if ( $post_type === self::CPT_SLUG ) {
            return Floral_Addon::plugin_dir( __FILE__ ) . 'content-template/templates/single-content-template.php';
        }
        
        return $single_template;
    }

    function manage_admin_columns_values( $column, $post_id ) {
        switch ( $column ) {
            case 'id': {
                edit_post_link( $post_id, '', '', $post_id, 'row-title' );
                break;
            }
            case 'title':
                $title = get_the_title();
                if ( !empty( $title ) ) {
                    echo $title;
                }
                break;
            case 'author':
                $author = get_post_meta( $post_id, 'meta-review-author-name', true );
                if ( !empty( $author ) ) {
                    echo $author;
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

new Floral_CPT_Content_Template();

