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

/*
 * Header Section
*/
$this->sections[] = array(
    'title'  => esc_html__( 'Header', 'floral' ),
    'desc'   => esc_html__( 'Change the header section configuration.', 'floral' ),
    'icon'   => 'el-icon-compass',
    'fields' => array(
        array(
            'id'        => 'header-override-default',
            'type'      => 'select',
            'multi'     => true,
            'title'     => esc_html__( 'Override default header settings in', 'floral' ),
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
            'subtitle' => esc_html__('Header Settings', 'floral' ),
        ),
        
        array(
            'id'       => 'header-enable',
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
            'id'       => 'nav-content',
            'type'     => 'select',
            'title'    => esc_html__( 'Select menu for header', 'floral' ),
            'subtitle' => esc_html__( 'Select menu for page, if you leave it empty it will get primary menu of your site.', 'floral' ),
            // Must provide key => value pairs for select options
            'options'  => floral_get_menu_list(),
            'default'  => 'primary',
        ),
        
        
        array(
            'id'      => 'nav-module-desktop',
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
            'id'       => 'nav-module-desktop-sticky',
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
            'id'      => 'nav-module-mobile',
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
            'id'      => 'nav-module-desktop-biggest',
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
            'id'      => 'nav-module-desktop-biggest-align',
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
            'id'      => 'nav-module-mobile-biggest',
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
            'id'      => 'nav-module-mobile-biggest-align',
            'type'    => 'button_set',
            'title'   => esc_html__( 'Biggest module in mobile screen align', 'floral' ),
            'options' => array(
                'nav-item-mobile-left'   => esc_html__( 'Left', 'floral' ),
                'nav-item-mobile-center' => esc_html__( 'Center', 'floral' ),
                'nav-item-mobile-right'  => esc_html__( 'Right', 'floral' ),
            ),
            'default' => 'nav-item-mobile-left'
        ),
    
    ), // #fields
);