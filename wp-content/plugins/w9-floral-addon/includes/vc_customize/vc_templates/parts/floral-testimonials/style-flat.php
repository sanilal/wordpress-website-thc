<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: style-flat.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

?>
<div class="testimonial-item clearfix">
    <div class="item-inner">
        <div class="ts-content-wrapper">
            <div class="ts-content-inner">
                <p class="ts-content pb-10 mb-0 fz-16 fw-medium"><?php echo esc_html( $testimonial_content ); ?></p>
                <?php
                if ( $testimonial_show_author_rating === 'yes' ) {
                    $this->print_rating_html( $testimonial_rate );
                }
                ?>
                <div class="ts-author-info">
                    <div class="pull-left mr-15">
                        <?php if ( $testimonial_show_author_avatar === 'yes' ) {
                            $this->print_author_avatar( $testimonial_author_avatar );
                        } ?>
                    </div>
                    <div class="ts-info-inner">
                        <p class="mb-0">
                            <a class="ts-author-name fz-16 fw-medium inherit-color" href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>"><?php echo esc_html( $testimonial_author_name ); ?></a>
                        </p>
                        <span class="ts-author-job mb-0 fw-medium p-color ls-005"><?php echo esc_html( $testimonial_author_job ); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
