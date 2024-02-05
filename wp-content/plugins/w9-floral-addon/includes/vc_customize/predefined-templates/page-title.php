<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: page-title.php
 * @time    : 9/13/16 4:08 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


//$template_group = __( 'Page Title | ', 'w9-floral-addon' );
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Classic Style', 'w9-floral-addon' ),
//    'content' => '[vc_row overlay_set="show_overlay_color" overlay_color="rgba(0,0,0,0.35)" text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1473821395457{padding-top: 200px !important;padding-bottom: 200px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/page-title-services-classicbg.jpg?id=451) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" tablet_css=".vc_custom_1473821395457{padding-top: 160px !important;padding-bottom: 100px !important;}" mobile_css=".vc_custom_1473821395458{padding-top: 140px !important;padding-bottom: 80px !important;}"][vc_column][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="100" heading_title_line_height="1.5" heading_text_align="text-center" heading_text_fw="fw-bold" heading_title_no_space="true" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="20" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-regular" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_title_scale_ratio="1.2" heading_title_minimum_size="100" heading_subtitle_responsive_title_size="1" heading_subtitle_scale_ratio="1.5" heading_subtitle_minimum_size="20"][/vc_column][/vc_row]'
//);
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Classic Style With Icon Box', 'w9-floral-addon' ),
//    'content' => '[vc_row overlay_set="show_overlay_color" overlay_color="rgba(0,0,0,0.35)" text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1473846363755{padding-top: 200px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/mountain.jpg?id=568) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" tablet_css=".vc_custom_1473846363756{padding-top: 120px !important;}" mobile_css=".vc_custom_1473846363756{padding-top: 140px !important;}"][vc_column][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="100" heading_title_line_height="1.2" heading_text_align="text-center" heading_text_fw="fw-bold" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="20" heading_subtitle_line_height="1.2" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-regular" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_title_scale_ratio="1.2" heading_title_minimum_size="24" heading_subtitle_responsive_title_size="1" heading_subtitle_scale_ratio="1.5" heading_subtitle_minimum_size="16"][vc_row_inner css=".vc_custom_1473846407036{padding-top: 110px !important;padding-bottom: 40px !important;}" tablet_css=".vc_custom_1473846407037{padding-top: 70px !important;}" mobile_css=".vc_custom_1473846407037{padding-top: 70px !important;}"][vc_column_inner text_color="__" heading_color="__" link_color="__" link_hover_color="__" width="1/3" css=".vc_custom_1473824169702{padding-bottom: 35px !important;}"][floral_shortcode_icon_box type="9wpthemes" icon_9wpthemes="w9 w9-ico-map" ib_i_align="bottom" ib_title="OUR OFFICE" ib_link="url:%23|title:open%20map%20||" ib_sub_title="Lorem Ipsum is simply dummy" ib_i_color="light" ib_tx_color="light"][/vc_column_inner][vc_column_inner text_color="__" heading_color="__" link_color="__" link_hover_color="__" width="1/3" css=".vc_custom_1473824173925{padding-bottom: 35px !important;}"][floral_shortcode_icon_box type="9wpthemes" icon_9wpthemes="w9 w9-ico-envelope" ib_i_align="bottom" ib_title="DROP A LINE" ib_link="url:%23|title:send%20email||" ib_sub_title="Lorem Ipsum is simply dummy" ib_i_color="light" ib_tx_color="light"][/vc_column_inner][vc_column_inner text_color="__" heading_color="__" link_color="__" link_hover_color="__" width="1/3" css=".vc_custom_1473824177742{padding-bottom: 35px !important;}"][floral_shortcode_icon_box type="9wpthemes" icon_9wpthemes="w9 w9-ico-chat" ib_i_align="bottom" ib_title="SUPPORT" ib_link="url:%23|title:open%20ticket||" ib_sub_title="Lorem Ipsum is simply dummy" ib_i_color="light" ib_tx_color="light"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Agency Style', 'w9-floral-addon' ),
//    'content' => '[vc_row overlay_set="show_overlay_gradient" overlay_opacity="0.75" overlay_gradient_color_1="transparent" overlay_gradient_color_2="dark" overlay_gradient_angle="180" text_color="light" heading_color="light" link_color="__" link_hover_color="light" css=".vc_custom_1475833312456{padding-top: 200px !important;padding-bottom: 150px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/page-agency-page-title-background.jpg?id=540) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column text_color="__" heading_color="__" link_color="__" link_hover_color="__"][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="150" heading_title_line_height="1.4" heading_text_align="text-center" heading_text_fw="fw-bold" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_width="custom-width" heading_separator_custom_width="254px" heading_separator_height="custom-height" heading_separator_custom_height="7px" heading_title_responsive_title_size="1" heading_title_scale_ratio="0.76" heading_title_minimum_size="24" css=".vc_custom_1473841429111{margin-bottom: 40px !important;}" tablet_css=".vc_custom_1473841429113{margin-bottom: 20px !important;}" mobile_css=".vc_custom_1473841429113{margin-bottom: 20px !important;}"][/vc_column][vc_column text_align="text-center" max_width="1100px" horizontal_align="block-align-center" text_color="light" heading_color="light" link_color="light" link_hover_color="__" font_size="20" responsive_font_size="0" el_class="s-font" css=".vc_custom_1473844537137{margin-bottom: 20px !important;}" tablet_css=".vc_custom_1473844537138{margin-bottom: 0px !important;}" mobile_css=".vc_custom_1473844537139{margin-bottom: 0px !important;}"][floral_shortcode_heading heading_title="" heading_title_size="18" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="20" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-inherit" heading_separator_enable="0" heading_title_responsive_title_size="0" heading_subtitle_responsive_title_size="0"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Startup Style', 'w9-floral-addon' ),
//    'content' => '[vc_row overlay_set="show_overlay_color" overlay_color="rgba(0,0,0,0.35)" text_color="light" heading_color="light" link_color="light" link_hover_color="__" css=".vc_custom_1475229933594{padding-top: 255px !important;padding-bottom: 255px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/screen_partner.jpg?id=1495) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" tablet_css=".vc_custom_1475229933594{padding-top: 160px !important;padding-bottom: 100px !important;}" mobile_css=".vc_custom_1475229933595{padding-top: 140px !important;padding-bottom: 80px !important;}"][vc_column text_align="text-center" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="60" heading_title_line_height="1.5" heading_text_align="text-center" heading_text_fw="fw-bold" heading_title_no_space="true" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_title_scale_ratio="1.2" heading_title_minimum_size="24"][floral_shortcode_heading heading_title="" heading_title_size="custom" heading_title_custom_size="32" heading_title_ff="p-font" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="custom" heading_subtitle_custom_size="32" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-inherit" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_subtitle_responsive_title_size="0"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Portfolio Style ', 'w9-floral-addon' ),
//    'content' => '[vc_row overlay_set="show_overlay_color" overlay_color="rgba(34,34,34,0.9)" text_color="light" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475836035357{padding-top: 135px !important;padding-bottom: 135px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/log.jpg?id=469) !important;}" tablet_css=".vc_custom_1475836035358{padding-top: 100px !important;padding-bottom: 100px !important;}" mobile_css=".vc_custom_1475836035359{padding-top: 100px !important;padding-bottom: 100px !important;}"][vc_column][floral_shortcode_heading heading_title_data_source="page-title" heading_title_size="custom" heading_title_custom_size="100" heading_title_line_height="1.4" heading_text_fw="fw-bold" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="20" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-regular" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_title_scale_ratio="1.5" heading_subtitle_responsive_title_size="1"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Shortcode Style', 'w9-floral-addon' ),
//    'content' => '[vc_row text_color="light" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475655088561{padding-top: 200px !important;padding-bottom: 150px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/10/slide1-home3.2.jpg?id=1823) !important;}"][vc_column text_align="text-center" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="60" heading_text_fw="fw-bold" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1475655282692{margin-bottom: 0px !important;}"][floral_shortcode_heading heading_title="" heading_el_tag="p" heading_title_ff="p-font" heading_text_fw="fw-light" heading_subtitle_enable="1" heading_subtitle_data_source="page-subtitle" heading_subtitle_size="custom" heading_subtitle_custom_size="32" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-inherit" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_subtitle_responsive_title_size="0"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Video Popup Style', 'w9-floral-addon' ),
//    'content' => '[vc_row content_width="container-xlg" overlay_set="show_overlay_color" overlay_color="rgba(0,0,0,0.5)" text_color="light" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475295280755{padding-top: 300px !important;padding-bottom: 240px !important;background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/startup-event-page-title.jpg?id=1505) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" tablet_css=".vc_custom_1475295280755{padding-top: 180px !important;padding-bottom: 120px !important;}" mobile_css=".vc_custom_1475295280756{padding-top: 120px !important;padding-bottom: 80px !important;}"][vc_column text_align="text-center" max_width="1230px" horizontal_align="block-align-center" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][vc_row_inner css=".vc_custom_1475296727250{margin-bottom: 25px !important;}"][vc_column_inner text_align="text-right" horizontal_align="block-align-right" text_color="__" heading_color="__" link_color="__" link_hover_color="__" text_align_on_tablet="text-center-on-tablet" text_align_on_mobile="text-center-on-mobile" offset="vc_col-md-5" css=".vc_custom_1475296571828{margin-right: -50px !important;}" tablet_css=".vc_custom_1475296571830{margin-right: 0px !important;}" mobile_css=".vc_custom_1475296571830{margin-right: 0px !important;}"][floral_shortcode_heading heading_title="Batch 16 " heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="60" heading_title_line_height="1" heading_text_fw="fw-bold" heading_title_no_space="true" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1475296464528{margin-bottom: 10px !important;}" tablet_css=".vc_custom_1475296464529{padding-bottom: 20px !important;}" mobile_css=".vc_custom_1475296464530{padding-bottom: 20px !important;}"][/vc_column_inner][vc_column_inner text_color="__" heading_color="__" link_color="__" link_hover_color="__" offset="vc_col-md-2"][vc_icon type="9wpthemes" icon_9wpthemes="w9 w9-ico-play-1" size="xl" align="center" onclick="popup-video" css=".vc_custom_1475296455488{margin-bottom: 10px !important;}"][/vc_column_inner][vc_column_inner text_align="text-left" text_color="__" heading_color="__" link_color="__" link_hover_color="__" text_align_on_tablet="text-center-on-tablet" text_align_on_mobile="text-center-on-mobile" offset="vc_col-md-5" css=".vc_custom_1475296622075{margin-left: -50px !important;}" tablet_css=".vc_custom_1475296622076{margin-left: 0px !important;}" mobile_css=".vc_custom_1475296622077{margin-left: 0px !important;}"][floral_shortcode_heading heading_title="Demo Day" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="60" heading_title_line_height="1" heading_text_fw="fw-bold" heading_title_no_space="true" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="0" css=".vc_custom_1475296470756{margin-bottom: 10px !important;}" tablet_css=".vc_custom_1475296470757{padding-bottom: 20px !important;}" mobile_css=".vc_custom_1475296470758{padding-bottom: 20px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column text_align="text-center" max_width="1170px" horizontal_align="block-align-center" text_color="__" heading_color="__" link_color="__" link_hover_color="__"][floral_shortcode_heading heading_title="A one-day event for active & accredited investors to check out our hottest accelerator & Series A portfolio companies." heading_title_size="custom" heading_title_custom_size="32" heading_title_ff="p-font" heading_text_fw="fw-light" heading_subtitle_enable="0" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_title_scale_ratio="1.6" css=".vc_custom_1475295755017{margin-bottom: 30px !important;}" tablet_css=".vc_custom_1475295755018{margin-bottom: 20px !important;}" mobile_css=".vc_custom_1475295755019{margin-bottom: 20px !important;}"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Full Height Style 01', 'w9-floral-addon' ),
//    'content' => '[vc_row full_height="yes" overlay_set="show_overlay_gradient" overlay_opacity="0.75" overlay_gradient_color_1="transparent" overlay_gradient_color_2="dark" overlay_gradient_angle="180" text_color="light" heading_color="light" link_color="__" link_hover_color="light" css=".vc_custom_1474969496003{background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/page-agency-page-title-background.jpg?id=540) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column text_color="__" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1474969508921{padding-top: 120px !important;}"][floral_shortcode_heading heading_title_data_source="page-title" heading_el_tag="h1" heading_title_size="custom" heading_title_custom_size="150" heading_title_line_height="1.4" heading_text_align="text-center" heading_text_fw="fw-bold" heading_subtitle_enable="0" heading_separator_enable="1" heading_separator_width="custom-width" heading_separator_custom_width="254px" heading_separator_height="custom-height" heading_separator_custom_height="7px" heading_title_responsive_title_size="1" heading_title_scale_ratio="0.76" heading_title_minimum_size="24" css=".vc_custom_1473841429111{margin-bottom: 40px !important;}" tablet_css=".vc_custom_1473841429113{margin-bottom: 20px !important;}" mobile_css=".vc_custom_1473841429113{margin-bottom: 20px !important;}"][/vc_column][vc_column text_align="text-center" max_width="1100px" horizontal_align="block-align-center" text_color="light" heading_color="light" link_color="light" link_hover_color="__" font_size="20" responsive_font_size="0" el_class="s-font" css=".vc_custom_1473844537137{margin-bottom: 20px !important;}" tablet_css=".vc_custom_1473844537138{margin-bottom: 0px !important;}" mobile_css=".vc_custom_1473844537139{margin-bottom: 0px !important;}"][vc_column_text]Our team has many skills so we’re able to offer a wide array of services. Far away, behind the word mountains, far from the countries Vokalia and Contia, there live the blind texts. Separated they live in
//Booksgrove right at the coast of the Semantics, a large language ocean.
//It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life.[/vc_column_text][/vc_column][vc_column text_color="__" heading_color="__" link_color="text" link_hover_color="__" css=".vc_custom_1474969599861{padding-bottom: 80px !important;}"][floral_shortcode_button btn_text="See our portfolio" btn_shape="btn-shape-rounded-2" btn_alignment="text-center" btn_icon_align="align-icon-right" type="9wpthemes" icon_9wpthemes="w9 w9-ico-ios-arrow-thin-right" btn_icon_effect="icon-effect-inner-out-text" btn_icon_size="175%" btn_text_color="text" btn_bgc="light" btn_text_hover_color="light" btn_bgc_hover_color="p" btn_add_icon="1"][/vc_column][/vc_row]'
//);
//
//$predefined_templates_list[] = array(
//    'name'    => $template_group . __( 'Full Height Style 02', 'w9-floral-addon' ),
//    'content' => '[vc_row full_height="yes" content_placement="middle" overlay_set="show_overlay_color" overlay_color="rgba(0,0,0,0.85)" text_color="light" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475033984979{background-image: url(http://floral.9wpthemes.com/wp-content/uploads/2016/09/corporate-about-bg.jpg?id=923) !important;}"][vc_column text_align="text-center" text_color="__" heading_color="__" link_color="__" link_hover_color="__" css=".vc_custom_1475033885329{padding-top: 140px !important;padding-bottom: 80px !important;}"][vc_icon type="9wpthemes" icon_9wpthemes="w9 w9-ico-play-1" size="xl" align="center" onclick="popup-video" css=".vc_custom_1474104163681{margin-bottom: 10px !important;}"][floral_shortcode_heading heading_title="Creativity is always a leap of faith" heading_title_size="custom" heading_title_custom_size="60" heading_text_fw="fw-bold" heading_subtitle_enable="1" heading_subtitle_content="It is putting your imagination to work, and it’s produced the most extraordinary results in human culture." heading_subtitle_size="custom" heading_subtitle_custom_size="32" heading_subtitle_fs="fs-inherit" heading_subtitle_fw="fw-regular" heading_separator_enable="0" heading_title_responsive_title_size="1" heading_subtitle_responsive_title_size="1" heading_subtitle_scale_ratio="1.5" heading_subtitle_minimum_size="12" css=".vc_custom_1474104234502{margin-bottom: 40px !important;}"][floral_shortcode_button btn_text="Purchase now" btn_shape="btn-shape-rounded-2" btn_icon_align="align-icon-right" type="9wpthemes" icon_9wpthemes="w9 w9-ico-ios-arrow-thin-right" btn_icon_size="175%" btn_text_hover_color="__" btn_bgc_hover_color="bolder" btn_add_icon="1"][/vc_column][/vc_row]'
//);


