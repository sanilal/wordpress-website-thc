<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-templates.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Templates extends Floral_Base {

    // Template arguments
    private $template_args;


    public function __construct() {
        parent::__construct();
        $this->template_args = array();

        /**
         * Custom template tags for this theme.
         */
        require_once( floral_theme_dir() . 'includes/common/template-tags.php' );
    }


    protected function add_actions() {
        add_action( 'wp_head', array( $this, 'head_meta' ), 0 );
        add_action( 'wp_head', array( $this, 'head_social_meta' ), 3 );
        add_action( 'floral_page_content_before', array( $this, 'page_header' ) );
        add_action( 'floral_page_content_after', array( $this, 'page_footer' ) );
        add_action( 'floral_page_before', array( $this, 'page_loading' ) );
        add_action( 'floral_page_before', array( $this, 'page_leftzone' ) );
        add_action( 'floral_page_after', array( $this, 'page_rightzone' ) );
        add_action( 'floral_page_after', array( $this, 'panel_selector' ) );
        add_action( 'floral_page_after', array( $this, 'back_to_top' ) );
        add_action( 'floral_page_wrapper_after', array( $this, 'popup_area' ) );
        
    }

    protected function add_filters() {
        add_filter( 'get_search_form', array( $this, 'search_form' ) );
    }

    public function save_all_template_args( $args, $context = '' ) {
        if ( empty( $args ) ) {
            return;
        }

        if ( empty( $context ) ) {
            $context = 'global';
        }

        if ( !isset( $this->template_args[$context] ) ) {
            $this->template_args[$context] = array();
        }

        foreach ( (array) $args as $key => $value ) {
            $this->template_args[$context][$key] = $value;
        }
    }

    public function save_template_args( $key, $value, $context = '' ) {
        if ( empty( $args ) ) {
            return;
        }

        if ( empty( $context ) ) {
            $context = 'global';
        }

        if ( !isset( $this->template_args[$context] ) ) {
            $this->template_args[$context] = array();
        }

        $this->template_args[$context][$key] = $value;
    }

    public function get_all_template_args( $context = '' ) {
        if ( empty( $context ) ) {
            $context = 'global';
        }
        if ( isset( $this->template_args[$context] ) ) {
            return $this->template_args[$context];
        }

        return null;
    }

    public function get_template_args( $key, $context = '', $default = null ) {
        if ( empty( $context ) ) {
            $context = 'global';
        }

        if ( isset( $this->template_args[$context] ) && isset( $this->template_args[$context][$key] ) ) {
            return $this->template_args[$context][$key];
        }

        return $default;
    }


    /**
     * head meta output
     */
    function head_meta() {
        $this->get_template_part( 'parts/head-meta' );
    }

    /**
     * head social meta output
     */
    function head_social_meta() {
        $this->get_template_part( 'parts/head-social-meta' );
    }
    /**
     * Page header desktop and mobile
     */
    function page_header() {
        $this->get_template_part( 'header' );
    }
    
    
    /**
     * Page footer
     */
    function page_footer() {
        $this->get_template_part( 'footer' );
    }
    
    /**
     * Page loading module
     */
    function page_loading() {
        $this->get_template_part( 'parts/page-transitions' );
    }
    
    /**
     * Page left zone
     */
    function page_leftzone() {
        $this->get_template_part( 'sidezone/page-leftzone' );
    }
    
    /**
     * Page right zone
     */
    function page_rightzone() {
        $this->get_template_part( 'sidezone/page-rightzone' );
    }
    
    /**
     * panel selector
     */
    function panel_selector() {
        $this->get_template_part( 'parts/panel-selector' );
    }
    
    /**
     * Back-to-top button
     */
    function back_to_top() {
        $this->get_template_part( 'parts/back-to-top' );
    }
    
    function popup_area(){
        $this->get_template_part('sidezone/popup-area');
    }

    /**
     * Search form template
     *
     * @param $form
     *
     * @return string
     */
    function search_form( $form ) {
        ob_start();
        ?>
        <form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
            <input type="text" class="search-field" autocomplete="off" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e( 'Search&hellip;', 'floral' ); ?>">
            <button type="submit"><i class="__icon-search w9 w9-ico-search-icon"></i></button>
        </form>
        <?php
        $form = ob_get_clean();

        return apply_filters( 'floral/template/search-form', $form );
    }


    /**
     * Get template parts
     *
     * @param       $slug
     * @param null  $name
     * @param array $args
     */
    public function get_template_part( $slug, $name = null, $args = array() ) {
        /**
         * @todo: implement cache save
         */
        // save all args
        $this->save_all_template_args( (array) $args, $slug );
        //get template
        get_template_part( 'templates' . DIRECTORY_SEPARATOR . $slug, $name );

    }
}

