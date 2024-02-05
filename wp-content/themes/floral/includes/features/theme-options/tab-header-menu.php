<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-header-menu.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'      => esc_html__( 'Header Menu Settings', 'floral' ),
    'desc'       => '',
    'icon'       => 'el el-lines',
    'fields'     => array(
    
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__('Main Menu Setting', 'floral')
        ),
	
	    array(
		    'id'       => 'scroll-set-submenu-position',
		    'type'     => 'switch',
		    'title'    => esc_html__( 'Change position (top or bottom) for submenu when scroll', 'floral' ),
//		    'subtitle' => esc_html__( 'Enable auto mode .', 'floral' ),
		    'default'  => 1,
	    ),

        array(
            'id'          => 'header-menu-font',
            'type'        => 'typography',
            'title'       => esc_html__( 'Menu font', 'floral' ),
            'subtitle'    => esc_html__( 'Specify the menu font properties.', 'floral' ),
            'google'      => true,
            'fonts'       => floral_get_preset_fonts(),
            'line-height' => false,
            'all_styles'  => true, // Enable all Google Font style/weight variations to be added to the page
            'color'       => false,
            'text-align'  => false,
            'font-style'  => true,
            'subsets'     => false,
            'font-size'   => true,
            'font-weight' => true,
            'output' => array('.floral-nav-body .floral-main-menu-content>li>a'),
            'units'       => 'px', // Defaults to px
            'default'     => array(
                'font-family' => 'Poppins',
                'font-size' => '14px',
                'font-weight' => '500'
            ),
            'compiler' => false
        ),


        array(
            'id'             => 'nav-menu-item-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'top'            => false,
            'bottom'         => false,
            'units'          => 'px',
            'output'         => array( '.floral-nav-body .floral-main-menu-content>li>a' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Menu item padding', 'floral' ),
            'default'        => array(
                'padding-left'  => '20px',
                'padding-right' => '20px',
                'units'         => 'px',
            )
        ),
    
        array(
            'id'             => 'nav-item-height',
            'type'           => 'dimensions',
            'compiler'       => true,
            'width'          => false,
            'units'          => 'px',
            'output'         => array( '.floral-nav-body .floral-main-menu-content>li>a' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Menu item height', 'floral' ),
            'subtitle'       => esc_html__( 'Choose the nav items height.', 'floral' ),
            'default'        => array(
                'height' => '80px',
                'units'  => 'px',
            )
        ),
        
        array(
            'id'             => 'nav-sticky-item-height',
            'type'           => 'dimensions',
            'compiler'       => true,
            'width'          => false,
            'units'          => 'px',
            'output'         => array( '.floral-nav-body.sticky-content .floral-main-menu-content>li>a' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sticky menu item height', 'floral' ),
            'subtitle'       => esc_html__( 'Choose the nav items height.', 'floral' ),
            'default'        => array(
                'height' => '60px',
                'units'  => 'px',
            )
        ),
    
        array(
            'id'    => 'info-normal',
            'type'  => 'info',
            'title' => esc_html__( 'Sub Menu Setting', 'floral' )
        ),


        array(
            'id'          => 'header-submenu-font',
            'type'        => 'typography',
            'title'       => esc_html__( 'Menu font', 'floral' ),
            'subtitle'    => esc_html__( 'Specify the menu font properties.', 'floral' ),
            'google'      => true,
            'fonts'       => floral_get_preset_fonts(),
            'line-height' => false,
            'all_styles'  => true, // Enable all Google Font style/weight variations to be added to the page
            'color'       => false,
            'text-align'  => false,
            'font-style'  => true,
            'subsets'     => false,
            'font-size'   => true,
            'font-weight' => true,
            'output' => array('.floral-nav-body .floral-main-menu-content > .menu-item .sub-menu .menu-item > a'),
            'units'       => 'px', // Defaults to px
            'default'     => array(
                'font-family' => 'Poppins',
                'font-size' => '12px',
                'font-weight' => '400'
            ),
            'compiler' => false
        ),


        array(
            'id'       => 'menu-sub-appear-effect',
            'type'     => 'select',
            'title'    => esc_html__( 'Sub menu appear effect', 'floral' ),
            'subtitle' => esc_html__( 'Select sub menu appear effect.', 'floral' ),
            // Must provide key => value pairs for select options
            'options'  => array(
                'floral-effect-none'       => esc_html__( 'None', 'floral' ),
                'floral-effect-fade'       => esc_html__( 'Fade', 'floral' ),
                'floral-effect-fade-up'    => esc_html__( 'Fade In Up', 'floral' ),
                'floral-effect-fade-down'  => esc_html__( 'Fade In Down', 'floral' ),
                'floral-effect-fade-left'  => esc_html__( 'Fade In Left', 'floral' ),
                'floral-effect-fade-right' => esc_html__( 'Fade In Right', 'floral' ),
                'floral-effect-dropdown'   => esc_html__( 'Drop down', 'floral' ),
            ),
            'default'  => 'floral-effect-fade',
        ),
        
        array(
            'id'      => 'menu-sub-border',
            'type'    => 'border',
            'title'   => esc_html__( 'Sub menu border', 'floral' ),
            'output'  => array( '.floral-main-menu-content .floral-tree-menu .sub-menu, .floral-main-menu-content .floral-mega-menu >.sub-menu ' ),
            'all'     => false,
            'default' => array(
                'border-color'  => 'transparent',
                'border-style'  => 'solid',
                'border-top'    => '1px',
                'border-right'  => '1px',
                'border-bottom' => '1px',
                'border-left'   => '1px'
            )
        ),
        
        array(
            'id'             => 'menu-sub-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'output'         => array( '.floral-main-menu-content .sub-menu' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sub menu padding', 'floral' ),
            'default'        => array(
                'padding-left'   => '0px',
                'padding-right'  => '0px',
                'padding-top'    => '15px',
                'padding-bottom' => '15px',
                'units'          => 'px',
            )
        ),
        
        array(
            'id'             => 'menu-sub-li-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => 'px',
            'output'         => array( '.floral-main-menu-content .sub-menu li' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sub menu item wrapper padding', 'floral' ),
            'default'        => array(
                'padding-left'   => '12px',
                'padding-right'  => '12px',
                'padding-top'    => '0',
                'padding-bottom' => '0',
                'units'          => 'px',
            )
        ),
        
        array(
            'id'      => 'menu-sub-background',
            'type'    => 'background',
            'title'   => esc_html__( 'Sub menu background', 'floral' ),
            'output'  => array( '.floral-main-menu-content .floral-tree-menu .sub-menu, .floral-main-menu-content .floral-mega-menu >.sub-menu ' ),
            'default' => array(
                'background-color' => '#222222',
            )
        ),
        
        array(
            'id'      => 'menu-sub-background-overlay',
            'type'    => 'color_rgba',
            'title'   => esc_html__( 'Sub menu background overlay', 'floral' ),
            'output'  => array( 'background-color' => '.floral-main-nav .floral-tree-menu .sub-menu:before, .floral-main-nav .floral-mega-menu > .sub-menu:before' ),
            'default' => array(
                'color' => '#000000',
                'alpha' => 0
            ),
        ),
        
        array(
            'id'             => 'menu-sub-item-size',
            'type'           => 'dimensions',
            'compiler'       => true,
            'units'          => 'px',
            'output'         => array( '.floral-main-menu-content .floral-tree-menu .sub-menu a' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sub menu item size', 'floral' ),
            'subtitle'       => esc_html__( 'Allow your users to choose the sub menu items size.<br/>Note: width of this option not available for mega menu full width items.', 'floral' ),
            'default'        => array(
                'width'  => '250px',
                'height' => '30px',
                'units'  => 'px',
            )
        ),
        
        array(
            'id'             => 'menu-sub-item-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'top'            => false,
            'bottom'         => false,
            'units'          => 'px',
            'output'         => array( '.floral-main-menu-content .sub-menu a' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sub menu item padding', 'floral' ),
            'default'        => array(
                'padding-left'  => '12px',
                'padding-right' => '12px',
                'units'         => 'px',
            )
        ),
        
        array(
            'id'       => 'menu-sub-item-color',
            'type'     => 'link_color',
            'title'    => esc_html__( 'Sub menu item color', 'floral' ),
            'output' => '.floral-main-menu-content .sub-menu a',
            'compiler' => true,
            'default'  => array(
                'regular' => '#ffffff',
                'hover'   => '#aaaaaa',
                'active'  => '#aaaaaa',
            )
        ),
        
        array(
            'id'       => 'menu-sub-item-hover-bg-color',
            'type'     => 'color_rgba',
            'compiler' => true,
            'output'   => array( 'background' => '.floral-main-menu-content .floral-tree-menu .sub-menu .menu-item:hover > a, .floral-main-menu-content .floral-mega-menu .sub-menu a:hover' ),
            'title'    => esc_html__( 'Sub menu item hover background color', 'floral' ),
            'default'  => array(
                'color' => '#ffffff',
                'alpha' => 0.1
            ),
        ),
        
        array(
            'id'       => 'menu-sub-item-hover-effect',
            'type'     => 'select',
            'title'    => esc_html__( 'Sub menu item hover effect', 'floral' ),
            'subtitle' => esc_html__( 'Select sub menu item hover effect.', 'floral' ),
            // Must provide key => value pairs for select options
            'options'  => array(
                'floral-menu-sub-item-hover-none'         => esc_html__( 'None', 'floral' ),
                'floral-menu-sub-item-hover-move-left'    => esc_html__( 'Move left', 'floral' ),
                'floral-menu-sub-item-hover-move-right'   => esc_html__( 'Move right', 'floral' ),
                'floral-menu-sub-item-hover-left-border'  => esc_html__( 'Left border', 'floral' ),
                'floral-menu-sub-item-hover-right-border' => esc_html__( 'Right border', 'floral' ),
            ),
            'default'  => 'floral-menu-sub-item-hover-none',
        ),
        
        // Mega menu
        array(
            'id'    => 'info-normal',
            'type'  => 'info',
            'title' => esc_html__( 'Mega Menu Setting', 'floral' )
        ),
        
        array(
            'id'       => 'menu-mega-separator-enable',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable mega menu separator', 'floral' ),
            'subtitle' => esc_html__( 'Enable separator between mega menu columns.', 'floral' ),
            'default'  => 1,
        ),
        
        array(
            'id'       => 'menu-mega-separator-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Mega menu separator color', 'floral' ),
            'output'   => array( 'border-left-color' => '.floral-enable-mega-menu-separator .floral-mega-menu > .sub-menu > .menu-item' ),
            'default' => array(
                'color' => '#dddddd',
                'alpha' => 0.4
            ),
        ),
    )
);