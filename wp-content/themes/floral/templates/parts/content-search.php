<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-search.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Template part for displaying results in search pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package 9WPThemes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content-wrapper">
        <h3 class="entry-title">
            <span class="entry-post-type">
                <?php
                $post_type = get_post_type();
                printf( '%s:', ucwords( str_replace( array( '-', '_' ), ' ', $post_type ) ) );
                ?>
            </span>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h3>


        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
</article><!-- #post-## -->
