<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-title.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Title Wrapper Section
*/
$content_template_list = floral_get_content_template_list();

$this->sections[] = array(
    'title'  => esc_html__( 'Title', 'floral' ),
    'desc'   => esc_html__( 'Change the page title section configuration.', 'floral' ),
    'icon'   => 'el el-minus',
    'fields' => array(
        array(
            'id'        => 'page-title-override-default',
            'type'      => 'select',
            'multi'     => true,
            'title'     => esc_html__( 'Override default settings in', 'floral' ),
            'subtitle'  => esc_html__( 'Choose which template you need to override the default settings in here.', 'floral' ),
            'desc'      => esc_html__( 'The tabs will appear after you save the change.', 'floral' ) .
                '<br />  <strong style="color: red;">' . esc_html__( 'Notice 1: If the page doesn\'t auto refresh, please refresh the page after changing and saving this option.', 'floral' ) . '</strong> </br> <strong style="color: red;">' .
                esc_html__( 'Notice 2: If an item is removed, the options will be saved automatically after the page auto refresh, please wait a bit.', 'floral' ) . '</strong>',
            'options'   => floral_get_template_prefix( 'options_field' ),
            'default'   => array(),
            'ajax_save' => false
//            'compiler' => true,
//            'reload_on_change' => true
        ),

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Default Title Settings', 'floral' )
        ),

        array(
            'id'       => 'page-title-enable',
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
            'id'       => 'page-title-content-template',
            'type'     => 'select',
            'title'    => esc_html__( 'Page title content template', 'floral' ),
            'options'  => $content_template_list,
            'desc'     => esc_html__( 'Select content template for page title.', 'floral' ),
            'default'  => '',
            'required' => array( 'page-title-enable', '=', array( 'custom' ) )
        ),


        array(
            'id'       => 'page-title-custom',
            'type'     => 'text',
            'title'    => esc_html__( 'Custom title', 'floral' ),
            'subtitle' => '',
            'default'  => '',
            'required' => array( 'page-title-enable', '=', array( 'simple', 'custom' ) ),
        ),

        array(
            'id'       => 'page-title-subtitle',
            'type'     => 'text',
            'title'    => esc_html__( 'Sub title', 'floral' ),
            'subtitle' => '',
            'desc'     => '',
            'default'  => '',
            'required' => array( 'page-title-enable', '=', array( 'simple', 'custom' ) ),
        ),

        array(
            'id'       => 'page-title-layout',
            'type'     => 'select',
            'title'    => esc_html__( 'Layout', 'floral' ),
            'subtitle' => esc_html__( 'Select page title layout', 'floral' ),
            'desc'     => '',
            'options'  => array(
	            'fullwidth'       => esc_html__( 'Full Width (overflow - hidden)', 'floral' ),
	            'fullwidth-visible'       => esc_html__( 'Full Width (overflow - visible)', 'floral' ),
	            'container'       => esc_html__( 'Container', 'floral' ),
	            'container-xlg'   => esc_html__( 'Container Extended', 'floral' ),
	            'container-fluid' => esc_html__( 'Container Fluid', 'floral' )
            ),
            'default'  => 'container',
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),

        array(
            'id'             => 'page-title-inner-padding',
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
            'required'       => array( 'page-title-enable', '=', array( 'simple' ) ),
            'output'         => array( '.site-title .site-title-inner' )
        ),
	
	    array(
		    'id'             => 'page-title-inner-wrapper-padding',
		    'type'           => 'spacing',
		    'mode'           => 'padding',
		    'units'          => 'px',
		    'units_extended' => 'false',
		    'title'          => esc_html__( 'Page title inner wrapper padding', 'floral' ),
		    'subtitle'       => esc_html__( 'Set page title inner wrapper left/right padding.', 'floral' ),
		    'desc'           => '',
		    'top'           => false,
		    'bottom'          => false,
		    'required'       => array( 'page-title-enable', '=', array( 'simple' ) ),
		    'output'         => array( '.site-title .site-title-inner-wrapper' )
	    ),

        array(
            'id'             => 'page-title-margin-bottom',
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
            'required'       => array( 'page-title-enable', '=', array( 'simple' ) ),
            'output'         => array( '.site-title' )
        ),

        array(
            'id'       => 'page-title-background',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Title background', 'floral' ),
            'compiler' => 'true',
            'subtitle' => esc_html__( 'Upload any media using the WordPress native uploader. <b>Notice: The background will never show if you are not set an opacity value for the background color. See the option Color Style.</b>', 'floral' ),
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
            'default' => array(
	            'url' => floral_theme_url(). 'assets/images/title-bg-default.jpg'
            )
        ),

        array(
            'id'       => 'page-title-parallax-effect',
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
            'validate' => 'not_empty',
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),


        array(
            'id'       => 'page-title-parallax-position',
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
            'validate' => 'not_empty',
            'required' => array(
                array( 'page-title-enable', '=', array( 'simple' ) ),
                array( 'page-title-parallax-effect', 'not_empty_and', 'no-effect' ),
            ),
        ),

        array(
            'id'       => 'title-random-number-1',
            'type'     => 'info',
            'subtitle' => esc_html__('Page Title Style Configurations', 'floral' ),
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),

        array(
            'id'       => 'page-title-text-align',
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
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),
	
	    array(
		    'id'       => 'title-subtitle-custom-style',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Enable custom style for title and subtitle ?', 'floral' ),
//		    'subtitle' => esc_html__( 'Smooth animation when scrolling the page.', 'floral' ),
		    'desc'     => '',
		    'default'  => 0,
		    'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
	    ),
	    
	    //--- Title and subtitle option ---

        array(
            'id'          => 'title-text-typo',
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
            'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
            'output'      => array( '.site-title .site-title-inner h1.title' )
        ),
	
	    array(
		    'id'       => 'title-font-style',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Title font style', 'floral' ),
		    'options'  => array(
			    '' => esc_html__( 'Default', 'floral' ),
			    'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
			    'fs-normal' => esc_html__( 'Normal', 'floral' ),
			    'fs-italic' => esc_html__( 'Italic', 'floral' ),
		    ),
		    'default'  => '',
		    'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
	    ),

        array(
            'id'       => 'title-text-transform',
            'type'     => 'select',
            'title'    => esc_html__( 'Title text transform', 'floral' ),
            'subtitle' => '',
            'desc'     => '',
            'options'  => array(
                'text-transform-__' => esc_html__( 'Normal', 'floral' ),
                'text-capitalize' => esc_html__( 'Capitalize', 'floral' ),
                'text-uppercase'  => esc_html__( 'Uppercase', 'floral' ),
            ),
            'default'  => 'text-uppercase',
            'validate' => 'not_empty',
            'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
        ),
	
	    array(
		    'id'             => 'title-margin-bottom',
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
		    'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
		    'output'         => array( '.site-title .site-title-inner h1.title' )
	    ),
	
	    array(
		    'id'          => 'subtitle-text-typo',
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
		    'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
		    'output'      => array( '.site-title .site-title-inner p.sub-title' )
	    ),
	
	    array(
		    'id'       => 'subtitle-font-style',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Subtitle font style', 'floral' ),
		    'options'  => array(
			    'fs-__' => esc_html__( 'Default', 'floral' ),
			    'fs-inherit' => esc_html__( 'Inherit', 'floral' ),
			    'fs-normal' => esc_html__( 'Normal', 'floral' ),
			    'fs-italic' => esc_html__( 'Italic', 'floral' ),
		    ),
		    'default'  => 'fs-italic',
		    'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
	    ),
	
	    array(
		    'id'       => 'subtitle-text-transform',
		    'type'     => 'select',
		    'title'    => esc_html__( 'Subtitle text transform', 'floral' ),
		    'subtitle' => '',
		    'desc'     => '',
		    'options'  => array(
			    'text-transform-__' => esc_html__( 'Normal', 'floral' ),
			    'text-capitalize' => esc_html__( 'Capitalize', 'floral' ),
			    'text-uppercase'  => esc_html__( 'Uppercase', 'floral' ),
		    ),
		    'default'  => 'text-transform-__',
		    'validate' => 'not_empty',
			    'required'    => array( 'title-subtitle-custom-style', '=', array( '1' ) ),
	    ),
	
	    //--- === ---

        array(
            'id'       => 'page-title-style',
            'type'     => 'select',
            'title'    => esc_html__( 'Color style', 'floral' ),
            'subtitle' => esc_html__( 'Choose style for the title wrapper.', 'floral' ),
            'options'  => array(
                'bg-gray-lighter'   => esc_html__( 'Light gray background, dark text', 'floral' ),
                'bg-gray'           => esc_html__( 'Gray background, dark text', 'floral' ),
                'bg-dark-lighter'   => esc_html__( 'Dark gray background,  light text', 'floral' ),
                'bg-dark'           => esc_html__( 'Black background, white text', 'floral' ),
                'bg-white'          => esc_html__( 'White background, dark text', 'floral' ),
                'bg-custom'         => esc_html__( 'Custom', 'floral' ),
                'bg-dark-alpha-30'  => esc_html__( 'Dark 30%', 'floral' ),
                'bg-dark-alpha-50'  => esc_html__( 'Dark 50%', 'floral' ),
                'bg-dark-alpha-70'  => esc_html__( 'Dark 70%', 'floral' ),
                'bg-light-alpha-30' => esc_html__( 'Light 30%', 'floral' ),
                'bg-light-alpha-50' => esc_html__( 'Light 50%', 'floral' ),
                'bg-light-alpha-70' => esc_html__( 'Light 70%', 'floral' ),
            ),
            'default'  => 'bg-light-alpha-30',
            'validate' => 'not_empty',
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
            'compiler' => true
        ),

        array(
            'id'       => 'page-title-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text color', 'floral' ),
            'subtitle' => esc_html__( 'Pick a color for page title.', 'floral' ),
            'transparent' => false,
            'default'  => '#444',
            'validate' => 'color',
            'required' => array(
                array( 'page-title-enable', '=', array( 'simple' ) ),
                array( 'page-title-style', '=', array( 'bg-custom' ) )
            ),
            'compiler' => true
//            'output'   => array( 'color' => '.site-title' )
        ),

        array(
            'id'       => 'page-title-bg-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Background color', 'floral' ),
            'subtitle' => esc_html__( 'Pick a background color for page title.', 'floral' ),
            'default'  => array(
                'color' => '#fff',
                'alpha' => 0.7,
                'rgba'  => 'rgba(255, 255, 255, 0.7)'
            ),
            'validate' => 'colorrgba',
            'required' => array(
                array( 'page-title-enable', '=', array( 'simple' ) ),
                array( 'page-title-style', '=', array( 'bg-custom' ) )
            ),
