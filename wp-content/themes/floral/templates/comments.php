<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: comments.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}

?>
<?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="entry-comments" id="comments">
        <h3 class="comments-title">
<!--            --><?php //comments_number( esc_html__( 'No Response', 'floral' ), esc_html__( 'One Response', 'floral' ), esc_html__( '% Responses', 'floral' ) ); ?>
			<?php echo esc_html__( 'Comments:', 'floral' )?>
        </h3>
        <?php if ( have_comments() ) : ?>
            <div class="entry-comments-list">
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                    <nav class="comment-navigation text-right" role="navigation">
                        <?php $paginate_comments_args = array(
                            'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                            'next_text' => '<i class="fa fa-angle-double-right"></i>'
                        );
                        paginate_comments_links( $paginate_comments_args );
                        ?>
                    </nav>
                    <div class="clearfix"></div>
                <?php endif; ?>
                <ol class="commentlist clearfix">
                    <?php wp_list_comments( array(
                        'style'       => 'li',
                        'callback'    => array( 'Floral_Blog' , 'render_comments' ),
                        'avatar_size' => 100,
                        'short_ping'  => true,
                    ) ); ?>
                </ol>
                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                    <nav class="comment-navigation comment-navigation-bottom text-right" role="navigation">
                        <?php paginate_comments_links( $paginate_comments_args ); ?>
                    </nav>
                    <div class="clearfix"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ( comments_open() ) : ?>
            <div class="entry-comments-form clearfix">
                <?php Floral_Blog::print_comment_form(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
