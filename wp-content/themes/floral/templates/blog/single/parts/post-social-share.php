<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post-social-share.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$enable_facebook  = floral_get_option( 'social-sharing', 'facebook', '' );
$enable_twitter   = floral_get_option( 'social-sharing', 'twitter', '' );
$enable_google    = floral_get_option( 'social-sharing', 'google', '' );
$enable_linkedin  = floral_get_option( 'social-sharing', 'linkedin', '' );
$enable_tumblr    = floral_get_option( 'social-sharing', 'tumblr', '' );
$enable_pinterest = floral_get_option( 'social-sharing', 'pinterest', '' );


if ( empty( $enable_facebook ) &&
    empty( $enable_twitter ) &&
    empty( $enable_google ) &&
    empty( $enable_linkedin ) &&
    empty( $enable_tumblr ) &&
    empty( $enable_pinterest )
) {
    return;
}
$link_class = 'text-uppercase text-center fw-medium light-color dark-bgc';
?>

<div class="floral-social-share-wrapper clearfix">
    <ul class="social-share list-unstyled no-mb">
        <?php if ( $enable_twitter == 1 ) : ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr( urlencode( get_the_title() ) ); ?> <?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                    <i class="w9 w9-ico-twitter-1"></i> Twitter
                </a>
            </li>
        <?php endif; ?>

        <?php if ( $enable_facebook == 1 ) : ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript:;">
                    <i class="w9 w9-ico-facebook-1"></i> Facebook
                </a>
            </li>
        <?php endif; ?>

        <?php if ( $enable_google == 1 ) : ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
                    <i class="w9 w9-ico-gplus"></i> Google
                </a>
            </li>
        <?php endif; ?>

        <?php if ( $enable_linkedin == 1 ): ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;title=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                    <i class="w9 w9-ico-linkedin-1"></i> Linkedin
                </a>
            </li>
        <?php endif; ?>

        <?php if ( $enable_tumblr == 1 ) : ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;name=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>&amp;description=<?php echo esc_attr( urlencode( get_the_excerpt() ) ); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                    <i class="w9 w9-ico-tumblr-1"></i> Tumblr
                </a>
            </li>
        <?php endif; ?>

        <?php if ( $enable_pinterest == 1 ) : ?>
            <li class="">
                <a class="<?php echo esc_attr($link_class)?>" onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>&amp;description=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                echo has_post_thumbnail() ? esc_attr( $arrImages[0] ) : ""; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                    <i class="w9 w9-ico-pinterest"></i> Pinterest
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>
