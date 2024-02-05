<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-image-carousel.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Gitem_Image_Carousel extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_gitem_image_carousel';
    
    public function __construct( $settings ) {
        parent::__construct( $settings );
        add_filter('vc_gitem_template_attribute_floral_gitem_image_carousel', array($this, 'floral_gitem_image_carousel'), 10 , 2);
    }
    
    public function floral_gitem_image_carousel($value, $data){
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
        $source = '';
        $meta_key = '';
        extract($atts);
        $u_class= uniqid('owl-ajax-load');
        $atts['el_class'] .= $u_class;
        
        if($source == 'custom'){
            $source = $meta_key;
        }
//        ob_start();
        if($source != 'static'){
            $image_list = array();
            $meta_gallery = get_post_meta($post->ID, $source, true);
            if(is_array($meta_gallery) && sizeof($meta_gallery) > 0){
                foreach ($meta_gallery as $image){
                    if(isset($image['attachment_id'])){$image_list[] = $image['attachment_id'];}
                }
                $atts['images'] = implode(',', $image_list);
            }
        }
//        return ob_get_clean();
    
        return Vc_Shortcodes_Manager::getInstance()->getElementClass( Floral_SC_Image_Carousel::SC_BASE )->output( $atts )
            .'<script>
                jQuery(document).ready(function(){
                    floral.core.do_owl_carousel(jQuery(".'. $u_class .'"));
                });
            </script>';
    }
}

