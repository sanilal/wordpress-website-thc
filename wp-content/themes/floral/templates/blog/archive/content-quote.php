<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-quote.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$quote_content    = floral_get_meta_option( 'post-quote-content', '', '' );
$quote_author     = floral_get_meta_option( 'post-quote-author-name', '', '' );
$quote_author_url = floral_get_meta_option( 'post-quote-author-url', '', '' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-quote-wrapper">
        <div class="quote-icon-wrapper">
            <i class="fa fa-quote-left"></i>
        </div>
        <div class="entry-quote">
            <?php if ( empty( $quote_content ) || empty( $quote_author ) || empty( $quote_author_url ) ) : ?>
                <p><?php echo mb_strimwidth( get_the_content(), 0, 100, '...' ); ?></p>
                <?php edit_post_link( esc_html__( 'Edit', 'floral' ), '<span class="pull-right fz-14">', '</span>' ); ?>
            <?php else : ?>
                <p><?php echo esc_html( $quote_content ); ?></p>
                <?php edit_post_link( esc_html__( 'Edit', 'floral' ), '<span class="pull-right fz-14 ml-10">', '</span>' ); ?>
                <cite>
                    <a href="<?php echo esc_url( $quote_author_url ) ?>" title="<?php echo esc_attr( $quote_author_url ); ?>"><?php echo esc_html( $quote_author ); ?></a>
                </cite>
            <?php endif; ?>
        </div>
    </div>
</article>