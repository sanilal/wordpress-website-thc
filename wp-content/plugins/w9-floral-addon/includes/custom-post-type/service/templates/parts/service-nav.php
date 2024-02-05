<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: service-nav.php
 * @time    : 8/26/16 12:39 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );
if ( !$next && !$previous ) {
    return;
}

?>
<nav class="floral-post-navigation mt-0-i row" role="navigation">
    <div class="nav-links container">
        <?php
        previous_post_link( '<div class="nav-prev">%link</div>', _x( '<i class="fa fa-chevron-left"></i> <div class="post-link-inner"><div class="post-link-label">Previous Portfolio</div> <div class="post-link-title">%title</div></div> ', 'Previous service link', 'w9-floral-addon' ) );
        next_post_link( '<div class="nav-next">%link</div>', _x( '<div class="post-link-inner"><div class="post-link-label">Next Portfolio</div> <div class="post-link-title">%title</div></div><i class="fa fa-chevron-right"></i>', 'Next service link', 'w9-floral-addon' ) );
        ?>
    </div>
</nav>