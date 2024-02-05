<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post-nav.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$single_post_navigation = floral_get_option( 'blog-single-post-navigation', '', '' );
if ( empty( $single_post_navigation ) ) {
    return;
}

$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );
if ( !$next && !$previous ) {
    return;
}


?>
<nav class="floral-post-navigation" role="navigation">
    <div class="nav-links">
        <?php
        previous_post_link( '<div class="nav-prev">%link</div>', _x( '<i class="fa fa-chevron-left"></i> <div class="post-link-inner"><div class="post-link-label">Previous Post</div> <div class="post-link-title">%title</div></div> ', 'Previous post link', 'floral' ) );
        next_post_link( '<div class="nav-next">%link</div>', _x( '<div class="post-link-inner"><div class="post-link-label">Next Post</div> <div class="post-link-title">%title</div></div><i class="fa fa-chevron-right"></i>', 'Next post link', 'floral' ) );
        ?>
    </div>
</nav>