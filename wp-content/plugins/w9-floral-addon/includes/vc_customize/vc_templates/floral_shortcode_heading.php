<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_heading.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Heading
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//$heading_title_no_space = '';

$heading_title = $heading_link = $heading_title_size = $heading_title_custom_size = $heading_el_tag = $heading_title_data_source = $heading_subtitle_data_source =
$heading_title_line_height = $heading_text_align = $heading_color = $heading_title_custom_color = $heading_title_ls =
$heading_title_ff = $heading_title_text_transform = $heading_text_fs = $heading_text_fw = $heading_title_custom_ff = $heading_title_responsive_title_size = $heading_title_minimum_size = $heading_title_scale_ratio =
$heading_subtitle_enable = $heading_subtitle_content = $heading_subtitle_margin_top = $heading_subtitle_text_transform = $heading_subtitle_fs = $heading_subtitle_fw = $heading_subtitle_size = $heading_subtitle_custom_size = $heading_subtitle_responsive_title_size = $heading_subtitle_minimum_size = $heading_subtitle_scale_ratio =
$heading_subtitle_line_height =
$heading_separator_enable= $heading_separator_margin_top = $heading_separator_width = $heading_separator_custom_width = $heading_separator_height = $heading_separator_custom_height = $heading_separator_color = $heading_separator_custom_color = $heading_text_align_on_tablet = $heading_text_align_on_mobile = $heading_subtitle_max_width =
$el_class = $css = $animation_css = $animation_duration = $animation_delay = $tablet_css = $mobile_css = '';

//$heading_title_text_transform = $heading_subtitle_text_transform = '';
$atts = vc_map_get_attributes( $this::SC_BASE, $atts );

extract( $atts );
Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

// inline styling
$style_heading           = array();
$style_heading_title     = array();
$style_heading_subtitle  = array();
$style_heading_separator = array();

// data resize
$data_title_resize_options    = array();
$data_subtitle_resize_options = array();

// heading subtitle class
$class_heading_subtitle = array();
// heading title class
$class_heading_title = array();
// class heading separator
$class_heading_separator = array();

// Heading class
$class_heading = array(
    $heading_text_align,
    $heading_title_ff,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
    Floral_Map_Helpers::get_class_animation( $animation_css ),
    $this->getExtraClass( $el_class )
);

/*-------------------------------------
	HEADING WRAPPER
---------------------------------------*/
// responsive on tablet
if ( !empty( $heading_text_align_on_tablet ) ) {
    $class_heading[] = $heading_text_align_on_tablet;
}

// responsive on mobile
if ( !empty( $heading_text_align_on_mobile ) ) {
    $class_heading[] = $heading_text_align_on_mobile;
}

if ( !empty( $heading_title_ls ) ) {
    $class_heading_title[] = $heading_title_ls;
}

if ( $heading_title_ff !== 'google-font' ) {
    $class_heading[] = $heading_text_fs;
    $class_heading[] = $heading_text_fw;
} else {
    $google_fonts_obj  = new Vc_Google_Fonts();
    $google_fonts_data = strlen( $heading_title_custom_ff ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( array(), $heading_title_custom_ff ) : '';
    if ( isset( $google_fonts_data['values']['font_family'] ) ) {
        $google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
        $style_heading[]     = 'font-family:' . $google_fonts_family[0];
        $google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
        $style_heading[]     = 'font-weight:' . $google_fonts_styles[1];
        $style_heading[]     = 'font-style:' . $google_fonts_styles[2];

        wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] );
    }
}

// Color
if ( $heading_color !== 'custom' ) {
    $class_heading[] = $heading_color . '-color';
} else {
    $style_heading[] = 'color: ' . $heading_title_custom_color;
}

/*-------------------------------------
	HEADING TITLE
---------------------------------------*/
$class_heading_title[] = 'fz-' . $heading_title_size;
$class_heading_title[] = $heading_title_text_transform;

//if ( $heading_title_no_space !== 'true' ) {
//    $class_heading_title[] = 'has-space';
//}


