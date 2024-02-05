<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-cpt-theme-demo.php
 * @time    : 8/28/16 11:45 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_CPT_Theme_Demo extends Floral_CPT_BASE {
    const CPT_SLUG = 'theme-demo';
    const CPT_DEFAULT_NAME = 'Theme Demo';
    
    const TAX_SLUG = 'theme-demo-category';
    const TAX_DEFAULT_NAME = 'Theme Demo Category';
    
    function __construct() {
        /*
         * LOAD OPTIONS
         */
        $event_enable = floral_get_option( 'theme-demo-enable' );
        if ( !$event_enable ) {
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
                'supports'    => array( 'title', 'thumbnail' , 'page-attributes')
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
        unset( $columns['cb'] );
        
        $columns = array_merge(
            array( 'id' => esc_html__( 'ID', 'w9-floral-addon' ), ),
            $columns,
            array(
                'demo_order' => esc_html__( 'Order', 'w9-floral-addon' ),
                'demo_image' => esc_html__( 'Demo Screen Shot', 'w9-floral-addon' ),
                'cats'       => esc_html__( 'Categories', 'w9-floral-addon' ),
            )
        );
        
        return $columns;
    }
    
    function manage_admin_columns_values( $column, $post_id ) {
        switch ( $column ) {
            case 'id': {
                edit_post_link( sprintf( esc_html__( '%s', 'w9-floral-addon' ), $post_id ), '', '', $post_id, 'row-title' );
                break;
            }
            
            case 'demo_order':
                echo get_post($post_id)->menu_order;
                break;
            
            case 'demo_image': {
                $demo_image = get_post_thumbnail_id();
                if ( !empty( $demo_image )) {
                    echo Floral_Image::get_image($demo_image, 'thumbnail' );
                }
                break;
            }
            
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

new Floral_CPT_Theme_Demo();

