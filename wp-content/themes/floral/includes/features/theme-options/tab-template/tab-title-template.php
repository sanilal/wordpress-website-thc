<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-title-template.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$content_template_list = floral_get_content_template_list();
$template_name         = floral_get_template_prefix( 'name', $template );
$template_name_lower   = strtolower( $template_name );

$this->sections[] = array(
	'title'      => $template_name . esc_html__( ' Page Title', 'floral' ),
	'desc'       => sprintf( esc_html__( 'Change the %s title section configuration.', 'floral' ), $template_name_lower ),
	'icon'       => 'fa fa-plus-circle',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => $template_name . esc_html__( ' Title Settings', 'floral' ),
		),
		
		array(
			'id'       => $template . 'page-title-enable',
			'type'     => 'select',
			'title'    => esc_html__( 'Page title template', 'floral' ),
			'subtitle' => esc_html__( 'If on, this layout part will be displayed.', 'floral' ),
			'options'  => array(
				'simple' => esc_html__( 'Simple', 'floral' ),
				'custom' => esc_html__( 'Content Template', 'floral' ),
				'off'    => esc_html__( 'Off', 'floral' )
			),
			'default'  => 'simple',
		),
		
		array(
			'id'       => $template . 'page-title-content-template',
			'type'     => 'select',
			'title'    => esc_html__( 'Page title content template', 'floral' ),
			'options'  => $content_template_list,
			'desc'     => esc_html__( 'Select content template for page title.', 'floral' ),
			'default'  => '',
			'required' => array( $template . 'page-title-enable', '=', array( 'custom' ) )
		),
		
		
		array(
			'id'       => $template . 'page-title-custom',
			'type'     => 'text',
			'title'    => esc_html__( 'Custom title', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'default'  => '',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple', 'custom' ) ),
		),
		
		
		array(
			'id'       => $template . 'page-title-subtitle',
			'type'     => 'text',
			'title'    => esc_html__( 'Sub title', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'default'  => '',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple', 'custom' ) ),
		),
		
		array(
			'id'       => $template . 'page-title-layout',
			'type'     => 'select',
			'title'    => esc_html__( 'Layout', 'floral' ),
			'subtitle' => esc_html__( 'Select page title layout', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'fullwidth'         => esc_html__( 'Full Width (overflow - hidden)', 'floral' ),
				'fullwidth-visible' => esc_html__( 'Full Width (overflow - visible)', 'floral' ),
				'container'         => esc_html__( 'Container', 'floral' ),
				'container-xlg'     => esc_html__( 'Container Extended', 'floral' ),
				'container-fluid'   => esc_html__( 'Container Fluid', 'floral' )
			),
			'default'  => 'container',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		array(
			'id'             => $template . 'page-title-inner-padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Page title inner padding', 'floral' ),
			'subtitle'       => esc_html__( 'Set page title inner top/bottom padding.', 'floral' ),
			'desc'           => '',
			'left'           => false,
			'right'          => false,
			'default'        => array(
				'padding-top'    => '95px',
				'padding-bottom' => '70px',
				'units'          => 'px',
			),
			'required'       => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
			'output'         => array( '.site-title.' . $template . ' .site-title-inner' )
		),
		
		array(
			'id'             => $template . 'page-title-inner-wrapper-padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => esc_html__( 'Page title inner wrapper padding', 'floral' ),
			'subtitle'       => esc_html__( 'Set page title inner wrapper left/right padding.', 'floral' ),
			'desc'           => '',
			'top'            => false,
			'bottom'         => false,
			'required'       => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
			'output'         => array( '.site-title.' . $template . ' .site-title-inner-wrapper' )
		),
		
		array(
			'id'             => $template . 'page-title-margin-bottom',
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
			'default'        => array(
				'margin-bottom' => '80px',
				'units'         => 'px',
			),
			'required'       => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
			'output'         => array( '.site-title.' . $template )
		),
		
		array(
			'id'       => $template . 'page-title-background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Title background', 'floral' ),
			'compiler' => 'true',
			'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader.', 'floral' ),
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
			'default'  => array(
				'url' => floral_theme_url() . 'assets/images/title-bg-default.jpg'
			)
		),
		
		array(
			'id'       => $template . 'page-title-parallax-effect',
			'type'     => 'select',
			'title'    => esc_html__( 'Parallax effect', 'floral' ),
			'subtitle' => esc_html__( 'Choose parallax effect for the background image.', 'floral' ),
			'options'  => array(
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
			'default'  => 'no-effect',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		
		array(
			'id'       => $template . 'page-title-parallax-position',
			'type'     => 'select',
			'title'    => esc_html__( 'Parallax vertical position', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'top'    => esc_html__( 'Top', 'floral' ),
				'center' => esc_html__( 'Center', 'floral' ),
				'bottom' => esc_html__( 'Bottom', 'floral' ),
			),
			'default'  => 'center',
			'required' => array(
				array( $template . 'page-title-enable', '=', array( 'simple' ) ),
				array( $template . 'page-title-parallax-effect', 'not_empty_and', 'no-effect' ),
			),
		),
		
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => $template_name . esc_html__( ' Title Style Configurations', 'floral' ),
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		//
		
		
		array(
			'id'       => $template . 'page-title-text-align',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Text align', 'floral' ),
			'subtitle' => esc_html__( 'Set Page Title Text Align', 'floral' ),
			'desc'     => '',
			'options'  => array(
				'text-left'   => esc_html__( 'Left', 'floral' ),
				'text-center' => esc_html__( 'Center', 'floral' ),
				'text-right'  => esc_html__( 'Right', 'floral' )
			),
			'default'  => 'text-left',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		array(
			'id'       => $template . 'title-subtitle-custom-style',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable custom style for title and subtitle ?', 'floral' ),
//		    'subtitle' => esc_html__( 'Smooth animation when scrolling the page.', 'floral' ),
			'desc'     => '',
			'default'  => 0,
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		//--- Title and subtitle option ---
		
		array(
			'id'          => $template . 'title-text-typo',
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
			'default'     => array(
				'font-family' => 'Poppins',
				'font-weight' => '600',
				'font-size'   => '48px',
			),
			'required'    => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
			'output'      => array( '.site-title.' . $template . ' .site-title-inner h1.title' )
		),
		
		array(
			'id'       => $template . 'title-font-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Title font style', 'floral' ),
			'options'  => array(
				''           => esc_html__( 'Default', 'floral' ),
				'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
				'fs-normal'  => esc_html__( 'Normal', 'floral' ),
				'fs-italic'  => esc_html__( 'Italic', 'floral' ),
			),
			'default'  => '',
			'required' => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
		),
		
		array(
			'id'       => $template . 'title-text-transform',
			'type'     => 'select',
			'title'    => esc_html__( 'Title text transform', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'text-transform-__' => esc_html__( 'Normal', 'floral' ),
				'text-capitalize'   => esc_html__( 'Capitalize', 'floral' ),
				'text-uppercase'    => esc_html__( 'Uppercase', 'floral' ),
			),
			'default'  => 'text-uppercase',
			'validate' => 'not_empty',
			'required' => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
		),
		
		array(
			'id'             => $template . 'title-margin-bottom',
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
			'default'        => array(
				'margin-bottom' => '10px',
				'units'         => 'px',
			),
			'required'       => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
			'output'         => array( '.site-title.' . $template . ' .site-title-inner h1.title' )
		),
		
		array(
			'id'          => $template . 'subtitle-text-typo',
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
			'default'     => array(
				'font-family' => 'Playfair Display',
				'font-weight' => '400',
				'font-size'   => '18px',
			),
			'required'    => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
			'output'      => array( '.site-title.' . $template . ' .site-title-inner p.sub-title' )
		),
		
		array(
			'id'       => $template . 'subtitle-font-style',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Subtitle font style', 'floral' ),
			'options'  => array(
				'fs-__'      => esc_html__( 'Default', 'floral' ),
				'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
				'fs-normal'  => esc_html__( 'Normal', 'floral' ),
				'fs-italic'  => esc_html__( 'Italic', 'floral' ),
			),
			'default'  => 'fs-italic',
			'required' => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
		),
		
		array(
			'id'       => $template . 'subtitle-text-transform',
			'type'     => 'select',
			'title'    => esc_html__( 'Subtitle text transform', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array(
				'text-transform-__' => esc_html__( 'Normal', 'floral' ),
				'text-capitalize'   => esc_html__( 'Capitalize', 'floral' ),
				'text-uppercase'    => esc_html__( 'Uppercase', 'floral' ),
			),
			'default'  => 'text-transform-__',
			'validate' => 'not_empty',
			'required' => array( $template . 'title-subtitle-custom-style', '=', array( '1' ) ),
		),
		
		
		//
		
		array(
			'id'       => $template . 'page-title-style',
			'type'     => 'select',
			'title'    => esc_html__( 'Color style', 'floral' ),
			'subtitle' => esc_html__( 'Choose style for the title wrapper.', 'floral' ),
			'options'  => array(
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
			'default'  => 'bg-light-alpha-30',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
			'compiler' => true
		),
		
		array(
			'id'       => $template . 'page-title-text-color',
			'type'     => 'color',
			'title'    => esc_html__( 'Text color', 'floral' ),
			'subtitle' => esc_html__( 'Pick a color for page title.', 'floral' ),
			'default'  => '#444',
			'required' => array(
				array( $template . 'page-title-enable', '=', array( 'simple' ) ),
				array( $template . 'page-title-style', '=', array( 'bg-custom' ) )
			),
			'compiler' => true
		),
		
		array(
			'id'       => $template . 'page-title-bg-color',
			'type'     => 'color_rgba',
			'title'    => esc_html__( 'Background color', 'floral' ),
			'subtitle' => esc_html__( 'Pick a background color for page title.', 'floral' ),
			'default'  => array(
				'color' => '#fff',
				'alpha' => 0.7,
				'rgba'  => 'rgba(255, 255, 255, 0.7)'
			),
			'required' => array(
				array( $template . 'page-title-enable', '=', array( 'simple' ) ),
				array( $template . 'page-title-style', '=', array( 'bg-custom' ) )
			),
			'compiler' => true
		),
		
		array(
			'id'       => mt_rand(),
			'type'     => 'info',
			'subtitle' => 'Breadcrumb Configurations',
			'required' => array( $template . 'page-title-enable.', '=', array( 'simple' ) ),
		),
		
		array(
			'id'       => $template . 'page-title-breadcrumbs',
			'type'     => 'switch',
			'title'    => esc_html__( 'Breadcrumbs', 'floral' ),
			'subtitle' => esc_html__( 'Enable/disable breadcrumbs in pages title.', 'floral' ),
			'desc'     => '',
			'default'  => '1',
			'required' => array( $template . 'page-title-enable', '=', array( 'simple' ) ),
		),
		
		//--- Breadcrumbs option ----

//	    array(
//		    'id'       => $template . 'breadcrumbs-prepended-text',
//		    'type'     => 'text',
//		    'title'    => esc_html__( 'Prepended text', 'floral' ),
//		    'subtitle'     => esc_html__('Breadcrumbs prepended text', 'floral'),
//		    'default'  =>  esc_html__( 'You are here:', 'floral' ),
//		    'required' => array( $template . 'page-title-breadcrumbs', '=', array( '1' ) ),
//	    ),
		
		array(
			'id'       => $template . 'breadcrumbs-position',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Breadcrumbs position', 'floral' ),
			'options'  => array(
				'left'  => esc_html__( 'Left', 'floral' ),
				'right' => esc_html__( 'Right', 'floral' ),
			),
			'default'  => 'right',
			'required' => array( $template . 'page-title-breadcrumbs', '=', array( '1' ) ),
		),
	), // #fields
);