// heading title font size
if ( !empty( $heading_title_responsive_title_size ) ) {
    $class_heading_title[] = 'responsive-font-size';

    if ( $heading_title_size === 'custom' ) {
        $data_title_resize_options['font_size']['maxFontSize'] = floatval( $heading_title_custom_size );
    } else {
        $data_title_resize_options['font_size']['maxFontSize'] = floatval( $heading_title_size );
    }

    if ( !empty( $heading_title_minimum_size ) ) {
        $data_title_resize_options['font_size']['minFontSize'] = floatval( $heading_title_minimum_size );
    }

    $heading_title_scale_ratio = ( !empty( $heading_title_scale_ratio ) && floatval( $heading_title_scale_ratio ) ) ? floatval( $heading_title_scale_ratio ) : 1;
    
    $data_title_resize_options['compressor'] = $heading_title_scale_ratio;
} else {
    if ( $heading_title_size === 'custom' ) {
        $style_heading_title[] = 'font-size: ' . $heading_title_custom_size . 'px';
    }
}

if ( !empty( $heading_title_line_height ) ) {
    $style_heading_title[] = 'line-height: ' . $heading_title_line_height;
}

/*-------------------------------------
	HEADING SUBTITLE
---------------------------------------*/
if ( !empty( $heading_subtitle_enable ) ) {
    $class_heading_subtitle[] = 'fz-' . $heading_subtitle_size;
    $class_heading_subtitle[] = $heading_subtitle_fs;
    $class_heading_subtitle[] = $heading_subtitle_text_transform;
    $class_heading_subtitle[] = $heading_subtitle_fw;

    if ( !empty( $heading_subtitle_responsive_title_size ) ) {
        $class_heading_subtitle[] = 'responsive-font-size';

        if ( $heading_subtitle_size === 'custom' ) {
            $data_subtitle_resize_options['font_size']['maxFontSize'] = floatval( $heading_subtitle_custom_size );
        } else {
            $data_subtitle_resize_options['font_size']['maxFontSize'] = floatval( $heading_subtitle_size );
        }

        if ( !empty( $heading_subtitle_minimum_size ) ) {
            $data_subtitle_resize_options['font_size']['minFontSize'] = floatval( $heading_subtitle_minimum_size );
        }

        $heading_subtitle_scale_ratio = ( !empty( $heading_subtitle_scale_ratio ) && floatval( $heading_subtitle_scale_ratio ) ) ? floatval( $heading_subtitle_scale_ratio ) : 1;

        $data_subtitle_resize_options['compressor'] = $heading_subtitle_scale_ratio;
    } else {
        if ( $heading_subtitle_size === 'custom' ) {
            $style_heading_subtitle[] = 'font-size: ' . $heading_subtitle_custom_size . 'px';
        }
    }
	
    if ( !empty( $heading_subtitle_margin_top ) ) {
        $style_heading_subtitle[] = 'margin-top: ' . $heading_subtitle_margin_top . 'px';
    }
    
    if ( !empty( $heading_subtitle_line_height ) ) {
        $style_heading_subtitle[] = 'line-height: ' . $heading_subtitle_line_height;
    }

    if ( !empty( $heading_subtitle_max_width ) ) {
        $style_heading_subtitle[] = 'max-width: ' . $heading_subtitle_max_width;
    }
}

/*-------------------------------------
	HEADING SEPARATOR
---------------------------------------*/
if ( !empty( $heading_separator_enable ) ) {
	if ( !empty( $heading_separator_margin_top ) ) {
		$style_heading_separator[] = 'margin-top: ' . $heading_separator_margin_top . 'px';
	}
	
	if ( $heading_separator_width === 'custom-width' ) {
        $style_heading_separator[] = 'width: ' . $heading_separator_custom_width;
    }

    if ( $heading_separator_height === 'custom-height' ) {
        $style_heading_separator[] = 'height: ' . $heading_separator_custom_height;
    }

    if ( !empty( $heading_separator_color ) ) {
        if ( $heading_separator_color !== 'custom' ) {
            $class_heading_separator[] = $heading_separator_color . '-bgc';
        } else {
            $style_heading_separator[] = 'background-color: ' . $heading_separator_custom_color;
        }
    }
}


