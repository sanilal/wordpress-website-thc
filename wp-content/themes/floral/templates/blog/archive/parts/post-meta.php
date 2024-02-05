<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post-meta.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$blog_archive_post_meta = floral_get_option( 'blog-archive-post-meta' );
$enable_date            = $enable_author = $enable_comments = $enable_categories = $enable_tags = '0';
if ( is_array( $blog_archive_post_meta ) && !empty( $blog_archive_post_meta ) ) {
    $enable_date       = $blog_archive_post_meta['date'];
    $enable_author     = $blog_archive_post_meta['author'];
    $enable_comments   = $blog_archive_post_meta['comments'];
    $enable_categories = $blog_archive_post_meta['categories'];
    $enable_tags       = $blog_archive_post_meta['tags'];
}
?>
<ul class="floral-entry-meta list-unstyled no-mb">
    <?php if ( !empty( $enable_date ) ): ?>
        <li class="entry-meta-date">
            <?php
                echo Floral_Wrap::link(get_the_date( get_option( 'date_format' ) ), get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) );
            ?>
        </li>
    <?php endif; ?>
    
    <?php if ( !empty( $enable_comments ) && ( comments_open() || get_comments_number() ) ) : ?>
        <li class="entry-meta-comment">
            <?php comments_popup_link(
                sprintf( '<span>%s</span>', esc_html__( 'No Comment', 'floral' ) ),
                sprintf( '<span>%s</span>', esc_html__( 'One Comment', 'floral' ) ),
                sprintf( '%s <span>%s</span>', get_comments_number(), esc_html__( 'Comments', 'floral' ) ) ); ?>
        </li>
    <?php endif; ?>

    <?php if ( !empty( $enable_author ) ): ?>
        <li class="entry-meta-author">
            <span><?php esc_html_e( 'By', 'floral' ); ?></span> <?php printf( '<a class="author vcard" href="%1$s">%2$s </a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) ); ?>
        </li>
    <?php endif; ?>
    
    <?php if ( !empty( $enable_categories ) && has_category() ): ?>
        <li class="entry-meta-category">
            <span><?php esc_html_e( 'In ', 'floral' ); ?></span> <?php echo get_the_category_list( ', ' ); ?>
        </li>
    <?php endif; ?>

    <?php if ( !empty( $enable_tags ) && has_tag() ): ?>
        <li class="entry-meta-tag">
            <span><?php esc_html_e( 'Tags ', 'floral' ); ?></span> <?php echo get_the_tag_list('', ', ' ); ?>
        </li>
    <?php endif; ?>
    
    <?php edit_post_link( esc_html__( 'Edit', 'floral' ), '<li class="entry-edit-link">', '</li>' ); ?>
</ul>