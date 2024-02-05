<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: metabox-header.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sections[] = array(
    'title'  => esc_html__( 'Header', 'floral' ),
    'desc'   => esc_html__( 'Change the footer section configuration.', 'floral' ),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Header Settings', 'floral' ),
        ),
        
        array(
            'id'       => 'meta-header-enable',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable header?', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide header.', 'floral' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                ''    => esc_html__( 'Default', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'default'  => '',
        ),
        
        array(
            'id'       => 'meta-nav-content',
            'type'     => 'select',
            'title'    => esc_html__( 'Select menu for header', 'floral' ),
            'subtitle' => esc_html__( 'Select menu appear on header.', 'floral' ),
            'desc'     => esc_html__( 'Leave empty mean use this setting from "Theme Options".', 'floral' ),
            // Must provide key => value pairs for select options
            'options'  => floral_get_menu_list(),
            'default'  => '',
        ),
        
        array(
            'id'      => 'meta-nav-width',
            'type'    => 'select',
            'title'   => esc_html__( 'Header width', 'floral' ),
            'desc'    => esc_html__( 'Leave empty mean use this setting from "Theme Option".', 'floral' ),
            'output'  => array( '.floral-nav-body .floral-nav-logo-wrapper' ),
            'options' => array(
                ''                        => esc_html__( 'Default', 'floral' ),
                'container'               => esc_html__( 'Container', 'floral' ),
                'container-xlg'           => esc_html__( 'Container Extended', 'floral' ),
                'container-fluid'         => esc_html__( 'Container Fluid', 'floral' ),
                'container-nav-fullwidth' => esc_html__( 'Full Width', 'floral' ),
            ),
            'default' => '',
        ),
        
        array(
            'id'       => 'meta-nav-boxed-enabled',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable boxed mode', 'floral' ),
            'subtitle' => esc_html__( 'Enable boxed mode', 'floral' ),
            'options'  => array(
                ''    => esc_html__( 'Default', 'floral' ),
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' )
            ),
            'default'  => '',
            'required' => array(
                array('nav-width' , '!=', 'container-fluid'),
                array('nav-width' , '!=', 'container-nav-fullwidth'),
            )
        ),
        
        array(
            'id'       => 'meta-nav-occupy-spacing',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                ''    => esc_html__( 'Default', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Nav occupy space?', 'floral' ),
            'subtitle' => esc_html__( 'Nav occupy page space or not.', 'floral' ),
            'default'  => '',
        ),
        
        array(
            'id'             => 'meta-nav-overlay-offset-top',
            'type'           => 'spacing',
            'output'         => array( '.floral-main-header' ),
            'mode'           => 'absolute',
            'top'            => true,
            'left'           => false,
            'right'          => false,
            'bottom'         => false,
            'units'          => array( 'px' ),
            'units_extended' => true,
            'title'          => esc_html__( 'Main nav offset top', 'floral' ),
            'subtitle'       => esc_html__( 'Main nav offset top in px unit.', 'floral' ),
            'default'        => array(),
            'required'       => array(
                'meta-nav-occupy-spacing', '=', 'off'
            )
        ),
        
        array(
            'id'       => 'meta-nav-sticky',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                ''    => esc_html__( 'Default', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Enable sticky menu', 'floral' ),
            'subtitle' => esc_html__( 'Nav will be fixed on top of window when scroll down position bigger than window height.', 'floral' ),
            'default'  => '',
        ),
        array(
            'id'       => 'meta-nav-headroom',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                ''    => esc_html__( 'Default', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Enable sticky headroom', 'floral' ),
            'subtitle' => esc_html__( 'Hide sticky menu when scroll down, show it when scroll up.', 'floral' ),
            'default'  => '',
            'required' => array(
                'meta-nav-sticky', '!=', 'off'
            )
        ),
	
	    array(
		    'id'             => 'meta-nav-item-height',
		    'type'           => 'dimensions',
		    'compiler'       => true,
		    'width'          => false,
		    'units'          => 'px',
		    'output'         => array( '.floral-nav-body .floral-main-menu-content>li>a' ),
		    'units-extended' => true,
		    'title'          => esc_html__( 'Menu item height', 'floral' ),
		    'subtitle'       => esc_html__( 'Choose the nav items height.', 'floral' ),
	    ),
	
	    array(
		    'id'             => 'meta-nav-sticky-item-height',
		    'type'           => 'dimensions',
		    'compiler'       => true,
		    'width'          => false,
		    'units'          => 'px',
		    'output'         => array( '.floral-nav-body.sticky-content .floral-main-menu-content>li>a' ),
		    'units-extended' => true,
		    'title'          => esc_html__( 'Sticky menu item height', 'floral' ),
		    'subtitle'       => esc_html__( 'Choose the nav items height.', 'floral' ),
	    ),
        
        array(
            'id'       => 'meta-nav-logo-select',
            'type'     => 'select',
            'compiler' => false,
            'title'    => esc_html__( 'Select logo', 'floral' ),
            'subtitle' => esc_html__( 'Select logo from logo list in "Logo & Favicon" tab of "Theme Options".', 'floral' ),
            'options'  => array(
                ''              => esc_html__( 'Default', 'floral' ),
                'logo'          => esc_html__( 'Basic logo', 'floral' ),
                'logo-option-1' => esc_html__( 'Logo option 1', 'floral' ),
                'logo-option-2' => esc_html__( 'Logo option 2', 'floral' ),
                'logo-option-3' => esc_html__( 'Logo option 3', 'floral' ),
            ),
            'default'  => '',
        ),
	
	    array(
		    'id'       => 'meta-nav-sticky-logo-select',
		    'type'     => 'select',
		    'compiler' => false,
		    'title'    => esc_html__( 'Select logo for sticky nav', 'floral' ),
		    'subtitle' => esc_html__( 'Select logo from logo list in "Logo & Favicon" tab.', 'floral' ),
		    'options'  => array(
			    ''              => esc_html__( 'Default', 'floral' ),
			    'logo'          => esc_html__( 'Basic logo', 'floral' ),
			    'logo-option-1' => esc_html__( 'Logo option 1', 'floral' ),
			    'logo-option-2' => esc_html__( 'Logo option 2', 'floral' ),
			    'logo-option-3' => esc_html__( 'Logo option 3', 'floral' ),
		    ),
		    'default'  => '',
	    ),
	    
        //Header Style
	    array(
		    'id'       => mt_rand(),
		    'type'     => 'info',
		    'subtitle' => esc_html__( 'Static Style', 'floral' ),
	    ),
        
        array(
            'id'       => 'meta-nav-item-color',
            'output'   => array( 'color' => '.floral-nav-body' ),
            'type'     => 'color',
            'title'    => esc_html__( 'Nav item color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
            'default'  => '',
        ),
        
        array(
            'id'       => 'meta-nav-item-link-color',
            'output'   => array( '.floral-nav-body .floral-main-menu-content>li>a, .floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
            'type'     => 'link_color',
            'title'    => esc_html__( 'Nav item link color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav link color.', 'floral' ),
            'desc'     => esc_html__( 'Hover, active color available for link in nav only.', 'floral' ),
            'default'  => array()
        ),
	
	    array(
		    'id'       => 'meta-nav-link-hover-background',
		    'type'     => 'color_rgba',
		    'output'   => array( 'background-color' => '.floral-nav-body .floral-main-menu-content>li>a:hover, .floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
		    'title'    => esc_html__( 'Main nav link hover background', 'floral' ),
		    'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
		    'default'  => '',
//		    'validate' => 'color',
	    ),
        
        array(
            'id'      => 'meta-nav-background',
            'type'    => 'background',
            'output'  => array( '.floral-nav-body' ),
            'title'   => esc_html__( 'Main nav background', 'floral' ),
            'default' => array(),
        ),
        
        array(
            'id'      => 'meta-nav-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Main nav background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.floral-nav-body:not(.sticky-content):before' ),
            // See Notes below about these lines.
            //'output'    => array('background-color' => '.site-header'),
            'default' => array(),
        ),
        
        array(
            'id'      => 'meta-nav-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Nav border', 'floral' ),
            'output'  => array( '.floral-nav-body' ),
            'all'     => false,
            'color'   => false,
            'default' => array(),
        ),
        
        array(
            'id'       => 'meta-nav-border-color',
            'title'    => esc_html__( 'Nav border color', 'floral' ),
            'subtitle' => esc_html__( 'Specify the nav border color.', 'floral' ),
            'output'   => array(
                'border-color' => '.floral-nav-body'
            ),
            'type'     => 'color_rgba',
            'default'  => array(),
        ),
        
        //Nav Sticky
	    array(
		    'id'       => mt_rand(),
		    'type'     => 'info',
		    'subtitle' => esc_html__( 'Sticky Style', 'floral' ),
	    ),
	    
        array(
            'id'       => 'meta-nav-sticky-item-color',
            'output'   => array( 'color' => '.floral-nav-body.sticky-content' ),
            'type'     => 'color',
            'title'    => esc_html__( 'Sticky nav item color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
            'default'  => '',
        ),
        
        array(
            'id'       => 'meta-nav-sticky-item-link-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Sticky nav item link color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav link color.', 'floral' ),
            'output'   => array( '.floral-nav-body.sticky-content .floral-main-menu-content>li>a,.floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
            'desc'     => esc_html__( 'Hover, active color available for link in nav only.', 'floral' ),
            'default'  => array(),
        ),
	    
	    array(
		    'id'       => 'meta-nav-sticky-link-hover-background',
		    'type'     => 'color_rgba',
		    'output'   => array( 'background-color' => '.floral-nav-body.sticky-content .floral-main-menu-content>li>a:hover, .floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
		    'title'    => esc_html__( 'Sticky nav link hover background', 'floral' ),
		    'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
		    'default'  => '',
//		    'validate' => 'color',
	    ),
        
        array(
            'id'      => 'meta-nav-sticky-background',
            'type'    => 'background',
            'output'  => array( '.floral-nav-body.sticky-content' ),
            'title'   => esc_html__( 'Sticky nav background', 'floral' ),
            'default' => array(),
        ),
        
        array(
            'id'      => 'meta-nav-sticky-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Sticky nav background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.floral-nav-body.sticky-content:before' ),
            'default' => array(),
        ),
        
        array(
            'id'      => 'meta-nav-sticky-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Sticky nav border', 'floral' ),
            'output'  => array( '.floral-nav-body.sticky-content' ),
            'all'     => false,
            'color'   => false,
            'default' => array()
        ),
        
        array(
            'id'       => 'meta-nav-sticky-border-color',
            'title'    => esc_html__( 'Sticky nav border color', 'floral' ),
            'subtitle' => esc_html__( 'Specify the sticky nav border color', 'floral' ),
            'output'   => array(
                'border-color' => '.floral-nav-body.sticky-content'
            ),
            'type'     => 'color_rgba',
            'default'  => array(),
        ),
    
    ) // #fields
);