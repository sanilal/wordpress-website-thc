<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-image.php
 * @time    : 9/7/16 12:29 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once floral_theme_dir() . 'includes/library/resize/resize.php';

class Floral_Image extends Floral_Base {
    
    public static $magnific_size = 'floral_1170';
    
    public function __construct() {
        parent::__construct();
        $this->add_image_size();
    }
    
    /**
     * Add image size
     *
     * Image size very tall with crop false to use pure ratio of image and width base on image size width
     */
    static function add_image_size() {
        add_image_size( 'floral_tiny', 70, 70, true );
        //270
        add_image_size( 'floral_270', 270, 810, false );
        //370
        add_image_size( 'floral_370', 370, 1110, false );
        //570
        add_image_size( 'floral_570', 570, 1710, false );
        //770
        add_image_size( 'floral_770', 770, 2310, false );
        //870
        add_image_size( 'floral_870', 870, 2610, false );
        //1170
        add_image_size( 'floral_1170', 1170, 3510, false );
        //1570
        add_image_size( 'floral_1570', 1570, 4710, false );
    }
    
    /**
     * List of common ratio, and it's value to improve performance
     *
     * @return array
     */
    static function get_floral_ratio_list() {
        //List ratio = width * height, value = r-height / r-width , height = width * value
        return array(
            '16x9' => '0.5625', // (9/16)
            '9x16' => '1.77777777778',
            '21x9' => '0.42857142857',
            '9x21' => '2.33333333333',
            '4x3'  => '0.75',
            '3x4'  => '1.33333333333',
            '3x2'  => '0.666666667',
            '2x3'  => '1.5',
            '1x1'  => '1',
            '2x1'  => '0.5',
            '1x2'  => '2',
        );
    }
    
