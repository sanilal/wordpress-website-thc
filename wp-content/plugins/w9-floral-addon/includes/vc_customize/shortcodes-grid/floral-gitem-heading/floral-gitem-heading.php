<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-heading.php
 * @time    : 9/9/16 12:16 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Gitem_Heading extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_gitem_heading';
    
    public function __construct( $settings ) {
        parent::__construct( $settings );
        
        add_filter('vc_gitem_template_attribute_floral_gitem_heading', array($this, 'floral_gitem_heading'), 10 , 2);
    }
    
    public function floral_gitem_heading($value, $data){
        /**
         * @var null|Wp_Post $post ;
         * @var string       $data ;
         */
        extract( array_merge( array(
            'post' => null,
            'data' => '',
        ), $data ) );
        $atts = array();
        parse_str( $data, $atts );
    
        if(isset($atts['heading_title_data_source']) && $atts['heading_title_data_source'] === 'post-title'){
            $atts['heading_title_data_source'] = 'custom-content';
            $atts['heading_title'] = get_the_title($post->ID);
        }
    
    
        $gitem_heading_link      = $atts['gitem_heading_link'];
        $gitem_heading_link_meta = $atts['gitem_heading_link_meta'];
    
        if ( $gitem_heading_link === 'post_link' ) {
            $atts['heading_link'] = 'url:' . urlencode( get_the_permalink( $post->ID ) );
            if(isset($atts['link_target']) && $atts['link_target'] === 'yes'){
                $atts['heading_link'] .= '|target:_blank';
            }
        } elseif ( $gitem_heading_link == 'meta_key' ) {
            $atts['heading_link'] = 'url:' . urlencode( get_post_meta( $post->ID, $gitem_heading_link_meta, true ) );
            if(isset($atts['link_target']) && $atts['link_target'] === 'yes'){
                $atts['heading_link'] .= '|target:_blank';
            }
        } elseif ( $gitem_heading_link == 'none' ) {
            $atts['heading_link'] = '';
        }
    
    
        return Vc_Shortcodes_Manager::getInstance()->getElementClass( 'floral_shortcode_' . 'heading' )->output( $atts );
    }
}

