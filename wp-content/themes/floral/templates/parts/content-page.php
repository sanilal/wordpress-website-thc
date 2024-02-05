<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-page.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Template part for displaying page content in page.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package 9WPThemes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'floral' ),
            'after'  => '</div>',
        ) );
        ?>
    </div>
    <!-- entry-content -->
</article><!-- #post-## -->