//            'output'   => array( 'background-color' => '.site-title' )
            'compiler' => true
        ),

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Breadcrumb Configurations', 'floral' ),
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),

        array(
            'id'       => 'page-title-breadcrumbs',
            'type'     => 'switch',
            'title'    => esc_html__( 'Breadcrumbs', 'floral' ),
            'subtitle' => esc_html__( 'Enable/disable breadcrumbs in pages title.', 'floral' ),
            'desc'     => '',
            'default'  => '1',
            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
        ),
	    
	    //--- Breadcrumbs option ----
	
//	    array(
//		    'id'       => 'breadcrumbs-prepended-text',
//		    'type'     => 'text',
//		    'title'    => esc_html__( 'Prepended text', 'floral' ),
//		    'subtitle'     => esc_html__('Breadcrumbs prepended text', 'floral'),
//		    'default'  =>  esc_html__( 'You are here:', 'floral' ),
//		    'required' => array( 'page-title-breadcrumbs', '=', array( '1' ) ),
//	    ),
	
	    array(
		    'id'       => 'breadcrumbs-position',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Breadcrumbs position', 'floral' ),
		    'options'  => array(
			    'left' => esc_html__( 'Left', 'floral' ),
			    'right' => esc_html__( 'Right', 'floral' ),
		    ),
		    'default'  => 'right',
		    'required' => array( 'page-title-breadcrumbs', '=', array( '1' ) ),
	    ),
	
