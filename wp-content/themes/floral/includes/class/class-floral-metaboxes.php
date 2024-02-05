<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-metaboxes.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Metaboxes extends Floral_Base {
    private $metaboxes;
    private $reserve_metaboxes;
    
    public function __construct() {
        parent::__construct();
        $this->metaboxes         = array();
        $this->reserve_metaboxes = array();
        $this->init_metaboxes();
    }
    
    protected function add_actions() {
        add_action( 'redux/metaboxes/' . floral_get_current_preset() . '/boxes', array( $this, 'get_metaboxes' ) );
    }
    
    
    /**
     * Init metabox sections
     */
    private function init_metaboxes() {
        // custom post type metabox
        $this->metaboxes[] = $this->get_page_metaboxes();
        
        // options for post format
        $this->metaboxes[] = $this->get_image_post_metaboxes();
        $this->metaboxes[] = $this->get_gallery_post_metaboxes();
        $this->metaboxes[] = $this->get_video_post_metaboxes();
        $this->metaboxes[] = $this->get_audio_post_metaboxes();
        $this->metaboxes[] = $this->get_quote_post_metaboxes();
        $this->metaboxes[] = $this->get_link_post_metaboxes();
        
        // post
        $this->metaboxes[] = $this->get_post_metaboxes();
        
        //review
        $this->metaboxes[] = $this->get_review_metaboxes();
        $this->metaboxes[] = $this->get_product_metaboxes();
        $this->metaboxes[] = $this->get_portfolio_metaboxes();
        $this->metaboxes[] = $this->get_service_metaboxes();
        $this->metaboxes[] = $this->get_event_metaboxes();
        $this->metaboxes[] = $this->get_theme_demo_metaboxes();
    }
    
    /**
     * Get metaboxes sections
     * @return array
     */
    public function get_metaboxes() {
        return $this->metaboxes;
    }
    
    
    /**
     * Metabox for image post format
     * @return array
     */
    private function get_image_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-image.php';
        
        return array(
            'id'          => 'floral-image-post-options',
            'title'       => esc_html__( 'Image Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'image' )
        );
    }
    
    /**
     * Matabox for video post format
     * @return array
     */
    private function get_video_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-video.php';
        
        return array(
            'id'          => 'floral-video-post-options',
            'title'       => esc_html__( 'Video Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'video' )
        );
    }
    
    /**
     * Metabox for gallery post format
     * @return array
     */
    private function get_gallery_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-gallery.php';
        
        return array(
            'id'          => 'floral-gallery-post-options',
            'title'       => esc_html__( 'Gallery Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'gallery' )
        );
    }
    
    /**
     * Metabox for audio post format
     * @return array
     */
    private function get_audio_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-audio.php';
        
        return array(
            'id'          => 'floral-audio-post-options',
            'title'       => esc_html__( 'Audio Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'audio' )
        );
    }
    
    
    /**
     * Metabox for quote post format
     * @return array
     */
    private function get_quote_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-quote.php';
        
        return array(
            'id'          => 'floral-quote-post-options',
            'title'       => esc_html__( 'Quote Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'quote' )
        );
    }
    
    /**
     * Metabox for link post format
     * @return array
     */
    private function get_link_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-post-link.php';
        
        return array(
            'id'          => 'floral-link-post-options',
            'title'       => esc_html__( 'Link Post Options', 'floral' ),
            'post_types'  => array( 'post' ),
            'position'    => 'normal', // normal, advanced, side
            'priority'    => 'high', // high, core, default, low
            'sections'    => $sections,
            'post_format' => array( 'link' )
        );
    }
    
    
    /**
     * Metabox for general post
     * @return array
     */
    private function get_post_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-content-blog-single.php';
        
        $sections = array_merge( $this->get_common_options(), $sections );
        
        return array(
            'id'         => 'floral-post-options',
            'title'      => esc_html__( 'Options', 'floral' ),
            'post_types' => array( 'post' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'high', // high, core, default, low
            'sections'   => $sections
        );
    }
    
    /**
     * Metabox for page
     * @return array
     */
    private function get_page_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-content-page.php';
        
        $sections = array_merge( $this->get_common_options(), $sections );
        
        return array(
            'id'         => 'floral-page-options',
            'title'      => esc_html__( 'Options', 'floral' ),
            'post_types' => array( 'page' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'high', // high, core, default, low
            'sections'   => $sections,
//            'page_template' => array(
//                'page_left-title.php'
//            )
        );
    }
    
    /**
     * Metabox for review
     * @return array
     */
    private function get_review_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-review.php';
        
        return array(
            'id'         => 'floral-review',
            'title'      => esc_html__( 'New Review', 'floral' ),
            'post_types' => array( 'review' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'high', // high, core, default, low
            'sections'   => $sections
        );
    }
    
    /**
     * Metabox for product
     * @return array
     */
    private function get_product_metaboxes() {
        
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-product-general.php';
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-content-template.php';
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-subzone.php';
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-product-title.php';
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-product-footer.php';
        $_sections = $sections;
        
        
        return array(
            'id'         => 'floral-woocommerce-product',
            'title'      => esc_html__( 'Product Options', 'floral' ),
            'post_types' => array( 'product' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'default', // high, core, default, low
            'sections'   => $sections
        );
    }
    
    /**
     * Metabox for portfolio
     * @return array
     */
    private function get_portfolio_metaboxes() {
        $sections = array();
        
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-portfolio.php';
        $sections = array_merge( $sections, $this->get_common_options() );
        
        
        return array(
            'id'         => 'floral-portfolio',
            'title'      => esc_html__( 'Options', 'floral' ),
            'post_types' => array( 'portfolio' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'low', // high, core, default, low
            'sections'   => $sections
        );
    }
	
	private function get_service_metaboxes() {
		$sections = array();
		
		require floral_theme_dir() . 'includes/features/metaboxes/metabox-service.php';
		$sections = array_merge( $sections, $this->get_common_options() );
		
		
		return array(
			'id'         => 'floral-service',
			'title'      => esc_html__( 'Options', 'floral' ),
			'post_types' => array( 'service' ),
			'position'   => 'normal', // normal, advanced, side
			'priority'   => 'low', // high, core, default, low
			'sections'   => $sections
		);
	}
    
    private function get_event_metaboxes() {
        $sections = array();
        
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-event.php';
	    $sections = array_merge( $sections, $this->get_common_options() );
        
        return array(
            'id'         => 'floral-event',
            'title'      => esc_html__( 'Event Options', 'floral' ),
            'post_types' => array( 'event' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'high', // high, core, default, low
            'sections'   => $sections
        );
    }
    
    private function get_common_options() {
        static $_sections;
        
        if ( empty( $_sections ) ) {
            $sections = array();
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-general.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-content-template.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-header.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-header-content.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-subzone.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-title.php';
            require floral_theme_dir() . 'includes/features/metaboxes/metabox-footer.php';
            $_sections = $sections;
        }
        
        return $_sections;
    }
    
    private function get_theme_demo_metaboxes() {
        $sections = array();
        require floral_theme_dir() . 'includes/features/metaboxes/metabox-theme-demo.php';
        
        return array(
            'id'         => 'floral-demo',
            'title'      => esc_html__( 'Theme Demo Options', 'floral' ),
            'post_types' => array( 'theme-demo' ),
            'position'   => 'normal', // normal, advanced, side
            'priority'   => 'high', // high, core, default, low
            'sections'   => $sections
        );
    }
}