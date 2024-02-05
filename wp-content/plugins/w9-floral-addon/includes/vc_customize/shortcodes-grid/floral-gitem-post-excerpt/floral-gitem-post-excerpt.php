<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-post-excerpt.php
 * @time    : 9/10/16 4:47 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Gitem_Post_Excerpt extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_gitem_post_excerpt';
    
    public function __construct( $settings ) {
        parent::__construct( $settings );
        add_filter( 'vc_gitem_template_attribute_floral_gitem_post_excerpt', array( $this, 'floral_gitem_post_excerpt' ), 10, 2 );
    }
    
    public function floral_gitem_post_excerpt( $value, $data ) {
        /**
         * @var null|Wp_Post $post ;
         * @var string       $data ;
         */
        extract( array_merge( array(
            'post' => null,
            'data' => '',
        ), $data ) );
        
        // Return empty excerpt if post password is required
        if(post_password_required()){
            return '';
        }
        
        $atts = array();
        
        parse_str( $data, $atts );
        $post_excerpt_max_length = '';
        $text_before_readmore_link = '';
        $readmore_text = '';
        $css                     = '';
        $el_class                = '';
        extract( $atts );
        
        $sc_classes = array(
            'floral-gitem-post-excerpt',
            $el_class,
            vc_shortcode_custom_css_class( $css ),
        );
        
        //Get excerpt from content
//        $post_excerpt = get_the_content( );
//        $post_excerpt = preg_replace( " ([.*?])", '', $post_excerpt );
//        $post_excerpt = strip_shortcodes( $post_excerpt );
//        $post_excerpt = strip_tags( $post_excerpt );
//        $post_excerpt = substr( $post_excerpt, 0, $post_excerpt_max_length );
//        $post_excerpt = substr( $post_excerpt, 0, strripos( $post_excerpt, " " ) );
//        $post_excerpt = trim( $post_excerpt );
    
        //Get excerpt from official excerpt of post, custom postytpe that support excerpt
        $post_excerpt = get_the_excerpt($post);
        $post_excerpt = substr( $post_excerpt, 0, $post_excerpt_max_length );
        $post_excerpt = substr( $post_excerpt, 0, strripos( $post_excerpt, " " ) );
        $post_excerpt = trim( $post_excerpt );
        
        
        if(!empty($post_excerpt)){
            $readmore = '';
            if(!empty($text_before_readmore_link)){
                $readmore .= esc_html($text_before_readmore_link);
            }
            if(!empty($readmore_text)){
                $readmore_text = esc_html($readmore_text);
                $readmore .= '<a title="'. $readmore_text .'" href="' . get_permalink( $post->ID ) . '">'. $readmore_text .'</a>';
            }
            $post_excerpt = $post_excerpt . $readmore;
        }
        
        return sprintf( '<div class="%s">%s</div>', floral_clean_html_classes( $sc_classes ), $post_excerpt );
    }
}

