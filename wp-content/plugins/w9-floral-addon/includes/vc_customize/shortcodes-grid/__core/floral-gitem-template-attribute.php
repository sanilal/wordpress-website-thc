<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_gitem_template_attribute.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Custom VC
function floral_gitem_template_attribute_post_image_url($value, $data){
    $output = '';
    /**
     * @var null|Wp_Post $post ;
     */
    extract( array_merge( array(
        'post' => null,
        'data' => '',
    ), $data ) );
    if ( 'attachment' === $post->post_type ) {
        $src = wp_get_attachment_image_src( $post->ID, 'large' );
    } else {
        $attachment_id = get_post_thumbnail_id( $post->ID );
        $src = wp_get_attachment_image_src( $attachment_id, 'large' );
    }
    if ( empty( $src ) && ! empty( $data ) ) {
        $output = esc_attr( rawurldecode( $data ) );
    } elseif ( ! empty( $src ) ) {
        $output = $src[0];
    } elseif ( true ) {
        $output = Floral_Image::get_placeholder_image('', true);
    }
    
    return $output;
};

remove_filter( 'vc_gitem_template_attribute_post_image_url', 'vc_gitem_template_attribute_post_image_url', 10 );
add_filter( 'vc_gitem_template_attribute_post_image_url', 'floral_gitem_template_attribute_post_image_url', 11, 2 );

function floral_gitem_template_attribute_post_image_background_image_css( $value, $data ) {
    $output = '';
    /**
     * @var null|Wp_Post $post ;
     */
    extract( array_merge( array(
        'post' => null,
        'data' => '',
    ), $data ) );
    if ( 'attachment' === $post->post_type ) {
        $src = wp_get_attachment_image_src( $post->ID, 'large' );
    } else {
        $attachment_id = get_post_thumbnail_id( $post->ID );
        $src = wp_get_attachment_image_src( $attachment_id, 'large' );
    }
    if ( ! empty( $src ) ) {
        $output = 'background-image: url(' . $src[0] . ') !important;';
    } else {
        $output = 'background-image: url(' . Floral_Image::get_placeholder_image('', true). ') !important;';
    }

    return apply_filters( 'vc_gitem_template_attribute_post_image_background_image_css_value', $output );
}

remove_filter( 'vc_gitem_template_attribute_post_image_background_image_css', 'vc_gitem_template_attribute_post_image_background_image_css', 10 );
add_filter( 'vc_gitem_template_attribute_post_image_background_image_css', 'floral_gitem_template_attribute_post_image_background_image_css', 11, 2 );


/**
 * Get post excerpt. Used as wrapper for others post data attributes.
 *
 * @param $data
 *
 * @return mixed|string
 */
function floral_gitem_template_attribute_post_excerpt( $value, $data ) {
    /**
     * @var null|Wp_Post $post ;
     * @var string $data ;
     */
    extract( array_merge( array(
        'post' => null,
        'data' => '',
    ), $data ) );
    
    return get_the_excerpt($post->ID);
}
remove_filter( 'vc_gitem_template_attribute_post_excerpt', 'vc_gitem_template_attribute_post_excerpt', 10 );
add_filter( 'vc_gitem_template_attribute_post_excerpt', 'floral_gitem_template_attribute_post_excerpt', 11 , 2);

