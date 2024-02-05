<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post-author-info.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$single_post_author = floral_get_option( 'blog-single-author-info', '', '' );
if ( empty( $single_post_author ) ) {
    return;
}

$description = get_the_author_meta( 'description' );
if ( empty( $description ) ) {
    return;
}

?>

<div class="floral-post-author-info-wrapper">
    <div class="post-author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
    </div>
    <div class="post-author-info">
        <h3 class="written-by"><?php printf( esc_attr__( 'Written by %s', 'floral' ), get_the_author_posts_link() ); ?></h3>
        <p class="author-description no-mb"><?php echo esc_html( $description ) ?></p>
    </div>
</div>
