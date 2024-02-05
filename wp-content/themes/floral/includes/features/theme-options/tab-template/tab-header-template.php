<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-header.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$content_template_list = floral_get_content_template_list();
$template_name         = floral_get_template_prefix( 'name', $template );
$template_name_lower   = strtolower( $template_name );

$this->sections[] = array(
    'title'      => $template_name . esc_html__( ' Header', 'floral' ),
    'desc'       => sprintf( esc_html__( 'Change the %s header section configuration.', 'floral' ), $template_name_lower ),
    'icon'       => 'fa fa-plus-circle',
    'subsection' => true,
    'fields'     => array(

        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Header Settings', 'floral' ),
        ),
        
        array(
            'id'       => $template . 'header-enable',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Enable header?', 'floral' ),
            'subtitle' => esc_html__( 'Show or hide header.', 'floral' ),
            'options'  => array(
                'on'  => esc_html__( 'On', 'floral' ),
                'off' => esc_html__( 'Off', 'floral' )
            ),
            'default'  => 'on',
        ),
	    
        array(
            'id'       => $template . 'nav-content',
            'type'     => 'select',
            'title'    => esc_html__( 'Select menu for header', 'floral' ),
            'subtitle' => esc_html__( 'Select menu for page, if you leave it empty it will get primary menu of your site.', 'floral' ),
            // Must provide key => value pairs for select options
            'options'  => floral_get_menu_list(),
            'default'  => 'primary',
        ),
	    
        array(
            'id'      => $template . 'nav-module-desktop',
            'type'    => 'sorter',
            'title'   => esc_html__( 'Nav module in desktop', 'floral' ),
            'desc'    => esc_html__( 'Select nav module appear in normal desktop nav, you also use this for sorter position of module in nav.', 'floral' ),
            'options' => array(
                'enabled'  => array(
                    'logo'      => esc_html__( 'Logo', 'floral' ),
                    'main-menu' => esc_html__( 'Main Menu', 'floral' ),
                    'search'    => esc_html__( 'Search', 'floral' ),
                    'cart'      => esc_html__( 'Cart', 'floral' ),
                ),
                'disabled' => array(
                    'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
                    'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
                    'popup'            => esc_html__( 'Popup', 'floral' ),
                    'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
                )
            ),
        ),
        
        array(
            'id'       => $template . 'nav-module-desktop-sticky',
            'type'     => 'sorter',
            'title'    => esc_html__( 'Nav module in desktop sticky nav', 'floral' ),
            'subtitle' => esc_html__( 'Select nav module appear in sticky nav in desktop screen, you also use this for sorter position of module in nav.', 'floral' ),
            'options'  => array(
                'enabled'  => array(
                    'logo'      => esc_html__( 'Logo', 'floral' ),
                    'main-menu' => esc_html__( 'Main Menu', 'floral' ),
                    'search'    => esc_html__( 'Search', 'floral' ),
                    'cart'      => esc_html__( 'Cart', 'floral' ),
                ),
                'disabled' => array(
                    'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
                    'popup'            => esc_html__( 'Popup', 'floral' ),
                    'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
                    'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
                )
            ),
        ),
        
        array(
            'id'      => $template . 'nav-module-mobile',
            'type'    => 'sorter',
            'title'   => esc_html__( 'Nav module in mobile', 'floral' ),
            'desc'    => esc_html__( 'Select nav module appear in sticky nav in desktop screen, you also use this for sorter position of module in nav.', 'floral' ),
            'options' => array(
                'enabled'  => array(
                    'logo'            => esc_html__( 'Logo', 'floral' ),
                    'toggle-leftzone' => esc_html__( 'Toggle Left Zone', 'floral' ),
                ),
                'disabled' => array(
                    'search'           => esc_html__( 'Search', 'floral' ),
                    'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
                    'cart'             => esc_html__( 'Cart', 'floral' ),
                    'popup'            => esc_html__( 'Popup', 'floral' ),
                    'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
                )
            ),
        ),
        
        array(
            'id'      => $template . 'nav-module-desktop-biggest',
            'type'    => 'select',
            'title'   => esc_html__( 'Biggest module in desktop screen', 'floral' ),
            'options' => array(
                'logo'             => esc_html__( 'Logo', 'floral' ),
                'main-menu'        => esc_html__( 'Main Menu', 'floral' ),
                'cart'             => esc_html__( 'Cart', 'floral' ),
                'search'           => esc_html__( 'Search', 'floral' ),
                'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
                'popup'            => esc_html__( 'Popup', 'floral' ),
                'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
                'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
            ),
            'default' => 'main-menu'
        ),
        
        array(
            'id'      => $template . 'nav-module-desktop-biggest-align',
            'type'    => 'button_set',
            'title'   => esc_html__( 'Biggest module in desktop screen align', 'floral' ),
            'options' => array(
                'nav-item-desktop-left'   => esc_html__( 'Left', 'floral' ),
                'nav-item-desktop-center' => esc_html__( 'Center', 'floral' ),
                'nav-item-desktop-right'  => esc_html__( 'Right', 'floral' ),
            ),
            'default' => 'nav-item-desktop-right'
        ),
        
        array(
            'id'      => $template . 'nav-module-mobile-biggest',
            'type'    => 'select',
            'title'   => esc_html__( 'Biggest module in mobile screen', 'floral' ),
            'options' => array(
                'logo'             => esc_html__( 'Logo', 'floral' ),
                'cart'             => esc_html__( 'Cart', 'floral' ),
                'search'           => esc_html__( 'Search', 'floral' ),
                'custom-content'   => esc_html__( 'Custom Content', 'floral' ),
                'popup'            => esc_html__( 'Popup', 'floral' ),
                'toggle-leftzone'  => esc_html__( 'Toggle Left Zone', 'floral' ),
                'toggle-rightzone' => esc_html__( 'Toggle Right Zone', 'floral' ),
            ),
            'default' => 'logo'
        ),
        
        array(
            'id'      => $template . 'nav-module-mobile-biggest-align',
            'type'    => 'button_set',
            'title'   => esc_html__( 'Biggest module in mobile screen align', 'floral' ),
            'options' => array(
                'nav-item-mobile-left'   => esc_html__( 'Left', 'floral' ),
                'nav-item-mobile-center' => esc_html__( 'Center', 'floral' ),
                'nav-item-mobile-right'  => esc_html__( 'Right', 'floral' ),
            ),
            'default' => 'nav-item-mobile-left'
        ),
	    
	    // !!!!!!!!!!!!!!!!!!!!
	    array(
		    'id'       => mt_rand(),
		    'type'     => 'info',
		    'subtitle' => esc_html__( 'Header Style.', 'floral' )
	    ),
	
	    array(
		    'id'       => $template . 'nav-width',
		    'type'     => 'select',
		    'title'    => esc_html__( 'Header width', 'floral' ),
		    'subtitle' => esc_html__( 'Select common header width in the list.', 'floral' ),
		    'output'   => '.main-header.' . $template . ' ' . '.floral-nav-body .floral-nav-logo-wrapper',
		    'options'  => array(
			    'container'               => esc_html__( 'Container', 'floral' ),
			    'container-xlg'           => esc_html__( 'Container Extended', 'floral' ),
			    'container-fluid'         => esc_html__( 'Container Fluid', 'floral' ),
			    'container-nav-fullwidth' => esc_html__( 'Full Width', 'floral' ),
		    ),
		    'default'  => 'container',
	    ),
	
	    array(
		    'id'       => $template . 'nav-boxed-enabled',
		    'type'     => 'button_set',
		    'title'    => esc_html__( 'Enable boxed mode', 'floral' ),
		    'subtitle' => esc_html__( 'Enable boxed mode.', 'floral' ),
		    'options'  => array(
			    'on'               => esc_html__( 'On', 'floral' ),
			    'off'               => esc_html__( 'Off', 'floral' ),
		    ),
		    'default'  => 'off',
		    'required' => array(
			    array($template . 'nav-width' , '!=', 'container-fluid'),
			    array($template . 'nav-width' , '!=', 'container-nav-fullwidth'),
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-occupy-spacing',
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
		    'id'             => $template . 'nav-overlay-offset-top',
		    'type'           => 'spacing',
		    'output'         => array( '.main-header.' . $template . ' ' . '.floral-main-header.floral-menu-overlay-wrapper' ),
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
			    $template . 'nav-occupy-spacing', '=', 'off'
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-sticky',
		    'type'     => 'button_set',
		    'options'  => array(
			    'on'  => esc_html__( 'On', 'floral' ),
			    'off' => esc_html__( 'Off', 'floral' ),
		    ),
		    'title'    => esc_html__( 'Enable sticky menu', 'floral' ),
		    'subtitle' => esc_html__( 'Nav will be fixed on top of window when scroll down position bigger than window height.', 'floral' ),
		    'default'  => 'on',
	    ),
	
	    array(
		    'id'       => $template . 'nav-headroom',
		    'type'     => 'button_set',
		    'options'  => array(
			    'on'  => esc_html__( 'On', 'floral' ),
			    'off' => esc_html__( 'Off', 'floral' ),
		    ),
		    'title'    => esc_html__( 'Enable sticky headroom', 'floral' ),
		    'subtitle' => esc_html__( 'Hide sticky menu when scroll down, show it when scroll up.', 'floral' ),
		    'default'  => 'off',
		    'required' => array(
			    $template . 'nav-sticky', '=', 'on'
		    )
	    ),
	
	    array(
		    'id'       => $template . 'header-nav-breakpoint',
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
		    'id'       => $template . 'nav-item-separator',
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
		    'id'       => $template . 'nav-item-separator-color',
		    'title'    => esc_html__( 'Nav item separator color', 'floral' ),
		    'subtitle' => esc_html__( 'Define nav item separator color.', 'floral' ),
		    'output'   => array(
			    'border-color' => '.main-header.' . $template . ' ' . '.floral-nav-enable-separator .floral-nav-item, ' . '.main-header.' . $template . ' ' . '.floral-nav-enable-separator .floral-nav-body-content'
		    ),
		    'type'     => 'color_rgba',
		    'default'  => array(
			    'color' => '#888',
			    'alpha' => '0.4',
		    ),
		    'required' => array(
			    $template . 'nav-item-separator', '=', 'on'
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-item-padding',
		    'type'     => 'spacing',
		    'mode'     => 'padding',
		    'units'    => 'px',
		    'top'      => false,
		    'bottom'   => false,
		    'title'    => esc_html__( 'Nav item padding', 'floral' ),
		    'subtitle' => esc_html__( 'Define nav item padding if have separator.', 'floral' ),
		    'output'   => array( '.main-header.' . $template . ' ' . '.floral-nav-enable-separator .floral-nav-item' ),
		    'default'  => array(
			    'padding-left'  => '20px',
			    'padding-right' => '20px',
			    'unit'          => 'px'
		    ),
		    'required' => array(
			    $template . 'nav-item-separator', '=', 'on'
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-item-color',
		    'output'   => array( 'color' => '.main-header.' . $template . ' ' . '.floral-nav-body' ),
		    'type'     => 'color',
		    'title'    => esc_html__( 'Nav item color', 'floral' ),
		    'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
		    'default'  => '#ffffff',
	    ),
	
	    array(
		    'id'       => $template . 'nav-item-link-color',
		    'output'   => array( '.main-header.' . $template . ' ' . '.floral-nav-body .floral-main-menu-content>li>a, ' . '.main-header.' . $template . ' ' . '.floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
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
		    'id'       => $template . 'nav-link-hover-background',
		    'type'     => 'color_rgba',
		    'output'   => array( 'background-color' => '.main-header.' . $template . ' ' . '.floral-nav-body .floral-main-menu-content>li>a:hover, ' . '.main-header.' . $template . ' ' . '.floral-nav-body .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
		    'title'    => esc_html__( 'Main nav link hover background', 'floral' ),
		    'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
		    'default'  => '',
//		    'validate' => 'color',
	    ),
	
	    array(
		    'id'       => $template . 'nav-menu-item-hover-effect',
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
		    'id'      => $template . 'nav-background',
		    'type'    => 'background',
		    'output'  => array( '.main-header.' . $template . ' ' . '.floral-nav-body' ),
		    'title'   => esc_html__( 'Main nav background', 'floral' ),
		    'default' => array(
			    'background-color' => 'transparent',
		    )
	    ),
	
	    array(
		    'id'      => $template . 'nav-background-overlay',
		    'type'    => 'color_rgba',
		    'title'   => esc_html__( 'Main nav background overlay', 'floral' ),
		    'output'  => array( 'background-color' => '.main-header.' . $template . ' ' . '.floral-nav-body:not(.sticky-content):before' ),
		    // See Notes below about these lines.
		    //'output'    => array('background-color' => '.site-header'),
		    'default' => array(
			    'color' => '#f2f2f2',
			    'alpha' => 1
		    ),
	    ),
	
	    array(
		    'id'      => $template . 'nav-border',
		    'type'    => 'border',
		    'title'   => esc_html__( 'Nav border', 'floral' ),
		    'output'  => array( '.main-header.' . $template . ' ' . '.floral-nav-body' ),
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
		    'id'       => $template . 'nav-border-color',
		    'title'    => esc_html__( 'Nav border color', 'floral' ),
		    'subtitle' => esc_html__( 'Specify the nav border color.', 'floral' ),
		    'output'   => array(
			    'border-color' => '.main-header.' . $template . ' ' . '.floral-nav-body'
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
		    'id'       => $template . 'nav-sticky-item-color',
		    'output'   => array( 'color' => '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content' ),
		    'type'     => 'color',
		    'title'    => esc_html__( 'Sticky nav item color', 'floral' ),
		    'subtitle' => esc_html__( 'Choose nav color.', 'floral' ),
		    'default'  => '#ffffff',
	    ),
	
	    array(
		    'id'       => $template . 'nav-sticky-item-link-color',
		    'type'     => 'link_color',
		    'title'    => esc_html__( 'Sticky nav item link color', 'floral' ),
		    'subtitle' => esc_html__( 'Choose nav link color.', 'floral' ),
		    'output'   => array( '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content .floral-main-menu-content>li>a, ' . '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a' ),
		    'desc'     => esc_html__( 'Hover, active color available for link in nav only.', 'floral' ),
		    'default'  => array(
			    'regular' => '#222',
	            'hover'   => '#EB6C6C',
	            'active'  => '#EB6C6C',
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-sticky-link-hover-background',
		    'type'     => 'color_rgba',
		    'output'   => array( 'background-color' => '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content .floral-main-menu-content>li>a:hover,' . '.main-header.' . $template . ' ' .  '.floral-nav-body.sticky-content .floral-nav-item:not(.floral-nav-main-menu-wrapper) a:hover' ),
		    'title'    => esc_html__( 'Sticky nav link hover background', 'floral' ),
		    'subtitle' => esc_html__( 'Choose link background color when hover.', 'floral' ),
		    'default'  => '',
//		    'validate' => 'color',
	    ),
	
	    array(
		    'id'      => $template . 'nav-sticky-background',
		    'type'    => 'background',
		    'output'  => array( '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content' ),
		    'title'   => esc_html__( 'Sticky nav background', 'floral' ),
		    'default' => array(
			    'background-color' => 'transparent',
		    )
	    ),
	
	    array(
		    'id'      => $template . 'nav-sticky-background-overlay',
		    'type'    => 'color_rgba',
		    'title'   => esc_html__( 'Sticky nav background overlay', 'floral' ),
		    'output'  => array( 'background-color' => '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content:before' ),
		    'default' => array(
			    'color' => '#f2f2f2',
			    'alpha' => 1
		    ),
	    ),
	
	    array(
		    'id'      => $template . 'nav-sticky-border',
		    'type'    => 'border',
		    'title'   => esc_html__( 'Sticky nav border', 'floral' ),
		    'output'  => array( '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content' ),
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
		    'id'       => $template . 'nav-sticky-border-color',
		    'title'    => esc_html__( 'Nav border color', 'floral' ),
		    'subtitle' => esc_html__( 'Specify the sticky nav border color.', 'floral' ),
		    'output'   => array(
			    'border-color' => '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content'
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
		    'subtitle' => esc_html__( 'Logo', 'floral' )
	    ),
	
	    array(
		    'id'       => $template . 'nav-logo-select',
		    'type'     => 'select',
		    'compiler' => false,
		    'title'    => esc_html__( 'Select logo', 'floral' ),
		    'subtitle' => esc_html__( 'Select logo from logo list in "Logo & Favicon" tab.', 'floral' ),
		    'options'  => array(
			    'logo'          => esc_html__( 'Basic logo', 'floral' ),
			    'logo-option-1' => esc_html__( 'Logo option 1', 'floral' ),
			    'logo-option-2' => esc_html__( 'Logo option 2', 'floral' ),
			    'logo-option-3' => esc_html__( 'Logo option 3', 'floral' ),
		    ),
		    'default'  => 'logo',
	    ),
	
	    array(
		    'id'             => $template . 'nav-logo-height',
		    'type'           => 'dimensions',
		    'compiler'       => true,
		    'width'          => false,
		    'units'          => 'px',
		    'output'         => array( '.main-header.' . $template . ' ' . '.floral-nav-body .floral-nav-logo-wrapper img' ),
		    'units-extended' => true,
		    'title'          => esc_html__( 'Nav logo height', 'floral' ),
		    'subtitle'       => esc_html__( 'Allow your users to choose the nav items height.', 'floral' ),
		    'default'        => array(
			    'height' => '40px',
			    'units'  => 'px',
		    )
	    ),
	
	    array(
		    'id'       => $template . 'nav-sticky-logo-select',
		    'type'     => 'select',
		    'compiler' => false,
		    'title'    => esc_html__( 'Select logo for sticky nav', 'floral' ),
		    'subtitle' => esc_html__( 'Select logo from logo list in "Logo & Favicon" tab.', 'floral' ),
		    'options'  => array(
			    'logo'          => esc_html__( 'Basic logo', 'floral' ),
			    'logo-option-1' => esc_html__( 'Logo option 1', 'floral' ),
			    'logo-option-2' => esc_html__( 'Logo option 2', 'floral' ),
			    'logo-option-3' => esc_html__( 'Logo option 3', 'floral' ),
		    ),
		    'default'  => 'logo',
	    ),
	
	    array(
		    'id'             => $template . 'nav-sticky-logo-height',
		    'type'           => 'dimensions',
		    'compiler'       => true,
		    'width'          => false,
		    'units'          => 'px',
		    'output'         => array( '.main-header.' . $template . ' ' . '.floral-nav-body.sticky-content .floral-nav-logo-wrapper img' ),
		    'units-extended' => true,
		    'title'          => esc_html__( 'Sticky nav logo height', 'floral' ),
		    'subtitle'       => esc_html__( 'Allow your users to choose the nav items height.', 'floral' ),
		    'default'        => array(
			    'height' => '40px',
			    'units'  => 'px',
		    )
	    ),
	    
    
    ), // #fields
);