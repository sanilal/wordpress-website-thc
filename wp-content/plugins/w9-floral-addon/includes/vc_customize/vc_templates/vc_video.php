<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc_video.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $el_class
 * @var $css
 * @var $el_width
 * @var $el_aspect
 * @var $align
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Video
 */
$title       = $link = $el_class = $css = $el_width = $el_aspect = $align = '';
$video_style = $image_placeholder = $image_placeholder_height = $image_placeholder_custom_height = $image_placeholder_overlay = $title_position = '';
$type        = $icon_floral = $icon_9wpthemes = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $icon_monosocial = '';
$atts        = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $link ) {
    return null;
}
$el_class = $this->getExtraClass( $el_class );

$video_w = 1170;
$video_h = $video_w / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed */
global $wp_embed;
$embed = '';
if ( is_object( $wp_embed ) ) {
    $embed = $wp_embed->run_shortcode( '[embed width="' . $video_w . '" height="' . $video_h . '"]' . $link . '[/embed]' );
}

if ( $video_style !== 'popup' ) :
    $el_classes = array(
        'wpb_video_widget',
        'wpb_content_element',
        'vc_clearfix',
        $el_class,
        vc_shortcode_custom_css_class( $css, ' ' ),
        'vc_video-aspect-ratio-' . esc_attr( $el_aspect ),
        'vc_video-el-width-' . esc_attr( $el_width ),
        'vc_video-align-' . esc_attr( $align ),
    );
    $css_class  = implode( ' ', $el_classes );
    $css_class  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->getShortcode(), $atts );
    
    $output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper">
			' . wpb_widget_title( array(
            'title'      => $title,
            'extraclass' => 'wpb_video_heading fz-24',
        ) ) . '
			<div class="wpb_video_wrapper">' . $embed . '</div>
		</div>
	</div>';
    
    echo $output;
else:
    $el_classes = array(
        'floral-popup-video-placeholder',
        'vc_clearfix',
        $el_class,
        vc_shortcode_custom_css_class( $css, ' ' ),
    );
    
    if ( $image_placeholder_height !== 'custom' ) {
        $el_classes[] = 'floral-popup-video-placeholder-ratio-' . esc_attr( $image_placeholder_height );
    }
    
    $title_class = array();
    if ( $title !== '' ) {
        $el_classes[] = '__with-title';
        $el_classes[] = 'title-' . $title_position;
        
        if ( $title_position === 'center-middle' ) {
            $title_class[] = 'fz-16 fw-medium ls-01 mb-0';
        } else {
            $title_class[] = 'fz-14 fw-regular ls-01 mb-0';
        }
        
    }
    
    $css_class = implode( ' ', $el_classes );
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->getShortcode(), $atts );
    
    $image_placeholder_src = wp_get_attachment_image_src( $image_placeholder, 'full' );
    $inline_css            = array();
    if ( $image_placeholder_src ) {
        $inline_css[] = 'background-image: url(\'' . $image_placeholder_src[0] . '\')';
    }
    
    if ( $image_placeholder_height === 'custom' && $image_placeholder_custom_height !== '' ) {
        $inline_css[] = 'height: ' . $image_placeholder_custom_height;
    } elseif ( $image_placeholder_height == 'custom' ) {
        $inline_css[] = 'height: 300px';
    }
    
    if ( empty( $image_placeholder_overlay ) ) {
        $image_placeholder_overlay = 'rgba(0,0,0,0.5)';
    }
    
    /*-------------------------------------
    	ICON
    ---------------------------------------*/
    $icon_content = '';
    if ( empty( $atts['i_type'] ) ) {
        $atts['i_type'] = 'fontawesome';
    }
    $data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_icon', $atts, 'i_' );
    if ( $data ) {
        $icon = visual_composer()->getShortCode( 'vc_icon' );
        if ( is_object( $icon ) ) {
            $icon_content = $icon->render( array_filter( $data ) );
        }
    }
    
    /*-------------------------------------
    	OUTPUT
    ---------------------------------------*/
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );
    $_link_attr = array( 'data-rel' => 'prettyPhoto', 'class' => 'prettyPhoto', 'data-width' => '1000' );
    
    if ( $el_aspect === '169' ) {
        $_link_attr['data-height'] = 1000 * 9 / 16;
    } elseif ( $el_aspect === '43' ) {
        $_link_attr['data-height'] = 1000 * 3 / 4;
    } elseif ( $el_aspect === '235' ) {
        $_link_attr['data-height'] = 1000 * 1 / 2.35;
    } else {
        $_link_attr['data-height'] = 600;
    }
    
    $__link = Floral_Wrap::link( 'link', $link, $_link_attr );
    ?>
    <div class="<?php echo esc_attr( $css_class ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css ) ?>>
        <div class="floral-video-placeholder-overlay" style="background-color: <?php echo $image_placeholder_overlay; ?>"></div>
        <div class="floral-popup-video-caller">
            
            <div class="__icon">
                <div class="floral-content-popup">
                    <?php echo ( !empty( $icon_content ) ) ? $icon_content : ''; ?>
                    <?php echo ( !empty( $__link ) ) ? $__link : ''; ?>
                </div>
            </div>
            <?php if ( $title !== '' && $title_position === 'center-middle' ) : ?>
                <h4 class="__title <?php floral_the_clean_html_classes( $title_class ); ?>"><?php echo esc_html( $title ) ?></h4>
            <?php endif; ?>
        </div>
        <?php if ( $title !== '' && $title_position !== 'center-middle' ) : ?>
            <h4 class="__title <?php floral_the_clean_html_classes( $title_class ); ?>"><?php echo esc_html( $title ) ?></h4>
        <?php endif; ?>
    </div>
    <?php
endif;