    /**
     * Get fixed ratio image size
     *
     * @param $image_size
     * @param $ratio
     *
     * @return array
     */
    static function get_fixed_ratio_size( $image_size, $ratio ) {
        global $_wp_additional_image_sizes;
        $ratio_list = self::get_floral_ratio_list();
        $ratio      = ( in_array( $ratio, $ratio_list ) ) ? $ratio : false;
        
        //Get image width
        if ( in_array( $image_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $image_width = get_option( "{$image_size}_size_w" );
        } elseif ( isset( $_wp_additional_image_sizes[$image_size] ) ) {
            $image_width = $_wp_additional_image_sizes[$image_size]['width'];
        } elseif ( $custom_size = self::extract_image_size( $image_size ) ) {
            $image_width = $custom_size[0];
        } else {
            $image_width = false;
        }
        if ( $ratio && $image_width ) {
            return array( 0 => $image_width, 1 => $image_width * $ratio );
        } else {
            return $image_size;
        }
    }
    
    /**
     * Caculate image size by column
     *
     * @param $incol
     *
     * @return mixed|string
     */
    static function calculate_image_size_column( $incol ) {
        $number_columns = isset( $incol['col'] ) ? $incol['col'] : 12;
        $container      = isset( $incol['container'] ) ? $incol['container'] : 'normal';
        if ( is_int( $number_columns ) && $number_columns < 0 && $number_columns > 12 ) {
            return 'full';
        }
        
        $size_list = array(
            0  => 'floral_tiny',
            1  => 'floral_tiny',
            2  => 'floral_270',
            3  => 'floral_270',
            4  => 'floral_370',
            5  => 'floral_570',
            6  => 'floral_570',
            7  => 'floral_770',
            8  => 'floral_770',
            9  => 'floral_870',
            10 => 'floral_1170',
            11 => 'floral_1170',
            12 => 'floral_1170',
            13 => 'floral_1570',
            14 => 'full',
        );
        
        // Normal Container
        if ( $container == 'normal' ) {
            return $size_list[$number_columns];
        }
        //Container Extended
        if ( $container == 'extended' ) {
            return $size_list[( $number_columns + 1 )];
        } //Container Fullwidth
        else {
            return $size_list[( $number_columns + 2 )];
        }
    }
    
    /**
     * Get image by id and column that it contain
     *
     * @param int   $id
     * @param array $incol
     * @param array $attr
     *
     * @return string
     */
    static function get_image_for_column( $id, $incol, $attr = array() ) {
        $image_size = self::calculate_image_size_column( $incol );
        self::get_image( $id, $image_size, $attr );
    }
    
    /**
     * Get image by ratio
     *
     * @param       $id
     * @param       $image_size
     * @param       $ratio
     * @param array $attr
     *
     * @return string
     */
    static function get_image_by_fixed_ratio( $id, $image_size, $ratio, $attr = array() ) {
        $image_size = self::get_fixed_ratio_size( $image_size, $ratio );
        
        return self::get_image( $id, $image_size, $attr );
    }
    
    /**
     * Get image by id
     *
     * @param int    $id
     * @param        $image_size
     * @param string $attr
     *
     * @return string
     */
    static function get_image( $id, $image_size = 'thumbnail', $attr = '' ) {
        if ( isset( $attr['ratio'] ) ) {
            $image_size = self::get_fixed_ratio_size( $image_size, $attr['ratio'] );
            unset( $attr['ratio'] );
        }
        
        if ( is_string( $image_size ) &&
            ( has_image_size( $image_size ) || in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full', ) ) )
        ) {
            return wp_get_attachment_image( $id, $image_size, false, $attr );
        } else {
            if ( $image_size = self::extract_image_size( $image_size ) ) {
                $image_src = wp_get_attachment_image_src( $id, 'full' );
                if ( $image_src ) {
                    $image = matthewruddy_image_resize( $image_src[0], $image_size[0], $image_size[1], true );
                    
                    $retina_images = self::generate_retina_images( $image_src, $image );
                    
                    return self::render_image( $id, $image, $retina_images, $image_size, $attr );
                }
            }
        }
        
        return '';
    }
	
	/**
	 * Get resize image url
	 *
	 * @param int    $id
	 * @param        $image_size
	 * @param string $attr
	 *
	 * @return string
	 */
	
	static function get_resize_image_url( $id, $image_size = 'thumbnail', $attr = '' ) {
		$image = array();
		if ( isset( $attr['ratio'] ) ) {
			$image_size = self::get_fixed_ratio_size( $image_size, $attr['ratio'] );
			unset( $attr['ratio'] );
		}
		
		if ( is_string( $image_size ) &&
		     ( has_image_size( $image_size ) || in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full', ) ) )
		) {
			$image = wp_get_attachment_image_src( $id, $image_size );
			if (is_array($image) && !empty($image)) {
				return reset($image);
			}
		} else {
			if ( $image_size = self::extract_image_size( $image_size ) ) {
				$image_src = wp_get_attachment_image_src( $id, 'full' );
				if ( $image_src ) {
					$image = matthewruddy_image_resize( $image_src[0], $image_size[0], $image_size[1], true );
					return reset($image);
				}
			}
		}
		return '';
	}
    
    /**
     * Generate suitable retina image
     * Return max $retina == 3
     *
     * @param $image_raw
     * @param $image
     *
     * @return array|bool
     */
    static function generate_retina_images( $image_raw, $image ) {
        $raw_width  = $image_raw[1];
        $raw_height = $image_raw[2];
        
        $image_width    = $image['width'];
        $image_height   = $image['height'];
        $image_width2x  = $image_width * 2;
        $image_height2x = $image_height * 2;
        $image_width3x  = $image_width * 3;
        $image_height3x = $image_height * 3;
        
        $retina_image = array();
        
        if ( $raw_width >= $image_width3x && $raw_height >= $image_height3x ) {
            $image_retina[] = matthewruddy_image_resize( $image_raw[0], $image_width3x, $image_height3x, true, false );
        }
        
        if ( $raw_width >= $image_width2x && $raw_height >= $image_height2x ) {
            $image_retina[] = matthewruddy_image_resize( $image_raw[0], $image_width2x, $image_height2x, true, false );
        }
        
        if ( $raw_width > $image_width && $raw_height > $image_height ) {
            if ( $raw_width == 0 || $raw_height == 0 || $image_width == 0 || $image_height == 0 ) {
                return $retina_image;
            }
            //Crop biggest size it can
            $tmp1 = $image_width / $raw_width;
            $tmp2 = $image_height / $raw_height;
            
            if ( $tmp1 > $tmp2 ) {
                $retina_width  = $raw_width;
                $retina_height = intval($image_height / $tmp1);
            } else {
                $retina_height = $raw_height;
                $retina_width  = intval($image_width / $tmp2);
            }
            $image_retina[] = matthewruddy_image_resize( $image_raw[0], $retina_width, $retina_height, true, false );
        }
        if ( isset( $image_retina ) ) {
            return $image_retina;
        } else {
            return false;
        }
    }
    
    /**
     * Generate image from url
     *
     * @param $image_url
     * @param $attr
     */
    static function render_image_from_url( $image_url, $attr ) {
        $default_attr = array(
            'src'   => $image_url,
            'class' => 'w9-external-image',
            'alt'   => esc_html__( 'External image', 'floral' )
        );
        $attr         = wp_parse_args( $attr, $default_attr );
        $html         = "<img";
        foreach ( $attr as $name => $value ) {
            $html .= " $name=" . '"' . $value . '"';
        }
        $html .= ' />';
        
        return $html;
    }
    
    /**
     * Render attachment in custom size
     *
     * @param $id
     * @param $image
     * @param $retina_images
     * @param $size
     * @param $attr
     *
     * @return string
     */
    static function render_image( $id, $image, $retina_images, $size, $attr ) {
        $html = '';
        if ( is_array( $image ) ) {
            $src    = $image['url'];
            $width  = $image['width'];
            $height = $image['height'];
            
            $hwstring   = image_hwstring( $width, $height );
            $size_class = $size;
            if ( is_array( $size_class ) ) {
                $size_class = join( 'x', $size_class );
            }
            $attachment   = get_post( $id );
            $default_attr = array(
                'src'   => $src,
                'class' => "attachment-$size_class size-$size_class",
                'alt'   => trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) ), // Use Alt field first
            );
            if ( empty( $default_attr['alt'] ) ) {
                $default_attr['alt'] = trim( strip_tags( $attachment->post_excerpt ) );
            } // If not, Use the Caption
            if ( empty( $default_attr['alt'] ) ) {
                $default_attr['alt'] = trim( strip_tags( $attachment->post_title ) );
            } // Finally, use the title
            
            
            $attr = wp_parse_args( $attr, $default_attr );
            
            if (isset($attr['extra-class']) && !empty($attr['extra-class'])) {
	            $attr['class'] .= ' ' .  $attr['extra-class'];
	            unset($attr['extra-class']);
            }
            
            $attr_srcset = array( $image['url'] . ' ' . $width . 'w' );
            
            if ( is_array( $retina_images ) ) {
                foreach ( $retina_images as $retina_image ) {
                    $attr_srcset[] = $retina_image['url'] . ' ' . intval($retina_image['width']) . 'w';
                }
            }
            
            $attr['srcset'] = implode( ', ', $attr_srcset );
            
//            $attr_sizes = '(min-width: 992px) ' . $width . 'px';
            $attr_sizes = '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
            
            $attr['sizes'] = $attr_sizes;
            
            /**
             * Filter the list of attachment image attributes.
             *
             * @since 2.8.0
             *
             * @param array        $attr       Attributes for the image markup.
             * @param WP_Post      $attachment Image attachment post.
             * @param string|array $size       Requested size. Image size or array of width and height values
             *                                 (in that order). Default 'thumbnail'.
             */
            $attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment, $size );
            $attr = array_map( 'esc_attr', $attr );
            $html = rtrim( "<img $hwstring" );
            foreach ( $attr as $name => $value ) {
                $html .= " $name=" . '"' . $value . '"';
            }
            $html .= ' />';
        }
        
        return $html;
    }
    
