<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$maintenance_mode = array();
if ( floral_get_current_preset() === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
	$maintenance_mode = array(
		array(
			'id'   => 'general-random-number-4',
			'type' => 'info',
			'desc' => esc_html__( 'Maintenance Mode', 'floral' )
		),
		array(
			'id'       => 'maintenance-mode',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Maintenance mode', 'floral' ),
			'subtitle' => '',
			'desc'     => '',
			'options'  => array( '2' => 'On (Custom Page)', '1' => 'On (Standard)', '0' => 'Off', ),
			'default'  => '0'
		),
		array(
			'id'       => 'maintenance-mode-page',
			'type'     => 'select',
			'data'     => 'pages',
			'title'    => esc_html__( 'Custom maintenance mode page', 'floral' ),
			'subtitle' => esc_html__( 'if you would like to show a custom page instead of the standard WordPress message, select the page that is your maintenance page.', 'floral' ),
			'desc'     => '',
			'default'  => '',
			'required' => array( 'maintenance-mode', '=', '2' )
		)
	);
}

$this->sections[] = array(
	'title'  => esc_html__( 'General Settings', 'floral' ),
	'desc'   => esc_html__( 'Configure easily the basic theme\'s settings.', 'floral' ),
	'icon'   => 'el-icon-adjust-alt',
	'fields' => array_merge(
		array(
			array(
				'id'   => 'general-random-number-1',
				'type' => 'info',
				'desc' => esc_html__( 'General Settings', 'floral' )
			),
			array(
				'id'       => 'smooth-scroll',
				'type'     => 'switch',
				'title'    => esc_html__( 'Smooth scroll', 'floral' ),
				'subtitle' => esc_html__( 'Smooth animation when scrolling the page.', 'floral' ),
				'desc'     => '',
				'default'  => 0
			),
			
			array(
				'id'       => 'custom-scroll',
				'type'     => 'switch',
				'title'    => esc_html__( 'Custom scroll bar', 'floral' ),
				'subtitle' => esc_html__( 'Enable or disable custom scroll bar.', 'floral' ),
				'desc'     => '',
				'default'  => 0
			),
			
			
			array(
				'id'       => 'custom-scroll-width',
				'type'     => 'dimensions',
				'title'    => esc_html__( 'Custom scroll bar width', 'floral' ),
				'desc'     => esc_html__( 'This must be numeric (no px) or empty.', 'floral' ),
				'units'    => 'px',
				'height'   => false,
				'default'  => array(
					'width' => '10'
				),
				'validate' => 'not_empty',
				'output'   => array( 'body::-webkit-scrollbar' ),
				'required' => array( 'custom-scroll', '=', array( '1' ) ),
			),
			
			array(
				'id'                    => 'custom-scroll-color',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Custom scroll bar color', 'floral' ),
				'subtitle'              => esc_html__( 'Set custom scroll bar color.', 'floral' ),
				'background-repeat'     => false,
				'background-attachment' => false,
				'background-position'   => false,
				'background-image'      => false,
				'preview'               => false,
				'transparent'           => false,
				'background-size'       => false,
				'validate'              => 'color',
				'required'              => array( 'custom-scroll', '=', array( '1' ) ),
				'default'               => array(
					'background-color' => '#eee',
				),
				'output'                => array( 'body::-webkit-scrollbar' ),
			),
			
			array(
				'id'                    => 'custom-scroll-thumb-color',
				'type'                  => 'background',
				'title'                 => esc_html__( 'Custom scroll bar thumb color', 'floral' ),
				'subtitle'              => esc_html__( 'Set custom scroll bar thumb color.', 'floral' ),
				'background-repeat'     => false,
				'background-attachment' => false,
				'background-position'   => false,
				'background-image'      => false,
				'preview'               => false,
				'transparent'           => false,
				'background-size'       => false,
				'validate'              => 'color',
				'default'               => array(
					'background-color' => '#fff',
				),
				'required'              => array( 'custom-scroll', '=', array( '1' ) ),
				'output'                => array( 'body::-webkit-scrollbar-thumb' ),
			),
			
			array(
				'id'       => 'back-to-top',
				'type'     => 'switch',
				'title'    => esc_html__( 'Back to top', 'floral' ),
				'subtitle' => esc_html__( 'Enable or disable back to top button.', 'floral' ),
				'desc'     => '',
				'default'  => '1'
			),

//        array(
//            'id'       => 'panel-selector',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Panel selector', 'floral' ),
//            'subtitle' => esc_html__( 'Enable or disable panel selector.', 'floral' ),
//            'desc'     => '',
//            'default'  => '0'
//        ),
			array(
				'id'       => 'rtl-mode',
				'type'     => 'switch',
				'title'    => esc_html__( 'Force RTL mode', 'floral' ),
				'subtitle' => esc_html__( 'Force enable rtl mode.', 'floral' ),
				'desc'     => '',
				'default'  => '0'
			),
			array(
				'id'       => 'input-style',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Input style', 'floral' ),
				'subtitle' => esc_html__( 'Select global input style.', 'floral' ),
				'desc'     => '',
				'options'  => array(
					'normal'        => esc_html__( 'Normal', 'floral' ),
					'border-bottom' => esc_html__( 'Bottom Line', 'floral' ),
				),
				'compiler' => true,
				'default'  => 'normal'
			),
			
			array(
				'id'       => 'widget-title-style',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Widget title style', 'floral' ),
				'subtitle' => esc_html__( 'Select general widget title style.', 'floral' ),
				'desc'     => '',
				'options'  => array(
					'style-1' => esc_html__( 'Style 1', 'floral' ),
					'style-2' => esc_html__( 'Style 2', 'floral' ),
				),
				'default'  => 'style-1'
			),
			
			array(
				'id'      => 'google-map-api',
				'type'    => 'text',
				'title'   => esc_html__( 'Google map API key', 'floral' ),
				'desc'    => sprintf( esc_html__( 'Enter your google map api key, very important option if you want to use Floral Google Maps shortcode. %s', 'floral' ), '<br/><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">' . esc_html__( 'Read the google map documentation for more information.', 'floral' ) . '</a>' ),
				'default' => '',
			),
			array(
				'id'   => 'general-random-number-2',
				'type' => 'info',
				'desc' => esc_html__( 'Performances', 'floral' )
			),
			array(
				'id'       => 'use-min-files',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use compressed CSS & Script files', 'floral' ),
				'subtitle' => esc_html__( 'Enable this option will speed up your page performance.', 'floral' ),
				'desc'     => '',
				'default'  => '0',
				'compiler' => true,
			),
			
			array(
				'id'   => 'general-random-number-3',
				'type' => 'info',
				'desc' => esc_html__( 'Body Settings', 'floral' )
			),
			array(
				'id'       => 'body-layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Body layout', 'floral' ),
				'subtitle' => esc_html__( 'Select the layout style of page body.', 'floral' ),
				'desc'     => '',
				'options'  => array(
					'wide'     => array(
						'title' => 'Wide',
						'img'   => floral_theme_url() . 'assets/images/layout-wide.png'
					),
					'boxed'    => array(
						'title' => 'Boxed',
						'img'   => floral_theme_url() . 'assets/images/layout-boxed.png'
					),
					'extended' => array(
						'title' => 'Extended',
						'img'   => floral_theme_url() . 'assets/images/layout-extended.png'
					),
					'float'    => array(
						'title' => 'Float',
						'img'   => floral_theme_url() . 'assets/images/layout-float.png'
					)
				),
				'default'  => 'wide'
			),
			array(
				'id'       => 'body-background',
				'type'     => 'background',
				'title'    => esc_html__( 'Body background', 'floral' ),
				'subtitle' => esc_html__( 'Config the style for body background.', 'floral' ),
				'output'   => array( 'Body' ), // An array of CSS selectors to apply this font style to dynamically
				'default'  => array(
					'background-color'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-attachment' => 'fixed',
					'background-size'       => 'cover'
				),
				'required' => array( 'body-layout', '!=', 'wide' )
			),
			array(
				'id'       => 'site-content-background',
				'type'     => 'background',
				'title'    => esc_html__( 'Site content background', 'floral' ),
				'subtitle' => esc_html__( 'Config the style for site content background.', 'floral' ),
				'output'   => array( '#page.site' ),
				// An array of CSS selectors to apply this font style to dynamically
				'default'  => array(
					'background-color'      => '',
					'background-repeat'     => 'no-repeat',
					'background-position'   => 'center center',
					'background-attachment' => 'fixed',
					'background-size'       => 'cover'
				),
			)
		),
		$maintenance_mode
	),
);