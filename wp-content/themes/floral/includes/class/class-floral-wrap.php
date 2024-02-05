<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-wrap.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Wrap extends Floral_Base {
    
    public function __construct() {
        parent::__construct();
    }
    
    static function calculate_slider_responsive_base_on_min_width( $min_width = 300, $max_item = 5 ) {
        $item = array();
        for ( $i = 0; $i < $max_item; $i ++ ) {
            $item[$min_width * $i]['items'] = $i;
        }
    }
    
    static function slider( $content, array $args = array(), array $class = array(), $ajax = false ) {
        $default_args = array(
            'items'              => 1,
            'nav'                => false,
            'dots'               => false,
            'loop'               => true,
            'center'             => false,
            'mouseDrag'          => true,
            'touchDrag'          => true,
            'pullDrag'           => true,
            'freeDrag'           => false,
            'margin'             => 0,
            'stagePadding'       => 0,
            'merge'              => false,
            'mergeFit'           => true,
            'autoWidth'          => false,
            'startPosition'      => 0,
            'smartSpeed'         => 250,
            'fluidSpeed'         => false,
            'dragEndSpeed'       => false,
            'autoplayHoverPause' => true,
        );
        
        $args      = wp_parse_args( $args, $default_args );
        $unique_id = uniqid( 'floral-slider-container' );
        if ( $ajax !== false ) {
            $class[] = 'manual';
        }
        
        ob_start();
        ?>
        <div id="<?php echo esc_attr( $unique_id ); ?>" class="floral-slider-container owl-carousel floral-owl-control <?php floral_the_clean_html_classes( $class ); ?>"
             data-options="<?php echo esc_attr( json_encode( $args ) ); ?>">
            <?php echo do_shortcode( $content ) ?>
        </div>
        <?php
        if ( $ajax !== false ) {
            ?>
            <script>
                (function ($) {
                    $(document).ready(function () {
                        floral.core && floral.core.do_owl_carousel($("#<?php echo esc_attr( $unique_id )?>"))
                    });
                })(jQuery);
            </script>
            
            <?php
        }
        
        return ob_get_clean();
    }
    
    static function link( $content, $href = "#", array $args = array() ) {
        $atts = '';
        foreach ( $args as $attr => $value ) {
            if ( empty( $value ) ) {
                continue;
            }
            $atts .= sprintf( ' %s="%s"', $attr, esc_attr( $value ) );
        }
        
        ob_start();
        ?>
        <a href="<?php echo esc_url( $href ) ?>" <?php echo sprintf( '%s', $atts ) ?>>
            <?php echo sprintf('%s', $content); ?>
        </a>
        <?php
        return ob_get_clean();
    }
    
    static function div( $class, $id ) {
        if ( is_array( $class ) ) {
            $class = implode( ' ', $class );
        }
        ob_start();
        ?>
        <div id="<?php echo esc_attr( $id ) ?>" class="<?php echo esc_attr( $class ) ?>">
        
        </div>
        <?php
        return ob_get_clean();
    }
    
    static function image_with_action( $image_id, $image_size, $action = 'none', $args = array() ) {
        if ( $action == 'lightbox' ) {
            return self::prettyphoto_image( $image_id, $image_size );
        } else {
            $image = Floral_Image::get_image( $image_id, $image_size );
            if ( $action == 'none' || empty( $action ) ) {
                return Floral_Image::get_image( $image_id, $image_size );
            } elseif ( $action == 'large_image' && !empty( $image ) ) {
                if ( $large_image_src = wp_get_attachment_image_src( $image_id, 'full' ) ) {
                    $large_image_src = $large_image_src[0];
                    
                    return self::link( $image, $large_image_src, array( 'target' => '_blank', 'alt' => get_the_title() ) );
                } else {
                    return '';
                }
            } elseif ( $action == 'link' && !empty( $image ) ) {
                return self::link( $image, $args['href'], array( 'alt' => get_the_title() ) );
            }
        }
    }
    
    
    static function prettyphoto_image( $image_id, $image_size, $args = array(), $html = array() ) {
        $args = wp_parse_args( $args, array(
            'gallery'          => '',
            'image_popup_size' => Floral_Image::$magnific_size,
        ) );
        
        $image_args = array();
        if ( isset( $args['ratio'] ) ) {
            $image_args['ratio'] = $args['ratio'];
        }
        $image = Floral_Image::get_image( $image_id, $image_size, $image_args );
        if ( empty( $image ) ) {
            return '';
        }
        $html['before'] = isset($html['before']) ? $html['before'] : '';
        $html['after'] = isset($html['after']) ? $html['after'] : '';
        
        $image_html = $html['before'] . $image . $html['after'];
        
        if ( empty( $image_popup_size ) ) {
            $image_popup_size = Floral_Image::$magnific_size;
        }
        $popup_image = wp_get_attachment_image_src( $image_id, $image_popup_size );
        $rel = '';
        
        if ($args['gallery'] === '') {
            $rel = 'floral-prettyPhoto';
        } elseif ($args['gallery'] === 'pp-gal' ) {
            $rel = 'prettyPhoto[pp_gal]';
        } else {
            $rel = sprintf( 'floral-owl-prettyPhoto[%s]', $args['gallery'] );
        }
        
//        $rel         = ( $args['gallery'] === '' ) ? 'floral-prettyPhoto' : sprintf( 'floral-owl-prettyPhoto[%s]', $args['gallery'] );
        
        ob_start();
        ?>
        <a href="<?php echo esc_attr( $popup_image[0] ); ?>" class="floral-pretty-photo-link" data-rel="<?php echo esc_attr($rel) ?>">
            <?php echo sprintf( '%s', $image_html ); ?>
        </a>
        <?php
        return ob_get_clean();
    }
    
    //Todo: build js and test function
    static function magnific_popup( $content, $args = array() ) {
        $defaults = array();
        $args     = wp_parse_args( $args, $defaults );
        ob_start();
        ?>
        <div class="magnific_popup" data-options="<?php json_encode( $args ) ?>">
            <?php echo wp_kses_post( $content ); ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    
}