    static function get_image_size_witdh( $size_name ) {
        global $_wp_additional_image_sizes;
        if ( in_array( $size_name, array( 'thumbnail', 'medium', 'mediumn_large', 'large' ) ) ) {
            return get_option( $size_name . '_size_w' );
        } elseif ( key_exists( $size_name, $_wp_additional_image_sizes ) ) {
            return $_wp_additional_image_sizes[$size_name]['width'];
        } elseif ( $size = self::extract_image_size( $size_name ) ) {
            return $size[0];
        } else {
            return false;
        }
    }

    /**
     * get_image_size_dimension
     *
     * @param $size_name
     *
     * @return bool|string
     */
    static function get_image_size_dimension( $size_name ) {
        global $_wp_additional_image_sizes;
        if ( in_array( $size_name, array( 'thumbnail', 'medium', 'mediumn_large', 'large' ) ) ) {
            return get_option( $size_name . '_size_w' ) . 'x' . get_option( $size_name . '_size_h' );
        } elseif ( key_exists( $size_name, $_wp_additional_image_sizes ) ) {
            return $_wp_additional_image_sizes[$size_name]['width'] . 'x' . $_wp_additional_image_sizes[$size_name]['height'];
        } elseif ( $size = self::extract_image_size( $size_name ) ) {
            return $size[0] . 'x' . $size[1];
        } else {
            return false;
        }
    }
    
    /**
     * String image size to array size
     *
     * @param $image_size
     *
     * @return array|bool
     */
    static function extract_image_size( $image_size ) {
        if ( is_array( $image_size ) && sizeof( $image_size ) == 2 ) {
            return $image_size;
        } elseif ( is_string( $image_size ) && preg_match( '/(\d+)x(\d+)/', $image_size, $matches ) ) {
            return array(
                $matches[1], // Width
                $matches[2], // Height
            );
        } else {
            return false;
        }
    }
    
    static function logo( $logo_opt = 'logo', $logo_width = false, $logo_height = false ) {
        $logo  = floral_get_option( $logo_opt );
        $image = '';
        $logo_attr = array( 'alt' => get_bloginfo( 'name' ) );
        if(!empty($logo_width) && $logo_width != 'auto'){
            $logo_attr['width']  = $logo_width;
        }
        if(!empty($logo_height) && $logo_height != 'auto'){
            $logo_attr['height']  = $logo_height;
        }
        
        if ( isset( $logo['attachment_id'] ) ) {
            //Todo: Optimize image size
            $image = Floral_Image::get_image( $logo['url'], 'full' );
        } elseif ( isset( $logo['url'] ) ) {
            $image = Floral_Image::render_image_from_url( $logo['url'], $logo_attr );
        }
        
        return Floral_Wrap::link( $image, home_url( '/' ), array( 'title' => get_bloginfo( 'name' ), 'class' => 'floral-logo-link' ) );
        
    }
    
    static function get_placeholder_image( $image_size = '' , $src_only = false) {
        if ( !empty( $image_size ) ) {
            $dimension = self::get_image_size_dimension( $image_size );
        }
        if ( empty( $image_size ) || $dimension === false ) {
            $dimension = '1170x700';
        }
        $src = 'https://placehold.it/' . $dimension . '?text=featured-image';

        if($src_only){
            return $src;
        }else{
            return '<img src="'. $src .'"/>';
        }
    }
}