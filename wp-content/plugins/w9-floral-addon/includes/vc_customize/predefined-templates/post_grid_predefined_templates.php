<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: post_grid_predefined_templates.php
 * @time    : 9/12/16 9:28 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$grid_item_predefined_templates = array(
//    'floralPostListing_HorizontalStyle01' => array(
//        'name' => __( 'Floral Post Listing | Horizontal Style 01', 'w9-floral-addon' ),
//        'template' => '[vc_gitem c_zone_position="right" el_class="floral-post-grid-horizontal-style-01" become_normal_in_screen="floral-vertical-xxs||floral-vertical-sm||floral-vertical-md"][vc_gitem_animated_block animation="scaleIn"][vc_gitem_zone_a height_mode="16-9" featured_image="yes" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b link="post_link" text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1476179615144{border-top-width: 0px !important;border-right-width: 0px !important;border-bottom-width: 0px !important;border-left-width: 0px !important;background-color: rgba(0,0,0,0.3) !important;*background-color: rgb(0,0,0) !important;border-left-style: solid !important;border-right-style: solid !important;border-top-style: solid !important;border-bottom-style: solid !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title="READ MORE" heading_el_tag="div" heading_title_size="custom" heading_title_custom_size="14" heading_text_align="text-center" heading_title_ff="p-font" heading_title_no_space="true" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_width="custom-width" heading_separator_custom_width="66px" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1476178657891{margin-bottom: 0px !important;}"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="p" link_hover_color="__" css=".vc_custom_1473497034324{padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 30px !important;padding-left: 30px !important;background-color: #ffffff !important;}"][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_ff="p-font" heading_text_fw="fw-medium" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1476693144459{margin-bottom: 15px !important;}"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="135" text_before_readmore_link="" readmore_text="" css=".vc_custom_1473646170759{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="author" feature_display="inline" label="By"][floral_shortcode_gitem_feature post_feature="categories" feature_display="inline" label="in"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
//    'floralPostListing_HorizontalStyle02' => array(
//        'name' => __( 'Floral Post Listing | Horizontal Style 02', 'w9-floral-addon' ),
//        'template' => '[vc_gitem c_zone_position="right" el_class="floral-post-grid-horizontal-style-02" become_normal_in_screen="floral-vertical-xxs||floral-vertical-sm||floral-vertical-md"][vc_gitem_animated_block animation="scaleIn"][vc_gitem_zone_a height_mode="3-2" link="post_link" featured_image="yes" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="p" link_hover_color="__" css=".vc_custom_1473671287835{padding-top: 40px !important;padding-right: 30px !important;padding-bottom: 55px !important;padding-left: 30px !important;background-color: #ffffff !important;}"][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_ff="p-font" heading_text_fw="fw-medium" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1476693337958{margin-bottom: 15px !important;}"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="135" text_before_readmore_link="" readmore_text="" css=".vc_custom_1473646170759{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="author" feature_display="inline" label="By"][floral_shortcode_gitem_feature post_feature="categories" feature_display="inline" label="in"][floral_shortcode_gitem_button gitem_btn_link="post_link" btn_text="" type="9wpthemes" icon_9wpthemes="w9 w9-ico-ios-arrow-thin-right" btn_icon_size="175%" btn_text_hover_color="light" btn_bgc_hover_color="dark" btn_add_icon="1" el_class="floral-ab-readmore-btn"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
//    'floralPostListing_VerticalStyle01' => array(
//        'name' => __( 'Floral Post Listing | Vertical Style 01', 'w9-floral-addon' ),
//        'template' => '[vc_gitem c_zone_position="bottom" become_normal_in_screen="floral-vertical-xxs||floral-vertical-md" el_class="floral-post-grid-vertical-style-01"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="3-2" link="post_link" featured_image="yes" text_color="__" heading_color="__" link_color="__" link_hover_color="__" el_class="gitem-floral-hover-overlay-effect __middle-row-fh"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][vc_column_text css=".vc_custom_1482064685263{margin-bottom: 0px !important;}"]<div class="__floral-hover-overlay"><i class="fa fa-link"> </i></div>[/vc_column_text][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row][vc_gitem_col css=".vc_custom_1482062920430{padding-top: 28px !important;}"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="14" heading_title_text_transform="text-uppercase" heading_text_fw="fw-regular" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1482062516115{margin-bottom: 15px !important;}"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="135" text_before_readmore_link="" readmore_text="" css=".vc_custom_1482063082335{margin-bottom: 27px !important;}"][vc_separator color="border" css=".vc_custom_1482064279150{margin-bottom: 5px !important;}"][floral_shortcode_gitem_feature feature_display="inline"][floral_shortcode_gitem_feature post_feature="number-comment" feature_display="inline"][vc_separator color="border" css=".vc_custom_1482064203270{margin-top: 5px !important;}"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
    'floralService' => array(
	    'name' => __( 'Floral service', 'w9-floral-addon' ),
	    'template' => '[vc_gitem c_zone_position="bottom" el_class="floral-grid-service"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="original" el_class="item-image"][vc_gitem_row position="top"][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_570" action="post_link"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][floral_shortcode_gitem_button btn_text="BOOK NOW" btn_text_hover_color="__" btn_bgc_hover_color="bolder" btn_add_icon="0"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__" el_class="item-content"][vc_gitem_row][vc_gitem_col el_class="item-content-inner"][vc_gitem_post_title link="post_link" font_container="tag:div|text_align:left" el_class="__title"][vc_gitem_post_meta key="meta-service-time" el_class="__time"][vc_gitem_post_meta key="meta-service-price" el_class="__price"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
    ),
    'floralService_WithBooking' => array(
	    'name' => __( 'Floral service (with booking button)', 'w9-floral-addon' ),
	    'template' => '[vc_gitem c_zone_position="bottom" el_class="floral-grid-service"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="original" el_class="item-image"][vc_gitem_row position="top"][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_570"][floral_shortcode_gitem_button gitem_btn_link="booking-page" btn_text="BOOK NOW" btn_ff="p-font" btn_text_hover_color="__" btn_bgc_hover_color="bolder" btn_add_icon="0"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][floral_shortcode_gitem_button btn_text="BOOK NOW" btn_text_hover_color="__" btn_bgc_hover_color="bolder" btn_add_icon="0"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__" el_class="item-content"][vc_gitem_row][vc_gitem_col el_class="item-content-inner"][vc_gitem_post_title link="post_link" font_container="tag:div|text_align:left" el_class="__title"][vc_gitem_post_meta key="meta-service-time" el_class="__time"][vc_gitem_post_meta key="meta-service-price" el_class="__price"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
    ),
    'floralGallery_Grid' => array(
	    'name' => __( 'Floral gallery (grid)', 'w9-floral-addon' ),
	    'template' => '[vc_gitem c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a el_class="hidden"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_570" image_ratio="0.666666667" action="post_link_and_light_box"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
    ),

    'floralGallery_Masonry' => array(
	    'name' => __( 'Floral gallery (masonry)', 'w9-floral-addon' ),
	    'template' => '[vc_gitem c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a el_class="hidden"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_570" action="post_link_and_light_box"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
    ),
//    'floralService_Style01' => array(
//	    'name' => __( 'Floral Service | Style 01', 'w9-floral-addon' ),
//	    'template' => '[vc_gitem c_zone_position="bottom" el_class="floral-service-style-01"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="original"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b link="image_lightbox" text_color="__" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475659344504{background-color: rgba(0,0,0,0.4) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_title_size="custom" heading_title_custom_size="14" heading_title_text_transform="text-uppercase" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0"][floral_shortcode_gitem_image source="featured_image" img_size="floral_370" image_ratio="0.666666667" action="post_link" css=".vc_custom_1482088642453{margin-bottom: 20px !important;}"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="135" text_before_readmore_link="" readmore_text=""][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]'
//    ),
//    'floralService_Style02' => array(
//	    'name' => __( 'Floral Service | Style 02', 'w9-floral-addon' ),
//	    'template' => '[vc_gitem el_class="floral-service-style-02" c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1482090699110{padding-bottom: 15px !important;}"][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_title_size="custom" heading_title_custom_size="14" heading_title_line_height="1.2" heading_title_text_transform="text-uppercase" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_width="custom-width" heading_separator_custom_width="40px" heading_title_responsive_title_size="0" css=".vc_custom_1482090532915{margin-bottom: 30px !important;}"][floral_shortcode_gitem_image source="featured_image" img_size="floral_370" image_ratio="0.666666667" action="post_link" css=".vc_custom_1482090564688{margin-bottom: 25px !important;}"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="200" text_before_readmore_link="" readmore_text="" css=".vc_custom_1482090608660{margin-bottom: 30px !important;}"][floral_shortcode_gitem_button gitem_btn_link="post_link" btn_text="read more" btn_shape="btn-shape-rounded-1" btn_size="btn-size-sm" btn_text_hover_color="__" btn_bgc_hover_color="gray2" btn_add_icon="0" el_class="text-uppercase"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]'
//    ),
//    'floralPortfolio_Simple' => array(
//	    'name' => __( 'Floral Portfolio Simple', 'w9-floral-addon' ),
//	    'template' => '[vc_gitem c_zone_position="bottom" el_class="floral-portfolio-simple"][vc_gitem_animated_block][vc_gitem_zone_a][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_370" image_ratio="0.666666667" action="post_link" css=".vc_custom_1482094615652{margin-bottom: 23px !important;}"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_title_size="custom" heading_title_custom_size="14" heading_text_align="text-center" heading_title_text_transform="text-uppercase" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1482094623162{margin-bottom: 0px !important;}"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]'
//    ),
//    'floralPortfolio_SimpleNoTitle' => array(
//	    'name' => __( 'Floral Portfolio Simple | No title', 'w9-floral-addon' ),
//	    'template' => '[vc_gitem c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_370" image_ratio="0.666666667" action="post_link"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]'
//    ),
//    'floralPortfolioListing_OverlayStyle01' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Ratio 3x4', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="4-3" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralPortfolioListing_OverlayStyle01_3x2' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Ratio 3x2', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="3-2" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralPortfolioListing_OverlayStyle01_16x9' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Ratio 16x9', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="16-9" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralPortfolioListing_OverlayStyle01_LargePadding' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Large Padding - Ratio 3x4', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01 large-padding"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="4-3" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralPortfolioListing_OverlayStyle01_LargePadding_3x2' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Large Padding - Ratio 3x2', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01 large-padding"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="3-2" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralPortfolioListing_OverlayStyle01_LargePadding_16x9' => array(
//        'name' => __( 'Floral Portfolio Listing | Overlay Style 01 - Large Padding - Ratio 16x9', 'w9-floral-addon' ),
//        'template' => '[vc_gitem el_class="floral-portfolio-listing-overlay-style-01 large-padding"][vc_gitem_animated_block animation="fadeIn"][vc_gitem_zone_a height_mode="16-9" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1474276035418{background-color: rgba(0,0,0,0.8) !important;*background-color: rgb(0,0,0) !important;}"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col el_class="text-center"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="16" heading_title_line_height="1.2" heading_title_ff="p-font" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_height="custom-height" heading_separator_custom_height="1px" heading_separator_color="light" heading_title_responsive_title_size="0" css=".vc_custom_1474275971468{margin-bottom: 15px !important;}"][floral_shortcode_gitem_feature post_feature="categories" t_separator="slash"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][/vc_gitem]',
//    ),
//    'floralEventLising_Simple' => array(
//        'name' => __( 'Floral Event Listing | Simple Style', 'w9-floral-addon' ),
//        'template' => '[vc_gitem c_zone_position="bottom" el_class="floral-item-simple-wrapper"][vc_gitem_animated_block][vc_gitem_zone_a][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475670284007{padding-top: 18px !important;padding-bottom: 18px !important;}"][vc_gitem_row][vc_gitem_col width="1/3"][floral_shortcode_gitem_text label_type="none" text_type="meta_key" url_type="none" text_meta_key="meta-event-time" el_class="s-font fz-14 text-center-xs-max" css=".vc_custom_1475670107499{padding-top: 8px !important;padding-right: 30px !important;padding-bottom: 7px !important;padding-left: 30px !important;}"][/vc_gitem_col][vc_gitem_col width="1/3"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="14" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1475669941677{margin-bottom: 0px !important;padding-top: 8px !important;padding-bottom: 7px !important;}" el_class="text-center-xs-max"][/vc_gitem_col][vc_gitem_col width="1/3" el_class="text-sm-right"][floral_shortcode_gitem_button gitem_btn_link="meta_key" btn_text="Booking Now" btn_size="btn-size-sm" btn_alignment="text-right" type="9wpthemes" icon_9wpthemes="w9 w9-ico-calendar" btn_text_color="text" btn_bgc="transparent" btn_text_hover_color="__" btn_bgc_hover_color="transparent" btn_add_icon="1" el_class="text-center-xs-max" css=".vc_custom_1475670907733{padding-right: 30px !important;padding-left: 30px !important;}" gitem_btn_link_meta="meta-event-booking-url"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
//    'floralEventLising_Horizontal_Style01' => array(
//        'name' => __( 'Floral Event Listing | Horizontal Style 01', 'w9-floral-addon' ),
//        'template' => '[vc_gitem normal_block_width="floral-normal-block-4-12" c_zone_position="right" el_class="floral-event-listing-horizontal-style01"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="16-9" featured_image="yes"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c][vc_gitem_row][vc_gitem_col width="3/4" el_class="__main-content"][floral_shortcode_gitem_heading gitem_heading_link="post_link" heading_title_data_source="post-title" heading_title_size="24" heading_title_line_height="1.4" heading_title_ff="p-font" heading_text_fw="fw-medium" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0"][floral_shortcode_gitem_post_excerpt post_excerpt_max_length="150" readmore_text=""][floral_shortcode_gitem_text text_type="meta_key" url_type="meta_key" label_static="Website:" text_meta_key="meta-event-website" url_meta_key="meta-event-website"][floral_shortcode_gitem_feature post_feature="social-follow" label="Follow us:"][floral_shortcode_gitem_text text_display="inline" url_type="meta_key" label_static="View on" text_static="Speaker list" url_meta_key="meta-event-speaker-url" el_class="text-link-color fw-semibold"][floral_shortcode_gitem_text text_display="inline" url_type="meta_key" label_static="| View " text_static="Slidedeck" url_meta_key="meta-event-slidedeck-url" el_class="text-link-color fw-semibold"][/vc_gitem_col][vc_gitem_col width="1/4" el_class="__button-wrapper"][floral_shortcode_gitem_button gitem_btn_link="meta_key" btn_text="Booking Now" btn_shape="btn-shape-rounded-2" type="9wpthemes" icon_9wpthemes="w9 w9-ico-calendar" btn_text_hover_color="__" btn_bgc_hover_color="bolder" gitem_btn_link_meta="meta-event-booking-url" btn_add_icon="1"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
//
//    'floralThemeDemoListing' => array(
//        'name' => __( 'Floral Theme Demo Listing', 'w9-floral-addon' ),
//        'template' => '[vc_gitem c_zone_position="bottom"][vc_gitem_animated_block][vc_gitem_zone_a height_mode="original"][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_a][vc_gitem_zone_b][vc_gitem_row position="top"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="middle"][vc_gitem_col width="1/2"][/vc_gitem_col][vc_gitem_col width="1/2"][/vc_gitem_col][/vc_gitem_row][vc_gitem_row position="bottom"][vc_gitem_col][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_b][/vc_gitem_animated_block][vc_gitem_zone_c text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_gitem_row][vc_gitem_col][floral_shortcode_gitem_image source="featured_image" img_size="floral_370" action="meta_url" link_target="yes" undefined="" meta_url="meta-theme-demo-url" css=".vc_custom_1476400050874{margin-bottom: 40px !important;}" el_class="floral-theme-demo-feature-image"][floral_shortcode_gitem_heading gitem_heading_link="meta_key" link_target="yes" heading_title_data_source="post-title" heading_el_tag="h4" heading_title_size="custom" heading_title_custom_size="12" heading_text_align="text-center" heading_title_ff="p-font" heading_text_fw="fw-semibold" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" gitem_heading_link_meta="meta-theme-demo-url" el_class="text-uppercase"][/vc_gitem_col][/vc_gitem_row][/vc_gitem_zone_c][/vc_gitem]',
//    ),
);