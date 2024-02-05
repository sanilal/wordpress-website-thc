<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-testimonials.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Testimonials extends WPBakeryShortCode {
    const SC_BASE = 'floral_shortcode_testimonials';

    public function print_rating_html( $rating ) {
        $testimonial_rate = floatval( $rating );
        if ( !empty( $testimonial_rate ) ) {
            $i = 0;
            echo '<span class="rating-wrapper">';
            while ( $i + 1 <= 5 ) {
                if ( $testimonial_rate >= $i + 1 ) {
                    echo '<span class="rating"><span class="star" style="width: 100%"></span></span>';
                } elseif ( $testimonial_rate <= $i ) {
                    echo '<span class="rating"><span class="star" style="width: 0"></span></span>';
                } else {
                    $percent = ( $testimonial_rate - $i ) * 100;
                    echo '<span class="rating"><span class="star" style="width: ' . $percent . '%"></span></span>';
                }
                $i ++;
            }
            echo '</span>';
        }
    }

    public function print_author_avatar( $testimonial_author_avatar ) {
        ?>
        <div class="ts-avatar-wrapper mb-10">
            <?php if ( !empty( $testimonial_author_avatar ) ) {
                echo Floral_Image::get_image( $testimonial_author_avatar, '55x55' );
            } else {
                echo sprintf( '<div class="icon-wrapper"><i class="w9 w9-ico-envato"></i></div>' );
            } ?>
        </div>
        <?php
    }
}
