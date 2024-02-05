<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: single-content-template.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

get_header();
?>
    <style>
        .single-content-template #page.site > header,.single-content-template #page.site > footer,.single-content-template #page.site > section, .floral-before-main-header, .floral-after-main-header{
            display:none;
        }
    </style>
    
    <main id="site-main-single" class="__site-main-single content-template-single container-fluid">
        <?php
        while ( have_posts() ) : the_post();
            the_content();
        endwhile; // End of the loop.
        ?>
    </main>

<?php
get_footer();