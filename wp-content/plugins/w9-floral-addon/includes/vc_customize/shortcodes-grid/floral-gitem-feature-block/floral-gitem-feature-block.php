<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-feature-block.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Gitem_Feature_Block extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_gitem_feature_block';
    
    public function __construct( $settings ) {
        parent::__construct( $settings );
        add_filter( 'vc_gitem_template_attribute_floral_gitem_feature_block', array( $this, 'floral_gitem_feature_block' ), 10, 2 );
    }
    
    public function floral_gitem_feature_block( $value, $data ) {
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
        $post_feature = $taxonomy = '';
        $el_class = '';
        $css = '';
        extract($atts);
        $sc_classes = array(
            'floral-gitem-feature-block',
            $el_class,
            vc_shortcode_custom_css_class( $css ),
        );
        
        $content = '';
        
        if ( $post_feature == 'date' ) {
            $content =  Floral_Wrap::link( get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
        }
        
        //Get categories base on post type
        elseif ( $post_feature == 'categories' ){
            
            $post_type = get_post_type($post);
            if($post_type == 'post'){
                $content = get_the_category_list( ', ', '', $post->ID );
            }elseif ($post_type == 'portfolio'){
                $content = get_the_term_list( $post->ID, Floral_CPT_Portfolio::TAX_SLUG, '', ',' );
            } elseif ($post_type == 'event'){
                $content = get_the_term_list( $post->ID, Floral_CPT_Event::TAX_SLUG, '', ',' );
            }
            
        }
        
        elseif ( $post_feature == 'author' ) {
            $content = Floral_Wrap::link(esc_html( get_the_author() ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), array('title'=> esc_html(get_the_author())));
        }
        
        elseif ( $post_feature == 'number-comment' ) {
            $content = sprintf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'w9-floral-addon' ), number_format_i18n( get_comments_number() ) );
        }
        
        elseif ( $post_feature == 'tags' ) {
            $content = get_the_tag_list( '', ', ' );
        }
        
        elseif ( $post_feature == 'social-follow' ) {
            $content = $this->get_social_folow($post);
        }
        
        elseif ( $post_feature == 'terms' ) {
            if(taxonomy_exists($taxonomy)){
                $content =  get_the_term_list( $post->ID, $taxonomy, '', ', ' );
            }
        }
        
        if(!isset($content)){
            $content = __( 'Wrong feature', 'w9-floral-addon' );
        }
        
        if(!empty($label)){
            $label = '<span class="__label fw-semibold">'. $label .'</span>';
        }
        
        return '<div class="'. floral_clean_html_classes($sc_classes) .'">'.$label.'<span class="__content">'.$content.'</span></div>';
        
    }
    
    public function get_social_folow($post){
        $social_list                       = array(
            'facebook'    => array(
                'icon' => 'fa fa-facebook',
            ),
            'twitter'     => array(
                'icon' => 'fa fa-twitter',
            ),
            'google-plus' => array(
                'icon' => 'fa fa-google-plus',
            ),
            'linkedin'    => array(
                'icon' => 'fa fa-linkedin',
            ),
        );
        
        $social_list['facebook']['url']    = get_post_meta( $post->ID, 'meta-'.$post->post_type.'-social-facebook', true );
        $social_list['twitter']['url']     = get_post_meta( $post->ID, 'meta-'.$post->post_type.'-social-twitter', true );
        $social_list['google-plus']['url'] = get_post_meta( $post->ID, 'meta-'.$post->post_type.'-social-google-plus', true );
        $social_list['linkedin']['url']    = get_post_meta( $post->ID, 'meta-'.$post->post_type.'-social-linkedin', true );
    
        ob_start();
        ?>
        <ul class="social-profiles meta-event-social inline-block-el icon-color-gray8 icon-color-hover-p mb-0 pl-0">
            <?php
            foreach ( $social_list as $key => $value ) {
                if ( !empty( $value['url'] ) ) {
                    echo sprintf( '<li><a href="%s" title="%s"><i class="%s"></i></a></li>', $value['url'], $key, $value['icon'] );
                }
            }
            ?>
        </ul>
        <?php
        return ob_get_clean();
    }
}

