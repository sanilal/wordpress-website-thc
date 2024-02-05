<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: style-simple.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

?>
<div class="testimonial-item text-center clearfix">
    <?php if ( $testimonial_show_author_avatar === 'yes' ) {
        $this->print_author_avatar( $testimonial_author_avatar );
    } ?>
    <?php if ( $testimonial_show_author_rating === 'yes' ): ?>
        <div class="ts-rating mb-5">
            <?php $this->print_rating_html( $testimonial_rate ); ?>
        </div>
    <?php endif; ?>
    <div class="ts-content-wrapper">
        <div class="ts-content-inner">
            <p class="ts-content mb-10 fz-28 t-font"><?php echo esc_html( $testimonial_content ); ?></p>
        </div>
    </div>
    <div class="ts-author-info text-center text-uppercase fz-16 s-font">
        <a class="ts-author-name fw-medium inherit-color" href="<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>"><?php echo esc_html( $testimonial_author_name ); ?></a>
        <span class="separator fw-medium pl-5 pr-5">-</span>
        <span class="ts-author-job fw-medium"><?php echo esc_html( $testimonial_author_job ); ?></span>
    </div>
</div>