/*-------------------------------------
	HEADING URL
---------------------------------------*/
$heading_link = vc_build_link( $heading_link );
$a_href       = !empty( $heading_link['url'] ) ? $heading_link['url'] : '';
$a_title      = !empty( $heading_link['title'] ) ? $heading_link['title'] : '';
$a_target     = !empty( $heading_link['target'] ) ? $heading_link['target'] : '_self';
$a_rel        = !empty( $heading_link['rel'] ) ? $heading_link['rel'] : '';

// heading title tag
$heading_title_open_tag  = '<' . $heading_el_tag . ' class="floral-heading ' . floral_clean_html_classes( $class_heading_title ) . '" ' . Floral_Map_Helpers::get_inline_style( $style_heading_title ) . ' data-resize="' . esc_attr( json_encode( $data_title_resize_options ) ) . '">';
$heading_title_close_tag = '</' . $heading_el_tag . '>';

// the heading title allow simple html inner
if ( $heading_title_data_source === 'custom-content' ) {
    if ( @preg_match( '/^#E\-8_/', $heading_title ) ) {
        $heading_title = @preg_replace( '/^#E\-8_/', '', $heading_title );
        $heading_title = urldecode( base64_decode( $heading_title ) );
    }
} elseif ( $heading_title_data_source === 'page-title' && function_exists( 'floral_get_page_title' ) ) {
    $heading_title = floral_get_page_title();
} elseif ( $heading_title_data_source === 'raw-page-title' ) {
	$heading_title = get_the_title();
}

if ( !empty( $heading_subtitle_enable ) ) {
    if ( $heading_subtitle_data_source === 'custom-content' && !empty( $heading_subtitle_content ) ) {
        if ( @preg_match( '/^#E\-8_/', $heading_subtitle_content ) ) {
            $heading_subtitle_content = @preg_replace( '/^#E\-8_/', '', $heading_subtitle_content );
            $heading_subtitle_content = urldecode( base64_decode( $heading_subtitle_content ) );
        }
    } elseif ( $heading_subtitle_data_source === 'page-subtitle' && function_exists( 'floral_get_page_subtitle' ) ) {
        $heading_subtitle_content = floral_get_page_subtitle();
    }
}

// Heading title content
if ( !empty( $a_href ) ) {
    $heading_title_content = Floral_Wrap::link( $heading_title, $a_href, array( 'rel' => $a_rel, 'target' => $a_target, 'title' => $a_title ) );
} else {
    $heading_title_content = $heading_title;
}

?>
<div class="floral-heading-wrapper <?php floral_the_clean_html_classes( $class_heading ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $style_heading, $animation_duration, $animation_delay ); ?>>
    <div class="__inner">
    <?php if ( !empty( $heading_title ) ): ?>
        <?php echo sprintf( '%s', $heading_title_open_tag ); ?>
        <?php echo sprintf( '%s', $heading_title_content ); ?>
        <?php echo sprintf( '%s', $heading_title_close_tag ); ?>
    <?php endif; ?>
    <?php if ( !empty( $heading_subtitle_enable ) && !empty( $heading_subtitle_content ) ) : ?>
        <p class="floral-heading-subtitle <?php floral_the_clean_html_classes( $class_heading_subtitle ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $style_heading_subtitle ); ?> data-resize="<?php echo esc_attr( json_encode( $data_subtitle_resize_options ) ); ?>"><?php echo sprintf( '%s', $heading_subtitle_content ); ?></p>
    <?php endif; ?>
    <?php if ( !empty( $heading_separator_enable ) ): ?>
        <span class="floral-separator <?php floral_the_clean_html_classes( $class_heading_separator ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $style_heading_separator ); ?>></span>
    <?php endif; ?>
    </div>
</div>