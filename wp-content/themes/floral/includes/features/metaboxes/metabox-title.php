<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-title.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
 * Title Wrapper Section
*/

$content_template_list = floral_get_content_template_list();

$sections[] = array(
	'title'  => esc_html__( 'Page Title', 'floral' ),
	'desc'   => esc_html__( 'Change the page title section configuration.', 'floral' ),
	'icon'   => 'el el-minus',
	'fields' => array(
		
		array(
			'id'       => 'meta-page-title-custom',
			'type'     => 'text',
			'title'    => esc_html__( 'Custom title', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'default'  => '',
//            'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-page-title-subtitle',
			'type'     => 'text',
			'title'    => esc_html__( 'Sub title', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'default'  => '',
//            'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-page-title-enable',
			'type'     => 'select',
			'title'    => esc_html__( 'Page title template', 'floral' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'floral' ),
			'options'  => array(
				''       => esc_html__( 'Default', 'floral' ),
				'simple' => esc_html__( 'Simple', 'floral' ),
				'custom' => esc_html__( 'Content Template', 'floral' ),
				'off'    => esc_html__( 'Off', 'floral' )
			),
			'default'  => '',
		),
		
		array(
			'id'       => 'meta-page-title-content-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Page title content template', 'floral' ),
			'options'  => $content_template_list,
			'desc'     => esc_html__( 'Select content template for page title.', 'floral' ),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'custom', '' ) )
		),
		
		array(
			'id'       => 'meta-page-title-layout',
			'type'     => 'select',
			'title'    => esc_html__( 'Layout', 'floral' ),
			'subtitle' => esc_html__( 'Select page title layout', 'floral' ),
			'desc'     => '',
			'options'  => array(
				''                  => esc_html__( 'Default', 'floral' ),
				'fullwidth'         => esc_html__( 'Full Width (overflow - hidden)', 'floral' ),
				'fullwidth-visible' => esc_html__( 'Full Width (overflow - visible)', 'floral' ),
				'container'         => esc_html__( 'Container', 'floral' ),
				'container-xlg'     => esc_html__( 'Container Extended', 'floral' ),
				'container-fluid'   => esc_html__( 'Container Fluid', 'floral' )
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'             => 'meta-page-title-inner-padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Padding', 'floral' ),
			'subtitle'       => esc_html__( 'Set page title top/bottom padding.', 'floral' ),
			'desc'           => '',
			'left'           => false,
			'right'          => false,
			'default'        => array(),
			'required'       => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
			'output'         => array( 'section.site-title.page-title .site-title-inner' )
		),
		
		array(
			'id'             => 'meta-page-title-inner-wrapper-padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Page title inner wrapper padding', 'floral' ),
			'subtitle'       => esc_html__( 'Set page title inner wrapper left/right padding.', 'floral' ),
			'desc'           => '',
			'top'            => false,
			'bottom'         => false,
			'required'       => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
			'output'         => array( 'section.site-title.page-title .site-title-inner-wrapper' )
		),
		
		array(
			'id'             => 'meta-page-title-margin-bottom',
			'type'           => 'spacing',
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Margin bottom', 'floral' ),
			'subtitle'       => esc_html__( 'Set page title bottom margin.', 'floral' ),
			'desc'           => '',
			'left'           => false,
			'right'          => false,
			'top'            => false,
			'default'        => array(),
			'required'       => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
			'output'         => array( 'section.site-title.page-title' )
		),
		
		array(
			'id'       => 'meta-page-title-background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Title background', 'floral' ),
			'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader.', 'floral' ),
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-page-title-parallax-effect',
			'type'     => 'select',
			'title'    => esc_html__( 'Parallax effect', 'floral' ),
			'subtitle' => esc_html__( 'Choose parallax effect for the background image.', 'floral' ),
			'options'  => array(
				''          => esc_html__( 'Default', 'floral' ),
				'no-effect' => esc_html__( 'No effect', 'floral' ),
				'0.0'       => '0.0',
				'0.05'      => '0.05',
				'0.1'       => '0.1',
				'0.2'       => '0.2',
				'0.3'       => '0.3',
				'0.4'       => '0.4',
				'0.5'       => '0.5',
				'0.6'       => '0.6',
				'0.7'       => '0.7',
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		
		array(
			'id'       => 'meta-page-title-parallax-position',
			'type'     => 'select',
			'title'    => esc_html__( 'Parallax vertical position', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'top'    => esc_html__( 'Top', 'floral' ),
				'center' => esc_html__( 'Center', 'floral' ),
				'bottom' => esc_html__( 'Bottom', 'floral' ),
			),
			'default'  => '',
			'required' => array(
				array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
				array( 'meta-page-title-parallax-effect', 'not_empty_and', 'no-effect' ),
			),
		),
		
		array(
			'id'       => 'meta-title-random-number-1',
			'type'     => 'info',
			'title'    => esc_html__( 'Page title style configurations', 'floral' ),
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		// typo
		
		array(
			'id'       => 'meta-page-title-text-align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Text align', 'floral' ),
			'subtitle' => esc_html__( 'Set Page Title Text Align', 'floral' ),
			'desc'     => '',
			'options'  => array(
				''            => esc_html__( 'Default', 'floral' ),
				'text-left'   => esc_html__( 'Left', 'floral' ),
				'text-center' => esc_html__( 'Center', 'floral' ),
				'text-right'  => esc_html__( 'Right', 'floral' )
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-title-subtitle-custom-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Enable custom style for title and subtitle ?', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'1' => 'On',
				''  => 'Default',
				'0' => 'Off',
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'          => 'meta-title-text-typo',
			'type'        => 'typography',
			'title'       => esc_html__( 'Title text typo', 'floral' ),
			'subtitle'    => esc_html__( 'Config typography for title text.', 'floral' ),
			'desc'        => '',
			'units'       => 'px',
//            'font-family' => false,
			'subsets'     => false,
			'font-backup' => false,
			'fonts'       => false,
			'text-align'  => false,
			'color'       => false,
			'font-style'  => false,
			'preview'     => false,
			'line-height' => false,
			'default'     => array(),
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
			'output'      => array( 'section.site-title .site-title-inner h1.title' ),
		),
		
		array(
			'id'       => 'meta-title-font-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Title font style', 'floral' ),
			'options'  => array(
				'' => esc_html__( 'Default', 'floral' ),
				'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
				'fs-normal' => esc_html__( 'Normal', 'floral' ),
				'fs-italic' => esc_html__( 'Italic', 'floral' ),
			),
			'default'  => '',
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
		),
		
		array(
			'id'       => 'meta-title-text-transform',
			'type'     => 'select',
			'title'    => esc_html__( 'Title text transform', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'' => esc_html__( 'Default', 'floral' ),
				'text-transform-__' => esc_html__( 'Normal', 'floral' ),
				'text-capitalize' => esc_html__( 'Capitalize', 'floral' ),
				'text-uppercase'  => esc_html__( 'Uppercase', 'floral' ),
			),
			'default'  => '',
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
		),
		
		array(
			'id'             => 'meta-title-margin-bottom',
			'type'           => 'spacing',
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Title margin bottom', 'floral' ),
			'subtitle'       => esc_html__( 'Set title bottom margin.', 'floral' ),
			'desc'           => '',
			'left'           => false,
			'right'          => false,
			'top'            => false,
			'default'        => array(),
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
			'output'         => array( 'section.site-title .site-title-inner h1.title' )
		),
		
		array(
			'id'          => 'meta-subtitle-text-typo',
			'type'        => 'typography',
			'title'       => esc_html__( 'Subtitle text typo', 'floral' ),
			'subtitle'    => esc_html__( 'Config typography for subtitle text.', 'floral' ),
			'desc'        => '',
			'units'       => 'px',
//            'font-family' => false,
			'subsets'     => false,
			'font-backup' => false,
			'fonts'       => false,
			'text-align'  => false,
			'color'       => false,
			'font-style'  => false,
			'preview'     => false,
			'line-height' => false,
			'default'     => array(),
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
			'output'      => array( 'section.site-title .site-title-inner p.sub-title' )
		),
		
		array(
			'id'       => 'meta-subtitle-font-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Subtitle font style', 'floral' ),
			'options'  => array(
				'' => esc_html__( 'Default', 'floral' ),
				'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
				'fs-normal' => esc_html__( 'Normal', 'floral' ),
				'fs-italic' => esc_html__( 'Italic', 'floral' ),
			),
			'default'  => '',
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
		),
		
		array(
			'id'       => 'meta-subtitle-text-transform',
			'type'     => 'select',
			'title'    => esc_html__( 'Subtitle text transform', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'' => esc_html__( 'Default', 'floral' ),
				'text-transform-__' => esc_html__( 'Normal', 'floral' ),
				'text-capitalize' => esc_html__( 'Capitalize', 'floral' ),
				'text-uppercase'  => esc_html__( 'Uppercase', 'floral' ),
			),
			'default'  => '',
			'validate' => 'not_empty',
			'required'    => array( 'meta-title-subtitle-custom-style', '=', array( '1') ),
		),
		
		array(
			'id'       => 'meta-page-title-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Style', 'floral' ),
			'subtitle' => esc_html__( 'Choose style for the title wrapper.', 'floral' ),
			'options'  => array(
				''                  => esc_html__( 'Default', 'floral' ),
				'bg-gray-lighter'   => esc_html__( 'Light gray background, dark text', 'floral' ),
				'bg-gray'           => esc_html__( 'Gray background, dark text', 'floral' ),
				'bg-dark-lighter'   => esc_html__( 'Dark gray background,  light text', 'floral' ),
				'bg-dark'           => esc_html__( 'Black background, white text', 'floral' ),
				'bg-white'          => esc_html__( 'White background, dark text', 'floral' ),
				'bg-dark-alpha-30'  => esc_html__( 'Dark 30%', 'floral' ),
				'bg-dark-alpha-50'  => esc_html__( 'Dark 50%', 'floral' ),
				'bg-dark-alpha-70'  => esc_html__( 'Dark 70%', 'floral' ),
				'bg-light-alpha-30' => esc_html__( 'Light 30%', 'floral' ),
				'bg-light-alpha-50' => esc_html__( 'Light 50%', 'floral' ),
				'bg-light-alpha-70' => esc_html__( 'Light 70%', 'floral' ),
				'bg-custom'         => esc_html__( 'Custom', 'floral' ),
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-page-title-text-color',
			'type'     => 'color',
			'title'    => esc_html__( 'Text color', 'floral' ),
			'subtitle' => esc_html__( 'Pick a color for page title.', 'floral' ),
			'default'  => '',
			'validate' => 'color',
			'required' => array(
				array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
				array( 'meta-page-title-style', '=', array( 'bg-custom' ) )
			)
		),
		
		array(
			'id'       => 'meta-page-title-bg-color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background color', 'floral' ),
			'subtitle' => esc_html__( 'Pick a background color for page title.', 'floral' ),
			'default'  => array(),
			'validate' => 'colorrgba',
			'required' => array(
				array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
				array( 'meta-page-title-style', '=', array( 'bg-custom' ) )
			)
		),
		
		array(
			'id'       => 'meta-title-random-number-2',
			'type'     => 'info',
			'title'    => 'Breadcrumb configurations',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
		array(
			'id'       => 'meta-page-title-breadcrumbs',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Breadcrumbs', 'floral' ),
			'subtitle' => esc_html__( 'Enable/disable breadcrumbs in pages title.', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'1' => 'On',
				''  => 'Default',
				'0' => 'Off',
			),
			'default'  => '',
			'required' => array( 'meta-page-title-enable', '=', array( 'simple', '' ) ),
		),
		
//		array(
//			'id'       => 'meta-breadcrumbs-prepended-text',
//			'type'     => 'text',
//			'title'    => esc_html__( 'Prepended text', 'floral' ),
//			'subtitle'     => esc_html__('Breadcrumbs prepended text', 'floral'),
//			'default'  =>  '',
//			'required' => array( 'meta-page-title-breadcrumbs', '=', array( '1' ) ),
//		),
		
		array(
			'id'       => 'meta-breadcrumbs-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Breadcrumbs position', 'floral' ),
			'options'  => array(
				'' => esc_html__( 'Default', 'floral' ),
				'left' => esc_html__( 'Left', 'floral' ),
				'right' => esc_html__( 'Right', 'floral' ),
			),
			'default'  => '',
			'required' => array( 'meta-page-title-breadcrumbs', '=', array( '1' ) ),
		),
//
//		array(
//			'id'       => 'meta-breadcrumbs-custom-style',
//			'type'     => 'switch',
//			'title'    => esc_html__( 'Enable custom style for title and subtitle ?', 'floral' ),
//			'desc'     => '',
//			'default'  => '0',
//			'required' => array( 'meta-page-title-breadcrumbs', '=', array( '1' ) ),
//		),
//
//		array(
//			'id'       => 'meta-breadcrumbs-text-color',
//			'type'     => 'color',
//			'title'    => esc_html__( 'Breadcrumbs text color', 'floral' ),
//			'transparent' => false,
//			'default'  => '',
//			'validate' => 'color',
//			'required' => array(
//				array( 'meta-breadcrumbs-custom-style', '=', array( '1' ) ),
//			),
//		),
//
//		array(
//			'id'       => 'meta-breadcrumbs-bg-color',
//			'type'     => 'color_rgba',
//			'title'    => esc_html__( 'Breadcrumbs background color', 'floral' ),
//			'default'  => array(),
//			'validate' => 'colorrgba',
//			'required' => array(
//				array( 'meta-breadcrumbs-custom-style', '=', array( '1' ) ),
//			),
//		),
	),
);