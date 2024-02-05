<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-heading.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_SC_Heading extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_heading';
	
	public static function map() {
		/*
		 * 1. Title
		 * - URL (Links)
		 * - Element tag
		 * - Styling Options
		 *
		 * 2. Enable Sub-Title
		 * - Content
		 * - Font Size
		 * - Line Height
		 *
		 *
		 * 3. Enable Separator
		 * - Separator Color
		 */
		
		return array(
			'name'           => esc_html__( 'Floral Heading', 'w9-floral-addon' ),
			'base'           => Floral_SC_Heading::SC_BASE,
			'class'          => '',
			'icon'           => 'w9 w9-ico-software-font-underline',
			'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
			'description'    => __( 'Create awesome heading', 'w9-floral-addon' ),
			'php_class_name' => 'Floral_SC_Heading',
			'params'         => array(
				// TITLE
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Data source', 'w9-floral-addon' ),
					'param_name' => 'heading_title_data_source',
					'value'      => array(
						esc_html__( 'Custom Content', 'w9-floral-addon' )          => 'custom-content',
						esc_html__( 'From Current Page Title', 'w9-floral-addon' ) => 'page-title',
						__( 'From Current "Raw" Page Title', 'w9-floral-addon' ) => 'raw-page-title',
					),
					'std'        => 'custom-content'
				),
				array(
					'type'        => 'textarea_safe',
					'heading'     => esc_html__( 'Title', 'w9-floral-addon' ),
					'param_name'  => 'heading_title',
					'value'       => '',
					'admin_label' => true,
					'std'         => 'This is heading title',
					'dependency'  => array( 'element' => 'heading_title_data_source', 'value' => 'custom-content' ),
				),
				
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link (URL)', 'w9-floral-addon' ),
					'param_name' => 'heading_link',
					'value'      => '',
					'dependency' => array( 'element' => 'heading_title_data_source', 'value' => 'custom-content' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Element tag', 'w9-floral-addon' ),
					'param_name'  => 'heading_el_tag',
					'value'       => array(
						esc_html__( 'h1', 'w9-floral-addon' )  => 'h1',
						esc_html__( 'h2', 'w9-floral-addon' )  => 'h2',
						esc_html__( 'h3', 'w9-floral-addon' )  => 'h3',
						esc_html__( 'h4', 'w9-floral-addon' )  => 'h4',
						esc_html__( 'h5', 'w9-floral-addon' )  => 'h5',
						esc_html__( 'h6', 'w9-floral-addon' )  => 'h6',
						esc_html__( 'p', 'w9-floral-addon' )   => 'p',
						esc_html__( 'div', 'w9-floral-addon' ) => 'div',
					),
					'std'         => 'h2',
					'description' => esc_html__( 'Select heading element tag.', 'w9-floral-addon' ),
					'admin_label' => true,
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Title size', 'w9-floral-addon' ),
					'param_name'  => 'heading_title_size',
					'value'       => array(
						esc_html__( 'Extra Small (18px)', 'w9-floral-addon' ) => '18',
						esc_html__( 'Small (24px)', 'w9-floral-addon' )       => '24',
						esc_html__( 'Medium (28px)', 'w9-floral-addon' )      => '28',
						esc_html__( 'Large (36px)', 'w9-floral-addon' )       => '36',
						esc_html__( 'Extra Large (48px)', 'w9-floral-addon' ) => '48',
						esc_html__( 'Custom Size', 'w9-floral-addon' )        => 'custom',
					),
					'std'         => '30',
					'description' => esc_html__( 'Select heading title size.', 'w9-floral-addon' ),
					'admin_label' => true,
				),
				
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Custom font size', 'w9-floral-addon' ),
					'param_name'  => 'heading_title_custom_size',
					'value'       => '',
					'description' => esc_html__( 'Enter custom font-size for the heading title (Unit: px).', 'w9-floral-addon' ),
					'dependency'  => array( 'element' => 'heading_title_size', 'value' => 'custom' ),
				),
				
				
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Title line height', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_line_height',
					'value'            => '',
					'description'      => esc_html__( 'Leave blank if you want to use default line-height.', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Text align', 'w9-floral-addon' ),
					'param_name'       => 'heading_text_align',
					'value'            => array(
						esc_html__( 'Inherit', 'w9-floral-addon' ) => '',
						esc_html__( 'Left', 'w9-floral-addon' )    => 'text-left',
						esc_html__( 'Center', 'w9-floral-addon' )  => 'text-center',
						esc_html__( 'Right', 'w9-floral-addon' )   => 'text-right',
						esc_html__( 'Justify', 'w9-floral-addon' ) => 'text-justify'
					),
					'description'      => esc_html__( 'Select text align.', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Title letter spacing', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_ls',
					'value'            => array(
						esc_html__( 'Default CSS', 'w9-floral-addon' ) => '',
						'0em'                                           => 'ls-0',
						'0.05em'                                        => 'ls-005',
						'0.1em'                                         => 'ls-01',
						'0.15em'                                        => 'ls-015',
						'0.2em'                                         => 'ls-02'
					),
					'description'      => esc_html__( 'Select title letter spacing.', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'w9-floral-addon' ),
					'param_name'         => 'heading_color',
					'param_holder_class' => 'vc_colored-dropdown',
					'value'              => Floral_Map_Helpers::get_colors(),
					'description'        => esc_html__( 'Select Color Scheme.', 'w9-floral-addon' ),
					'edit_field_class'   => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'colorpicker',
					'heading'          => esc_html__( 'Custom color', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_custom_color',
					'value'            => '',
					'dependency'       => array(
						'element' => 'heading_color',
						'value'   => 'custom'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Select title font family', 'w9-floral-addon' ),
					'param_name'  => 'heading_title_ff',
					'value'       => array(
						esc_html__( 'Primary Font', 'w9-floral-addon' )   => 'p-font',
						esc_html__( 'Secondary Font', 'w9-floral-addon' ) => 's-font',
						esc_html__( 'Third Font', 'w9-floral-addon' )     => 't-font',
						esc_html__( 'Google Font', 'w9-floral-addon' )    => 'google-font',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'description' => esc_html__( 'Select title font family.', 'w9-floral-addon' ),
					'admin_label' => true,
					'std'         => 's-font'
				),
				
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Title text transform', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_text_transform',
					'value'            => array(
						__( 'Default', 'w9-floral-addon' )    => '',
						__( 'lowercase', 'w9-floral-addon' )  => 'text-lowercase',
						__( 'UPPERCASE', 'w9-floral-addon' )  => 'text-uppercase',
						__( 'Capitalize', 'w9-floral-addon' ) => 'text-capitalize',
					),
					'description'      => esc_html__( 'Select title text transform.', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Title font style', 'w9-floral-addon' ),
					'param_name'       => 'heading_text_fs',
					'value'            => array(
						__( 'Normal', 'w9-floral-addon' ) => '',
						__( 'Italic', 'w9-floral-addon' ) => 'fs-italic',
					),
					'description'      => esc_html__( 'Select font style.', 'w9-floral-addon' ),
					'std'              => '',
					'dependency'       => array(
						'element'            => 'heading_title_ff',
						'value_not_equal_to' => 'google-font'
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Title font weight', 'w9-floral-addon' ),
					'param_name'       => 'heading_text_fw',
					'value'            => array(
						__( 'Inherit', 'w9-floral-addon' )         => 'fw-inherit',
						__( 'Light (300)', 'w9-floral-addon' )     => 'fw-light',
						__( 'Regular (400)', 'w9-floral-addon' )   => 'fw-regular',
						__( 'Medium (500)', 'w9-floral-addon' )    => 'fw-medium',
						__( 'Semi Bold (600)', 'w9-floral-addon' ) => 'fw-semibold',
						__( 'Bold (700)', 'w9-floral-addon' )      => 'fw-bold',
					),
					'description'      => esc_html__( 'Select font weight. May be some value do not work because of the font does not support it.', 'w9-floral-addon' ),
					'std'              => 'fw-inherit',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element'            => 'heading_title_ff',
						'value_not_equal_to' => 'google-font'
					),
				),
				
				
				array(
					'type'       => 'google_fonts',
					'param_name' => 'heading_title_custom_ff',
					'value'      => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
					'settings'   => array(
						'fields' => array(
							'font_family_description' => __( 'Select font family.', 'w9-floral-addon' ),
							'font_style_description'  => __( 'Select font styling.', 'w9-floral-addon' ),
						),
					),
					'dependency' => array(
						'element' => 'heading_title_ff',
						'value'   => 'google-font',
					),
				),
				
//				array(
//					'type'       => 'checkbox',
//					'heading'    => esc_html__( 'Remove space between title and other elements', 'w9-floral-addon' ),
//					'param_name' => 'heading_title_no_space',
//					'value'      => '',
//				),
				
				// Sub Title
				array(
					'type'       => 'switcher',
					'heading'    => esc_html__( 'Sub-title', 'w9-floral-addon' ),
					'param_name' => 'heading_subtitle_enable',
					'value'      => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Data source', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_data_source',
					'value'       => array(
						esc_html__( 'Custom Content', 'w9-floral-addon' )              => 'custom-content',
						esc_html__( 'From Current Page Sub Title', 'w9-floral-addon' ) => 'page-subtitle',
					),
					'std'         => 'custom-content',
					'admin_label' => true,
					'group'       => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				array(
					'type'        => 'textarea_safe',
					'heading'     => esc_html__( 'Content', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_content',
					'value'       => '',
					'description' => esc_html__( 'Enter subtitle content.', 'w9-floral-addon' ),
					'group'       => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_subtitle_data_source',
						'value'   => 'custom-content',
					),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Size', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_size',
					'value'       => array(
						esc_html__( 'Extra Small (12px)', 'w9-floral-addon' ) => '12',
						esc_html__( 'Small (14px)', 'w9-floral-addon' )       => '14',
						esc_html__( 'Medium (16px)', 'w9-floral-addon' )      => '16',
						esc_html__( 'Large (18px)', 'w9-floral-addon' )       => '18',
						esc_html__( 'Extra Large (20px)', 'w9-floral-addon' ) => '20',
						esc_html__( 'Custom Size', 'w9-floral-addon' )        => 'custom',
					),
					'std'         => 'fz-30',
					'description' => esc_html__( 'Select heading title size.', 'w9-floral-addon' ),
					'group'       => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Custom font size', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_custom_size',
					'value'       => '',
					'description' => esc_html__( 'Enter custom font-size for the heading subtitle (Unit: px).', 'w9-floral-addon' ),
					'dependency'  => array( 'element' => 'heading_subtitle_size', 'value' => 'custom' ),
					'group'       => __( 'Sub Title', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Margin top', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_margin_top',
					'value'       => '',
					'description' => esc_html__( 'Enter the margin top for the heading subtitle (Unit: px).', 'w9-floral-addon' ),
					'group'       => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Line height', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_line_height',
					'value'            => '',
					'description'      => esc_html__( 'Leave blank if you want to use default line-height.', 'w9-floral-addon' ),
					'group'            => __( 'Sub Title', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'             => 'textfield',
					'heading'          => esc_html__( 'Max width', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_max_width',
					'description'      => esc_html__( 'Set max-width attribute for the heading subtitle (etc: 300px, 50%...).', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'            => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Text transform', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_text_transform',
					'value'            => array(
						__( 'Default', 'w9-floral-addon' )    => '',
						__( 'lowercase', 'w9-floral-addon' )  => 'text-lowercase',
						__( 'UPPERCASE', 'w9-floral-addon' )  => 'text-uppercase',
						__( 'Capitalize', 'w9-floral-addon' ) => 'text-capitalize',
					),
					'description'      => esc_html__( 'Select subtitle text transform.', 'w9-floral-addon' ),
					'std'              => '',
					'group'            => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font style', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_fs',
					'value'            => array(
						__( 'Inherit', 'w9-floral-addon' ) => 'fs-inherit',
						__( 'Normal', 'w9-floral-addon' )  => 'fs-normal',
						__( 'Italic', 'w9-floral-addon' )  => 'fs-italic',
					),
					'description'      => esc_html__( 'Select font style.', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'            => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Font weight', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_fw',
					'value'            => array(
						__( 'Inherit', 'w9-floral-addon' )         => 'fw-inherit',
						__( 'Light (300)', 'w9-floral-addon' )     => 'fw-light',
						__( 'Regular (400)', 'w9-floral-addon' )   => 'fw-regular',
						__( 'Medium (500)', 'w9-floral-addon' )    => 'fw-medium',
						__( 'Semi Bold (600)', 'w9-floral-addon' ) => 'fw-semibold',
						__( 'Bold (700)', 'w9-floral-addon' )      => 'fw-bold',
					),
					'description'      => esc_html__( 'Select font weight. May be some value do not work because of the font does not support it.', 'w9-floral-addon' ),
					'std'              => '',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
					'group'            => __( 'Sub Title', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				// separator
				array(
					'type'        => 'switcher',
					'heading'     => esc_html__( 'Separator', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_enable',
					'value'       => '',
					'admin_label' => true,
				),
				
				array(
					'type'        => 'number',
					'heading'     => esc_html__( 'Margin top', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_margin_top',
					'value'       => '',
					'description' => esc_html__( 'Enter the margin top for the separator (Unit: px).', 'w9-floral-addon' ),
					'group'       => __( 'Separator', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_separator_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Width', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_width',
					'value'       => array(
						esc_html__( 'Default', 'w9-floral-addon' )      => 'default',
						esc_html__( 'Custom Width', 'w9-floral-addon' ) => 'custom-width',
					),
					'std'         => 'default',
					'description' => esc_html__( 'Select heading separator width. Default value is 105px.', 'w9-floral-addon' ),
					'group'       => __( 'Separator', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_separator_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Custom width', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_custom_width',
					'value'       => '',
					'description' => esc_html__( 'Enter custom width for the heading separator (etc: 20px, 10em...).', 'w9-floral-addon' ),
					'dependency'  => array( 'element' => 'heading_separator_width', 'value' => 'custom-width' ),
					'group'       => __( 'Separator', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Height', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_height',
					'value'       => array(
						esc_html__( 'Default', 'w9-floral-addon' )       => 'default',
						esc_html__( 'Custom Height', 'w9-floral-addon' ) => 'custom-height',
					),
					'std'         => 'default',
					'description' => esc_html__( 'Select heading separator height. Default value is 2px.', 'w9-floral-addon' ),
					'group'       => __( 'Separator', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_separator_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Custom height', 'w9-floral-addon' ),
					'param_name'  => 'heading_separator_custom_height',
					'value'       => '',
					'description' => esc_html__( 'Enter custom height for the heading separator (etc: 20px, 10em...).', 'w9-floral-addon' ),
					'dependency'  => array( 'element' => 'heading_separator_height', 'value' => 'custom-height' ),
					'group'       => __( 'Separator', 'w9-floral-addon' ),
				),
				
				
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'w9-floral-addon' ),
					'param_name'         => 'heading_separator_color',
					'param_holder_class' => 'vc_colored-dropdown',
					'value'              => Floral_Map_Helpers::get_colors(),
					'description'        => esc_html__( 'Select Color Scheme.', 'w9-floral-addon' ),
					'group'              => __( 'Separator', 'w9-floral-addon' ),
					'dependency'         => array(
						'element' => 'heading_separator_enable',
						'value'   => '1',
					),
					'std'                => 'p'
				),
				
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Custom color', 'w9-floral-addon' ),
					'param_name' => 'heading_separator_custom_color',
					'value'      => '',
					'dependency' => array(
						'element' => 'heading_separator_color',
						'value'   => 'custom'
					),
					'group'      => __( 'Separator', 'w9-floral-addon' ),
				),
				
				// responsive title
				array(
					'type'        => 'switcher',
					'heading'     => esc_html__( 'Responsive title', 'w9-floral-addon' ),
					'param_name'  => 'heading_title_responsive_title_size',
					'description' => esc_html__( 'Enable or disable heading title font size responsive.', 'w9-floral-addon' ),
					'value'       => '',
					'group'       => __( 'Responsive', 'w9-floral-addon' )
				),
				
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Title responsive compressor', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_scale_ratio',
					'value'            => '',
					'description'      => esc_html__( 'Enter responsive compressor (etc: 1.2, 1.5, 0.6, 0.7...). This is for responsive purpose. Default value is 1.', 'w9-floral-addon' ),
					'dependency'       => array( 'element' => 'heading_title_responsive_title_size', 'value' => '1' ),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Title minimum font size', 'w9-floral-addon' ),
					'param_name'       => 'heading_title_minimum_size',
					'value'            => '',
					'description'      => esc_html__( 'Enter minimum font-size for the heading title (Unit: px). Default value is 20.', 'w9-floral-addon' ),
					'dependency'       => array( 'element' => 'heading_title_responsive_title_size', 'value' => '1' ),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				// responsive subtitle
				array(
					'type'        => 'switcher',
					'heading'     => esc_html__( 'Responsive sub-title', 'w9-floral-addon' ),
					'param_name'  => 'heading_subtitle_responsive_title_size',
					'description' => esc_html__( 'Enable or disable heading sub-title font size responsive.', 'w9-floral-addon' ),
					'value'       => '',
					'group'       => __( 'Responsive', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'heading_subtitle_enable',
						'value'   => '1',
					),
				),
				
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Sub-title responsive compressor', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_scale_ratio',
					'value'            => '',
					'description'      => esc_html__( 'Enter responsive compressor (etc: 1.2, 1.5, 0.6, 0.7...). This is for responsive purpose. Default value is 1.', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_responsive_title_size',
						'value'   => '1'
					),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'number',
					'heading'          => esc_html__( 'Sub-title minimum font size', 'w9-floral-addon' ),
					'param_name'       => 'heading_subtitle_minimum_size',
					'value'            => '',
					'description'      => esc_html__( 'Enter minimum font-size for the heading title (Unit: px). Default value is 20.', 'w9-floral-addon' ),
					'dependency'       => array(
						'element' => 'heading_subtitle_responsive_title_size',
						'value'   => '1'
					),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				// responsive text align
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Text align on tablet devices', 'w9-floral-options' ),
					'param_name'       => 'heading_text_align_on_tablet',
					'value'            => array(
						__( 'Inherit Form The Larger Size', 'w9-floral-addon' ) => '',
						__( 'Left', 'w9-floral-addon' )                         => 'text-left-on-tablet',
						__( 'Center', 'w9-floral-addon' )                       => 'text-center-on-tablet',
						__( 'Right', 'w9-floral-addon' )                        => 'text-right-on-tablet',
						__( 'Justify', 'w9-floral-addon' )                      => 'text-justify-on-tablet',
					),
					'std'              => '',
					'description'      => esc_html__( 'Screen width from 480px to 991px.', 'w9-floral-addon' ),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Text align on mobile devices', 'w9-floral-options' ),
					'param_name'       => 'heading_text_align_on_mobile',
					'value'            => array(
						__( 'Inherit Form The Larger Size', 'w9-floral-addon' ) => '',
						__( 'Left', 'w9-floral-addon' )                         => 'text-left-on-mobile',
						__( 'Center', 'w9-floral-addon' )                       => 'text-center-on-mobile',
						__( 'Right', 'w9-floral-addon' )                        => 'text-right-on-mobile',
						__( 'Justify', 'w9-floral-addon' )                      => 'text-justify-on-mobile',
					),
					'std'              => '',
					'description'      => esc_html__( 'Screen width smaller than 480px.', 'w9-floral-addon' ),
					'group'            => __( 'Responsive', 'w9-floral-addon' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column'
				),
				
				Floral_Map_Helpers::extra_class(),
				Floral_Map_Helpers::design_options(),
				Floral_Map_Helpers::design_options_on_tablet(),
				Floral_Map_Helpers::design_options_on_mobile(),
				Floral_Map_Helpers::animation_css(),
				Floral_Map_Helpers::animation_duration(),
				Floral_Map_Helpers::animation_delay()
			)
		);
	}
}

if ( ! function_exists( 'floral_sc_heading' ) ) {
	function floral_sc_heading( array $attr = array() ) {
		$var = '';
		foreach ( $attr as $key => $value ) {
			$var .= sprintf( ' %s="%s"', $key, $value );
		}
		
		echo do_shortcode( "[floral_shortcode_heading $var]" );
	}
	
}