<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-cpt-base.php
 * @time    : 8/26/16 12:38 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

abstract class Floral_CPT_BASE {
    protected $is_cpt_created = false;
    protected $is_tax_created = false;
    
    public function __construct( $postype_args, $taxonomy_args = array() ) {
        if ( is_array( $postype_args ) && ( !isset( $postype_args['slug'] ) || !isset( $postype_args['name'] ) ) ) {
            return;
        }
        //
        // Register Postype
        //
        $cpt_slug = self::uglify( $postype_args['slug'] );
        $cpt_name = self::beautify( $postype_args['name'] );
        
        $cpt_args = isset( $postype_args['args'] ) ? $postype_args['args'] : array();
        $this->register_post_type( $cpt_slug, $cpt_name, $cpt_args );

        if ( !empty( $taxonomy_args ) && is_array( $taxonomy_args ) && isset( $taxonomy_args['slug'] ) && isset( $taxonomy_args['name'] ) ) {
            //
            // Register Taxonomy
            //
            $tax_slug = self::uglify( $taxonomy_args['slug'] );
            $tax_name = self::beautify( $taxonomy_args['name'] );
            $tax_args = isset( $taxonomy_args['args'] ) ? $taxonomy_args['args'] : array();
            
            $this->register_taxonomy( $tax_slug, $tax_name, $cpt_slug, $tax_args );
        }

        //
        // Some useful hook
        //
        add_filter( 'single_template', array( $this, 'register_single_template' ) );
        add_filter( 'archive_template', array( $this, 'register_archive_template' ) );
        if ( is_admin() ) {
            add_filter( 'manage_edit-' . $cpt_slug . '_columns', array( $this, 'manage_admin_columns' ) );
            add_action( 'manage_' . $cpt_slug . '_posts_custom_column', array( $this, 'manage_admin_columns_values' ), 10, 2 );
        }
    }
    
    protected function register_post_type( $slug, $name, array $args ) {
        if ( isset( $args['labels'] ) ) {
            unset( $args['labels'] );
        }
        $default_cpt_args = array(
            'labels'            => array(
                'name'               => sprintf( '%s', $name ),
                'singular_name'      => sprintf( '%s', $name ),
                'menu_name'          => sprintf( '%s', $name ),
                'all_items'          => sprintf( __( 'All %s', 'w9-floral-addon' ), $name ),
                'add_new'            => sprintf( __( 'Add New %s', 'w9-floral-addon' ), $name ),
                'add_new_item'       => sprintf( __( 'Add New %s', 'w9-floral-addon' ), $name ),
                'edit_item'          => sprintf( __( 'Edit %s', 'w9-floral-addon' ), $name ),
                'new_item'           => sprintf( __( 'New %s', 'w9-floral-addon' ), $name ),
                'view_item'          => sprintf( __( 'View %s', 'w9-floral-addon' ), $name ),
                'items_archive'      => sprintf( __( '%s Archive', 'w9-floral-addon' ), $name ),
                'search_items'       => sprintf( __( 'Search %s', 'w9-floral-addon' ), $name ),
                'not_found'          => sprintf( __( 'No %s found', 'w9-floral-addon' ), $name ),
                'not_found_in_trash' => sprintf( __( 'No %s found in trash', 'w9-floral-addon' ), $name ),
                'parent_item_colon'  => sprintf( __( '%s Parent', 'w9-floral-addon' ), $name ),
            ),
            'description'       => '',
            'public'            => true,
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_in_menu'      => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_icon'         => 'dashicons-admin-post',
            'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'has_archive'       => false,
            'rewrite'           => array( 'slug' => $slug, 'with_front' => true ),
        );
        $args             = wp_parse_args( $args, $default_cpt_args );

        $rs                   = register_post_type( $slug, $args );
        $this->is_cpt_created = !is_wp_error( $rs );
    }
    
    protected function register_taxonomy( $slug, $name, $postype, array $args ) {
        if ( isset( $args['labels'] ) ) {
            unset( $args['labels'] );
        }

        $defaults_tax_args = array(
            'labels'             => array(
                'name'              => sprintf( '%s', $name ),
                'singular_name'     => sprintf( '%s', $name ),
                'search_items'      => sprintf( __( 'Search %s', 'w9-floral-addon' ), $name ),
                'all_items'         => sprintf( __( 'All %s', 'w9-floral-addon' ), $name ),
                'parent_item'       => sprintf( __( 'Parent %s', 'w9-floral-addon' ), $name ),
                'parent_item_colon' => sprintf( __( 'Parent %s:', 'w9-floral-addon' ), $name ),
                'edit_item'         => sprintf( __( 'Edit %s', 'w9-floral-addon' ), $name ),
                'update_item'       => sprintf( __( 'Update %s', 'w9-floral-addon' ), $name ),
                'add_new_item'      => sprintf( __( 'Add New %s', 'w9-floral-addon' ), $name ),
                'new_item_name'     => sprintf( __( 'New %s Name', 'w9-floral-addon' ), $name ),
                'menu_name'         => sprintf( __( '%s', 'w9-floral-addon' ), $name )
            ),
            'description'        => '',
            'public'             => true,
            'publicly_queryable' => null,
            'hierarchical'       => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'show_tagcloud'      => false,
            'show_in_quick_edit' => true,
            'show_admin_column'  => false,
            'rewrite'            => array( 'slug' => $slug ),
        );
        $args              = wp_parse_args( $args, $defaults_tax_args );

        if ( !taxonomy_exists( $slug ) ) {
            $rs                   = register_taxonomy( $slug, $postype, $args );
            $this->is_tax_created = !is_wp_error( $rs );
        } else {
            $this->is_tax_created = register_taxonomy_for_object_type( $slug, $postype );
        }

    }

    function register_archive_template( $archive_template ) {
        /**
         * Override this function
         */
        return $archive_template;
    }

    function register_single_template( $single_template ) {
        /**
         * Override this function
         */
        return $single_template;
    }

    function manage_admin_columns( $columns ) {
        /**
         * Override this function
         */
        return $columns;
    }

    function manage_admin_columns_values( $column, $post_id ) {
        /**
         * Override this function
         */
    }

    public function is_cpt_created() {
        return $this->is_cpt_created;
    }

    public function is_tax_created() {
        return $this->is_tax_created;
    }
    
    static function beautify( $string ) {
        return ucwords( str_replace( array( '-', '_' ), ' ', trim( $string ) ) );
    }
    
    static function uglify( $string ) {
        return sanitize_key( $string );
    }
}