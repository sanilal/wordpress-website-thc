<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_thumbnail_slider.php
 * @time    : 12/13/2016 6:09 AM
 * @author  : 9WPThemes Team
 * @var $this Floral_SC_Thumbnail_slider
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

wp_enqueue_style( Floral_Enqueue::STYLE_PREFIX . 'slick-carousel' );
wp_enqueue_script( Floral_Enqueue::SCRIPT_PREFIX . 'slick-carousel' );

$s1_img_size = $s1_img_size_custom = $s1_image_ratio = $s2_img_size = $s2_img_size_custom = $s2_image_ratio = $el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );


$meta_value = '';

if (floral_get_current_post_type() === Floral_CPT_Portfolio::CPT_SLUG ) {
	$meta_value = floral_get_meta_option( 'portfolio-gallery' );
}

if (floral_get_current_post_type() === Floral_CPT_Service::CPT_SLUG ) {
	$meta_value = floral_get_meta_option( 'service-gallery' );
}

$image_list = array();
if ( !empty( $meta_value ) && is_string( $meta_value ) ) {
	$image_list = (explode(",",$meta_value));
} else {
	$image_list = array('-1', '-2', '-3', '-4');
}

// slider 1
if ( $s1_img_size === 'custom' ) {
	$s1_img_size = ( empty( $s1_img_size_custom ) ) ? 'floral_1170' : $s1_img_size_custom;
}


$s1_args   = array();
if ( !empty( $s1_image_ratio ) ) {
	$s1_args['ratio'] = $s1_image_ratio;
}
$s1_image_render = '';

foreach ( $image_list as $image ) {
	$s1_image_render .= '<div class="__item">';
	if ( !empty( $meta_value ) ) {
		$s1_image_render .= Floral_Image::get_image( $image, $s1_img_size, $s1_args );
	} else {
		$s1_image_render .= '<img src="' . get_template_directory_uri() . '/assets/images/place-holder/2x1.png' . '" alt="' . __( 'No image', 'w9-floral-addon' ) . '"/>';
	}
	$s1_image_render .= '</div>';
}

// slider 2
if ( $s2_img_size === 'custom' ) {
	$s2_img_size = ( empty( $s2_img_size_custom ) ) ? 'floral_270' : $s2_img_size_custom;
}


$s2_args   = array();
if ( !empty( $s2_image_ratio ) ) {
	$s2_args['ratio'] = $s2_image_ratio;
}
$s2_image_render = '';

foreach ( $image_list as $image ) {
	$s2_image_render .= '<div class="__item">';
	if ( !empty( $meta_value ) ) {
		$s2_image_render .= Floral_Image::get_image( $image, $s2_img_size, $s2_args );
	} else {
		$s2_image_render .= '<img src="' . get_template_directory_uri() . '/assets/images/place-holder/3x2.png' . '" alt="' . __( 'No image', 'w9-floral-addon' ) . '"/>';
	}
	$s2_image_render .= '</div>';
}

$unique_id = uniqid('floral-thumbnail-slider-');

?>
<div id = "<?php echo $unique_id; ?>" class="floral-thumbnail-slider">
	<div class="syn-slider-1-wrapper">
		<div class="syn-slider-1">
			<?php echo $s1_image_render; ?>
		</div>
	</div>
	<div class="syn-slider-2-wrapper">
		<div class="syn-slider-2">
			<?php echo $s2_image_render; ?>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function(a){"use-strict";function c(c){c="undefined"!=typeof c?c:"",a(".floral-thumbnail-slider"+c).each(function(){function h(a){var b=a;e.find(".slick-slide").removeClass("synced").eq(b).addClass("synced"),i(b)}function i(a){var b=a,c=!1,d=e.find(".slick-slide:last").index();for(var g in f)if(b===f[g])var c=!0;c===!1?b>f[f.length-1]?b==d?e.slick("slickGoTo",b-f.length+1):e.slick("slickGoTo",b-f.length+2):b-1===-1?e.slick("slickGoTo",0):e.slick("slickGoTo",b-1):b===f[f.length-1]?e.slick("slickGoTo",f[1]):b===f[0]&&e.slick("slickGoTo",b-1)}var c=a(this),d=c.find(".syn-slider-1"),e=c.find(".syn-slider-2");d.slick({infinite:!1,fade:!1,speed:400,adaptiveHeight:!1,arrows:!0,dots:!1}),d.on("beforeChange",function(a,b,c,d){h(d)});var f=[],g=0;e.on("init",function(b,c){a(this).find(".slick-slide").eq(0).addClass("synced");var d=window.innerWidth;d>=1020&&(g=4),d<1020&&(g=3);for(var e=0;e<g;e++)f.push(e)}),b.on("resize load",function(a){var b=window.innerWidth;return b>=1020&&(g=4),b<1020&&(g=3),g}),e.on("afterChange",function(a,b,c){f.length=0;for(var d=c;d<c+g;d++)f.push(d)}),e.slick({swipeToSlide:!0,infinite:!1,slidesToShow:4,slidesToScroll:1,speed:400,arrows:!1,centerPadding:"0px",responsive:[{breakpoint:1230,settings:{slidesToShow:4}},{breakpoint:1020,settings:{slidesToShow:3}}]}),e.on("click",".slick-slide",function(b){b.preventDefault();var c=a(this).data("slick-index");d.slick("slickGoTo",c)})})}var b=a(window);c("<?php echo '#' . $unique_id; ?>")});
</script>

<?php


//
//$images = implode( ',', $image_list );
//$images = explode( ',', $images );
//var_dump($images);
//$i      = - 1;
//?>
<?php //foreach ( $images as $attach_id ) : ?>
<!--	--><?php
//	$i ++;
//	if ( $attach_id > 0 ) {
//		if ( function_exists( 'Floral_Image' ) ) {
//			$post_thumbnail                = array();
//			$post_thumbnail['thumbnail']   = Floral_Image::get_image( $attach_id, $s1_img_size );
//			$post_thumbnail['p_img_large'] = wp_get_attachment_image_src( $attach_id, 'floral_1170' );
//		} else {
//			$post_thumbnail = wpb_getImageBySize( array(
//				'attach_id'  => $attach_id,
//				'thumb_size' => $s1_img_size,
//			) );
//		}
//	} else {
//		$post_thumbnail                   = array();
//		$post_thumbnail['thumbnail']      = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" alt="' . __( 'No image', 'w9-floral-addon' ) . '"/>';
//		$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
//	}
//	$thumbnail = $post_thumbnail['thumbnail'];
//	echo $thumbnail;
//
//	?>
<?php //endforeach ?>

