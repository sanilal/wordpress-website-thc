<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-link.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$link_text = floral_get_meta_option( 'post-link-text', '', '' );
$link_url  = floral_get_meta_option( 'post-link-url', '', '' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-link-wrapper">
        <div class="link-icon-wrapper">
            <i class="fa fa-link"></i>
        </div>
        <h3 class="entry-link">
            <?php if ( empty( $link_url ) || empty( $link_text ) ) : ?>
                <?php echo mb_strimwidth(get_the_content(), 0, 100, '...'); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( $link_url ); ?>" rel="bookmark" target="_blank">
                    <?php echo esc_html( $link_text ); ?>
                </a>
            <?php endif; ?>
        </h3>
        <div class="entry-meta-wrapper">
            <?php floral_get_template_part( 'blog/archive/parts/post', 'meta' ); ?>
        </div><!-- .entry-meta -->
    </div>
</article>

