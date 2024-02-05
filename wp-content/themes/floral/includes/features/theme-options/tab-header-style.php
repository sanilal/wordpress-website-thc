<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-header-style.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Header Style', 'floral' ),
    'desc'   => esc_html__( 'Change the header section configuration.', 'floral' ),
    'icon'   => 'el-icon-star',
    'fields' => array(
        array(
            'id'       => 'nav-width',
            'type'     => 'select',
            'title'    => esc_html__( 'Header width', 'floral' ),
            'subtitle' => esc_html__( 'Select common header width in the list.', 'floral' ),
            'output'   => '.floral-nav-body .floral-nav-logo-wrapper',
            'options'  => array(
                'container'               => esc_html__( 'Container', 'floral' ),
                'container-xlg'           => esc_html__( 'Container Extended', 'floral' ),
                'container-fluid'         => esc_html__( 'Container Fluid', 'floral' ),
                'container-nav-fullwidth' => esc_html__( 'Full Width', 'floral' ),
            ),
            'default'  => 'container',
        ),
        
        array(
            'id'       => 'nav-boxed-enabled',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable boxed mode', 'floral' ),
            'subtitle' => esc_html__( 'Enable boxed mode.', 'floral' ),
            'options'  => array(
                'on'               => esc_html__( 'On', 'floral' ),
                'off'               => esc_html__( 'Off', 'floral' ),
            ),
            'default'  => 'off',
            'required' => array(
                array('nav-width' , '!=', 'container-fluid'),
                array('nav-width' , '!=', 'container-nav-fullwidth'),
            )
        ),
        
        array(
            'id'       => 'nav-occupy-spacing',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Nav occupy space?', 'floral' ),
            'subtitle' => esc_html__( 'Nav occupy page space or not.', 'floral' ),
            'default'  => 'on',
        ),
        
        array(
            'id'             => 'nav-overlay-offset-top',
            'type'           => 'spacing',
            'output'         => array( '.floral-main-header.floral-menu-overlay-wrapper' ),
            'mode'           => 'absolute',
            'top'            => true,
            'left'           => false,
            'right'          => false,
            'bottom'         => false,
            'units'          => array('px'),
            'units_extended' => true,
            'title'          => esc_html__( 'Main nav offset top', 'floral' ),
            'subtitle'       => esc_html__( 'Main nav offset top in px unit.', 'floral' ),
            'default'        => array(),
            'required'       => array(
                'nav-occupy-spacing', '=', 'off'
            )
        ),
        
        array(
            'id'       => 'nav-sticky',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Enable sticky menu', 'floral' ),
            'subtitle' => __( 'Nav will be fixed on top of window when scroll down to the position which is configured by <b>When will the sticky nav show up<b/>.', 'floral' ),
            'default'  => 'on',
        ),
	
	    array(
		    'id'             => 'nav-sticky-show-up',
		    'type'           => 'spacing',
		    'mode'           => 'absolute',
		    'top'            => true,
		    'left'           => false,
		    'right'          => false,
		    'bottom'         => false,
		    'units'          => '',
		    'units_extended' => true,
		    'title'          => esc_html__( 'When will the sticky nav show up?', 'floral' ),
		    'subtitle'       => __( 'Unit: px. If you leave the field blank, the default value will be 0. <br/> This value will be calculated from the bottom of main menu.', 'floral' ),
		    'default'        => array(),
		    'required'       => array(
			    'nav-sticky', '=', 'on'
		    )
	    ),
        
        array(
            'id'       => 'nav-headroom',
            'type'     => 'button_set',
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'title'    => esc_html__( 'Enable sticky headroom', 'floral' ),
            'subtitle' => esc_html__( 'Hide sticky menu when scroll down, show it when scroll up.', 'floral' ),
            'default'  => 'off',
            'required' => array(
                'nav-sticky', '=', 'on'
            )
        ),
        
        array(
            'id'       => 'header-nav-breakpoint',
            'height'   => false,
            'type'     => 'dimensions',
            'units'    => 'px',
            'default'  => array(
                'width' => '992px',
                'unit'  => 'px'
            ),
            'title'    => esc_html__( 'Desktop - mobile breakpoint', 'floral' ),
            'subtitle' => esc_html__( 'Desktop nav and desktop nav hide if screen width lower than breakpoint, Mobile nav and mobile module hide if screen greater than breakpoint.', 'floral' )
        ),
        
        array(
            'id'       => 'nav-item-separator',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable nav item separator', 'floral' ),
            'subtitle' => esc_html__( 'Enable separator between nav items. This option work best if header width id fullwidth.', 'floral' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' ),
            ),
            'default'  => 'off',
        ),
        
        array(
            'id'       => 'nav-item-separator-color',
            'title'    => esc_html__( 'Nav item separator color', 'floral' ),
            'subtitle' => esc_html__( 'Define nav item separator color.', 'floral' ),
            'output'   => array(
                'border-color' => '.floral-nav-enable-separator .floral-nav-item, .floral-nav-enable-separator .floral-nav-body-content'
            ),
            'type'     => 'color_rgba',
            'default'  => array(
                'color' => '#888',
                'alpha' => '0.4',
            ),
            'required' => array(
                'nav-item-separator', '=', 'on'
            )
        ),
        
        array(
            'id'       => 'nav-item-padding',
            'type'     => 'spacing',
            'mode'     => 'padding',
            'units'    => 'px',
            'top'      => false,
            'bottom'   => false,
            'title'    => esc_html__( 'Nav item padding', 'floral' ),
            'subtitle' => esc_html__( 'Define nav item padding if have separator.', 'floral' ),
            'output'   => array( '.floral-nav-enable-separator .floral-nav-item' ),
            'default'  => array(
                'padding-left'  => '20px',
                'padding-right' => '20px',
                'unit'          => 'px'
            ),
            'required' => array(
                'nav-item-separator', '=', 'on'
            )
        ),
        
        array(
            'id'       => 'nav-item-color',
            'output'   => array( 'color' => '.floral-nav-body' ),
            'type'     => 'color',
            'title'    => esc_html__( 'Nav item color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
            'default'  => '#ffffff',
        ),
        
        array(
            'id'       => 'nav-item-link-color',
            'output'   => array( '.floral-nav-body .floral-main-menu-content>li>a, .floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
            'type'     => 'link_color',
            'title'    => esc_html__( 'Nav item link color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav link color.', 'floral' ),
            'desc'     => esc_html__( 'Hover, active color available for link in nav only.', 'floral' ),
            'default'  => array(
                'regular' => '#222',
                'hover'   => '#EB6C6C',
                'active'  => '#EB6C6C',
            )
        ),
        
        array(
            'id'       => 'nav-link-hover-background',
            'type'     => 'color_rgba',
            'output'   => array( 'background-color' => '.floral-nav-body .floral-main-menu-content>li>a:hover, .floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
            'title'    => esc_html__( 'Main nav link hover background', 'floral' ),
            'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
            'default'  => '',
//            'validate' => 'color',
        ),
        
        array(
            'id'       => 'nav-menu-item-hover-effect',
            'type'     => 'select',
            'title'    => esc_html__( 'Nav menu item hover effect', 'floral' ),
            'subtitle' => esc_html__( 'Select menu item (link in menu only) hover effect.', 'floral' ),
            'options'  => array(
                'floral-menu-item-hover-none'      => esc_html__( 'None', 'floral' ),
                'floral-menu-item-hover-underline' => esc_html__( 'Underline', 'floral' ),
                'floral-menu-item-hover-bracket'   => esc_html__( 'Brackets', 'floral' ),
            ),
            'default'  => 'floral-menu-item-hover-underline',
        ),
        
        array(
            'id'      => 'nav-background',
            'type'    => 'background',
            'output'  => array( '.floral-nav-body' ),
            'title'   => esc_html__( 'Main nav background', 'floral' ),
            'default' => array(
                'background-color' => 'transparent',
            )
        ),
        
        array(
            'id'      => 'nav-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Main nav background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.floral-nav-body:not(.sticky-content):before' ),
            // See Notes below about these lines.
            //'output'    => array('background-color' => '.site-header'),
            'default' => array(
                'color' => '#F2f2f2',
                'alpha' => 1
            ),
        ),
        
        array(
            'id'      => 'nav-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Nav border', 'floral' ),
            'output'  => array( '.floral-nav-body' ),
            'all'     => false,
            'color'   => false,
            'default' => array(
                'border-style'  => 'solid',
                'border-top'    => '0',
                'border-right'  => '0',
                'border-bottom' => '1px',
                'border-left'   => '0'
            )
        ),
        
        array(
            'id'       => 'nav-border-color',
            'title'    => esc_html__( 'Nav border color', 'floral' ),
            'subtitle' => esc_html__( 'Specify the nav border color.', 'floral' ),
            'output'   => array(
                'border-color' => '.floral-nav-body'
            ),
            'type'     => 'color_rgba',
            'default'  => array(
                'color' => '#888',
                'alpha' => '0.4',
            ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Header Sticky Style.', 'floral' )
        ),
        
        array(
            'id'       => 'nav-sticky-item-color',
            'output'   => array( 'color' => '.floral-nav-body.sticky-content' ),
            'type'     => 'color',
            'title'    => esc_html__( 'Sticky nav item color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
            'default'  => '#ffffff',
        ),
        
        array(
            'id'       => 'nav-sticky-item-link-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Sticky nav item link color', 'floral' ),
            'subtitle' => esc_html__( 'Choose nav link color.', 'floral' ),
            'output'   => array( '.floral-nav-body.sticky-content .floral-main-menu-content>li>a,.floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
            'desc'     => esc_html__( 'Hover, active color available for link in nav only.', 'floral' ),
            'default'  => array(
	            'regular' => '#222',
	            'hover'   => '#EB6C6C',
	            'active'  => '#EB6C6C',
            )
        ),
        
        array(
            'id'       => 'nav-sticky-link-hover-background',
            'type'     => 'color_rgba',
            'output'   => array( 'background-color' => '.floral-nav-body.sticky-content .floral-main-menu-content>li>a:hover, .floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
            'title'    => esc_html__( 'Sticky nav link hover background', 'floral' ),
            'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
            'default'  => '',
//            'validate' => 'color',
        ),
        
        array(
            'id'      => 'nav-sticky-background',
            'type'    => 'background',
            'output'  => array( '.floral-nav-body.sticky-content' ),
            'title'   => esc_html__( 'Sticky nav background', 'floral' ),
            'default' => array(
                'background-color' => 'transparent',
            )
        ),
        
        array(
            'id'      => 'nav-sticky-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Sticky nav background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.floral-nav-body.sticky-content:before' ),
            'default' => array(
                'color' => '#f2f2f2',
                'alpha' => 1
            ),
        ),
        
        array(
            'id'      => 'nav-sticky-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Sticky nav border', 'floral' ),
            'output'  => array( '.floral-nav-body.sticky-content' ),
            'all'     => false,
            'color'   => false,
            'default' => array(
                'border-style'  => 'solid',
                'border-top'    => '0',
                'border-right'  => '0',
                'border-bottom' => '0',
                'border-left'   => '0'
            )
        ),
        
        array(
            'id'       => 'nav-sticky-border-color',
            'title'    => esc_html__( 'Nav border color', 'floral' ),
            'subtitle' => esc_html__( 'Specify the sticky nav border color.', 'floral' ),
            'output'   => array(
                'border-color' => '.floral-nav-body.sticky-content'
            ),
            'type'     => 'color_rgba',
            'default'  => array(
                'color' => '#888',
                'alpha' => '0.4',
            ),
        ),
    ) );
