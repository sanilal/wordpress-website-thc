<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-blog.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Blog extends Floral_Base {
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function add_filters() {
        add_filter( 'the_password_form', array( __CLASS__, 'password_form' ) );
        add_filter( 'excerpt_length', array( __CLASS__, 'excerpt_length' ) );
        add_filter( 'excerpt_more', array( __CLASS__, 'excerpt_more' ) );
    }
    
    static function print_comment_form() {
        $commenter         = wp_get_current_commenter();
        $req               = get_option( 'require_name_email' );
        $aria_req          = ( $req ? " aria-required='true'" : '' );
        $html5             = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
        $fields            = array(
            'author' => '<div class="form-group col-md-6">' .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Name', 'floral' ) . '" ' . $aria_req . '>' .
                '</div>',
            'email'  => '<div class="form-group col-md-6">' .
                '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'floral' ) . '" ' . $aria_req . '>' .
                '</div>'
        );
        $comment_form_args = array(
            'fields'               => $fields,
            'comment_field'        => '<div class="form-group col-md-12">' .
                '<textarea rows="6" id="comment" name="comment" placeholder="' . esc_html__( 'Comment', 'floral' ) . '" ' . $aria_req . '></textarea>' .
                '</div>',
            'comment_notes_before' => '<p class="comment-notes">' .
                esc_html__( 'Your email address will not be published.', 'floral' ) /* . ( $req ? $required_text : '' ) */ .
                '</p>',
            'comment_notes_after'  => '',
            'id_submit'            => 'btnComment',
            'class_submit'         => 'button-submit alt floral-btn btn-style-solid fw-semibold ls-01 text-uppercase btn-size-md icon-effect-inner-out-text hover-effect-default light-color p-bgc none-hover-color s-hover-bgc align-icon-right',
            'title_reply'          => esc_html__( 'Leave a Comment', 'floral' ),
            'title_reply_to'       => esc_html__( 'Leave a Comment to %s', 'floral' ),
            'cancel_reply_link'    => esc_html__( 'Cancel reply', 'floral' ),
            'label_submit'         => esc_html__( 'Post Comment', 'floral' )
        );
        
        comment_form( $comment_form_args );
    }
    
    static function render_comments( $comment, $args, $depth ) {
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
                <div class="comment-avatar">
                    <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
                <div class="comment-content entry-content">
                    <div class="comment-author">
                        <h4 class="comment-author-name"><?php comment_author_link() ?></h4>
                        <div class="comment-meta">
                            <span class="comment-meta-date">
                                <?php echo sprintf( '%s at %s', get_comment_date( 'M j, Y' ), get_comment_time( 'g:i a' ) ); ?>
                            </span>
                            <?php edit_comment_link( esc_html__( 'Edit', 'floral' ), ' ', '' ) ?>
                        </div>
                        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
                    </div>
                    <div class="comment-text">
                        <?php comment_text() ?>
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'floral' ); ?></em>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }
    
    static function paging_navigation() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
        
        $big   = 999999999;
        $links = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var( 'paged' ) ),
            'total'     => $wp_query->max_num_pages,
            'prev_next' => true,
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list',
        ) );
        
        if ( !empty( $links ) ) :
            ?>
            <div class="floral-pagination">
                <?php echo wp_kses_post( $links ); ?>
            </div>
            <?php
        endif;
    }
    
    static function paging_load_more() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
        $link = get_next_posts_page_link( $wp_query->max_num_pages );
        if ( !empty( $link ) ) :
            ?>
            <div class="floral-load-more text-center">
                <button data-next-page="<?php echo esc_url( $link ); ?>" data-loading-text="<i class='fa fa-spinner fa-spin'></i> <?php esc_html_e( 'Loading...', 'floral' ); ?>" type="button" class="blog-load-more floral-btn s-font btn-style-solid btn-shape-rounded-2 btn-size-md icon-effect-none hover-effect-default light-color p-bgc p-hover-bgc-bolder">
                    <?php esc_html_e( 'Load More', 'floral' ); ?>
                </button>
            </div>
            <?php
        endif;
    }
    
    
    static function paging_infinite_scroll() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
        
        $link = get_next_posts_page_link( $wp_query->max_num_pages );
        if ( !empty( $link ) ) :
            ?>
            <div class="floral-infinite-scroll text-center">
                <a href="#" class="infinite-scroll-link hide" data-next-page="<?php echo esc_url( $link ); ?>">Infinite</a>
                <div class="loading-three-bounce">
                    <div class="loading-child loading-bounce1"></div>
                    <div class="loading-child loading-bounce2"></div>
                    <div class="loading-child loading-bounce3"></div>
                </div>
            </div>
            <?php
        endif;
    }
    
    static function the_post_navigation( $archive_paging_type, $args = array() ) {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }
	    
        $archive_paging_type_class = array('navigation-type-' . $archive_paging_type );
	    if ($archive_paging_type === 'default') {
        	$archive_paging_type_class[] = 'navigation-' . ( !empty($args['style']) ? $args['style'] : 'style-2' );
		    $archive_paging_type_class[] = 'navigation-align-' . ( !empty($args['align']) ? $args['align'] : 'center' );
		}
		
        ?>
        <div class="<?php floral_the_clean_html_classes( $archive_paging_type_class ); ?>">
            <?php
            switch ( $archive_paging_type ) :
                case 'load-more':
                    Floral_Blog::paging_load_more();
                    break;
                case 'infinite-scroll':
                    Floral_Blog::paging_infinite_scroll();
                    break;
                default:
                    Floral_Blog::paging_navigation();
                    break;
            endswitch;
            ?>
        </div>
        <?php
    }
    
    //Render Image For Post
    public static function post_image( $image_id, $image_args = array(), $action = 'link', $gallery_id = '' ) {
        $html = Floral_Image::get_image( $image_id, $image_args['size'],array( 'ratio' => $image_args['ratio']));
        if ( $action === 'link' ) {
            $args = array( 'title' => get_the_title() );
            $html = Floral_Wrap::link( $html, get_permalink(), $args );
        }
        $rel = !empty( $gallery_id ) ? sprintf( 'floral-owl-prettyPhoto[%s]', $gallery_id ) : 'floral-prettyPhoto';
        
        if ( !empty( $html ) ) {
            $href          = wp_get_attachment_image_src( $image_id, 'floral_1170' );
            $popup_classes = array( 'floral-blog-link-popup' );
            $html          = sprintf( '<div class="floral-blog-post-image">%s<a class="%s" href="%s" data-rel="%s"><i class="w9 w9-ico-resize-full floral-blog-icon"></i></a></div>', $html, floral_clean_html_classes( $popup_classes ), $href[0], $rel );
        }
        
        return $html;
    }
    
    // Render post feature image
    static function post_feature_image( $image_size = 'floral_1170', $image_ratio= 'original', $action = 'link' ) {
        $thumbnail_id = get_post_thumbnail_id();
        if ( $thumbnail_id ) {
	        $image_args['size'] = $image_size;
	        $image_args['ratio'] = $image_ratio;
            return self::post_image( $thumbnail_id, $image_args, $action );
        } else {
            return '';
        }
    }
    
    // Render post feature of image format
    static function post_feature_format_image( $image_size = 'floral_1170', $image_ratio= 'original', $action = 'link' ) {
        $meta_image = get_post_meta( get_the_ID(), 'meta-post-image-url', true );
        if ( isset( $meta_image['id'] ) ) {
	        $image_args['size'] = $image_size;
	        $image_args['ratio'] = $image_ratio;
            return self::post_image( $meta_image['id'], $image_args, $action );
        } else {
            return '';
        }
    }
    
    // Render post feature gallery
    static function post_feature_format_gallery( $image_size = 'floral_1170', $image_ratio= 'original', $action = 'link' ) {
        $gallery = get_post_meta( get_the_ID(), 'meta-post-gallery', true );
        
        $gallery_count = count( (array) $gallery );
        $html          = '';
		$image_args['size'] = $image_size;
		$image_args['ratio'] = $image_ratio;
        if ( $gallery_count > 1 ) {
            $gallery_content = '';
            $gallery_id      = uniqid( 'post-gallery-' );
            foreach ( $gallery as $slide ) {
                $gallery_content .= self::post_image( $slide['attachment_id'], $image_args, $action, $gallery_id );
            }
            
            $html = Floral_Wrap::slider( $gallery_content, array( 'nav' => true ), array( 'post-gallery', 'gallery-popup', 'owl-control-default' ), true );
        } elseif ( $gallery_count == 1 && isset( $gallery[0]['attachment_id'] ) ) {
            $html = self::post_image( $gallery[0]['attachment_id'], $image_args, $action );
        }
        
        return $html;
    }
    
    // Render post feature video
    static function post_feature_format_video() {
        $embed     = '';
        $video_url = get_post_meta( get_the_ID(), 'meta-post-video-url', true );
        if ( !empty( $video_url ) && filter_var( $video_url, FILTER_VALIDATE_URL ) ) {
            $args  = array( 'wmode' => 'transparent' );
            $embed = wp_oembed_get( $video_url, $args );
        } else {
            $embed = get_post_meta( get_the_ID(), 'meta-post-video-html', true );
        }
        if ( !empty( $embed ) ) {
            return sprintf( '<div class="entry-video video-frame-wrapper embed-responsive embed-responsive-16by9">%s</div>', $embed );
        }
    }
    
    // Render post feature audio
    static function post_feature_format_audio() {
        $embed      = '';
        $autdio_url = get_post_meta( get_the_ID(), 'meta-post-audio-url', true );
        if ( !empty( $autdio_url ) && filter_var( $autdio_url, FILTER_VALIDATE_URL ) ) {
            $args  = array( 'wmode' => 'transparent' );
            $embed = wp_oembed_get( $autdio_url, $args );
        } else {
            $embed = get_post_meta( get_the_ID(), 'meta-post-autdio-html', true );
        }
        if ( empty( $embed ) ) {
            return '';
        } else {
            return sprintf( '<div class="entry-audio audio-frame-wrapper">%s</div>', $embed );
        }
    }
    
    // Render post feature quote
    static function post_feature_format_quote() {
        $quote_content    = get_post_meta( get_the_ID(), 'meta-post-quote-content', true );
        $quote_author     = get_post_meta( get_the_ID(), 'meta-post-quote-author-name', true );
        $quote_author_url = get_post_meta( get_the_ID(), 'meta-post-quote-author-url', true );
        if ( empty( $quote_content ) ) {
            return '';
        }
        ob_start();
        ?>
        <div class="entry-quote-wrapper">
            <div class="quote-icon-wrapper">
                <i class="fa fa-quote-left"></i>
            </div>
            <div class="entry-quote">
                <?php if ( empty( $quote_content ) || empty( $quote_author ) || empty( $quote_author_url ) ) : ?>
                    <p><?php echo mb_strimwidth( get_the_content(), 0, 100, '...' ); ?></p>
                <?php else : ?>
                    <p><?php echo esc_html( $quote_content ); ?></p>
                    <cite>
                        <a href="<?php echo esc_url( $quote_author_url ) ?>" title="<?php echo esc_attr( $quote_author_url ); ?>"><?php echo esc_html( $quote_author ); ?></a>
                    </cite>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    // Render post feature link
    static function post_feature_format_link() {
        $link_text = get_post_meta( get_the_ID(), 'meta-post-link-text', true );
        $link_url  = get_post_meta( get_the_ID(), 'meta-post-link-url', true );
        
        if ( empty( $link_text ) ) {
            return '';
        }
        ob_start();
        ?>
        <div class="entry-link-wrapper">
            <div class="link-icon-wrapper">
                <i class="fa fa-link"></i>
            </div>
            <h3 class="entry-link">
                <?php if ( empty( $link_url ) || empty( $link_text ) ) : ?>
                    <?php echo mb_strimwidth( get_the_content(), 0, 100, '...' ); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" rel="bookmark">
                        <?php echo esc_html( $link_text ); ?>
                    </a>
                <?php endif; ?>
            </h3>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Get post feature auto
     *
     * @param $args
     *
     * @return bool|string
     */
    static function post_feature_format_auto( $args = array() ) {
        $default = array(
            'image_size'              => 'floral_1170',
            'image_ratio'              => 'original',
            'action'                  => 'none',
            'feature_image_permalink' => true
        );
        $args    = wp_parse_args( $args, $default );
        
        $post_format = get_post_format();
        $html        = '';
        if ( $post_format === 'image' ) {
            $html = self::post_feature_format_image( $args['image_size'],$args['image_ratio'], $args['action'] );
        } elseif ( $post_format === 'gallery' ) {
            $html = self::post_feature_format_gallery( $args['image_size'],$args['image_ratio'], $args['action'] );
        } elseif ( $post_format === 'video' ) {
            $html = self::post_feature_format_video();
        } elseif ( $post_format === 'audio' ) {
            $html = self::post_feature_format_audio();
        } elseif ( $post_format === 'link' ) {
            $html = self::post_feature_format_link();
        } elseif ( $post_format === 'quote' ) {
            $html = self::post_feature_format_quote();
        }
        
        if ( !empty( $html ) ) {
            return $html;
        }
        
        return self::post_feature_image( $args['image_size'],$args['image_ratio'], $args['action'] );
    }
    
    static function password_form() {
        global $post;
        $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
        $o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="fw-semibold mb-20">' . esc_html__( "To view this protected post, enter the password below:" , 'floral') . '</p>
    <input class="mb-25" name="post_password" id="' . $label . '" placeholder="'. esc_html__('Password', 'floral') .'" type="password" size="20" maxlength="20" /><input class="floral-btn light-color fw-medium text-uppercase p-font btn-style-solid btn-shape-square btn-size-sm p-bgc gray2-hover-bgc " type="submit" name="Submit" value="' . esc_attr__( "Submit", 'floral' ) . '" />
    </form>
    ';
        
        return $o;
    }
    
    static function excerpt_length( $length ) {
        $excerpt_length = floral_get_option( 'blog-archive-excerpt-length' );
        $excerpt_length = intval( $excerpt_length );
        if ( empty( $excerpt_length ) ) {
            $excerpt_length = 50;
        }
        
        return $excerpt_length;
    }
    
    static function excerpt_more( $more ) {
        return '...';
    }
    
    public static function get_link_pages() {
        wp_link_pages( array(
            'before'      => '<div class="floral-link-pages"><span class="floral-link-page-title default-fz">' . esc_html__( 'Pages:', 'floral' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span class="floral-page-link">',
            'link_after'  => '</span>',
        ) );
    }
    
    public static function calculate_feature_imagesize_by_layout( $layout, $sidebar ) {
        switch ( $layout ) {
            case 'container' :
                switch ( $sidebar ) {
                    case 'none':
                        return 'floral_1170';
                        break;
                    case 'right':
                    case 'left':
                        return 'floral_870';
                        break;
                    case 'both':
                        return 'floral_570';
                        break;
                }
                break;
            case 'container-xlg' :
                switch ( $sidebar ) {
                    case 'none':
                        return 'floral_1570';
                        break;
                    case 'right':
                    case 'left':
                        return 'floral_1170';
                        break;
                    case 'both':
                        return 'floral_770';
                        break;
                }
                break;
            
            case 'container-fluid' :
            case 'fullwidth':
            default:
                switch ( $sidebar ) {
                    case 'none':
                        return 'full';
                        break;
                    case 'right':
                    case 'left':
                        return 'floral_1570';
                        break;
                    case 'both':
                        return 'floral_1170';
                        break;
                }
        }
    }
    
    
    /**
     * @return bool
     * @deprecated
     */
    static function has_post_thumbnail() {
        switch ( get_post_format() ) {
            case 'gallery':
                $gallery       = floral_get_meta_option( 'post-gallery', '', '', array() );
                $gallery_count = count( $gallery );
                
                if ( $gallery_count == 0 && !has_post_thumbnail() ) {
                    return false;
                }
                break;
            case 'video':
                $video_url      = floral_get_meta_option( 'post-video-url' );
                $video_embedded = floral_get_meta_option( 'post-video-html' );
                if ( ( empty( $video_url ) || !filter_var( $video_url, FILTER_VALIDATE_URL ) ) && empty( $video_embedded ) ) {
                    return false;
                }
                break;
            case 'audio':
                $audio_url      = floral_get_meta_option( 'post-audio-url' );
                $audio_embedded = floral_get_meta_option( 'post-audio-html' );
                if ( ( empty( $audio_url ) || !filter_var( $audio_url, FILTER_VALIDATE_URL ) ) && empty( $audio_embedded ) ) {
                    return false;
                }
                break;
            case 'quote':
                $quote = floral_get_meta_option( 'post-quote-content' );
                if ( empty( $quote ) ) {
                    return false;
                }
                break;
            default:
                $meta_image = floral_get_meta_option( 'post-image-url' );
                if ( ( !isset( $meta_image ) || empty( $meta_image['id'] ) ) && !has_post_thumbnail() ) {
                    return false;
                }
                break;
        }
        
        return true;
    }
    
    /**
     * Get post thumbnail of page
     *
     * @param $size
     *
     * @return string
     * @deprecated
     */
    static function post_thumbnail( $size ) {
        $html                     = '';
        $blog_archive_light_box   = floral_get_option( 'blog-archive-light-box', '', 'light-box-none' );
        $light_box_style          = false;
        if ( $blog_archive_light_box !== 'light-box-none' ) {
            $light_box_style = $blog_archive_light_box;
        }
        switch ( get_post_format() ) {
            case 'gallery':
                $gallery = floral_get_meta_option( 'post-gallery' );
                if ( empty( $gallery ) ) {
                    $html .= self::get_single_post_thumbnail_html( get_post_thumbnail_id(), $size, get_the_title(), $light_box_style );
                } else {
                    $gallery_count = count( (array) $gallery );
                    switch ( $gallery_count ) {
                        case 1:
                            $html .= self::get_single_post_thumbnail_html( $gallery[0]['attachment_id'], $size, $gallery[0]['title'], true );
                            break;
                        default:
                            $gallery_content = '';
                            $gallery_id      = uniqid( 'post-gallery-' );
                            foreach ( $gallery as $slide ) {
                                $gallery_content .= Floral_Wrap::prettyphoto_image( $slide['attachment_id'], $size, array( 'gallery' => $gallery_id ) );
                            }
                            $html .= Floral_Wrap::slider( $gallery_content, array( 'nav' => true ), array( 'post-gallery', 'gallery-popup', 'owl-control-default' ), true );
                            break;
                    }
                }
                break;
            
            case 'video':
                $html .= '<div class="video-frame-wrapper embed-responsive embed-responsive-16by9 embed-responsive-' . $size . '">';
                $video_url = floral_get_meta_option( 'post-video-url' );
                if ( !empty( $video_url ) && filter_var( $video_url, FILTER_VALIDATE_URL ) ) {
                    $args = array(
                        'wmode' => 'transparent'
                    );
                    $html .= wp_oembed_get( $video_url, $args );
                } else {
                    $video_embedded = floral_get_meta_option( 'post-video-html', '', '', '' );
                    $html .= $video_embedded;
                }
                $html .= '</div>';
                break;
            
            case 'audio':
                $html .= '<div class="audio-frame-wrapper">';
                $audio_url = floral_get_meta_option( 'post-audio-url' );
                if ( !empty( $audio_url ) && filter_var( $audio_url, FILTER_VALIDATE_URL ) ) {
                    $args = array(
                        'wmode' => 'transparent'
                    );
                    $html .= wp_oembed_get( $audio_url, $args );
                } else {
                    $audio_embedded = floral_get_meta_option( 'post-audio-html', '', '', '' );
                    $html .= $audio_embedded;
                }
                $html .= '</div>';
                break;
            
            case 'quote':
                $quote_content = floral_get_meta_option( 'post-quote-content' );
                $quote_author     = floral_get_meta_option( 'post-quote-author-name' );
                $quote_author_url = floral_get_meta_option( 'post-quote-author-url' );
                ob_start();
                ?>
                <div class="entry-quote-wrapper">
                    <div class="quote-icon-wrapper">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <div class="entry-quote">
                        <?php if ( empty( $quote_content ) || empty( $quote_author ) || empty( $quote_author_url ) ) : ?>
                            <p><?php echo mb_strimwidth( get_the_content(), 0, 100, '...' ); ?></p>
                        <?php else : ?>
                            <p><?php echo esc_html( $quote_content ); ?></p>
                            <cite>
                                <a href="<?php echo esc_url( $quote_author_url ) ?>" title="<?php echo esc_attr( $quote_author_url ); ?>"><?php echo esc_html( $quote_author ); ?></a>
                            </cite>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                $html .= ob_get_clean();
                break;
            
            case 'link':
                $link_text = floral_get_meta_option( 'post-link-text', '', '' );
                $link_url         = floral_get_meta_option( 'post-link-url', '', '' );
                ob_start();
                ?>
                <div class="entry-link-wrapper">
                    <div class="link-icon-wrapper">
                        <i class="fa fa-link"></i>
                    </div>
                    <h3 class="entry-link">
                        <?php if ( empty( $link_url ) || empty( $link_text ) ) : ?>
                            <?php echo mb_strimwidth( get_the_content(), 0, 100, '...' ); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" rel="bookmark">
                                <?php echo esc_html( $link_text ); ?>
                            </a>
                        <?php endif; ?>
                    </h3>
                </div>
                <?php
                $html = ob_get_clean();
                break;
            
            default:
                $meta_image = floral_get_meta_option( 'post-image-url' );
                if ( isset( $meta_image ) && !empty( $meta_image['id'] ) ) {
                    $html .= self::get_single_post_thumbnail_html( $meta_image['id'], $size, get_the_title(), $light_box_style );
                } else {
                    $html .= self::get_single_post_thumbnail_html( get_post_thumbnail_id(), $size, get_the_title(), $light_box_style );
                }
                break;
        }
        
        return $html;
    }
    
    static function get_single_post_thumbnail_html( $attachment_id, $size, $title, $lightbox_style = false, $in_gallary = false ) {
        return Floral_Wrap::prettyphoto_image( $attachment_id, $size );
//        $html = '';
//        if ( !empty( $attachment_id ) ) {
//            if ( empty( $size ) ) {
//                $size = 'floral_1170';
//            }
//
//            $html = Floral_Image::get_image( $attachment_id, $size, array( 'title' => $title ) );
//
//            if ( !empty( $html ) ) {
//                $popup_class = 'single-item-popup';
//                if ( $in_gallary ) {
//                    $popup_class = 'gallery-item-popup';
//                }
//                if ( !is_single() ) {
//                    if ( $lightbox_style ) {
//                        $full_size_img_url = wp_get_attachment_image_src( $attachment_id, 'floral_1170' )[0];
//                        $html .= sprintf(
//                            '<div class="entry-thumbnail-overlay text-center %3$s"><div class="cell-vertical-wrapper"><div class="cell-middle">
//                        <a href="%1$s" class="entry-thumbnail-link"><i class="fa fa-link"></i></a>
//                        <a href="%2$s" class="entry-thumbnail-popup %4$s"><i class="fa fa-expand"></i></a>
//                    </div></div></div>',
//                            get_the_permalink(), $full_size_img_url, floral_clean_html_classes( $lightbox_style ), floral_clean_html_classes( $popup_class ) );
//                    } else {
//                        $html = sprintf( '<a href="%1$s" title="%2$s" class="entry-thumbnail-overlay"> %3$s </a>',
//                            get_the_permalink(), get_the_title(), $html );
//                    }
//                }
//            }
//        }
//
//        return !empty( $html ) ? sprintf( '<div class="entry-thumbnail">%s</div>', $html ) : $html;
    }
    
}
        