//	    array(
//		    'id'       => 'breadcrumbs-custom-style',
//		    'type'     => 'switch',
//		    'title'    => esc_html__( 'Enable custom style for title and subtitle ?', 'floral' ),
//		    'desc'     => '',
//		    'default'  => '0',
//		    'required' => array( 'page-title-breadcrumbs', '=', array( '1' ) ),
//	    ),
	
//	    array(
//		    'id'       => 'breadcrumbs-text-color',
//		    'type'     => 'color',
//		    'title'    => esc_html__( 'Breadcrumbs text color', 'floral' ),
//		    'transparent' => false,
//		    'default'  => '#fff',
//		    'validate' => 'color',
//		    'required' => array(
//			    array( 'breadcrumbs-custom-style', '=', array( '1' ) ),
//		    ),
//		    'compiler' => true
////            'output'   => array( 'color' => '.site-title' )
//	    ),
//
//	    array(
//		    'id'       => 'breadcrumbs-bg-color',
//		    'type'     => 'color_rgba',
//		    'title'    => esc_html__( 'Breadcrumbs background color', 'floral' ),
//		    'default'  => array(
//			    'color' => '#000',
//			    'alpha' => 0.6,
//			    'rgba'  => 'rgba(0, 0, 0, 0.6)'
//		    ),
//		    'validate' => 'colorrgba',
//		    'required' => array(
//			    array( 'breadcrumbs-custom-style', '=', array( '1' ) ),
//		    ),
////            'output'   => array( 'background-color' => '.site-title' )
//		    'compiler' => true
//	    ),

//        array(
//            'id'       => 'page-title-breadcrumbs-float-mode',
//            'type'     => 'switch',
//            'title'    => esc_html__( 'Breadcrumbs float mode', 'floral' ),
//            'subtitle' => esc_html__( 'Enable/Disable Breadcrumbs Float Mode In Pages Title', 'floral' ),
//            'desc'     => esc_html__( 'If on, the breadcrumb will be floating along with the page title text align.', 'floral' ),
//            'default'  => '1',
//            'required' => array( 'page-title-enable', '=', array( 'simple' ) ),
//        ),
//
//
//        array(
//            'id'       => 'page-title-breadcrumbs-align',
//            'type'     => 'button_set',
//            'title'    => esc_html__( 'Breadcrumbs align', 'floral' ),
//            'subtitle' => esc_html__( 'Set breadcrumbs align.', 'floral' ),
//            'desc'     => '',
//            'options'  => array(
//                'left'   => esc_html__( 'Left', 'floral' ),
//                'center' => esc_html__( 'Center', 'floral' ),
//                'right'  => esc_html__( 'Right', 'floral' )
//            ),
//            'default'  => 'left',
//            'required' => array(
//                array( 'page-title-enable', '=', array( 'simple' ) ),
//                array( 'page-title-breadcrumbs', '=', array( '1' ) ),
//                array( 'page-title-breadcrumbs-float-mode', '=', array( '0' ) ),
//            ),
//        ),

    ), // #fields
);