<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-header-module.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Header Modules', 'floral' ),
    'desc'   => esc_html__( 'Change the header modules section configuration.', 'floral' ),
    'icon'   => 'el-icon-puzzle',
    'fields' => array(
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Logo', 'floral' )
        ),
	
	    array(
		    'id'       => 'nav-logo-select',
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
            'id'             => 'nav-logo-height',
            'type'           => 'dimensions',
            'compiler'       => true,
            'width'          => false,
            'units'          => 'px',
            'output'         => array( '.floral-nav-body .floral-nav-logo-wrapper img' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Nav logo height', 'floral' ),
            'subtitle'       => esc_html__( 'Allow your users to choose the nav items height.', 'floral' ),
            'default'        => array(
                'height' => '50px',
                'units'  => 'px',
            )
        ),
	
	    array(
		    'id'       => 'nav-sticky-logo-select',
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
            'id'             => 'nav-sticky-logo-height',
            'type'           => 'dimensions',
            'compiler'       => true,
            'width'          => false,
            'units'          => 'px',
            'output'         => array( '.floral-nav-body.sticky-content .floral-nav-logo-wrapper img' ),
            'units-extended' => true,
            'title'          => esc_html__( 'Sticky nav logo height', 'floral' ),
            'subtitle'       => esc_html__( 'Allow your users to choose the nav items height.', 'floral' ),
            'default'        => array(
                'height' => '50px',
                'units'  => 'px',
            )
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Search', 'floral' )
        ),
        
        array(
            'id'       => 'nav-search-icon',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Search icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-search-icon'      => '<i class="w9 w9-ico-search-icon"></i>',
                'w9 w9-ico-icon-search'      => '<i class="w9 w9-ico-icon-search"></i>',
                'w9 w9-ico-search-1'         => '<i class="w9 w9-ico-search-1"></i>',
                'w9 w9-ico-basic-magnifier'  => '<i class="w9 w9-ico-basic-magnifier"></i>',
                'w9 w9-ico-magnifying-glass' => '<i class="w9 w9-ico-magnifying-glass"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite search icon.', 'floral' ),
            'default'  => 'w9 w9-ico-icon-search',
        ),
        
        array(
            'id'       => 'nav-search-result-type',
            'type'     => 'select',
            'title'    => esc_html__( 'Search result type', 'floral' ),
            'subtitle' => esc_html__( 'Choose search result after search.', 'floral' ),
            'options'  => array(
                'normal' => esc_html__( 'Normal', 'floral' ),
                'ajax'   => esc_html__( 'Ajax', 'floral' ),
            ),
            'default'  => 'normal',
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Cart', 'floral' )
        ),
        array(
            'id'       => 'shop-mini-cart-theme',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Mini cart theme', 'floral' ),
            'subtitle' => esc_html__( 'Choose your favorite mini cart theme.', 'floral' ),
            'options'  => array(
                'theme-dark'  => esc_html__( 'Dark', 'floral' ),
                'theme-light' => esc_html__( 'Light', 'floral' )
            ),
            'desc'     => esc_html__( 'If you find that changing this option does not work, please try to add an item to the cart to refresh the session storage.', 'floral' ),
            'default'  => 'theme-dark'
        ),
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Toggle Left Zone', 'floral' )
        ),
        
        array(
            'id'       => 'nav-toogle-leftzone-icon',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Toggle left zone icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-bars'              => '<i class="w9 w9-ico-bars"></i>',
                'w9 w9-ico-menu27'            => '<i class="w9 w9-ico-menu27"></i>',
                'w9 w9-ico-list23'            => '<i class="w9 w9-ico-list23"></i>',
                'w9 w9-ico-menu55'            => '<i class="w9 w9-ico-menu55"></i>',
                'w9 w9-ico-menu'              => '<i class="w9 w9-ico-menu"></i>',
                'w9 w9-ico-arrows-move-left'  => '<i class="w9 w9-ico-arrows-move-left"></i>',
                'w9 w9-ico-arrows-move-right' => '<i class="w9 w9-ico-arrows-move-right"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite toggle icon.', 'floral' ),
            'default'  => 'w9 w9-ico-list23',
        ),
        
        array(
            'id'             => 'nav-toggle-leftzone-fontsize',
            'type'           => 'typography',
            'title'          => esc_html__( 'Toggle left zone font size', 'floral' ),
            'subtitle'       => esc_html__( 'Toggle left zone font size.', 'floral' ),
            'font-size'      => true,
            'font-backup'    => false,
            'font-style'     => false,
            'font-weight'    => false,
            'font-family'    => false,
            'subsets'        => false,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'preview'        => array(
                'text' => '<i class="w9 w9-ico-bars"></i> <i class="w9 w9-ico-menu27"></i> <i class="w9 w9-ico-list23"></i> <i class="w9 w9-ico-menu55"></i> <i class="w9 w9-ico-menu"></i> <i class="w9 w9-ico-arrows-move-left"></i> <i class="w9 w9-ico-arrows-move-right"></i> ',
            ),
            'color'          => false,
            'output'         => array( '.floral-nav-body-content .floral-nav-item .floral-leftzone-caller .floral-block-icon' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '24px'
            ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Toggle Right Zone', 'floral' )
        ),
        
        array(
            'id'       => 'nav-toogle-rightzone-icon',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Toggle right zone icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-bars'              => '<i class="w9 w9-ico-bars"></i>',
                'w9 w9-ico-menu27'            => '<i class="w9 w9-ico-menu27"></i>',
                'w9 w9-ico-list23'            => '<i class="w9 w9-ico-list23"></i>',
                'w9 w9-ico-menu55'            => '<i class="w9 w9-ico-menu55"></i>',
                'w9 w9-ico-menu'              => '<i class="w9 w9-ico-menu"></i>',
                'w9 w9-ico-arrows-move-left'  => '<i class="w9 w9-ico-arrows-move-left"></i>',
                'w9 w9-ico-arrows-move-right' => '<i class="w9 w9-ico-arrows-move-right"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite toggle icon.', 'floral' ),
            'default'  => 'w9 w9-ico-menu27',
        ),
        
        array(
            'id'             => 'nav-toggle-rightzone-fontsize',
            'type'           => 'typography',
            'title'          => esc_html__( 'Toggle right zone font size', 'floral' ),
            'subtitle'       => esc_html__( 'Toggle right zone font size.', 'floral' ),
            'font-size'      => true,
            'font-backup'    => false,
            'font-style'     => false,
            'font-weight'    => false,
            'font-family'    => false,
            'subsets'        => false,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'preview'        => array(
                'text' => '<i class="w9 w9-ico-bars"></i> <i class="w9 w9-ico-menu27"></i> <i class="w9 w9-ico-list23"></i> <i class="w9 w9-ico-menu55"></i> <i class="w9 w9-ico-menu"></i> <i class="w9 w9-ico-arrows-move-left"></i> <i class="w9 w9-ico-arrows-move-right"></i> ',
            ),
            'color'          => false,
            'output'         => array( '.floral-nav-body-content .floral-nav-item .floral-rightzone-caller .floral-block-icon' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '20px'
            ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Popup', 'floral' )
        ),
        
        array(
            'id'       => 'nav-toggle-popup-icon',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Popup icon', 'floral' ),
            'options'  => array(
                'w9 w9-ico-bars'               => '<i class="w9 w9-ico-bars"></i>',
                'w9 w9-ico-list23'             => '<i class="w9 w9-ico-list23"></i>',
                'w9 w9-ico-menu55'             => '<i class="w9 w9-ico-menu55"></i>',
                'w9 w9-ico-menu'               => '<i class="w9 w9-ico-menu"></i>',
                'w9 w9-ico-chat'               => '<i class="w9 w9-ico-chat"></i>',
                'w9 w9-ico-basic-mail'         => '<i class="w9 w9-ico-basic-mail"></i>',
                'w9 w9-ico-basic-todolist-pen' => '<i class="w9 w9-ico-basic-todolist-pen"></i>',
                'w9 w9-ico-paper-plane'        => '<i class="w9 w9-ico-paper-plane"></i>',
                'w9 w9-ico-basic-download'     => '<i class="w9 w9-ico-basic-download"></i>',
                'w9 w9-ico-basic-question'     => '<i class="w9 w9-ico-basic-question"></i>',
                'w9 w9-ico-trophy'             => '<i class="w9 w9-ico-trophy"></i>',
                'w9 w9-ico-download'           => '<i class="w9 w9-ico-download"></i>',
            ),
            'subtitle' => esc_html__( 'Choose your favorite toggle icon.', 'floral' ),
            'default'  => 'w9 w9-ico-bars',
        ),
        
        array(
            'id'             => 'nav-toggle-popup-fontsize',
            'type'           => 'typography',
            'title'          => esc_html__( 'Toggle right zone font size', 'floral' ),
            'subtitle'       => esc_html__( 'Toggle right zone font size.', 'floral' ),
            'font-size'      => true,
            'font-backup'    => false,
            'font-style'     => false,
            'font-weight'    => false,
            'font-family'    => false,
            'subsets'        => false,
            'line-height'    => false,
            'word-spacing'   => false,
            'letter-spacing' => false,
            'text-align'     => false,
            'text-transform' => false,
            'preview'        => array(
                'text' => '<i class="w9 w9-ico-bars"></i> <i class="w9 w9-ico-list23"></i> <i class="w9 w9-ico-menu55"></i> <i class="w9 w9-ico-menu"></i> <i class="w9 w9-ico-chat"></i> <i class="w9 w9-ico-basic-mail"></i> <i class="w9 w9-ico-basic-todolist-pen"></i> <i class="w9 w9-ico-paper-plane"></i> <i class="w9 w9-ico-basic-download"></i> <i class="w9 w9-ico-basic-question"></i> <i class="w9 w9-ico-trophy"></i> <i class="w9 w9-ico-download"></i> ',
            ),
            'color'          => false,
            'output'         => array( '.floral-nav-body-content .floral-nav-item .floral-popup-caller .floral-block-icon' ),
            'units'          => 'px',
            'default'        => array(
                'font-size' => '28px'
            ),
        ),
        
        array(
            'id'       => 'nav-module-popup-type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Popup type', 'floral' ),
            'subtitle' => esc_html__( 'Select popup type.', 'floral' ),
            'options'  => array(
                'sidebar'          => esc_html__( 'Sidebar', 'floral' ),
                'content-template' => esc_html__( 'Content Template', 'floral' ),
            ),
            'default'  => 'sidebar',
        ),
        
        array(
            'id'       => 'nav-module-popup-sidebar',
            'type'     => 'select',
            'title'    => esc_html__( 'Popup sidebar', 'floral' ),
            'subtitle' => esc_html__( 'Choose the popup sidebar.', 'floral' ),
            'data'     => 'sidebars',
            'desc'     => '',
            'default'  => 'sidebar-popup',
            'required' => array( 'nav-module-popup-type', '=', array( 'sidebar' ) ),
        ),
        
        array(
            'id'       => 'nav-module-popup-content-template',
            'type'     => 'select',
            'title'    => esc_html__( 'Popup content template', 'floral' ),
            'subtitle' => esc_html__( 'Choose the popup content template.', 'floral' ),
            'options'  => floral_get_content_template_list(),
            'desc'     => '',
            'default'  => 'sidebar-1',
            'required' => array( 'nav-module-popup-type', '=', array( 'content-template' ) ),
        ),
        
        array(
            'id'       => mt_rand(),
            'type'     => 'info',
            'subtitle' => esc_html__( 'Custom Content', 'floral' )
        ),
        
        array(
            'id'       => 'nav-custom-content',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Custom content', 'floral' ),
            'subtitle' => esc_html__( 'Define your custom Content to nav module "Custom Content".', 'floral' ),
            'desc'     => esc_html__( 'Content can be raw HTML, shortcode string or mix of them.', 'floral' ),
            'default'  => ''
        )
    
    )
);