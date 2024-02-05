<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: content-archive.php
 * @time    : 8/26/16 12:39 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * @var $portfolio_post_class
 * @var $portfolio_thumbnail_ratio
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( floral_clean_html_classes( $portfolio_post_class ) ); ?>>
    <div class="entry-header">
        <div class="entry-thumbnail">
            <?php
            $thumbnail_id   = get_post_thumbnail_id();
            $thumbnail_args = array();
            if(isset($portfolio_thumbnail_ratio)){
                $thumbnail_args['ratio'] = $portfolio_thumbnail_ratio;
            }
            
            $post_thumbnail = Floral_Image::get_image( $thumbnail_id, 'floral_1170', $thumbnail_args );
            if ( empty( $post_thumbnail ) ) {
                $post_thumbnail = Floral_Image::get_placeholder_image( '1170x' . ( isset( $portfolio_thumbnail_ratio ) && ( floatval( $portfolio_thumbnail_ratio ) !== 0 ) ? 1170 * $portfolio_thumbnail_ratio : 700 ) );
            }
            
            echo sprintf( '%s', $post_thumbnail );
            ?>
        </div>
    </div>
    <div class="entry-content floral-overlay text-center floral-animation-child">
        <div class="__content-inner cell-vertical-wrapper">
            <div class="cell-middle">
                <h3 class="entry-title">
                    <?php
                    $title = get_the_title();
                    $title = Floral_Wrap::link( $title, get_permalink(), array( 'title' => $title ) );
                    echo wp_kses_post( $title );
                    ?>
                </h3>
                <div class="__separator"></div>
                <div class="entry-portfolio-categories">
                    <?php
                    $categories = get_the_term_list( get_the_ID(), Floral_CPT_Portfolio::TAX_SLUG, '', ' / ' );
                    if ( !is_wp_error( $categories ) ) {
                        echo wp_kses_post( $categories );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>