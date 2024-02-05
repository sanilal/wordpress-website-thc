<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-resize.php
 * @time    : 4/29/2016
 * @author  : 9WPThemes Team
 */

// inport core resize
require floral_theme_dir() . 'includes/library/resize/resize.php';


/**
 * @param $dimensions
 *
 * @return array|bool
 */
function floral_extract_dimensions( $dimensions ) {
    $dimensions = str_replace( ' ', '', $dimensions );
    $matches    = null;

    if ( preg_match( '/(\d+)x(\d+)/', $dimensions, $matches ) ) {
        return array(
            $matches[1],
            $matches[2],
        );
    }

    return false;
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function floral_get_image_sizes() {
    global $_wp_additional_image_sizes;
    
    $sizes = array();
    
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[$_size]['width']  = get_option( "{$_size}_size_w" );
            $sizes[$_size]['height'] = get_option( "{$_size}_size_h" );
            $sizes[$_size]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[$_size] ) ) {
            $sizes[$_size] = array(
                'width'  => $_wp_additional_image_sizes[$_size]['width'],
                'height' => $_wp_additional_image_sizes[$_size]['height'],
                'crop'   => $_wp_additional_image_sizes[$_size]['crop'],
            );
        }
    }
    
    return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   get_image_sizes()
 *
 * @param  string $size The image size for which to retrieve data.
 *
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function floral_get_image_size( $size ) {
    $sizes = floral_get_image_sizes();
    
    if ( isset( $sizes[$size] ) ) {
        return $sizes[$size];
    } else {
        $dimensions = floral_extract_dimensions( $size );
        if ( $dimensions ) {
            return array(
                'width'  => $dimensions[0],
                'height' => $dimensions[1],
                'crop'   => true
            );
        }
    }
    
    return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   get_image_size()
 *
 * @param  string $size The image size for which to retrieve data.
 *
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function floral_get_image_width( $size ) {
    if ( !$size = floral_get_image_size( $size ) ) {
        return false;
    }
    
    if ( isset( $size['width'] ) ) {
        return $size['width'];
    }
    
    return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_image_size()
 *
 * @param  string $size The image size for which to retrieve data.
 *
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function floral_get_image_height( $size ) {
    if ( !$size = floral_get_image_size( $size ) ) {
        return false;
    }
    
    if ( isset( $size['height'] ) ) {
        return $size['height'];
    }
    
    return false;
}

/**
 * @param        $image_url
 * @param string $size
 *
 * @return array|WP_Error
 */
function floral_resize_image_by_url( $image_url, $size = 'thumbnail' ) {
    $image_size = floral_get_image_size( $size );

    if ( $image_size == false ) {
        return false;
    }
    
    return matthewruddy_image_resize( $image_url, $image_size['width'], $image_size['height'], $image_size['crop'] );
}

/**
 * @param        $attachment_id
 * @param string $size
 *
 * @return array|WP_Error
 */
function floral_resize_image_by_id( $attachment_id, $size = 'thumbnail' ) {
    $image_src = wp_get_attachment_image_src( $attachment_id, 'full' );

    if ( count( $image_src ) > 0 ) {
        return floral_resize_image_by_url( $image_src[0], $size );
    }

    return false;
}


/**
 * Get an HTML img element representing an image attachment
 *
 * While `$size` will accept an array, it is better to register a size with
 * add_image_size() so that a cropped version is generated. It's much more
 * efficient than having to find the closest-sized image and then having the
 * browser scale down the image.
 *
 * @param int          $attachment_id Image attachment ID.
 * @param string|array $size          Optional. Image size. Accepts any valid image size, or an array of width
 *                                    and height values in pixels (in that order). Default 'thumbnail'.
 * @param string|array $attr          Optional. Attributes for the image markup. Default empty.
 *
 * @return string HTML img element or empty string on failure.
 */
function floral_get_attachment_image( $attachment_id, $size = 'thumbnail', $attr = '' ) {
    $html  = '';
    $image = floral_resize_image_by_id( $attachment_id, $size );
    if ( is_array( $image ) ) {
        $src    = $image['url'];
        $width  = $image['width'];
        $height = $image['height'];

        $hwstring   = image_hwstring( $width, $height );
        $size_class = $size;
        if ( is_array( $size_class ) ) {
            $size_class = join( 'x', $size_class );
        }
        $attachment   = get_post( $attachment_id );
        $default_attr = array(
            'src'   => $src,
            'class' => "attachment-$size_class size-$size_class",
            'alt'   => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ), // Use Alt field first
        );
        if ( empty( $default_attr['alt'] ) ) {
            $default_attr['alt'] = trim( strip_tags( $attachment->post_excerpt ) );
        } // If not, Use the Caption
        if ( empty( $default_attr['alt'] ) ) {
            $default_attr['alt'] = trim( strip_tags( $attachment->post_title ) );
        } // Finally, use the title

        $attr = wp_parse_args( $attr, $default_attr );

        // Generate 'srcset' and 'sizes' if not already present.
        if ( empty( $attr['srcset'] ) ) {
            $image_meta = get_post_meta( $attachment_id, '_wp_attachment_metadata', true );

            if ( is_array( $image_meta ) ) {
                $size_array = array( absint( $width ), absint( $height ) );
                $srcset     = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment_id );
                $sizes      = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );

                if ( $srcset && ( $sizes || !empty( $attr['sizes'] ) ) ) {
                    $attr['srcset'] = $srcset;

                    if ( empty( $attr['sizes'] ) ) {
                        $attr['sizes'] = $sizes;
                    }
                }
            }
        }

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