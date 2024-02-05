<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post-tags.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$blog_single_post_meta = floral_get_option( 'blog-single-post-meta' );
$enable_tags           = '0';
if ( is_array( $blog_single_post_meta ) && !empty( $blog_single_post_meta ) ) {
    $enable_tags = $blog_single_post_meta['tags'];
}
?>

<?php if ( !empty( $enable_tags ) ): ?>
    <div class="entry-meta-tags-wrapper">
        <?php if ( has_tag() ):
            the_tags( '<div class="entry-meta-tags"><span><i class="fa fa-tags p-color"></i>' . esc_html__( 'Tags:', 'floral' ) . '</span>', ', ', '</div>' ); ?>
<!--        --><?php //else: ?>
<!--            <div class="entry-meta-tags">-->
<!--                <span><i class="fa fa-tags p-color"></i>--><?php //echo esc_html__( 'Tags: No tag.', 'floral' ) ?><!--</span>-->
<!--            </div>-->
        <?php endif; ?>
    </div>
<?php endif; ?>
