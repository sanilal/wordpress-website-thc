<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-exporter.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Exporter {

    /**
     * Generate options data
     * @return false|string
     */
    static function create_data_options_file() {
        /**
         * @global wpdb $wpdb
         */
        global $wpdb;
        $_options = array(
            //widgets
            'sidebars_widgets'                         => '=',
            'widget_%'                                 => 'like',
            //theme mods
            'theme_mods_' . get_option( 'stylesheet' ) => '=',
            //options and preset
            FLORAL_THEME_OPTIONS_DEFAULT_NAME          => '=',
            '_floral_ps_%'                             => 'like',
            // show on front
            'show_on_front'                            => '=',
            'page_on_front'                            => '=',
            'page_for_posts'                           => '=',
            //woocommerce
            'shop_catalog_image_size'                  => '=',
            'shop_single_image_size'                   => '=',
            'shop_thumbnail_image_size'                => '=',
            'woocommerce_%'                            => 'like',

            //mailchimp
            'mc4wp_default_form_id'                    => '=',
            // permalink stucture
            'permalink_structure'                      => '=',

            // default image size
            'medium_size_w'                            => '=',
            'medium_size_h'                            => '=',
            'thumbnail_size_w'                         => '=',
            'thumbnail_size_h'                         => '=',
            'large_size_w'                             => '=',
            'large_size_h'                             => '=',
        );

        $data = array();
        foreach ( $_options as $option => $operator ) {
            //get data
            $rows = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value, autoload FROM $wpdb->options WHERE option_name $operator %s;", $option ) );
            //fetching data
            foreach ( $rows as $id => $row ) {
                $data[$row->option_name] = array(
                    'option_value' => $row->option_value,
                    'autoload'     => $row->autoload
                );
            }
        }

        // woocommerce attribute taxonomy
        $_woocommerce_attr_taxs         = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}woocommerce_attribute_taxonomies;", ARRAY_A );
        $data['_woocommerce_attr_taxs'] = array(
            'option_value' => $_woocommerce_attr_taxs,
            'autoload'     => false
        );

        return self::store_data( 'data-options.json', $data );
    }

    static function create_data_update_file() {
        $data = array();
        // nav menu locations
        $navs = get_terms( array( 'taxonomy' => 'nav_menu', 'hide_empty' => false ) );

        $data['nav_menu'] = array();
        foreach ( $navs as $nav ) {
            $data['nav_menu'][$nav->term_id] = $nav->slug;
        }
        // page setup
        $data['page']   = array();
        $page_for_posts = get_option( 'page_for_posts' );
        $page_on_front  = get_option( 'page_on_front' );
        if ( !empty( $page_for_posts ) ) {
            $data['page']['page_for_posts'] = get_post( $page_for_posts )->post_name;
        }

        if ( !empty( $page_on_front ) ) {
            $data['page']['page_on_front'] = get_post( $page_on_front )->post_name;
        }

        return self::store_data( 'data-update.json', $data );
    }


    static function store_data( $file_name, $data ) {
        global $wpdb;
        // sanitize folder name
        $demo_folder_name = sanitize_key( get_bloginfo( 'blogname' ) );
        if ( strlen( $demo_folder_name ) > 10 ) {
            $demo_folder_name = substr( $demo_folder_name, 0, 10 );
        }
        $store_path = FLORAL_DEMO_DATA_PATH . $demo_folder_name . '-' . $wpdb->blogid;

        $store_path = trailingslashit( $store_path );

        //store file
        if ( !is_dir( $store_path ) ) {
            if ( !wp_mkdir_p( $store_path ) ) {
                return wp_json_encode( array( 'status' => 'error', 'message' => esc_html__( 'Insufficient permissions to create files', 'floral' ) ) );
            }
        }

        if ( !floral_put_file_content( $store_path . $file_name, wp_json_encode( $data ) ) ) {
            return wp_json_encode( array( 'status' => 'error', 'message' => esc_html__( 'Insufficient permissions to create files', 'floral' ) ) );
        }

        return wp_json_encode( array( 'status' => 'success', 'message' => sprintf( esc_html__( 'The file is placed in: %s', 'floral' ), $store_path . $file_name ) ) );
    }
}

if ( isset( $_GET['generate-data-options'] ) || isset( $_GET['generate-data'] ) ) {
    Floral_Exporter::create_data_options_file();
}

if ( isset( $_GET['generate-data-update'] ) || isset( $_GET['generate-data'] ) ) {
    Floral_Exporter::create_data_update_file();
}