//class Floral_Grid_Item_Preview {
//    protected $shortcodes_string = '';
//    protected $post_id = false;
//
//    public function render() {
//        $this->post_id = (int) vc_request_param( 'post_id' );
//        $this->shortcodes_string = stripslashes( vc_request_param( 'shortcodes_string', true ) );
//        require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/class-vc-grid-item.php' );
//        $grid_item = new Vc_Grid_Item();
//        $grid_item->setIsEnd( false );
//        $grid_item->setGridAttributes( array( 'element_width' => 4 ) );
//        $grid_item->setTemplate( $this->shortcodes_string, $this->post_id );
//        $this->enqueue();
//        vc_include_template( 'params/vc_grid_item/preview.tpl.php', array(
//            'preview' => $this,
//            'grid_item' => $grid_item,
//            'shortcodes_string' => $this->shortcodes_string,
//            'post' => $this->mockingPost(),
//            'default_width_value' => apply_filters( 'vc_grid_item_preview_render_default_width_value', 4 ),
//        ) );
//    }
//
//    public function addCssBackgroundImage( $css ) {
//        if ( empty( $css ) ) {
//            $css = 'background-image: url(' . Floral_Image::get_placeholder_image('', true) . ') !important';
//        }
//
//        return $css;
//    }
//
//    public function addImageUrl( $url ) {
//        if ( empty( $url ) ) {
//            $url = Floral_Image::get_placeholder_image('', true);
//        }
//
//        return $url;
//    }
//
//    public function addImage( $img ) {
//        if ( empty( $img ) ) {
//            $img = '<img src="' . Floral_Image::get_placeholder_image('', true) . '" alt="">';
//        }
//
//        return $img;
//    }
//
//    /**
//     *
//     * @since 4.5
//     *
//     * @param $link
//     *
//     * @return string
//     */
//    public function disableContentLink( $link, $atts, $css_class ) {
//        return 'a' . ( strlen( $css_class ) > 0 ? ' class="' . esc_attr( $css_class ) . '"' : '' );
//    }
//
//    /**
//     *
//     * @since 4.5
//     *
//     * @param $link
//     *
//     * @return string
//     */
//    public function disableRealContentLink( $link, $atts, $post, $css_class ) {
//        return 'a' . ( strlen( $css_class ) > 0 ? ' class="' . esc_attr( $css_class ) . '"' : '' );
//    }
//
//    /**
//     * Used for filter: vc_gitem_zone_image_block_link
//     * @since 4.5
//     *
//     * @param $link
//     *
//     * @return string
//     */
//    public function disableGitemZoneLink( $link ) {
//        return '';
//    }
//
//    public function enqueue() {
//        visual_composer()->frontCss();
//        visual_composer()->frontJsRegister();
//        wp_enqueue_script( 'prettyphoto' );
//        wp_enqueue_style( 'prettyphoto' );
//        wp_enqueue_style( 'js_composer_front' );
//        wp_enqueue_script( 'wpb_composer_front_js' );
//        wp_enqueue_style( 'js_composer_custom_css' );
//
//        VcShortcodeAutoloader::getInstance()->includeClass( 'WPBakeryShortCode_VC_Basic_Grid' );
//
//        $grid = new WPBakeryShortCode_VC_Basic_Grid( array( 'base' => 'vc_basic_grid' ) );
//        $grid->shortcodeScripts();
//        $grid->enqueueScripts();
//    }
//
//    public function mockingPost() {
//        $post = get_post( $this->post_id );
//        setup_postdata( $post );
//        $post->post_title = __( 'Post title', 'js_composer' );
//        $post->post_content = __( 'The WordPress Excerpt is an optional summary or description of a post; in short, a post summary.', 'js_composer' );
//        $post->post_excerpt = __( 'The WordPress Excerpt is an optional summary or description of a post; in short, a post summary.', 'js_composer' );
//        add_filter( 'get_the_categories', array(
//            &$this,
//            'getTheCategories',
//        ), 10, 2 );
//        $GLOBALS['post'] = $post;
//
//        return $post;
//    }
//
//    public function getTheCategories( $categories, $post_id ) {
//        $ret = $categories;
//        if ( ! $post_id || ( $post_id && $post_id == $this->post_id ) ) {
//            $cat = get_categories( 'number=5' );
//            if ( empty( $ret ) && ! empty( $cat ) ) {
//                $ret += $cat;
//            }
//        }
//
//        return $ret;
//    }
//
//    public function addPlaceholderImage( $img ) {
//        if ( null === $img || false === $img ) {
//            $img = array(
//                'thumbnail' => '<img class="vc_img-placeholder vc_single_image-img" src="' . vc_asset_url( 'vc/vc_gitem_image.png' ) . '" />',
//            );
//        }
//
//        return $img;
//    }
//}
//
//
//function floral_grid_item_render_preview() {
//    vc_user_access()
//        ->checkAdminNonce()
//        ->validateDie()
//        ->wpAny( array(
//            'edit_post',
//            (int) vc_request_param( 'post_id' ),
//        ) )
//        ->validateDie()
//        ->part( 'grid_builder' )
//        ->can()
//        ->validateDie();
//
//    require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/class-vc-grid-item.php' );
//    $grid_item = new Vc_Grid_Item();
//    $grid_item->mapShortcodes();
//    require_once vc_path_dir( 'PARAMS_DIR', 'vc_grid_item/editor/class-vc-grid-item-preview.php' );
//    $vcGridPreview = new Floral_Grid_Item_Preview();
//    add_filter( 'vc_gitem_template_attribute_post_image_background_image_css_value', array(
//        $vcGridPreview,
//        'addCssBackgroundImage',
//    ) );
//    add_filter( 'vc_gitem_template_attribute_post_image_url_value', array(
//        $vcGridPreview,
//        'addImageUrl',
//    ) );
//    add_filter( 'vc_gitem_template_attribute_post_image_html', array(
//        $vcGridPreview,
//        'addImage',
//    ) );
//    add_filter( 'vc_gitem_attribute_featured_image_img', array(
//        $vcGridPreview,
//        'addPlaceholderImage',
//    ) );
//    add_filter( 'vc_gitem_post_data_get_link_real_link', array(
//        $vcGridPreview,
//        'disableRealContentLink',
//    ), 10, 4 );
//    add_filter( 'vc_gitem_post_data_get_link_link', array(
//        $vcGridPreview,
//        'disableContentLink',
//    ), 10, 3 );
//    add_filter( 'vc_gitem_zone_image_block_link', array(
//        $vcGridPreview,
//        'disableGitemZoneLink',
//    ) );
//    $vcGridPreview->render();
//    die();
//}
//
//remove_action( 'wp_ajax_vc_gitem_preview', 'vc_grid_item_render_preview', 5 );
//add_action( 'wp_ajax_vc_gitem_preview', 'floral_grid_item_render_preview', 6 );